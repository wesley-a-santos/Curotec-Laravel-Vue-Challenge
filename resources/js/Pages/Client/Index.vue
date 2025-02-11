<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import PrimaryLink from "@/Components/PrimaryLink.vue";
import Pagination from "@/Components/Pagination.vue";
import GreenLink from "@/Components/GreenLink.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    clients: {
        type: Object,
        required: true
    }
})

const destroy = (id) => {
    if (confirm('Are you sure?')) {
        router.delete(route('clients.destroy', id))
    }
}


</script>

<template>
    <Head title="Clients"/>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clients</h2>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <PrimaryLink :href="route('clients.create')" class="mt-3">Add CLient</PrimaryLink>

                    <table class="w-full text-left table-auto min-w-max text-slate-800 mt-4">
                        <thead>
                        <tr class="text-slate-500 border-b border-slate-300 bg-slate-50">
                            <th class="p-4">

                                Name

                            </th>
                            <th class="p-4">

                                Social Security Number

                            </th>
                            <th class="p-4">

                                Birth Date

                            </th>
                            <th class="p-4">

                                Gender

                            </th>
                            <th class="p-4">

                                First Contact Date

                            </th>
                            <th class="p-4">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="hover:bg-slate-50" v-for="client in clients.data" :key="client.id">
                            <td class="p-4">

                                {{ [client.first_name, client.surname].join(' ') }}

                            </td>
                            <td class="p-4">

                                {{ client.social_security_number }}

                            </td>
                            <td class="p-4">

                                {{ client.birth_date }}

                            </td>
                            <td class="p-4">

                                {{ client.gender.name }}

                            </td>
                            <td class="p-4">

                                {{ client.first_contact_date }}

                            </td>
                            <td class="p-4">
                                <PrimaryLink :href="route('clients.edit', client.id)" class="mr-2">Edit</PrimaryLink>
                                <GreenLink :href="route('clients.show', client.id)" class="mr-2">Show</GreenLink>
                                <DangerButton @click="destroy(client.id)" type="button" >
                                    Delete
                                </DangerButton>
                            </td>
                        </tr>

                        </tbody>
                    </table>


                    <Pagination :pagination="clients.meta"/>

                </div>
            </div>
        </div>


    </AuthenticatedLayout>


</template>
