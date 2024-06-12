<template>
    <div class="painting-detail-container">
      <div v-if="painting">
        <img :src="painting.image" :alt="painting.title">
        <div class="painting-info">
          <h2>{{ painting.title }}</h2>
          <p>Автор: {{ painting.artist }}</p>
          <p>{{ painting.description }}</p>
        </div>
      </div>
      <div v-else>
        <p>Завантаження даних...</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'PaintingDetail',
    data() {
      return {
        painting: null
      };
    },
    created() {
      this.fetchPaintingDetail();
    },
    methods: {
      fetchPaintingDetail() {
        const id = this.$route.params.id;
        fetch(`http://localhost/artgallery/php/get_paintings.php?id=${id}`)
          .then(response => response.json())
          .then(data => {
            this.painting = data;
          })
          .catch(error => {
            console.error('Error fetching painting detail:', error);
          });
      }
    }
  }
  </script>
  
  <style>
  .painting-detail-container {
    padding: 20px;
    background-color: #111;
    min-height: 100vh;
    color: #fff;
  }
  
  .painting-detail-container img {
    width: 100%;
    height: auto;
    max-width: 600px;
    display: block;
    margin: 0 auto 20px;
  }
  
  .painting-info {
    text-align: center;
  }
  
  .painting-info h2 {
    margin: 10px 0;
    font-size: 2rem;
    color: #ffffff;
  }
  
  .painting-info p {
    margin: 5px 0;
    color: #aaa;
  }
  </style>
  