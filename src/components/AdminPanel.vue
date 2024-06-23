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
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdminPanel',
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
      axios.get('http://localhost/artgallery/php/fetch_paintings.php') 
        .then(response => {
          this.paintings = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the paintings!", error);
        });
    }
  }
};
</script>

<style scoped>
.h11{
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

</style>
