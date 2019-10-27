<template>
    <div class="card">
        <div class="card-header">Мои мысли</div>
        <div class="card-body">
            <ul v-if="thoughts.length > 0">
                <li v-for="item in thoughts">{{ item.text }}</li>
            </ul>
            <div v-else>
                <emp>Мыслей пока нет</emp>
            </div>
            <input class="form-control" type="text" name="add-thought" v-model="newThought">
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
                newThought: ""
            }
        },
        methods: {
            async fetchThoughts() {
                const response = await axios.get('/thoughts')
                this.thoughts = response.data.thoughts;
            }
        }
    }
</script>

<style scoped lang="scss">
</style>
