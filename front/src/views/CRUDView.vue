<template>
  <div class="admin-layout">
    <aside class="sidebar">
      <div class="admin-profile">
        <img src="/public/img/Compte.png" alt="Compte" class="account-logo">
        <p class="admin-name">ADMINISTRATEUR</p>
      </div>

      <nav class="admin-nav">
        <div class="nav-item" @click="currentSection = 'dashboard'">Tableau de bord</div>
        <div class="nav-item" @click="currentSection = 'excursions'">Excursions</div>
        <div class="nav-item blue" @click="showUsers">Utilisateurs</div>
      </nav>
      <router-link to="/" class="btn-retour">
          <button class="btn-retour">ACCUEIL</button>
      </router-link>
    </aside>
    <main class="admin-content">
      <header class="admin-banner">
       <div class="hero-image-container">
        </div>
      </header>
      <section class="admin-stats-section">
        <div class="section-divider">
          <h2>ANALYSE DE VOTRE ACTIVITÉ</h2>
        </div>

        <div class="dashboard-container">
          <div class="stats-grid">
            <div class="stat-box">
              <h4>{{ allExcursions.length }}</h4>
              <p>Destinations</p>
            </div>
            <div class="stat-box">
              <h4>{{ usersCount }}</h4>
              <p>Voyageurs inscrits</p>
            </div>
            <div class="stat-box">
              <h4>{{ totalFavoritesCount }}</h4>
              <p>Total Favoris</p>
            </div>
          </div>

          <div class="top-ranking">
            <h3>Destinations coup de cœur 💓</h3>
            <ul>
              <li v-for="(item, index) in topFavorites" :key="item.nom">
                <span class="rank">#{{ index + 1 }}</span>
                <span class="city-name">{{ item.nom }}</span>
                <span class="count">{{ item.nb_fav }} favoris</span>
              </li>
            </ul>
          </div>
        </div>
      </section>
      <section v-if="currentSection === 'excursions'" class="excursion-section">
        <div class="section-divider">
          <h2>GESTION DU CATALOGUE</h2>
          </div>
        </section>

      <section v-if="currentSection === 'utilisateurs'" class="user-management-section">
        <div class="section-divider">
          <h2>LISTE DES VOYAGEURS</h2>
        </div>
        
        <div class="user-table-container">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Login (Email)</th>
                <th>Rôle</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.login">
                <td>{{ user.login }}</td>
                <td>
                  <span :class="user.isAdmin ? 'badge-admin' : 'badge-user'">
                    {{ user.isAdmin ? 'Administrateur' : 'Voyageur' }}
                  </span>
                </td>
                <td>
                  <button class="btn-action">Détails</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section class="excursion-section">
      <div class="section-header">
        <span class="badge-recent">Recent</span>
      </div>

      <div class="cards-grid">
        <div class="card create-card" @click="openCreateModal">
          <span>CRÉER EXCURSION</span>
          <span class="plus-icon">+</span>
        </div>

        <div 
          v-for="item in recentExcursions" 
          :key="'recent-' + item.id" 
          class="card city-card" 
          :style="{ backgroundColor: item.color || '#f1768a' }"
        >
          {{ item.name }} (RÉCENT)
        </div>
      </div>

      <div v-if="isModalOpen" class="modal-overlay">
        <div class="modal-content">
          <h3>{{ isEditing ? 'Modifier l\'excursion' : 'Ajouter une destination' }}</h3>
          
          <form @submit.prevent="handleCreate" class="creation-form">
            <div class="field-group">
              <label>Nom de l'excursion</label>
              <input v-model="newExcursion.nom" type="text" placeholder="Ex: Kyoto Tradition" required>
            </div>

            <div class="field-group">
              <label>Nom du fichier image</label>
              <input v-model="newExcursion.image" type="text" placeholder="ex: kyoto.jpg" required>
            </div>

            <div class="field-group">
              <label>Description</label>
              <textarea v-model="newExcursion.desc" rows="3" placeholder="Résumé du voyage..."></textarea>
            </div>

            <div class="form-row">
              <div class="field-group">
                <label>Difficulté</label>
                <select v-model="newExcursion.difficulte">
                  <option>Facile</option>
                  <option>Moyen</option>
                  <option>Difficile</option>
                </select>
              </div>
              <div class="field-group">
                <label>Catégorie</label>
                <select v-model="newExcursion.idCat" required>
                  <option value="" disabled>Choisir une catégorie</option>
                  <option value="1">Détente et Bien-être</option>
                  <option value="2">Nourriture et oenologie</option>
                  <option value="3">Culture et Patrimoine</option>
                  <option value="4">Nature et Vie Sauvage</option>
                  <option value="5">Sport et Aventure</option>
                  <option value="6">Famille et Tribu</option>
                  <option value="7">Randonnée</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="field-group">
                <label>Prix (€)</label>
                <input v-model.number="newExcursion.prix" type="number" step="0.01">
              </div>
              <div class="field-group">
                <label>Durée (Jours)</label>
                <input v-model.number="newExcursion.duree" type="number">
              </div>
              <div class="field-group">
                <label>Nb Max Pers.</label>
                <input v-model.number="newExcursion.nbLimitPers" type="number">
              </div>
            </div>

            <div class="modal-buttons">
              <button type="submit" class="btn-save">
                {{ isEditing ? 'METTRE À JOUR' : 'ENREGISTRER' }}
              </button>
              
              <button type="button" @click="isModalOpen = false" class="btn-cancel">ANNULER</button>
            </div>
          </form>
        </div>
      </div>

      <div class="section-divider">
        <h2>LES EXCURSIONS :</h2>
        <div class="search-bar">
          <input type="text" v-model="searchQuery" placeholder="RECHERCHE">
          <span class="search-icon">🔍</span>
        </div>
      </div>
      <div class="cards-grid">
        <div 
          v-for="item in filteredExcursions" 
          :key="item.id" 
          class="card city-card" 
          :style="{ backgroundColor: item.color || '#4361ee' }"
          @click="openEditModal(item)"
        >
          {{ item.name }}
          <button class="delete-btn" @click.stop="handleDelete(item.id)">×</button>
        </div>
      </div>
    </section>
    </main>
  </div>
</template>
<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter();
const usersCount = ref(0);
const totalFavoritesCount = ref(0);
const topFavorites = ref([]);

const fetchStats = async () => {
  try {
    const response = await fetch(`${import.meta.env.VITE_API_URL}/api_admin_stats.php`);
    const data = await response.json();
    usersCount.value = data.usersCount;
    totalFavoritesCount.value = data.totalFavorites;
    topFavorites.value = data.topFavorites;
  } catch (error) {
    console.error("Erreur stats :", error);
  }
};

onMounted(() => {
  const userData = JSON.parse(localStorage.getItem('user'));
  if (!userData || !userData.isAdmin) {
    alert("Accès refusé. Vous n'êtes pas administrateur.");
    router.push('/');
  } else {
    fetchExcursions();
    fetchStats();
  }
});
const isEditing = ref(false);
const allExcursions = ref([]);
const searchQuery = ref('');

// 1. Charger les données depuis la DB
const fetchExcursions = async () => {
  try {
    const response = await fetch(`${import.meta.env.VITE_API_URL}/api_admin_excursions.php`);
    allExcursions.value = await response.json();
  } catch (error) {
    console.error("Erreur chargement admin :", error);
  }
};

// 2. Filtrer pour la section "Recent" (ex: les 3 dernières)
const recentExcursions = computed(() => {
  return allExcursions.value.slice(-3).reverse();
});

// 3. Logique de recherche
const filteredExcursions = computed(() => {
  return allExcursions.value.filter(excu => 
    excu.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});
const openCreateModal = () => {
  isEditing.value = false;
  newExcursion.value = { nom: '', image: '', desc: '', duree: 1, difficulte: 'Facile', nbLimitPers: 20, prix: 0, idCat: '' };
  isModalOpen.value = true;
};
const isModalOpen = ref(false);
const newExcursion = ref({
  nom: '',
  image: '',
  desc: '',
  duree: 1,
  difficulte: 'Facile',
  nbLimitPers: 20,
  prix: 0,
  idCat: '' 
});

const handleCreate = async () => {
  try {
    const response = await fetch(`${import.meta.env.VITE_API_URL}/api_create_excursion.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newExcursion.value)
    });
    const result = await response.json();
    if(result.success) {
      alert("Excursion ajoutée avec succès !");
      isModalOpen.value = false;
      fetchExcursions(); // Recharge la liste dynamique
    }
  } catch (error) {
    console.error("Erreur technique :", error);
  }
};
/* MODIF */
const openEditModal = (item) => {
  isEditing.value = true;
  isModalOpen.value = true;
  newExcursion.value = { 
    id: item.id, 
    nom: item.name, 
    image: item.image || '', 
    desc: item.desc || '', 
    duree: item.duree || 1, 
    difficulte: item.difficulte || 'Facile', 
    nbLimitPers: item.nbLimitPers || 20, 
    prix: item.prix || 0, 
    idCat: item.idCat || '' 
  };
  isModalOpen.value = true;
};
// Suppression
const handleDelete = async (id) => {
  if (confirm("Supprimer définitivement cette excursion ?")) {
    try {
      const response = await fetch(`http://localhost:8000/api_delete_excursion.php?id=${id}`, { method: 'DELETE' });
      const result = await response.json();
      if (result.success) {
        fetchExcursions();
      }
    } catch (error) {
      console.error("Erreur suppression:", error);
    }
  }
};

const currentSection = ref('excursions'); // 'dashboard', 'excursions', 'utilisateurs'
const users = ref([]);

const showUsers = async () => {
  currentSection.value = 'utilisateurs';
  const response = await fetch(`${import.meta.env.VITE_API_URL}/api_admin_users.php`);
  users.value = await response.json();
};
onMounted(fetchExcursions);
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
/* --- MODAL DE CRÉATION DU FORMULAIRE--- */
/* --- OVERLAY (Le fond sombre derrière le formulaire) --- */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6); /* Fond semi-transparent */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 2000; /* Doit être au-dessus de tout le reste */
  backdrop-filter: blur(4px); /* Effet de flou sur le fond */
}

/* --- LE CONTENEUR DU FORMULAIRE --- */
.modal-content {
  background: white;
  padding: 30px;
  border-radius: 15px;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  font-family: 'Lora', serif; /* Harmonisation avec le reste du site */
}

.modal-content h3 {
  color: #f1768a; /* Rose de ton thème */
  margin-top: 0;
  margin-bottom: 20px;
  text-align: center;
  font-size: 1.5rem;
}

/* --- STRUCTURE DU FORMULAIRE --- */
.creation-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.field-group {
  display: flex;
  flex-direction: column;
  text-align: left;
}

.field-group label {
  font-size: 0.85rem;
  color: #ff85a1;
  font-weight: bold;
  margin-bottom: 5px;
  text-transform: uppercase;
}

/* --- INPUTS, SELECT ET TEXTAREA --- */
.field-group input, 
.field-group select, 
.field-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 0.95rem;
  box-sizing: border-box; /* Évite que l'input dépasse */
  font-family: Arial, sans-serif;
}

.field-group input:focus, 
.field-group textarea:focus {
  outline: none;
  border-color: #f1768a;
  box-shadow: 0 0 5px rgba(241, 118, 138, 0.3);
}

/* --- LIGNES AVEC PLUSIEURS CHAMPS --- */
.form-row {
  display: flex;
  gap: 10px;
}

.form-row .field-group {
  flex: 1; /* Les colonnes prennent la même largeur */
}

/* --- BOUTONS D'ACTION --- */
.modal-buttons {
  display: flex;
  gap: 15px;
  margin-top: 10px;
}

.btn-save {
  flex: 2;
  background-color: #4361ee !important; /* Ton bleu admin */
  color: white;
  border: none;
  padding: 12px;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s;
}

.btn-save:hover {
  background-color: #304cc2 !important;
}

.btn-cancel {
  flex: 1;
  background-color: #ccc !important;
  color: white;
  border: none;
  padding: 12px;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s;
}

.btn-cancel:hover {
  background-color: #999 !important;
}
/* --- BOUTON SUPPRESSION --- */
.city-card {
  position: relative;
  cursor: pointer;
  transition: transform 0.2s;
}

.city-card:hover {
  transform: scale(1.05);
}

.delete-btn {
  position: absolute;
  top: 5px;
  right: 5px;
  background: rgba(255, 255, 255, 0.3);
  border: none;
  color: white;
  border-radius: 50%;
  width: 25px;
  height: 25px;
  cursor: pointer;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
}

.delete-btn:hover {
  background: red;
}
/* --- CONTENEUR DU DASHBOARD --- */
.dashboard-container {
  padding: 30px;
  background-color: #fff;
  border-radius: 15px;
  margin: 20px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

/* --- GRILLE DES COMPTEURS --- */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 40px;
}

.stat-box {
  background: linear-gradient(135deg, #ff85a1 0%, #f1768a 100%);
  color: white;
  padding: 25px;
  border-radius: 12px;
  text-align: center;
  transition: transform 0.3s ease;
}

.stat-box:hover {
  transform: translateY(-5px);
}

.stat-box h4 {
  font-size: 2.5rem;
  margin: 0;
  font-family: 'Lora', serif;
}

.stat-box p {
  margin: 5px 0 0;
  text-transform: uppercase;
  font-size: 0.8rem;
  letter-spacing: 1px;
  opacity: 0.9;
}

/* --- CLASSEMENT TOP FAVORIS --- */
.top-ranking {
  background-color: #fdf2f2;
  padding: 25px;
  border-radius: 12px;
  border: 1px solid #ffe1e1;
}

.top-ranking h3 {
  color: #9e073a;
  font-family: 'Lora', serif;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.top-ranking ul {
  list-style: none;
  padding: 0;
}

.top-ranking li {
  background: white;
  margin-bottom: 10px;
  padding: 15px 20px;
  border-radius: 8px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 2px 5px rgba(0,0,0,0.02);
  border-left: 5px solid #4361ee; /* Bleu pour rappeler le côté admin */
}

.top-ranking li:first-child {
  border-left-color: #ff85a1; /* Rose pour le numéro 1 */
  font-weight: bold;
}
.kpi-section {
  padding: 20px;
  background-color: #fff;
  margin-bottom: 20px;
  border-bottom: 1px solid #eee;
}

.stats-grid-top {
  display: flex;
  justify-content: space-around;
  gap: 20px;
}

.kpi-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 15px 30px;
  background: white;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  border-bottom: 4px solid #f1768a; /* Petite barre rose en bas */
  min-width: 150px;
}

.kpi-label {
  font-size: 0.75rem;
  color: #888;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.kpi-value {
  font-size: 1.8rem;
  font-weight: bold;
  color: #333;
  font-family: 'Lora', serif;
}
/* --- BADGES RÔLES UTILISATEURS --- */
.user-table-container {
  background: white;
  margin: 20px;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.admin-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}

.admin-table th {
  padding: 12px;
  border-bottom: 2px solid #ff85a1;
  color: #f1768a;
  font-size: 0.9rem;
}

.admin-table td {
  padding: 15px 12px;
  border-bottom: 1px solid #eee;
  font-size: 0.9rem;
}

.badge-admin {
  background: #4361ee;
  color: white;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 0.75rem;
}

.badge-user {
  background: #f1768a;
  color: white;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 0.75rem;
}
/* À ajouter dans CRUDView.vue */
@media (max-width: 1024px) {
  .admin-layout {
    flex-direction: column;
  }
  .sidebar {
    width: 100%;
    height: auto;
    flex-direction: row;
    justify-content: space-around;
    padding: 10px;
  }
  .admin-profile {
    display: none; /* On cache le profil pour gagner de la place */
  }
  .admin-nav {
    display: flex;
    gap: 10px;
  }
  .cards-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 colonnes au lieu de 4 */
  }
  .stats-grid-top {
    flex-direction: column;
    align-items: center;
  }
  .kpi-card {
    width: 90%;
    margin-bottom: 10px;
  }
}

@media (max-width: 600px) {
  .cards-grid {
    grid-template-columns: 1fr; /* 1 seule colonne sur petit téléphone */
  }
  .admin-table {
    display: block;
    overflow-x: auto; /* Permet de scroller le tableau horizontalement */
  }
}
</style>