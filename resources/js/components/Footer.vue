<template>
  <div class="footer">
    <nav
      class="
        navbar
        d-flex
        flex-wrap
        align-items-center
        justify-content-space-beteween
        p-1
      "
    >
      <a href="/" class="logo">Boolbnb</a>
      <input type="checkbox" id="toggler" />
      <label for="toggler"><i class="fas fa-bars"></i></label>
      <div class="menu">
        <ul class="list d-flex">
          <li
            class="nav-item me-1"
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
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "Footer",
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
};
</script>

<style lang="scss" scoped>
.footer {
  width: 100%;
  height: 50px;
  border-top: 1px solid lightblue;
}
.navbar a {
  text-decoration: none;
}
.logo {
  margin-right: 50px;
}
.list {
  list-style: none;
  gap: 25px;
}
#toggler,
.navbar label {
  display: none;
}

/* @media screen and (max-width: 600px) {
  .menu {
    width: 100%;
    max-height: 0;
    overflow: hidden;
  }

  .list {
    flex-direction: column-reverse;
    align-items: center;
    padding: 20px;
    bottom: 40px;
  }

  .navbar label {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
  }

  #toggler:checked ~ .menu {
    max-height: 100%;
  }
} */

//MEDIA QUERY MD-SM-XS HOME-PAGE

@media screen and (max-width: 991px) {
  .footer {
    width: 100%;
    height: 50px;
    display: none;
  }
}
</style>
