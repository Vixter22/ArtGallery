<template>
  <div class="gallery-container">
    <div class="header-container">
      <h1>Наші Художники</h1>
      <div class="search-container">
        <input type="text" v-model="searchQuery" @input="searchArtists" placeholder="Пошук художників">
        <ul class="search-results" v-if="searchResults.length">
          <li v-for="artist in searchResults" :key="artist.id">
            <router-link :to="{ name: 'ArtistDetail', params: { id: artist.id } }">{{ artist.name }}</router-link>
          </li>
        </ul>
      </div>
    </div>
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
      artists: [],
      searchQuery: '',
      searchResults: []
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
          this.artists = data;
        })
        .catch(error => {
          console.error('Error fetching artists:', error);
        });
    },
    searchArtists() {
      if (this.searchQuery.length > 2) {
        fetch(`http://localhost/artgallery/php/search_artists.php?query=${this.searchQuery}`)
          .then(response => response.json())
          .then(data => {
            this.searchResults = data;
          })
          .catch(error => {
            console.error('Error fetching search results:', error);
          });
      } else {
        this.searchResults = [];
      }
    },
    goToArtistDetail(id) {
      this.$router.push({ name: 'ArtistDetail', params: { id } });
    }
  }
}
</script>

<style>
body {
  background-color: #111; 
  color: #fff; 
  margin: 0;
  font-family: Arial, sans-serif;
}

.gallery-container {
  padding: 15px;
  background-color: #111;
  min-height: 100vh;
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-left: 500px;
  padding-right: 55px;
}

.search-container {
  position: relative;
  width: 190px; 
}

.search-container input {
  width: 100%;
  padding: 0.5rem 1rem; 
  background-color: #000; 
  color: #ff6600; 
  border: 2px solid #ff6600; 
  border-radius: 5px;
  font-size: 1rem;
}

.search-container input::placeholder {
  color: #aaa; 
}

.search-container input:focus {
  outline: none; 
  border-color: #ff6600; 
}

.search-results {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  background: #222;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  list-style: none;
  padding: 0;
  margin: 0.5rem 0 0;
  max-height: 300px;
  overflow-y: auto;
  z-index: 10;
}

.search-results li {
  margin: 0;
}

.search-results li a {
  color: #ff6600;
  text-decoration: none;
  display: block;
  padding: 0.5rem;
}

.search-results li a:hover {
  text-decoration: underline;
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
