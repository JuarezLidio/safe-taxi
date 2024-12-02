<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import Password from 'primevue/password';

const form = useForm({
    name: '',
    surname:'',
    id_role:'',
    email: '',
    phone: '',
    password:'',
    password_confirmation: '',
})

const props = defineProps({
    roles: {
        type: Object,
    },
});
</script>

<style>

 .p-password-input{
    width: 100% !important;
 }

</style>

<template>
    <Modal>
        <form @submit.prevent="form.post(route('users.store'))">
            <h1 class="text-2xl font-bold text-center">Crear un nuevo usuario</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <InputText id="name" v-model="form.name" class="w-full" />
                    <label for="name">Escribe un nombre</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <InputText id="surname" v-model="form.surname" class="w-full" />
                    <label for="surname">Escribe un apellido</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.surname">
                    {{ form.errors.surname }}
                </div>
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.id_role" :options="roles" optionLabel="name" class="w-full" optionValue="id" />
                    <label >Selecciona un rol</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_role">
                    {{ form.errors.id_role }}
                </div>
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <InputText id="email" v-model="form.email" class="w-full" />
                    <label for="email">Escribe un correo electrónico</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <InputText id="phone" v-model="form.phone" class="w-full" />
                    <label for="phone">Escribe un teléfono</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.phone">
                    {{ form.errors.phone }}
                </div>
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <Password class="w-full" id="password" v-model="form.password" :feedback="false" toggleMask />
                    <label for="password">Escribe una contraseña</label>
                </FloatLabel>
                <div class="text-red-500 flex justify-end mt-1 text-sm w-full" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
                <FloatLabel class="md:w-14rem mt-6 mb-0">
                    <Password class="w-full" id="password_confirmation" v-model="form.password_confirmation" :feedback="false" toggleMask />
                    <label for="password_confirmation">Confirma la contraseña</label>
                </FloatLabel>
                <div class="text-red-500 flex justify-end mt-1 text-sm w-full" v-if="form.errors.password_confirmation">
                    {{ form.errors.password_confirmation }}
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
