import { defineStore } from 'pinia'

export const useTodoStore = defineStore('todo', {
    state: () => ({
        todos: []
    }),
    actions: {
        addTodo(todo) {
            const existingTodo = this.todos.find(t => t.text === todo.text);
            if (existingTodo) {
                alert(`Todo item "${todo.text}" already exists`);
            } else {
                this.todos.push(todo);
            }
        },
        removeTodo(id) {
            this.todos = this.todos.filter(todo => todo.id !== id)
        },
        updateTodo(todo) {
            // update the todo in the store
            const index = this.todos.findIndex(t => t.id === todo.id)
            if (index !== -1) {
                this.todos.splice(index, 1, todo)
            }
        }
    },
    mutations: {
        updateTodo(state, todo) {
            const index = state.todos.findIndex(t => t.id === todo.id)
            if (index !== -1) {
                state.todos.splice(index, 1, { ...state.todos[index], done: todo.done })
            }
        }
    },
    getters: {
        getTodos: state => state.todos,
        getTodoById: state => id => state.todos.find(todo => todo.id === id)
    }
})
