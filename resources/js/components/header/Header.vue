<template>

  <header class="nav-wrapper d-flex align-items-center  fixed-top">

      <nav class="my-navbar d-flex  justify-content-between w-100">

        <div class="nav-bar-left d-flex mx-3">
            <a class="my-navbar-logo " href="/">
                <h1>Boolbnb</h1>
            </a>
            
            <a v-if="$userEmail != ''"  href="/admin/apartments">
                <h1>Dashboard</h1>
            </a>
        </div>

        <div class="d-flex nav-bar-right mx-3">
          <a v-if="$userEmail == ''" href="/register">
              <h1>Registrati</h1>
          </a>

          <a v-if="$userEmail == ''"  href="/login">
              <h1>Login</h1>
          </a>

          <a v-if="$userEmail != ''" href="#"  @click.prevent="logout()">
            <h1> Logout </h1>
          </a>
        </div>

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
  header {

    background-color: #003580;
    height: 15vh;
    width: 100%;
    
    a {
        margin: 0 .5rem;
        color: white;

        &:hover {

          color: white;
        }
        
    }

    h1 {

      font-size: 1.4rem;
      font-weight: 700;
    }

  }
  
</style>