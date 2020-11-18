<template>
    <div class="card">
        <div class="card-header">{{ name }} <span v-if="price">({{ price }})</span></div>
        <div class="card-body">
            <img :src="image" alt="">
        </div>
    </div>
</template>

<script>
import image from './product.png';

export default {
    name: "Product",
    props: ['name', 'price'],
    data() {
        return {
            image,
        }
    }
}
</script>

<style scoped lang="scss">
.card {
    width: 300px;

    .card-body {
        display: flex;
        justify-content: center;
        align-items: center;

        img {
            width: 150px;
            height: 150px;
        }
    }
}
</style>
