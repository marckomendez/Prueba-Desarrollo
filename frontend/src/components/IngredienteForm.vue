<template>
  <div>
    <h2>{{ esEdicion ? 'Editar Ingrediente' : 'Crear Ingrediente' }}</h2>
    <form @submit.prevent="guardarIngrediente">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input id="nombre" v-model="ingrediente.nombre" type="text" required />
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" v-model="ingrediente.descripcion" />
      </div>
      <div class="form-group">
        <label for="fecha_ingreso">Fecha de ingreso</label>
        <input id="fecha_ingreso" v-model="ingrediente.fecha_ingreso" type="date" />
      </div>
      <div class="form-group">
        <label for="fecha_vencimiento">Fecha de vencimiento</label>
        <input id="fecha_vencimiento" v-model="ingrediente.fecha_vencimiento" type="date" />
      </div>
      <button class="btn btn-primary" type="submit">
        {{ esEdicion ? 'Actualizar' : 'Crear' }}
      </button>
      <router-link class="btn btn-secondary" to="/ingredientes">Cancelar</router-link>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'IngredienteForm',
  data() {
    return {
      ingrediente: {
        nombre: '',
        descripcion: '',
        fecha_ingreso: '',
        fecha_vencimiento: '',
      },
      esEdicion: false,
    };
  },
  async created() {
    if (this.$route.params.id) {
      this.esEdicion = true;
      await this.cargarIngrediente(this.$route.params.id);
    }
  },
  methods: {
    async cargarIngrediente(id) {
      try {
        const resp = await axios.get(`/api/ingredientes/${id}`);
        const data = resp.data;
        this.ingrediente = {
          id: data.id,
          nombre: data.nombre,
          descripcion: data.descripcion,
          fecha_ingreso: data.fecha_ingreso,
          fecha_vencimiento: data.fecha_vencimiento,
        };
      } catch (error) {
        console.error(error);
      }
    },
    async guardarIngrediente() {
      const payload = {
        nombre: this.ingrediente.nombre,
        descripcion: this.ingrediente.descripcion,
        fecha_ingreso: this.ingrediente.fecha_ingreso || null,
        fecha_vencimiento: this.ingrediente.fecha_vencimiento || null,
      };
      try {
        if (this.esEdicion) {
          await axios.put(`/api/ingredientes/${this.ingrediente.id}`, payload);
          alert('Ingrediente actualizado correctamente');
        } else {
          await axios.post('/api/ingredientes', payload);
          alert('Ingrediente creado correctamente');
        }
        this.$router.push('/ingredientes');
      } catch (error) {
        console.error(error);
        const mensaje = error.response?.data?.message || 'Error al guardar el ingrediente';
        alert(mensaje);
      }
    },
  },
};
</script>

<style scoped>
.form-group {
  margin-bottom: 1rem;
  display: flex;
  flex-direction: column;
}
.form-group label {
  font-weight: bold;
  margin-bottom: 0.25rem;
}
.form-group input,
.form-group textarea {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.btn {
  padding: 0.5rem 1rem;
  border: none;
  margin-right: 0.5rem;
  cursor: pointer;
  color: #fff;
  border-radius: 4px;
}
.btn-primary {
  background-color: #28a745;
}
.btn-secondary {
  background-color: #6c757d;
}
</style>
