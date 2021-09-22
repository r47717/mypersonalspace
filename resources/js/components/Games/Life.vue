<template>
    <div class="card d-inline-flex">
        <div class="card-header">Игра "Жизнь"</div>
        <div class="card-body">
            <canvas
                width="1000"
                height="600"
                ref="field"
            />
            <div>
                <div class="mt-3"><span>Начальный объём популяции: </span><input type="text" v-model="initCount" ></div>
                <div class="mt-3">
                    <button class="btn btn-warning" @click="speedUp">Ускорить</button>
                    <button class="btn btn-info ml-2" @click="speedDown">Замедлить</button>
                    <button class="btn btn-primary ml-5" @click="restart">Рестарт</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
const WW = 1000;
const HH = 600;
const DX = 20;
const DY = 20;
const NX = WW / DX;
const NY = HH / DY;
const accelerationRate = 0.8;

export default {
    name: "Life",
    data() {
        return {
            stopped: false,
            field: [],
            speed: 1000, // ms
            timer: null,
            fieldColor: "eeeeee",
            gridColor: "aaaaaa",
            cellColor: "000000",
            initCount: 300,
        };
    },
    
    mounted() {
        this.restart();
    },
    
    beforeDestroy() {
        if (this.timer) {
            clearInterval(this.timer);
        }
    },

    watch: {
        field() {
            this.paint();
        }
    },

    methods: {
        initField() {
            this.field = new Array(NX * NY).fill(0);
            this.randomEntities();
            //this.paint();
        },

        randomEntities() {
            for (let i = 0; i < this.initCount; i++) {
                let index;
                do {
                    index = Math.floor(Math.random() * NX * NY)
                } while(this.field[index] !== 0);

                this.field[index] = 1;
            }
        },

        getX(index) {
            return index % NX;
        },

        getY(index) {
            return Math.floor(index / NX);
        },

        getIndex(x, y) {
            return y * NX + x;
        },

        getNeighborsCount(index) {
            const x = this.getX(index);
            const y = this.getY(index);

            const nb = new Array(8);
            nb[0] = [x === 0 ? NX - 1 : x - 1, y === 0 ? NY - 1 : y - 1]
            nb[1] = [x, y === 0 ? NY - 1 : y - 1]
            nb[2] = [x === NX - 1 ? 0 : x + 1, y === 0 ? NY - 1 : y - 1]
            nb[3] = [x === 0 ? NX - 1 : x - 1, y]
            nb[4] = [x === NX - 1 ? 0 : x + 1, y]
            nb[5] = [x === 0 ? NX - 1 : x - 1, y === NY - 1 ? 0 : y + 1]
            nb[6] = [x, y === NY - 1 ? 0 : y + 1]
            nb[7] = [x === NX - 1 ? 0 : x + 1,  y === NY - 1 ? 0 : y + 1]

            return nb.reduce((acc, curr) => acc + this.field[this.getIndex(curr[0], curr[1])], 0);
        },

        step() {
            const newField = this.field.slice();

            for (let index = 0; index < this.field.length; index++) {
                const count = this.getNeighborsCount(index)
                if (this.field[index] === 0 && count === 3) {
                    newField[index] = 1;
                } else if (this.field[index] === 1 && (count > 3 || count < 2)) {
                    newField[index] = 0;
                }
            }

            this.field = newField;
        },

        paint() {
            const ctx = this.$refs.field.getContext("2d");

            ctx.fillStyle = `#${this.fieldColor}`;
            ctx.fillRect(0, 0, WW, HH);

            ctx.strokeStyle = `#${this.fieldColor}`;
            ctx.strokeRect(0, 0, WW, HH);

            ctx.strokeStyle = `#${this.gridColor}`;
            ctx.beginPath();

            let x = 0;
            while (x <= WW) {
                ctx.moveTo(x, 0);
                ctx.lineTo(x, HH);
                x += DX;
            }

            let y = 0;
            while (y <= HH) {
                ctx.moveTo(0, y);
                ctx.lineTo(WW, y);
                y += DY;
            }

            ctx.lineWidth = 1;
            ctx.closePath();
            ctx.stroke();

            this.field.map((cell, index) => {
                if (cell) {
                    const y = this.getY(index);
                    const x = this.getX(index);
                    
                    ctx.fillStyle = `#${this.cellColor}`;
                    ctx.fillRect(x * DX, y * DY, DX, DY);
                }
            })
        },

        go() {
            this.step();
        },

        resetTimer() {
            if (this.timer) {
                clearInterval(this.timer);
            }
            this.timer = setInterval(this.go, this.speed);
        },

        restart() {
            this.initField();
            this.resetTimer();
        },

        speedUp() {
            this.speed *= accelerationRate;
            this.resetTimer();
        },

        speedDown() {
            this.speed /= accelerationRate;
            this.resetTimer();
        }
    },
};
</script>

<style scoped></style>
