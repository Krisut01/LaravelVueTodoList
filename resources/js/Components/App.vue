<template>
  <div class="todo-container">
    <div class="todo-header">
      <h1>My To-Do List</h1>
    </div>

    <!-- Display To-Do List -->
    <ul class="todo-list">
      <li v-for="todo in todos" :key="todo.id" class="todo-item">
        <span>{{ todo.name }}</span>
        <!-- Edit and Delete buttons -->
        <div class="todo-actions">
          <button @click="editTodo(todo)" class="edit-btn">Edit</button>
          <button @click="deleteTodo(todo.id)" class="delete-btn">Delete</button>
        </div>
      </li>
    </ul>

    <!-- Form to Add or Edit a To-Do -->
    <form @submit.prevent="addTodo" class="todo-form">
      <input
        v-model="newTodo"
        :placeholder="isEdit ? 'Edit task' : 'New task'"
        class="todo-input"
      />
      <button type="submit" class="submit-btn">
        {{ isEdit ? 'Update' : 'Add' }}
      </button>
    </form>

    
  </div>
  
  
</template>

<script>
import axios from 'axios'; // Import axios for API requests
import '../../css/TodoList.css'; // Going two levels up to reach 'resources/css'

export default {
  data() {
    return {
      newTodo: '',    // New to-do input
      todos: [],      // Array of to-do items
      isEdit: false,  // Flag to check if editing
      currentTodoId: null // Store the current todo ID when editing
    };
  },
  created() {
    this.fetchTodos();  // Fetch to-dos when component is created
  },
  methods: {
    // Fetch all to-do items from the backend
    async fetchTodos() {
      const response = await axios.get('/api/todos');
      this.todos = response.data;  // Store the to-do items in the 'todos' array
    },

    // Add or update a to-do
    async addTodo() {
      if (this.isEdit) {
        // Update the to-do
        await axios.put(`/api/todos/${this.currentTodoId}`, { name: this.newTodo });
        this.isEdit = false;  // Reset to Add mode
      } else {
        // Add a new to-do
        if (this.newTodo) {
          await axios.post('/api/todos', { name: this.newTodo });
        }
      }

      this.newTodo = '';  // Clear the input field
      this.fetchTodos();  // Fetch updated to-do list
    },

    // Set up for editing an existing to-do
    editTodo(todo) {
      this.newTodo = todo.name;
      this.isEdit = true;
      this.currentTodoId = todo.id;
    },

    // Delete a to-do item
    async deleteTodo(todoId) {
      await axios.delete(`/api/todos/${todoId}`);
      this.fetchTodos();  // Fetch updated to-do list after deletion
    }
  }
};
</script>
