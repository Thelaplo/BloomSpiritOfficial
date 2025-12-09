<template>
  <div class="detail-page-container" v-if="voyage.id">
    
    <header class="header-container">
      <div class="header-top-bar">
          <nav class="top-nav-center">
             <router-link to="/" class="nav-rectangle-group">
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
      <div class="summary-info-block">
          
          
          
          <h1>Histoire de {{ voyage.title }} :</h1>
          
          <p class="header-description-text">
            {{ voyage.title }} est une grande ville portuaire et un centre économique majeur de l'Ouest du Japon. Elle est connue pour son architecture moderne, sa vie nocturne et la qualité de sa street food.
          </p>

          <div class="trip-summary-card">
            <div class="duree-estim"></div>
            <h2>Promenade à {{ voyage.title }}</h2>
            <div class="details-row">
              <p>Durée estimée : {{ voyage.duration }} jours</p>
              <p class="price-info">À partir de {{ formatCurrency(voyage.price) }} / p</p>
            </div>
            <div class="action-buttons">
              <button class="contact-button">Contacter l'agence</button>
              <button class="favorite-button">♡ ajouter aux favoris</button>
            </div>
          </div>
          
      </div>
      
      <div class="hero-image-absolute" :style="{ backgroundImage: 'url(' + voyage.imageUrl + ')' }">
          <div class="japanese-title">{{ getJapaneseTitle(voyage.title) }}</div>
      </div>
      
    </header>

    <div class="content-wrapper">
      
      <div class="main-info-column">
          
        <section class="itinerary-section timeline-section">
          <h2>Itinéraire Détaillé</h2>
          
          <ul class="itinerary-timeline">
              <li>
                  <span class="step-label">Jour 1 :</span>
                  <h3>Arrivée et transfert</h3>
                  <p>Installation, suivi d'un dîner traditionnel.</p>
              </li>
              <li>
                  <span class="step-label">Jour 2 :</span>
                  <h3>Balade au cœur de {{ voyage.title }}</h3>
                  <p>Exploration guidée des sites culturels et déjeuner inclus.</p>
              </li>
              <li>
                  <span class="step-label">Jour 3 :</span>
                  <h3>Musée Toyotomi Ishigaki</h3>
                  <p>Visite du musée et découverte de l'histoire locale.</p>
              </li>
          </ul>
        </section>

      </div>
      
      <div class="side-info-column">
          
          <div class="side-info-block pink-block">
              <h3>Prochaine date</h3>
              <p>Départ : Samedi 20 Mars</p>
              <p>Durée : {{ voyage.duration }} jours</p>
          </div>

          <div class="side-info-block pink-block reservation-block">
              <h3>Prix : {{ formatCurrency(voyage.price) }}</h3>
              <p>Réduction : <span>{{ formatCurrency(voyage.price * 0.2) }} EUR</span></p>
              <button class="reserve-button">Réserver maintenant</button>
          </div>
          
          <!-- <div class="side-info-block white-block contact-block">
              <h3>Contactez-nous</h3>
              <form @submit.prevent="submitContact">
                  <input type="text" placeholder="Nom Complet" required>
                  <input type="email" placeholder="Email" required>
                  <textarea placeholder="Votre message..."></textarea>
                  <button type="submit" class="submit-contact-button">Envoyer</button>
              </form>
          </div>
           -->
      </div>
    </div>
  </div>
   <div v-else class="loading-message">
        Chargement des détails du voyage... (ou voyage non trouvé)
    </div>
</template>
<script>
import { voyages } from '../data.js';

export default {
  data() {
    return {
      voyage: {}
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
      const voyageId = parseInt(this.$route.params.id);
      const foundVoyage = voyages.find(v => v.id === voyageId);

      if (foundVoyage) {
        this.voyage = foundVoyage;
      } else {
        this.voyage = {}; 
        // Si non trouvé, on pourrait rediriger: this.$router.push({ name: 'carte' });
      }
    },
    
    // Méthode pour formater le prix en Euro
    formatCurrency(value) {
      return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 0
      }).format(value);
    },
    
    // NOUVELLE MÉTHODE : Pour afficher le caractère japonais (Emoji simple pour la démo)
    getJapaneseTitle(title) {
        // Mappage simple des titres aux caractères japonais/emojis correspondants
        const map = {
            'Torii Miyajima': '宮島', // 🔥 CARACTÈRE CORRECT
            'Shirakawa-go': '白川郷',
            'Chute de Nachi': '那智',
            'Nara': '奈良',
            'Miyako-jima': '宮古島',
            'Osaka': '大阪',
            'Kyoto': '京都',
            'Tokyo': '東京'
        };
        const simpleTitle = title.split(' ')[0];
        return map[title] || map[simpleTitle] || title.charAt(0);
    },
    
    submitContact() {
        // Logique de soumission du formulaire ici
        alert("Formulaire de contact envoyé (Simulation)!");
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
    top: 150px; 
    left: -20px; 
    font-size: 2.5em; 
    
    /* 🔥 CORRECTION CLÉ : Retirer le fond blanc et l'ombrage */
    background-color: transparent; 
    box-shadow: none; 
    
    color: var(--primary-color); /* La couleur du caractère */
    
    padding: 15px 10px;
    border-radius: 10px 0 0 10px; 
    z-index: 10; 
    line-height: 1;
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
  min-height: 500px;
  max-width: 120%; 
  margin: 0 auto;
}

/* 1.1 Colonne de gauche (Texte / Résumé) */
.summary-info-block {
    width: 60%; 
    padding: 40px;
    padding-top: 60px; 
    position: relative; 
    z-index: 10;
}

.summary-info-block h1 {
    font-size: 1.8em;
    width: 80%;
    margin-bottom: 5px;
    color: var(--text-dark); /* Plus foncé que le primary color */
}

/* 🔥 NOUVEAU STYLE : Texte de description dans le Header */
.header-description-text {
    font-size: 0.95em;
    line-height: 1.5;
    margin-bottom: 50px;
    max-width: 70%; /* Pour que le texte n'aille pas trop loin */
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
}

/* 1.3 Caractère Japonais (inchangé) */
.japanese-title {
    position: absolute;
    top: 150px; 
    left: -57px; 
    font-size: 100px; 
    max-width: 1%;
    
    /* 🔥 CORRECTION CLÉ : Retirer le fond blanc et l'ombrage */
    background-color: transparent; 
    box-shadow: none; 
    
    color: #fb9bbb; /* La couleur du caractère */
    
    padding: 15px 10px;
    border-radius: 10px 0 0 10px; 
    z-index: 10; 
    line-height: 1;
}

/* 1.4 Carte de résumé (Bloc d'information rose du Figma) */

.trip-summary-card {
    background-color: #FFC7D8; /* Rose clair */
    
    /* 🔥 CORRECTION CLÉ : Réduction de la largeur pour le rendre très vertical */
    width: 200px; /* Utiliser une largeur fixe (ex: 300px) est plus stable que 35% dans cette colonne */
    max-width: 50%; /* Sécurité pour les petits écrans */
    padding: 20px; /* Légèrement réduit pour un aspect plus compact */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-top: 10px;
    border: 1px solid #fafafa00;
    height: auto;
}

.trip-summary-card h2 {
    font-size: 1.2em;
    color: #f96b9b;
    margin-bottom: 5px;
    text-align:left;
    padding-bottom: 5px;
}

.details-row p {
    margin: 5px 0;
    font-size: 0.9em;
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
    border: none; /* Retrait de la bordure */
    color: var(--primary-color);
    width: fit-content; /* Prend juste la largeur nécessaire */
    margin: 0 auto; /* Centrer dans l'espace disponible */
    padding: 5px 0;
}

.contact-button {
    /* Bouton Contacter l'agence (Rectangle Rose) */
    background-color: rgb(209, 118, 144);
    border: 3px solid rgb(209, 118, 144);;
    color: rgb(129, 55, 55);
    border-radius: 5px;
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

/* Sections d'information principales (gauche) */
.info-section, .itinerary-section {
    position: relative;
    background-color: white;
    padding: 20px;
    padding-left: 60px; /* Espace pour le numéro de section */
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
}

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

/* Itinéraire Détaillé (Les étapes) */
.itinerary-steps {
    list-style: none;
    padding: 0;
    counter-reset: step-counter; /* Initialiser le compteur */
}

.itinerary-steps li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 15px;
    line-height: 1.5;
}

.itinerary-steps li h3 {
    font-size: 1em;
    color: var(--primary-color);
    margin: 0;
}

.itinerary-steps li::before {
    content: counter(step-counter);
    counter-increment: step-counter;
    position: absolute;
    left: 0;
    top: 0;
    background-color: var(--primary-color);
    color: white;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    text-align: center;
    font-size: 0.8em;
    line-height: 20px;
    font-weight: bold;
}

/* Colonne Latérale (Side Info) */
.side-info-block {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

.pink-block {
    background-color: var(--secondary-color); 
    border: 1px solid #f9d8e1; 
    color: var(--text-dark);
}

.pink-block h3 {
    color: var(--primary-color);
    margin-top: 0;
    border-bottom: 1px solid var(--primary-color);
    padding-bottom: 5px;
    margin-bottom: 10px;
    font-size: 1.2em;
}

.reservation-block span {
    color: #008000; 
    font-weight: bold;
}

.reserve-button {
    background-color: var(--primary-color);
    color: white;
    border: none;
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

/* Bloc Contact (Formulaire) */
.contact-block {
    background-color: white;
}

.contact-block form input,
.contact-block form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; 
    font-size: 0.9em;
}

.contact-block form textarea {
    resize: vertical;
    min-height: 80px;
}

.submit-contact-button {
    background-color: var(--primary-color);
    color: white;
    border: none;
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

/* Responsive */
@media (max-width: 900px) {
  .content-wrapper {
    grid-template-columns: 1fr;
  }
  
  .trip-summary-card {
    top: 50px;
    left: 20px;
    right: 20px;
    width: auto;
  }
  
  .japanese-title {
    display: none; 
  }
  
  .detail-hero-header {
      height: 600px; 
  }
}
</style>