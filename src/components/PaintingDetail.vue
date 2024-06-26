<template>
  <div class="painting-detail-container">
    <div v-if="painting" class="painting-content">
      <img :src="painting.image" :alt="painting.title" class="painting-image" @click="openModal">
      <div class="painting-info">
        <h1>{{ painting.title }}</h1>
        <p class="actor">
          <b>Автор: </b>
          <span @click="goToArtistDetail(painting.artist_id)" style="cursor: pointer; color: #aaa; text-decoration: underline;">
            {{ painting.artist }}
          </span>
        </p>
        <p class="description">{{ painting.description }}</p>
      </div>
    </div>
    <div v-else>
      <p>Завантаження даних...</p>
    </div>

    <div v-if="isModalOpen" class="modal" @click="closeModal">
      <span class="close" @click="closeModal">&times;</span>
      <img class="modal-content" :src="painting.image" alt="Full Image">
      <div class="caption">{{ painting.title }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaintingDetail',
  data() {
    return {
      painting: null,
      isModalOpen: false,
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
    },
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    goToArtistDetail(artistId) {
      this.$router.push({ name: 'ArtistDetail', params: { id: artistId } });
    }
  }
}
</script>

<style>
.painting-detail-container {
  display: flex;
  justify-content: left;
  padding: 60px;
  box-sizing: border-box;
}

.painting-content {
  max-width: 1200px;
  width: 100%;
}

.painting-image {
  float: left;
  margin: 0 20px 20px 0;
  width: 500px;
  height: 400px;
  object-fit: cover;
  border: 1px solid #ff6600;
  border-radius: 4px;
  cursor: pointer;
}

.painting-info h1 {
  font-size: 2.5rem;
  margin: 0 0 20px;
  color: #ffffff;
}

.actor {
  font-size: 1.1rem;
  line-height: 1.6;
  color: #aaa;
  margin: 10px 0;
  word-break: break-word;
  text-align: center;
}

.actor span {
  cursor: pointer;
  color: #aaa;
  text-decoration: underline;
}

.description {
  font-size: 1.1rem;
  line-height: 1.6;
  color: #aaa;
  margin: 10px 0;
  word-break: break-word;
  text-align: justify;
}

.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
  margin: 60px auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

.caption {
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

@media (max-width: 768px) {
  .painting-detail-container {
    padding: 20px;
  }

  .painting-content {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .painting-image {
    float: none;
    margin: 0 0 20px 0;
    width: 100%;
    height: auto;
  }

  .painting-info {
    text-align: center;
  }
}
</style>
