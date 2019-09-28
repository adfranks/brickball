// Constructor for any visual object in the game.
function GameObj(x, y, color, width, height, type) {
    this.x = x;
    this.y = y;
    this.color = color;
    this.width = width;
    this.height = height;
    this.type = type;
}

GameObj.prototype.draw = function () {
    var ctx = brickBall.context;
    ctx.fillStyle = this.color;
    ctx.fillRect(this.x, this.y, this.width, this.height);
};

// Create a brick object.
function Brick(x, y, color, width, height) {
    GameObj.call(this, x, y, color, width, height);
    this.exist =  true;
}

Brick.prototype = new GameObj();
Brick.prototype.constructor = Brick;

Brick.prototype.draw = function () {
    if (this.exist === true) {
        var ctx = brickBall.context;
        ctx.fillStyle = this.color;
        ctx.fillRect(this.x, this.y, this.width, this.height);
    }
};

// Make a paddle class.
function Paddle(x, y, color, width, height) {
    GameObj.call(this, x, y, color, width, height);
    this.velocityX = 0;
}

Paddle.prototype = new GameObj();
Paddle.prototype.constructor = Paddle;

Paddle.prototype.newPos = function() {
    this.velocityX = 0;
    if (brickBall.key && brickBall.key === 37 && this.x >= 12) {this.velocityX = -12;}
    else if (brickBall.key && brickBall.key === 37 && this.x < 12) {this.velocityX = -this.x;}
    else if (brickBall.key && brickBall.key === 39 && (this.x + this.width) <= (brickBall.canvas.width - 12)) {
        this.velocityX = 12;
    } else if (brickBall.key && brickBall.key === 39 && (this.x + this.width) > (brickBall.canvas.width - 12)) {
        this.velocityX = brickBall.canvas.width - (this.x + this.width);
    } 
    this.x += this.velocityX; 
};

Paddle.prototype.resize = function() {
    this.width = this.width / 2;
};

// Use constuctor/prototype patterns to create a ball object.
function GameBall(x, y, color, width, acceleration) {
    GameObj.call(this, x, y, color, width);
    this.radius = width / 2;
    this.velocityX = 0;
    this.velocityY = 0;
    this.acceleration = acceleration;
    this.lowAngle = 0.5;
    this.highAngle = 0.8;
    this.brickHit = false;
    this.padHit = 0;
    this.topHit = 0;
    this.hitOrange = false;
    this.hitGreen = false;
    this.hitBlue = false;
    this.padSound = new Sound("audio/padSound");
    this.wallSound = new Sound("audio/edgeSound");
    this.brickSound = new Sound("audio/brickSound");
}

GameBall.prototype = new GameObj();
GameBall.prototype.constructor = GameBall;

GameBall.prototype.draw = function() {
    var ctx = brickBall.context;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
    ctx.fillStyle = this.color;
    ctx.fill();
};

GameBall.prototype.newPos = function() {
    this.x += this.velocityX;
    this.y += this.velocityY;
};

GameBall.prototype.serve = function () {
    var i, modal = document.getElementsByClassName("modal");
    
    for (i = 0; i < modal.length; i++) {
        if (modal[i].style.display == "block") {
            return;
        } 
    }    
    this.velocityX = this.acceleration;
    this.velocityY = this.acceleration;
};

GameBall.prototype.angle = function(range, randomize) {
    var randomAngle = Math.random() + 0.1;
    var sameSpeed = this.acceleration * this.acceleration + this.acceleration * this.acceleration; 

    if (randomize === true) {
        if (range === "low" && (randomAngle > 0.5 || randomAngle < 0.8)) {
            this.lowAngle = randomAngle;    
        } else if (range === "high" && (randomAngle > 0.8 || randomAngle < 1.1)) {
            this.highAngle = randomAngle;
        } else {this.angle(range, randomize);}
    }
    if (range === "low") {
        this.velocityX = Math.cos(this.lowAngle) * Math.sqrt(sameSpeed);
        this.velocityY = Math.sin(this.lowAngle) * Math.sqrt(sameSpeed);
    }
    if (range === "high") {
        this.velocityX = Math.cos(this.highAngle) * Math.sqrt(sameSpeed);
        this.velocityY = Math.sin(this.highAngle) * Math.sqrt(sameSpeed);
    }
};

// Method for when a ball hits a brick.
GameBall.prototype.brick = function(hitBrick) {
    this.brickSound.play();
    hitBrick.exist = false; 
    this.brickHit = true;
    brickCount++;
    if (brickCount === (14 * 8)) {
        brickBall.nextLevel();
    }

    // Speed up if first time hitting brick with new color in round.
    switch (hitBrick.color) {
        case "rgb(255, 52, 0)":
            if (this.hitOrange !== true) {
                this.velocityX *= 1.15;
                this.velocityY *= 1.15;
                this.acceleration *= 1.15;
            }
            this.hitOrange = true;
            break;
        case "green":
            if (this.hitGreen !== true) {
                this.velocityX *= 1.14;
                this.velocityY *= 1.14;
                this.acceleration *= 1.14;
            }
            this.hitGreen = true;
            break;
        case "blue":
            if (this.hitBlue !== true) {
                this.velocityX *= 1.16;
                this.velocityY *= 1.16;
                this.acceleration *= 1.16;
            }
            this.hitBlue = true;
            break;
    }
};

// Method for when the ball hits the paddle.
GameBall.prototype.paddle = function(hitPaddle) {
    var randomize;

    this.padSound.play();
    this.brickHit = false; 
    this.padHit++;

    /* If ball hits pad 5 times it will change the bouncing angle,
       to a random angle within a specified range, when ball
       bounces off either the inner or outer part of paddle.  It will not
       change the angle of both the inner and outer paddle at same time. */
    if (this.padHit > 4) {
        randomize = true;
        this.padHit = 0;
    } else {randomize = false;}

    // Ball hits outer paddle. 
    if ((this.x + this.radius) < (hitPaddle.x + hitPaddle.width / 4) ||
    (this.x - this.radius) > (hitPaddle.x + 3 * hitPaddle.width / 4)) {
        this.angle("low", randomize);
    } else {this.angle("high", randomize);} // Ball hit inner paddle.

    // Ball bounces left if hits left side of paddle and right if hits right side of paddle. 
    if (((this.x + this.radius) < (hitPaddle.x + hitPaddle.width / 2) &&
    this.velocityX > 0) || ((this.x - this.radius) > (hitPaddle.x + hitPaddle.width / 2) &&
    this.velocityX < 0)) {this.velocityX = -this.velocityX;}
};

// Method for when the ball hits the sides of the screen.
GameBall.prototype.wall = function() {

    // Ball hits left or right side of game wall
    if ((this.x + this.radius) >= brickBall.canvas.width || (this.x - this.radius) <= 0) {
        this.wallSound.play();
        this.velocityX = -this.velocityX;
        this.brickHit = false;
    }

    // Ball hits top of game screen
    if ((this.y - this.radius) < 0) {
        this.wallSound.play();
        this.velocityY = -this.velocityY;
        this.brickHit = false;
        this.topHit++;

        if (this.topHit === 1) {
            pad.resize();
        }
    }
};

// Method for when the ball hits something.
GameBall.prototype.collide = function(otherObj) {

    // Ball hits another game object that is not a former brick that was hit previously.
    if (!(otherObj instanceof Brick && (otherObj.exist === false || this.brickHit === true))) {
        if ((this.x + this.radius) >= otherObj.x && (this.x - this.radius) <= (otherObj.x + otherObj.width) &&
        (this.y + this.radius) >= otherObj.y && (this.y - this.radius) <= (otherObj.y + otherObj.height)) {
            if (otherObj instanceof Brick) {
                this.brick(otherObj);
            }

            // Actions when ball hits the paddle.
            if (otherObj instanceof Paddle) {
                this.paddle(otherObj);
            }
            this.velocityY = -this.velocityY;
        } 
    }
    this.wall();

    // Ball goes beyond bottom of game screen.
    if ((this.y - this.radius * 2) > brickBall.canvas.height) {
        brickBall.endRound();
    }
};

// Text class for writing on the game screen.
function Text(x, y, color, fontPx) {
    GameObj.call(this, x, y, color);
    this.fontPx = fontPx;
}

Text.prototype = new GameObj();
Text.prototype.constructor = Text;

Text.prototype.draw = function () {
    var ctx = brickBall.context;
    ctx.fillStyle = this.color;
    ctx.font = this.fontPx + "px Verdana";
    ctx.fillText(this.text, this.x, this.y);
};
