<template>
  <div class="profil-page">
    <TheHeader />

    <main class="profil-content">
      <section id="infos" class="profile-section">
        <div class="section-card">
          <h2>MES INFORMATIONS</h2>
          <form @submit.prevent="updateUserInfo" class="info-form">
            <div class="form-grid">
              <div class="input-group">
                <label>Email (Login)</label>
                <input v-model="user.login" type="email" disabled class="disabled-input">
              </div>
              <div class="input-group">
                <label>Nom</label>
                <input v-model="user.nom" type="text" placeholder="Votre nom">
              </div>
              <div class="input-group">
                <label>Prénom</label>
                <input v-model="user.prenom" type="text" placeholder="Votre prénom">
              </div>
              <div class="input-group">
                <label>Téléphone</label>
                <input v-model="user.tel" type="tel" placeholder="06 .. .. .. ..">
              </div>
              <div class="input-group full-width">
                <label>Nouveau Mot de Passe (Optionnel)</label>
                <input v-model="newPassword" type="password" placeholder="Laissez vide pour conserver l'ancien">
              </div>
            </div>
            <button type="submit" class="btn-update">ENREGISTRER LES MODIFICATIONS</button>
          </form>
        </div>
      </section>

      <section id="favoris" class="profile-section">
        <div class="section-card">
          <h2>MES FAVORIS 💓</h2>
          
          <div v-if="favorites.length > 0" class="favorites-grid">
            <div v-for="item in favorites" :key="item.id" class="favorite-item">
              <router-link :to="'/detail/' + item.id" class="fav-link">
                <div class="fav-image" :style="{ backgroundImage: `url('/public/img/${item.image}')` }"></div>
                <div class="fav-info">
                  <h3>{{ item.nom }}</h3>
                  <p>{{ item.duree }} jours • {{ item.prix }}€</p>
                </div>
              </router-link>
              <button @click="removeFav(item.id)" class="btn-remove">RETIRER</button>
            </div>
          </div>

          <div v-else class="no-favorites">
            <p>Aucun favori pour le moment.</p>
            <router-link to="/" class="btn-explore">DÉCOUVRIR LES EXCURSIONS</router-link>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import TheHeader from '@/components/TheHeader.vue';

export default {
  components: { TheHeader },
  data() {
    return {
      user: JSON.parse(localStorage.getItem('user') || '{}'),
      newPassword: '',
      favorites: []
    };
  },
  mounted() {
    this.loadFavorites();
    if (this.$route.hash === '#favoris') {
      this.scrollToFavoris();
    }
  },
  methods: {
    async loadFavorites() {
      if (!this.user.login) return;
      try {
        const response = await fetch(`http://localhost:8000/api_get_favoris.php?login=${this.user.login}`);
        this.favorites = await response.json();
      } catch (e) { console.error(e); }
    },
    async updateUserInfo() {
      // API à créer pour mettre à jour nom, prenom, tel, mdp
      const payload = { ...this.user, newPassword: this.newPassword };
      console.log("Mise à jour :", payload);
      alert("Profil mis à jour !");
    },
    async removeFav(id) {
      await fetch('http://localhost:8000/api_toggle_favoris.php', {
        method: 'POST',
        body: JSON.stringify({ login: this.user.login, idExcursion: id })
      });
      this.loadFavorites();
    },
    scrollToFavoris() {
      setTimeout(() => {
        const el = document.getElementById('favoris');
        if (el) el.scrollIntoView({ behavior: 'smooth' });
      }, 300);
    }
  }
};
</script>

<style scoped>
.profil-page { padding-top: 40px; background-color: #fcf1f3; min-height: 100vh; font-family: 'Judson', serif; }
.profil-content { padding: 40px 10%; display: flex; flex-direction: column; gap: 40px; }
.section-card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.full-width { grid-column: span 2; }

.input-group label { color: #f1768a; font-weight: bold; margin-bottom: 5px; display: block; }
.input-group input { width: 100%; padding: 12px; border: 1px solid #ffcad4; border-radius: 8px; box-sizing: border-box; }
.btn-update { margin-top: 20px; background: #f1768a; color: white; border: none; padding: 15px; border-radius: 8px; width: 100%; cursor: pointer; font-weight: bold; }

.favorites-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; margin-top: 20px; }
.favorite-item { border-radius: 10px; overflow: hidden; border: 1px solid #fce4ec; transition: 0.3s; }
.fav-image { height: 150px; background-size: cover; background-position: center; }
.fav-info { padding: 15px; text-align: center; }
.btn-remove { width: 100%; background: #4361ee; color: white; border: none; padding: 8px; cursor: pointer; }
/* --- RESPONSIVE DESIGN --- */

/* Pour les tablettes (moins de 992px) */
@media (max-width: 992px) {
  .profil-content {
    padding: 20px 5%; /* On réduit les marges sur les côtés */
    gap: 30px;
  }
}

/* Pour les mobiles (moins de 768px) */
@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr; /* Le formulaire passe sur une seule colonne */
  }

  .full-width {
    grid-column: span 1; /* Les champs larges s'adaptent */
  }

  .favorites-grid {
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); /* Cartes plus petites */
    gap: 15px;
  }

  .section-card {
    padding: 20px; /* Moins d'espace interne */
  }

  h2 {
    font-size: 1.2rem;
  }
}

/* Pour les petits téléphones (moins de 480px) */
@media (max-width: 480px) {
  .favorites-grid {
    grid-template-columns: 1fr; /* Une seule carte par ligne */
  }
  
  .fav-image {
    height: 180px; /* On redonne de la hauteur à l'image */
  }
}
</style>