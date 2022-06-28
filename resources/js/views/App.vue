<template>
    <div>
        <Header />
        <Main />
        <Footer />
    </div>
</template>

<script>
import Header from "../components/header/Header.vue";
import Main from "../components/main/Main.vue";
import Footer from "../components/footer/Footer.vue";


export default {
    name: "App",
    components: {
        Header,
        Main,
        Footer
    },
};
</script>

<style lang="scss">

    a {
        text-decoration: none;

        &:hover {
            color: white;
            text-decoration: none;
        }
    }

    p {
        padding: 0;
        margin:0;
    }
</style>

