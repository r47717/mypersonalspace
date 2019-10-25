<template>
    <div class="card">
        <div class="card-header new-file-box">
            <div>{{ trans('app.new_file') }}</div>
            <div><a href="/files">{{ trans('app.go_to_files') }}</a></div>
        </div>
        <div class="card-body">
            <input type="file" id="file" ref="fileUpload">
            <input type="text" class="form-control mt-2" id="file-comment" placeholder="Comment" v-model="fileComment">
            <button class="btn btn-success mt-2" @click="onClickSaveFile">{{ trans('app.save') }}</button>
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
                fileValue: "",
                fileComment: ""
            }
        },
        computed: {
        },
        methods: {
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
    .new-file-box {
        display: flex;
        justify-content: space-between;
    }
</style>
