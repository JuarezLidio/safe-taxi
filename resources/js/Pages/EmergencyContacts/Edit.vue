<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    emergencyContacts: {
        type: Object,
    },
});

const form = useForm({
    alias: props.emergencyContacts.alias,
    description: props.emergencyContacts.description,
    email: props.emergencyContacts.email,
    phone: props.emergencyContacts.phone,
    is_active: props.emergencyContacts.is_active
});

const options = [
  { id: 1, label: 'Activo' },
  { id: 0, label: 'Inactivo' }
];

</script>

<template>
    <Modal>
        <form @submit.prevent="form.put(route('emergency_contacts.update', props.emergencyContacts.id))">
            <h1 class="text-2xl font-bold">Edita el usuario de emergencia</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="alias" v-model="form.alias" class="w-full" />
                    <label for="alias">Escribe un alias</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.alias">
                    {{ form.errors.alias }}
                </div>
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
                    <label >Escribe un correo electrónico</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText id="phone" v-model="form.phone" class="w-full" />
                    <label >Escribe un teléfono</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.phone">
                    {{ form.errors.phone }}
                </div>
            </div>
            <div class="form-group flex flex-col w-full" v-if="$page.props.auth.user.id_role !=3">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.is_active" inputId="is_active" :options="options" optionLabel="label" class="w-full" optionValue="id" />
                    <label >Estado</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.is_active">
                    {{ form.errors.is_active }}
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
