<template>
  <div>
    <h2>{{ esEdicion ? 'Editar Pastel' : 'Crear Pastel' }}</h2>
    <form @submit.prevent="guardarPastel">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input id="nombre" v-model="pastel.nombre" type="text" required />
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" v-model="pastel.descripcion" />
      </div>
      <div class="form-group">
        <label for="preparado_por">Preparado por</label>
        <input id="preparado_por" v-model="pastel.preparado_por" type="text" />
      </div>
      <div class="form-group">
        <label for="fecha_creacion">Fecha de creación</label>
        <input id="fecha_creacion" v-model="pastel.fecha_creacion" type="date" />
      </div>
      <div class="form-group">
        <label for="fecha_vencimiento">Fecha de vencimiento</label>
        <input id="fecha_vencimiento" v-model="pastel.fecha_vencimiento" type="date" />
      </div>
      <div class="form-group">
        <label>Ingredientes</label>
        <div v-for="ing in ingredientes" :key="ing.id">
          <input
            type="checkbox"
            :id="`ing-${ing.id}`"
            :value="ing.id"
            v-model="pastel.ingredientes"
          />
          <label :for="`ing-${ing.id}`">{{ ing.nombre }}</label>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">
        {{ esEdicion ? 'Actualizar' : 'Crear' }}
      </button>
      <router-link class="btn btn-secondary" to="/pasteles">Cancelar</router-link>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'PastelForm',
  data() {
    return {
      pastel: {
        nombre: '',
        descripcion: '',
        preparado_por: '',
        fecha_creacion: '',
        fecha_vencimiento: '',
        ingredientes: [],
      },
      ingredientes: [],
      esEdicion: false,
    };
  },
  async created() {
    await this.cargarIngredientes();
    if (this.$route.params.id) {
      this.esEdicion = true;
      await this.cargarPastel(this.$route.params.id);
    }
  },
  methods: {
    async cargarIngredientes() {
      try {
        const resp = await axios.get('/api/ingredientes');
        this.ingredientes = resp.data;
      } catch (error) {
        console.error(error);
      }
    },
    async cargarPastel(id) {
      try {
        const resp = await axios.get(`/api/pasteles/${id}`);
        const data = resp.data;
        this.pastel = {
          id: data.id,
          nombre: data.nombre,
          descripcion: data.descripcion,
          preparado_por: data.preparado_por,
          fecha_creacion: data.fecha_creacion,
          fecha_vencimiento: data.fecha_vencimiento,
          ingredientes: data.ingredientes.map(i => i.id),
        };
      } catch (error) {
        console.error(error);
      }
    },
    async guardarPastel() {
      const payload = {
        nombre: this.pastel.nombre,
        descripcion: this.pastel.descripcion,
        preparado_por: this.pastel.preparado_por,
        fecha_creacion: this.pastel.fecha_creacion || null,
        fecha_vencimiento: this.pastel.fecha_vencimiento || null,
        ingredientes: this.pastel.ingredientes,
      };
      try {
        if (this.esEdicion) {
          await axios.put(`/api/pasteles/${this.pastel.id}`, payload);
          alert('Pastel actualizado correctamente');
        } else {
          await axios.post('/api/pasteles', payload);
          alert('Pastel creado correctamente');
        }
        this.$router.push('/pasteles');
      } catch (error) {
        console.error(error);
        const mensaje = error.response?.data?.message || 'Error al guardar el pastel';
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
