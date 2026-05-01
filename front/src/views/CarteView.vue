<template>
  <div id="bloom-spirit-site">
    <header class="hero-section">
      <div class="static-hero-container">
        <CarteJapon class="hero-map-overlay" />
        
        <div class="search-bar-wrapper">
          <input 
            type="text" 
            placeholder="ville, thème, distance..." 
            class="search-input"
            v-model="searchQuery"
          />
          <button class="search-button">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
              <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
          </button>
        </div>

        <TheHeader/>
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
          Aucun voyage ne correspond à vos critères de recherche.
        </p>
      </div>
    </section>
  </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import CarteJapon from '../components/CarteJapon.vue';
import TravelCard from '../components/travelcard.vue'; 
import TheHeader from '@/components/TheHeader.vue';

export default {
  components: {
    CarteJapon,
    TravelCard,
    TheHeader
  },
  setup() {
    const searchQuery = ref('');
    const voyages = ref([]);
    
    // Déclaration de l'objet filters pour tes sélecteurs
    const filters = ref({
      distance: '',
      options: '',
      theme: ''
    });

    const loadVoyages = async () => {
      try {
        const response = await fetch('http://localhost:8000/get_excursions.php');
        const data = await response.json();
        
        // On prépare l'objet pour qu'il corresponde aux attentes de travelcard.vue
        voyages.value = data.map(v => ({
          id: v.id,
          title: v.nom,
          imageUrl: `/img/${v.image}`,
          price: v.prix,
          duration: v.duree || 7, // On utilise la colonne duree de MySQL
          idCat: v.idCat,
          commentaire: v.commentaire
        }));
      } catch (error) {
        console.error("Erreur de chargement des voyages:", error);
      }
    };

    onMounted(loadVoyages);

    const filteredVoyages = computed(() => {
      return voyages.value.filter(voyage => {
        // 1. Recherche par texte (déjà présent)
        const matchesSearch = voyage.title.toLowerCase().includes(searchQuery.value.toLowerCase());

        // 2. Filtre Options (en dur par ID ou Nom)
        const matchesOption = !filters.value.options || 
                            (filters.value.options === 'Culturel' && [1, 4, 7].includes(voyage.id)) || 
                            (filters.value.options === 'Nature' && [2, 3, 5, 6, 8].includes(voyage.id));

        // 3. Filtre Thématique (en dur par mot-clé)
        const themesMap = {
          'Temple': ['Torii Miyajima', 'Nara', 'Taikodani Inari-jinja'],
          'Montagne': ['Shirakawa-go', 'Alpes Japonaises'],
          'Plage': ['Miyako-jima', 'Kumejima']
        };
        const matchesTheme = !filters.value.theme || 
                            (themesMap[filters.value.theme] && themesMap[filters.value.theme].includes(voyage.title));

        // 4. Filtre Distance (en dur pour la démo)
        const matchesDistance = !filters.value.distance || 
                              (filters.value.distance === '50km' && [4, 1].includes(voyage.id)) ||
                              (filters.value.distance === '100km') || // On laisse passer pour la démo
                              (filters.value.distance === '200km');

        return matchesSearch && matchesOption && matchesTheme && matchesDistance;
      });
    });

    return {
      searchQuery,
      filters,
      filteredVoyages
    };
  }
};
</script>

<style scoped>
/* Ajoute ici tes styles existants ou garde ceux que tu avais */
.travel-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 30px;
  padding: 20px;
}
.no-results {
  text-align: center;
  padding: 50px;
  font-style: italic;
  color: #666;
}
</style>
<style scoped>
  /* À mettre en dehors du "scoped" si possible, ou dans App.vue */
html, body {
  margin: 0 !important;
  padding: 0 !important;
  width: 100%;
  overflow-x: hidden; /* Empêche le décalage horizontal */
}
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

/* ------------------ Section Hero (Conteneur Statique) ------------------ */


.static-hero-container {
  /* Rétablit l'image de fond statique de la maquette */
  min-height: 500px; 
  position: relative;
  display: flex; /* Utilisé pour centrer la barre de recherche */
  justify-content: center;
  align-items: center;
  width:100%;
  overflow: hidden;
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
  box-shadow: var(--shadow-subtle);
  left:0%;
  /* Largeur contrôlée */
  width: 90%; 
  max-width: 500px; 
  right:500px;
  
  /* 🔥 IMPORTANT : On enlève les marges qui pourraient décentrer */
  margin: 0 auto; 
  
  /* On s'assure qu'elle passe au-dessus de la carte */
  z-index: 10; 
  position: relative; 
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
  padding: 50px ;
  background-color: var(--bg-light); 
  width:100%;
  padding-left:0;
  
}

/* RECTANGLE ROSE PLEIN ET CHEVAUCHANT */
.filters-row {
  display: flex;
  align-items: center;
  flex-wrap: wrap; 
  
  background-color: #e783a44e ; /* Couleur Rose (ajustée) */
  color: var(--text-light); 
  
  padding: 10px 20px; 
  
  margin: -60px auto 20px auto; /* Centre le bloc et le remonte */
  border-radius: 8px; 
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
  width: auto;
  height: 70px;
  justify-content: center;
}

.section-logo {
  font-size: 1.4em;
  font-weight: bold;
  margin-right: 30px;
  min-width: 100px;
}

.filter-group {
  display: center;
  align-items: center;
  margin-right: 40px;
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
  .filters-row {
    height: auto; /* Hauteur automatique pour contenir les filtres empilés */
    flex-direction: column;
    padding: 20px;
    margin-top: -30px;
  }
  .filter-group {
    margin: 10px 0;
    width: 100%;
    justify-content: space-between;
    display: flex;
  }
  .filter-select {
    width: 60%;
  }
  .search-bar-wrapper {
    width: 95%;
    top: 10%;
  }
}

@media (max-width: 480px) {
  .travel-grid {
    grid-template-columns: 1fr; 
  }
}
</style>