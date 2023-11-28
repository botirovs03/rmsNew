<template>
    <div>
        <div id="Title">Roles</div>
        <h1>This is Roles</h1>
        <div>
            <button class="create-link" @click="isCreate = !isCreate"> Add New Role </button>
            <Transition>
                <UpsertRole
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles" :key="role.id">
                    <td>{{ role.id }}</td>
                    <td>{{ role.name }}</td>
                    <td>
                        <button
                            @click="getUpdateData(role.id)"
                            class="btn-status update-link"
                        >
                        <fa icon="pencil" />
                        </button>
                        <Link
                            :href="'/role/delete/' + role.id"
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
import UpsertRole from "./UpsertRole.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
export default {
    components: {
        UpsertRole,
        Link,
    },
    props: {
        roles: {
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
    methods: {
        CloseModal(value) {
            this.isCreate = false;
            this.isUpdate = false;
            this.updateData = {};
        },
        getUpdateData(id) {
            let config = {
                method: "get",

                url: "http://localhost/role/" + id,
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
