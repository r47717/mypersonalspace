<template>
    <canvas
        ref="canvas"
        :style="{width: `${this.width}px`, height: `${this.height}px`}"
        @click="onClick"
    ></canvas>
</template>

<script>
const colors = [
    ['#eeeeee', '#aaaaaa'],
    ['#ffeeee', '#ffaaaa'],
    ['#eeffee', '#aaffaa'],
    ['#eeeeff', '#aaaaff'],
    ['#ffffee', '#ffffaa'],
    ['#dddddd', '#bbbbbb'],
    ['#dddd99', '#bbbb99'],
];

export default {
    name: "Balls",

    data() {
        return {
            width: 600,
            height: 500,
            ballColor1: '#eeeeee',
            ballColor2: '#aaaaaa',
            currentColor: 0,
            canvas: null,
            ctx: null,
        }
    },

    mounted() {
        this.canvas = this.$refs.canvas;
        this.ctx = this.canvas.getContext('2d');

        this.canvas.setAttribute('width', this.width);
        this.canvas.setAttribute('height', this.height);

        this.clearCanvas();

        this.runBall(0, 0, this.width, this.height);

    },

    methods: {
        changeColor() {
            if (++this.currentColor >= colors.length) {
                this.currentColor = 0;
            }
            this.ballColor1 = colors[this.currentColor][0];
            this.ballColor2 = colors[this.currentColor][1];
        },

        clearCanvas() {
            this.ctx.fillStyle = 'white';
            this.ctx.fillRect(0, 0, this.width, this.height);
            this.ctx.strokeStyle = 'black';
            this.ctx.lineWidth = 1;
            this.ctx.strokeRect(0, 0, this.width, this.height);
        },

        runBall(x1, y1, x2, y2) {
            let size = 40;
            let minSize = 30;
            let maxSize = 50;
            let speedX = 1;
            let speedY = 1;
            let speedSize = 1;
            let sizeGap = 10;
            let x = x1 + size;
            let y = y1 + size;

            const drawBall = () => {
                const gradient = this.ctx.createRadialGradient(x, y, 0, x, y, size);
                gradient.addColorStop(0, this.ballColor1);
                gradient.addColorStop(.9, this.ballColor2);

                this.ctx.fillStyle = gradient;
                this.ctx.beginPath();
                this.ctx.arc(x, y, size, 0, Math.PI * 2);
                this.ctx.fill();
            }

            const move1px = () => {
                if (sizeGap === 0) {
                    if (speedSize === 1) {
                        if (size >= maxSize) speedSize = -1;
                        else size++;
                    } else {
                        if (size <= minSize) speedSize = 1;
                        else size--;
                    }
                    sizeGap = 10;
                } else sizeGap--;

                let newX, newY;

                if (speedX > 0) {
                    if (x + size + 1 >= x2) {
                        speedX = -1;
                        newX = x - 1;
                    } else {
                        newX = x + 1;
                    }
                } else {
                    if (x - 1 <= x1 + size) {
                        newX = x + 1;
                        speedX = 1;
                    } else {
                        newX = x - 1;
                    }
                }
                if (speedY > 0) {
                    if (y + size + 1 >= y2) {
                        speedY = -1;
                        newY = y - 1;
                    } else {
                        newY = y + 1;
                    }
                } else {
                    if (y - 1 <= y1 + size) {
                        newY = y + 1;
                        speedY = 1;
                    } else {
                        newY = y - 1;
                    }
                }

                x = newX;
                y = newY;
            };

            const step = (timestamp) => {
                move1px();
                this.clearCanvas();
                drawBall();
                requestAnimationFrame(step);
            };

            requestAnimationFrame(step);
        },

        onClick() {
            this.changeColor()
        }
    }
}
</script>

<style scoped>
</style>
