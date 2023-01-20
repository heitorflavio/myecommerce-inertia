<template>
  <div>
    <Navbar />
    <Loading v-if="Loading"/>
    <div id="app" v-else>
      <div id="content" class="p-2">

        <h1>Finalizado!</h1>
        <p>Número do Pedido: #{{orders.order.id}}</p>
        <p>Obrigado Pelo Seu Pedido!</p>
        <p>Em breve você receberá um e-mail com os detalhes do seu pedido.</p>
        <h3>Clique No Link Abaixo Para Gerar Seu Boleto</h3>
        <a class="btn btn-link btn-lg" :href="paymentLink" target="_blank">Gerar Boleto</a>
        <div class="mt-4">
         <p>Código de barras</p>
          <p>{{boleto.barcode}}</p>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from "@/Components/Layout/Navbar.vue";
import Footer from "@/Components/Layout/Footer.vue";
import Loading from "../Components/Layout/LoadingTime.vue";
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
export default {
  name: "Finish",
  components: {
    Navbar,
    Footer,
    Loading,
  },
  props: {
    order: Object,
    customer: Object,
    },
    data() {
        return {
          orders: "",
          boleto: "",
          paymentLink: "",
          Loading: true
        }
  },
    methods: {
      pay() {
        // console.log(this.boleto.boletos[0].paymentLink);
           axios.post("/pagseguro/boleto", {
            order: this.orders,
           }).then((response) => {
             this.boleto = response.data.boletos[0];
             this.paymentLink = response.data.boletos[0].paymentLink
              this.Loading = false
            //  console.log(this.paymentLink)
        }).catch((error) => {
            console.log(error);
        });
        },
    },
  created(){
    this.orders = this.order
    
    
  },
  mounted() {
    this.pay()
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
#content {
 display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 100px;
  text-align: center;

}
</style>