<template>
  <div>
    <nav
      class="
        navbar navbar-expand-lg
        fixed-top
        px-5
        mb-lg-0 mb-md-0 mb-sm-5 mb-5
        my-header
        bg-white
      "
    >
      <div class="container-fluid">
        <a class="me-5 my-text" data-text="BoolBNB" href="/">BoolBNB</a>

        <!-- //!! LOGOUT FUNZIONA  PREVENT DOPPIO CLICK LOGOUT - SINGLE CLICK NON LOGOUT-->
        <!-- <a
          href="#"
          class="pointer-events"
          v-if="$userEmail != ''"
          @click.prevent="logout()"
          >Logout</a
        > -->

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul
            class="
              navbar-nav
              me-auto
              mb-2 mb-lg-0
              d-flex
              justify-content-center
              align-items-center
            "
          >
            <li
              class="nav-item me-1 my-link"
              v-for="(navItem, index) in navItems"
              :key="index"
            >
              <router-link
                class="nav-link active"
                :to="{ name: navItem.routeName }"
              >
                {{ navItem.label }}
              </router-link>
            </li>
            <li>
              <a v-if="$userEmail != ''" href="/admin/apartments" class="me-5 text-decoration-none"
                >Dashboard</a
              >
            </li>
          </ul>

          <ul class="d-flex justify-content-center align-items-center mb-0">
            <li class="nav-item dropdown list-unstyled d-flex">
              <a
                class="nav-link dropdown-toggle me-5"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                v-if="$userEmail != ''"
              >
                Icona utente
              </a>
              <a
                class="nav-link dropdown-toggle me-5"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                v-if="$userEmail == ''"
              >
                Accedi
              </a>

              <!-- //#dropdown menu -->
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li v-if="$userEmail == ''">
                  <a class="dropdown-item" href="/register">Registrati</a>
                </li>

                <li v-if="$userEmail == ''">
                  <a class="dropdown-item" href="/login">Login</a>
                </li>

                <li>
                  <!-- //!! LOGOUT FUNZIONA  PREVENT DOPPIO CLICK LOGOUT - SINGLE CLICK NON LOGOUT-->
                  <a
                    href="#"
                    class="pointer-events dropdown-item text-info"
                    v-if="$userEmail != ''"
                    @click.prevent="logout()"
                    >Logout</a
                  >
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "Header",
  data: function () {
    return {
      navItems: [
        {
          label: "About us",
          routeName: "about-us",
        },
        {
          label: "Contact us",
          routeName: "contact",
        },
      ],
    };
  },

  methods: {
    logout() {
      axios.post("/logout").catch((error) => {
        window.location.href = "/login";
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap");
.my-header {
  height: 65px;
}
.my-text {
  font-family: "Montserrat", sans-serif;
  text-transform: uppercase;
  font-size: 30px;
  //-webkit-text-stroke: 1px #eee;
  //color: transparent;
  position: relative;
  text-decoration-line: none;
}
.my-link {
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.my-text::before {
  content: attr(data-text);
  position: absolute;
  top: 0;
  left: 0;
  color: rgba(22, 22, 192, 0.555);
  //-webkit-text-stroke: 3px rgb(0, 255, 98);
  width: 0;
  white-space: nowrap;
  overflow: hidden;
  //border-right: 2px solid blue;
  animation: text-fill 3s ease-in-out alternate infinite;
}
@keyframes text-fill {
  100% {
    width: 100%;
  }
}
</style>
