 <script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navbar from '@/Components/Layout/Navbar.vue';
import Footer from '@/Components/Layout/Footer.vue';
import List from '@/Components/Home/List.vue';
import cheackCart from '../Plugin/cartCheck.js'

cheackCart.Hash();

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    products: Array,
    user: String
});


</script> 

<template>
  <div id="app">
    <Head title="Myecommerce" />
    <Navbar :user="user" />
    <List id="List" :products="products" />
    <Footer id="footer" />
  </div>
</template>

<style scoped>
#app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
#List {
  flex: 1;
  margin-top: 100px;

}
#footer {
  /* margin-top: 100px; */
}
</style>
