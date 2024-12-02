<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const form = useForm({
    alias: '',
    description: '',
    email: '',
    phone: '',
    is_active: ''
});

</script>

<template>
    <Modal>
        <form @submit.prevent="form.post(route('emergency_contacts.store'))">
            <h1 class="text-2xl font-bold text-center">Crear un nuevo contacto de emergencia</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="alias" v-model="form.alias" class="w-full" />
                    <label for="alias">Escribe un alias</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.alias">
                    {{ form.errors.alias }}
                </div>

                <div class="form-group flex flex-col w-full">
                    <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                        <InputText id="description" v-model="form.description" class="w-full" />
                        <label for="description">Escribe una descripción</label>
                    </FloatLabel>
                    <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.description">
                        {{ form.errors.description }}
                    </div>
                </div>

                <div class="form-group flex flex-col w-full">
                    <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                        <InputText id="email" v-model="form.email" class="w-full" />
                        <label>Escribe un correo electrónico</label>
                    </FloatLabel>
                    <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.email">
                        {{ form.errors.email }}
                    </div>
                </div>
                <div class="form-group flex flex-col w-full">
                    <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                        <InputText id="phone" v-model="form.phone" class="w-full" />
                        <label>Escribe un teléfono</label>
                    </FloatLabel>
                    <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.phone">
                        {{ form.errors.phone }}
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" :value="csrf">
            <div class="flex justify-end">
                <Button type="submit" label="Crear"
                    class="mt-6 px-6 py-1 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-600" />
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
