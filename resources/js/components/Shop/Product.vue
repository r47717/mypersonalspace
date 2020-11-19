<template>
    <div :class="classObject">
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
    props: ['name', 'price', 'view'],
    data() {
        return {
            image,
        }
    },
    computed: {
        classObject() {
            return {
                card: true,
                'card-small': this.view === 'small-icons',
                'list': this.view === 'list',
            }
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

.card.card-small {
    width: 100px;

    .card-body {
        img {
            width: 50px;
            height: 50px;
        }
    }
}

.card.list {
    .card-body {
        display: none;
    }
}

</style>
