<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import FloatLabel from 'primevue/floatlabel';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import { computed } from 'vue';

const props = defineProps({
    assignment: {
        type: Object,
    },
    drivers: {
        type: Array,
        required: true
    },
    transports: {
        type: Array,
        required: true
    },
});

const form = useForm({
    id_driver: props.assignment.id_driver,
    id_transport: props.assignment.id_transport,
    is_actived: props.assignment.is_actived,
});

const options = [
    { label: 'Activo', value: 1 },
    { label: 'Inactivo', value: 0 }
];


</script>

<template>
    <Modal>
        <form @submit.prevent="form.put(route('assignments.update', props.assignment.id))">
            <h1 class="text-2xl font-bold text-center">Edita la asignación</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown id="id_driver" v-model="form.id_driver" :options="props.drivers" filter option-label="label" option-value="value" class="w-full" />
                    <label for="id_driver">Nombre Completo del Taxista</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_driver">
                   <p>{{ form.errors.id_driver }}</p>
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown id="id_transport" v-model="form.id_transport" :options="transports" filter option-label="label" option-value="value" class="w-full" />
                    <label for="id_transport">Número Económico</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_transport">
                   <p>{{ form.errors.id_transport }}</p>
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown id="is_actived" v-model="form.is_actived" :options="options" option-label="label" option-value="value" class="w-full" />
                    <label for="is_actived">Estado</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.is_actived">
                   <p>{{ form.errors.is_actived }}</p>
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
