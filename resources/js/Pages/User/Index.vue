<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import PrimaryLink from "@/Components/PrimaryLink.vue";
import Pagination from "@/Components/Pagination.vue";
import GreenLink from "@/Components/GreenLink.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    users: {
        type: Object,
        required: true
    }
})

const destroy = (id) => {
    if (confirm('Are you sure?')) {
        router.delete(route('users.destroy', id))
    }
}

</script>

<template>
    <Head title="Users"/>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <PrimaryLink :href="route('users.create')" class="mt-3">Add User</PrimaryLink>

                    <table class="w-full text-left table-auto min-w-max text-slate-800 mt-4">
                        <thead>
                        <tr class="text-slate-500 border-b border-slate-300 bg-slate-50">
                            <th class="p-4">

                                Name

                            </th>
                            <th class="p-4">

                                e-Mail

                            </th>
                            <th class="p-4">

                                Role

                            </th>

                            <th class="p-4">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="hover:bg-slate-50" v-for="user in users.data" :key="user.id">
                            <td class="p-4">

                                {{ user.name }}

                            </td>
                            <td class="p-4">

                                {{ user.email }}

                            </td>
                            <td class="p-4">

                                {{ user.role.name }}

                            </td>

                            <td class="p-4">
                                <PrimaryLink :href="route('users.edit', user.id)" class="mr-2">Edit</PrimaryLink>
                                <GreenLink :href="route('users.show', user.id)" class="mr-2">Show</GreenLink>
                                <DangerButton @click="destroy(user.id)" type="button" >
                                    Delete
                                </DangerButton>
                            </td>
                        </tr>

                        </tbody>
                    </table>


                    <Pagination :pagination="users.meta"/>

                </div>
            </div>
        </div>


    </AuthenticatedLayout>


</template>
