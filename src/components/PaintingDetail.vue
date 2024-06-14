<template>
  <div class="painting-detail-container">
    <div v-if="painting" class="painting-content">
      <div class="painting-image-container">
        <img :src="painting.image" :alt="painting.title" class="painting-image">
      </div>
      <div class="painting-info">
        <h1>{{ painting.title }}</h1>
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
  display: flex;
  justify-content: center;
  padding: 20px;
  box-sizing: border-box;
}

.painting-content {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  max-width: 1200px;
  width: 100%;
  flex-wrap: wrap;
}

.painting-image-container {
  flex: 0 0 auto;
  margin-right: 20px;
  max-width: 500px;
}

.painting-image {
  width: 100%;
  height: auto;
  object-fit: cover;
  border: 1px solid #ff6600;
  border-radius: 4px;
}

.painting-info {
  flex: 1;
  min-width: 300px;
}

.painting-info h1 {
  font-size: 2.5rem;
  margin: 0 0 20px;
  color: #ffffff;
}

.painting-info p {
  font-size: 1.1rem;
  line-height: 1.6;
  color: #aaa;
  margin: 10px 0;
  word-break: break-word;
}

.painting-info p strong {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}
</style>
