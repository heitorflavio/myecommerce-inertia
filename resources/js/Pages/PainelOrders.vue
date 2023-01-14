
<template>
    <div class="home">
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
                    <h1 class="m-0">Pedidos</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Pedidos</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
  
            <section class="content">
              <div class="container-fluid">
                <!-- Table -->
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="card-tools">
                          <div
                            class="input-group input-group-sm"
                            style="width: 150px"
                          >
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
                              <th>NOME</th>
                              <th>EMAIL</th>
                              <th>TOTAL</th>
                              <th>PAGAMENTO</th>
                              <th>DATA</th>
                              <th>EDITAR</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="order in orders" :key="order.id">
                              <td>{{order.id}}</td>
                              <td>{{order.customer_name}}</td>
                              <td>{{order.customer_email}}</td>
                              <td>{{price(order.total)}}</td>
                              <td>{{order.payment_method}}</td>
                              <td>{{formatDate(order.created_at)}}</td>
                              <td>
                                <button class="btn-sm btn-primary" @click="popvar = order.id">Editar</button>
                              </td>
                            </tr>                
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Table -->
              </div>
            </section>
          </div>
  
          <Footer />
  
          <div id="sidebar-overlay"></div>
        </div>
  
        <div class="jqvmap-label" style="display: none"></div>
      </body>
    </div>
  </template>
    
    <script>
  import Sidebar from "@/components/Painel/layout/Sidebar.vue";
  import Navbar from "@/components/Painel/layout/Navbar.vue";
  import Footer from "@/components/Painel/layout/Footer.vue";
  import axios from "axios";
  import moment from "moment";
  
  
  export default {
    name: "HomeView",
    components: {
      Sidebar,
      Navbar,
      Footer,
  
  },
  props: {
    user: Object,
    orders: Array,
  },
      methods: {
        formatDate: function (value) {
              if (value) {
                  return moment(String(value)).format('DD/MM/YYYY HH:mm')
              }
          },
          price: function (value) {
              if (value) {
                  return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
              }
          }
      },
  };
  </script>
    