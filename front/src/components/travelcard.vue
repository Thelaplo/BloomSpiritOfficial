<template>
  <div class="travel-card">
    <img :src="travel.imageUrl" :alt="travel.title" class="card-image">
    <div class="card-content">
      <h3 class="card-title">{{ travel.title }}</h3>
      <p class="card-details">
        {{ travel.duration }} jours à partir de 
        <span class="price">{{ formatCurrency(travel.price) }}</span>
      </p>
      <a href="#" class="card-link">voir plus</a>
    </div>
  </div>
</template>

<script>
// On utilise l'Options API ici, ce qui est compatible avec le script de CarteView.vue
export default {
  // Déclare que ce composant accepte une prop nommée 'travel'
  props: {
    travel: {
      type: Object,
      required: true
    }
  },
  methods: {
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
/* Les styles sont déjà bons, je les laisse tels quels */
/* Styles de la carte (tirés du CSS précédent) */
.travel-card {
  background-color: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s;
  text-align: center;
}

.travel-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.card-image {
  width: 100%;
  height: 180px; 
  object-fit: cover;
  display: block;
}

.card-content {
  padding: 15px 10px;
}

.card-title {
  font-size: 1.1em;
  margin-bottom: 5px;
  font-weight: 600;
}

.card-details {
  font-size: 0.9em;
  color: #555;
  margin-bottom: 10px;
}

.price {
    font-weight: bold;
    color: #e91e63; /* Couleur principale */
}

.card-link {
  display: block;
  font-size: 0.85em;
  color: #e91e63;
  text-decoration: none;
  font-weight: 500;
}
</style>