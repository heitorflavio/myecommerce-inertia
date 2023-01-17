<template>
  <div>
    <div>
      <!-- <h1>{{product}}</h1> -->
      <Navbar :user="user" />
      <Loading v-if="!product" />
      <div id="product">
        <section class="py-5">
          <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
              <div class="col-md-6">
                <img
                  class="card-img-top mb-5 mb-md-0"
                  :src="product.image"
                  alt="..."
                />
                <div class="col-12 product-image-thumbs">
                  <div v-for="(image, index) in images" :key="index">
                    <img
                      @click="current = index"
                      :src="image.path"
                      class="img-thumb"
                    />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="small mb-1">SKU: {{ product.sku }}</div>
                <h1 class="display-5 fw-bolder">{{ product.name }}</h1>
                <div class="fs-5 mb-5">
                  <span
                    class="text-decoration-line-through"
                    v-if="product.onSale == true"
                    >{{ maskPrice(product.onSalePrice) }}</span
                  >
                  <span class="ml-2">{{ maskPrice(product.price) }}</span>
                </div>
                <p class="lead">{{ product.description }}</p>
                <div class="d-flex">
                  <!-- <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem"> -->
                  <button
                    class="btn btn-outline-dark flex-shrink-0"
                    type="button"
                    @click="addCart()"
                  >
                    <i class="bi-cart-fill me-1"></i>
                    Add to cart
                  </button>
                  <button
                    class="btn btn-outline-danger flex-shrink-0"
                    type="button"
                  >
                    <i class="bi-cart-fill me-1"></i>
                    Add to Wishlist
                  </button>
                </div>
                <div class="w-50 mt-4">
                  <div class="d-flex align-items-center">
                    <input
                      type="text"
                      class="form-control"
                      v-model="cep"
                      v-mask="'#####-###'"
                      placeholder="Calcular frete"
                    />
                    <button
                      class="btn btn-outline-dark flex-shrink-0"
                      @click="getFrete()"
                    >
                      Consultar
                    </button>
                  </div>
                </div>
                <div v-if="fretes.length > 0" class="frete mt-4">
                  <div v-for="frete in fretes" :key="frete.id">
                    <div class="">
                      <img
                        :src="frete.company.picture"
                        alt="imagem frete"
                        id="imageFrete"
                      />
                      <!-- <input
                        type="radio"
                        :id="frete.id"
                        name="radioFrete"
                        @click="addFrete(frete)"
                      /> -->
                      <label for=""
                        >{{ frete.name }} - {{ maskPrice(frete.price) }}</label
                      >
                    </div>
                  </div>
                </div>
                <span v-if="alertFrete">Frete indisponível</span>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5 bg-light">
          <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div
              class="
                row
                gx-4 gx-lg-5
                row-cols-2 row-cols-md-3 row-cols-xl-4
                justify-content-center
              "
            >
              <div class="col mb-5">
                <div class="card h-100">
                  <!-- Product image-->
                  <img
                    class="card-img-top"
                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                    alt="..."
                  />
                  <!-- Product details-->
                  <div class="card-body p-4">
                    <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder">Fancy Product</h5>
                      <!-- Product price-->
                      $40.00 - $80.00
                    </div>
                  </div>
                  <!-- Product actions-->
                  <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                      <a class="btn btn-outline-dark mt-auto" href="#"
                        >View options</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="col mb-5">
                <div class="card h-100">
                  <!-- Sale badge-->
                  <div
                    class="badge bg-dark text-white position-absolute"
                    style="top: 0.5rem; right: 0.5rem"
                  >
                    Sale
                  </div>
                  <!-- Product image-->
                  <img
                    class="card-img-top"
                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                    alt="..."
                  />
                  <!-- Product details-->
                  <div class="card-body p-4">
                    <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder">Special Item</h5>
                      <!-- Product reviews-->
                      <div
                        class="
                          d-flex
                          justify-content-center
                          small
                          text-warning
                          mb-2
                        "
                      >
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                      </div>
                      <!-- Product price-->
                      <span class="text-muted text-decoration-line-through"
                        >$20.00</span
                      >
                      $18.00
                    </div>
                  </div>
                  <!-- Product actions-->
                  <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                      <a class="btn btn-outline-dark mt-auto" href="#"
                        >Add to cart</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="col mb-5">
                <div class="card h-100">
                  <!-- Sale badge-->
                  <div
                    class="badge bg-dark text-white position-absolute"
                    style="top: 0.5rem; right: 0.5rem"
                  >
                    Sale
                  </div>
                  <!-- Product image-->
                  <img
                    class="card-img-top"
                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                    alt="..."
                  />
                  <!-- Product details-->
                  <div class="card-body p-4">
                    <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder">Sale Item</h5>
                      <!-- Product price-->
                      <span class="text-muted text-decoration-line-through"
                        >$50.00</span
                      >
                      $25.00
                    </div>
                  </div>
                  <!-- Product actions-->
                  <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                      <a class="btn btn-outline-dark mt-auto" href="#"
                        >Add to cart</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="col mb-5">
                <div class="card h-100">
                  <!-- Product image-->
                  <img
                    class="card-img-top"
                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                    alt="..."
                  />
                  <!-- Product details-->
                  <div class="card-body p-4">
                    <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder">Popular Item</h5>
                      <!-- Product reviews-->
                      <div
                        class="
                          d-flex
                          justify-content-center
                          small
                          text-warning
                          mb-2
                        "
                      >
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                      </div>
                      <!-- Product price-->
                      $40.00
                    </div>
                  </div>
                  <!-- Product actions-->
                  <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                      <a class="btn btn-outline-dark mt-auto" href="#"
                        >Add to cart</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <Footer id="footer" />
    </div>
  </div>
</template>

<script>
import Navbar from "@/Components/Layout/Navbar.vue";
import Footer from "@/Components/Layout/Footer.vue";
import Mask from "../Plugin/MaskPrice.js";
import Loading from "@/components/Layout/LoadingTime.vue";
import {mask} from 'vue-the-mask'
export default {
  directives: {
    mask
  },
  components: {
    Navbar,
    Loading,
    Footer,
  },
  props: {
    product: {
      type: Object,
      required: true,
    },
    images: {
      type: Array,
      required: true,
    },
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      current: 0,
      alertaAtivo: false,
      msg: "",
      CSStext: "",
      total: 0,
      cep: "",
      fretes: [],
      alertFrete: false,
    };
  },
  methods: {
    refreshFrete(array) {
      let r = [];
      array.forEach((element) => {
        if (element.price != null) {
          this.alertFrete = true;
        }
      });
      if()
      return r;
    },
    getFrete() {
      this.fretes = [];
      let products = {
        id: this.product.id,
        width: this.product.width,
        height: this.product.height,
        length: this.product.length,
        weight: this.product.weight,
        quantity: 1,
        insurance_value: this.product.insurance_value,

      }
      
      axios
        .post("/product/frete", {
          cep: this.cep,
          products: products,
        })
        .then((response) => {
          this.fretes = this.refreshFrete(JSON.parse(response.data));
        })
        .catch((error) => {
          console.log(error);
        });
    },
    maskPrice(price) {
      price = parseInt(price);
      return Mask.price(price);
    },
    addCart: function () {
      let cartId = sessionStorage.getItem("cart");
      cartId = window.atob(cartId);
      axios
        .post("/cart/new", {
          product_id: this.product.id,
          cart_id: cartId,
          description: this.product.description,
          price: this.product.price,
          sku: this.product.sku,
          image: this.product.image,
          status: 1,
          quantity: 1,
          width: this.product.width,
          height: this.product.height,
          weight: this.product.weight,
          length: this.product.length,
          insurance_value: this.product.insurance_value,
        })
        .then((response) => {
          this.alertaAtivo = true;
          this.msg = "Produto adicionado ao carrinho";
          this.CSStext = "alert alert-success";

          console.log(response.data);

          // this.$emit("updateCart  this.total = response.data.total;", this.total);
        })
        .catch((error) => {
          console.log(error.response.data);
          this.alertaAtivo = true;
          this.msg = "Erro ao adicionar ao carrinho";
          this.CSStext = "alert alert-danger";
        });
    },
  },
  watch: {
    // fretes(n) {
    //   this.fretes 
    // },
  },
  created() {},
};
</script>

<style scoped>
#imageFrete{
  width: 60px
}
.frete {
  display: grid;
  grid-template-columns: 1fr 1fr ;
  align-items: center;
  
}
#product {
  /* height: 100vh; */
  display: flex;
  flex-direction: column;
}

button {
  margin: 2px;
}
/* ALERTA */

.alerta {
  position: absolute;
  top: 60px;
  left: 0px;
  z-index: 10;
  width: 100%;
  text-align: center;
  display: none;
}

.alerta.ativo {
  display: block;
  animation: fadeInDown 0.3s forwards;
}

@keyframes fadeInDown {
  from {
    transform: translate3d(0, -30px, 0);
    opacity: 0;
  }
  to {
    opacity: 1;
    transform: translate3d(0, 0px, 0);
  }
}

.alerta_mensagem_sucesso {
  background-color: #198754;
  display: inline-block;
  padding: 20px 40px;
  color: #fff;
  border: 1px solid #198754;
  box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.1), 0px 4px 10px rgba(0, 0, 0, 0.2);
}
.alerta_mensagem_error {
  background-color: #f8d7da;
  display: inline-block;
  padding: 20px 40px;
  color: #fff;
  border: 1px solid #dc3545;
  box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.1), 0px 4px 10px rgba(0, 0, 0, 0.2);
}
.alerta_mensagem_wishlist {
  background-color: #45748f;
  display: inline-block;
  padding: 20px 40px;
  color: #fff;
  border: 1px solid #000c79;
  box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.1), 0px 4px 10px rgba(0, 0, 0, 0.2);
}
.img-thumb {
  width: 120px;
  height: 120px;
  object-fit: cover;
}
#footer {
  /* position: absolute;
  bottom: 0;
  width: 100%; */
}
</style>