<template>
  <div class="admin-panel">
    <h1 class="h11">Адмін панель</h1>
    <div class="tables-container">
      <div class="table-wrapper">
        <h2>Таблиця з картинами</h2>
        <table class="paintings-table">
          <thead>
            <tr>
              <th @click="sortById">ID</th>
              <th @click="sortByTitle">Назва картини</th>
              <th @click="sortByCategory">Категорія</th>
              <th @click="sortByArtist">Художник</th>
              <th>Дії</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="painting in paintings" :key="painting.id">
              <td>{{ painting.id }}</td>
              <td>{{ painting.title }}</td>
              <td>{{ painting.category }}</td>
              <td>{{ painting.artist }}</td>
              <td><button @click="deletePainting(painting.id)">Видалити</button></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="right-tables">
        <div class="table-wrapper artists-table-wrapper">
          <h2 class="tab_h2">Таблиця з художниками</h2>
          <table class="artists-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Ім'я</th>
                <th>Дата народження</th>
                <th>Країна</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="artist in artists" :key="artist.id">
                <td>{{ artist.id }}</td>
                <td>{{ artist.name }}</td>
                <td>{{ artist.bday }}</td>
                <td>{{ artist.country }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="table-wrapper categories-table-wrapper">
          <h2 class="tab_h2">Таблиця з категоріями</h2>
          <table class="categories-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Опис</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="category in categories" :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.description }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="form-container">
      <h2>Додати нову картину</h2>
      <form @submit.prevent="addPainting">
        <label for="title">Назва картини:</label>
        <input type="text" v-model="newPainting.title" required />

        <label for="category">Категорія:</label>
        <input type="number" v-model="newPainting.category" min="1" max="5" required />

        <label for="artist">Художник:</label>
        <input type="number" v-model="newPainting.artist" min="1" max="5" required />

        <label for="image">URL зображення:</label>
        <input type="text" v-model="newPainting.image" required />

        <label for="description">Опис:</label>
        <textarea v-model="newPainting.description" required></textarea>

        <button type="submit">Додати картину</button>
        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
        <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
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
      artists: [],
      categories: [],
      newPainting: {
        title: '',
        category: '',
        artist: '',
        image: '',
        description: ''
      },
      errorMessage: '',
      successMessage: '',
      sortAscending: true,
      sortTitleAscending: true,
      sortCategoryAscending: true,
      sortArtistAscending: true
    };
  },
  created() {
    this.fetchPaintings();
    this.fetchArtists();
    this.fetchCategories();
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
    fetchArtists() {
      axios.get('http://localhost/artgallery/php/fetch_artists.php')
        .then(response => {
          this.artists = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the artists!", error);
        });
    },
    fetchCategories() {
      axios.get('http://localhost/artgallery/php/fetch_categories.php')
        .then(response => {
          this.categories = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the categories!", error);
        });
    },
    addPainting() {
      const newPainting = {
        title: this.newPainting.title,
        category: this.newPainting.category,
        artist: this.newPainting.artist,
        image: this.newPainting.image,
        description: this.newPainting.description
      };

      const requiredFields = ['title', 'category', 'artist', 'image', 'description'];
      for (const field of requiredFields) {
        if (!newPainting[field]) {
          this.errorMessage = `Missing field: ${field}`;
          return;
        }
      }

      if (newPainting.category < 1 || newPainting.category > 5) {
        this.errorMessage = "Категорія повинна бути числом від 1 до 5";
        return;
      }

      if (newPainting.artist < 1 || newPainting.artist > 5) {
        this.errorMessage = "Художник повинен бути числом від 1 до 5";
        return;
      }

      axios.post('http://localhost/artgallery/php/fetch_paintings.php', newPainting)
        .then(response => {
          if (response.data.message === "Картину успішно додано") {
            this.fetchPaintings();
            this.errorMessage = '';
            this.successMessage = "Картину успішно додано";
            this.newPainting = {
              title: '',
              category: '',
              artist: '',
              image: '',
              description: ''
            };
            alert(this.successMessage);
          } else {
            this.errorMessage = response.data.message || "Помилка при додаванні картини";
          }
        })
        .catch(error => {
          console.error("There was an error adding the painting!", error);
          this.errorMessage = "Помилка при додаванні картини";
        });
    },
    deletePainting(paintingId) {
      axios.post('http://localhost/artgallery/php/fetch_paintings.php', { id: paintingId, _method: 'DELETE' })
        .then(response => {
          if (response.data.message === "Картину успішно видалено") {
            this.fetchPaintings();
            this.successMessage = "Картину успішно видалено";
            alert(this.successMessage);
          } else {
            this.errorMessage = response.data.message || "Помилка при видаленні картини";
          }
        })
        .catch(error => {
          console.error("There was an error deleting the painting!", error);
          this.errorMessage = "Помилка при видаленні картини";
        });
    },
    sortById() {
      this.paintings.sort((a, b) => {
        return this.sortAscending ? a.id - b.id : b.id - a.id;
      });
      this.sortAscending = !this.sortAscending;
    },
    sortByTitle() {
      this.paintings.sort((a, b) => {
        const titleA = a.title.toLowerCase();
        const titleB = b.title.toLowerCase();
        if (this.sortTitleAscending) {
          if (titleA < titleB) return -1;
          if (titleA > titleB) return 1;
          return 0;
        } else {
          if (titleA > titleB) return -1;
          if (titleA < titleB) return 1;
          return 0;
        }
      });
      this.sortTitleAscending = !this.sortTitleAscending;
    },
    sortByCategory() {
      this.paintings.sort((a, b) => {
        const categoryA = a.category.toLowerCase();
        const categoryB = b.category.toLowerCase();
        if (this.sortCategoryAscending) {
          if (categoryA < categoryB) return -1;
          if (categoryA > categoryB) return 1;
          return 0;
        } else {
          if (categoryA > categoryB) return -1;
          if (categoryA < categoryB) return 1;
          return 0;
        }
      });
      this.sortCategoryAscending = !this.sortCategoryAscending;
    },
    sortByArtist() {
      this.paintings.sort((a, b) => {
        const artistA = a.artist.toLowerCase();
        const artistB = b.artist.toLowerCase();
        if (this.sortArtistAscending) {
          if (artistA < artistB) return -1;
          if (artistA > artistB) return 1;
          return 0;
        } else {
          if (artistA > artistB) return -1;
          if (artistA < artistB) return 1;
          return 0;
        }
      });
      this.sortArtistAscending = !this.sortArtistAscending;
    }
  }
};
</script>

<style scoped>

.tab_h2{
  width: 540px;
}

.h11 {
  padding-left: 500px;
}
.admin-panel {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  padding: 0 50px;
}

.tables-container {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.table-wrapper {
  width: 45%;
}

.right-tables {
  width: 540px;
}

.artists-table-wrapper, .categories-table-wrapper {
  margin-top: 20px;
  padding-bottom: 50px;
}

.paintings-table {
  width: 540px;
  border-collapse: collapse;
  background-color: #FFA500;
  color: #FFFFFF;
}

.artists-table {
  width: 540px;
  border-collapse: collapse;
  background-color: #1E90FF;
  color: #FFFFFF;
}

.categories-table {
  width: 540px;
  border-collapse: collapse;
  background-color: #32CD32;
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
  cursor: pointer; 
}

tr:nth-child(even) {
  background-color: #FFA500;
}

tr:nth-child(odd) {
  background-color: #FF8C00;
}

.artists-table th, .artists-table td {
  border: 1px solid #466db4;
}

.artists-table th {
  background-color: #466db4;
  color: #FFFFFF;
}

.artists-table tr:nth-child(even) {
  background-color: #4682B4;
}

.artists-table tr:nth-child(odd) {
  background-color: #1E90FF;
}

.categories-table th, .categories-table td {
  border: 1px solid #1f831f; 
}

.categories-table th {
  background-color: #1f831f; 
  color: #FFFFFF;
}

.categories-table tr:nth-child(even) {
  background-color: #228B22; 
}

.categories-table tr:nth-child(odd) {
  background-color: #32CD32; 
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
  border: 1px solid #ff6a06;
  border-radius: 4px;
  background-color: #000000;
  color: #ff6a06; 
}

input:focus, textarea:focus {
  border-color: #FFFFFF;
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

.error-message {
  color: red;
  margin-top: 10px;
}

.success-message {
  color: green;
  margin-top: 10px;
}
</style>
