<template>
    <div class="card">
        <div class="card-header">{{ snakeTitle }}</div>
        <div class="card-body d-flex justify-content-center">
            <canvas
                ref="canvas"
                :style="{width: `${this.width}px`, height: `${this.height}px`}"
                tabindex="-1"
                @keydown="onKeyDown"
                @dblclick="onDblClick"
            >
            </canvas>
        </div>
    </div>
</template>

<script>
import {Snake} from './snake'
import {Field} from './field'
import {Mongoose} from "./mongoose";
import {Food} from "./food";

const FIELD_X_MIN = 0;
const FIELD_Y_MIN = 0;
const FIELD_X_MAX = 29;
const FIELD_Y_MAX = 29;

export default {
    name: "snake",
    data() {
        return {
            width: 600,
            height: 600,
            gameStopped: true,
            snakeLength: 5,
            canvas: null,
            snake: null,
            field: null,
            mongoose: null,
            food: null,
        }
    },

    computed: {
        snakeTitle() {
            return this.gameStopped ? `Змейка - ${this.snakeLength} - (пауза)` : `Змейка - ${this.snakeLength}`;
        }
    },

    mounted() {
        this.init();
    },

    methods: {
        init() {
            this.canvas = this.$refs.canvas;

            this.snake = new Snake(FIELD_X_MIN, FIELD_X_MAX, FIELD_Y_MIN, FIELD_Y_MAX);
            this.field = new Field(this.canvas, 30, 30, this.width, this.height);
            this.mongoose = new Mongoose(FIELD_X_MIN, FIELD_X_MAX, FIELD_Y_MIN, FIELD_Y_MAX);
            this.food = new Food(FIELD_X_MIN, FIELD_X_MAX, FIELD_Y_MIN, FIELD_Y_MAX);

            this.field.connect(this.snake, this.mongoose, this.food);

            this.canvas.setAttribute('width', this.width);
            this.canvas.setAttribute('height', this.width);

            this.canvas.focus();

            // document.onkeydown = function (e) {
            //     let key = e.key;
            //     if (key == 37 || key == 38 || key == 39 || key == 40) {
            //         e.preventDefault();
            //         return false;
            //     }
            //     return true;
            // };

            this.field.draw();

            let intv = setInterval(() => {
                if (this.gameStopped) return;

                if (!this.snake.run(this.field)) {
                    clearInterval(intv);
                    return;
                }
                this.snakeLength = this.snake.getLength();
                this.mongoose.run(this.field);
                this.food.run(this.field);
                this.field.draw();

            }, 700);

        },

        onKeyDown(e) {
            e.preventDefault();
            e.stopPropagation();
            this.snake.control(e.key);
        },

        onDblClick() {
            this.gameStopped = !this.gameStopped;
        }

    }
}
</script>

<style scoped>

</style>
