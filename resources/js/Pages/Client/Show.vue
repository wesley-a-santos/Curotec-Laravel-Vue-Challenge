<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import PrimaryLink from "@/Components/PrimaryLink.vue";
import GreenLink from "@/Components/GreenLink.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    client: {
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
    <Head title="Create client"/>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Client Details</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <div>
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base/7 font-semibold text-gray-900">Client Information</h3>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm/6 font-medium text-gray-900">Name</dt>
                                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ [client.first_name, client.surname].join(' ')}}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm/6 font-medium text-gray-900">Social Security Number</dt>
                                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ client.social_security_number }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm/6 font-medium text-gray-900">Birth Date</dt>
                                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        {{ client.birth_date }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm/6 font-medium text-gray-900">Gender</dt>
                                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        {{ client.gender.name }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm/6 font-medium text-gray-900">First Contact Date</dt>
                                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ client.first_contact_date }}</dd>
                                </div>

                            </dl>
                        </div>
                    </div>
                    <PrimaryLink :href="route('clients.index')" class="mt-3 mr-2">Back</PrimaryLink>
                    <GreenLink :href="route('clients.edit', client.id)" class="mr-2">Edit</GreenLink>
                    <DangerButton @click="destroy(client.id)" type="button" >
                        Delete
                    </DangerButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>


</template>
