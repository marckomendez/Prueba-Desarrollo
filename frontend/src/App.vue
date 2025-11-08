<template>
  <div>
    <nav class="navbar">
      <h1><router-link to="/" class="logo-link">Pastelería</router-link></h1>
      <ul class="nav-links">
        <li><router-link to="/">Inicio</router-link></li>
        <li><router-link to="/pasteles">Pasteles</router-link></li>
        <li><router-link to="/ingredientes">Ingredientes</router-link></li>
      </ul>
    </nav>
    <main class="container">
      <router-view />
    </main>
  </div>
</template>

<style>
nav.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  background-color: #f8f8f8;
  border-bottom: 1px solid #ddd;
}
nav.navbar h1 {
  margin: 0;
  font-size: 1.5rem;
}
nav.navbar .logo-link {
  text-decoration: none;
  color: #333;
}
nav.navbar ul {
  list-style: none;
  display: flex;
  gap: 1rem;
  margin: 0;
  padding: 0;
}
nav.navbar a {
  text-decoration: none;
  color: #333;
}
nav.navbar a.router-link-exact-active {
  font-weight: bold;
  color: #007bff;
}
.container {
  padding: 1rem;
}
</style>
