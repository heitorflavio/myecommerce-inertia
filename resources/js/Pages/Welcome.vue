<template>
  <div id="app">
    <Head title="Myecommerce" />
    <Navbar :user="user" />
    <List id="List" :products="products" />
    <Footer id="footer" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navbar from '@/Components/Layout/Navbar.vue';
import Footer from '@/Components/Layout/Footer.vue';
import List from '@/Components/Home/List.vue';
import cheackCart from '../Plugin/cartCheck.js'



export default {
  name: 'HomePage',
  components: {
    Head,
    Navbar,
    Footer,
    List,
  },
  props: {
    products: Array,
    user: Object
  },
   created() {
     cheackCart.Hash();
  }

}

</script> 

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
