import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import PastelList from '../components/PastelList.vue';
import PastelForm from '../components/PastelForm.vue';
import IngredienteList from '../components/IngredienteList.vue';
import IngredienteForm from '../components/IngredienteForm.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/pasteles',
    name: 'pasteles',
    component: PastelList,
  },
  {
    path: '/pasteles/nuevo',
    name: 'pastel-nuevo',
    component: PastelForm,
  },
  {
    path: '/pasteles/:id/editar',
    name: 'pastel-editar',
    component: PastelForm,
    props: true,
  },
  {
    path: '/ingredientes',
    name: 'ingredientes',
    component: IngredienteList,
  },
  {
    path: '/ingredientes/nuevo',
    name: 'ingrediente-nuevo',
    component: IngredienteForm,
  },
  {
    path: '/ingredientes/:id/editar',
    name: 'ingrediente-editar',
    component: IngredienteForm,
    props: true,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
