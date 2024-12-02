<script setup>
import { router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputIcon from 'primevue/inputicon';
import IconField from 'primevue/iconfield';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { FilterMatchMode } from 'primevue/api';
import Swal from 'sweetalert2';

const props = defineProps({
    data: {
        type: Object
    },
    dataSelected: {
        type: Array
    },
    headerSelected: {
        type: Array
    },
    searchInput: {
        type: Array
    },
    isTrash: {
        type: Boolean,
        default: false,
    },
    routeCreate: {
        type: String
    },
    routeTrash: {
        type: String
    },
    routeShow: {
        route: {
            type: String
        },
        default: false
    },
    routeEdit: {
        route: {
            type: String
        },
        default: false
    },
    routeDestroy: {
        route: {
            type: String
        },
        default: false
    },
    routeRestore: {
        route: {
            type: String
        },
        default: false
    },
    routeDrop: {
        route: {
            type: String
        },
        default: false
    },
    routeRestoreAll: {
        route: {
            type: String
        },
        default: false
    },
    routeDropAll: {
        route: {
            type: String
        },
        default: false
    },
    routePrevious: {
        type: String
    },
});
const deleteSwal = Swal.mixin({
    customClass: {
        confirmButton: "p-button p-component py-1 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-600 mr-4",
        cancelButton: "p-button p-component py-1 bg-gray-500 border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:ring-2 focus:ring-offset-2 focus:ring-gray-600"
    },
    buttonsStyling: false
});

const restoreSwal = Swal.mixin({
    customClass: {
        confirmButton: "p-button p-component py-1 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-600 mr-4",
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
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route(`${props.routeDestroy.route}`, id))
        }
    });
};

const restore = (id) => {
    restoreSwal.fire({
        title: '¿Estás seguro de que deseas restaurar este registro?',
        text: 'Recuerda que esta acción conllevará a que el registro sea público.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Restaurar",
        cancelButtonText: `Cancelar`,
        confirmButtonColor: '#22C55E',
    }).then((result) => {
        if (result.isConfirmed) {
            router.patch(route(`${props.routeRestore.route}`, id))
        }
    });
};

const drop = (id) => {
    deleteSwal.fire({
        title: '¿Estás seguro de que deseas eliminar para siempre este registro?',
        text: 'Recuerda que no podrás recuperar este registro después de eliminarlo.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route(`${props.routeDrop.route}`, id))
        }
    });
};

const restoreAll = () => {
    restoreSwal.fire({
        title: '¿Estás seguro de que deseas restaurar todos los registros?',
        text: 'Recuerda que esta acción conllevará a que todos los registros sean públicos.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Restaurar",
        cancelButtonText: `Cancelar`,
        confirmButtonColor: '#22C55E',
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route(`${props.routeRestoreAll.route}`))
        }
    });
};

const dropAll = () => {
    deleteSwal.fire({
        title: '¿Estás seguro de que deseas eliminar todos los registros?',
        text: 'Recuerda que no podrás recuperar los registros después de eliminarlos.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route(`${props.routeDropAll.route}`))
        }
    });
};

const filters = ref();

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};

initFilters();

const clearFilter = () => {
    initFilters();
};

const formatDate = (value) => {
    let fecha = new Date(value);
    let year = fecha.getFullYear();
    let month = (fecha.getMonth() + 1).toString().padStart(2, '0');
    let day = fecha.getDate().toString().padStart(2, '0');
    let hours = fecha.getHours().toString().padStart(2, '0');
    let minutes = fecha.getMinutes().toString().padStart(2, '0');
    let seconds = fecha.getSeconds().toString().padStart(2, '0');

    return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
};

</script>

<template>
    <div class="relative z-10">
        <div class="absolute right-0 m-7">

            <div v-if="props.isTrash == false">
                <Link v-if="routeCreate" :href="route(routeCreate)">
                    <Button label="Agregar" icon="pi pi-plus"
                    class="px-3 py-1 mr-2 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-600" />
                </Link>
                <Link v-if="routeTrash" type="button" :href="route(routeTrash)">
                    <Button label="Eliminados" icon="pi pi-trash"
                    class="px-3 py-1 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600  focus:ring-2 focus:ring-offset-2 focus:ring-red-600" />
                </Link>
            </div>

            <div v-if="props.isTrash == true">
                <Link v-if="routePrevious" :href="route(routePrevious)">
                    <Button label="Existentes" icon="pi pi-check-circle"
                    class="px-3 py-1 mr-2" />
                </Link>
                <Button v-if="routeRestoreAll" label="Restaurar todos" icon="pi pi-refresh"
                    class="px-3 py-1 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 mr-2 focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
                    @click.prevent="restoreAll()" />

                <Button v-if="routeDropAll" label="Eliminar todos" icon="pi pi-trash"
                    class="px-3 py-1 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-600"
                    @click.prevent="dropAll()" />
            </div>
        </div>

    </div>
    <div class="card">

        <DataTable v-model:filters="filters" :value="data" paginator :rows="5" :rowsPerPageOptions="[1, 5, 10, 20, 50]"
            tableStyle="min-width: 50rem" :globalFilterFields="searchInput">
            <template #header>
                <div class="flex justify-content-between gap-3">
                    <Button type="button" icon="pi pi-filter-slash" outlined @click="clearFilter()" />
                    <IconField iconPosition="left">
                        <InputIcon class="pi pi-search"></InputIcon>
                        <InputText v-model="filters['global'].value" placeholder="Buscar" />
                    </IconField>
                </div>
            </template>

            <div v-for="(datum, index) in dataSelected">
                <Column :field="datum" :header="headerSelected[index]"></Column>
            </div>
            
            <Column v-if="props.isTrash == false" header="Creado" field="created_at">
                <template #body="slotProps">
                    <span>{{ formatDate(slotProps.data.created_at) }} </span>
                </template>
            </Column>

            <Column v-if="props.isTrash == false" header="Actualizado" field="updated_at">
                <template #body="slotProps">
                    <span>{{ formatDate(slotProps.data.updated_at) }} </span>
                </template>
            </Column>

            <Column v-if="props.isTrash == true" header="Eliminado" field="deleted_at">
                <template #body="slotProps">
                    <span>{{ formatDate(slotProps.data.deleted_at) }} </span>
                </template>
            </Column>

            <Column header="Acciones" class="flex gap-2">
                <template #body="slotProps">
                    <Link v-if="routeShow" :href="route(`${routeShow.route}`, { id: slotProps.data.id })"><Button
                        icon="pi pi-eye" aria-label="Ver" class="p-0" /></Link>
                    <Link v-if="routeEdit" :href="route(`${routeEdit.route}`, { id: slotProps.data.id })"><Button
                        icon="pi pi-file-edit" aria-label="Ver"
                        class="p-0 bg-yellow-400 border-yellow-400 hover:bg-yellow-500 hover:border-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600" />
                    </Link>
                    <Button v-if="routeDestroy" icon="pi pi-trash"
                        class="p-0 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-600"
                        @click.prevent="destroy(slotProps.data.id)" />
                    <Button v-if="routeRestore" icon="pi pi-refresh"
                        class="p-0 bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
                        @click.prevent="restore(slotProps.data.id)" />
                    <Button v-if="routeDrop" icon="pi pi-trash"
                        class="p-0 bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-600"
                        @click.prevent="drop(slotProps.data.id)" />
                </template>
            </Column>

            <template #empty> No se encontraron resultados. </template>

        </DataTable>
    </div>
</template>
