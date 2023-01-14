
<template>
  <div>
    <body class="sidebar-mini layout-fixed" style="height: auto">
      <div class="wrapper">
        <div
          class="
            preloader
            flex-column
            justify-content-center
            align-items-center
          "
          style="height: 0px"
        >
          <img
            class="animation__shake"
            src=""
            alt="AdminLTELogo"
            height="60"
            width="60"
            style="display: none"
          />
        </div>

        <!-- nav -->
        <Navbar />
        <!-- nav -->

        <!-- side -->
        <Sidebar :user="user" />
        <!-- side -->

        <div class="content-wrapper" style="min-height: 855px">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Produtos</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Produtos</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <section class="content">
            <div class="container-fluid">
              <!-- Table -->
              <Table :products="products" />
              <!-- Table -->
            </div>
          </section>
        </div>

        <Footer></Footer>

        <div id="sidebar-overlay"></div>
      </div>

      <div class="jqvmap-label" style="display: none"></div>
    </body>
  </div>
</template>
    
    <script>
import { Inertia } from "@inertiajs/inertia";
import Sidebar from "@/components/Painel/layout/Sidebar.vue";
import Navbar from "@/components/Painel/layout/Navbar.vue";
import Footer from "@/components/Painel/layout/Footer.vue";
import Table from "@/components/Painel/Products/Table.vue";
import axios from "axios";

export default {
  name: "HomeView",
  components: {
    Sidebar,
    Navbar,
    Footer,
    Table,
  },
  data() {
    return {};
  },
  props: {
    products: Array,
    user: Object,
  },

  methods: {
   
  },
  mounted() {
    // this.products = this.$store.state.products;
    // this.user = this.$store.state.user;
    // console.log(this.products);
    // console.log(this.user);
  },
};
</script>
    