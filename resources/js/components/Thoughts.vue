<template>
    <div class="card">
        <div class="card-header">Мои мысли</div>
        <div class="card-body">
            <div class="mb-5" v-if="thoughts.length > 0">
                <div class="alert alert-info alert-dismissible fade show" v-for="item in thoughts">
                    {{ item.text }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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
        mounted() {
            this.fetchThoughts();
        },
        data() {
            return {
                thoughts: [],
                newThought: ''
            }
        },
        methods: {
            async fetchThoughts() {
                const response = await axios.get('/thoughts');
                this.thoughts = response.data && response.data.thoughts || [];
            },
            async onEnter() {
                if(this.newThought.trim().length) {
                    await axios.post('/thoughts', {
                        text: this.newThought
                    });
                    this.thoughts.push({
                        text: this.newThought
                    });
                    this.newThought = '';
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .no-thoughts {
        font-style: italic;
    }
</style>
