<template>
    <div id="backModal" @click="Close">
        <div id="modal" @click.stop>
            <button class="closeButton" @click="Close"><fa icon="xmark" /></button>

            <form  class="modalForm" v-if="this.updateData.id == undefined" @submit.prevent="formCreate.post('/role/create', {
                onSuccess: () => {
                    formCreate.reset()
                }
            })">
                <!-- email -->
                <input type="text" v-model="formCreate.name" placeholder="Name" required/>
                <div v-if="formCreate.errors.name">{{ form.errors.name }}</div>

                <button v-else type="submit" :disabled="formCreate.processing">Add</button>
            </form>

            <form v-else class="modalForm" @submit.prevent="formUpdate.put('/role/update/'+ updateData.id, {
                onSuccess: () => {
                    formUpdate.reset()
                    Close()
                }
            })">
                <!-- email -->
                <input type="text" v-model="formUpdate.name" required/>
                <div v-if="formUpdate.errors.name">{{ form.errors.name }}</div>

                <button type="submit" :disabled="formUpdate.processing">Update</button>
            </form>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";

export default {
    mounted () {
        console.log(this.updateData);
    },
    props: {
        updateData: {
            type: Object,
            default: {}
        },
    },
    data() {
        return {
            formCreate: useForm({
                name: null,
            }),
            formUpdate:useForm({
                id:this.updateData.id,
                name:this.updateData.name
            })
        };
    },
    methods: {
        Close() {
            this.$emit("toclose");
        },
    },
};
</script>

<style lang="css" scoped>

</style>
