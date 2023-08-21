<script setup xmlns="http://www.w3.org/1999/html">
</script>

<template>
  <main>
    <h1>Item show:</h1>
    <div>
      <div style="border: 1px solid white; padding: 5px 10px; margin: 10px 0">
        <div>
          Id: {{ itemData.id }}
        </div>
        <div>
          Имя: {{ itemData.name }}
        </div>
        <div>
          Ключ: {{ itemData.key }}
        </div>
        <div>
          Создано: {{ itemData.created_at }}
        </div>
      </div>
    </div>
    <form @submit.prevent="updateItem">
      <div style="color: green" v-if="this.successMessage">{{ this.successMessage }}</div>
      <div style="color: red" v-if="this.errorMessage">{{ this.errorMessage }}</div>
      <div>
        <label for="userId">Name:</label>
        <input type="text" id="name" v-model="itemUpdateData.name">
      </div>
      <div>
        <label for="title">Key: </label>
        <input type="text" id="key" v-model="itemUpdateData.key">
      </div>
      <button>Update Item</button>
    </form>
    <form @submit.prevent="deleteItem">
      <div style="color: green" v-if="this.successMessage">{{ this.successMessage }}</div>
      <div style="color: red" v-if="this.errorMessage">{{ this.errorMessage }}</div>
      <button>Delete Item</button>
    </form>

  </main>
</template>

<script>
import axios from 'axios'
import {useRoute} from "vue-router";
import {computed} from "vue";

export default {
  data() {
    const route = useRoute();

    return {
      itemId: computed(() => route.params.id).value,
      itemData: {
        name: null,
        key: null
      },
      itemUpdateData: {
        name: null,
        key: null
      },
      errorMessage: null,
      successMessage: null
    }
  },
  mounted() {
    this.errorMessage = null;
    this.successMessage = null;

    console.log(this.itemId);

    axios.get(`${import.meta.env.VITE_BASE_URL}/item/${this.itemId}`, {
      headers: {
        'authorization': `Bearer ${import.meta.env.VITE_TOKEN}`
      }
    })
        .then((response) => {
          console.log(response.data.data)
          this.itemData = response.data.data;
        })
        .catch(error => {
          console.log(error);
          this.errorMessage = error.response.data.message;
        });
  },
  methods: {
    updateItem() {
      this.errorMessage = null;
      this.successMessage = null;

      axios.put(`${import.meta.env.VITE_BASE_URL}/item/${this.itemId}`, this.itemUpdateData, {
        headers: {
          'authorization': `Bearer ${import.meta.env.VITE_TOKEN}`
        }
      })
          .then((response) => {
            this.successMessage = 'Item updated';
            console.log(response);
            this.itemData = response.data.data;
          })
          .catch(error => {
            console.log(error.response.data);
            this.errorMessage = error.response.data.message;
          });
    },
    deleteItem() {
      this.errorMessage = null;
      this.successMessage = null;

      axios.delete(`${import.meta.env.VITE_BASE_URL}/item/${this.itemId}`, {
        headers: {
          'authorization': `Bearer ${import.meta.env.VITE_TOKEN}`
        }
      })
          .then((response) => {
            this.successMessage = 'Item deleted';
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
