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
                    formCreate.post('/table/create', {
                        onBefore: () => {
                            //
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
                    v-model="formCreate.table_number"
                    placeholder="Table Number"
                    required
                />
                <div v-if="formCreate.errors.table_number">
                    {{ formCreate.errors.table_number }}
                </div>

                <input
                    type="number"
                    v-model="formCreate.capacity"
                    placeholder="capacity"
                    required
                />
                <div v-if="formCreate.errors.capacity">
                    {{ formCreate.errors.capacity }}
                </div>

                <select v-model="formCreate.status" required>
                    <option value="" selected disabled>
                        ---Select Payment Mathod---
                    </option>
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                </select>
                <div v-if="formCreate.errors.status">
                    {{ formCreate.errors.status }}
                </div>


                <button v-else type="submit" :disabled="formCreate.processing">
                    Add
                </button>
            </form>

            <form
                v-else
                class="modalForm"
                @submit.prevent="
                    formUpdate.put('/table/update/' + updateData.id, {
                        onSuccess: () => {
                            formUpdate.reset();
                            Close();
                        },
                    })
                "
            >
            <input
                    type="text"
                    v-model="formUpdate.table_number"
                    placeholder="Table Number"
                    required
                />
                <div v-if="formUpdate.errors.table_number">
                    {{ formUpdate.errors.table_number }}
                </div>

                <input
                    type="number"
                    v-model="formUpdate.capacity"
                    placeholder="capacity"
                    required
                />
                <div v-if="formUpdate.errors.capacity">
                    {{ formUpdate.errors.capacity }}
                </div>

                <select v-model="formUpdate.status" required>
                    <option value="" selected disabled>
                        ---Select Payment Mathod---
                    </option>
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                </select>
                <div v-if="formUpdate.errors.status">
                    {{ formUpdate.errors.status }}
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

export default {
    props: {
        updateData: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            formCreate: useForm({
                table_number: null,
                capacity:null,
                status: "Available",
            }),
            formUpdate: useForm({
                id: this.updateData.id,
                table_number: this.updateData.table_number,
                capacity: this.updateData.capacity,
                status: this.updateData.status,
            }),
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
