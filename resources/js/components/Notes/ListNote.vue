<template>
    <ul>
        <li v-for="item in items">{{ item }}</li>
    </ul>
</template>

<script>
export default {
    name: "ListNote",
    props: ['text'],
    data() {
        return {}
    },
    computed: {
        items() {
            return this.text.split(' ');
        }
    }
}
</script>

<style scoped>

</style>
