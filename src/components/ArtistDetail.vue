<template>
  <div class="artist-detail-container">
    <div v-if="artist" class="artist-content">
      <img :src="artist.image" :alt="artist.name" class="artist-image">
      <div class="artist-info">
        <h1>{{ artist.name }}</h1>
        <p class="bday"><b>Дата народження: </b>{{ artist.bday }}</p>
        <p class="country"><b>Країна: </b>{{ artist.country }}</p>
        <p class="biography"><b>Біографія: </b>{{ artist.biography }}</p>
        <div class="paintings-list">
          <h2>Список картин художника:</h2>
          <ul>
            <li v-for="painting in artist.paintings" :key="painting.id">
              <router-link :to="{ name: 'PaintingDetail', params: { id: painting.id } }">{{ painting.title }}</router-link>
            </li>
          </ul>
        </div>
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
  padding: 60px;
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

.biography {
  text-align: justify;
}

.paintings-list {
  margin-top: 20px;
}

.paintings-list h2 {
  font-size: 1.5rem;
  color: #ffffff;
}

.paintings-list ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0;
}

.paintings-list li {
  margin: 5px;
  width: calc(33.333% - 10px);
  text-align: center;
}

.paintings-list li a {
  color: #aaa;
  text-decoration: underline;
  font-weight: bold;
  font-size: 1.2rem;
}

.paintings-list li a:hover {
  text-decoration: none;
}

@media (max-width: 768px) {
  .artist-detail-container {
    flex-direction: column;
    padding: 20px;
  }

  .artist-content {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .artist-image {
    float: none;
    margin: 0 0 20px 0;
    width: 100%;
    height: auto;
  }

  .artist-info {
    text-align: center;
  }

  .paintings-list ul {
    flex-direction: column;
    align-items: center;
  }

  .paintings-list li {
    width: 100%;
    margin: 10px 0;
  }
}
</style>
