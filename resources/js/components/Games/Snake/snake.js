const DIR_STOP = 0;
const DIR_UP = 1;
const DIR_DOWN = 2;
const DIR_LEFT = 3;
const DIR_RIGHT = 4;

const SNAKE_INIT_X = 10;
const SNAKE_INIT_Y = 10;
const SNAKE_INIT_LEN = 5;
const SNAKE_INIT_DIR = DIR_RIGHT;

export class Snake {
    constructor(xMin, xMax, yMin, yMax) {
        this.xMin = xMin;
        this.xMax = xMax;
        this.yMin = yMin;
        this.yMax = yMax;

        this.init();
    }

    init() {
        this.headX = SNAKE_INIT_X;
        this.headY = SNAKE_INIT_Y;
        this.dir = SNAKE_INIT_DIR;
        this.grow = 0;
        this.body = [];

        let x = this.headX;
        let y = this.headY;
        for (let i = 0; i < SNAKE_INIT_LEN; i++) {
            switch (this.dir) {
                case DIR_UP:
                    y++;
                    break;
                case DIR_DOWN:
                    y--;
                    break;
                case DIR_LEFT:
                    x++;
                    break;
                case DIR_RIGHT:
                    x--;
                    break;
            }
            this.body.push([x, y]);
        }
    }

    nextDir(dir, x1, y1) {
        let x2 = x1;
        let y2 = y1;
        switch (dir) {
            case DIR_DOWN:
                y2++;
                break;
            case DIR_UP:
                y2--;
                break;
            case DIR_RIGHT:
                x2++;
                break;
            case DIR_LEFT:
                x2--;
                break;
        }
        return [x2, y2];
    }

    isSnake(p) {
        if (p[0] === this.headX && p[1] === this.headY) return true;

        let found = false;
        this.body.forEach((item) => {
            if (item[0] === p[0] && item[1] === p[1]) {
                found = true;
            }
        });

        return found;
    }

    canMove(field) {
        const p = this.nextDir(this.dir, this.headX, this.headY);
        const food = field.isFood(p);
        if (food > 0) {
            this.grow += food;
            field.eatFood(p);
            return true;
        }

        return p[0] >= this.xMin && p[0] <= this.xMax && p[1] >= this.yMin && p[1] <= this.yMax &&
            field.isEmpty(p);
    }

    step() {
        const p = this.nextDir(this.dir, this.headX, this.headY);

        if (this.grow > 0) {
            this.grow--;
        } else {
            this.body.pop();
        }

        this.body.unshift([this.headX, this.headY]);
        this.headX = p[0];
        this.headY = p[1];
    }

    run(field) {
        if (this.dir === DIR_STOP) return false;

        if (this.canMove(field)) {
            this.step();
        } else {
            this.dir = DIR_STOP;
            return false;
        }
        return true;
    }

    draw(drawInterface) {
        drawInterface.drawSnakeHead(this.headX, this.headY);
        this.body.forEach((item) => {
            drawInterface.drawSnakeBody(item[0], item[1]);
        });
    }

    control(key) {
        switch (key) {
            case 'ArrowUp':
                if (this.dir !== DIR_DOWN) this.dir = DIR_UP;
                break;
            case 'ArrowDown':
                if (this.dir !== DIR_UP) this.dir = DIR_DOWN;
                break;
            case 'ArrowLeft':
                if (this.dir !== DIR_RIGHT) this.dir = DIR_LEFT;
                break;
            case 'ArrowRight':
                if (this.dir !== DIR_LEFT) this.dir = DIR_RIGHT;
                break;
        }
    }

    getLength() {
        return this.body.length;
    }
}
