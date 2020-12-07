<template>
    <div class="card d-inline-flex">
        <div class="card-header">Тетрис ({{ score }})</div>
        <div class="card-body">
            <canvas width="300" height="600" class="tetris-field" tabindex=-1 ref="field" @keyup="onKeyDown"/>
        </div>
    </div>
</template>

<script>

const WW = 300;
const HH = 600;
const DX = 20;
const DY = 20;
const NX = WW / DX;
const NY = HH / DY;
const FIGURE_SIZE = 4;
const FIELD_COLOR = "#c0a1ea";
const FIGURE_COLOR = "#5add49";

export default {
    name: "Tetris",
    data() {
        return {
            timer: null,
            speed: 1000, // ms
            stopped: false,
            movingFigure: null,
            cells: [],
            figureTypes: [1, 2, 3, 4, 5, 6, 7],
            score: 0,
        }
    },
    mounted() {
        this.timer = setInterval(this.move, this.speed);
        this.$refs.field.focus();
        this.cells = new Array(NY).fill(0).map(row => new Array(NX).fill(0));
    },
    beforeDestroy() {
        clearInterval(this.timer);
    },
    methods: {
        print() {
            for (let i = 0; i < NY; i++) {
                let row = "";
                for (let j = 0; j < NX; j++) {
                    row += this.cells[i][j];
                }
                console.log(row);
            }
        },
        paint() {
            const ctx = this.$refs.field.getContext('2d');

            ctx.fillStyle = FIELD_COLOR;
            ctx.fillRect(0, 0, WW, HH);

            ctx.fillStyle = FIGURE_COLOR;
            for (let i = 0; i < NY; i++) {
                for (let j = 0; j < NX; j++) {
                    if (this.cells[i][j]) {
                        ctx.fillRect(j * DY, i * DX, DY, DX);
                    }
                }
            }

            if (this.movingFigure) {
                this.movingFigure.cells.forEach(({x, y}) => {
                    ctx.fillRect(x * DY, y * DX, DY, DX);
                })
            }
        },
        move() {
            if (!this.stopped) {
                if (!this.movingFigure) {
                    this.createNewFigure();
                } else {
                    if (this.canMoveDown()) {
                        this.moveFigureDown();
                    } else {
                        this.saveFigureToCells();
                        this.movingFigure = null;
                        this.eraseFullLines();
                    }
                }

                this.paint();
                this.print();
            }
        },
        getNewFigureType() {
            return this.figureTypes[Math.floor(Math.random() * Math.floor(this.figureTypes.length))];
        },
        createNewFigure() {
            const type = this.getNewFigureType();
            const top = 0;
            const left = Math.ceil(NX / 2) - Math.floor(FIGURE_SIZE / 2);
            const f = this.movingFigure = {
                cells: [],
            };
            switch (type) {
                case 1:
                    f.cells = [
                        {
                            y: top, x: left,
                        },
                        {
                            y: top, x: left + 1,
                        },
                        {
                            y: top, x: left + 2,
                        },
                        {
                            y: top, x: left + 3,
                        }
                    ];
                    break;
                case 2:
                    f.cells = [
                        {
                            y: top, x: left,
                        },
                        {
                            y: top, x: left + 1,
                        },
                        {
                            y: top + 1, x: left + 1,
                        },
                        {
                            y: top + 1, x: left + 2,
                        }
                    ];
                    break;
                case 3:
                    f.cells = [
                        {
                            y: top, x: left + 1,
                        },
                        {
                            y: top, x: left + 2,
                        },
                        {
                            y: top + 1, x: left,
                        },
                        {
                            y: top + 1, x: left + 1,
                        }
                    ];
                    break;
                case 4: // T
                    f.cells = [
                        {
                            y: top, x: left + 1,
                        },
                        {
                            y: top + 1, x: left,
                        },
                        {
                            y: top + 1, x: left + 1,
                        },
                        {
                            y: top + 1, x: left + 2,
                        }
                    ];
                    break;
                case 5: // square
                    f.cells = [
                        {
                            y: top, x: left,
                        },
                        {
                            y: top, x: left + 1,
                        },
                        {
                            y: top + 1, x: left,
                        },
                        {
                            y: top + 1, x: left + 1,
                        }
                    ];
                    break;
                case 6:
                    f.cells = [
                        {
                            y: top, x: left,
                        },
                        {
                            y: top + 1, x: left,
                        },
                        {
                            y: top + 1, x: left + 1,
                        },
                        {
                            y: top + 1, x: left + 2,
                        }
                    ];
                    break;
                case 7:
                    f.cells = [
                        {
                            y: top, x: left + 2,
                        },
                        {
                            y: top + 1, x: left,
                        },
                        {
                            y: top + 1, x: left + 1,
                        },
                        {
                            y: top + 1, x: left + 2,
                        }
                    ];
                    break;
                default:
                    throw new Error('unknown figure type');
            }
        },
        saveFigureToCells() {
            this.movingFigure.cells.forEach(({x, y}) => {
                this.cells[y][x] = 1;
            });
        },
        canMoveDown() {
            for (const {x, y} of this.movingFigure.cells) {
                if (y >= NY - 1 || this.cells[y + 1][x] === 1) {
                    return false;
                }
            }

            return true;
        },
        moveFigureDown() {
            this.movingFigure.cells.forEach((item) => {
                item.y++;
            });
        },
        tryMoveFigureLeft() {
            for (const {x, y} of this.movingFigure.cells) {
                if (x <= 0 || this.cells[y][x - 1] === 1) {
                    return false;
                }
            }

            this.movingFigure.cells.forEach((item) => {
                item.x--;
            });
        },
        tryMoveFigureRight() {
            for (const {x, y} of this.movingFigure.cells) {
                if (x >= NX - 1 || this.cells[y][x + 1] === 1) {
                    return false;
                }
            }

            this.movingFigure.cells.forEach((item) => {
                item.x++;
            });
        },
        tryRotateFigure() {
            const newFigure = [];

            const cells = this.movingFigure.cells;

            let minX = cells[0].x;
            let maxX = cells[0].x;
            let minY = cells[0].y;
            let maxY = cells[0].y;
            for (let i = 1; i < cells.length; i++) {
                if (cells[i].x < minX) minX = cells[i].x;
                if (cells[i].x > maxX) maxX = cells[i].x;
                if (cells[i].y < minY) minY = cells[i].y;
                if (cells[i].y > maxY) maxY = cells[i].y;
            }

            const diam = Math.max(maxX - minX, maxY - minY) + 1;

            const matrix = new Array(diam).fill(0).map(row => new Array(diam).fill(0));
            cells.forEach(({x, y}) => {
                matrix[y - minY][x - minX] = 1;
            })

            const matrix2 = new Array(diam).fill(0).map(row => new Array(diam).fill(0));
            for (let i = 0; i < diam; i++) {
                for (let j = 0; j < diam; j++) {
                    matrix2[i][j] = matrix[diam - j - 1][i];
                }
            }

            for (let i = 0; i < diam; i++) {
                for (let j = 0; j < diam; j++) {
                    if (matrix2[i][j] === 1) {
                        newFigure.push({
                            x: minX + j,
                            y: minY + i,
                        })
                    }
                }
            }

            let conflict = false;
            newFigure.forEach(({x, y}) => {
                if (x > NX - 1 || x < 0 || y > NY - 1 || y < 0 || this.cells[y][x] === 1) {
                    conflict = true;
                }
            });

            if (!conflict) {
                this.movingFigure.cells = newFigure;
                this.paint();
            }
        },
        dropFigure() {
            while (this.canMoveDown()) {
                this.moveFigureDown();
            }
        },
        onKeyDown(event) {
            if (!this.movingFigure) {
                return;
            }

            switch (event.keyCode) {
                case 32: // space
                case 40: // down
                    this.dropFigure();
                    break;
                case 37: // left
                    this.tryMoveFigureLeft();
                    break;
                case 38: // up
                    this.tryRotateFigure();
                    break;
                case 39: // right
                    this.tryMoveFigureRight();
                    break;
            }
            this.paint();
        },
        eraseFullLines() {
            let erased;
            do {
                erased = false;
                for (let row = 0; row < this.cells.length; row++) {
                    if (this.cells[row].every(cell => cell === 1)) {
                        this.removeRow(row);
                        erased = true;
                        this.score++;
                        break;
                    }

                }
            } while (erased);
        },
        removeRow(row) {
            this.cells.splice(row, 1);
            this.cells.unshift(new Array(NX).fill(0));
        }
    }
}
</script>

<style lang="scss">
.tetris-field {
    background: #c0a1ea;
    width: 300px;
    height: 600px;
    border: 1px solid #aaaaaa;
}
</style>
