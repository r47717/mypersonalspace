<template>
    <div class="card">
        <div class="card-header new-note-box">
            <div>{{ trans('app.new_note') }}</div>
            <div><a href="/notes">{{ trans('app.go_to_notes') }}</a></div>
        </div>
        <div class="card-body">
            <textarea name="new-note" class="form-control"  id="new-note-text" rows="3" v-model="newNote"></textarea>
            <button class="btn btn-success mt-2" @click="onClickSaveNote" :disabled="!addBtnEnabled">{{ trans('app.save') }}</button>
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
                newNote: ""
            }
        },
        computed: {
            addBtnEnabled() {
                return this.newNote.trim().length > 0;
            }
        },
        methods: {
            async onClickSaveNote() {
                try {
                    const resp = await axios.post("/notes", { text: this.newNote });
                    console.log(resp);
                    this.newNote = "";
                } catch(e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .new-note-box {
        display: flex;
        justify-content: space-between;
    }

    #new-note-text {
        width: 100%;
    }
</style>
