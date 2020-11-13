<template>
    <div class="card">
        <div class="card-header">Мои цитаты</div>
        <div class="card-body">
            <div class="mb-5" v-if="quotes.length > 0">
                <div class="" v-for="item in quotes" :data-id="item.id">
                    "{{ item.quote }}" <span v-if="item.author">&nbsp;({{ item.author }})</span>
                    <button type="button" class="close" @click="onQuoteRemove(item.id)">
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="mb-5 no-quotes">Ваш цитатник пуст, давайте что-нибудь добавим</div>
            </div>
            <div class="input-block">
                <input class="form-control" type="text" name="add-quote" placeholder="Цитата" v-model="newQuote.quote" @keyup.enter="onEnter">
                <input class="form-control" type="text" name="add-author"placeholder="Кто сказал?" v-model="newQuote.author" @keyup.enter="onEnter">
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        async mounted() {
            await this.fetchQuotes();
        },
        data() {
            return {
                quotes: [],
                newQuote: {
                    quote: '',
                    author: '',
                }
            }
        },
        methods: {
            async fetchQuotes() {
                const response = await axios.get('/fetch-quotes');
                this.quotes = response.data && response.data.quotes || [];
                console.log(this.quotes);
            },
            async onEnter() {
                if(this.newQuote.quote.trim().length) {
                    await axios.post('/quotes', {
                        quote: this.newQuote.quote,
                        author: this.newQuote.author,
                    });
                    this.newQuote = {
                        quote: '',
                        author: '',
                    };
                    await this.fetchQuotes();
                }
            },
            async onQuoteRemove(id) {
                await axios.delete(`/quotes/${id}`);
                await this.fetchQuotes();
            }
        }
    }
</script>

<style scoped lang="scss">
    .no-quotes {
        font-style: italic;
    }

    .input-block {
        display: flex;
        input:first-child {
            background: black;
            color: yellow;
            font-style: italic;
            flex: 1 1 70%;
        }
        input:last-child {
            flex: 1 1 30%;
            margin-left: 20px;
        }
    }
</style>
