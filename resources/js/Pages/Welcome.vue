 <script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navbar from '@/Components/Layout/Navbar.vue';
import List from '@/Components/Home/List.vue';

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
  <Head title="Myecommerce" />
  <Navbar :user="user" :total="0" />
  <List :products="products" />
</template>

