<template>
  <div class="admin-panel">
    <h1 class="h11">Адмін панель</h1>
    <div class="tables-container">
      <div class="table-wrapper">
        <h2>Таблиця з картинами</h2>
        <table class="paintings-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Назва картини</th>
              <th>Категорія</th>
              <th>Художник</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="painting in paintings" :key="painting.id">
              <td>{{ painting.id }}</td>
              <td>{{ painting.title }}</td>
              <td>{{ painting.category }}</td>
              <td>{{ painting.artist }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="form-container">
      <h2>Додати нову картину</h2>
      <form @submit.prevent="addPainting">
        <label for="title">Назва картини:</label>
        <input type="text" v-model="newPainting.title" required />

        <label for="category">Категорія:</label>
        <input type="number" v-model="newPainting.category" required />

        <label for="artist">Художник:</label>
        <input type="number" v-model="newPainting.artist" required />

        <label for="image">URL зображення:</label>
        <input type="text" v-model="newPainting.image" required />

        <label for="description">Опис:</label>
        <textarea v-model="newPainting.description" required></textarea>

        <button type="submit">Додати картину</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdminPanel',
  data() {
    return {
      paintings: [],
      newPainting: {
        title: '',
        category: '',
        artist: '',
        image: '',
        description: ''
      }
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
    },
    addPainting() {
      axios.post('http://localhost/artgallery/php/fetch_paintings.php', this.newPainting)
        .then(response => {
          if (response.data.success) {
            this.fetchPaintings();
            this.newPainting = {
              title: '',
              category: '',
              artist: '',
              image: '',
              description: ''
            };
          } else {
            alert(response.data.error || 'Failed to add painting');
          }
        })
        .catch(error => {
          console.error("There was an error adding the painting!", error);
        });
    }
  }
};
</script>

<style scoped>
.h11 {
  padding-left: 500px;
}
.admin-panel {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  padding-left: 50px;
}

.tables-container {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.table-wrapper {
  width: 45%;
}

.paintings-table {
  width: 100%;
  border-collapse: collapse;
  background-color: #FFA500;
  color: #FFFFFF;
}

th, td {
  border: 1px solid #ff6a06;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #ff6a06;
  color: #FFFFFF;
}

tr:nth-child(even) {
  background-color: #FFA500;
}

tr:nth-child(odd) {
  background-color: #FF8C00;
}

.form-container {
  margin-top: 20px;
}

label {
  display: block;
  margin: 10px 0 5px;
}

input, textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  background-color: #ff6a06;
  color: #FFFFFF;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #e55d00;
}
</style>
