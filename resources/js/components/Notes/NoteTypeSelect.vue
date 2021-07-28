<template>
    <select
        class="form-control"
        name="new-note-type"
        v-model="newNoteType"
        @change="onChange"
    >
        <option value="all" v-if="all === 'true'">Все</option>
        <option value="generic">обычная</option>
        <option value="list">список</option>
        <option value="reminder">напоминание</option>
        <option value="experience">опыт</option>
        <option value="wish">желание</option>
    </select>
</template>

<script>
export default {
    name: "NoteTypeSelect",
    props: ["all"],
    data() {
        return {
            newNoteType: this.all === "true" ? "all" : "generic",
        };
    },
    methods: {
        onChange(el) {
            this.$emit("type-changed", el.target.value);
        },
    },
};
</script>

<style scoped>
select {
    width: 200px;
}
</style>
