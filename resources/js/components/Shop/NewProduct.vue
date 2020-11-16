<template>
    <div>
        <input type="text" class="form-control mb-1" name="name" placeholder="Название" v-model="name">
        <input type="text" class="form-control mb-4" name="price" placeholder="Цена" v-model="price">
        <button class="btn btn-success" @click="onProductCreate">Создать</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "NewProduct",
    data() {
        return {
            name: "",
            price: "",
        }
    },
    methods: {
        async onProductCreate() {
            await axios.post('/products', {
                title: this.name,
                price: this.price,
            });
            this.$emit('new-product-added');
        }
    }
}
</script>

<style scoped lang="scss">

</style>
