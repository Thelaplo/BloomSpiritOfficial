<template>
  <div class="login-page-container">
    
    <div class="image-side">
        </div>
    
    <div class="form-side">
      <div class="login-card">
        
        <h1 class="login-title">Connexion</h1>
        
        <form @submit.prevent="handleLogin" class="login-form">
          
          <div class="form-group">
            <label for="email">E-Mail</label>
            <input type="text" 
                   id="email" 
                   v-model="email" 
                   required>
          </div>
          
          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" 
                   id="password" 
                   v-model="password" 
                   required>
          </div>
          
          <p class="forgot-password">
            <a href="#">Mot de passe oublié ?</a>
          </p>
          
          <div class="action-buttons">
              <button type="submit" class="login-button">SE CONNECTER</button>
              <router-link to="/register" class="register-button">S'INSCRIRE</router-link>
          </div>
          
        </form>
        
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    handleLogin() {
      // 🚨 LOGIQUE DE CONNEXION ICI
      console.log('Tentative de connexion avec :', this.email, this.password);
      
      // Simuler une connexion réussie et rediriger
      // this.$router.push('/'); 
    }
  }
}
</script>

<style scoped>
/* POLICES & COULEURS */
:root {
  --primary-color: #e91e63; /* Rose profond (Pour le texte/bordure) */
  --secondary-color: #f7e6e9; /* Arrière-plan général clair */
  --background-pink: #fbe6ec; /* Le rose clair du côté formulaire */
  --text-dark: #333;
}
/* Importez ici vos polices (Inter, Judson, etc.) */


/* ----------------------------------- */
/* 1. CONTENEUR PRINCIPAL (Division 50/50) */
/* ----------------------------------- */

.login-page-container {
  display: flex;
  min-height: 100vh;
  width: 100vw;
}

/* 2. CÔTÉ IMAGE (50% à gauche) */
.image-side {
  width: 50%;
  background-image: url('/public/img/tokyo-night-street.jpg'); /* 🔥 Remplacez par le chemin de votre image */
  background-size: cover;
  background-position: center;
}

/* 3. CÔTÉ FORMULAIRE (50% à droite) */
.form-side {
  width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: var(--background-pink); /* Fond rose clair */
  position: relative; /* Pour positionner le caractère japonais */
  overflow: hidden;
}

/* 4. CARACTÈRE JAPONAIS DE FOND (CSS Visuel) */
.form-side::before {
    content: '連'; /* Le caractère japonais (à ajuster si vous en avez un autre) */
    position: absolute;
    top: 50px;
    right: -20px;
    font-size: 250px;
    font-family: Arial, sans-serif; /* Utilisez une police qui supporte le CJK si possible */
    color: rgba(255, 255, 255, 0.5); /* Blanc semi-transparent */
    /* Vous pouvez utiliser une couleur rose très claire si le fond est blanc */
    color: rgba(255, 192, 203, 0.4); 
    transform: rotate(-10deg);
    line-height: 1;
    z-index: 1;
}

/* 5. CARTE DE CONNEXION (Conteneur du formulaire) */
.login-card {
  background-color: transparent; /* Pas de fond blanc, le fond est le form-side */
  padding: 40px;
  width: 100%;
  max-width: 450px;
  z-index: 2; /* S'assure qu'il est au-dessus du caractère japonais */
}

.login-title {
  color: var(--primary-color);
  margin-bottom: 30px;
  font-size: 1.8em;
  text-align: center;
}

/* 6. CHAMPS ET INPUTS */
.form-group {
  text-align: left;
  margin-bottom: 20px;
  z-index: 5;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
  color: var(--text-dark);
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 1em;
  box-sizing: border-box;
  background-color: white; /* Fond blanc pour les champs */
  
  /* 🔥 Bords arrondis plus fins, comme sur le Figma */
  border-radius: 15px; 
}

/* 7. LIEN OUBLIÉ ET BOUTONS */
.forgot-password {
    text-align: right;
    font-size: 0.85em;
    margin-top: -10px;
    margin-bottom: 20px;
}

.forgot-password a {
  color: var(--primary-color);
  text-decoration: underline; /* Comme sur la maquette */
}

.action-buttons {
    display: flex;
    gap: 20px; /* Espace entre les deux boutons */
    margin-top: 25px;
}

.login-button, .register-button {
  flex-grow: 1;
  padding: 10px;
  border: 2px solid var(--primary-color); 
  border-radius: 15px; /* Bords arrondis */
  font-size: 0.9em;
  font-weight: 700;
  text-align: center;
  cursor: pointer;
  text-decoration: none;
}

/* Style du bouton SE CONNECTER (Rempli) */
.login-button {
  background-color: var(--primary-color);
  color: white;
}

/* Style du bouton S'INSCRIRE (Contour) */
.register-button {
  background-color: transparent;
  color: var(--primary-color);
  line-height: normal;
}
</style>