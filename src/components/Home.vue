<template>
  <div>
    <section class="hero">
      <div class="hero-content">
        <h1>Ласкаво просимо до Палітри мистецтва</h1>
        <p>Наша галерея представляє найкращі твори сучасних художників</p>
        <router-link to="/HomeGallery" class="button">Дізнатися більше</router-link>
      </div>
    </section>
    
    <section class="history">
      <h2>Наша історія</h2>
      <div class="history-content">
        <img src="/f1.jpg" alt="Галерея" class="gallery-image">
        <div class="history-items">
          <br><br>
          <div class="history-item">
            <h3>Заснування</h3>
            <p>Галерея "Палітра мистецтва" була заснована у 2000 році з метою підтримки сучасного мистецтва.</p>
          </div>
          <div class="history-item">
            <h3>Місія</h3>
            <p>Наша місія - просувати талановитих художників та надавати платформу для їхньої творчості.</p>
          </div>
          <div class="history-item">
            <h3>Досягнення</h3>
            <p>За роки існування ми провели понад 100 виставок та співпрацювали з численними митцями з усього світу.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="news">
      <h2>Короткі новини</h2>
      <br>
      <div class="news-items">
        <div class="news-item">
          <img src="/vistavka.jpg" alt="Виставка" width="300" height="200">
          <h3>Відкриття нової виставки</h3>
          <p>Відвідайте нашу нову виставку сучасного мистецтва.</p>
        </div>
        <div class="news-item">
          <img src="/inter.jpg" alt="Інтерв'ю" width="300" height="200">
          <h3>Інтерв'ю з художником</h3>
          <p>Дізнайтеся більше про наших художників через їхні інтерв'ю.</p>
        </div>
        <div class="news-item">
          <img src="/nago.jpg" alt="Нагороди" width="300" height="200">
          <h3>Нагороди та відзнаки</h3>
          <p>Галерея отримала численні нагороди за внесок у мистецтво.</p>
        </div>
        <div class="news-item">
          <img src="/klas.jpg" alt="Майстер-клас" width="300" height="200">
          <h3>Майстер-класи</h3>
          <p>Приєднуйтесь до наших майстер-класів та навчайтесь у професіоналів.</p>
        </div>
      </div>
    </section>
    
    <section class="location">
      <div class="address">
        <h2>Наша адреса</h2>
        <p>Україна, Івано-Франківська область, Коломия,<br> проспект Вячеслава Чорновола 17, 78200</p>
      </div>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2642.3415056343742!2d25.03695038614427!3d48.52668670907773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4736d28591949f31%3A0xdd929d03a59e4aa5!2z0L_RgNC-0YHQvy4g0JLRj9GH0LXRgdC70LDQstCwINCn0L7RgNC90L7QstC-0LvQsCwgMTcsINCa0L7Qu9C-0LzRi9GPLCDQmNCy0LDQvdC-LdCk0YDQsNC90LrQvtCy0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsIDc4MjAw!5e0!3m2!1sru!2sua!4v1717771439128!5m2!1sru!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <section class="contact-form">
      <h2>Зв'яжіться з нами</h2>
      <form>
        <label for="name">Ім'я</label>
        <input type="text" id="name" name="name">
        
        <label for="email">Електронна пошта</label>
        <input type="email" id="email" name="email">
        
        <label for="message">Повідомлення</label>
        <textarea id="message" name="message"></textarea>
        
        <button type="submit">Відправити</button>
      </form>
    </section>
  </div>
</template>

<script>
export default {
  name: 'HomePage'
}
</script>

<style>
body {
  background: #000;
  color: #fff;
}
.hero {
  background: url('/public/f2.jpg') no-repeat center center / cover; /* Оновлений стиль для фону */
  height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.hero-content {
  background: rgba(0, 0, 0, 0.5);
  padding: 2rem;
  border-radius: 10px;
}
.button {
  background: #ff6600;
  color: #fff;
  padding: 1rem 2rem;
  text-decoration: none;
  border-radius: 5px;
  display: inline-block;
  margin: 1rem 0;
  transition: background-color 0.3s;
}
.button:hover {
  background: #e65c00;
}
.history {
  padding: 2rem;
  background: #111;
}
.history-content {
  display: flex;
  align-items: center;
}
.gallery-image {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
  margin-right: 2rem;
  transition: transform 0.3s;
}
.gallery-image:hover {
  transform: scale(1.05);
}
.history-items {
  flex: 1;
}
.history-item {
  margin-bottom: 2rem;
  background: #222;
  padding: 1rem;
  border-radius: 10px;
  transition: background-color 0.3s;
}
.history-item:hover {
  background: #333;
}
.history-item h3 {
  margin: 0;
  color: #ffffff;
}
.history-item p {
  color: #aaa;
  text-align: left;
}
.news {
  padding: 2rem;
  background: #222;
}
.news-items {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
}
.news-item {
  background: #333;
  padding: 1rem;
  border-radius: 10px;
  text-align: center;
}
.news-item img {
  max-width: 100%;
  border-radius: 10px;
  transition: transform 0.3s;
}
.news-item img:hover {
  transform: scale(1.05);
}
.contact-form {
  padding: 2rem;
  background: #111;
}
.contact-form form {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.contact-form label {
  margin: 0.5rem 0;
}
.contact-form input, .contact-form textarea {
  padding: 0.5rem;
  margin: 0.5rem 0;
  border-radius: 5px;
  border: 1px solid #ccc;
  background: #222;
  color: #fff;
  width: 50%;
  transition: border-color 0.3s;
}
.contact-form input:focus, .contact-form textarea:focus {
  border-color: #ff6600;
  outline: none;
}
.contact-form textarea {
  height: 10rem;
}
.contact-form button {
  background: #ff6600;
  color: #fff;
  padding: 1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 1rem;
  transition: background-color 0.3s;
}
.contact-form button:hover {
  background: #e65c00;
}
.location {
  display: flex;
  align-items: center;
  padding: 2rem;
  background-color: #222;
}
.address {
  flex: 1;
  padding-right: 2rem;
}
.address h2 {
  margin: 0 0 1rem;
}
.address p {
  margin: 0;
  color: #aaa;
  font-size: 1rem;
}
iframe {
  flex: 2;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
</style>
