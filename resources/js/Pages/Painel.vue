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
                    <h1 class="m-0">Dashboard</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
  
            <section class="content">
              <div class="container-fluid">
                <!-- dashboard 1 -->
                <Dashboard1 />
                <!-- d1 -->
  
              
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
  import Footer from "@/components/Painel/layout/Footer.vue";
  import Navbar from "@/components/Painel/layout/Navbar.vue";
  import Dashboard1 from "@/components/Painel/Home/Dashboard1.vue";
  export default {
    name: "HomeView",
    components: {
      Sidebar,
      Navbar,
      Footer,
      Dashboard1,
  },
  props: {
      user: Object,
    }
  };
  </script>
  