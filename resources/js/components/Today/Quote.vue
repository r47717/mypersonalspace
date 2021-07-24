<template>
    <div class="cite w-100 h-100">
        <em>{{ quote }}</em>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Quote",
    async mounted() {
        await this.loadQuotes();
        this.index = this.quotes && Math.floor(Math.random() * this.quotes.length);
    },
    data() {
        return {
            quotes: [],
            index: 0,
        }
    },
    computed: {
        quote() {
            return this.quotes.length ? `"${this.quotes[this.index || 0].quote}"  (${this.quotes[this.index || 0].author})` : "";
        }
    },
    methods: {
        async loadQuotes() {
            const response = await axios.get('/fetch-quotes');
            this.quotes = response.data && response.data.quotes || [];
        }
    }
}
</script>

<style scoped>
.cite {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    font-size: 17px;
    text-align: justify;
}
</style>
