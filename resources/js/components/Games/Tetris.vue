<template>
    <div class="tetris-field" tabindex=-1 ref="field" @keyup="onKeyDown">
    </div>
</template>

<script>
export default {
    name: "Tetris",
    data() {
        return {
            timer: null,
            speed: 1000, // ms
            stopped: false,
            y: 0,
            x: 5,
            movingFigure: null,
            figures: [],
            figureTypes: [1, 2, 3, 4, 5, 6, 7],
        }
    },
    mounted() {
        this.timer = setInterval(this.move, this.speed);
        this.$refs.field.focus();
    },
    beforeDestroy() {
        clearInterval(this.timer);
    },
    methods: {
        move() {
            if (!this.stopped) {
                if (!this.movingFigure) {
                    this.createNewFigure();
                }

                if (this.canMove()) {
                    this.movingFigure.style.transform = `translate(${20 * this.x}px, ${20 * this.y}px)`;
                    this.y++;
                } else {
                    this.figures.push({
                        el: this.movingFigure,
                        y: this.y
                    });
                    this.movingFigure = null;
                    this.y = 0;
                    this.x = 0;
                }
            }
        },
        getNewFigureType() {
            return this.figureTypes[Math.floor(Math.random() * Math.floor(this.figureTypes.length))];
        },
        onKeyDown(event) {
            switch (event.keyCode) {
                case 32: // space
                    console.log('rotate')
                    break;
                case 37: // left
                    if (this.x > 0) this.x--;
                    break;
                case 38: // up
                    break;
                case 39: // right
                    if (this.x < 12) this.x++;
                    break;
                case 40: // down
                    break;
            }
        },
        createNewFigure() {
            const type = this.getNewFigureType();
            const figure = document.createElement('div');
            figure.classList.add('tetris-figure');
            figure.classList.add(`f${type}`);

            const p1 = document.createElement('div');
            p1.classList.add('p');
            p1.classList.add('p1');
            const p2 = document.createElement('div');
            p2.classList.add('p');
            p2.classList.add('p2');
            const p3 = document.createElement('div');
            p3.classList.add('p');
            p3.classList.add('p3');
            const p4 = document.createElement('div');
            p4.classList.add('p');
            p4.classList.add('p4');

            figure.append(p1, p2, p3, p4);

            this.$refs.field.append(figure);
            this.movingFigure = figure;
        },
        canMove() {
            return this.y < 10;
        }
    }
}
</script>

<style lang="scss">
$dx: 20px;
$dy: 20px;

.tetris-field {
    width: 300px;
    height: 600px;
    border: 1px solid #aaaaaa;
    position: relative;

    .tetris-figure {
        position: relative;
        top: 0;
        left: 0;
    }

    .p {
        position: absolute;
        width: $dx;
        height: $dy;
        background: #aaaaaa;
    }

    .f1 {
        .p1 {
            top: 0;
            left: 0;
        }

        .p2 {
            top: 0;
            left: $dx;
        }

        .p3 {
            top: 0;
            left: calc(#{$dx} + #{$dx});
        }

        .p4 {
            top: 0;
            left: calc(#{$dx} + #{$dx} + #{$dx});
        }
    }

    .f2 {
        .p1 {
            top: 0;
            left: 0;
        }

        .p2 {
            top: $dy;
            left: 0;
        }

        .p3 {
            top: $dy;
            left: $dx;
        }

        .p4 {
            top: $dy;
            left: calc(#{$dx} + #{$dx});
        }
    }

    .f3 {
        .p1 {
            top: $dy;
            left: 0;
        }

        .p2 {
            top: $dy;
            left: $dx;
        }

        .p3 {
            top: $dy;
            left: calc(#{$dx} + #{$dx});
        }

        .p4 {
            top: 0;
            left: calc(#{$dx} + #{$dx});
        }
    }

    .f4 {
        .p1 {
            top: $dy;
            left: 0;
        }

        .p2 {
            top: $dy;
            left: $dx;
        }

        .p3 {
            top: $dy;
            left: calc(#{$dx} + #{$dx});
        }

        .p4 {
            top: 0;
            left: $dx;
        }
    }

    .f5 {
        .p1 {
            top: 0;
            left: 0;
        }

        .p2 {
            top: 0;
            left: $dx;
        }

        .p3 {
            top: $dy;
            left: $dx;
        }

        .p4 {
            top: $dy;
            left: calc(#{$dx} + #{$dx});
        }
    }

    .f6 {
        .p1 {
            top: $dy;
            left: 0;
        }

        .p2 {
            top: $dy;
            left: $dx;
        }

        .p3 {
            top: 0;
            left: $dx;
        }

        .p4 {
            top: 0;
            left: calc(#{$dx} + #{$dx});
        }
    }

    .f7 {
        .p1 {
            top: 0;
            left: $dx;
        }

        .p2 {
            top: $dy;
            left: $dx;
        }

        .p3 {
            top: 0;
            left: calc(#{$dx} + #{$dx});
        }

        .p4 {
            top: $dy;
            left: calc(#{$dx} + #{$dx});
        }
    }
}


</style>
