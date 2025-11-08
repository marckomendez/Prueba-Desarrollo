<template>
  <div>
    <div class="header">
      <h2>Lista de Ingredientes</h2>
      <router-link class="btn btn-primary" to="/ingredientes/nuevo">Nuevo Ingrediente</router-link>
    </div>
    <div v-if="loading" class="loading">Cargando...</div>
    <div v-if="error" class="error">{{ error }}</div>
    <table v-if="!loading && !error" class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="ing in ingredientes" :key="ing.id">
          <td>{{ ing.id }}</td>
          <td>{{ ing.nombre }}</td>
          <td>{{ ing.descripcion }}</td>
          <td>
            <router-link :to="`/ingredientes/${ing.id}/editar`" class="btn btn-sm btn-secondary">Editar</router-link>
            <button @click="eliminarIngrediente(ing.id)" class="btn btn-sm btn-danger">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'IngredienteList',
  data() {
    return {
      ingredientes: [],
      error: null,
      loading: false,
    };
  },
  methods: {
    async cargarIngredientes() {
      this.loading = true;
      this.error = null;
      try {
        const resp = await axios.get('/api/ingredientes');
        this.ingredientes = resp.data;
      } catch (error) {
        console.error(error);
        this.error = 'Error al cargar los ingredientes. Por favor, intenta de nuevo.';
        alert(this.error);
      } finally {
        this.loading = false;
      }
    },
    async eliminarIngrediente(id) {
      if (confirm('¿Deseas eliminar este ingrediente?')) {
        try {
          await axios.delete(`/api/ingredientes/${id}`);
          this.ingredientes = this.ingredientes.filter(i => i.id !== id);
          alert('Ingrediente eliminado correctamente');
        } catch (error) {
          console.error(error);
          alert('Error al eliminar el ingrediente');
        }
      }
    },
  },
  mounted() {
    this.cargarIngredientes();
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
