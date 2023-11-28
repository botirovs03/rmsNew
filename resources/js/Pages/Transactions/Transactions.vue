<template>
    <div>
        <div id="Title">Transactions</div>
        <h1>This is Transactions</h1>
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
                    <th>User</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Method</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="transaction in transactions" :key="transaction.id">
                    <td>{{ transaction.user ? transaction.user.name : "N/A"  }}</td>
                    <td>{{ transaction.amount }}</td>
                    <td>{{ transaction.description }}</td>
                    <td>{{ transaction.transaction_type }}</td>
                    <td>{{ transaction.payment_method }}</td>
                    <td>{{ transaction.notes }}</td>


                    <td>
                        <button
                            @click="getUpdateData(transaction.id)"
                            class="btn-status update-link"
                        >
                        <fa icon="pencil" />
                        </button>
                        <Link
                            :href="'/transaction/delete/' + transaction.id"
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
import UpsertRole from "./UpsertTransactions.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
export default {
    components: {
        UpsertRole,
        Link,
    },
    props: {
        transactions: {
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
                url: "http://localhost/transaction/" + id,
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
