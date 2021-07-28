import { DrawInterface, Field, Point } from "./field";

enum SnakeDirection {
    DIR_STOP = 0,
    DIR_UP = 1,
    DIR_DOWN = 2,
    DIR_LEFT = 3,
    DIR_RIGHT = 4,
}

const SNAKE_INIT_X = 10;
const SNAKE_INIT_Y = 10;
const SNAKE_INIT_LEN = 5;
const SNAKE_INIT_DIR = SnakeDirection.DIR_RIGHT;

export class Snake {
    private headX: number;
    private headY: number;
    private dir: SnakeDirection;
    private grow: number;
    private body: Array<[number, number]>;

    constructor(
        private readonly xMin: number,
        private readonly xMax: number,
        private readonly yMin: number,
        private readonly yMax: number
    ) {
        this.headX = SNAKE_INIT_X;
        this.headY = SNAKE_INIT_Y;
        this.dir = SNAKE_INIT_DIR;
        this.grow = 0;
        this.body = [];
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
                // @ts-ignore
                case SnakeDirection.DIR_UP:
                    y++;
                    break;
                // @ts-ignore
                case SnakeDirection.DIR_DOWN:
                    y--;
                    break;
                // @ts-ignore
                case SnakeDirection.DIR_LEFT:
                    x++;
                    break;
                // @ts-ignore
                case SnakeDirection.DIR_RIGHT:
                    x--;
                    break;
            }
            this.body.push([x, y]);
        }
    }

    nextDir(dir: SnakeDirection, x1: number, y1: number) {
        let x2 = x1;
        let y2 = y1;
        switch (dir) {
            case SnakeDirection.DIR_DOWN:
                y2++;
                break;
            case SnakeDirection.DIR_UP:
                y2--;
                break;
            case SnakeDirection.DIR_RIGHT:
                x2++;
                break;
            case SnakeDirection.DIR_LEFT:
                x2--;
                break;
        }
        return [x2, y2, undefined] as Point;
    }

    isSnake(p: Point) {
        if (p[0] === this.headX && p[1] === this.headY) return true;

        let found = false;
        this.body.forEach((item) => {
            if (item[0] === p[0] && item[1] === p[1]) {
                found = true;
            }
        });

        return found;
    }

    canMove(field: Field) {
        const p = this.nextDir(this.dir, this.headX, this.headY);
        const food = field.isFood(p);
        if (food > 0) {
            this.grow += food;
            field.eatFood(p);
            return true;
        }

        return (
            p[0] >= this.xMin &&
            p[0] <= this.xMax &&
            p[1] >= this.yMin &&
            p[1] <= this.yMax &&
            field.isEmpty(p)
        );
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

    run(field: Field) {
        if (this.dir === SnakeDirection.DIR_STOP) return false;

        if (this.canMove(field)) {
            this.step();
        } else {
            this.dir = SnakeDirection.DIR_STOP;
            return false;
        }
        return true;
    }

    draw(drawInterface: DrawInterface) {
        drawInterface.drawSnakeHead(this.headX, this.headY);
        this.body.forEach((item) => {
            drawInterface.drawSnakeBody(item[0], item[1]);
        });
    }

    control(key: string) {
        switch (key) {
            case "ArrowUp":
                if (this.dir !== SnakeDirection.DIR_DOWN)
                    this.dir = SnakeDirection.DIR_UP;
                break;
            case "ArrowDown":
                if (this.dir !== SnakeDirection.DIR_UP)
                    this.dir = SnakeDirection.DIR_DOWN;
                break;
            case "ArrowLeft":
                if (this.dir !== SnakeDirection.DIR_RIGHT)
                    this.dir = SnakeDirection.DIR_LEFT;
                break;
            case "ArrowRight":
                if (this.dir !== SnakeDirection.DIR_LEFT)
                    this.dir = SnakeDirection.DIR_RIGHT;
                break;
        }
    }

    getLength() {
        return this.body.length;
    }
}
