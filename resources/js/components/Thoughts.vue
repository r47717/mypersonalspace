<template>
    <div class="card">
        <div class="card-header">Мои мысли</div>
        <div class="card-body">
            <ul>
                <li v-for="item in thoughts">{{ item.text }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {

        },
        data() {
            return {
                thoughts: [
                    {
                        text: 'Идея 1',
                    },
                    {
                        text: 'Идея 2',
                    },
                    {
                        text: 'Идея 3',
                    },
                    {
                        text: 'Идея 4',
                    },
                ]
            }
        }
    }
</script>

<style scoped lang="scss">
</style>
