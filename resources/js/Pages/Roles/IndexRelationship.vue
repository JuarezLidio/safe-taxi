<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import RecursiveList from '@/Components/RecursiveList.vue'
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';

const props = defineProps({
    roles: {
        type: Object,
    },
    rolesPermissions: {
        type: Array,
    },
    rolesMenus: {
        type: Array,
    },
});

const visibilityPermissions = ref(Array(props.rolesPermissions.length).fill(false));

const expandPermissions = (index) => {
    visibilityPermissions.value[index] = !visibilityPermissions.value[index];
};

const visibilityMenus = ref(Array(props.rolesMenus.length).fill(false));

const expandMenus = (index) => {
    visibilityMenus.value[index] = !visibilityMenus.value[index];
};
</script>

<template>
    <AppLayout title="Dashboard - Roles - Permisos - Menús">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl uppercase mb-3 font-bold">Listado de Roles - Permisos - Menús</h1>
                    <div class="card">
                        <DataTable :value="roles" tableStyle="min-width: 50rem;">
                            <Column field="name" class="align-top" header="Rol"></Column>
                            <Column header="Permisos" class="align-top">
                                <template #body="slotProps">
                                    <p v-show="rolesPermissions[slotProps.index] != 0" class="font-bold hover:cursor-pointer" @click.prevent="expandPermissions(slotProps.index)">Controller<i :class="{'pi pi-angle-down': !visibilityPermissions[slotProps.index], 'pi pi-angle-up': visibilityPermissions[slotProps.index]}" ></i></p>
                                    <p v-show="rolesPermissions[slotProps.index] == 0" class="font-bold">Controller</p>
                                    <div v-show="visibilityPermissions[slotProps.index]">
                                        <RecursiveList :target="'alias'" :items="rolesPermissions[slotProps.index]" />
                                    </div>
                                </template>
                            </Column>
                            <Column header="Menús" class="align-top">
                                <template #body="slotProps">
                                    <p v-show="rolesMenus[slotProps.index] != 0" class="font-bold hover:cursor-pointer h-full" @click.prevent="expandMenus(slotProps.index)">Index<i :class="{'pi pi-angle-down': !visibilityMenus[slotProps.index], 'pi pi-angle-up': visibilityMenus[slotProps.index]}" ></i></p>
                                    <p v-show="rolesMenus[slotProps.index] == 0" class="font-bold">Index</p>
                                    <div v-show="visibilityMenus[slotProps.index]">
                                        <RecursiveList :target="'name'" :items="rolesMenus[slotProps.index]" />
                                    </div>
                                </template>
                            </Column>
                            <Column header="Acciones" class="align-top">
                                <template #body="slotProps">
                                    <Link :href="route('roles.editRelationship', { id: slotProps.data.id })" class="w-3/4"><Button icon="pi pi-file-edit" aria-label="Ver" class="w-full p-0 bg-yellow-400 border-yellow-400 hover:bg-yellow-500 hover:border-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600" /></Link>
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
