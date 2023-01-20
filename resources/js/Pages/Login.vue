<template>
  <div>
    <div class=" bg-dark wrapper" id="login">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
              <div class="card-body p-0">
                <div class="row">
                  <div class="col-lg-6 d-none d-lg-flex">
                    <div class="flex-grow-1 bg-login-image" id="img"></div>
                  </div>
                  <div class="col-lg-6">
                    <div class="p-5">
                      <div class="text-center">
                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                      </div>
                      <form
                        class="user"
                        @submit.prevent="form.post('/login')"
                        method="POST"
                      >
                      <!-- <form
                        class="user"
                        @submit.prevent="setPost()"
                        method="POST"

                      > -->
                        <div class="mb-3">
                          <input
                            class="form-control form-control-user"
                            type="email"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter Email Address..."
                            required
                            name="email"
                            v-model="form.email"
                          />
                        </div>
                        <div class="mb-3">
                          <input
                            class="form-control form-control-user"
                            type="password"
                            id="exampleInputPassword"
                            placeholder="Password"
                            required
                            name="password"
                            v-model="form.password"
                          />
                        </div>
                        <div class="mb-3">
                          <div class="custom-control custom-checkbox small">
                            <div class="form-check">
                              <input
                                class="form-check-input custom-control-input"
                                type="checkbox"
                                id="formCheck-1"
                              /><label
                                class="form-check-label custom-control-label"
                                for="formCheck-1"
                                >Remember Me</label
                              >
                            </div>
                          </div>
                        </div>
                        <button
                          class="btn btn-primary d-block btn-user w-100"
                          type="submit"
                        >
                          Login
                        </button>
                        <!-- <hr /> -->
                        <!-- <a
                            class="
                              btn btn-primary
                              d-block
                              btn-google btn-user
                              w-100
                              mb-2
                            "
                            role="button"
                            ><i class="fab fa-google"></i>&nbsp; Login with
                            Google</a
                          ><a
                            class="
                              btn btn-primary
                              d-block
                              btn-facebook btn-user
                              w-100
                            "
                            role="button"
                            ><i class="fab fa-facebook-f"></i>&nbsp; Login with
                            Facebook</a
                          > -->
                        <hr />
                      </form>
                      <div class="text-center">
                        <a class="small" href="forgot-password"
                          >Forgot Password?</a
                        >
                      </div>
                      <div class="text-center">
                        <a class="small" href="register">Create an Account!</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import { Inertia } from "@inertiajs/inertia";
export default {
  name: "LoginView",
  data() {
    return {
      form: Inertia.form({
        email: "",
        password: "",
        cart: "",
      }),
    };
  },
  props: {
    errors: Object,
    login: Object,
  },
  methods: {
   async setPost() {
    await  axios.get("/sanctum/csrf-cookie").then((response) => {
        // Login...
        console.log('csrf',response)
    });
      await this.form.post("/login");
    
    },
  },
  watch: {
    login: function (val) {
      console.log(val);
    },
  },
  methods: {
    cartCheck() {
      if(localStorage.getItem('_cart') != null){
        this.form.cart = localStorage.getItem('_cart');
        sessionStorage.removeItem('cart');
        localStorage.removeItem('_cart');
      } 
    }
  },
  created() {
    this.cartCheck();
    // this.submit();
    // console.log(this.login);
    // axios.get("/cart").then((response) => {
    //   console.log(response);
    // });
  },
};
</script>
  
  <style scoped>
#img {
  background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
  background-size: cover;
  background-image: url("../../assets/img/dogs/image3.jpeg");
  background-position: center;
  background-repeat: no-repeat;
}
#login {
  height: 100vh;
}
button {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding: 0.75rem 1rem;
}
input {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding: 1rem;
}
label {
  font-size: 0.8rem;
  color: #000;
}
</style>