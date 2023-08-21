<script setup>
</script>

<template>
  <main>
    <h1>Items:</h1>
    <div>
      <a v-bind:href="'/item/' + item.id" v-for="item in items"
         style="display:block; border: 1px solid white; padding: 5px 10px; margin: 10px 0">
        <div>
          Id: {{ item.id }}
        </div>
        <div>
          Имя: {{ item.name }}
        </div>
        <div>
          Ключ: {{ item.key }}
        </div>
        <div>
          Создано: {{ item.created_at }}
        </div>
      </a>
    </div>
  </main>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    axios.get(`${import.meta.env.VITE_BASE_URL}/item`, {
      headers: {
        'authorization': `Bearer ${import.meta.env.VITE_TOKEN}`
      }
    })
        .then((response) => {
          console.log(response.data.data)
          this.items = response.data.data
        })
        .catch(error => console.log(error));
  }
}
</script>
