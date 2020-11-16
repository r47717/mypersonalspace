<template>
    <div class="card">
        <div class="card-header">{{ name }} <span v-if="price">({{ price }})</span></div>
        <div class="card-body"></div>
    </div>
</template>

<script>
export default {
    name: "Product",
    props: ['name', 'price'],
}
</script>

<style scoped lang="scss">
.card {
    width: 300px;
}
</style>
