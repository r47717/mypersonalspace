<template>
    <div>
        <button
            class="new-quote-show"
            v-if="newQuoteHidden"
            @click="newQuoteHidden = false"
        >
            новая
        </button>
        <div>
            <div class="quote-group">
                <div class="quote-container input-box" v-if="!newQuoteHidden">
                    <textarea
                        class="form-control"
                        type="text"
                        rows="3"
                        name="add-quote"
                        placeholder="Напиши здесь свою цитату"
                        v-model="newQuote.quote"
                    />
                    <div class="author-label">
                        <input
                            class="form-control"
                            type="text"
                            name="add-author"
                            placeholder="А здесь имя автора"
                            v-model="newQuote.author"
                        />
                    </div>
                    <button
                        class="quote-save"
                        @click="saveNewQuote"
                        :disabled="newQuote.quote.trim().length === 0"
                    >
                        готово
                    </button>
                    <button
                        class="new-quote-hide"
                        @click="newQuoteHidden = true"
                    >
                        скрыть
                    </button>
                </div>
                <div
                    class="quote-container"
                    v-for="item in quotes"
                    :data-id="item.id"
                >
                    "{{ item.quote }}"
                    <span class="author-label" v-if="item.author">{{
                        item.author
                    }}</span>
                    <button
                        type="button"
                        class="close"
                        @click="onQuoteRemove(item.id)"
                    >
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div class="input-block"></div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    async mounted() {
        await this.fetchQuotes();
    },
    data() {
        return {
            quotes: [],
            newQuote: {
                quote: "",
                author: "",
            },
            newQuoteHidden: false,
        };
    },
    methods: {
        async fetchQuotes() {
            const response = await axios.get("/fetch-quotes");
            this.quotes = (response.data && response.data.quotes) || [];
            console.log(this.quotes);
        },
        async saveNewQuote() {
            if (this.newQuote.quote.trim().length) {
                await axios.post("/quotes", {
                    quote: this.newQuote.quote,
                    author: this.newQuote.author,
                });
                this.newQuote = {
                    quote: "",
                    author: "",
                };
                await this.fetchQuotes();
            }
        },
        async onQuoteRemove(id) {
            await axios.delete(`/quotes/${id}`);
            await this.fetchQuotes();
        },
    },
};
</script>

<style scoped lang="scss">
.no-quotes {
    font-style: italic;
}

.quote-group {
    display: grid;
    grid-template-columns: 50% 50%;
    grid-gap: 10px;
    margin: 20px;
}

.quote-container {
    display: inline-flex;
    position: relative;
    background: #ffffff;
    justify-content: center;
    align-items: center;
    min-height: 200px;
    padding: 20px;
    font-style: italic;

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .author-label {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-style: initial;
        font-weight: bold;
    }
}

.quote-container.input-box {
    input,
    textarea {
        border: none;
        text-align: center;
    }

    textarea {
        resize: none;
    }

    input {
        font-weight: bold;
    }

    .quote-save {
        position: absolute;
        top: 10px;
        right: 10px;
        border: none;
        font-size: 0.8em;
        outline: none;
    }

    .new-quote-hide {
        position: absolute;
        top: 10px;
        left: 10px;
        border: none;
        font-size: 0.8em;
        outline: none;
    }
}

.new-quote-show {
    border: none;
    font-size: 0.6em;
    outline: none;
}
</style>
