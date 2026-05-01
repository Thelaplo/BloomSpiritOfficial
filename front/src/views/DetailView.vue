<template>
  <div class="detail-page-container" v-if="excursion.id">
    <header class="header-container">
      <TheHeader />
      <div class="summary-info-block">
          <h1>Histoire de {{ excursion.title }} :</h1>
          <p class="header-description-text">
            {{ excursion.description }}
          </p>

          <div class="sidebar">
            <h1> </h1>
          </div>

          <div class="trip-summary-card">
              <h2>Promenade à {{ excursion.title }}</h2>
            <div class="details-row">
              <p>Durée estimée : {{ excursion.duration }} jours</p>
              <p class="price-info">À partir de {{ formatCurrency(excursion.price) }} / p</p>
            </div>
          <div class="action-buttons">
            <button class="contact-button" @click="contactAgency">
            Contacter l'agence
            </button>

          <button class="favorite-button" @click="toggleFavorite">
            {{ isFavorite ? '💓' : '♡' }} ajouter aux favoris
          </button>
      </div>
          </div>
      </div>

      <div class="hero-image-absolute" :style="{ backgroundImage: `url(${excursion.imageUrl})` }">
        <div class="japanese-title">{{ getJapaneseTitle(excursion.title) }}</div>
      </div>
    </header>

    <div class="content-wrapper">
      <div class="main-info-column">
        <section class="itinerary-section timeline-section">
            <ul class="itinerary-timeline">
                <li v-for="(etape, index) in excursion.etapes" :key="index">
                    <div class="step-alternating-content">
                        <span class="step-label">Jour {{ etape.day }} - {{ etape.label }}</span>
                        <img src="/public/img/rondRose.png" alt="Etape" class="timeline-dot-img">
                    </div>
                </li>
            </ul>
        </section>
      </div>
      
      <!-- <div class="side-info-column">
          <div class="side-info-block pink-block">
              <h3>Détails</h3>
              <p>Type : {{ excursion.difficulte }}</p> <p>Durée : {{ excursion.duration }} jours</p>
          </div>
      </div> -->
    </div>
  </div>
  <!-- <div v-else class="loading-message">Chargement de l'excursion...</div>
        <section class="map-section">
            <h2>Localisation de la Région</h2>
            
            <img :src="excursion.mapImageUrl" 
                alt="Carte de la région de {{ excursion.nom }}" 
                class="region-map-image">
                
            <p class="map-note">Zoom sur la Region </p>
        </section> -->

 
      

</template>
<script>
import TheHeader from '@/components/TheHeader.vue';
import { h } from 'vue';

export default {
  components: {
    TheHeader
  },
  data() {
    return {
      excursion: {},   // Contient les données de l'API
      isFavorite: false // État du bouton coeur (pour le changement visuel)
    };
  },
  watch: {
    '$route.params.id': {
      immediate: true, 
      handler(newId) {
        this.loadExcursion(newId);
      }
    }
  },
 methods: {
    async loadExcursion(id) {
      try {
        const response = await fetch(`${import.meta.env.VITE_API_URL}/api_detail.php?id=${id}`);
        this.excursion = await response.json();

        const userData = JSON.parse(localStorage.getItem('user'));
        if (userData && id) {
            // Force la conversion en nombre de l'ID passé à l'API
            this.checkIfFavorite(userData.login, Number(id));
        }
      } catch (error) {
        console.error("Erreur chargement :", error);
      }
    },
    
    formatCurrency(value) {
      if (!value) return "0,00 €";
      return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(value);
    },
    getJapaneseTitle(nom) {
    if (!nom) return "";
    const map = { 
        'Torii Miyajima': '宮島', 
        'Nara': '奈良', 
        'Shirakawa-go': '白川郷',
        'Chute de Nachi': '那智滝',
        'Miyako-jima': '宮古島',
        'Taikodani Inari-jinja': '太鼓谷',
        'Kumejima': '久米島',
        'Shirakawa-go (Hiver)': '白川郷',
        'Alpes Japonaises': '日本ア',
        'Le Japon sous la neige': '雪',
        'Trésors du Japon': '宝',
        'L\'archipel aux trésors': '島'
    };

    return map[nom] || nom.charAt(0);
    },

    // --- LES NOUVELLES MÉTHODES POUR TES BOUTONS ---
    contactAgency() {
      // Ouvre le client mail de l'utilisateur avec un sujet pré-rempli
      const subject = `Demande d'information : ${this.excursion.title}`;
      window.location.href = `mailto:contact@bloomspirit.com?subject=${encodeURIComponent(subject)}`;
    },

    async toggleFavorite() {
      const userStr = localStorage.getItem('user');
      if (!userStr) {
        alert("Connectez-vous pour ajouter des favoris !");
        return;
      }
      const userData = JSON.parse(userStr);

      // On récupère l'ID directement depuis la route pour éviter les erreurs de mapping
      const excursionId = Number(this.$route.params.id); 

      if (!excursionId) {
        console.error("ID excursion introuvable");
        return;
      }
      const idToSend = Number(this.excursion.id || this.$route.params.id);

      const payload = {
        login: userData.login,
        idExcursion: idToSend // Vérifie que c'est bien "idExcursion" ici
      };

      try {
        const response = await fetch(`${import.meta.env.VITE_API_URL}/api_toggle_favoris.php`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            login: userData.login,
            idExcursion: excursionId // Envoie bien l'ID en nombre
          })
        });
        
        const result = await response.json();
        
        // Ton PHP renvoie "added" ou "removed"
        if (result.status === 'added') {
            this.isFavorite = true;
        } else if (result.status === 'removed') {
            this.isFavorite = false;
        }
      } catch (error) {
        console.error("Erreur technique favoris:", error);
      }
    },
    async checkIfFavorite(login, idExcursion) {
    // Tu peux créer une petite API api_check_favoris.php ou utiliser toggle avec un mode "check"
    // Pour l'instant, on peut aussi le faire via une requête simple
        const response = await fetch(`${import.meta.env.VITE_API_URL}api_check_favoris.php?login=${login}&idExcursion=${idExcursion}`);
        const result = await response.json();
        this.isFavorite = result.isFavorite;
    }
  }
}
</script>
<style scoped>
/* Variables pour un style cohérent */
:root {
  --primary-color: #e91e63; /* Rose profond */
  --secondary-color: #f7e6e9; /* Arrière-plan clair, comme dans Figma */
  --text-dark: #333;
}

.detail-page-container {
  font-family: Arial, sans-serif;
  background-color: var(--secondary-color);
  min-height: 100vh;
}
/* Mes Polices*/
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Amarnath:wght@400;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Judson:wght@400;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap');

/*-------------------Barre de Navigation-----------------------------*/ 
.header-top-bar {
  position: absolute;
  top: 5px;
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
  position: center;
  padding: auto;
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

/* ----------------------------------- */
/* Styles du Caractère Japonais (Pas de fond) */
/* ----------------------------------- */
.japanese-title {
  position: absolute;
  top: 155px; 
  left: -57px; 
  font-size: 100px; 
  max-width: 1%;
  
  background-color: transparent; 
  box-shadow: none; 
  
  color: #fb9bbb; 
  
  padding: 15px 10px;
  border-radius: 10px 0 0 10px; 
  z-index: 10; 
  line-height: 1;
  font-family:"Judson", serif;
}
/* ------------------------------------------- */
/* 1. HEADER / BANNER (Arrangement du Figma)  */
/* ------------------------------------------- */

.header-container {
  /* Le conteneur principal de l'en-tête */
  min-height: 400px; 
  background-color: #f7f6f6; 
  position: relative; 
  padding-bottom: 20px;
  min-height: 600px;
  max-width: 150%; 
  margin: 0 auto;
}

/* 1.1 Colonne de gauche (Texte / Résumé) */
.summary-info-block {
    width: 60%; 
    padding: 40px;
    padding-top: 95px; 
    position: relative; 
    z-index: 15;
    font-family: "Judson",serif;
}

.sidebar {

position: fixed; 
  right: 0;         
  top: 0;             
  width: 120px;      
  height: 100vh;     
  background-color: #FFC7D8;
  padding-top: 20px;
  display: flex;
  flex-direction: column;
  box-shadow: -2px 0 5px rgba(0,0,0,0.2); 
}

.summary-info-block h1 {
    font-size: 1.8em;
    width: 80%;
    margin-bottom: 5px;
    color: black; /* Plus foncé que le primary color */
}

/* 🔥 NOUVEAU STYLE : Texte de description dans le Header */
.header-description-text {
    font-size: 0.95em;
    line-height: 1.5;
    margin-bottom: 50px;
    max-width: 60%; /* Pour que le texte n'aille pas trop loin */
    font-family: "Judson", sans-serif;
}

/* 1.2 Image (Positionnée en ABSOLU à droite) */
.hero-image-absolute {
    position: absolute;
    top: 0;
    right: 0;
    width: 50%; 
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 5;
    border-radius: 0 0 0 50px; 
    box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1);
    justify-content: end;
    margin-right: 110px;
}



/* 1.4 Carte de résumé (Bloc d'information rose du Figma) */

.trip-summary-card {
    background-color: #FFC7D8; /* Rose clair */
    
    /* 🔥 CORRECTION CLÉ : Réduction de la largeur pour le rendre très vertical */
    width: 200px; /* Utiliser une largeur fixe (ex: 300px) est plus stable que 35% dans cette colonne */
    max-width: 50%; /* Sécurité pour les petits écrans */
    padding: 10px; /* Légèrement réduit pour un aspect plus compact */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-top: 10px;
    border: 1px solid #fafafa00;
    height: auto;
}

.trip-summary-card h2 {
    font-size: 20px;
    color: #9e073a;
    margin-bottom: 5px;
    text-align:left;
    padding-bottom: 5px;
    padding-right:50px;
    margin-left: 20px;;
    top:-10px;
    font-family: "Lora", serif;

}

.details-row p {
    margin: 5px 0;
    font-size: 17px;
    color:#f7f6f6;
    padding:10px;
    text-align:center;
}

.price-info {
    color: var(--primary-color);
    font-weight: bold;
    
}

/* ----------------------------------- */
/* Styles des Boutons d'Action (Petits Rectangles) */
/* ----------------------------------- */

.action-buttons {
   padding: 8px 12px; /* Remplissage réduit pour faire un petit rectangle */
    border-radius: 5px; /* Coins arrondis */
    font-size: 0.9em;
    font-weight: 500;
    width: auto; /* La largeur sera définie par le padding */
    text-align: center;
    padding-bottom: 5px;
    
}


/* Styles spécifiques au design Figma */
.favorite-button {
    /* Bouton Favoris (Texte) */
    background-color: transparent;
    border: 1px solid rgb(152, 41, 67);;
    color: rgb(152, 41, 67);
    border-radius: 5px;
    width: 170px; /* Prend juste la largeur nécessaire */
    margin: 0 auto; /* Centrer dans l'espace disponible */
    padding: 5px 0;
    cursor: pointer;
    transition: opacity 0.2s;
    
}

.contact-button {
    /* Bouton Contacter l'agence (Rectangle Rose) */
    background-color: rgb(152, 41, 67);
    border: 3px solid rgb(152, 41, 67);;
    color: rgb(247, 177, 177);
    border-radius: 5px;
    margin: 5px auto;
    width: 170px;
    cursor: pointer;
    transition: opacity 0.2s;
}

.contact-button:active, .favorite-button:active {
    transform: scale(0.95);
}



/* ------------------------------------------- */
/* 2. CORPS PRINCIPAL (Contenu sous la bannière) */
/* ------------------------------------------- */

.content-wrapper {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 5%;
  display: grid;
  grid-template-columns: 2fr 1fr; /* 2/3 pour le contenu, 1/3 pour la colonne latérale */
  gap: 40px;
}


/* ----------------------------------- */
/* TIMELINE : Base et Ligne Centrale */
/* ----------------------------------- */

.itinerary-section {
    background-color: white;
    padding: 30px; 
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
}

.itinerary-timeline {
    list-style: none;
    padding: 0;
    position: relative;
}

/* 1. La Ligne Verticale (Tracée au centre) */
.itinerary-timeline::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%; 
    width: 3px;
    background-color: #f095b3; 
    transform: translateX(-50%); 
    z-index: 1; 
}
.itinerary-timeline li:last-child::after {
    content: '';
    position: absolute;
    
    /* Place un grand rectangle BLANC au bas de la ligne centrale */
    left: 50%;
    bottom: -19px;
    width: 30px; /* Largeur suffisante pour masquer la ligne */
    height: 30px; /* Hauteur suffisante pour masquer le bas */
    
    /* 🔥 La couleur du fond de la SECTION ITINÉRAIRE est la clé */
    background-color: white; 
    
    transform: translateX(-50%);
    z-index: 10; /* Assure qu'il couvre la ligne */
}
/* 2. Style de chaque élément <li> (Structure pour l'alternance) */
.itinerary-timeline li {
    position: relative;
    margin-bottom: 40px; 
    padding: 0;
}

/* 3. Conteneur du Texte et de l'Image (Utilise la Grille) */
.step-alternating-content {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Division 50% / 50% */
    align-items: center;
    width: 100%;
    text-align: left;
    gap:10px;
   
}

/* Cible le conteneur du texte et du rond */
.step-content-container {
    display: flex;
    align-items: center; /* 🔥 LA CLÉ : Centre tous les éléments sur l'axe vertical */
    gap: 15px;
    /* D'autres styles de flex-direction sont appliqués aux étapes paires/impaires */
}

/* 4. L'Image PNG (Positionnement Absolu au centre) */
.timeline-dot-img {
    position: absolute;
    left: 50%; 
    top: 0;
    
    /* Centrage et dimensionnement de l'image */
    width: 25px; 
    height: 25px;
    transform: translate(-50%, -50%); 
    
    /* Pour que l'image couvre la ligne */
    z-index: 10; 
    border-radius: 50%; /* Si l'image n'est pas déjà un cercle parfait */
    border: 4px solid white; /* Bordure blanche pour couper la ligne */
}


/* 5. ALIGNEMENT ALTERNÉ : Styles des Labels */

.step-label {
    font-size: 20px;
    /* font-weight: bold; */
    color: var(--text-dark); 
    display: block; 
    padding-top: 0px; 
    position: relative;
    top:-10px;
    font-family:"Judson", serif;
}

/* Étapes Impaires (GAUCHE) */
.itinerary-timeline li:nth-child(odd) .step-label {
    grid-column: 1 / 2; /* Reste dans la colonne de gauche */
    text-align: right; /* Aligne le texte vers le centre */
    padding-right: 30px; /* Espace vers le rond */
}

/* Étapes Paires (DROITE) */
.itinerary-timeline li:nth-child(even) .step-label {
    grid-column: 2 / 3; /* Colonne de droite */
    text-align: left; /* Aligne le texte loin du centre */
    padding-left: 30px; /* Espace vers le rond */
}
/*--------------------------------------- */
/* -----FIN DE LA SECTION ITINERARY------- */
/*--------------------------------------- */
.section-number {
    position: absolute;
    top: 10px;
    left: 20px; 
    font-size: 1.2em;
    font-weight: bold;
    color: var(--primary-color);
}

.info-section h2, .itinerary-section h2 {
  color: var(--text-dark);
  font-size: 1.4em;
  margin-bottom: 10px;
}

.tags span {
    background-color: var(--primary-color);
    color: white;
    padding: 4px 8px;
    border-radius: 10px;
    font-size: 0.8em;
    margin-right: 5px;
    display: inline-block;
    margin-top: 10px;
}



/* Colonne Latérale (Side Info) */
.side-info-block {
    padding: 20px;
    background-color: pink;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

/* .pink-block {
    background-color: var(--secondary-color); 
    border: 1px solid #f9d8e1; 
    color: var(--text-dark);
} */

.pink-block h3 {
    color: var(--primary-color);
    margin-top: 0;
    border-bottom: 1px solid var(--primary-color);
    padding-bottom: 5px;
    margin-bottom: 10px;
    font-size: 1.2em;
}
/* ------------------------------------------- */
/* NOUVEAUX STYLES : SECTION CARTE (Map) */
/* ------------------------------------------- */

.map-section {
    background-color: white;
    padding: 30px; 
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    margin-top: 30px; /* Espace après la timeline */
}

.map-section h2 {
    font-family: 'Judson', serif; /* Exemple d'application d'une police spécifique */
    color: var(--primary-color);
    font-size: 1.4em;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.region-map-image {
    width: 100%; /* L'image prend toute la largeur du conteneur */
    max-height: auto;
    object-fit: cover; /* Assure que l'image couvre l'espace sans se déformer */
    border-radius: 8px;
    display: block;
}

.map-note {
    font-size: 0.85em;
    color: #666;
    margin-top: 10px;
    text-align: center;
}


/* Responsive */
@media (max-width: 900px) {
  .header-container {
    display: flex;
    flex-direction: column;
    min-height: auto;
  }
  .summary-info-block {
    width: 100%;
    padding: 80px 20px 20px;
  }
  .hero-image-absolute {
    position: relative; /* L'image reprend sa place dans le flux */
    width: 100%;
    height: 300px;
    margin-right: 0;
    border-radius: 20px;
  }
  .trip-summary-card {
    width: 100%;
    max-width: none;
    margin: 20px 0;
  }
  .content-wrapper {
    grid-template-columns: 1fr; /* Une seule colonne pour l'itinéraire */
  }
  .sidebar {
    display: none; /* On cache la barre rose latérale fixe sur mobile */
  }
  .step-alternating-content {
    grid-template-columns: 1fr;
    text-align: left !important;
    padding-left: 40px;
  }
  .itinerary-timeline::after {
    left: 20px; /* On déplace la ligne de l'itinéraire sur le côté */
  }
  .timeline-dot-img {
    left: 20px;
  }
}
</style>