<template>
    <main class="wrapper-main mb-5">
        <keep-alive include="AdvancedSearch, HomePage" max="5">
            <router-view/>
        </keep-alive>
    </main>
</template>

<script>
export default {
    name: "Main",
};
</script>

<style lang="scss">
    main {
        margin-top: 10rem;
        overflow-y: hidden;
    }
</style>
