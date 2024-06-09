<template>
  <footer>
    <div class="footer-content">
      <div class="footer-left">
        <div class="logo-section">
          <img src="/logo.png" alt="Логотип" class="logo">
          <div class="site-info">
            <h1>Палітра мистецтва</h1>
            <p class="text-muted">Зв'яжіться з нами для отримання додаткової інформації.</p>
          </div>
        </div>
        <div class="contact-info text-muted">
          <p>Телефон: +380000000000</p>
          <p>Email: PalitraMestectva@gmail.com</p>
        </div>
      </div>
      <div class="footer-center text-muted">
        <h2>CONNECT</h2>
        <ul>
          <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
          <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
          <li><a href="https://youtube.com" target="_blank">Youtube</a></li>
        </ul>
      </div>
      <div class="footer-right text-muted">
        <h2>QUICK LINKS</h2>
        <ul>
          <li><router-link to="/">Головна</router-link></li>
          <li><router-link to="/HomeGallery">Категорії картин</router-link></li>
          <li><router-link to="/About">Художники</router-link></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom text-muted">
      <p>Палітра мистецтва © 2024</p>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter',
};
</script>

<style>
footer {
  background: #000; /* Чорний фон */
  color: #fff;
  padding: 1rem 0;
  width: 100%;
  bottom: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.footer-content {
  display: flex;
  justify-content: space-between;
  width: 80%;
  max-width: 1200px;
}
.footer-left {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
.logo-section {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}
.logo {
  margin-right: 1rem;
  width: 50px; /* Встановлюємо ширину логотипу */
  height: 50px; /* Встановлюємо висоту логотипу */
}
.site-info {
  text-align: left;
}
.site-info h1 {
  margin: 0;
  font-size: 1.5rem;
  color: #fff; /* Назва сайту */
}
.text-muted {
  color: #aaa; /* Тон темніший для всього іншого тексту */
}
.contact-info {
  text-align: left;
  margin-left: 3 rem; /* Вирівнювання контактної інформації */
}
.footer-center, .footer-right {
  text-align: left;
}
.footer-center h2, .footer-right h2 {
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
  color: #aaa; /* Тон темніший для заголовків */
}
.footer-center ul, .footer-right ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-center li, .footer-right li {
  margin-bottom: 0.5rem;
}
.footer-center a, .footer-right a {
  color: #aaa;
  text-decoration: none;
  transition: color 0.5s; /* Додавання плавного переходу кольору */
}
.footer-center a:hover, .footer-right a:hover {
  color: #ff6600; /* Оранжевий колір при наведенні */
  text-decoration: none; /* Відсутність підкреслення при наведенні */
}
.footer-bottom {
  margin-top: 1rem;
  text-align: center;
}
</style>
