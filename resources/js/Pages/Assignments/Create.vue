<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import Button from 'primevue/button';
import { computed } from 'vue';


const form = useForm({
    id_driver: '',
    id_transport: '',
})

const props = defineProps({
    assignments: {
        type: Object
    },
    drivers: {
        type: Object
    },
    transports: {
        type: Object
    },
});

const driversFullName = computed(() => {
    return props.drivers.map(driver => {
        return {
            ...driver,
            fullName: `${driver.full_name} ${driver.surnames}`
        }
    });
});
</script>

<template>
    <Modal>
        <form @submit.prevent="form.post(route('assignments.store'))">
            <h1 class="text-2xl font-bold text-center">Crear una nueva asignación</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.id_driver" inputId="id_driver" :options="driversFullName" filter optionLabel="fullName" class="w-full" optionValue="id" />
                    <label for="id_driver">Selecciona el taxista</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_driver">
                    {{ form.errors.id_driver }}
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.id_transport" inputId="id_transport" :options="transports" filter optionLabel="economic_number" class="w-full" optionValue="id" />
                    <label for="id_transport">Selecciona el número economico</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_transport">
                    {{ form.errors.id_transport }}
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
