<template>
  <div id="bloom-spirit-site">
    <header class="hero-section">
      <div class="static-hero-container">
        
        <CarteJapon class="hero-map-overlay" />
        
        <div class="search-bar-wrapper">
          </div>
        <div class="header-top-bar">
          </div>
        <div class="search-bar-wrapper">
          <input 
            type="text" 
            placeholder="ville, thème, distance..." 
            class="search-input"
            v-model="searchQuery"
            @keyup.enter="filterVoyages"
          />
          <button class="search-button" @click="filterVoyages">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
              <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
          </button>
        </div>
        <div class="header-top-bar">
          <nav class="top-nav-center">
            <a href="#" class="nav-rectangle-group">
              <span>Excursion</span>
              <span class="separator">|</span>
              <span>Carte</span>
              <span class="separator">|</span>
              <span>Contactez-nous</span>
            </a>
          </nav>
          <a href="#" class="logo-link">
            <img src="/public/img/BloomSpirit.png" alt="Bloom Spirit Logo" class="site-logo">
          </a>

          <a href="#" class="account-logo-link">
            <img src="/public/img/Compte.png" alt="Compte" class="account-logo">
          </a>

        </div>
        
      </div>
    </header>
    <section class="filters-and-title-section">
      <div class="filters-row">
        <h2 class="section-logo">Bloom Spirit</h2>
        
        <div class="filter-group">
            <label for="distance">Distance</label>
            <select id="distance" class="filter-select" v-model="filters.distance">
                <option value="">Toutes</option>
                <option value="50km">Moins de 50 km</option>
                <option value="100km">Moins de 100 km</option>
                <option value="200km">Moins de 200 km</option>
                </select>
        </div>
        <div class="filter-group">
          <label for="options">Options</label>
          <select id="options" class="filter-select" v-model="filters.options">
            <option value="">Toutes</option>
            <option value="Culturel">Culturel</option>
            <option value="Nature">Nature</option>
          </select>
        </div>
        <div class="filter-group">
          <label for="thematique">Thématique</label>
          <select id="thematique" class="filter-select" v-model="filters.theme">
            <option value="">Toutes</option>
            <option value="Temple">Temple</option>
            <option value="Montagne">Montagne</option>
            <option value="Plage">Plage</option>
          </select>
        </div>
      </div>
      
      <div class="titles-container">
        <h1>Nos idées de voyage sur mesure au Japon</h1>
        <p class="subtitle">Votre voyage ne ressemblera à aucun autre.</p>
      </div>
    </section>

    <section class="travel-grid-section">
      <div class="travel-grid">
        
        <TravelCard 
          v-for="voyage in filteredVoyages" 
          :key="voyage.id" 
          :travel="voyage"
        />
        
        <p v-if="filteredVoyages.length === 0" class="no-results-message" style="grid-column: 1 / -1; text-align: center;">
          Aucun voyage ne correspond à vos critères de recherche. Veuillez ajuster vos filtres.
        </p>

      </div>
    </section>

  </div>
</template>
<script>
import TravelCard from '../components/travelcard.vue'; 
import CarteJapon from '../components/CarteJapon.vue';

export default {
  components: {
    TravelCard,
    CarteJapon
  },
  data() {
    return {
      // PROPRIÉTÉS DE FILTRAGE
      searchQuery: '',
      filters: {
        distance: '', // Nouveau filtre actif
        options: '',
        theme: '',
      },
      
      // Données de voyage (avec distance_km ajoutée)
      voyages: [
        { id: 1, title: 'Torii Miyajima', duration: 6, price: 950, imageUrl: '/public/img/torii-Miyajima.jpeg', options: 'Culturel', theme: 'Temple', distance_km: 75 },
        { id: 2, title: 'Shirakawa-go', duration: 5, price: 620, imageUrl: '/public/img/shirakawa_go.jpg', options: 'Nature', theme: 'Montagne', distance_km: 150 },
        { id: 3, title: 'Chute de Nachi', duration: 5, price: 620, imageUrl: '/public/img/Chute2nachi.webp',  options: 'Nature', theme: 'Temple', distance_km: 40 },
        { id: 4, title: 'Nara', duration: 7, price: 1100, imageUrl: '/public/img/nara.jpg',  options: 'Culturel', theme: 'Temple', distance_km: 120 },
        { id: 5, title: 'Miyako-jima', duration: 5, price: 920, imageUrl: '/public/img/miyako-jima.jpg',  options: 'Nature', theme: 'Plage', distance_km: 800 },
        { id: 6, title: 'Shirakawa-go', duration: 5, price: 620, imageUrl: '/public/img/Shirakawa-go2.jpeg', options: 'Nature', theme: 'Montagne', distance_km: 160 },
        { id: 7, title: 'Taikodani Inari-jinja', duration: 7, price: 1100, imageUrl: '/public/img/Taikodani-inari-jinja.jpg',options: 'Culturel', theme: 'Temple', distance_km: 50 },
        { id: 8, title: 'Kumejima', duration: 7, price: 630, imageUrl: '/public/img/kumejima.jpg',options: 'Nature', theme: 'Plage', distance_km: 130 },
      ]
    };
  },
  
  computed: {
    filteredVoyages() {
      const query = this.searchQuery.toLowerCase().trim();
      
      return this.voyages.filter(voyage => {
        let match = true;
        
        // 1. Recherche dans la barre (Titre, Thème, Option)
        if (query.length > 0) {
          const searchTargets = [voyage.title, voyage.theme, voyage.options].join(' ').toLowerCase();
          if (!searchTargets.includes(query)) {
            match = false;
          }
        }
        
        // 2. FILTRE DISTANCE
        if (this.filters.distance) {
            const maxDistance = parseInt(this.filters.distance.replace('km', ''));
            if (voyage.distance_km > maxDistance) {
                match = false;
            }
        }
        
        // 3. Filtre Options
        if (this.filters.options && voyage.options !== this.filters.options) {
          match = false;
        }
        
        // 4. Filtre Thématique
        if (this.filters.theme && voyage.theme !== this.filters.theme) {
          match = false;
        }

        return match;
      });
    }
  },
  
  methods: {
    filterVoyages() {
      console.log('Filtrage des voyages en cours...');
    }
  }
}
</script>

<style scoped>
/* Définition des couleurs principales */
:root {
  --primary-color: #e91e63; /* Rose/Rouge */
  --text-dark: #333;
  --text-light: #fff;
  --bg-light: #f4f4f4;
  --shadow-subtle: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#bloom-spirit-site {
  font-family: 'Helvetica Neue', Arial, sans-serif;
  background-color: #FFEAF1;
  text-align: center;
  padding-bottom: 50px;
}
/*-------------------Barre de Navigation-----------------------------*/ 
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
  color: rgb(203, 71, 93);
  text-decoration: none;
  font-weight: 500;
  font-size: 0.9em;
  padding: 8px 15px;
  white-space: nowrap;

  border: 2px solid rgb(225, 161, 161);
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
/* ------------------ Section Hero (Conteneur Statique) ------------------ */


.static-hero-container {
  /* Rétablit l'image de fond statique de la maquette */
  min-height: 500px; 
  position: relative;
  display: flex; /* Utilisé pour centrer la barre de recherche */
  justify-content: center;
  align-items: center;
  padding: 0; 
}

.hero-map-overlay {
      position: absolute; /* Allows it to fill the container without affecting other elements */
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1; /* Place it behind the nav (z-index: 20) and search bar */
}


/* Style de la Barre de Recherche (pour centrer au milieu de l'image) */
.search-bar-wrapper {
  background-color: rgba(244, 217, 217, 0.9);
  border-radius: 30px;
  display: flex;
  align-items: center;
  padding: 10px 20px;
  box-shadow: var(--shadow-subtle);
  width: 100%;
  max-width: 600px;
  z-index: 10; /* Ensure it is above the map (z-index: 1) */
  position: relative; /* Keep it positioned relative to the container center */
}


.search-input {
  flex-grow: 1;
  border: none;
  padding: 5px 10px;
  font-size: 1.1em;
  background: transparent;
  outline: none;
}

.search-button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  padding: 5px;
  color: var(--primary-color);
}


/* ------------------ Section Filtres et Titres ------------------ */

.filters-and-title-section {
  padding: 50px 5%;
  background-color: var(--bg-light); 
}

/* RECTANGLE ROSE PLEIN ET CHEVAUCHANT */
.filters-row {
  display: flex;
  align-items: center;
  flex-wrap: wrap; 
  
  background-color: #e783a44e ; /* Couleur Rose (ajustée) */
  color: var(--text-light); 
  
  padding: 7px 5px; 
  
  margin: -60px auto 30px auto; /* Centre le bloc et le remonte */
  border-radius: 8px; 
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
  width: auto;
}

.section-logo {
  font-size: 1.4em;
  font-weight: bold;
  margin-right: 30px;
  min-width: 100px;
}

.filter-group {
  display: flex;
  align-items: center;
  margin-right: 20px;
}

.filter-group label {
  margin-right: 5px;
  font-size: 0.9em;
}

.filter-select {
  padding: 5px 10px;
  border: 1px solid var(--text-light);
  border-radius: 4px;
  background-color: var(--primary-color);
  color: var(--text-light);
  font-size: 0.9em;
  cursor: pointer;
}

.titles-container {
  text-align: center;
  padding: 20px 0;
}

.titles-container h1 {
  font-size: 2em;
  margin-bottom: 5px;
  font-weight: 300;
}

.subtitle {
  font-style: italic;
  color: #666;
  font-size: 1em;
}


/* ------------------ Grille de Voyages ------------------ */

.travel-grid-section {
  padding: 40px 5%;
  background-color: #efa7a728;
}

.travel-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr); 
  gap: 30px;
  max-width: 1200px; 
  margin: 0 auto;
}

/* --- Media Queries pour la Réactivité (très important !) --- */
@media (max-width: 1024px) {
  .travel-grid {
    grid-template-columns: repeat(3, 1fr); 
  }
}

@media (max-width: 768px) {
  .travel-grid {
    grid-template-columns: repeat(2, 1fr); 
  }
  
  .filters-row {
      justify-content: center;
  }
  
  .filter-group {
      margin: 5px 10px;
  }
  
  .section-logo {
      width: 100%;
      text-align: center;
      margin: 0 0 10px 0;
  }
}

@media (max-width: 480px) {
  .travel-grid {
    grid-template-columns: 1fr; 
  }
}
</style>