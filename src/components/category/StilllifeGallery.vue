<template>
  <div class="gallery-container">
    <h1 id="Land">Натюрморт</h1>
    <div v-if="paintings.length" class="paintings-grid">
      <div v-for="painting in paintings" :key="painting.id" class="painting" @click="goToPaintingDetail(painting.id)">
        <img :src="painting.image" :alt="painting.title">
        <div class="painting-info">
          <h2>{{ painting.title }}</h2>
          <p>Автор: {{ painting.artist }}</p>
          <p>{{ painting.description }}</p>
        </div>
      </div>
    </div>
    <div v-else>
      <p>Немає картин в цій категорії.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StilllifeGallery',
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
      fetch('http://localhost/artgallery/php/get_paintings.php?category=Натюрморт')
        .then(response => response.json())
        .then(data => {
          console.log('Fetched data:', data);
          this.paintings = data;
        })
        .catch(error => {
          console.error('Error fetching paintings:', error);
        });
    },
    goToPaintingDetail(id) {
      this.$router.push({ name: 'PaintingDetail', params: { id } });
    }
  }
}
</script>

<style>
.gallery-container {
  padding: 20px;
  background-color: #111;
  min-height: 100vh;
}

#Lend {
  text-align: center;
  margin-bottom: 40px;
  color: #343a40;
}

.paintings-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  padding: 20px;
}

.painting {
  background: #222;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.painting:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.painting img {
  width: 100%;
  height: 300px;
  object-fit: cover;
}

.painting-info {
  padding: 20px;
  text-align: center;
}

.painting-info h2 {
  margin: 10px 0;
  font-size: 1.5rem;
  color: #ffffff;
}

.painting-info p {
  margin: 5px 0;
  color: #aaa;
}
</style>
