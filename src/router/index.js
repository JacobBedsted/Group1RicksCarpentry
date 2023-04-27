import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ShowInventoryView from '../views/ShowInventoryView.vue'
import LoginView from '../views/LoginView.vue'
import SaleFormView from '../views/SaleFormView.vue'
import SaleReportView from '../views/SaleReportView.vue'
import ReplenishInventoryView from '../views/ReplenishInventoryView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/ShowInventory',
    name: 'ShowInventory',
    component: ShowInventoryView
  },
  {
    path: '/Login',
    name: 'Login',
    component: LoginView
  },
  {
    path: '/SaleForm',
    name: 'SaleForm',
    component: SaleFormView
  },
  {
    path: '/ReplenishInventory',
    name: 'ReplenishInventory',
    component: ReplenishInventoryView
  },
  {
    path: '/SaleReport',
    name: 'SaleReport',
    component: SaleReportView
  },
]

const router = new VueRouter({
  routes
})

export default router
