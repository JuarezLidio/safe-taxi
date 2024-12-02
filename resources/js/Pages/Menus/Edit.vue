<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const props = defineProps({
    menu: {
        type: Object,
    },
    menus: {
        type: Object,
    }
});

const form = useForm({
    name: props.menu.name,
    id_parent: props.menu.id_parent,
    destination_url: props.menu.destination_url,
});

</script>

<template>
    <Modal>
        <form @submit.prevent="form.put(route('menus.update', props.menu.id))">
            <h1 class="text-2xl font-bold text-center">Edita el menú</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.id_parent" inputId="id_parent" :options="menus" optionLabel="name" class="w-full" optionValue="id" />
                    <label for="id_parent">Selecciona un menú padre</label>
                </FloatLabel>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="name" v-model="form.name" class="w-full" />
                    <label for="name">Escribe un nombre</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.name">
                   <p> {{ form.errors.name }}</p>
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="url" v-model="form.destination_url" class="w-full" />
                    <label for="url">Escribe una URL destino</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.destination_url">
                    <p>{{ form.errors.destination_url }}</p>
                </div>
            </div>
            <input type="hidden" name="_token" :value="csrf">
            <div class="flex justify-end">
                <Button type="submit" label="Editar" class="mt-6 px-6 py-1 bg-yellow-400 border-yellow-400 hover:bg-yellow-500 hover:border-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" />
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
