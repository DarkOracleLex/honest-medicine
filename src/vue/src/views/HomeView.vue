<script setup>
</script>

<template>
  <main>
    <h1>Changes:</h1>
    <div>
      <div style="border: 1px solid white; padding: 5px 10px; margin: 10px 0" v-for="item in changes">
        <div>
          Модель: {{ item.model }}
        </div>
        <div>
          Событие: {{ item.event_type }}
        </div>
        <div v-if="item.changes">
          Изменения: {{ item.changes }}
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      changes: [],
    };
  },
  mounted() {
    axios.get(`${import.meta.env.VITE_BASE_URL}/change`, {
      headers: {
        'authorization': `Bearer ${import.meta.env.VITE_TOKEN}`
      }
    })
        .then((response) => {
          console.log(response.data.data)
          this.changes = response.data.data
        })
        .catch(error => console.log(error));
  }
}
</script>
