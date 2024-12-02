<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import { computed } from 'vue';

const props = defineProps({
  assignments: {
    type: Object,
    required: true,
  },
});

const assignments = computed(() => {
  return props.assignments.map(assignment => {
    return {
      ...assignment,
      driver_full_name: `${assignment.drivers.full_name} ${assignment.drivers.surnames}`,
      is_actived: assignment.is_actived == 1 ? 'Activo' : 'Inactivo'
    };
  });
});
</script>

<template>
    <AppLayout title="Dashboard - Asignación Taxista-Transporte">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl font-bold uppercase mb-3">Listado de Asignaciones Taxista-Transporte</h1>
                    <DataTable
                        :data="assignments"
                        :dataSelected="['driver_full_name','transports.economic_number','is_actived']"
                        :headerSelected="['Nombre Completo del Taxista','Número Económico del Transporte','Estado']"
                        :searchInput="['driver_full_name', 'transports.economic_number']"
                        :routeCreate="'assignments.create'"
                        :routeTrash="'assignments.trash'"
                        :routeShow="{route: 'assignments.show'}"
                        :routeEdit="{route: 'assignments.edit'}"
                        :routeDestroy="{route: 'assignments.destroy'}" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
