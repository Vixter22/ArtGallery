<template>
  <div class="artist-detail-container">
    <div v-if="artist" class="artist-content">
      <img :src="artist.image" :alt="artist.name" class="artist-image">
      <div class="artist-info">
        <h1>{{ artist.name }}</h1>
        <p class="bday"><b>Дата народження: </b>{{ artist.bday }}</p>
        <p class="country"><b>Країна: </b>{{ artist.country }}</p>
        <p class="biography"><b>Біографія: </b>{{ artist.biography }}</p>
      </div>
    </div>
    <div v-else>
      <p>Завантаження даних...</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ArtistDetail',
  data() {
    return {
      artist: null,
    };
  },
  created() {
    this.fetchArtistDetail();
  },
  methods: {
    fetchArtistDetail() {
      const id = this.$route.params.id;
      fetch(`http://localhost/artgallery/php/get_artists.php?id=${id}`)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          this.artist = data;
        })
        .catch(error => {
          console.error('Error fetching artist detail:', error);
        });
    }
  }
}
</script>

<style>
.artist-detail-container {
  display: flex;
  justify-content: left;
  padding: 50px;
  box-sizing: border-box;
}

.artist-content {
  max-width: 1200px;
  width: 100%;
}

.artist-image {
  float: left;
  margin: 0 20px 20px 0;
  width: 500px; 
  height: 400px; 
  object-fit: cover;
  border: 1px solid #ff6600;
  border-radius: 4px;
}

.artist-info h1 {
  font-size: 2.5rem;
  margin: 0 0 20px;
  color: #ffffff;
}

.bday, .country, .biography {
  font-size: 1.1rem;
  line-height: 1.6;
  color: #aaa;
  margin: 10px 0;
}
</style>
