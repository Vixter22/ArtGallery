<template>
  <div class="gallery-container">
    <h1>Наші Художники</h1>
    <div v-if="error" class="error">{{ error }}</div>
    <div v-else>
      <div v-if="artists.length" class="paintings-grid">
        <div v-for="artist in artists" :key="artist.name" class="artist-card" @click="goToArtistDetail(artist.id)">
          <img v-if="artist.image" :src="artist.image" :alt="artist.name" class="artist-image">
          <div class="artist-info">
            <h2>{{ artist.name }}</h2>
            <p><strong>Дата народження:</strong> {{ artist.bday }}</p>
            <p><strong>Країна:</strong> {{ artist.country }}</p>
          </div>
        </div>
      </div>
      <div v-else>
        <p>Немає художників.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AboutGallery',
  data() {
    return {
      artists: [],
      error: null
    };
  },
  created() {
    this.fetchArtists();
  },
  methods: {
    async fetchArtists() {
      try {
        const response = await fetch('http://localhost/artgallery/php/get_artists.php');
        const data = await response.json();
        if (response.ok) {
          this.artists = data;
        } else {
          this.error = data.error || 'Помилка завантаження даних';
        }
      } catch (error) {
        this.error = 'Помилка завантаження даних: ' + error.message;
      }
    },
    goToArtistDetail(id) {
      this.$router.push({ name: 'ArtistDetail', params: { id } });
    }
  }
}
</script>

<style scoped>
.gallery-container {
  padding: 20px;
  background-color: #111;
  min-height: 100vh;
}

h1 {
  text-align: center;
  margin-bottom: 40px;
  color: #ffffff;
}

.paintings-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  padding: 20px;
}

.artist-card {
  background: #222;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
}

.artist-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.artist-image {
  width: 100%;
  height: 300px;
  object-fit: cover;
}

.artist-info {
  padding: 20px;
  text-align: center;
}

.artist-info h2 {
  margin: 10px 0;
  font-size: 1.5rem;
  color: #ffffff;
}

.artist-info p {
  margin: 5px 0;
  color: #aaa;
}

.error {
  color: red;
  text-align: center;
}
</style>
