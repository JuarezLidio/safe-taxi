<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import Button from 'primevue/button';
import RecursiveList from '@/Components/RecursiveList.vue'
import { Link } from '@inertiajs/vue3';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

defineEmits(['upload-data'])

const props = defineProps({
    role: {
        type: Object,
    },
    rolePermission: {
        type: Array,
    },
    roleMenu: {
        type: Array,
    },
    permissions: {
        type: Array,
    },
    menus: {
        type: Array,
    },
});

const form = useForm({
    alias: [],
    name: [],
});

function getIdsAndChildrenIds(permissions) {
    // Recursive function to traverse nodes and their children
    const array = [];

    function traverseNodes(node, parentIds) {
        // Save the id of the current node
        const id = node.id;

        // If there are child nodes, traverse them as well
        if (node.children) {
            node.children.forEach(child => {
                // Add the id of the current node to the child's parentIds
                const childParentIds = [...parentIds, id];
                // Recursively call for children
                traverseNodes(child, childParentIds);
            });
        }
        array.push(id);
        // Show the ids and parentIds of the current node
    }

    // Iterate over each main node
    permissions.forEach(node => {
        // Start with an empty list of parentIds
        const parentIds = [];
        // Call the function to traverse nodes
        traverseNodes(node, parentIds);
    });

    return array;
}
const roleArray = [props.role];

getIdsAndChildrenIds(props.rolePermission).forEach((element) => form.alias.push(element));
getIdsAndChildrenIds(props.roleMenu).forEach((element) => form.name.push(element));

const uploadData = (item, model) => {
    if (form[model].includes(item)) {
        form[model] = form[model].filter(id => id !== item);
    } else {
        form[model].push(item);
    }
};
</script>

<template>
    <AppLayout title="Dashboard - Roles - Permisos - Menús">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl uppercase mb-3 font-bold">Edición de Rol - Permiso - Menú</h1>
                    <form @submit.prevent="form.put(route('roles.updateRelationship', props.role.id))">
                        <DataTable :value="roleArray" class="pb-10" tableStyle="min-width: 50rem; padding: 100rem;">
                            <Column field="name" header="Rol" class="align-top"></Column>
                            <Column header="Permisos" class="align-top">
                                <template #body="slotProps">
                                    <div class="flex items-center mb-4">
                                        <input checked type="checkbox" disabled
                                            class="w-4 h-4 text-blue-600 bg-blue-500 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label class="ms-2 text-sm  text-gray-900 dark:text-gray-300">Controller</label>
                                    </div>
                                    <RecursiveList :target="'alias'" :items="permissions"
                                        :comparisionItems="rolePermission" :comparisionFlag="true"
                                        @upload-data="uploadData" />
                                </template>
                            </Column>
                            <Column header="Menús" class="align-top">
                                <template #body="slotProps">
                                    <div class="flex items-center mb-4">
                                        <input checked type="checkbox" disabled
                                            class="w-4 h-4 text-blue-600 bg-blue-500 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label class="ms-2 text-sm  text-gray-900 dark:text-gray-300">Index</label>
                                    </div>
                                    <RecursiveList :target="'name'" :items="menus" :comparisionItems="roleMenu"
                                        :comparisionFlag="true" @upload-data="uploadData" />
                                </template>
                            </Column>
                        </DataTable>
                        <input type="hidden" name="_token" :value="csrf">
                        <Link :href="route('roles.indexRelationship')">
                        <Button label="Listado" class="bottom-24 fixed px-3 py-1" />
                        </Link>
                        <Button type="submit" label="Editar"
                            class="bottom-24 ml-24 fixed mt-6 px-6 py-1 bg-yellow-400 border-yellow-400 hover:bg-yellow-500 hover:border-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600" />
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
}

</script>
