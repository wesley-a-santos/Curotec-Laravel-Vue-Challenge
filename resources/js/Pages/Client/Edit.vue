<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import SelectMenu from "@/Components/SelectMenu.vue";

const props = defineProps({
    genders: {
        type: Object,
        required: true
    },
    client: {
        type: Object,
        required: true
    }
})


const form = useForm(props.client)

</script>

<template>
    <Head title="Create client"/>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Client</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <form @submit.prevent="form.put(route('clients.update', client.id))" class="mt-6 space-y-6">

                        <div>
                            <InputLabel for="first_name" value="Name" />

                            <TextInput
                                id="first_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.first_name"
                                required
                                autofocus
                                autocomplete="first_name"
                            />

                            <InputError class="mt-2" :message="form.errors.first_name" />
                        </div>

                        <div>
                            <InputLabel for="surname" value="Surname" />

                            <TextInput
                                id="surname"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.surname"
                                required
                                autocomplete="surname"
                            />

                            <InputError class="mt-2" :message="form.errors.surname" />
                        </div>

                        <div>
                            <InputLabel for="social_security_number" value="Social Security Number" />

                            <TextInput
                                id="social_security_number"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.social_security_number"
                                required
                                autocomplete="social_security_number"
                            />

                            <InputError class="mt-2" :message="form.errors.social_security_number" />
                        </div>

                        <div>
                            <InputLabel for="birth_date" value="Birth Date" />

                            <TextInput
                                id="birth_date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.birth_date"
                                required
                                autocomplete="birth_date"
                            />

                            <InputError class="mt-2" :message="form.errors.birth_date" />
                        </div>

                        <div>
                            <InputLabel for="first_contact_date" value="Birth Date" />

                            <TextInput
                                id="first_contact_date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.first_contact_date"
                                required
                                autocomplete="first_contact_date"
                            />

                            <InputError class="mt-2" :message="form.errors.first_contact_date" />
                        </div>

                        <div>
                            <InputLabel for="gender_id" value="Gender" />

                            <SelectMenu
                                id="gender_id"
                                class="mt-1 block w-full"
                                v-model="form.gender_id"
                                :itens="genders"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.gender_id" />
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
