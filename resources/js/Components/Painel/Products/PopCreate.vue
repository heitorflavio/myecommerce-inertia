<template>
  <form @submit.prevent="">
    <!-- Modal -->
    <div
      class="modal fade"
      id="CreateModal"
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
              CADASTRAR NOVO PRODUTO
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
                              v-model="name"
                              required
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
                              v-model="sku"
                              required
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
                            v-if="nstatus"
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
                            v-model="pvl"
                            v-if="nstatus"
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
                            PROMOÇÃO ATIVADA
                          </button>
                          <button
                            v-else
                            class="btn-sm btn-danger"
                            type="button"
                            @click="nstatus = !nstatus"
                          >
                            PROMOÇÃO DESATIVADA
                          </button>
                        </div>
                      </div>
                      <!--  -->
                      <div class="row"></div>
                      <!--  -->
                    </b-card-text>
                  </b-tab>
                  <b-tab title="Imagens">
                    <b-card-text>
                      <input
                        type="file"
                        @change="onFileChange"
                        name="file"
                        required
                      />

                      <!-- <input ref="fileInput" type="file" @input="pickFile" />
                    <div
                      class="imagePreviewWrapper"
                      :style="{ 'background-image': `url(${previewImage})` }"
                      @click="selectImage"
                    ></div> -->
                    </b-card-text>
                  </b-tab>
                </b-tabs>
              </b-card>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" @click="create()">
              Cadastrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
export default {
  name: "ModalComponent",
  data() {
    return {
      form: Inertia.form({
        name: "",
        sku: "",
        description: "",
        descriptionr: "",
        price: "",
        pricep: "",
        pvl: "",
        stock: "",
        status: false,
        image: "",
        onSale: 0,
        onSalePrice: "",
        onSaleDate: "",
        imageName: "",
        previewImage: null,
        path: "",
      }),
      error: null,
      nstatus: false,
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

    create: function () {
      if (this.image != "") {
        if (this.nstatus == true) {
          this.onSale = 1;
        } else {
          this.onSale = 0;
        }

        axios
          .post(
            this.$store.state.base_url + "produtos/create",

            {
              name: this.name,
              sku: this.sku,
              Fulldescription: this.description,
              description: this.descriptionr,
              price: this.price,
              // onSale: this.onSale,
              onSale: this.onSale,
              onSalePrice: this.pricep,
              onSaleDate: this.pvl,
              stock: this.stock,
            }
          )
          .then((response) => {
            console.log(response);
            this.uploadImage(response.data.id);
          })
          .catch((error) => {
            console.log(error);
            this.error = error.response.data.message;
          });
      }
    },
  },
};
</script>

<style>
label {
  font-size: 0.8rem;
  font-weight: 500;
  color: #000;
}
.imagePreviewWrapper {
  width: 250px;
  height: 250px;
  display: block;
  cursor: pointer;
  margin: 0 auto 30px;
  background-size: cover;
  background-position: center center;
}
</style>