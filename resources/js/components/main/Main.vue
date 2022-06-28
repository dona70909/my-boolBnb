<template>
    <main class="wrapper-main mb-2">
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
        margin-top: 8rem;
    }
</style>
