const DRAW_SNAKE_HEAD = 1;
const DRAW_SNAKE_BODY = 2;
const DRAW_MONGOOSE = 3;
const DRAW_FOOD = 4;

export class Field {
    constructor(canvas, nx, ny, w, h) {
        this.w = w;
        this.h = h;
        this.dx = w / nx;
        this.dy = h / ny;
        this.ctx = canvas.getContext('2d');
    }

    connect(snake, mongoose, food) {
        this.snake = snake;
        this.mongoose = mongoose;
        this.food = food;
    }

    isEmpty(p) {
        return !this.snake.isSnake(p) && !this.mongoose.isMongoose(p) && this.food.isFood(p) === 0;
    }

    isFood(p) {
        return this.food.isFood(p);
    }

    eatFood(p) {
        this.food.eatFood(p);
    }

    draw() {
        this.clearField();
        this.snake.draw(this.drawInterface);
        this.mongoose.draw(this.drawInterface);
        this.food.draw(this.drawInterface);
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

    drawCell(x, y, type, num) {
        this.ctx.beginPath();

        switch (type) {
            case DRAW_SNAKE_HEAD:
                this.ctx.arc((x + 0.5) * this.dx, (y + 0.5) * this.dy, this.dx / 2 - 2, 0, Math.PI * 2,
                    true);
                this.ctx.fillStyle = 'blue';
                break;
            case DRAW_SNAKE_BODY:
                this.ctx.arc((x + 0.5) * this.dx, (y + 0.5) * this.dy, this.dx / 2 - 2, 0, Math.PI * 2,
                    true);
                this.ctx.fillStyle = 'green';
                break;
            case DRAW_MONGOOSE:
                this.ctx.arc((x + 0.5) * this.dx, (y + 0.5) * this.dy, this.dx / 2 - 2, 0, Math.PI * 2,
                    true);
                this.ctx.fillStyle = 'black';
                break;
            case DRAW_FOOD:
                this.ctx.font = '25px serif';
                this.ctx.strokeText(num, x * this.dx + 4, (y + 1) * this.dy - 2, this.dx);
                break;
        }

        this.ctx.closePath();
        this.ctx.fill();
    }

    drawInterface = {
        drawSnakeHead: (x, y) => this.drawCell(x, y, DRAW_SNAKE_HEAD),
        drawSnakeBody: (x, y) => this.drawCell(x, y, DRAW_SNAKE_BODY),
        drawMongoose: (x, y) => this.drawCell(x, y, DRAW_MONGOOSE),
        drawFood: (x, y, num) => this.drawCell(x, y, DRAW_FOOD, num),
    }
}
