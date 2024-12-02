<script setup>
import Modal from "@/Components/MomentumModal.vue";
import { useForm } from "@inertiajs/vue3";
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const props = defineProps({
    permission: {
        type: Object,
    },
    permissions: {
        type: Object,
    }
});

const form = useForm({
    alias: props.permission.alias,
    id_parent: props.permission.id_parent,
});

</script>

<template>
    <Modal>
        <form @submit.prevent="form.put(route('permissions.update', props.permission.id))">
            <h1 class="text-2xl font-bold text-center">Edita el permiso</h1>
            <div class="form-group flex flex-col w-full">
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <Dropdown v-model="form.id_parent" inputId="id_parent" :options="permissions" optionLabel="alias" class="w-full" optionValue="id" />
                    <label>Selecciona un permiso padre</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.id_parent">
                    {{ form.errors.id_parent }}
                </div>
                <FloatLabel class="w-full md:w-14rem mt-6 mb-0">
                    <InputText v-model="form.alias" class="w-full" />
                    <label>Escribe un Alias</label>
                </FloatLabel>
                <div class="text-red-500 w-full flex justify-end mt-1 text-sm" v-if="form.errors.alias">
                    {{ form.errors.alias }}
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
