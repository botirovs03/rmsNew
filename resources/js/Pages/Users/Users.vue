<template>
    <div>
        <div id="Title">Users</div>
        <h1>This is Users</h1>
        <div>
            <Button class="create-link" @click="isCreate = !isCreate"> Add New Role </Button>
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
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.gender }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone }}</td>
                    <td>{{ user.address }}</td>


                    <td>
                        <button
                            @click="getUpdateData(user.id)"
                            class="btn-status update-link"
                        >
                        <fa icon="pencil" />
                        </button>
                        <Link
                            :href="'/user/delete/' + user.id"
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
import UpsertRole from "./UpsertUser.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
export default {
    components: {
        UpsertRole,
        Link,
    },
    props: {
        users: {
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
                url: "http://localhost/user/" + id,
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

#Title {
    position: relative;
    top: -70px;
    font-size: 40px;
}
template {
    background-color: #fef7e5;
}
</style>
