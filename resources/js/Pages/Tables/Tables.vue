<template>
    <div>
        <div id="Title">Transactions</div>
        <h1>This is Transactions</h1>
        <div>
            <button class="create-link" @click="isCreate = !isCreate"> Add New Role </button>
            <Transition>
                <UpsertTable
                    @toclose="CloseModal"
                    v-if="isCreate || isUpdate"
                    :isupdate="isUpdate"
                    :updateData="updateData"
                />
            </Transition>
        </div>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Table</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="table in tables" :key="table.id">
                    <td>{{ table.user ? table.user.name : "N/A"  }}</td>
                    <td>{{ table.table_number }}</td>
                    <td>{{ table.capacity }}</td>
                    <td>{{ table.status }}</td>

                    <td>
                        <button
                            @click="getUpdateData(table.id)"
                            class="btn-status update-link"
                        >
                        <fa icon="pencil" />
                        </button>
                        <Link
                            :href="'/table/delete/' + table.id"
                            method="delete"
                            as="button"
                            type="button"
                            class="btn-status delete-link"
                        >
                            <fa icon="trash-can" />
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import UpsertTable from "./UpsertTables.vue"
import { Link } from "@inertiajs/vue3";
import axios from "axios";
export default {
    components: {
        UpsertTable,
        Link,
    },
    props: {
        tables: {
            type: Object,
        },
    },
    data() {
        return {
            isCreate: false,
            isUpdate: false,
            updateData: {},
        };
    },
    mount () {
        console.log(transactions)
    },
    methods: {
        CloseModal(value) {
            this.isCreate = false;
            this.isUpdate = false;
            this.updateData = {};
        },
        getUpdateData(id) {
            let config = {
                method: "get",
                url: "http://localhost/table/" + id,
            };

            axios
                .request(config)
                .then((response) => {
                    this.updateData = response.data;
                    this.isUpdate = true;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="css" scoped>
.v-enter-active,
.v-leave-active {
    transition: all 0.2s ease-in-out;
}

.v-enter-from,
.v-leave-to {
    margin-top: -50px;
    opacity: 0;
}


template {
    background-color: #fef7e5;
}
</style>
