<template>
    <div class="card">
        <div class="card-header tasks-box">{{ trans('app.tasks') }}</div>
        <div class="card-body">
            <table class="table table-bordered table-striped" v-if="tasks.length > 0">
                <tr>
                    <th>ID</th>
                    <th>Задача</th>
                    <th>Описание</th>
                    <th>Дедлайн</th>
                    <th>Сделана</th>
                </tr>
                <tr v-for="item in tasks">
                    <td>{{ item.id }}</td>
                    <td>{{ item.title }}</td>
                    <td>{{ item.description }}</td>
                    <td>{{ item.deadline }}</td>
                    <td>{{ item.status }}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" @click="onTaskDelete(item.id)">Удалить</button>
                    </td>
                </tr>
            </table>
            <div v-else><i>Задач пока нет</i></div>
            <div class="mt-5">
                <input type="text" class="form-control mb-2" v-model:value="newTask.title" placeholder="Задача">
                <input type="text" class="form-control mb-2" v-model:value="newTask.description" placeholder="Описание">
                <input type="checkbox" class="mb-2 mr-3" v-model:value="newTask.status"><span>Сделана</span>
                <input type="text" class="form-control mb-2" v-model:value="newTask.deadline" placeholder="Срок исполнения">
                <button class="btn btn-success btn-sm" @click="onAddNewTask()" :disabled="newTask.title.trim().length === 0">Добавить новую задачу</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            console.log(this.items);
            this.fetchTasks();
        },
        data() {
            return {
                tasks: [],
                newTask: {
                    title: "",
                    description: "",
                    deadline: "",
                    status: false,
                },
            }
        },
        methods: {
            async fetchTasks() {
                const response = await axios('/fetch-tasks');
                console.log(response);
                this.tasks = response && response.data && response.data.tasks;
            },
            async onAddNewTask() {
                const tasks = await axios.post(`/tasks`, {
                    title: this.newTask.title,
                    description: this.newTask.description,
                    deadline: this.newTask.deadline,
                    status: this.newTask.status,
                });
                await this.fetchTasks();
                this.newTask = {
                    title: "",
                    description: "",
                    deadline: "",
                    status: false,
                };
            },
            async onTaskDelete(id) {
                const tasks = await axios.delete(`/tasks/${id}`);
                await this.fetchTasks();
            }
        }
    }
</script>

<style scoped lang="scss">
</style>
