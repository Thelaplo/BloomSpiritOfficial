<template>
  <div class="admin-layout">
    <aside class="sidebar">
      <div class="admin-profile">
        <img src="/public/img/Compte.png" alt="Compte" class="account-logo">
        <p class="admin-name">ADMINISTRATEUR</p>
      </div>

      <nav class="admin-nav">
        <div class="nav-item">Tableau de bord</div>
        <div class="nav-item active">Excursion</div>
        <div class="nav-item blue">Commande</div>
        <div class="nav-item blue">Utilisateur</div>
        <div class="nav-item blue">Avis</div>
      </nav>

      <button class="btn-retour">RETOUR</button>
    </aside>

    <main class="admin-content">
      <header class="admin-banner">
       <div class="hero-image-container">
        </div>
      </header>

      <section class="excursion-section">
        <div class="section-header">
          <span class="badge-recent">Recent</span>
        </div>

        <div class="cards-grid">
          <div class="card create-card">
            <span>CREE EXCURSION</span>
            <span class="plus-icon">+</span>
          </div>

          <div 
            v-for="(item, index) in excursions" 
            :key="index" 
            class="card city-card" 
            :style="{ backgroundColor: item.color }"
          >
            {{ item.name }}
          </div>
        </div>

        <div class="section-divider">
          <h2>LES EXCURSIONS :</h2>
          <div class="search-bar">
            <input type="text" placeholder="RECHERCHE">
            <span class="search-icon">🔍</span>
          </div>
        </div>

        <div class="cards-grid">
          <div 
            v-for="(item, index) in allExcursions" 
            :key="index" 
            class="card city-card" 
            :style="{ backgroundColor: item.color }"
          >
            {{ item.name }}
          </div>
        </div>
      </section>
    </main>
  </div>
</template>
<script setup>
import { ref } from 'vue';

const excursions = ref([
  { name: 'TOKYO', color: '#c5b4b4' },
  { name: 'OSAKA', color: '#e6ba95' },
  { name: 'NIIGATA', color: '#a0ced9' }
]);

const allExcursions = ref([
  { name: 'KYOTO', color: '#ca95ca' },
  { name: 'FUKUSHIMA', color: '#c5b4b4' },
  { name: 'NAGASAKI', color: '#9bc4a9' },
  { name: 'YOKOHAMA', color: '#978dbf' },
  { name: 'FUJI', color: '#a0ced9' },
  { name: 'FUKUOKA', color: '#c9d18b' },
  { name: 'KOBE', color: '#e6ba95' }
]);
</script>
<style scoped>
/* --- STYLE PAR DEFAUT--- */
.admin-layout {
  display: flex;
  min-height: 100vh;
  background-color: #fff1f5; /* Fond rose très clair */
  font-family: Arial, sans-serif;
}

/* --- BARRE LATERALE --- */
.sidebar {
  width: 200px;
  background-color: #ff85a1;
  padding: 40px 15px;
  display: flex;
  flex-direction: column;
  color: white;
}

.admin-profile {
  text-align: center;
  margin-bottom: 50px;
}
/* --- LOGO ACC --- */
.account-logo {
  height: 45px; 
  width: auto;
  object-fit: contain;
}
/* --- BARRE NAV LATERALE --- */
.nav-item {
  padding: 10px;
  margin-bottom: 10px;
  font-size: 0.8rem;
  cursor: pointer;
  border-radius: 4px;
}

.nav-item.active {
  background-color: #f1768a; 
  position: relative;
}

.nav-item.blue {
  background-color: #4361ee;
}
/* --- BTN RETOUR--- */
.btn-retour {
  margin-top: auto;
  background-color: #4361ee;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 4px;
  cursor: pointer;
}

/* --- CONTENT --- */
.admin-content {
  flex-grow: 1;
  padding: 0;
  margin-top: 0;
}

/* --- HERO BANNIERE IMG --- */
.hero-image-container {
  background-image: url('/public/img/backAcceuil.jpg');
  height: 450px; 
  background-size: cover;
  background-position: center; 
  border-radius: 0; 
  position: auto;
  overflow: visible; 
}

/* --- GRILLE --- */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 40px;
  padding-top:20px;
  padding-left:20px;

}

.card {
  height: 100px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: bold;
  text-transform: uppercase;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
/* --- CASE CRÉATION --- */
.create-card {
  background: white;
  color: #333;
  border: 2px dashed #ccc;
  flex-direction: column;
  cursor: pointer;
}

.plus-icon { font-size: 1.5rem; margin-top: 5px; }

.section-divider {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 30px 0 20px;
  padding-left:0 ;
}
/* --- BARRE DE RECHERCHE--- */
.search-bar {
  background: white;
  padding: 5px 15px;
  border-radius: 20px;
  display: flex;
  align-items: center;
}

.search-bar input {
  border: none;
  outline: none;
  padding: 5px;
  text-transform: uppercase;
  font-size: 0.8rem;
}
/* --- BADGE RECENT --- */
.badge-recent {
  background: #f1768a;
  color: white;
  padding: 5px 20px;
  padding-bottom: 7px;
  padding-top:0px;
  border-radius: 15px;
  font-size: 0.8rem;
  margin-top: 10px;
  display:inline-block;
}
</style>