<template>
    <div class="header-top-bar">
          <nav class="top-nav-center">
            <div class="nav-rectangle-group">
              <router-link to="/" class="nav-link">Excursion</router-link>
              
              <span class="separator">|</span>
              
              <router-link to="/carte" class="nav-link">Carte</router-link>
              
              <span class="separator">|</span>
              
              <router-link to="/contact" class="nav-link">Contactez-nous</router-link>
            </div>
          </nav>
        <router-link to="/" class="logo-link">
         <img src="/public/img/BloomSpirit.png" alt="Bloom Spirit Logo" class="site-logo">
        </router-link>

          <router-link to="/login" class="account-logo-link">
            <img src="/public/img/Compte.png" alt="Compte" class="account-logo">
          </router-link>

        </div>
</template>
<style scoped>
    /* ------------------ BARRE DU HAUT & NAVIGATION ------------------ */

.header-top-bar {
  position: absolute;
  top: 25px;
  left: 10px;
  right: 30px;
  display: flex;
  justify-content: space-between; 
  align-items: center;
  z-index: 20;
}

.top-nav-center {
  display: flex;
  justify-content: center;
  margin: 20px; 
}

/* Styles pour le logo */
.site-logo {
  height: 45px; 
  width: auto;
  object-fit: contain;
}

/* Styles pour le logo Compte/Connexion (à droite) */
.account-logo {
  height: 45px; 
  width: auto;
  object-fit: contain;
}

/* Styles pour le RECTANGLE DE NAVIGATION GROUPÉ */
/* Le conteneur reste le rectangle avec la bordure */
.nav-rectangle-group {
  display: flex;
  align-items: center;
  padding: 8px 20px;
  border: 2px solid rgb(225, 161, 161);
  border-radius: 25px;
  background-color: rgba(203, 147, 175, 0.616); /* Optionnel : fond léger */
}

/* Style des liens individuels */
.nav-link {
  color: rgb(203, 71, 93);
  text-decoration: none;
  font-weight: 500;
  font-size: 0.9em;
  transition: color 0.3s;
}

/* Effet au survol sur un mot précis */
.nav-link:hover {
  color: #333;
}

.separator {
  margin: 0 15px;
  color: rgb(225, 161, 161);
  pointer-events: none; /* Pour qu'on ne puisse pas cliquer sur le trait */
}

/* Effet de survol */
.nav-rectangle-group:hover {
  background-color: white;
  color: #333;
}
</style>