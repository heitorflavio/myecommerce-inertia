<template>
  <div>
    <!-- POPUP -->
    <PopCreateVue />
    <PopUpdateVue :id="id"/>
    <!-- POPUP -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button
              class="btn-sm btn-primary"
              type="button"
              data-bs-toggle="modal"
              data-bs-target="#CreateModal"
            >
              +
            </button>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                />
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>IMAGEM</th>
                  <th>NAME</th>
                  <th>SKU</th>
                  <th>PREÇO</th>
                  <th>ESTOQUE</th>
                  <th>DATA</th>
                  <th>STATUS</th>
                  <th>ACOES</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products" :key="product.id" class="tr">
                  <td>
                    {{ product.id }}
                  </td>
                  <td>
                    <img
                      :src="product.image"
                      alt="product image"
                      width="50"
                      height="50"
                    />
                  </td>
                  <td>
                    {{ product.name }}
                  </td>
                  <td>
                    {{ product.sku }}
                  </td>
                  <td>
                    {{ price(product.price) }}
                  </td>
                  <td>
                    {{ product.stock }}
                  </td>
                  <td>
                    {{ formatDate(product.created_at) }}
                  </td>
                  <td>
                    <span v-if="product.status == 1" class="badge bg-success">A</span>
                    <span v-else class="badge bg-danger">I</span>
                  </td>
                  <td>
                    <button
                      class="btn-sm btn-primary"
                      type="button"
                      data-bs-toggle="modal"
                      data-bs-target="#UpdateModal"
                      @click="update(product.id)"
                    >
                      Editar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PopCreateVue from "./PopCreate.vue";
import PopUpdateVue from "./PopUpdate.vue";
import moment from "moment";
export default {
  name: "TableComponent",
  props: {
    products: {
      type: Array,
      default: () => [],
    },
  },
  components: {
    PopCreateVue,
    PopUpdateVue,
  },
  data() {
    return {
      url: null,
      id: null,
    };
  },
  methods: {
    // img(link) {
    //   return link.replace("public", "storage");
    // },
    // update: function (id) {
    //  this.id = id;
    // },
    formatDate: function (value) {
      if (value) {
        return moment(String(value)).format("DD/MM/YYYY HH:mm");
      }
    },
    price: function (value) {
      if (value) {
        return value.toLocaleString("pt-BR", {
          style: "currency",
          currency: "BRL",
        });
      }
    },
  },
  filters: {
    // formatDate: function (value) {
    //   if (value) {
    //     return moment(String(value)).format("DD/MM/YYYY HH:mm");
    //   }
    // },
    // price: function (value) {
    //   if (value) {
    //     return value.toLocaleString("pt-BR", {
    //       style: "currency",
    //       currency: "BRL",
    //     });
    //   }
    // },
  },
  created() {
    // this.url = this.$store.state.base_url.replace("/api", "");
    console.log(this.products)
  },
};
</script>

<style scoped>
.tr {
  cursor: pointer;
}
td{
  vertical-align: middle !important;
}
</style>