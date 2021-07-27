import {Snake} from './snake';
import {Mongoose} from "./mongoose";
import {Food} from "./food";

export type Point = [number, number, number | undefined];

export type DrawInterface = {
    drawSnakeHead: (x: number, y: number) => void
    drawSnakeBody: (x: number, y: number) => void
    drawMongoose: (x: number, y: number) => void
    drawFood: (x: number, y: number, num: number) => void
}

export enum FieldObjectType {
    DRAW_SNAKE_HEAD = 1,
    DRAW_SNAKE_BODY = 2,
    DRAW_MONGOOSE = 3,
    DRAW_FOOD = 4,
}

export class Field {
    private readonly dx: number
    private readonly dy: number
    private readonly ctx: CanvasRenderingContext2D
    private snake: Snake | undefined;
    private mongoose: Mongoose | undefined
    private food: Food | undefined

    constructor(canvas: HTMLCanvasElement, nx: number, ny: number, private readonly w: number, private readonly h: number) {
        this.dx = w / nx;
        this.dy = h / ny;
        this.ctx = canvas.getContext('2d')!;
    }

    connect(snake: Snake, mongoose: Mongoose, food: Food) {
        this.snake = snake;
        this.mongoose = mongoose;
        this.food = food;
    }

    isEmpty(p: Point) {
        return !this.snake!.isSnake(p) && !this.mongoose!.isMongoose(p) && this.food!.isFood(p) === 0;
    }

    isFood(p: Point) {
        return this.food!.isFood(p);
    }

    eatFood(p: Point) {
        this.food!.eatFood(p);
    }

    draw() {
        this.clearField();
        this.snake!.draw(this.drawInterface);
        this.mongoose!.draw(this.drawInterface);
        this.food!.draw(this.drawInterface);
    }

    clearField() {
        this.ctx.fillStyle = 'white';
        this.ctx.fillRect(0, 0, this.w, this.h);

        this.ctx.strokeStyle = 'gray';

        this.ctx.strokeRect(0, 0, this.w, this.h);

        this.ctx.beginPath();

        let x = this.dx;
        while (x < this.w) {
            this.ctx.moveTo(x, 0);
            this.ctx.lineTo(x, this.h);
            x += this.dx;
        }

        let y = this.dy;
        while (y < this.h) {
            this.ctx.moveTo(0, y);
            this.ctx.lineTo(this.w, y);
            y += this.dy;
        }

        this.ctx.lineWidth = 1;
        this.ctx.closePath();
        this.ctx.stroke();
    }

    drawCell(x: number, y: number, type: FieldObjectType, num?: number) {
        this.ctx.beginPath();

        switch (type) {
            case FieldObjectType.DRAW_SNAKE_HEAD:
                this.ctx.arc((x + 0.5) * this.dx, (y + 0.5) * this.dy, this.dx / 2 - 2, 0, Math.PI * 2,
                    true);
                this.ctx.fillStyle = 'blue';
                break;
            case FieldObjectType.DRAW_SNAKE_BODY:
                this.ctx.arc((x + 0.5) * this.dx, (y + 0.5) * this.dy, this.dx / 2 - 2, 0, Math.PI * 2,
                    true);
                this.ctx.fillStyle = 'green';
                break;
            case FieldObjectType.DRAW_MONGOOSE:
                this.ctx.arc((x + 0.5) * this.dx, (y + 0.5) * this.dy, this.dx / 2 - 2, 0, Math.PI * 2,
                    true);
                this.ctx.fillStyle = 'black';
                break;
            case FieldObjectType.DRAW_FOOD:
                this.ctx.font = '25px serif';
                this.ctx.strokeText("" + num, x * this.dx + 4, (y + 1) * this.dy - 2, this.dx);
                break;
        }

        this.ctx.closePath();
        this.ctx.fill();
    }

    drawInterface: DrawInterface = {
        drawSnakeHead: (x: number, y: number) => this.drawCell(x, y, FieldObjectType.DRAW_SNAKE_HEAD),
        drawSnakeBody: (x: number, y: number) => this.drawCell(x, y, FieldObjectType.DRAW_SNAKE_BODY),
        drawMongoose: (x: number, y: number) => this.drawCell(x, y, FieldObjectType.DRAW_MONGOOSE),
        drawFood: (x: number, y: number, num: number) => this.drawCell(x, y, FieldObjectType.DRAW_FOOD, num),
    }
}
