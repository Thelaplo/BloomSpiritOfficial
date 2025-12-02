<template>
  <div id="bloom-spirit-site">

    <header class="hero-section">
      <div class="hero-map-container">
        
        <div class="search-bar-wrapper">
          <input 
            type="text" 
            placeholder="ville, thème, distance..." 
            class="search-input"
          />
          <button class="search-button">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
              <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
          </button>
        </div>
        
      </div>
    </header>

    <section class="filters-and-title-section">
      <div class="filters-row">
        <h2 class="section-logo">Bloom Spirit</h2>
        
        <div class="filter-group"><label for="code-pays">Code pays</label><select id="code-pays" class="filter-select"><option value="jp">Japon</option></select></div>
        <div class="filter-group"><label for="options">Options</label><select id="options" class="filter-select"><option value="">Toutes</option></select></div>
        <div class="filter-group"><label for="thematique">Thématique</label><select id="thematique" class="filter-select"><option value="">Culturel</option></select></div>
      </div>
      
      <div class="titles-container">
        <h1>Nos idées de voyage sur mesure au Japon</h1>
        <p class="subtitle">Votre voyage ne ressemblera à aucun autre.</p>
      </div>
    </section>

    <section class="travel-grid-section">
      <div class="travel-grid">
<!--         
        <TravelCard 
          v-for="voyage in voyages" 
          :key="voyage.id" 
          :travel="voyage"
        /> -->
        
      </div>
    </section>

  </div>
</template>
<style scoped>
/* Définition des couleurs principales */
:root {
  --primary-color: #e91e63; /* Rose/Rouge */
  --text-dark: #333;
  --text-light: #fff;
  --bg-light: #f4f4f4;
  --shadow-subtle: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* ------------------ Section Hero (Carte et Recherche) ------------------ */

.hero-map-container {
  /* Assurez-vous d'avoir cette image dans /public/img/ */
  background: url('/public/img/map_japan.jpg') no-repeat center center/cover;
  min-height: 500px; 
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}

/* Style de la Barre de Recherche */
.search-bar-wrapper {
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 30px;
  display: flex;
  align-items: center;
  padding: 10px 20px;
  box-shadow: var(--shadow-subtle);
  width: 100%;
  max-width: 600px;
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
  padding: 20px 5%;
  background-color: var(--bg-light); 
}

/* Ligne de filtres rose/rouge qui chevauche la carte */
.filters-row {
  display: flex;
  align-items: center;
  flex-wrap: wrap; 
  background-color: var(--primary-color);
  color: var(--text-light);
  padding: 10px 20px;
  margin: -60px 0 30px 0; /* Remonte sur la carte */
  box-shadow: var(--shadow-subtle);
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
  background-color: #fff;
}

.travel-grid {
  display: grid;
  /* Grille par défaut à 4 colonnes */
  grid-template-columns: repeat(4, 1fr); 
  gap: 30px;
  max-width: 1200px; 
  margin: 0 auto;
}

/* --- Media Queries pour la Réactivité (très important !) --- */
@media (max-width: 1024px) {
  .travel-grid {
    grid-template-columns: repeat(3, 1fr); /* 3 colonnes sur tablette */
  }
}

@media (max-width: 768px) {
  .travel-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 colonnes sur petit écran */
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
    grid-template-columns: 1fr; /* 1 colonne sur mobile */
  }
}
</style>