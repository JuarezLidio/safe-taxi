<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const form = useForm({
    name: '',
    id_parent: '',
    destination_url: '',
})

const props = defineProps({
    menus: {
        type: Object,
    },
});

</script>

<template>
    <Modal>
        <form @submit.prevent="form.post(route('menus.store'))">
            <h1 class="text-2xl font-bold text-center">Crear un nuevo menú</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.id_parent" inputId="id_parent" :options="menus" optionLabel="name" class="w-full" optionValue="id" />
                    <label for="id_parent">Selecciona un menú padre</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_parent">
                    {{ form.errors.id_parent }}
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="name" v-model="form.name" class="w-full" />
                    <label for="name">Escribe un nombre</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="url" v-model="form.destination_url" class="w-full" />
                    <label for="url">Escribe una URL destino</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.destination_url">
                   <p> {{ form.errors.destination_url }} </p>
                </div>

            </div>
            <input type="hidden" name="_token" :value="csrf">
            <div class="flex justify-end">
                <Button type="submit" label="Crear" class="mt-6 px-6 py-1 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-600"  />
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
