<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    transport: {
        type: Object,
    },
    transports: {
        type: Object,
    }
});

const form = useForm({
    model: props.transport.model,
    sub_model: props.transport.sub_model,
    car_plate: props.transport.car_plate,
    brand: props.transport.brand,
    sub_brand: props.transport.sub_brand,
    economic_number: props.transport.economic_number,
    is_actived: props.transport.is_actived
});

const options = [
    { label: 'Activo', value: 1 },
    { label: 'Inactivo', value: 0 }
];
</script>

<template>
    <Modal>
        <form @submit.prevent="form.put(route('transports.update', props.transport.id))">
            <h1 class="text-2xl font-bold text-center">Edita el transporte</h1>
            <div class="form-group  grid grid-cols-1 md:grid-cols-2 gap-6">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="model" v-model="form.model" class="w-full" />
                    <label for="model">Escribe el modelo</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.model">
                   <p> {{ form.errors.model }}</p>
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="sub_model" v-model="form.sub_model" class="w-full" />
                    <label for="sub_model">Escribe el submodelo</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.sub_model">
                   <p> {{ form.errors.sub_model }}</p>
                </div>

                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="car_plate" v-model="form.car_plate" class="w-full" />
                    <label for="car_plate">Escribe la matrícula</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.car_plate">
                    <p>{{ form.errors.car_plate }}</p>
                </div>
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="brand" v-model="form.brand" class="w-full" />
                    <label for="brand">Escribe la marca</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.brand">
                    <p>{{ form.errors.brand }}</p>
                </div>
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="sub_brand" v-model="form.sub_brand" class="w-full" />
                    <label for="sub_brand">Escribe la submarca</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.sub_brand">
                    <p>{{ form.errors.sub_brand }}</p>
                </div>
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="economic_number" v-model="form.economic_number" class="w-full" />
                    <label for="economic_number">Escribe el número económico</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.economic_number">
                    <p>{{ form.errors.economic_number }}</p>
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
