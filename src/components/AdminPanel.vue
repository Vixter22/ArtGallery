<template>
  <div>
    <h1>Адмін панель</h1>
    <ul>
      <li v-for="painting in paintings" :key="painting.id">
        {{ painting.id }} - {{ painting.title }} - {{ painting.category }} - {{ painting.artist }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdminPanel',
  data() {
    return {
      paintings: []
    };
  },
  created() {
    this.fetchPaintings();
  },
  methods: {
    fetchPaintings() {
      axios.get('http://localhost/artgallery/php/fetch_paintings.php') 
        .then(response => {
          this.paintings = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the paintings!", error);
        });
    }
  }
};
</script>

<style scoped>

</style>
