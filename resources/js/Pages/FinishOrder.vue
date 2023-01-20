<template>
  <Navbar />
  <div id="template">
    <div id="app">
      <div>
        <form @submit.prevent="">
          <div class="d-flex main">
            <div class="alert alert-danger" v-if="alert">{{ alert }}</div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <h6
                    class="
                      d-flex
                      justify-content-center
                      align-items-center
                      mb-4
                    "
                  >
                    <img src="../../assets/caminhao.svg" alt="" />
                    <b>Endereço da Entrega</b>
                  </h6>
                  <div class="col">
                    <span><b>Endereço: </b>{{ customer.address }}, </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <span><b>Bairro: </b> {{ customer.district }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <span><b>Cidade: </b> {{ customer.city }}</span>
                    <span class="ml-4"><b>UF: </b> {{ customer.state }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <span><b>Cep: </b> {{ customer.zip }}</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="row">
                  <h6
                    class="
                      d-flex
                      justify-content-center
                      align-items-center
                      mb-4
                    "
                  >
                    <img src="../../assets/boleto.svg" alt="" />
                    <b>Itens</b>
                  </h6>
                  <div class="col">
                    <span
                      ><b>{{ Total }} - Item - {{ maskPrice(total) }}</b></span
                    >
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <span
                      ><b> Frete: {{ maskPrice(freteItem.price) }}</b></span
                    >
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <span
                      ><b>TOTAL: {{ maskPrice(isTotal) }}</b></span
                    >
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="row">
                  <h6
                    class="
                      d-flex
                      justify-content-center
                      align-items-center
                      mb-4
                    "
                  >
                    <img src="../../assets/cart.svg" alt="" />
                    <b>Frete</b>
                  </h6>
                </div>

                <div id="frete">
                  <div class="ml-4">
                    <img
                      :src="freteItem.company.picture"
                      alt="imagem frete"
                      id="pictureFrete"
                      class="mb-1"
                    />
                    <b>Frete: </b>{{ freteItem.name }}
                  </div>
                  <div class="ml-4">
                    <b>Valor: </b>{{ maskPrice(freteItem.price) }}
                  </div>
                  <div class="ml-4">
                    <b>Prazo: </b>{{ freteItem.delivery_time }} Dias
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card rounded-3 mb-4" v-for="pd in product" :key="pd.id">
            <div class="card-body p-4">
              <div
                class="row d-flex justify-content-between align-items-center"
              >
                <div class="col-md-2 col-lg-2 col-xl-2">
                  <img
                    :src="pd.image"
                    class="img-fluid rounded-3"
                    alt="Cotton T-shirt"
                  />
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                  <p class="lead fw-normal mb-2">{{ pd.name }}</p>
                  <p id="description">
                    {{ pd.description }}
                  </p>
                  <span>{{ maskPrice(pd.price) }} UN</span>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                  <div>
                    <input
                      id="form1"
                      min="0"
                      name="quantity"
                      :value="pd.quantity"
                      type="number"
                      disabled
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                  <h5 class="mb-0">
                    {{ maskPrice(pd.price * pd.quantity) }}
                  </h5>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div
              class="
                card-body
                d-flex
                align-content-center
                justify-content-center
              "
            >
              <button type="button" v-for="py in payments" :key="py.id"  @click="pay = py.id" class="btn btn-outline-success flex-shrink-0">
                {{ py.name }}
              </button>
            </div>
          </div>
          <div class="card pay2" v-if="pay == 1">
            <div
              class="
                card-body
                d-flex
                align-content-center
                justify-content-center
              "
            >
              <div class="row d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center">
                  <h4>
                    <b>Total: {{ maskPrice(isTotal) }}</b>
                  </h4>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                  <button
                    type="submit"
                    class="btn fzd mt-3"
                    @click="finish"
                  >
                    FINALIZAR COMPRA
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card pay2" v-if="pay == 2">
            <div
              class="
                card-body
                d-flex
                align-content-center
                justify-content-center
              "
            >
              <div class="row d-flex align-items-center justify-content-center">
                <div class="row">
                  <div class="d-flex align-items-center justify-content-center">
                    <span><b>**** PAGAR NA ENTREGA ****</b> </span>
                  </div>
                  <div
                    class="
                      col
                      d-flex
                      align-items-center
                      justify-content-center
                      mb-2
                      mt-2
                    "
                  >
                    <input
                      type="radio"
                      name="payment"
                      value="1"
                      required
                      v-model="PayEntrega"
                    /><span class="ml-2 mr-2"><b>PIX</b></span>
                    <input
                      type="radio"
                      name="payment"
                      value="2"
                      required
                      v-model="PayEntrega"
                    /><span class="ml-2 mr-2"><b>DINHEIRO</b></span>
                    <input
                      type="radio"
                      name="payment"
                      value="3"
                      required
                      v-model="PayEntrega"
                    /><span class="ml-2 mr-2"><b>CARTÃO</b></span>
                  </div>
                </div>
                <div
                  class="d-flex align-items-center justify-content-center mt-2"
                >
                  <h4>
                    <b>Total: {{ isTotal }}</b>
                  </h4>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                  <button type="submit" class="btn fzd mt-1">
                    FINALIZAR COMPRA
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card pay1" v-if="pay == 3">
            <div
              class="
                card-body
                d-flex
                align-content-center
                justify-content-center
                flex-column
              "
            >
              <!--  -->
              <div class="row gx-3">
                <div class="col-6">
                  <div class="d-flex flex-column">
                    <p class="text mb-1">Person Name</p>
                    <input
                      class="form-control mb-3"
                      type="text"
                      placeholder="Name"
                      required
                    />
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-flex flex-column">
                    <p class="text mb-1">Card Number</p>
                    <input
                      class="form-control mb-3"
                      type="text"
                      placeholder="1234 5678 4356 9878"
                      required
                    />
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-flex flex-column">
                    <p class="text mb-1">Expiry</p>
                    <input
                      class="form-control mb-3"
                      type="text"
                      placeholder="MM/YYYY"
                      required
                    />
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-flex flex-column">
                    <p class="text mb-1">CVV/CVC</p>
                    <input
                      class="form-control mb-3 pt-2"
                      type="text"
                      placeholder="***"
                      required
                    />
                  </div>
                </div>
              </div>
              <!--  -->
              <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn fzd mt-3">
                  FINALIZAR COMPRA
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script>
import Navbar from "@/Components/Layout/Navbar.vue";
import Footer from "@/Components/Layout/Footer.vue";
import axios from "axios";
import Mask from "../Plugin/MaskPrice.js";
import { Inertia } from "@inertiajs/inertia";
export default {
  name: "FinishOrder",
  components: {
    Navbar,
    Footer,
  },
  props: {
    user: {
      type: Object,
      default: null,
    },
    products: {
      type: Array,
      default: null,
    },
    frete: {
      type: Number,
      default: null,
    },
    cep: {
      type: String,
      default: null,
    },
    payment: {
      type: Array,
      default: null,
    },
  },
  data() {
    return {
      pay: false,
      PayEntrega: null,
      isTotal: 0,
      retur: false,
      product: [],
      freteItem: {},
      total: 0,
      Total: 0,
      customer: [],
      payments: [],
    };
  },
  methods: {
    finish: function () {
      axios
        .post("/order/store", {
          valor_frete: this.freteItem.price,
          frete: this.freteItem.name,
          payment_method: this.pay,
        })
        .then((response) => {
          Inertia.post('/order/finish', {
            order: response.data
          })
        })
        .catch((error) => {
          console.log(error);
        });
    },
    maskPrice(price) {
      let type = typeof price;
      if (type == "string") {
        price = parseFloat(price);
      }
      return Mask.price(price);
    },
  },
  created() {
    this.product = this.products;
    this.freteItem = this.frete;
    this.customer = this.user;
    this.payments = this.payment;
    this.isTotal =
      parseFloat(this.frete.price) +
      this.products.reduce((a, b) => {
        return parseFloat(a) + parseFloat(b.price) * parseFloat(b.quantity);
      }, 0);
    this.Total = this.product.length;
    this.total = this.product.reduce((a, b) => {
      return parseFloat(a) + parseFloat(b.price) * parseFloat(b.quantity);
    }, 0);
  },
};
</script>

<style scoped>
#pictureFrete {
  width: 64px;
}
#app {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 100px;
}
#template {
  display: flex;
  flex-direction: column;
  background-image: url("../../assets/pattern.svg");
  background-repeat: repeat;
  height: 100vh;
}
.card {
  width: 100%;
  margin: 10px;
}
.main {
  margin: 20px 0 0 0;
  justify-content: center;
  align-items: center;
}
.button {
  width: 100px;
  height: 100px;
  margin: 0 10px 0 10px;
  border: solid 1px #000;
}
.fzd {
  background-color: #ffc107;
  font-size: 20px;
}
.pay1 {
  margin: 10px 0 0 0;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.pay2 {
  margin: 0 0 10% 0;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
#frete {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
}
@media screen and (max-width: 500px) {
  .main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
}
</style>