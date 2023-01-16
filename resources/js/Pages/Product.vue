<template>
  <div>
    <div>
      <!-- <h1>{{product}}</h1> -->
      <Navbar  :user="user" :total="total" />
      <Loading v-if="!product" />
      <section class="content">
        <div class="alerta" :class="{ ativo: alertaAtivo }">
          <p :class="CSStext">{{ msg }}</p>
        </div>
        <div class="card card-solid">
          <div class="card-body">
            <!--  -->
            <!--  -->
            <div class="row">
              <div class="col-12 col-sm-6">
                 <h3 class="d-inline-block d-sm-none">
                {{ product.name }}
              </h3> 
                 <div class="col-12">
                  <img
                    v-if="images.length > 0"
                    :src="images[current].path"
                    class="product-image"
                    alt="Product Image"
                  />
                  <img
                    v-else
                    :src="product.image"
                    class="product-image"
                    alt="Product Image"
                  />
                </div>
                <div class="col-12 product-image-thumbs">
                  <div
                    v-for="(image, index) in images"
                    :key="index"
                  >
                    <img @click="current = index" :src="image.path" class="img-thumb" />
                  </div>
                </div> 
              </div>
              <div class="col-12 col-sm-6">
                <h3 class="my-3">
                  {{ product.name }}
                </h3>
                <p>
                  {{ product.description }}
                </p>
                <hr />
                <div v-if="!product.onSale" class="py-2 px-3 mt-4">
                  <h2 class="mb-0 price">{{ product.price }}</h2>
                  <span class="prices"> à vista</span>
                </div>
                <div v-else class="py-2 px-3 mt-4">
                  <span class="Salesprice"
                    ><s>{{ product.onSalePrice }}</s></span
                  >
                  <h2 class="mb-0 price">{{ product.price }}</h2>
                  <span class="prices"> à vista</span>
                </div>
                <div class="mt-4">
                  <div
                    class="btn btn-primary btn-lg btn-flat"
                    @click="addCart()"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-cart-plus mr2"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"
                      />
                      <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"
                      />
                    </svg>
                    Add to Cart
                  </div>
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-lg btn-flat"
                    @click="addWish()"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-heart-fill"
                      viewBox="0 0 16 16"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"
                      ></path>
                    </svg>
                    Add to Wishlist
                  </button>
                </div>
              </div>
            </div>
            <div class="row mt-4"></div>
          </div>
        </div>
      </section>
      <Footer id="footer" />
    </div>
  </div>
</template>

<script>
import Navbar from '@/Components/Layout/Navbar.vue';
import Footer from '@/Components/Layout/Footer.vue';
import Loading from "@/components/Layout/PaginaCarregando.vue";
export default {
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
      };
  },
  methods: {
    addCart: function () {
      let cartId = sessionStorage.getItem("cart");
      cartId = window.atob(cartId);
        axios.post("/cart/new", {
          product_id: this.product.id,
          cart_id: cartId,
          description: this.product.description,
          price: this.product.price,
          sku: this.product.sku,
          image: this.product.image,
          status: 1,
          quantity: 1,
        }).then((response) => {
          this.alertaAtivo = true;
          this.msg = "Produto adicionado ao carrinho";
          this.CSStext = "alert alert-success";

          console.log(response.data)
        
          // this.$emit("updateCart  this.total = response.data.total;", this.total);
        }).catch((error) => {
          console.log(error.response.data)
          this.alertaAtivo = true;
          this.msg = "Erro ao adicionar ao carrinho";
          this.CSStext = "alert alert-danger";
        });
    },
    },
  created() {
   
  },
};
</script>

<style scoped>
.textdescription {
  font-size: 1.2rem;
  color: #000;
  margin-top: 14px;
  margin-left: 10px;
}
.svgdes {
}


.description {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  width: 100%;
}
.content {
  padding: 20px 40px 20px 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 100px;
}
.price {
  font-size: 2rem;
  color: rgb(255, 101, 0);
}
.Salesprice {
  line-height: 1.5rem;
  font-size: 0.9rem;
  color: rgb(127, 133, 141);
  font-family: Poppins, sans-serif !important;
}
.prices {
  font-size: 0.875rem;
  line-height: 1.5rem;
  color: rgb(86, 92, 105);
  font-family: Poppins, sans-serif !important;
}
@media screen and (max-width: 768px) {
  .content {
    flex-direction: column;
    padding: 0;
  }
  .price {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .prices {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    margin-left: 5px;
  }
  .mt-4 {
    margin-top: 0.5rem !important;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 40px;
  }
  .product-image {
  width: 100%px;
  object-fit: cover;
}
}
@media (min-width: 500px){
  .product-image {
  width: 500px;
  object-fit: cover;
}
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
#footer{
    
    position:absolute;
   bottom:0;
   width:100%;
  

}
</style>