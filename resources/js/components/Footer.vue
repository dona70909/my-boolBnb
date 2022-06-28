<template>
    <section class="container-fluid">
      QUI UN FOOTER CON LINK A CASO
    </section>
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
