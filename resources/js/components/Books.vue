<template>
    <div class="row">
        <div class="col">
            <div v-for="book in books">{{ book.title }}</div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Books",
        mounted() {
            this.fetchBooks();
        },
        data() {
            return {
                books: []
            }
        },
        methods: {
            async fetchBooks() {
                const response = await axios.get('/books');
                this.books = response.data && response.data.books || [];
            }
        }
    }
</script>

<style scoped>

</style>
