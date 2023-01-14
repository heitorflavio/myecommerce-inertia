<template>
  <aside
    class="main-sidebar sidebar-dark-primary elevation-4"
    style="height: 105%"
  >
    <a
      href="#"
      class="brand-link d-flex align-item-center justify-content-center"
    >
      <span class="brand-text font-weight-light">Myecommerce</span>
    </a>

    <div
      class="
        sidebar
        os-host
        os-theme-light
        os-host-overflow
        os-host-overflow-y
        os-host-resize-disabled
        os-host-scrollbar-horizontal-hidden
        os-host-transition
      "
    >
      <div class="os-resize-observer-host observed">
        <div class="os-resize-observer"></div>
      </div>
      <div class="os-size-auto-observer observed">
        <div class="os-resize-observer"></div>
      </div>

      <div class="os-padding">
        <div class="os-viewport os-viewport-native-scrollbars-invisible">
          <div class="os-content">
            <div
              class="
                user-panel
                mt-3
                pb-3
                mb-3
                d-flex
                align-item-center
                justify-content-center
              "
            >
              <div class="image"></div>
              <div class="info">
                <a class="d-block">{{ user.name }}</a>
              </div>
            </div>
            <!-- Nav  -->
            <nav class="p-1 d-flex align-items-center justify-content-center">
              <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
              >
                <li class="nav-item">
                  <a href="/painel/orders" class="nav-link">
                    <i class="nav-icon fas fa-tree"></i>
                    <p>Pedidos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/painel/products" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>Produtos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/painel/customers" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Clientes</p>
                  </a>
                </li>
                <!--  -->
                <li class="nav-item">
                  <a class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      Integrações
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bling</p>
                      </a>
                    </li>
                  </ul>
                  <!-- </li> -->
                </li>
              </ul>
            </nav>
            <!-- Nav -->
          </div>
        </div>
      </div>
      <div
        class="
          os-scrollbar
          os-scrollbar-horizontal
          os-scrollbar-unusable
          os-scrollbar-auto-hidden
        "
      >
        <div class="os-scrollbar-track">
          <div class="os-scrollbar-handle"></div>
        </div>
      </div>
      <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
        <div class="os-scrollbar-track">
          <div class="os-scrollbar-handle"></div>
        </div>
      </div>
      <div class="os-scrollbar-corner"></div>
    </div>
  </aside>
</template>

<script>
export default {
  name: "Sidebar",
  data() {
    return {

    };
  },
  props: {
    user: Object,
  },
  methods: {
    // me: function () {
    //   this.session = sessionStorage.getItem("session");
    //   this.session = window.atob(this.session);
    //   this.name = JSON.parse(this.session).name;
    //   // console.log(this.session);
    // },
  },
  created() {
    // this.me();
    // console.log(this.user)
  },
};
</script>

<style scoped>
</style>