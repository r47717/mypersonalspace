<template>
    <div class="canvas" :style="canvasStyle()">
        <div
            v-for="cell in cells"
            :class="{'game15-cell': true, 'cell-empty': cell.value === 0 }"
            :style="cellStyle(cell)"
            @click="onClick(cell)"
        >
            {{ cell.value }}
        </div>
    </div>
</template>

<script>
export default {
    name: "Game15",

    data() {
        return {
            width: 500,
            height: 500,
            cells: [],
        }
    },

    computed: {
        dd() {
            return this.width / 4;
        },
        emptyCell() {
            return this.cells.find(cell => cell.value === 0)
        },
        canMoveLeft() {
            return this.cells.find(({row, col}) => row === this.emptyCell.row && col === this.emptyCell.col + 1)
        },
        canMoveRight() {
            return this.cells.find(({row, col}) => row === this.emptyCell.row && col === this.emptyCell.col - 1)
        },
        canMoveUp() {
            return this.cells.find(({row, col}) => col === this.emptyCell.col && row === this.emptyCell.row + 1)
        },
        canMoveDown() {
            return this.cells.find(({row, col}) => col === this.emptyCell.col && row === this.emptyCell.row - 1)
        },
        win() {
            const offs = this.cells[0].value ? 1 : 0;
            for (let i = offs; i < 15 + offs; i++) {
                if (this.cells[i].value !== i + 1 - offs) {
                    return;
                }
            }

            alert('WIN!')
        },
    },

    mounted() {
        this.reset();
    },

    watch: {
        cells() {
            const offs = this.cells[0].value ? 1 : 0;
            for (let i = offs; i < 15 + offs; i++) {
                if (this.cells[i].value !== i + 1 - offs) {
                    return;
                }
            }

            alert('WIN!')
        }
    },

    methods: {
        canvasStyle() {
            return {width: `${this.width}px`, height: `${this.height}px`}
        },

        cellStyle(cell) {
            return {
                top: `${cell.row * this.dd}px`,
                left: `${cell.col * this.dd}px`,
                width: `${this.dd}px`,
                height: `${this.dd}px`
            }
        },

        reset() {
            this.cells = new Array(16);
            const data = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
            for (let row = 0; row < 4; row++) {
                for (let col = 0; col < 4; col++) {
                    const index = Math.floor(Math.random() * data.length);
                    this.cells[row * 4 + col] = {row, col, value: data[index]};
                    data.splice(index, 1);
                }
            }
        },

        onClick(cell) {
            if (cell === this.canMoveRight) this.exchange(this.canMoveRight, this.emptyCell)
            else if (cell === this.canMoveLeft) this.exchange(this.canMoveLeft, this.emptyCell)
            else if (cell === this.canMoveUp) this.exchange(this.canMoveUp, this.emptyCell)
            else if (cell === this.canMoveDown) this.exchange(this.canMoveDown, this.emptyCell)
        },

        exchange(cell1, cell2) {
            this.cells = this.cells.map((cell) => {
                const {row, col} = cell;
                if (row === cell1.row && col === cell1.col) {
                    return {row, col, value: 0}
                }

                if (row === cell2.row && col === cell2.col) {
                    return {row, col, value: cell1.value}
                }

                return cell;
            });
        },
    }
}
</script>

<style scoped>
.canvas {
    background: #eeeeee;
    border: 1px solid gray;
    position: relative;
}

.game15-cell {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 35px;
    font-weight: 700;
    border: 1px solid gray;
    background: #eeeeee;
    box-sizing: border-box;
    cursor: pointer;
    user-select: none;
}

.cell-empty {
    background: white;
    color: white;
}

</style>
