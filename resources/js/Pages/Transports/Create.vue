<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const form = useForm({
    model: '',
    sub_model: '',
    car_plate: '',
    brand: '',
    sub_brand: '',
    economic_number: ''
})

const props = defineProps({
    transports: {
        type: Object,
    },
});

</script>

<template>
    <Modal>
        <form @submit.prevent="form.post(route('transports.store'))">
            <h1 class="text-2xl font-bold text-center">Crear un nuevo transporte</h1>
            <div class="form-group flex flex-col w-full">

                <FloatLabel class="w-full md:w-14rem mt-5 mb-0">
                    <InputText id="model" v-model="form.model" class="w-full" />
                    <label for="model">Escribe el modelo</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.model">
                    {{ form.errors.model }}
                </div>

                <FloatLabel class="w-full md:w-14rem mt-5 mb-0">
                    <InputText id="sub_model" v-model="form.sub_model" class="w-full" />
                    <label for="sub_model">Escribe el submodelo</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.sub_model">
                    {{ form.errors.sub_model }}
                </div>

                <FloatLabel class="w-full md:w-14rem mt-5 mb-0">
                    <InputText id="car_plate" v-model="form.car_plate" class="w-full" />
                    <label for="car_plate">Escribe la matrícula</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.car_plate">
                    {{ form.errors.car_plate }}
                </div>

                <FloatLabel class="w-full md:w-14rem mt-5 mb-0">
                    <InputText id="brand" v-model="form.brand" class="w-full" />
                    <label for="brand">Escribe la marca</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.brand">
                   <p> {{ form.errors.brand }} </p>
                </div>

                <FloatLabel class="w-full md:w-14rem mt-5 mb-0">
                    <InputText id="sub_brand" v-model="form.sub_brand" class="w-full" />
                    <label for="sub_brand">Escribe la submarca</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.sub_brand">
                   <p> {{ form.errors.brand }} </p>
                </div>

                <FloatLabel class="w-full md:w-14rem mt-5 mb-0">
                    <InputText id="economic_number" v-model="form.economic_number" class="w-full" />
                    <label for="economic_number">Escribe el número económico</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.economic_number">
                   <p> {{ form.errors.economic_number}} </p>
                </div>

            </div>
            <input type="hidden" name="_token" :value="csrf">
            <div class="flex justify-end">
                <Button type="submit" label="Crear" class="mt-5 px-6 py-1 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-600"  />
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
