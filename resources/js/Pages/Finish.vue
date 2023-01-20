<template>
  <div>
    <Navbar />
    <div id="app">
      <h1>Finish</h1>
        <p>Order number: {{orders.id}}</p>
      <p>Thank you for your order!</p>
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from "@/Components/Layout/Navbar.vue";
import Footer from "@/Components/Layout/Footer.vue";
export default {
  name: "Finish",
  components: {
    Navbar,
    Footer,
  },
  props: {
    order: Object,
    },
    data() {
        return {
            orders: "",
        }
    },
  created(){
    this.orders = this.order
  }
};
</script>

<style scoped>
#app {
  display: flex;
  flex-direction: column;
  background-image: url("../../assets/pattern.svg");
  background-repeat: repeat;
  height: 100vh;
}
</style>