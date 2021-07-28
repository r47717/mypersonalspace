<template>
    <div class="card d-inline-flex">
        <div class="card-header">Тетрис (счёт: {{ score }})</div>
        <div class="card-body">
            <div class="stopped" v-if="stopped">Игра окончена</div>
            <div class="d-flex">
                <canvas
                    width="300"
                    height="600"
                    class="tetris-field"
                    tabindex="-1"
                    ref="field"
                    @keydown.prevent="onKeyDown"
                />
                <div class="ml-5 d-flex">
                    <div
                        class="
                            d-flex
                            flex-column
                            align-items-start
                            justify-content-between
                        "
                    >
                        <div
                            class="
                                align-self-center
                                d-flex
                                flex-column
                                align-items-center
                            "
                        >
                            <p>Следующая фигура:</p>
                            <canvas
                                width="120"
                                height="120"
                                class="tetris-preview"
                                ref="preview"
                            />
                        </div>
                        <div>
                            <select class="mb-3" name="rotate" v-model="rotate">
                                <option value="clockwise">
                                    Поворот по часовой
                                </option>
                                <option value="counterclockwise">
                                    Поворот против часовой
                                </option>
                            </select>
                            <div class="d-flex align-items-center mb-3">
                                <input type="checkbox" v-model="pause" />
                                <div class="ml-1">Пауза</div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input type="checkbox" v-model="accelerate" />
                                <div class="ml-1">Ускорение</div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input
                                    type="checkbox"
                                    v-model="projectionEnabled"
                                />
                                <div class="ml-1">Проекция</div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input
                                    type="checkbox"
                                    v-model="extendedFigures"
                                />
                                <div class="ml-1">Расширенный набор фигур</div>
                            </div>
                            <div class="mb-3">
                                <table>
                                    <tr>
                                        <td>Цвет поля:</td>
                                        <td>
                                            <input
                                                type="text"
                                                v-model="fieldColor"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Цвет фигуры:</td>
                                        <td>
                                            <input
                                                type="text"
                                                v-model="figureColor"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Цвет проекции:</td>
                                        <td>
                                            <input
                                                type="text"
                                                v-model="projectionColor"
                                            />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button class="restart" @click="onRestart">
                                    Рестарт
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

const PREVIEW_PADDING = 20;
const PREVIEW_WW = DX * FIGURE_SIZE + PREVIEW_PADDING * 2;
const PREVIEW_HH = DY * FIGURE_SIZE + PREVIEW_PADDING * 2;

const basicFigures = [
    [
        { y: 0, x: 0 },
        { y: 0, x: 1 },
        { y: 0, x: 2 },
        { y: 0, x: 3 },
    ],
    [
        { y: 0, x: 0 },
        { y: 0, x: 1 },
        { y: 1, x: 1 },
        { y: 1, x: 2 },
    ],
    [
        { y: 0, x: 1 },
        { y: 0, x: 2 },
        { y: 1, x: 0 },
        { y: 1, x: 1 },
    ],
    [
        { y: 0, x: 1 },
        { y: 1, x: 0 },
        { y: 1, x: 1 },
        { y: 1, x: 2 },
    ],
    [
        { y: 0, x: 0 },
        { y: 0, x: 1 },
        { y: 1, x: 0 },
        { y: 1, x: 1 },
    ],
    [
        { y: 0, x: 0 },
        { y: 1, x: 0 },
        { y: 1, x: 1 },
        { y: 1, x: 2 },
    ],
    [
        { y: 0, x: 2 },
        { y: 1, x: 0 },
        { y: 1, x: 1 },
        { y: 1, x: 2 },
    ],
];

const extendedFigures = [
    [
        { y: 0, x: 0 },
        { y: 1, x: 1 },
        { y: 1, x: 2 },
        { y: 0, x: 2 },
    ],
    [
        { y: 0, x: 0 },
        { y: 1, x: 0 },
        { y: 1, x: 1 },
        { y: 0, x: 2 },
    ],
    [
        { y: 0, x: 0 },
        { y: 1, x: 1 },
        { y: 0, x: 2 },
        { y: 1, x: 3 },
    ],
    [
        { y: 1, x: 0 },
        { y: 0, x: 1 },
        { y: 1, x: 2 },
        { y: 0, x: 3 },
    ],
    [
        { y: 0, x: 0 },
        { y: 1, x: 1 },
        { y: 1, x: 2 },
        { y: 1, x: 3 },
    ],
];

const accelerationPlan = (score) => {
    if (score > 150) return 100;
    if (score > 100) return 200;
    if (score > 90) return 300;
    if (score > 70) return 400;
    if (score > 50) return 500;
    if (score > 30) return 600;
    if (score > 10) return 700;
    return 800;
};

export default {
    name: "Tetris",
    data() {
        return {
            fieldColor: "c0a1ea",
            figureColor: "5add49",
            projectionColor: "999999",
            timer: null,
            maxSpeed: 100, // ms
            speed: 800,
            speedCounter: 0,
            accelerate: true,
            projectionEnabled: true,
            extendedFigures: false,
            stopped: false,
            movingFigure: null,
            cells: [],
            nextFigureType: null,
            score: 0,
            rotate: "counterclockwise",
            pause: false,
        };
    },

    mounted() {
        this.timer = setInterval(this.move, this.maxSpeed);
        this.$refs.field.focus();
        this.initField();
    },

    computed: {
        projection() {
            if (!this.projectionEnabled || this.movingFigure === null) {
                return null;
            }

            let runningProjection = JSON.parse(
                JSON.stringify(this.movingFigure)
            );

            while (this.canMoveDown(runningProjection)) {
                runningProjection = this.moveFigureDown(runningProjection);
            }

            return runningProjection;
        },
        figures() {
            if (!this.extendedFigures) {
                return basicFigures;
            }

            return basicFigures.concat(extendedFigures);
        },
    },

    watch: {
        movingFigure() {
            this.paint();
        },
        cells() {
            this.paint();
        },
        projection() {
            this.paint();
        },
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

        initField() {
            this.cells = new Array(NY)
                .fill(0)
                .map((row) => new Array(NX).fill(0));
        },

        drawFigurePreview() {
            const structure = this.getFigureStructure(
                this.nextFigureType,
                0,
                0
            );

            const ctx = this.$refs.preview.getContext("2d");
            ctx.fillStyle = `#${this.fieldColor}`;
            ctx.fillRect(0, 0, PREVIEW_WW, PREVIEW_HH);

            ctx.fillStyle = `#${this.figureColor}`;
            structure.forEach(({ x, y }) => {
                ctx.fillRect(
                    PREVIEW_PADDING + x * DY,
                    PREVIEW_PADDING + y * DX,
                    DY,
                    DX
                );
            });
        },

        drawMovingFigure() {
            const ctx = this.$refs.field.getContext("2d");
            ctx.fillStyle = `#${this.figureColor}`;

            if (this.movingFigure) {
                this.movingFigure.forEach(({ x, y }) => {
                    ctx.fillRect(x * DY, y * DX, DY, DX);
                });
            }
        },

        drawProjection() {
            if (this.projection === null) {
                return null;
            }

            const ctx = this.$refs.field.getContext("2d");
            ctx.fillStyle = `#${this.projectionColor}`;
            this.projection.forEach(({ x, y }) => {
                ctx.fillRect(x * DY, y * DX, DY, DX);
            });
        },

        paint() {
            const ctx = this.$refs.field.getContext("2d");

            ctx.fillStyle = `#${this.fieldColor}`;
            ctx.fillRect(0, 0, WW, HH);

            ctx.fillStyle = `#${this.figureColor}`;
            for (let i = 0; i < NY; i++) {
                for (let j = 0; j < NX; j++) {
                    if (this.cells[i][j]) {
                        ctx.fillRect(j * DY, i * DX, DY, DX);
                    }
                }
            }

            if (this.projectionEnabled) {
                this.drawProjection();
            }

            if (this.movingFigure) {
                this.drawMovingFigure();
            }

            if (this.nextFigureType) {
                this.drawFigurePreview();
            }
        },

        move() {
            if (this.stopped || this.pause) {
                return;
            }

            if (this.speedCounter > 0) {
                this.speedCounter--;
                return;
            }

            if (!this.movingFigure) {
                if (!this.createNewFigure()) {
                    this.stopped = true;
                } else {
                    this.nextFigureType = this.getNewFigureType();
                }
            } else {
                if (this.canMoveDown(this.movingFigure)) {
                    this.movingFigure = this.moveFigureDown(this.movingFigure);
                } else {
                    this.saveFigureToCells();
                    this.movingFigure = null;
                    this.eraseFullLines();
                    if (this.accelerate) {
                        this.speed = accelerationPlan(this.score);
                    }
                }
            }

            this.speedCounter = Math.round(this.speed / this.maxSpeed);
        },

        getNewFigureType() {
            return Math.floor(Math.random() * Math.floor(this.figures.length));
        },

        getFigureStructure(type, top, left) {
            const pattern = this.figures[type];
            if (pattern === undefined) {
                throw new Error("incorrect figure type");
            }

            return pattern.map(({ x, y }) => ({ x: left + x, y: top + y }));
        },

        createNewFigure() {
            const type = this.nextFigureType || this.getNewFigureType();
            const top = 0;
            const left = Math.ceil(NX / 2) - Math.floor(FIGURE_SIZE / 2);
            const f = this.getFigureStructure(type, top, left);

            for (const { x, y } of f) {
                if (this.cells[y][x] === 1) {
                    return false;
                }
            }

            this.movingFigure = f;
            return true;
        },

        saveFigureToCells() {
            const newCells = this.cells.slice();
            this.movingFigure.forEach(({ x, y }) => {
                newCells[y][x] = 1;
            });

            this.cells = newCells;
        },

        canMoveDown(figureCells) {
            for (const { x, y } of figureCells) {
                if (y >= NY - 1 || this.cells[y + 1][x] === 1) {
                    return false;
                }
            }

            return true;
        },

        moveFigureDown(figureCells) {
            const newCells = figureCells.slice();
            newCells.forEach((item) => {
                item.y++;
            });

            return newCells;
        },

        tryMoveFigureLeft() {
            for (const { x, y } of this.movingFigure) {
                if (x <= 0 || this.cells[y][x - 1] === 1) {
                    return false;
                }
            }

            this.movingFigure = this.movingFigure.map(({ x, y }) => ({
                y,
                x: x - 1,
            }));
        },

        tryMoveFigureRight() {
            for (const { x, y } of this.movingFigure) {
                if (x >= NX - 1 || this.cells[y][x + 1] === 1) {
                    return false;
                }
            }

            this.movingFigure = this.movingFigure.map(({ x, y }) => ({
                y,
                x: x + 1,
            }));
        },

        tryRotateFigure() {
            const newFigure = [];

            const cells = this.movingFigure;

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

            const matrix = new Array(diam)
                .fill(0)
                .map((row) => new Array(diam).fill(0));
            cells.forEach(({ x, y }) => {
                matrix[y - minY][x - minX] = 1;
            });

            const matrix2 = new Array(diam)
                .fill(0)
                .map((row) => new Array(diam).fill(0));

            for (let i = 0; i < diam; i++) {
                for (let j = 0; j < diam; j++) {
                    if (this.rotate === "clockwise") {
                        matrix2[i][j] = matrix[diam - j - 1][i];
                    } else {
                        matrix2[i][j] = matrix[j][diam - i - 1];
                    }
                }
            }

            for (let i = 0; i < diam; i++) {
                for (let j = 0; j < diam; j++) {
                    if (matrix2[i][j] === 1) {
                        newFigure.push({
                            x: minX + j,
                            y: minY + i,
                        });
                    }
                }
            }

            let conflict = false;
            newFigure.forEach(({ x, y }) => {
                if (
                    x > NX - 1 ||
                    x < 0 ||
                    y > NY - 1 ||
                    y < 0 ||
                    this.cells[y][x] === 1
                ) {
                    conflict = true;
                }
            });

            if (!conflict) {
                this.movingFigure = newFigure;
            }
        },

        dropFigure() {
            let newFigure = this.movingFigure.slice();
            while (this.canMoveDown(newFigure)) {
                newFigure = this.moveFigureDown(newFigure);
            }
            this.movingFigure = newFigure;
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
        },

        eraseFullLines() {
            let erased;
            const cells = this.cells.slice();
            do {
                erased = false;
                for (let row = 0; row < cells.length; row++) {
                    if (cells[row].every((cell) => cell === 1)) {
                        cells.splice(row, 1);
                        cells.unshift(new Array(NX).fill(0));
                        erased = true;
                        this.score++;
                        break;
                    }
                }
            } while (erased);

            this.cells = cells;
        },

        onRestart() {
            this.initField();
            this.movingFigure = null;
            this.$refs.field.focus();
            this.score = 0;
            this.speed = accelerationPlan(this.score);
            this.stopped = false;
        },
    },
};
</script>

<style lang="scss" scoped>
.card-body {
    position: relative;

    input[type="text"] {
        // TBD
    }
}

.stopped {
    position: absolute;
    top: 250px;
    left: 60px;
    background: #ffffff;
    padding: 10px 25px;
    border-radius: 24px;
    font-size: 25px;
    box-shadow: #666666 10px 10px 10px;
}

.tetris-field {
    background: #c0a1ea;
    width: 300px;
    height: 600px;
    border: 1px solid #aaaaaa;
}

button.restart {
    border: none;
    background: deepskyblue;
    color: #ffffff;
    padding: 5px 25px;
    border-radius: 15px;
    box-shadow: #aaaaaa 3px 3px 3px;
}

button.restart:hover {
    color: yellow;
}

button.restart:focus {
    outline: none;
    box-shadow: none;
    transform: translate(2px, 2px);
}
</style>
