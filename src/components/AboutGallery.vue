<template>
  <div class="gallery-container">
    <h1>Наші Художники</h1>
    <div v-if="artists.length" class="artists-grid">
      <div v-for="artist in artists" :key="artist.id" class="artist" @click="goToArtistDetail(artist.id)">
        <img :src="artist.image" :alt="artist.name">
        <div class="artist-info">
          <h2>{{ artist.name }}</h2>
          <p>{{ artist.bday }}  {{ artist.country }}</p>
        </div>
      </div>
    </div>
    <div v-else>
      <p>Немає художників для відображення.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AboutGallery',
  data() {
    return {
      artists: []
    };
  },
  created() {
    this.fetchArtists();
  },
  methods: {
    fetchArtists() {
      fetch('http://localhost/artgallery/php/get_artists.php')
        .then(response => response.json())
        .then(data => {
          console.log('Fetched data:', data);
          this.artists = data;
        })
        .catch(error => {
          console.error('Error fetching artists:', error);
        });
    },
    goToArtistDetail(id) {
      this.$router.push({ name: 'ArtistDetail', params: { id } });
    }
  }
}
</script>

<style>
.gallery-container {
  padding: 15px;
  background-color: #111;
  min-height: 100vh;
}

.artists-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  padding: 20px;
}

.artist {
  background: #222;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.artist:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.artist img {
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
</style>
