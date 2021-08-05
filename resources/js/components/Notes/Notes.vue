<template>
    <div>
        <div class="mb-5 d-flex flex-wrap" v-if="notes.length > 0">
            <google-note
                title="Untitled"
                v-for="item in notes"
                :text="item.text"
            ></google-note>
        </div>
        <div v-else>
            <div class="mb-5 no-notes">
                Заметок пока нет, но это же временно?
            </div>
        </div>
        <div class="mt-5">
            <new-note @new-note-added="onNewNoteAdded"></new-note>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    async mounted() {
        await this.fetchNotes();
    },
    data() {
        return {
            notes: [],
        };
    },
    methods: {
        async fetchNotes() {
            const response = await axios.get("/fetch-notes");
            this.notes = (response.data && response.data.notes) || [];
            console.log(this.notes);
        },
        async onNoteRemove(id) {
            await axios.delete(`/notes/${id}`);
            await this.fetchNotes();
        },
        async onNewNoteAdded() {
            await this.fetchNotes();
        },
        getNotesByType(type) {
            return this.notes.filter((note) => note.type === type);
        },
        onTypeFilterChanged(value) {
            this.filter = value;
        },
    },
};
</script>

<style scoped lang="scss">
.no-notes {
    font-style: italic;
}

.main-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.note-line {
    & > span {
        padding: 5px;
    }

    button {
        margin-left: 20px;
    }
}
</style>
