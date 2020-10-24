<template>
    <div class="card">
        <div class="card-header">Мои мысли</div>
        <div class="card-body">
            <div class="mb-5" v-if="thoughts.length > 0">
                <div class="" v-for="item in thoughts" :data-id="item.id">
                    {{ item.text }}
                    <button type="button" class="close" @click="onThoughtRemove(item.id)">
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="mb-5 no-thoughts">Мыслей пока нет. Добавите?</div>
            </div>
            <input class="form-control" type="text" name="add-thought" v-model="newThought" @keyup.enter="onEnter">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        async mounted() {
            await this.fetchThoughts();
        },
        data() {
            return {
                thoughts: [],
                newThought: ''
            }
        },
        methods: {
            async fetchThoughts() {
                const response = await axios.get('/fetch-thoughts');
                this.thoughts = response.data && response.data.thoughts || [];
                console.log(this.thoughts);
            },
            async onEnter() {
                if(this.newThought.trim().length) {
                    await axios.post('/thoughts', {
                        text: this.newThought
                    });
                    this.newThought = '';
                    await this.fetchThoughts();
                }
            },
            async onThoughtRemove(id) {
                await axios.delete(`/thoughts/${id}`);
                await this.fetchThoughts();
            }
        }
    }
</script>

<style scoped lang="scss">
    .no-thoughts {
        font-style: italic;
    }
</style>
