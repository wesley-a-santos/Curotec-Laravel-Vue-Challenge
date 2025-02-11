<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { ref, computed } from 'vue'
import { useTodoStore } from '@/Stores/todo'
import DangerButton from "@/Components/DangerButton.vue";
import Checkbox from "@/Components/Checkbox.vue";

const todoStore = useTodoStore()

const newTodo = ref('')
const todos = computed(() => todoStore.getTodos)

const addTodo = async () => {
    await todoStore.addTodo({ id: Math.random(), text: newTodo.value, done: false })
    newTodo.value = ''
}

const removeTodo = async (id) => {
    await todoStore.removeTodo(id)
}

const updateTodo = async (id, done) => {
    await todoStore.updateTodo(id, done)
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Todo List</h2>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <div>
                        <InputLabel for="newTodo" value="New Item"/>

                        <TextInput
                            id="newTodo"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="newTodo"
                            autofocus
                            @keyup.enter="addTodo"
                        />
                        <p class="block font-medium text-sm text-gray-700">Type the todo and press enter</p>

                    </div>

                    <p class="text-sm/6 font-semibold text-gray-900 mt-6">List Itens</p>
                    <ul role="list" class="divide-y divide-gray-100 mt-1">
                        <li class="flex justify-between gap-x-6 py-5" v-for="todo in todos" :key="todo.id">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <Checkbox :checked="todo.done" v-model="todo.done" @change="updateTodo(todo)" />
                                    <span :class="{ 'ml-2': true, done: todo.done }">{{ todo.text }}</span>
                                </div>
                                <DangerButton class="self-end" @click="removeTodo(todo.id)">Delete</DangerButton>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>



<style>
.done {
    text-decoration: line-through;
}
</style>
