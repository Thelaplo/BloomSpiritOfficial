<template>
  <div class="map-container">

    <l-map
      :zoom="initialZoom"
      :center="initialCenter"
      :minZoom="minZoom"
      :maxBounds="japanBounds"
      :maxBoundsViscosity="1.0"
    >
      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      />
    </l-map>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { LMap, LTileLayer } from '@vue-leaflet/vue-leaflet';
import 'leaflet/dist/leaflet.css'; // Don't forget the required CSS import

// 1. Define Map Center and Zoom
// Approximate center of Japan
const initialCenter = ref([36.2048, 138.2529]);
const initialZoom = ref(6);
// Prevent users from zooming out past a reasonable country view
const minZoom = ref(5); 

// 2. Define the Bounding Box for Japan (The Restriction)
// This is the crucial part that prevents panning/zooming away from Japan.
// Format: [[SouthWest Lat, SouthWest Lng], [NorthEast Lat, NorthEast Lng]]
const japanBounds = ref([
  [26.0, 127.0], // Southwest corner (Near Taiwan/Philippines)
  [46.25, 150.57]  // Northeast corner (Near Russia/Kurils)
]);
</script>

<style scoped>
/* 3. Define the Map Height */
/* It is crucial for Leaflet to know the height of its container. */
.map-container {
  width: 100%;
  position: center;
  height: 600px; /* Adjust this value as needed */
  border: 1px solid #ccc;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Ensure the LMap component fills its container */
.l-map {
  width: 100%;
  height: 100%;
}
</style>