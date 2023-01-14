<template>
   <form @submit.prevent="">
  <div>
    <div
      class="modal fade"
      id="UpdateModal"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
              Editar Produto # {{ id }}
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div>
              <b-card no-body>
                <b-tabs card>
                  <b-tab title="Dados" active>
                    <b-card-text>
                      
                        <!--  -->
                        <div class="row">
                          <div class="col-md-7 mb-4 pb-1">
                            <div class="form-outline form-white">
                              <label class="form-label" for="name">NOME</label>
                              <input
                                type="text"
                                id="name"
                                class="form-control form-control-lg"
                                required
                                v-model="name"
                              />
                            </div>
                          </div>
                          <div class="col-md-5 mb-4 pb-1">
                            <div class="form-outline form-white">
                              <label class="form-label" for="sku">SKU</label>
                              <input
                                type="text"
                                id="sku"
                                class="form-control form-control-lg"
                                required
                                v-model="sku"
                              />
                            </div>
                          </div>
                        </div>
                        <!--  -->
                        <div class="row">
                          <div class="col-md-12 mb-4 pb-1">
                            <div class="form-outline form-white">
                              <label class="form-label" for="description"
                                >DESCRIÇÃO</label
                              >
                              <textarea
                                type="text"
                                id="description"
                                class="form-control form-control-lg"
                                v-model="description"
                                cols="10"
                                rows="6"
                              >
                              </textarea>
                            </div>
                          </div>
                        </div>
                        <!--  -->
                        <div class="row">
                          <div class="col-md-12 pb-1">
                            <div class="form-outline form-white">
                              <label class="form-label" for="descriptionr"
                                >DESCRIÇÃO RESUMIDA</label
                              >
                              <textarea
                                type="text"
                                id="descriptionr"
                                class="form-control form-control-lg"
                                v-model="descriptionr"
                                required
                                rows="3"
                              >
                              </textarea>
                            </div>
                          </div>
                        </div>
                        <!--  -->
                        <div class="row">
                          <div class="col-md-2 mb-4">
                            <label for="price">PREÇO</label>
                            <input
                              type="text"
                              id="price"
                              class="form-control"
                              required
                              v-model="price"
                            />
                          </div>
                          <div class="col-md-3 mb-4">
                            <label for="pricem">PREÇO PROMOCIONAL</label>
                            <input
                              type="text"
                              id="pricem"
                              class="form-control"
                              v-model="pricep"
                              required
                              v-if="nonSale"
                            />
                            <input
                              type="text"
                              id="pricem"
                              class="form-control"
                              v-model="pricep"
                              disabled
                              v-else
                            />
                          </div>
                          <div class="col-md-4 mb-4">
                            <label for="pricem">PROMOÇÂO VALIDA ATE</label>
                            <input
                              type="date"
                              id="pricem"
                              class="form-control"
                              required
                              v-model="pvl"
                              v-if="nonSale"
                            />
                            <input
                              type="date"
                              id="pricem"
                              class="form-control"
                              v-model="pvl"
                              disabled
                              v-else
                            />
                          </div>
                          <div class="col-md-2 mb-4">
                            <label for="stock">ESTOQUE</label>
                            <input
                              type="text"
                              id="stock"
                              class="form-control"
                              required
                              v-model="stock"
                            />
                          </div>
                          <div class="form-group">
                            <button
                              v-if="nstatus"
                              class="btn-sm btn-success"
                              type="button"
                              @click="nstatus = !nstatus"
                            >
                              ATIVADO
                            </button>
                            <button
                              v-else
                              class="btn-sm btn-danger"
                              type="button"
                              @click="nstatus = !nstatus"
                            >
                              DESATIVADO
                            </button>                           
                          </div>
                          <div>
                            <button v-if="nonSale" class="btn-sm btn-success" type="button" @click="nonSale = !nonSale">PROMOÇÃO ATIVADA</button>
                            <button  v-else class="btn-sm btn-danger" type="button" @click="nonSale = !nonSale">PROMOÇÃO DESATIVADA</button>
                          </div>
                        </div>
                        <!--  -->
                        <div class="row"></div>
                        <!--  -->
                 
                    </b-card-text>
                  </b-tab>
                  <b-tab title="Imagens">
                    <b-card-text>
                      <input type="file" @change="onFileChange" name="file" />
                    </b-card-text>
                  </b-tab>
                </b-tabs>
              </b-card>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="submit"
              class="btn btn-primary"
              @click="updateProduct()"
            >
              Atualizar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
 </form>
</template>

<script>
import axios from "axios";
export default {
  name: "PopUpdate",
  props: {
    id: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      products: [],
      name: "",
      sku: "",
      description: "",
      descriptionr: "",
      price: "",
      pricep: "",
      pvl: "",
      stock: "",
      status: "",
      nstatus: "",
      nonSale: ""
    };
  },
  methods: {
    onFileChange(event) {
      this.image = event.target.files[0];
      this.imageName = event.target.files[0].name;
    },
    uploadImage(id) {
      var form = new FormData();
      form.append("file", this.image);
      form.append("name", this.imageName);

      axios
        .post(this.$store.state.base_url + "produtos/image/" + id, form, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          console.log(res);
          this.$router.go();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getProducts: function () {
      axios
        .get(this.$store.state.base_url + "produtos/" + this.id)
        .then((response) => {
          this.name = response.data.name;
          this.sku = response.data.sku;
          this.description = response.data.Fulldescription;
          this.descriptionr = response.data.description;
          this.price = response.data.price;
          this.pricep = response.data.onSalePrice;
          this.pvl = response.data.onSaleDate;
          this.stock = response.data.stock;
          this.nonSale = response.data.onSale;
          this.status = response.data.status;
          if (this.status == 1) {
            this.nstatus = true;
          } else {
            this.nstatus = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateProduct: function () {
      if (this.nstatus == true) {
        this.status = 1;
      } else {
        this.status = 0;
      }
      axios
        .put(this.$store.state.base_url + "produtos/" + this.id, {
          name: this.name,
          sku: this.sku,
          Fulldescription: this.description,
          description: this.descriptionr,
          price: this.price,
          onSalePrice: this.pricep,
          onSaleDate: this.pvl,
          onSale: this.nonSale,
          stock: this.stock,
          status: this.status,
        })
        .then((response) => {
          console.log(response);
          if(this.image != undefined) {
            this.uploadImage(response.data.id);
            }
          this.getProducts();
          // this.$router.go();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    Status: function () {
      if (this.status == 1) {
        this.nstatus = true;
      } else {
        this.nstatus = false;
      }
    },
  },
  watch: {
    id: function () {
      this.getProducts();
    },
  },
  mounted() {
    if (this.id > 0) {
      this.getProducts();
    }
  },
};
</script>

<style>
</style>