<template>
    <div>
        <div class="card">
            <div class="card-header">Мои заметки</div>
            <div class="card-body">
                <div class="mb-5" v-if="notes.length > 0">
                    <div class="" v-for="item in notes" :data-id="item.id">
                        "{{ item.text }}"
                        <button type="button" class="close" @click="onNoteRemove(item.id)">
                            <span>&times;</span>
                        </button>
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
        }
    }
}
</script>

<style scoped lang="scss">
.no-notes {
    font-style: italic;
}
</style>
