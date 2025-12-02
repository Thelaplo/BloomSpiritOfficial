<template>
    <div class="destination-card tokyo-card">
          <div class="city-overlay">Tokyo</div>
    </div>
    <div class="destination-card kyoto-card">
          <div class="city-overlay">Kyoto</div>
    </div>

    <div class="destination-card okinawa-card">
          <div class="city-overlay">Okinawa</div>
    </div>

</template>
<script setup>
    const String = '';
</script>
<style>
/* ------------------ Section Populaire - Cartes ------------------ */
.destination-cards-container {
  display: flex;
  justify-content: center;
  gap: 25px;
  flex-wrap: wrap;
  padding: 0 20px;
}

.destination-card {
  width: 320px;
  height: 480px;
  border-radius: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  background-size: cover;
  background-position: center;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s;
}
.destination-card:hover {
    transform: translateY(-10px);
}


/* Images de fond pour chaque carte (VÉRIFIEZ LES CHEMINS !) */
.tokyo-card    { background-image: url('/public/img/tokyo.jpg'); }
.kyoto-card    { background-image: url('/public/img/kyoto.jpg'); }
.okinawa-card  { background-image: url('/public/img/nara.jpg'); } 


/* L'overlay contenant le nom de la ville et l'effet de couleur rose en bas */
.city-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 40px 20px 20px;
  color: white;
  font-size: 1.8em;
  font-weight: bold;
  text-align: left;

  /* Gradient pour simuler l'effet de vague/couleur */
  background: linear-gradient(
    to top,
    rgba(240, 98, 146, 0.8) 0%,
    rgba(240, 98, 146, 0.4) 40%,
    transparent 80%
  );

  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}


/* ------------------ Media Queries (pour le responsive) ------------------ */
@media (max-width: 1024px) {
  .destination-cards-container {
    gap: 15px;
  }
  .destination-card {
    width: 45%;
    height: 350px;
  }
}

@media (max-width: 768px) {
  .hero-image-container {
    height: 300px;
  }
  
  /* ❌ SUPPRIMÉ : Suppression de la classe .site-logo-center-image non utilisée */
  
  .carte-button-wrapper {
      width: 150px; /* Taille ajustée pour le mobile */
      height: 150px;
      top: 85%; /* Ajustement mobile du bouton */
  }

  .destination-cards-container {
    flex-direction: column;
    align-items: center;
  }
  .destination-card {
    width: 90%;
    max-width: 400px;
    height: 300px;
  }
}
</style>