<template>
  <div class="destination-cards-container">
    
    <div 
      v-for="city in cities" 
      :key="city.id" 
      class="destination-card"
      :style="{ backgroundImage: `url(${city.image})` }"
    >
      <div class="city-overlay">
        <span class="event-tag">Incontournable</span>
        <div class="city-title">{{ city.name }}</div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue';

const cities = ref([
  { id: 1, name: 'Tokyo', image: '/img/tokyo.jpg' },
  { id: 2, name: 'Kyoto', image: '/img/kyoto.jpg' },
  { id: 3, name: 'Okinawa', image: '/img/nara.jpg' } // Tu peux changer pour okinawa.jpg si tu l'as
]);
</script>

<style scoped>
/* 1. LE CONTENEUR */
.destination-cards-container {
  display: flex;
  justify-content: center;
  gap: 25px;
  flex-wrap: wrap;
  padding: 40px 20px;
}

/* 2. LA CARTE (Design identique aux events) */
.destination-card {
  width: 320px;
  height: 480px;
  border-radius: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  background-size: cover;
  background-position: center;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.destination-card:hover {
    transform: translateY(-10px);
}

/* 3. L'OVERLAY (Dégradé rose premium) */
.city-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 50px 20px 25px;
  color: white;
  text-align: left;
  /* On utilise le dégradé rose de tes cartes events */
  background: linear-gradient(to top, 
    rgba(233, 30, 99, 0.9) 0%, 
    rgba(233, 30, 99, 0.3) 60%, 
    transparent 100%);
}

/* 4. LE TEXTE (Police Lora et Italique) */
.event-tag {
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: block;
  margin-bottom: 5px;
  opacity: 0.9;
}

.city-title {
  font-size: 2.2rem; /* Légèrement plus grand pour les villes */
  font-weight: bold;
  font-family: 'Lora', serif; /* Applique la police premium */
  font-style: italic; /* L'effet stylé des events */
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .destination-cards-container {
    flex-direction: column;
    align-items: center;
  }
  .destination-card {
    width: 90%;
    max-width: 400px;
    height: 350px;
  }
}
</style>