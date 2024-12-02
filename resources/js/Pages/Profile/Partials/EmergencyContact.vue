<script setup>
import Swal from 'sweetalert2';
import ActionSection from '@/Components/ActionSection.vue';
import Button from 'primevue/button';
import { router, Link } from '@inertiajs/vue3';

const props = defineProps({
    emergencyContacts: {
        type: Object,
        required: true
    }
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
            router.delete(route('emergency_contacts.destroy', id))
        }
    });
};

</script>

<template>
    <ActionSection>
        <template #title>
            Contactos de emergencia
        </template>
        <template #description>
            Siempre mantenga un contacto de emergencia disponible para cualquier situación.
        </template>
        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                <table class="w-full">
                    <tbody>
                        <div v-for="(contact, index) in emergencyContacts">
                            <tr class="flex items-center gap-12 scale-100 py-1 border-b-2 border-gray-200"
                                v-if="contact.is_active != 0">
                                <td class="whitespace-no-wrap  text-4xl font-medium ">
                                    <span
                                        class="items-center border-2 px-3 py-0.5 border-gray-500 text-gray-500 rounded-full">
                                        {{ index + 1 }}</span>
                                </td>
                                <td class="px-2 py-2 whitespace-no-wrap font-medium">
                                    <p class="leading-5 text-gray-700 font-semibold ">Alias:</p>
                                    <p class="leading-5 text-gray-700">Descripción:</p>
                                    <p class="leading-5 text-gray-700">Correo electrónico:</p>
                                    <p class="leading-5 text-gray-700">Teléfono celular:</p>
                                </td>
                                <td class="px-2 py-2 whitespace-no-wrap">
                                    <p class="leading-5 text-gray-700 ">{{ contact.alias }}</p>
                                    <p class="leading-5 text-gray-700">{{ contact.description }}</p>
                                    <p class="leading-5 text-gray-700">{{ contact.email }}</p>
                                    <p class="leading-5 text-gray-700">{{ contact.phone }}</p>
                                </td>
                                <td class="px-2 py-2 whitespace-no-wrap">
                                    <Link :href="route('emergency_contacts.edit', contact.id)">
                                    <Button label="EDITAR" icon="pi pi-file-edit"
                                        class="px-6 py-1 mb-4 bg-yellow-400 border-yellow-400  text-xs hover:bg-yellow-500 hover:border-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" />
                                    </Link>
                                    <Button label="BORRAR" icon="pi pi-trash"
                                        class="px-6 py-1 bg-principal-500 border-principal-500 text-xs hover:bg-principal-600 focus:bg-principal-800 hover:border-principal-600 focus:ring-2 focus:ring-offset-2 focus:ring-principal-600"
                                        @click.prevent="destroy(contact.id)" />
                                </td>
                            </tr>

                        </div>
                        <tr>
                            <td>
                                <Link :href="route('emergency_contacts.create')">
                                <button type="submit"
                                    class="mt-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-green-500 hover:bg-green-600 focus:bg-green-600 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Agrega un usuario de emergencia </button>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </template>


    </ActionSection>
</template>
