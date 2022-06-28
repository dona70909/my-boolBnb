<template>
    <div class="container-fluid pt-5 px-0">
        <keep-alive include="AdvancedSearch, HomePage" max="5">
            <router-view/>
        </keep-alive>
    </div>
</template>

<script>
export default {
    name: "Main",
};
</script>

<style>
</style>
