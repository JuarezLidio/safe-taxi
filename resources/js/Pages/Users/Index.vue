<script setup>
import { computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';

const props = defineProps({
  users: {
    type: Array,
    required: true
  }
});

const transformedUsers = computed(() => {
  return props.users.map(user => ({
    ...user,
    is_active: user.is_active == 1 ? 'Activo' : 'Inactivo'
  }));
});

</script>

<template>
    <AppLayout title="Dashboard - Usuarios">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl font-bold uppercase mb-3">Listado de Usuarios</h1>
                    <DataTable
                        :data="transformedUsers"
                        :dataSelected="['name', 'surname', 'roles.name','email', 'phone', `is_active`]"
                        :headerSelected="['Nombre', 'Apellido', 'Rol', 'Correo electrónico', 'Teléfono', 'Estado']"
                        :searchInput="['name', 'surname', 'phone', 'email', 'rol']"
                        :routeCreate="'users.create'"
                        :routeTrash="'users.trash'"
                        :routeShow="{route: 'users.show'}"
                        :routeEdit="{route: 'users.edit'}"
                        :routeDestroy="{route: 'users.destroy'}" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
