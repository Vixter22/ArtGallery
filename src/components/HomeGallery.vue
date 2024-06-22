<template>
  <div class="home-gallery">
    <div class="categories-container">
      <div class="header-with-search">
        <h1 class="category_h1">Категорії картин</h1>
        <div class="search-box">
          <input type="text" v-model="searchQuery" @input="searchPaintings" placeholder="Пошук картин за назвою">
          <ul class="search-results" v-if="searchResults.length">
            <li v-for="painting in searchResults" :key="painting.id">
              <router-link :to="{ name: 'PaintingDetail', params: { id: painting.id } }">{{ painting.title }}</router-link>
            </li>
          </ul>
        </div>
      </div>
      <div class="categories">
        <div class="category-item" v-for="category in categories" :key="category.name">
          <router-link :to="category.link">
            <img :src="category.image" :alt="category.name">
            <div class="category-info">
              <h2>{{ category.name }}</h2>
              <p>{{ category.description }}</p>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeGallery',
  data() {
    return {
      categories: [
        {
          name: 'Пейзаж',
          link: '/LandscapeGallery',
          image: '/peizaj.jpg',
          description: 'Картини, що зображують природні сцени та пейзажі.'
        },
        {
          name: 'Портрет',
          link: '/PortraitGallety',
          image: '/portret.jpg',
          description: 'Картини, що зображують людей та їхні обличчя.'
        },
        {
          name: 'Абстракція',
          link: '/AbstractGallery',
          image: '/abs.jpg',
          description: 'Картини, що використовують абстрактні форми та кольори.'
        },
        {
          name: 'Натюрморт',
          link: '/StilllifeGallery',
          image: '/nat.jpg',
          description: 'Картини, що зображують неживі предмети, як-от фрукти чи квіти.'
        },
        {
          name: 'Сюрреалізм',
          link: '/SurrealismGallery',
          image: '/sur.jpg',
          description: 'Картини, що зображують сучасні та експериментальні форми мистецтва.'
        }
      ],
      searchQuery: '',
      searchResults: []
    };
  },
  methods: {
    searchPaintings() {
      if (this.searchQuery.length > 2) {
        fetch(`http://localhost/artgallery/php/search_paintings.php?query=${this.searchQuery}`)
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

.home-gallery {
  display: flex;
  justify-content: space-between;
  padding-top: 15px;
}

.categories-container {
  flex: 1;
}

.header-with-search {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
}

.header-with-search h1 {
  margin: 0;
  font-size: 2rem;
}

.search-box {
  position: relative;
  width: 200px; 
  padding-right: 15px;
}

.header-with-search input {
  padding: 0.5rem;
  background-color: #000; 
  color: #ff6600; 
  border: 2px solid #ff6600; 
  border-radius: 5px;
  font-size: 1rem;
}

.header-with-search input::placeholder {
  color: #aaa; 
}

.header-with-search input:focus {
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
  max-height: 200px;
  overflow-y: auto;
  z-index: 10;
}

.search-results li {
  padding: 0.5rem;
}

.search-results li a {
  color: #ff6600;
  text-decoration: none;
}

.search-results li a:hover {
  text-decoration: underline;
}

.category_h1 {
  padding-left: 500px;
}

.categories {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  padding: 1rem;
}

.category-item {
  background: #222;
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.category-item:hover {
  transform: scale(1.05);
}

.category-item img {
  width: 300px;
  height: 300px;
  margin: 0.5rem;
  border-radius: 5px;
}

.category-info {
  padding: 1rem;
  flex: 1;
}

.category-info h2 {
  margin: 0;
  font-size: 1.5rem;
  color: #fff;
}

.category-info p {
  margin: 0.5rem 0 0;
  font-size: 1rem;
  color: #aaa;
}

.category-item a {
  text-decoration: none;
  color: inherit;
  display: flex;
  align-items: center;
}
</style>
