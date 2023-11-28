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
                    formCreate.post('/transaction/create', {
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
                    type="number"
                    v-model="formCreate.amount"
                    placeholder="Amount"
                    step="0.01"
                    required
                />
                <div v-if="formCreate.errors.amount">
                    {{ formCreate.errors.amount }}
                </div>

                <input
                    type="date"
                    v-model="formCreate.transaction_date"
                    placeholder="date"
                    required
                />
                <div v-if="formCreate.errors.transaction_date">
                    {{ formCreate.errors.transaction_date }}
                </div>

                <input
                    type="Time"
                    v-model="formCreate.transaction_time"
                    placeholder="date"
                    required
                />
                <div v-if="formCreate.errors.transaction_time">
                    {{ formCreate.errors.transaction_time }}
                </div>

                <select v-model="formCreate.payment_method" required>
                    <option value="" selected disabled>
                        ---Select Payment Mathod---
                    </option>
                    <option value="Naxd">Naxd</option>
                    <option value="UzCard">UzCard</option>
                    <option value="Humo">Humo</option>
                    <option value="Bank raqami">Bank raqami</option>
                </select>
                <div v-if="formCreate.errors.payment_method">
                    {{ formCreate.errors.payment_method }}
                </div>

                <input
                    type="text"
                    v-model="formCreate.description"
                    placeholder="Description"
                    required
                />
                <div v-if="formCreate.errors.description">
                    {{ formCreate.errors.description }}
                </div>

                <input
                    type="text"
                    v-model="formCreate.notes"
                    placeholder="notes"
                    required
                />
                <div v-if="formCreate.errors.notes">
                    {{ formCreate.errors.notes }}
                </div>
                <select v-model="formCreate.transaction_type" required>
                    <option aria-selected="" value="Cost">Cost</option>
                    <option value="Income">Income</option>
                </select>
                <div v-if="formCreate.errors.transaction_type">
                    {{ formCreate.errors.transaction_type }}
                </div>

                <button v-else type="submit" :disabled="formCreate.processing">
                    Add
                </button>
            </form>

            <form
                v-else
                class="modalForm"
                @submit.prevent="
                    formUpdate.put('/transaction/update/' + updateData.id, {
                        onSuccess: () => {
                            formUpdate.reset();
                            Close();
                        },
                    })
                "
            >
                <input
                    type="number"
                    v-model="formUpdate.amount"
                    step="0.01"
                    required
                />
                <div v-if="formUpdate.errors.amount">
                    {{ formUpdate.errors.amount }}
                </div>

                <input
                    type="date"
                    v-model="formUpdate.transaction_date"
                    placeholder="date"
                    required
                />
                <div v-if="formUpdate.errors.transaction_date">
                    {{ formUpdate.errors.transaction_date }}
                </div>

                <input
                    type="Time"
                    v-model="formUpdate.transaction_time"
                    placeholder="date"
                    required
                />
                <div v-if="formUpdate.errors.transaction_time">
                    {{ formUpdate.errors.transaction_time }}
                </div>

                <select v-model="formUpdate.payment_method" required>
                    <option value="1" selected disabled>
                        ---Select your gender---
                    </option>
                    <option value="Naxd">Naxd</option>
                    <option value="UzCard">UzCard</option>
                    <option value="Humo">Humo</option>
                    <option value="Bank raqami">Bank raqami</option>
                </select>
                <div v-if="formUpdate.errors.payment_method">
                    {{ formUpdate.errors.payment_method }}
                </div>

                <input
                    type="text"
                    v-model="formUpdate.description"
                    placeholder="description"
                    required
                />
                <div v-if="formUpdate.errors.description">
                    {{ formUpdate.errors.description }}
                </div>

                <input
                    type="text"
                    v-model="formUpdate.notes"
                    placeholder="notes"
                    required
                />
                <div v-if="formUpdate.errors.notes">
                    {{ formUpdate.errors.notes }}
                </div>

                <select v-model="formUpdate.transaction_type" required>
                    <option value="Cost">Cost</option>
                    <option value="Income">Income</option>
                </select>
                <div v-if="formUpdate.errors.payment_method">
                    {{ formUpdate.errors.payment_method }}
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
                amount: "",
                transaction_date: new Date().toISOString().split("T")[0],
                transaction_time: new Date()
                    .toISOString()
                    .split("T")[1]
                    .split(".")[0]
                    .slice(0, 5),
                description: "",
                notes: "",
                payment_method: "Naxd",
                transaction_type: "Cost",
            }),
            formUpdate: useForm({
                id: this.updateData.id,
                amount: this.updateData.amount,
                description: this.updateData.description,
                notes: this.updateData.notes,
                payment_method: this.updateData.payment_method,
                transaction_type: this.updateData.transaction_type,
                transaction_date:
                    this.updateData.transaction_date.split("T")[0],
                transaction_time: this.updateData.transaction_time
                    .split("T")[1]
                    .split(".")[0]
                    .slice(0, 5),
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
