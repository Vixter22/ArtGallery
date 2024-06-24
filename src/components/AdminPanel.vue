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
              <th>Назва картини</th>
              <th>Категорія</th>
              <th>Художник</th>
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
      newPainting: {
        title: '',
        category: '',
        artist: '',
        image: '',
        description: ''
      },
      errorMessage: '',
      successMessage: '',
      sortAscending: true // Відстеження напрямку сортування
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

      axios.post('http://localhost/artgallery/php/fetch_paintings.php', newPainting)
        .then(response => {
          if (response.data.message === "Картину успішно додано") {
            this.fetchPaintings(); // Оновлення списку картин після успішного додавання
            this.errorMessage = '';
            this.successMessage = "Картину успішно додано";
            this.newPainting = {
              title: '',
              category: '',
              artist: '',
              image: '',
              description: ''
            };
            // Виклик alert з повідомленням
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
            this.fetchPaintings(); // Оновлення списку картин після успішного видалення
            this.successMessage = "Картину успішно видалено";
            // Виклик alert з повідомленням
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
        if (this.sortAscending) {
          return a.id - b.id;
        } else {
          return b.id - a.id;
        }
      });
      this.sortAscending = !this.sortAscending; // Зміна напрямку сортування
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
  cursor: pointer; /* Вказівник курсора для заголовків стовпців */
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
