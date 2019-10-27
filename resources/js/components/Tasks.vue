<template>
    <div class="card">
        <div class="card-header tasks-box">{{ trans('app.tasks') }}</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr v-for="item in tasks">
                    <td>{{ item.id }}</td>
                    <td>{{ item.title }}</td>
                    <td>{{ item.deadline }}</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            console.log(this.items);
        },
        data() {
            return {
                tasks: []
            }
        }
    }
</script>

<style scoped lang="scss">
</style>
