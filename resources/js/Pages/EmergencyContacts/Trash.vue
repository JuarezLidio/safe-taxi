<script setup>
import { computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';

const props = defineProps({
  emergencyContacts: {
    type: Array,
    required: true
  }
});

const transformedEmergencyContacts = computed(() => {
  return props.emergencyContacts.map(emergencyContact => ({
    ...emergencyContact,
    is_active: emergencyContact.is_active == 1 ? 'Activo' : 'Inactivo'
  }));
});

</script>

<template>
    <AppLayout title="Dashboard - Contactos de emergencia">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl font-bold uppercase mb-3">Listado de contactos de emergencia eliminados</h1>
                    <DataTable
                        :data="transformedEmergencyContacts"
                        :dataSelected="['users.email', 'alias','email', 'phone', `is_active`]"
                        :headerSelected="['Correo del usuario','Alias', 'Correo ','Teléfono', 'Estado']"
                        :searchInput="['alias', 'users.email', 'email']"
                        :routeRestore="{route: 'emergency_contacts.restore'}"
                        :routeDrop="{route: 'emergency_contacts.drop'}"
                        :routeRestoreAll="{route: 'emergency_contacts.restoreAll'}"
                        :routeDropAll="{route: 'emergency_contacts.dropAll'}"
                        :routePrevious="'emergency_contacts.index'"
                        :isTrash="true"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
