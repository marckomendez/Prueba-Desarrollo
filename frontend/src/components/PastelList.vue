<template>
  <div>
    <div class="header">
      <h2>Lista de Pasteles</h2>
      <router-link class="btn btn-primary" to="/pasteles/nuevo">Nuevo Pastel</router-link>
    </div>
    <div v-if="loading" class="loading">Cargando...</div>
    <div v-if="error" class="error">{{ error }}</div>
    <table v-if="!loading && !error" class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Preparado por</th>
          <th>Ingredientes</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pastel in pasteles" :key="pastel.id">
          <td>{{ pastel.id }}</td>
          <td>{{ pastel.nombre }}</td>
          <td>{{ pastel.descripcion }}</td>
          <td>{{ pastel.preparado_por }}</td>
          <td>
            <ul>
              <li v-for="ing in pastel.ingredientes" :key="ing.id">
                {{ ing.nombre }}
              </li>
            </ul>
          </td>
          <td>
            <router-link :to="`/pasteles/${pastel.id}/editar`" class="btn btn-sm btn-secondary">Editar</router-link>
            <button @click="eliminarPastel(pastel.id)" class="btn btn-sm btn-danger">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'PastelList',
  data() {
    return {
      pasteles: [],
      error: null,
      loading: false,
    };
  },
  methods: {
    async cargarPasteles() {
      this.loading = true;
      this.error = null;
      try {
        const resp = await axios.get('/api/pasteles');
        this.pasteles = resp.data;
      } catch (error) {
        console.error(error);
        this.error = 'Error al cargar los pasteles. Por favor, intenta de nuevo.';
        alert(this.error);
      } finally {
        this.loading = false;
      }
    },
    async eliminarPastel(id) {
      if (confirm('¿Deseas eliminar este pastel?')) {
        try {
          await axios.delete(`/api/pasteles/${id}`);
          this.pasteles = this.pasteles.filter(p => p.id !== id);
          alert('Pastel eliminado correctamente');
        } catch (error) {
          console.error(error);
          alert('Error al eliminar el pastel');
        }
      }
    },
  },
  mounted() {
    this.cargarPasteles();
  },
};
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}
.table {
  width: 100%;
  border-collapse: collapse;
}
.table th, .table td {
  border: 1px solid #ddd;
  padding: 0.5rem;
}
.table th {
  background-color: #f5f5f5;
}
.btn {
  padding: 0.25rem 0.5rem;
  border: none;
  cursor: pointer;
  text-decoration: none;
  color: white;
  border-radius: 4px;
}
.btn-primary {
  background-color: #007bff;
}
.btn-secondary {
  background-color: #6c757d;
  margin-right: 0.25rem;
}
.btn-danger {
  background-color: #dc3545;
}
.loading {
  padding: 1rem;
  text-align: center;
  color: #007bff;
  font-weight: bold;
}
.error {
  padding: 1rem;
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
  border-radius: 4px;
  margin-bottom: 1rem;
}
</style>
