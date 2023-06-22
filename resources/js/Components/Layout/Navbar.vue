<template>
  <div>
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a href="/" class="logo">
          <img src="../../../assets/ranek.svg" alt="Ranek" />
        </a>
        <a href="/" class="logo2">
          <img src="../../../assets/ranek2.svg" alt="Ranek" />
        </a>
        <form @submit.prevent="form.post('/')" method="POST">
          <div class="input-group">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"
              v-model="form.search" />
            <div class="input-group-append">
              <button type="submit" class="btn btn-sidebar">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <div class="d-flex">
          <div class="nav-item dropdown" id="cart">
            <a href="/cart" class="nav-link">
              <img src="../../../assets/cart.svg" alt="Carrinho" />
              <span class="badge badge-danger navbar-badge">{{ Total }}</span>
            </a>
          </div>

          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
          aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
              Menu
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

              <li class="nav-item" v-if="!user">
                <a class="nav-link" href="/login">Login/Register</a>
              </li>
              <li class="nav-item dropdown" v-else>
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  {{ user.name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Perfil</a></li>
                  <li><a class="dropdown-item" href="#">Wishlist</a></li>
                  <li><a class="dropdown-item" href="#">Pedidos</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Categorias
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>
  
<script>
import axios from "axios";

// import axios from 'axios';
export default {
  name: "TheHeader",

  components: {
    // Sidebar,
  },
  data() {
    return {
      // total: 0,
      login: false,
      name: "",
      loading: false,
      form: this.$inertia.form({
        search: "",
      }),
      Total: 0,
    };
  },

  props: {
    // total: Number,
    user: Object,
  },
  methods: {
    cart() {
      let id = window.atob(sessionStorage.getItem("cart"));
      // console.log(id);
      axios
        .post("/cart/products", {
          cart_id: id,
        })
        .then((response) => {
          this.Total = response.data.length;
          // console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    me() {
      axios
        .post(this.$store.state.base_url + "me", {
          token: sessionStorage.getItem("token"),
        })
        .then((response) => {
          // console.log(response);
          this.login = true;
          this.name = response.data.name;
          this.loading = true;
          // this.$router.push("/");
        })
        .catch((error) => {
          console.log(error);
          this.loading = true;
        });
    },
    logout() {
      sessionStorage.removeItem("token");
      this.login = false;
      this.$router.push("/");
    },
  },
  mounted() {
    // this.me();
    console.log(this.user)
    this.cart();
    // console.log(this.user);
  },
  watch: {
    Total(n) {
      this.Total = n
    }
  }
};
</script>
  
<style scoped>
@media (max-width: 500px) {
  .logo {
    display: none;
  }

  .logo2 {
    display: flex;
  }

  .logo2 img {
    width: 60px;
    height: 60px;
  }

  .input-group {
    width: 200px;
  }

  .container-fluid {
    padding: 0;
  }

  #cart {
    margin-right: 15px;
  }
}

@media (min-width: 500px) {
  .logo2 {
    display: none;
  }

  .logo {
    padding: 10px 0;
  }

  .logo img {
    width: 90px;
  }

  .input-group {
    width: 400px;
  }

  #cart {
    margin-right: 15px;
  }
}

.input-group-append {
  background-color: #fff;
  border-radius: 0 5px 5px 0;
}

#PreNav {
  background-color: #007bff;
  height: 3px;
}

#PosNav {
  /* background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x !important; */
  height: 50px;
  box-shadow: 0 2px 4px rgba(30, 60, 90, 0.1);
  background-color: #007bff;
}
</style>
  