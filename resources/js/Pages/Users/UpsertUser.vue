<template>
    <div id="backModal" @click="Close">
        <div id="modal" @click.stop @mouseup.stop>
            <button class="closeButton" @click="Close">
                <fa icon="xmark" />
            </button>

            <form
                class="modalForm"
                v-if="this.updateData.id == undefined"
                @submit.prevent="
                    formCreate.post('/user/create', {
                        onBefore: () => {
                            console.log('asdfasdfasdf');
                            if (formCreate.password !== formCreate.passwordR) {
                                // Passwords do not match, prevent form submission
                                console.log('dont match')
                                return false; // Returning false prevents form submission
                            }
                           
                            // Continue with the form submission logic if passwords match
                        },
                        onSuccess: () => {
                            formCreate.reset();
                            Close();
                        },
                    })
                "
            >
                <input
                    type="text"
                    v-model="formCreate.name"
                    placeholder="Name"
                    required
                />
                <div v-if="formCreate.errors.name">{{ formCreate.errors.name }}</div>

                <select v-model="formCreate.gender" required>
                    <option value="---Select your gender---" selected disabled>
                        ---Select your gender---
                    </option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div v-if="formCreate.errors.gender">
                    {{ formCreate.errors.gender }}
                </div>

                <input
                    type="email"
                    v-model="formCreate.email"
                    placeholder="Email"
                    required
                />
                <div v-if="formCreate.errors.email">
                    {{ formCreate.errors.email }}
                </div>

                <input
                    type="text"
                    v-model="formCreate.phone"
                    placeholder="Phone Number"
                    required
                />
                <div v-if="formCreate.errors.phone">
                    {{ formCreate.errors.phone }}
                </div>

                <input
                    type="text"
                    v-model="formCreate.address"
                    placeholder="Address"
                    required
                />
                <div v-if="formCreate.errors.address">
                    {{ formCreate.errors.address }}
                </div>

                <select v-model="formCreate.role_id" required>
                    <option value="---Select role---" selected disabled>
                        ---Select role---
                    </option>
                    <option
                        v-for="role in roles"
                        :value="role.id"
                        :key="role.id"
                    >
                        {{ role.name }}
                    </option>
                </select>
                <div v-if="formCreate.errors.role_id">
                    {{ formCreate.errors.role_id }}
                </div>

                <input
                    type="password"
                    v-model="formCreate.password"
                    placeholder="Password"
                    required
                />
                <div v-if="formCreate.errors.password">
                    {{ formCreate.errors.password }}
                </div>

                <input
                    type="password"
                    v-model="formCreate.passwordR"
                    placeholder="Repeat the Password"
                    required
                />
                <div v-if="formCreate.errors.passwordR">
                    {{ formCreate.errors.passwordR }}
                </div>

                <button v-else type="submit" :disabled="formCreate.processing">
                    Add
                </button>
            </form>

            <form
                v-else
                class="modalForm"
                @submit.prevent="
                    formUpdate.put('/user/update/' + updateData.id, {
                        onSuccess: () => {
                            formUpdate.reset();
                            Close();
                        },
                    })
                "
            >
                <input type="text" v-model="formUpdate.name" required />
                <div v-if="formUpdate.errors.name">
                    {{ formUpdate.errors.name }}
                </div>

                <select v-model="formUpdate.gender" required>
                    <option value="1" selected disabled>
                        ---Select your gender---
                    </option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div v-if="formUpdate.errors.gender">
                    {{ formUpdate.errors.gender }}
                </div>

                <input
                    type="text"
                    v-model="formUpdate.email"
                    placeholder="Email"
                    required
                />
                <div v-if="formUpdate.errors.email">
                    {{ formUpdate.errors.email }}
                </div>

                <input
                    type="text"
                    v-model="formUpdate.phone"
                    placeholder="Phone Number"
                    required
                />
                <div v-if="formUpdate.errors.phone">
                    {{ formUpdate.errors.phone }}
                </div>

                <input
                    type="text"
                    v-model="formUpdate.address"
                    placeholder="Address"
                    required
                />
                <div v-if="formUpdate.errors.address">
                    {{ formUpdate.errors.address }}
                </div>

                <select v-model="formUpdate.role_id" required>
                    <option value="---Select role---" disabled>
                        ---Select role---
                    </option>
                    <option
                        v-for="role in roles"
                        :value="role.id"
                        :key="role.id"
                    >
                        {{ role.name }}
                    </option>
                </select>
                <div v-if="formUpdate.errors.role_id">
                    {{ formUpdate.errors.role_id }}
                </div>

                <div class="checkbox-container">
                    <input
                        type="checkbox"
                        v-model="formUpdate.ispassword"
                        name="ispass"
                    />
                    <label for="ispass">Update password</label>
                </div>

                <input
                    type="password"
                    v-model="formUpdate.password"
                    placeholder="Password"
                    :disabled="!formUpdate.ispassword"
                />
                <div v-if="formUpdate.errors.password">
                    {{ formUpdate.errors.password }}
                </div>

                <input
                    type="password"
                    v-model="formUpdate.passwordR"
                    placeholder="Repeat the Password"
                    :disabled="!formUpdate.ispassword"
                />
                <div v-if="formUpdate.errors.passwordR">
                    {{ formCreate.errors.passwordR }}
                </div>

                <button type="submit" :disabled="formUpdate.processing">
                    Update
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";

export default {
    mounted() {
        console.log(this.updateData);

        let config = {
            method: "get",
            url: "http://localhost/user/roles",
        };

        axios
            .request(config)
            .then((response) => {
                this.roles = response.data;
                console.log(this.roles);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    props: {
        updateData: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            formCreate: useForm({
                name: "",
                gender: "1",
                email: "",
                phone: "",
                address: "",
                role_id: "1",
                ispassword: false,
                password: "",
                passwordR: "",
            }),
            formUpdate: useForm({
                id: this.updateData.id,
                name: this.updateData.name,
                gender: this.updateData.gender,
                email: this.updateData.email,
                phone: this.updateData.phone,
                address: this.updateData.address,
                role_id: this.updateData.role_id,
                ispassword: false,
                password: "",
                passwordR: "",
            }),
            roles: [],
        };
    },
    methods: {
        Close() {
            this.$emit("toclose");
        },
    },
};
</script>

<style lang="css" scoped></style>
