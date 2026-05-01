<template>
  <div class="destination-card" :style="{ backgroundImage: `url(${event.image})` }">
    <div class="event-badge" v-if="event.badge">{{ event.badge }}</div>
    
    <div class="city-overlay">
      <span class="event-tag">{{ event.tag }}</span>
      <div class="event-title">{{ event.title }}</div>
      <p class="event-promo" v-if="event.promo">{{ event.promo }}</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  event: Object
});
</script>
<style scoped>
.destination-cards-container {
  display: flex;
  justify-content: center;
  gap: 25px;
  flex-wrap: wrap;
  padding: 40px 20px;
}

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

/* Images de fond */
.momiji-card  { background-image: url('/public/img/momiji.jpeg'); }
.sapporo-card { background-image: url('/public/img/sapporo.jpeg'); }
.onsen-card   { background-image: url('/public/img/onsen.jpeg'); }

/* --- Badge flottant --- */
.event-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background-color: #e91e63;
  color: white;
  padding: 5px 12px;
  border-radius: 50px;
  font-size: 0.7rem;
  font-weight: bold;
  text-transform: uppercase;
  z-index: 2;
}

/* --- Overlay avec dégradé --- */
.city-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 50px 20px 25px;
  color: white;
  text-align: left;
  background: linear-gradient(to top, 
    rgba(233, 30, 99, 0.9) 0%, 
    rgba(233, 30, 99, 0.3) 60%, 
    transparent 100%);
}

.event-tag {
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: block;
  margin-bottom: 5px;
}

.event-title {
  font-size: 1.8rem;
  font-weight: bold;
  font-family: 'Lora', serif;
  font-style: italic;
}

.event-promo {
  margin-top: 10px;
  font-size: 1rem;
  font-weight: 600;
  background: rgba(255, 255, 255, 0.2);
  display: inline-block;
  padding: 2px 8px;
  border-radius: 5px;
}
</style>