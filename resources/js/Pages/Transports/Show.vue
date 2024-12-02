<script setup>
import Modal from "@/Components/MomentumModal.vue";
import Swal from 'sweetalert2';
import { router, Link } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { computed } from 'vue';

const props = defineProps({
    transport: {
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
            router.delete(route('transports.destroy', id))
        }
    });
};

const status = computed(() => {
    return props.transport.is_actived ? 'Activo' : 'Inactivo';
});
</script>

<template>
    <Modal>
        <h1 class="text-2xl font-bold text-center mb-3">Visualizar transporte</h1>
        <div class="form-group  grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col space-y-1">
                <label for="model" class="w-full">Modelo</label>
                <InputText class="w-full" id="model" :placeholder="transport.model" disabled />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="sub_model" class="w-full">Submodelo</label>
                <InputText class="w-full" id="sub_model" :placeholder="transport.sub_model" disabled />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="car_plate" class="w-full">Matrícula</label>
                <InputText class="w-full" id="car_plate" :placeholder="transport.car_plate" disabled />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="brand" class="w-full">Marca</label>
                <InputText class="w-full" id="brand" :placeholder="transport.brand" disabled />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="sub_brand" class="w-full">Submarca</label>
                <InputText class="w-full" id="sub_brand" :placeholder="transport.sub_brand" disabled />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="economic_number" class="w-full">Número económico</label>
                <InputText class="w-full" id="economic_number" :placeholder="transport.economic_number" disabled />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="is_actived" class="w-full">Estado</label>
                <InputText class="w-full" id="is_actived" :placeholder="status" disabled />
            </div>
        </div>
            <div class="mt-3 flex justify-end">
                <Link :href="route('transports.edit', transport.id)">
                <Button label="Editar" icon="pi pi-file-edit" aria-label="Ver"
                    class="px-6 py-1 bg-yellow-400 border-yellow-400 hover:bg-yellow-500 hover:border-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" />
                </Link>
                <Button label="Borrar" icon="pi pi-trash"
                    class="ml-4 px-6 py-1 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-600"
                    @click.prevent="destroy(transport.id)" />
            </div>
    </Modal>
</template>

<script>
</script>
