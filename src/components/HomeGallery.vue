<template>
  <div>
    <h1>Категорії картин</h1>
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
</template>

<script>
export default {
  name: 'HomeGallery',
  data() {
    return {
      categories: [
        {
          name: 'Пейзажі',
          link: '/LandscapeGallery',
          image: '/peizaj.jpg',
          description: 'Картини, що зображують природні сцени та пейзажі.'
        },
        {
          name: 'Портрети',
          link: '/PortraitGallety',
          image: '/portret.jpg',
          description: 'Картини, що зображують людей та їхні обличчя.'
        },
        {
          name: 'Абстракції',
          link: '/AbstractGallery',
          image: '/abs.jpg',
          description: 'Картини, що використовують абстрактні форми та кольори.'
        },
        {
          name: 'Натюрморти',
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
      ]
    };
  }
}
</script>

<style>
body {
  background-color: #111; /* Змінюємо фон сторінки */
  color: #fff; /* Змінюємо колір тексту */
  margin: 0;
  font-family: Arial, sans-serif;
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
