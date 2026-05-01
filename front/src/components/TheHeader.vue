<template>
    <div class="header-top-bar">
        <nav class="nav-rectangle-group">
            <router-link to="/" class="nav-link">Excursion</router-link>
            <span class="separator">|</span>
            <router-link to="/carte" class="nav-link">Carte</router-link>
            <span class="separator">|</span>
            <router-link to="/contact" class="nav-link"></router-link>
                <a :href="mailToLink" class="nav-link">Contactez-nous</a>
        </nav>

        <router-link to="/" class="logo-link">
            <img src="/public/img/BloomSpirit.png" alt="Bloom Spirit Logo" class="site-logo">
        </router-link>

        <div class="account-section" v-click-outside="closeMenu">
            <span v-if="isLoggedIn" class="user-name">{{ userName }}</span>
            
            <div class="dropdown-wrapper">
                <div @click="toggleMenu" class="account-logo-trigger">
                    <img src="/public/img/Compte.png" alt="Compte" class="account-logo">
                </div>

                <transition name="fade">
                    <div v-if="isMenuOpen" class="dropdown-menu">
                        <template v-if="isLoggedIn">
                            <router-link to="/profil" class="dropdown-item">Mon profil</router-link>
                            <router-link :to="{ path: '/profil', hash: '#favoris' }" class="dropdown-item">
                                Mes Favoris
                            </router-link>
                            <router-link v-if="isAdmin" to="/crud" class="dropdown-item admin-link">
                                ⚙️ Administration
                            </router-link>
                            <hr>
                            <button @click="handleLogout" class="dropdown-item logout">Déconnexion</button>
                        </template>
                        <template v-else>
                            <router-link to="/login" class="dropdown-item">Se connecter</router-link>
                            <router-link to="/inscription" class="dropdown-item">S'inscrire</router-link>
                        </template>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const isLoggedIn = ref(false);
const isAdmin = ref(false); // Ajout de l'état admin
const isMenuOpen = ref(false);
const userName = ref('');

onMounted(() => {
    const userData = localStorage.getItem('user');
    if (userData) {
        const user = JSON.parse(userData);
        isLoggedIn.value = true;
        isAdmin.value = user.isAdmin === true || user.isAdmin === 1; 
        userName.value = user.login.split('@')[0];
    }
});

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
    isMenuOpen.value = false;
};

const handleLogout = () => {
    localStorage.removeItem('user');
    window.location.href = '/'; 
};

// Définit le lien mailto avec un sujet et un corps de message par défaut
const mailToLink = "mailto:contact@bloomspirit.com?subject=Demande d'information - Bloom Spirit&body=Bonjour, je souhaiterais obtenir des informations sur vos excursions au Japon...";
</script>


<style scoped>
.header-top-bar {
  position: absolute;
  top: 25px;
  left: 0;   /* On part bien du bord gauche */
  right: 0;  /* Jusqu'au bord droit */
  padding: 0 30px; /* On met l'espace à l'intérieur */
  
  display: flex;
  justify-content: space-between; 
  align-items: center;
  z-index: 100;
}
.logo-link {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}

.account-section {
    display: flex; align-items: center; gap: 10px; position: relative;
}

.user-name {
    color: rgb(203, 71, 93); font-weight: bold; font-family: 'Lora', serif;
}

.account-logo-trigger { cursor: pointer; }
.site-logo, .account-logo { height: 45px; width: auto; }

/* STYLE DU MENU DÉROULANT */
.dropdown-wrapper { position: relative; }

.dropdown-menu {
    position: absolute;
    top: 55px; right: 0;
    background: white;
    border: 1px solid rgb(225, 161, 161);
    border-radius: 10px;
    width: 180px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    display: flex; flex-direction: column;
    overflow: hidden;
    z-index: 101;
}

.dropdown-item {
    padding: 12px 15px;
    text-decoration: none;
    color: #333;
    font-size: 0.9rem;
    font-family: 'Lora', serif;
    text-align: left;
    background: none; border: none; width: 100%; cursor: pointer;
}

.dropdown-item:hover { background-color: #fbe6ec; color: rgb(203, 71, 93); }
.logout { color: #e91e63; font-weight: bold; border-top: 1px solid #eee; }

/* Animation */
.fade-enter-active, .fade-leave-active { transition: opacity 0.2s; }
.fade-enter-from, .fade-leave-to { opacity: 0; }

/* Styles Navigation existants */
.nav-rectangle-group {
  display: flex; align-items: center; padding: 8px 20px;
  border: 2px solid rgb(225, 161, 161); border-radius: 25px;
  background-color: rgba(203, 147, 175, 0.616);
}
.nav-link { color: rgb(203, 71, 93); text-decoration: none; font-weight: 500; }
.separator { margin: 0 10px; color: rgb(203, 71, 93); }
/*-----------------Administration---------------- */
.admin-link {
    color: #4361ee !important; /* Le bleu de ton interface CRUD */
    background-color: #f0f4ff;
    font-weight: bold;
}
.admin-link:hover {
    background-color: #e0e7ff;
}
@media (max-width: 768px) {
  .header-top-bar {
    padding: 0 10px;
    top: 10px;
  }
  .nav-rectangle-group {
    padding: 5px 10px;
    font-size: 0.75rem; /* Réduction de la taille sur mobile */
  }
  .separator { margin: 0 5px; }
  .user-name { display: none; } /* On cache le nom pour gagner de la place */
  .site-logo { height: 35px; }
}
</style>