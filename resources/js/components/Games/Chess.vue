<template>
    <div class="card d-inline-block">
        <div class="card-header">Шахматы</div>
        <div class="card-body d-flex justify-content-center">
            <canvas
                ref="canvas"
                :style="{
                    width: `${this.width}px`,
                    height: `${this.height}px`,
                }"
                @click="onClick"
            >
            </canvas>
        </div>
    </div>
</template>

<script>
const WW = 640;
const HH = 640;
const NCELLS = 8;

const FIELD_X_MIN = 0;
const FIELD_Y_MIN = 0;
const FIELD_X_MAX = 63;
const FIELD_Y_MAX = 63;

export default {
    name: "snake",
    data() {
        return {
            width: WW,
            height: HH,
            canvas: null,
            ctx: null,
            dx: WW / NCELLS,
            dy: HH / NCELLS,
        };
    },

    computed: {},

    mounted() {
        this.init();
    },

    methods: {
        init() {
            this.canvas = this.$refs.canvas;
            this.canvas.setAttribute("width", this.width);
            this.canvas.setAttribute("height", this.height);
            this.canvas.focus();
            this.ctx = this.canvas.getContext("2d");

            this.drawBoard();
        },

        drawBoard() {
            this.ctx.fillStyle = "white";
            this.ctx.fillRect(0, 0, this.width, this.height);

            this.ctx.strokeStyle = "gray";

            this.ctx.strokeRect(0, 0, this.width, this.height);

            this.ctx.beginPath();

            let x = this.dx;
            while (x < this.width) {
                this.ctx.moveTo(x, 0);
                this.ctx.lineTo(x, this.height);
                x += this.dx;
            }

            let y = this.dy;
            while (y < this.height) {
                this.ctx.moveTo(0, y);
                this.ctx.lineTo(this.width, y);
                y += this.dy;
            }

            this.ctx.lineWidth = 1;
            this.ctx.closePath();
            this.ctx.stroke();
        },

        onClick() {},
    },
};
</script>

<style scoped></style>
