<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const form = useForm({
    alias: '',
    id_parent: '',
})

const props = defineProps({
    permissions: {
        type: Object,
    },
});

</script>

<template>
    <Modal>
        <form @submit.prevent="form.post(route('permissions.store'))">
            <h1 class="text-2xl font-bold text-center">Crear un nuevo permiso</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.id_parent" :options="permissions" optionLabel="alias" class="w-full" optionValue="id" />
                    <label >Selecciona un permiso padre</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_parent">
                    <p>{{ form.errors.id_parent }}</p>
                </div>
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <InputText v-model="form.alias" class="w-full" />
                    <label>Escribe un alias</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.alias">
                    <p>{{ form.errors.alias }}</p>
                </div>
            </div>
            <input type="hidden" name="_token" :value="csrf">
            <div class="flex justify-end">
                <Button type="submit" label="Crear" class="mt-6 px-6 py-1 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-600" />
            </div>
        </form>
    </Modal>
</template>

<script>
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    props: {
        errors: Object
    },
}
</script>
