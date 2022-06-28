<template>

  <header class="">
      <nav class="fixed-top my-navbar d-flex align-items-center justify-content-space-around" id="nav">
        <!-- //% logo -->
        <a class="my-navbar-logo " href="/">
            <h1>Boolbnb</h1>
        </a>

        <a href="/admin/apartments">
            <h1>Dashboard</h1>
        </a>

        <a v-if="$userEmail == ''" href="/register">
            <h1>Registrati</h1>
        </a>

        <a v-if="$userEmail == ''"  href="/login">
            <h1>Login</h1>
        </a>

        <a v-if="$userEmail != ''" href="#"  @click.prevent="logout()">
          <h1> Logout </h1>
        </a>

    </nav>
  </header>

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



<style lang="scss">

  //#NAV BAR STYLE WRAPPER
  #nav {

    background-color: blue;
    color: red;
    height: 20vh;
    width: 100%;
    

    a {
        margin: 0 .5rem;
        
    }

  }
  
</style>