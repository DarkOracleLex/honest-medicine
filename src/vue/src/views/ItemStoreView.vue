<script setup>
</script>

<template>
  <main>
    <h1>Item store:</h1>
    <form @submit.prevent="createItem">
      <div style="color: green" v-if="this.successMessage">{{ this.successMessage }}</div>
      <div style="color: red" v-if="this.errorMessage">{{ this.errorMessage }}</div>
      <div>
        <label for="userId">Name:</label>
        <input type="text" id="name" v-model="itemData.name">
      </div>
      <div>
        <label for="title">Key: </label>
        <input type="text" id="key" v-model="itemData.key">
      </div>
      <button>Create Item</button>
    </form>
  </main>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      itemData: {
        name: '',
        key: ''
      },
      errorMessage: null,
      successMessage: null
    }
  },
  methods: {
    createItem() {
      this.errorMessage = null;
      this.successMessage = null;

      axios.post(`${import.meta.env.VITE_BASE_URL}/item`, this.itemData, {
        headers: {
          'authorization': `Bearer ${import.meta.env.VITE_TOKEN}`
        }
      })
          .then((response) => {
            this.successMessage = 'Item created';
            console.log(response);
          })
          .catch(error => {
            console.log(error.response.data);
            this.errorMessage = error.response.data.message;
          });
    }
  }
}
</script>
