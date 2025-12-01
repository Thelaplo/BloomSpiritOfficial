<template>
  <div id="bloom-spirit-site">
    <header class="hero-section">
      <div class="hero-image-container">

        <div class="header-top-bar">

          <a href="#" class="logo-link">
            <img src="/public/img/BloomSpirit.png" alt="Bloom Spirit Logo" class="site-logo">
          </a>

          <nav class="top-nav-center">
            <a href="#" class="nav-rectangle-group">
              <span>Excursion</span>
              <span class="separator">|</span>
              <span>Carte</span>
              <span class="separator">|</span>
              <span>Contactez-nous</span>
            </a>
          </nav>

          <a href="#" class="account-logo-link">
            <img src="/public/img/Compte.png" alt="Compte" class="account-logo">
          </a>

        </div>
        

        <a href="#" class="carte-button-wrapper">
            <img src="/public/img/fleur.png" alt="Carte" class="carte-fleur-image">
            <span class="carte-text"></span>
        </a>
      </div>
    </header>

    <section class="popular-section">
      <h2>POPULAIRE</h2>
      <div class="destination-cards-container">
        
        <div class="destination-card tokyo-card">
          <div class="city-overlay">Tokyo</div>
        </div>

        <div class="destination-card kyoto-card">
          <div class="city-overlay">Kyoto</div>
        </div>

        <div class="destination-card okinawa-card">
          <div class="city-overlay">Okinawa</div>
        </div>
        
      </div>
    </section>
    
    <section class="autumn-offers-section">
      <h2>Offres d'Automne</h2>
    </section>
  </div>
</template>

<script setup>
// Aucun script (logique) nécessaire pour une vue statique
</script>

<style scoped>
/* NOTE IMPORTANTE : Nous allons utiliser des styles précis pour une copie conforme du Figma ! */

#bloom-spirit-site {
  font-family: 'Helvetica Neue', Arial, sans-serif;
  background-color: #f7f7f7;
  text-align: center;
  padding-bottom: 50px;
}

/* ------------------ Section Hero ------------------ */
/* ------------------ Section Hero ------------------ */
.hero-section {
  max-width: none;
  margin: 0;
  padding: 0;
  width: 100%;
}

.hero-image-container {
  background-image: url('/public/img/backAcceuil.jpg');
  /* La hauteur peut devenir problématique si elle est fixe. 
     Ajustons-la en fonction du ratio pour la rendre plus fluide, 
     mais pour l'instant, gardons 450px en fixe pour éviter le saut */
  height: 450px; 
  background-size: cover;
  background-position: center; /* Simplifions la position à 'center' */
  border-radius: 0; 
  position: relative;
  overflow: visible; 
  
  /* ... autres styles ... */
}

/* ------------------ BARRE DU HAUT & NAVIGATION ------------------ */

/* ------------------ BARRE DU HAUT : Logo | Menu Groupé | Compte ------------------ */

.header-top-bar {
  position: absolute;
  top: 25px;
  left: 30px;
  right: 30px;
  /* Utilisation de Flexbox pour une répartition flexible */
  display: flex;
  justify-content: space-between; 
  align-items: center;
  z-index: 20;
}

/* Le menu groupé a besoin de ne pas être trop large pour laisser de l'espace au logo */
.top-nav-center {
  /* Retirons le flex-grow: 1 pour éviter qu'il prenne trop de place */
  /* flex-grow: 1; */ 
  display: flex;
  justify-content: center;
  /* AJUSTEMENT : Ajoutons une petite marge pour éviter de coller au logo et à l'icône de compte */
  margin: 0 40px; 
}

/* Styles pour le logo (Image) à gauche */
.site-logo {
  height: 40px; 
  width: auto;
  object-fit: contain;
}

/* Styles pour le logo Compte/Connexion (à droite) */
.account-logo {
  height: 30px; 
  width: auto;
  object-fit: contain;
}


/* Styles pour le RECTANGLE DE NAVIGATION GROUPÉ */
.nav-rectangle-group {
  color: white;
  text-decoration: none;
  font-weight: 500;
  font-size: 0.9em;
  padding: 8px 15px;
  white-space: nowrap;

  border: 2px solid white;
  border-radius: 20px;

  transition: background-color 0.3s, color 0.3s;
}

/* Séparateurs entre les liens (Excursion | Carte | Contactez-nous) */
.separator {
  margin: 0 10px;
  opacity: 0.7;
}

/* Effet de survol */
.nav-rectangle-group:hover {
  background-color: white;
  color: #333;
}


/* ------------------ TITRE PRINCIPAL GRAND ET CENTRÉ ------------------ */

/* Ajout du titre central (non visible dans la dernière capture, mais présent dans la Figma) */
.site-title-center {
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 3em; /* Taille de base */
  /* ... autres styles ... */
}

/* AJUSTEMENT RESPONSIVE POUR LE TITRE */
@media (max-width: 768px) {
    .site-title-center {
        font-size: 1.8em; /* Réduire la taille du titre sur mobile */
    }
}


/* ------------------ BOUTON FLEUR (CORRIGÉ ET REPOSITIONNÉ) ------------------ */

.carte-button-wrapper {
  /* ... autres styles ... */
  
  /* CORRECTION 2: TAILLE RELATIVE (fluidité pour le responsive) */
  width: 200px; /* Taille maximale ou de base */
  height: 200px;
  
  /* POSITIONNEMENT CRUCIAL POUR LE CHEVAUCHEMENT */
  position: absolute;
  top: 78%; /* 95% de la hauteur de l'image (pour chevaucher le fond blanc) */
  left: 50%;
  transform: translateX(-50%); /* Centre horizontalement */
  z-index: 30;
  
  /* ... autres styles ... */
}
.carte-fleur-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.carte-text {
  position: absolute;
  color: white; 
  font-weight: bold;
  font-size: 1.1em;
  pointer-events: none; /* Permet de cliquer sur l'image en dessous */
}


/* ------------------ Sections Titres H2 ------------------ */
.popular-section {
    /* La fleur chevauche, donc on réduit la marge supérieure de la section */
    padding-top: 50px; 
}

.popular-section h2, .autumn-offers-section h2 {
  font-size: 1.8em;
  margin: 60px 0 30px;
  font-weight: bold;
  text-transform: uppercase;
  color: #333;
}

/* ... (Le reste des styles des cartes, overlays, et media queries est correct) ... */
</style>