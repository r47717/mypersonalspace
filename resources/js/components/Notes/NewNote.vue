<template>
    <div class="card">
        <div class="card-header new-note-box">
            <div>{{ trans("app.new_note") }}</div>
        </div>
        <div class="card-body">
            <textarea
                name="new-note"
                class="form-control"
                id="new-note-text"
                rows="3"
                v-model="newNote"
            ></textarea>
            <div class="note-controls mt-2">
                <button
                    class="btn btn-success"
                    @click="onClickSaveNote"
                    :disabled="!addBtnEnabled"
                >
                    {{ trans("app.save") }}
                </button>
                <note-type-select @type-changed="onTypeChanged" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    mounted() {},
    data() {
        return {
            newNote: "",
            newNoteType: "generic",
        };
    },
    computed: {
        addBtnEnabled() {
            return this.newNote.trim().length > 0;
        },
    },
    methods: {
        onTypeChanged(type) {
            this.newNoteType = type;
        },
        async onClickSaveNote() {
            try {
                const resp = await axios.post("/notes", {
                    note: this.newNote,
                    type: this.newNoteType,
                });
                console.log(resp);
                this.newNote = "";
                this.newNoteType = "generic";
                this.$emit("new-note-added");
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>

<style scoped lang="scss">
.new-note-box {
    display: flex;
    justify-content: space-between;
}

#new-note-text {
    width: 100%;
}

.note-controls {
    display: flex;
    justify-content: space-between;
}
</style>
