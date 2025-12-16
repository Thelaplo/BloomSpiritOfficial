<template>
  <router-link :to="{ name: 'detail', params: { id: travel.id }}" class="travel-card-link">
    <div class="travel-card">
      
      <img :src="travel.imageUrl" :alt="travel.title" class="card-image">
      <div class="card-content">
        <h3 class="card-title">{{ travel.title }}</h3>
        <p class="card-details">
          {{ travel.duration }} jours à partir de 
          <span class="price">{{ formatCurrency(travel.price) }}</span>
        </p>
        <span class="card-link">voir plus</span>
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  props: {
    travel: {
      type: Object,
      required: true
    }
  },
  methods: {
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
/* Ajout d'un style pour retirer le soulignement du lien et étendre la zone de clic */
.travel-card-link {
    text-decoration: none;
    color: inherit;
    display: block; 
}
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
}

.card-content {
  padding: 15px;
  text-align: left;
}

.card-title {
  margin: 0 0 5px 0;
  font-size: 1.2em;
  color: #333;
}

.card-details {
  font-size: 0.9em;
  color: #666;
  margin: 0 0 10px 0;
}

.price {
  color: #e91e63;
  font-weight: bold;
  font-size: 1.1em;
}

.card-link {
  display: inline-block;
  color: #e91e63;
  font-weight: bold;
  text-decoration: none;
  border-bottom: 2px solid #f095b3;
}

.card-link:hover {
  border-bottom-color: #e91e63;
}
</style>