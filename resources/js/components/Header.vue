<template>
  <section class="container-fluid bg-black">
    <!-- Image and text -->
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
          Bootstrap
        </a>
      </nav>
  </section>
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