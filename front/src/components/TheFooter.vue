<template>
  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-brand">
        <img src="/public/img/BloomSpirit.png" alt="Bloom Spirit Logo" class="footer-logo">
        <p class="slogan">Laissez votre esprit éclore au Japon.</p>
      </div>

      <div class="footer-links">
        <h3>Navigation</h3>
        <ul>
          <li><router-link to="/">Accueil</router-link></li>
          <li><router-link to="/excursions">Excursions</router-link></li>
          <li><router-link to="/carte">Carte</router-link></li>
        </ul>
      </div>

      <div class="footer-contact">
        <h3>Aide</h3>
        <ul>
          <li><a href="#">Contactez-nous</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Mentions Légales</a></li>
        </ul>
      </div>

      <div class="footer-social">
        <h3>Suivez-nous</h3>
        <div class="social-icons">
          <span>INSTAGRAM</span>
          <span>FACEBOOK</span>
          <span>X</span>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 Bloom Spirit - Voyage sur mesure au Japon. <span>咲</span></p>
    </div>
  </footer>
</template>

<style scoped>
.site-footer {
  background-color: #efaad5bb; /* Même rose que tes pages */
  padding: 60px 5% 20px 5%;
  color: #333;
  font-family: 'Lora', serif;
  border-top: 1px solid rgba(233, 30, 99, 0.1);
}

.footer-container {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 40px;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-logo {
  height: 50px;
  margin-bottom: 15px;
}

.slogan {
  font-style: italic;
  font-size: 0.9rem;
  color: #666;
}

h3 {
  font-size: 1.1rem;
  margin-bottom: 20px;
  color: #e91e63; /* Rose plus prononcé */
  text-transform: uppercase;
  letter-spacing: 1px;
}

ul {
  list-style: none;
  padding: 0;
}

ul li {
  margin-bottom: 10px;
}

ul li a {
  text-decoration: none;
  color: #555;
  font-size: 0.9rem;
  transition: color 0.3s;
}

ul li a:hover {
  color: #e91e63;
}

.footer-bottom {
  margin-top: 40px;
  padding-top: 20px;
  border-top: 1px solid rgba(0,0,0,0.05);
  text-align: center;
  font-size: 0.8rem;
  color: #781c65;
}

.footer-bottom span {
  color: #e91e63;
  font-size: 1.2rem;
  margin-left: 5px;
}
.footer-social .social-icons {
  display: flex;
  gap: 15px;
  font-size: 0.9rem;
  color: #555;
}

/* Responsive */
@media (max-width: 768px) {
  .footer-container {
    grid-template-columns: 1fr 1fr;
  }
}
</style>