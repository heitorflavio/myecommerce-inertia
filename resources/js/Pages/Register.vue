<template>
  <div>
    <div class=" bg-dark wrappe" id="register">
      <div class="container" id="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-5 d-none d-lg-flex">
                <div class="flex-grow-1 bg-register-image" id="img"></div>
              </div>
              <div class="col-lg-7">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-4">Create an Account!</h4>
                  </div>
                  <form @submit.prevent="form.post('/register')" method="POST">
                    <div class="row mb-3">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input
                          class="form-control form-control-user"
                          type="text"
                          id="exampleFirstName"
                          placeholder="First Name"
                          name="first_name"
                          v-model="form.first_name"
                          required
                        />
                      </div>
                      <div class="col-sm-6">
                        <input
                          class="form-control form-control-user"
                          type="text"
                          id="exampleLastName"
                          placeholder="Last Name"
                          name="last_name"
                          v-model="form.last_name"
                          required
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input
                          class="form-control form-control-user"
                          type="email"
                          id="exampleInputEmail"
                          aria-describedby="emailHelp"
                          placeholder="Email Address"
                          name="Email"
                          v-model="form.email"
                          required
                        />
                      </div>
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input
                          class="form-control form-control-user"
                          type="text"
                          id="exampleInputDocument"
                          placeholder="CPF"
                          name="document"
                          maxlength="11"
                          v-model="form.document"
                          required
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input
                          class="form-control form-control-user"
                          type="text"
                          id="examplePhone"
                          placeholder="Phone"
                          name="phone"
                          v-model="form.phone"
                          v-mask="'(##) #####-####'"
                          required
                        />
                      </div>
                      <div class="col-sm-6">
                        <input
                          :class="class_cep"
                          type="text"
                          id="exampleCep"
                          placeholder="Cep"
                          name="cep"
                          v-model="zip"
                          v-mask="'#####-###'"
                          required
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <input
                          class="form-control form-control-user street"
                          type="text"
                          id="Street"
                          placeholder="Street"
                          name="street"
                          v-model="form.st"
                          required
                        />
                      </div>
                      <div class="col-sm-2 mb-3 mb-sm-0">
                        <input
                          class="form-control form-control-user number"
                          type="text"
                          id="exampleNumber"
                          placeholder="Number"
                          name="number"
                          v-model="form.number"
                          required
                        />
                      </div>
                      <div class="col-sm-6">
                        <input
                          class="form-control form-control-user"
                          type="text"
                          id="exampleDistrict"
                          placeholder="District"
                          name="district"
                          v-model="form.district"
                          required
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <select
                          class="form-control form-control-user select"
                          v-model="uf"
                          required
                        >
                          <option selected class="select option">State</option>
                          <option
                            v-for="std in states"
                            :value="std.id"
                            :key="std.id"
                            class="select option"
                          >
                            {{ std.name }}
                          </option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <select class="form-control form-control-user select" v-model="form.city"  required>
                          <option disabled selected class="select option">
                            City
                          </option>
                          <option
                            v-for="ct in citys"
                            :key="ct.id"
                            selected
                            class="select option"
                          >
                            {{ ct.nome }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input
                          :class="class_password"
                          type="password"
                          id="examplePasswordInput"
                          placeholder="Password"
                          name="password"
                          v-model="password"
                          required
                        />
                      </div>
                      <div class="col-sm-6">
                        <input
                          :class="class_password"
                          type="password"
                          id="exampleRepeatPasswordInput"
                          placeholder="Repeat Password"
                          name="password_repeat"
                          v-model="password_repeat"
                          required
                        />
                      </div>
                    </div>
                    <button
                      v-if="
                        form.password &&
                        form.password_repeat &&
                        form.password === form.password_repeat
                      "
                      class="btn btn-primary d-block btn-user w-100"
                      type="submit"
                    >
                      Register Account
                    </button>
                    <button
                      v-else
                      class="btn btn-primary d-block btn-user w-100"
                      type="submit"
                      disabled
                    >
                      Register Account
                    </button>
                    <!-- <hr />
                    <a
                    class="
                    btn btn-primary
                    d-block
                    btn-google btn-user
                    w-100
                    mb-2
                    "
                    role="button"
                    ><i class="fab fa-google"></i>&nbsp; Register with
                    Google</a
                    ><a
                    class="
                    btn btn-primary
                    d-block
                    btn-facebook btn-user
                    w-100
                    "
                    role="button"
                    ><i class="fab fa-facebook-f"></i>&nbsp; Register with
                    Facebook</a
                    > -->
                    <hr />
                  </form>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html"
                      >Forgot Password?</a
                    >
                  </div>
                  <div class="text-center">
                    <a class="small" href="login.html"
                      >Already have an account? Login!</a
                    >
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
import { mask } from "vue-the-mask";
import axios from "axios";
export default {
  name: "Register",
  directives: {
    mask,
  },
  data() {
    return {
      form: Inertia.form({
        first_name: null,
        last_name: null,
        email: null,
        document: null,
        phone: null,
        zip: null,
        number: null,
        st: null,
        district: null,
        city: 'City',
        state: null,
        password: null,
        password_repeat: null,
      }),
      zip: null,
      citys: [],
      password: null,
      password_repeat: null,
      uf: 'State',
      class_password: "form-control form-control-user",
      class_cep: "form-control form-control-user",
      states: [
        { id: 12, name: "Acre" },
        { id: 27, name: "Alagoas" },
        { id: 3, name: "Amapá" },
        { id: 13, name: "Amazonas" },
        { id: 29, name: "Bahia" },
        { id: 23, name: "Ceará" },
        { id: 53, name: "Distrito Federal" },
        { id: 32, name: "Espírito Santo" },
        { id: 52, name: "Goiás" },
        { id: 21, name: "Maranhão" },
        { id: 51, name: "Mato Grosso" },
        { id: 50, name: "Mato Grosso do Sul" },
        { id: 31, name: "Minas Gerais" },
        { id: 16, name: "Pará" },
        { id: 25, name: "Paraíba" },
        { id: 41, name: "Paraná" },
        { id: 26, name: "Pernambuco" },
        { id: 22, name: "Piauí" },
        { id: 33, name: "Rio de Janeiro" },
        { id: 24, name: "Rio Grande do Norte" },
        { id: 43, name: "Rio Grande do Sul" },
        { id: 11, name: "Rondônia" },
        { id: 14, name: "Roraima" },
        { id: 42, name: "Santa Catarina" },
        { id: 35, name: "São Paulo" },
        { id: 28, name: "Sergipe" },
        { id: 17, name: "Tocantins" },
      ],
    };
    },
  props: {
      errors: Object,
      customer: Object,  
  },
  methods: {
    cep() {
      this.form.zip = this.form.zip.replace("-", "");
      console.log(this.form.zip)
      axios
        .get(`https://viacep.com.br/ws/${this.form.zip}/json`)
        .then((response) => {
          console.log(response.data);
          this.class_cep = "form-control form-control-user is-valid";
          this.form.st = response.data.logradouro;
          this.form.district = response.data.bairro;
          this.form.city = response.data.localidade;
          this.form.state = response.data.uf;
        })
        .catch((error) => {
          console.log(error);
          this.class_cep = "form-control form-control-user is-invalid";
          //   this.zip_code = "";
        });
    },
    getCity(val) {
      axios
        .get(
          `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${val}/distritos`
        )
        .then((response) => {
          console.log(response.data);
          this.citys = response.data.sort((a, b) => {
            if (a.nome < b.nome) {
              return -1;
            }
            if (a.nome > b.nome) {
              return 1;
            }
            return 0;
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  watch: {
    zip: function (val) {
      this.form.zip = val;
      if (val.length != 9) {
        this.class_cep = "form-control form-control-user is-invalid";
      } else {
        this.class_cep = "form-control form-control-user is-valid";
        this.cep();
      }
    },
    password: function (val) {
      this.form.password = val;
      if (val.length < 8) {
        this.class_password = "form-control form-control-user is-invalid";
      } else {
        this.class_password = "form-control form-control-user is-valid";
        if (this.password_repeat != val && this.password_repeat != "") {
          this.class_password = "form-control form-control-user is-invalid";
        }
      }
    },
    password_repeat: function (val) {
      this.form.password_repeat = val;
      if (val.length < 8) {
        this.class_password = "form-control form-control-user is-invalid";
      } else {
        this.class_password = "form-control form-control-user is-valid";
        if (val != this.password) {
          this.class_password = "form-control form-control-user is-invalid";
        } else {
          this.class_password = "form-control form-control-user is-valid";
        }
      }
    },
    uf: function (val) {
      this.form.state = val;
      this.getCity(val);
      },
    customer: function (val) {
      
    },
  },
};
</script>

<style scoped>
#img {
  background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
  background-size: cover;
  background-image: url("../../assets/img/dogs/image2.jpeg");
  background-position: center;
  background-repeat: no-repeat;
}
#register {
  height: 100vh;
  display: flex;
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
.select {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding-left: 1rem;
  color: #495057;
}
option {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding: 1rem;
  color: #000;
}
.option {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding: 1rem;
  color: #000;
}
.street {
  font-size: 0.8rem;
  border-radius: 10rem 0 0 10rem;
  padding: 1rem;
}
.number {
  font-size: 0.8rem;
  border-radius: 0 10rem 10rem 0;
  border: solid 1px 1px 1px 0px #e3e6f0;
  padding: 1rem;
  margin-left: -15px;
}
</style>