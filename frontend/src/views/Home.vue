<template>
  <div class="home">
    <div class="welcome-card">
      <h1>Bienvenido a la Pastelería</h1>
      <p class="subtitle">Sistema de gestión de pasteles e ingredientes</p>
      
      <div class="cards-container">
        <div class="info-card">
          <h3>Pasteles</h3>
          <p>Gestiona el catálogo de pasteles, asigna ingredientes y controla las fechas de vencimiento.</p>
          <router-link to="/pasteles" class="btn btn-primary">Ver Pasteles</router-link>
        </div>
        
        <div class="info-card">
          <h3>Ingredientes</h3>
          <p>Administra el inventario de ingredientes, controla fechas de ingreso y vencimiento.</p>
          <router-link to="/ingredientes" class="btn btn-primary">Ver Ingredientes</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home',
};
</script>

<style scoped>
.home {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 60vh;
}

.welcome-card {
  max-width: 800px;
  text-align: center;
}

.welcome-card h1 {
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
  color: #333;
}

.subtitle {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 2rem;
}

.cards-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-top: 2rem;
}

.info-card {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, box-shadow 0.2s;
}

.info-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.info-card h3 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
  color: #333;
}

.info-card p {
  color: #666;
  margin-bottom: 1.5rem;
  line-height: 1.6;
}

.btn {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  text-decoration: none;
  border-radius: 4px;
  font-weight: 500;
  transition: background-color 0.2s;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-primary:hover {
  background-color: #0056b3;
}
</style>
