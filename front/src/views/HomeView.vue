<template>
  <div id="bloom-spirit-site">
    <header class="hero-section">
      <div class="hero-image-container">

        <div class="header-top-bar">
          <nav class="top-nav-center">
             <router-link to="/carte" class="nav-rectangle-group">
              <span>Excursion</span>
              <span class="separator">|</span>
              <span>Carte</span>
              <span class="separator">|</span>
              <span>Contactez-nous</span>
            </router-link>
          </nav>
          <router-link to="/" class="logo-link">
            <img src="/public/img/BloomSpirit.png" alt="Bloom Spirit Logo" class="site-logo">
          </router-link>

          <a href="#" class="account-logo-link">
            <img src="/public/img/Compte.png" alt="Compte" class="account-logo">
          </a>

        </div>
        
        <router-link to="/carte" class="carte-button-wrapper">
            <img src="/public/img/fleur.png" alt="Carte" class="carte-fleur-image">
            <span class="carte-text"></span>
        </router-link>
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
      <p>Découvrez nos meilleures offres pour la saison des feuilles rouges!</p>
    </section>
  </div>
</template>

<script>
import { voyages } from '../data.js'; // ✅ Importation du tableau de données centralisé

export default {
  data() {
    return {
      voyage: {} // L'objet voyage sera rempli au chargement
    };
  },
  
  // Utilise un watcher pour charger les données à l'ouverture de la page et si l'ID change
  watch: {
    '$route.params.id': {
      immediate: true, 
      handler() {
        this.loadVoyageData();
      }
    }
  },

  methods: {
    loadVoyageData() {
      // Récupère l'ID depuis l'URL et le convertit en nombre
      const voyageId = parseInt(this.$route.params.id);
      
      // Recherche l'objet dans le tableau de données
      const foundVoyage = voyages.find(v => v.id === voyageId);

      if (foundVoyage) {
        this.voyage = foundVoyage;
      } else {
        this.voyage = {}; // Vide l'objet pour afficher le message de non-trouvé
      }
    },
    
    // Méthode pour formater le prix en Euro
    formatCurrency(value) {
      return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 0
      }).format(value);
    }
  }
}
</script>

<style scoped>
/* Variables de base */
:root {
  --primary-color: #e91e63; /* Rose */
  --secondary-color: #f7e6e9; /* Arrière-plan clair */
  --text-dark: #333;
}

.detail-page-container {
  font-family: Arial, sans-serif;
  background-color: var(--secondary-color);
}

/* --- Section Héro (Image d'en-tête) --- */
.hero-detail-section {
  height: 400px;
  background-size: cover;
  background-position: center;
  position: relative;
  display: flex;
  align-items: flex-end; 
  color: white;
}

.overlay {
  background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
  width: 100%;
  padding: 30px 5%;
}

.overlay h1 {
  font-size: 2.5em;
  margin-bottom: 5px;
}

.price-info {
  font-size: 1.2em;
  font-weight: bold;
}

/* --- Contenu Principal (Grille à deux colonnes) --- */
.content-wrapper {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 5%;
  display: grid;
  grid-template-columns: 2fr 1fr; /* 2/3 pour le contenu principal, 1/3 pour la colonne latérale */
  gap: 40px;
}

/* --- COLONNE LATÉRALE (Blocs d'information roses) --- */

.side-info-column {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.side-info-block {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    color: white;
}

.pink-block {
    background-color: var(--primary-color);
}

.side-info-block h3 {
    margin-top: 0;
    font-size: 1.2em;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.reserve-button {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: white;
    color: var(--primary-color);
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s;
}

.reserve-button:hover {
    background-color: #f0f0f0;
}


/* --- Sections d'information principales (gauche) --- */
.info-section h2, .itinerary-section h2 {
  color: var(--primary-color);
  font-size: 1.8em;
  border-bottom: 2px solid var(--primary-color);
  padding-bottom: 10px;
  margin-bottom: 20px;
}

.description-text {
  line-height: 1.6;
  margin-bottom: 20px;
}

.tags span {
  display: inline-block;
  background-color: var(--primary-color);
  color: white;
  padding: 5px 10px;
  border-radius: 15px;
  font-size: 0.9em;
  margin-right: 10px;
}

/* --- Section Itinéraire --- */
.day-plan {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 900px) {
  .content-wrapper {
    grid-template-columns: 1fr;
  }
}
</style>
<style scoped>
/* NOTE IMPORTANTE : Nous allons utiliser des styles précis pour une copie conforme du Figma ! */

#bloom-spirit-site {
  font-family: 'Helvetica Neue', Arial, sans-serif;
  background-color: #FFEAF1;
  text-align: center;
  padding-bottom: 50px;
}

/* ------------------ Section Hero ------------------ */

.hero-section {
  max-width: none;
  margin: 0;
  padding: 0;
  width: 100%;
}

.hero-image-container {
  background-image: url('/public/img/backAcceuil.jpg');
  height: 450px; 
  background-size: cover;
  background-position: center; 
  border-radius: 0; 
  position: relative;
  overflow: visible; 
}

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


/* ------------------ LOGO PRINCIPAL CENTRÉ (NOUVEAU BLOC) ------------------ */

.main-hero-logo {
  position: absolute;
  
  /* Centrage Horizontal Parfait */
  left: 60%;
  transform: translateX(-50%); 
  
  /* Position Verticale : Ajustement pour le placer au-dessus de la pagode */
  top: 110px; 
  
  /* Taille du logo principal */
  width: 300px; 
  height: auto;
  z-index: 15; 
  
  /* Rend le logo blanc pour qu'il soit visible sur le fond sombre */
  filter: invert(100%); 
}


/* ------------------ BOUTON FLEUR (CORRIGÉ ET REPOSITIONNÉ) ------------------ */

.carte-button-wrapper {
  
  width: 150px; 
  height: 150px;
  /* POSITIONNEMENT CRUCIAL POUR LE CHEVAUCHEMENT */
  position: absolute;
  top: 83%; 
  left: 50%;
  transform: translateX(-50%); /* Centre horizontalement */
  z-index: 30;
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
  pointer-events: none;
  /* ✅ AJOUT DU CENTRAGE POUR LE TEXTE DE LA FLEUR */
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); 
}


/* ------------------ Sections Titres H2 ------------------ */
.popular-section {
    padding-top: 50px; 
}

.popular-section h2, .autumn-offers-section h2 {
  font-size: 1.8em;
  margin: 60px 0 30px;
  font-weight: bold;
  text-transform: uppercase;
  color: #333;
}

/* ------------------ Section Populaire - Cartes ------------------ */
.destination-cards-container {
  display: flex;
  justify-content: center;
  gap: 25px;
  flex-wrap: wrap;
  padding: 0 20px;
}

.destination-card {
  width: 320px;
  height: 480px;
  border-radius: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  background-size: cover;
  background-position: center;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s;
}
.destination-card:hover {
    transform: translateY(-10px);
}


/* Images de fond pour chaque carte (VÉRIFIEZ LES CHEMINS !) */
.tokyo-card    { background-image: url('/public/img/tokyo.jpg'); }
.kyoto-card    { background-image: url('/public/img/kyoto.jpg'); }
.okinawa-card  { background-image: url('/public/img/nara.jpg'); } 


/* L'overlay contenant le nom de la ville et l'effet de couleur rose en bas */
.city-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 40px 20px 20px;
  color: white;
  font-size: 1.8em;
  font-weight: bold;
  text-align: left;

  /* Gradient pour simuler l'effet de vague/couleur */
  background: linear-gradient(
    to top,
    rgba(240, 98, 146, 0.8) 0%,
    rgba(240, 98, 146, 0.4) 40%,
    transparent 80%
  );

  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}


/* ------------------ Media Queries (pour le responsive) ------------------ */
@media (max-width: 1024px) {
  .destination-cards-container {
    gap: 15px;
  }
  .destination-card {
    width: 45%;
    height: 350px;
  }
}

@media (max-width: 768px) {
  .hero-image-container {
    height: 300px;
  }
  
  /* ❌ SUPPRIMÉ : Suppression de la classe .site-logo-center-image non utilisée */
  
  .carte-button-wrapper {
      width: 150px; /* Taille ajustée pour le mobile */
      height: 150px;
      top: 85%; /* Ajustement mobile du bouton */
  }

  .destination-cards-container {
    flex-direction: column;
    align-items: center;
  }
  .destination-card {
    width: 90%;
    max-width: 400px;
    height: 300px;
  }
}
</style>