<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SelectMenu from "@/Components/SelectMenu.vue";

const props = defineProps({
    roles: {
        type: Object,
        required: true
    },
    user: {
        type: Object,
        required: true
    }
})


const form = useForm(props.user)

</script>

<template>
    <Head title="Create user"/>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <form @submit.prevent="form.put(route('users.update', user.id))" class="mt-6 space-y-6">

                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="email" value="e-Mail" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="role_id" value="Role" />

                            <SelectMenu
                                id="role_id"
                                class="mt-1 block w-full"
                                v-model="form.role_id"
                                :itens="roles"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.role_id" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing" class="disabled:opacity-25">Save</PrimaryButton>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>


</template>
