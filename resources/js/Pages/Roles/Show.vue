<script setup>
import Modal from "@/Components/MomentumModal.vue";
import Swal from 'sweetalert2';
import { router, Link } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const props = defineProps({
    role: {
        type: Object,
    },
});
const deleteSwal = Swal.mixin({
    customClass: {
        confirmButton: "p-button p-component py-1 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-600 mr-4",
        cancelButton: "p-button p-component py-1 bg-gray-500 border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:ring-2 focus:ring-offset-2 focus:ring-gray-600"
    },
    buttonsStyling: false
});
const destroy = (id) => {
    deleteSwal.fire({
        title: '¿Estás seguro de que deseas eliminar este registro?',
        text: 'Recuerda que cuentas con un plazo de 30 días para recuperar este registro.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: `Cancelar`,
        confirmButtonColor: '#EF4444',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('roles.destroy', id))
        }
    });
};
</script>

<template>
    <Modal>
        <h1 class="text-2xl font-bold">Visualizar rol</h1>
        <div class="form-group flex flex-col">
            <div class="mt-4 mb-0">
                <label for="name" class="w-full">Nombre</label>
                <InputText class="w-full" id="name" :placeholder="role.name" disabled />
            </div>
            <div class="w-full flex items-start mt-6 justify-between">
                <Link :href="route('roles.edit', role.id)">
                    <Button label="Editar" icon="pi pi-file-edit" aria-label="Ver"
                    class="px-6 py-1 bg-yellow-400 border-yellow-400 hover:bg-yellow-500 hover:border-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" />
                </Link>
                <Button label="Borrar" icon="pi pi-trash"
                    class="px-6 py-1 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-600"
                    @click.prevent="destroy(role.id)" />
            </div>
        </div>

    </Modal>
</template>

<script>
</script>
