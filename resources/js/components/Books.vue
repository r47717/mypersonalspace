<template>
    <div class="row">
        <div class="col">
            <div class="books-container">
                <div v-for="book in books" class="item-container">
                    {{ book.title }}
                    <button class="btn btn-sm btn-outline-info text-field">T</button>
                    <input type="checkbox" class="form-control is-read-checkbox">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Books",
        async mounted() {
            //await this.fetchBooks();
            this.mockBooks();
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
            },
            mockBooks() {
                this.books = [
                    {
                        id: 1,
                        title: 'Основы JavaScript',
                        category: "",
                        is_read: false,
                        rating: 0,
                    },
                    {
                        id: 2,
                        title: 'React для чайников',
                        category: "",
                        is_read: true,
                        rating: 2,
                    },
                    {
                        id: 3,
                        title: 'Pro NodeJS',
                        category: "",
                        is_read: false,
                        rating: 3,
                    },
                    {
                        id: 4,
                        title: 'Основы JavaScript',
                        category: "",
                        is_read: false,
                        rating: 0,
                    },
                    {
                        id: 5,
                        title: 'React для чайников',
                        category: "",
                        is_read: true,
                        rating: 2,
                    },
                    {
                        id: 6,
                        title: 'Pro NodeJS',
                        category: "",
                        is_read: false,
                        rating: 3,
                    },
                ];
            }
        }
    }
</script>

<style scoped lang="sass">
    .row
        height: 100%
        .col
            height: 100%

    .books-container
        height: 100%
        display: flex
        justify-content: space-evenly
        flex-wrap: wrap
        align-items: flex-start
        align-content: flex-start
        padding: 40px
        background: #FFFFFF

    .item-container
        display: flex
        justify-content: center
        align-items: flex-end
        background-image: url("/img/open-book.jpg")
        background-position: center
        background-repeat: no-repeat
        background-size: 250px 200px
        width: 250px
        height: 230px
        position: relative
    button.text-field
        position: absolute
        top: 160px
        left: 40px
        height: 25px
        width: 25px
    input.is-read-checkbox
        position: absolute
        top: 40px
        left: 40px
        height: 15px
        width: 15px
</style>
