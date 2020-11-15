<template>
    <div>
        <div class="card">
            <div class="card-header">Мои заметки</div>
            <div class="card-body">
                <div class="mb-5 d-flex flex-wrap" v-if="notes.length > 0">
                    <div v-for="type in Object.keys(types)">
                        <div class="card m-2" v-if="getNotesByType(type).length > 0">
                            <div class="card-header">{{ types[type] }}</div>
                            <div class="card-body">
                                <div class="note-line" v-for="item in getNotesByType(type)" :data-id="item.id">
                                    <span>"{{ item.text }}"</span>
                                    <button type="button" class="close" @click="onNoteRemove(item.id)">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="mb-5 no-notes">Заметок пока нет, но это же временно?</div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <new-note @new-note-added="onNewNoteAdded"></new-note>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    async mounted() {
        await this.fetchNotes();
    },
    data() {
        return {
            notes: [],
            filter: null,
            types: {
                "generic": 'обычная',
                "list": "список",
                "reminder": "напоминание",
                "experience": "опыт",
                "wish": "желание",
            }
        }
    },
    methods: {
        async fetchNotes() {
            const response = await axios.get('/fetch-notes');
            this.notes = response.data && response.data.notes || [];
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
            return this.notes.filter(note => note.type === type);
        }
    }
}
</script>

<style scoped lang="scss">
.no-notes {
    font-style: italic;
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
