<template>
  <div class="bottom-menu" style="z-index: 100">
    <nav
      class="col-12 d-flex justify-content-center align-items-center"
      style="height: 100%"
    >
      <ul
        class="
          d-flex
          justify-content-center
          align-items-center
          mb-0
          list-unstyled
          p-4
        "
      >
        <li
          class="nav-item me-1 li-none-sm"
          v-for="(navItem, index) in navItems"
          :key="index"
        >
          <router-link
            class="nav-link active padd"
            :to="{ name: navItem.routeName }"
          >
            {{ navItem.label }}
          </router-link>
        </li>
        <li class="li-none-sm">
          <a v-if="$userEmail != ''" href="/admin/apartments" class="me-5"
            >Dashboard</a
          >
        </li>
        <!--Icone mobile-->
        <li class="icone-mobile">
          <a href="/AdvancedSearch"><i class="fab fa-searchengin"></i></a>
          <a href="/about-us"><i class="fab fa-airbnb"></i></a>
          <a href="/contact-us"><i class="fas fa-address-book"></i></a>
          <a v-if="$userEmail != ''" href="/admin/apartments"
            ><i class="fas fa-house-user"></i
          ></a>
        </li>
      </ul>
      <!--Drop Down Menu-->
      <ul class="mb-0 list-unstyled">
        <li class="nav-item dropdown list-unstyled d-flex">
          <a
            class="nav-link dropdown-toggle me-5 padd"
            href="#"
            id="navbarDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            v-if="$userEmail == ''"
          >
            Accedi
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li v-if="$userEmail == ''">
              <a class="dropdown-item" href="/register">Registrati</a>
            </li>
            <li v-if="$userEmail == ''">
              <a class="dropdown-item" href="/login">Login</a>
            </li>
          </ul>
          <ul class=" list-unstyled d-flex justify-content-center align-items-center">
            <li>
              <a
                href="#"
                class="pointer-events text-decoration-none"
                style="color: #3490dc"
                v-if="$userEmail != ''"
                @click.prevent="logout()"
                >Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "HeaderNavMobile",

  data() {
    return {
      navItems: [
        {
          label: "Ricerca Avanzata",
          routeName: "advancedsearch",
        },
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

  methods:{
    logout() {
      axios.post("/logout").catch((error) => {
        window.location.href = "/login";
      });
    },
  }
};
</script>

<style lang="scss" scoped>
.bottom-menu {
  display: none;
}

.icone-mobile {
  display: none;
}

//MEDIA QUERY MD-SM-XS HOME-PAGE

@media screen and (max-width: 991px) {
  .bottom-menu {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 60px;
    background-color: lightblue;
    position: fixed;
    display: block;
  }
}

@media screen and (max-width: 733px) {
  .bottom-menu {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 60px;
    background-color: lightblue;
    position: fixed;
    display: block;
  }

  .padd {
    padding: 0;
  }
}

@media screen and (max-width: 732px) {
  .li-none-sm {
    display: none;
  }

  .icone-mobile {
    display: block;
    font-size: 2rem;
    margin-right: 60px;
    a {
      margin: 0px 20px;
    }
  }
}

@media screen and (max-width: 592px) {
  .li-none-sm {
    display: none;
  }

  .icone-mobile {
    display: block;
    font-size: 1.7rem;
    margin-right: 20px;
    a {
      margin: 0px 10px;
    }
  }
}

@media screen and (max-width: 384px) {
  .li-none-sm {
    display: none;
  }

  .icone-mobile {
    display: block;
    font-size: 1.4rem;
    margin-right: 20px;
    a {
      margin: 0px 7px;
    }
  }
}

@media screen and(max-width: 767px) {
  #mobile-menu {
        width: 100%;
        height: 50px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #eee;
        display: none;
  }
}

</style>
