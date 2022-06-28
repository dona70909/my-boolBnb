<template>
    
    <footer>
        <section class="container-fluid">
          <div class="row">
            <div class="col-12">
              Footer
            </div>
          </div>
        </section>
    </footer>

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
  height: 20vh;
}

</style>
