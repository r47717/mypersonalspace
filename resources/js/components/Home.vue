<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body dashboard-title">@lang('home.dashboard.title')</div>
                </div>
            </div>
        </div>
        <div class="row widgets">
            <div class="col-6">
                <div class="card">
                    <div class="card-header new-note-box">
                        <div>@lang('New Note')</div>
                        <div><a href="/notes">Go to my notes</a></div>
                    </div>
                    <div class="card-body">
                        <textarea name="new-note" class="form-control"  id="new-note-text" rows="10" v-model="newNote"></textarea>
                        <button class="btn btn-success mt-2" @click="onClickSaveNote" :disabled="!addBtnEnabled">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header new-file-box">
                        <div>New File</div>
                        <div><a href="/files">Go to my file box</a></div>
                    </div>
                    <div class="card-body">
                        <input type="file" id="file" ref="fileUpload">
                        <input type="text" class="form-control mt-2" id="file-comment" placeholder="Comment" v-model="fileComment">
                        <button class="btn btn-success mt-2" @click="onClickSaveFile">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row tasks">
            <div class="col-12">
                <div class="card">
                    <div class="card-header tasks-box">Tasks</div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
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
                newNote: "",
                fileValue: "",
                fileComment: ""
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
            },
            async onClickSaveFile() {
                const formData = new FormData();
                const file = document.querySelector('#file');
                formData.append("file", file.files[0]);
                formData.append("comment", this.fileComment);
                try {
                    await axios.post('/files', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    this.$refs.fileUpload.value = '';
                    this.fileComment = "";
                } catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .dashboard-title {
        text-align: center;
    }

    .widgets {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .new-note-box {
        display: flex;
        justify-content: space-between;
    }

    #new-note-text {
        width: 100%;
    }
    .new-file-box {
        display: flex;
        justify-content: space-between;
    }
</style>
