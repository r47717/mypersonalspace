<template>
    <div>
        <div class="card mb-5">
            <div class="card-header">Моя витрина</div>
            <div class="card-body">
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">Мои продукты</div>
            <div class="card-body">
                <div v-if="products.length > 0">
                    <div v-for="product in products" class="d-inline-block m-3">
                        <product :name="product.title" :price="product.price"/>
                    </div>
                </div>
                <div v-if="products.length === 0">Пока Ваш магазин пуст, но ведь Вам наверняка есть, чем поделиться?
                </div>
            </div>
        </div>

        <div class="card new-product">
            <div class="card-header">Новый продукт</div>
            <div class="card-body">
                <new-product @new-product-added="fetchProducts"/>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    async mounted() {
        await this.fetchProducts();
    },
    data() {
        return {
            products: [],
        }
    },
    methods: {
        async fetchProducts() {
            const response = await axios.get('/products');
            this.products = response.data && response.data.products || [];
        }
    }
}
</script>

<style scoped lang="scss">
.card.new-product {
    max-width: 500px;
}
</style>
