<template>
  <header>
    <div class="row" id="PreNav"></div>
    <nav>
      <a href="/" class="logo">
        <img src="../../../assets/ranek.svg" alt="Ranek" />
      </a>

      <!-- <b-avatar v-if="this.$store.state.login == true" id="dropdown-1" text="Dropdown Button" class="m-md-2"> -->
      <div id="search">
        <form @submit.prevent="form.post('/')" method="POST">
          <input
            name="busca"
            id="busca"
            class="form-control"
            type="text"
            v-model="form.search"
            placeholder="Buscar..."
          />
         <button class="btn btn-link"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
      <!-- dropdown -->
      <div class="cart4">
        <div
          v-if="this.user"
          
        >
          <ul class="navbar-nav ml-auto cart btn" @click="cart()">
            <li class="nav-item">
              <span href="nav-link">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="22"
                  height="22"
                  fill="currentColor"
                  class="bi bi-cart"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                  />
                </svg>
              </span>
              <span class="badge badge-danger">{{ total }}</span>
            </li>
          </ul>
          <!-- <div class="dropdown">
            <b-avatar
              class=""
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
            </b-avatar>

            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item"
                  ><b>{{ this.user.name }}</b></a
                >
              </li>
              <li><a class="dropdown-item" href="/wishlist" >Wishlist</a></li>
              <li><a class="dropdown-item" @click="logout()">Sair</a></li>
            </ul>
          </div> -->
        </div>
        <!--  end -->

        <a v-else class="btn sidea" href="/login"
          ><span class="login"><b>Cadastre-se / Login</b></span></a
        >
      </div>
    </nav>
    <div class="row" id="PosNav">
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">CATEGORIAS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">MAIS VENDIDOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">PROMOÇÃO</a>
        </li>
      </ul>
    </div>
  </header>
</template>
  
  <script>
import axios from "axios";
// import axios from 'axios';
export default {
  name: "TheHeader",
  computed: {},
  data() {
    return {
      // total: 0,
      login: false,
      name: "",
      loading: false,
      form: this.$inertia.form({
        search: "",
      }),
    };
  },

  props: {
    total: Number,
    user: String,
  },
  methods: {
    cart() {
      this.$router.push("/cart");
    },
    me() {
      axios
        .post(this.$store.state.base_url + "me", {
          token: sessionStorage.getItem("token"),
        })
        .then((response) => {
          console.log(response);
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
    console.log(this.user);
  },
};
</script>
  
  <style scoped>
 
  #search {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    flex-wrap: nowrap;
    width: 100%;
  }

  .btn-link {
    background: none;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 0;
    margin: 0;
    color: rgb(137, 107, 182);
  }

  form{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    flex-wrap: nowrap;
    width: 30%;
  }
.resultados {
  height: 600px;
}

#busca {
  width: 100%;
  height: 32px;
  border: none;
}



@media screen and (max-width: 768px) {
  .nav-item {
    display: flex;
    align-items: center;
  }
  .nav-link {
    font-family: "industry", "arial", sans-serif;
    font-size: 10px;
    font-weight: 500;
    color: rgb(137, 107, 182);
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0 5px;
    transition: all 0.3s ease;
  }
  #PreNav {
    background: rgb(137, 107, 182);
    height: 3px;
  }
  #PosNav {
    /* background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x !important; */
    height: 50px;
    box-shadow: 0 2px 4px rgba(30, 60, 90, 0.1);
  }
  .logo {
    width: 60px;
  }
 .cart4 {
    margin-right: -20px;
  }
  form{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    flex-wrap: nowrap;
    width: 70%;
  }
}

.nav-item {
  display: flex;
  align-items: center;
}
.nav-link {
  font-family: "industry", "arial", sans-serif;
  font-size: 14px;
  font-weight: 500;
  font-weight: bold;
  color: rgb(137, 107, 182);
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 0 15px;
  transition: all 0.3s ease;
}
#PreNav {
  background: rgb(137, 107, 182);
  height: 3px;
}
#PosNav {
  /* background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x !important; */
  height: 50px;
  box-shadow: 0 2px 4px rgba(30, 60, 90, 0.1);
}
nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 15px 20px;
  box-shadow: 0 2px 4px rgba(30, 60, 90, 0.1);
}

header {
  background: #fff;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
}

.logo {
  padding: 10px 0;
}

.logo img {
  width: 90px;
}
.cart {
  margin-right: 14px;
}
.badge {
  /* position: absolute; */
  /* top: -14px; */
  /* right: -10px; */
  /* padding: 5px 10px; */
  border-radius: 50%;
  background: red;
  color: #fff;
  font-size: 0.7rem;
}
.login {
  /* padding: 10px; */
  font-family: Poppins, sans-serif !important;
  border-radius: 4px;
  text-decoration: none;
}
@media (max-width: 500px) {
  .sidea {
    margin-right: -20px;
  }
}
</style>
  