<template>
  <div id="template">
    <Navbar />
    <Loading v-if="Time" />
    <div v-else>
      <!-- <section  style="background-color: #eee"> -->
      <div class="alerta" :class="{ ativo: alertaAtivo }">
        <p :class="CSStext">{{ msg }}</p>
      </div>
      <div class="container h-100 py-5" id="app">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
              <div>
                <span class="nav-item dropdown" data-v-87ee9136=""
                  ><a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    data-v-87ee9136=""
                  >
                    Ordenar por
                  </a>
                  <ul
                    class="dropdown-menu dropdown-menu-dark"
                    data-v-87ee9136=""
                  >
                    <li data-v-87ee9136="">
                      <a
                        class="dropdown-item"
                        href="#"
                        data-v-87ee9136=""
                        @click="orderByPrice()"
                        >Preço</a
                      >
                    </li>
                    <li data-v-87ee9136="">
                      <a
                        class="dropdown-item"
                        href="#"
                        data-v-87ee9136=""
                        @click="orderByQuantity()"
                        >Quantidade</a
                      >
                    </li>
                    <!-- <li data-v-87ee9136=""></li>
                    <li data-v-87ee9136="">
                      <a class="dropdown-item" href="#" data-v-87ee9136=""
                        >Something else here</a
                      >
                    </li> -->
                  </ul></span
                >
              </div>
            </div>

            <div
              class="card rounded-3 mb-4"
              v-for="pd in products"
              :key="pd.id"
            >
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
                    <button
                      class="btn btn-link px-2"
                      @click="removeCart(pd.product_id)"
                    >
                      <i class="fas fa-minus"></i>
                    </button>

                    <input
                      id="form1"
                      min="0"
                      name="quantity"
                      :value="pd.quantity"
                      type="number"
                      class="form-control form-control-sm"
                    />

                    <button
                      class="btn btn-link px-2"
                      @click="addCart(pd.product_id)"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                    <h5 class="mb-0">
                      {{ maskPrice(pd.price * pd.quantity) }}
                    </h5>
                  </div>
                  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <a
                      href="#!"
                      class="text-danger"
                      @click="deleteCart(pd.product_id)"
                      ><i class="fas fa-trash fa-lg"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
            <form @submit.prevent="">
              <div class="card mb-4 frete p-3">
                <div class="card-body d-flex flex-row">
                  <div class="form-outline">
                    <input
                      type="text"
                      id="form1"
                      class="form-control form-control-lg"
                      placeholder="CEP"
                      required
                      v-mask="'#####-###'"
                      v-model="cep"
                      maxlength="9"
                    />
                    <!-- <label class="form-label" for="form1">Frete</label> -->
                  </div>
                  <div>
                    <button
                      type="button"
                      class="btn btn-outline-warning btn-lg"
                      @click="getFrete()"
                    >
                      Apply
                    </button>
                  </div>
                </div>
                <div v-if="fretes.length > 0" class="frete-temp">
                  <div v-for="frete in fretes" :key="frete.id">
                    <div class="">
                      <img
                        :src="frete.company.picture"
                        alt="imagem frete"
                        id="imageFrete"
                      />
                      <input
                        type="radio"
                        :id="frete.id"
                        name="radioFrete"
                        required
                        @click="addFrete(frete)"
                      />
                      <label for=""
                        >{{ frete.name }} - {{ maskPrice(frete.price) }}</label
                      >
                    </div>
                  </div>
                </div>
                <span v-if="alertFrete">Frete indisponível</span>
              </div>
              <!-- <div class="card"  v-if="fretePrice != null">
                <div class="card-body">
                  <button
                    type="submit"
                    class="btn btn-warning btn-block btn-lg"
                    @click="finish = !finish"
                  >
                    Continuar
                  </button>
                </div>
              </div> -->
              <div class="card">
                <div class="card-body">
                  <button
                    type="submit"
                    class="btn btn-warning btn-block btn-lg"
                    ref="finish"
                    @click="finish()"
                    v-if="freteSelected != null"
                  >
                    Proceed to Pay
                  </button>
                  <button
                    v-else
                    type="submit"
                    class="btn btn-warning btn-block btn-lg"
                  >
                    Proceed to Pay
                  </button>
                  <div id="total">
                    <h7>Total Produtos: {{ maskPrice(Total) }}</h7>
                    <h7>Frete: {{ maskPrice(fretePrice) }}</h7>
                    <h4>Total: {{ maskPrice(sum(Total, fretePrice)) }}</h4>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- </section> -->
    </div>
    <Footer id="footer" />
  </div>
</template>

<script>
import Navbar from "../Components/Layout/Navbar.vue";
import Footer from "../Components/Layout/Footer.vue";
import Loading from "../Components/Layout/LoadingTime.vue";
import Mask from "../Plugin/MaskPrice.js";
import axios from "axios";
import { mask } from "vue-the-mask";
import { Inertia } from "@inertiajs/inertia";

export default {
  name: "Cart",
  directives: {
    mask,
  },
  props: {
    product: {
      type: Array,
      required: true,
    },
    user: {
      type: Object,
    },
  },
  components: {
    Navbar,
    Footer,
    Loading,
  },
  data() {
    return {
      products: [],
      Time: true,
      cep: "",
      fretes: [],
      freteSelected: null,
      alertFrete: false,
      Total: 0,
      fretePrice: 0,
    };
  },
  methods: {
    finish() {
      if (this.user) {
        console.log("logado");
        Inertia
          .post("/order", {
            cep: this.cep,
            frete: this.freteSelected,
            products: this.products,
            user: this.user,
            // total: this.Total,
            // fretePrice: this.fretePrice,
          })
          .then((res) => {
            console.log(res);
          });
      } else {
        console.log("nao logado");
        window.location.href = "/login";
      }
    },
    orderByQuantity() {
      this.products.sort((a, b) => {
        return a.quantity - b.quantity;
      });
    },
    orderByPrice() {
      this.products.sort((a, b) => {
        return a.price - b.price;
      });
    },
    sum(a, b) {
      a = parseFloat(a);
      b = parseFloat(b);
      return a + b;
    },
    finishRedirect() {
      if (this.freteSelected != null) {
        // console.log("finish")

        // this.totalwithFrete = this.Total + this.freteSelected.price;
        this.finish = false;
      }
    },
    addFrete(Object) {
      this.freteSelected = "";
      // this.products.forEach((element) => {
      //     this.Total += element.price * element.quantity;
      //   });
      this.freteSelected = Object;
      this.fretePrice = Object.price;
    },
    refreshFrete(array) {
      let r = [];
      array.forEach((element) => {
        if (element.price != null) {
          r.push(element);
        }
      });
      if (r.length == 0) {
        this.alertFrete = true;
      }
      return r;
    },
    getFrete() {
      this.fretes = [];
      let products = [];
      // console.log(products)
      this.products.forEach((element) => {
        products.push(
          JSON.stringify({
            product_id: element.product_id,
            width: element.width,
            height: element.height,
            length: element.length,
            weight: element.weight,
            insurance_value: element.insurance_value,
            quantity: element.quantity,
          })
        );
      });
      // console.log(products);
      axios
        .post("/cart/frete", {
          cep: this.cep,
          products: products,
        })
        .then((response) => {
          // console.log(response.data);
          this.fretes = this.refreshFrete(JSON.parse(response.data));
console.log(this.fretes)
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
    cart() {
      this.Time = true;
      this.products = [];
      let id = window.atob(sessionStorage.getItem("cart"));

      axios
        .post("/cart/products", {
          cart_id: id,
        })
        .then((response) => {
          this.products = response.data;

          if (this.cep != "") {
            this.getFrete();
          }
          setTimeout(() => {
            this.Time = false;
          }, 1000);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addCart(id) {
      let cartId = sessionStorage.getItem("cart");
      cartId = window.atob(cartId);
      axios
        .post("/cart/add", {
          product_id: id,
          cart_id: cartId,
        })
        .then((response) => {
          // this.alertaAtivo = true;
          // this.msg = "Produto adicionado ao carrinho";
          // this.CSStext = "alert alert-success";
          this.cart();
          console.log(response.data);
          // this.getFrete();
          // console.log(response.data)

          // this.$emit("updateCart  this.total = response.data.total;", this.total);
        })
        .catch((error) => {
          console.log(error.response.data);
          // this.alertaAtivo = true;
          // this.msg = "Erro ao adicionar ao carrinho";
          // this.CSStext = "alert alert-danger";
        });
    },
    removeCart(id) {
      let cartId = sessionStorage.getItem("cart");
      cartId = window.atob(cartId);
      axios
        .post("/cart/remove", {
          product_id: id,
          cart_id: cartId,
        })
        .then((response) => {
          // this.alertaAtivo = true;
          // this.msg = "Produto adicionado ao carrinho";
          // this.CSStext = "alert alert-success";
          this.cart();

          // console.log(response.data)

          // this.$emit("updateCart  this.total = response.data.total;", this.total);
        })
        .catch((error) => {
          console.log(error.response.data);
          // this.alertaAtivo = true;
          // this.msg = "Erro ao adicionar ao carrinho";
          // this.CSStext = "alert alert-danger";
        });
    },
    deleteCart(id) {
      let cartId = sessionStorage.getItem("cart");
      cartId = window.atob(cartId);
      axios
        .post("/cart/destroy", {
          product_id: id,
          cart_id: cartId,
        })
        .then((response) => {
          // this.alertaAtivo = true;
          // this.msg = "Produto adicionado ao carrinho";
          // this.CSStext = "alert alert-success";
          this.cart();

          // console.log(response.data)

          // this.$emit("updateCart  this.total = response.data.total;", this.total);
        })
        .catch((error) => {
          console.log(error.response.data);
          // this.alertaAtivo = true;
          // this.msg = "Erro ao adicionar ao carrinho";
          // this.CSStext = "alert alert-danger";
        });
    },
  },
  watch: {
    freteSelected(n) {
      this.freteSelected = n;
    },
    products(n) {
      this.products.forEach((element) => {
        this.Total += element.price * element.quantity;
      });
      // console.log(this.Total)
    },
    // Total(n) {
    //   this.Total = n;
    // },
  },
  created() {
    this.cart();
  },
  mounted() {
    //   setTimeout(() => {
    //   this.Time = false;
    // }, 1000);
  },
};
</script>

<style scoped>
#total {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
}
#description {
  width: 200px;

  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
#imageFrete {
  width: 60px;
}
.frete {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
}
.frete-temp {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
}
#app {
  margin-top: 50px;
  height: 100vh;
}
#template {
  display: flex;
  flex-direction: column;

  background-image: url("../../assets/pattern.svg");
  background-repeat: repeat;
  height: 100vh;
}
#footer {
  margin-top: auto;
}

@media (max-width: 768px) {
  #imageFrete {
    width: 60px;
  }
  .frete {
    /* display: grid;
  grid-template-rows: 1fr 1fr;
  align-items: center; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .frete-temp {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
  }
  #form1 {
    width: 200px;
  }
}
</style>