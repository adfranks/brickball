// Start creating the game by declaring variables. 
var pad, ball, bricks, brickCount, level, round, levelText, ballText, score, over,
count, signModal, logModal;

// Object literal for the game screen with properties and methods.
var gameScreen = {
    canvas: document.getElementById("breakoutCanvas"),
    start: function() {
        this.canvas.width = 956;
        this.canvas.height = 600;
        this.context = this.canvas.getContext("2d");
        this.interval = setInterval(updateGameScreen, 20);
        this.canvas.addEventListener("click", startRound);
        window.addEventListener("keydown", function(e) {
            gameScreen.key = e.keyCode; 
        });
        window.addEventListener("keyup", function(e) {
            gameScreen.key = false;
        });
    },
    clear: function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    nextLevel: function() {
        ball.levelSound.play();
        clearInterval(this.interval);
        level = 2; 
        initialize();
    }
};

// Set up the game to begin.
function initialize() {
    gameScreen.start();
    levelText = new Text(14, 55, "white", 15);
    ballText = new Text(102, 55, "white", 15);
    score = new Text(177, 55, "white", 15);
    bricks = [];
    multiBricks(14, 8, 64, 13);
    level = (level === 2) ? 2:1; 
    count = 0;
    if (level === 1) {round = 1;}
    if (brickCount === undefined) {brickCount = 0;} 
    pad = (level !== 2) ? new Paddle(441, 585, "white", 75, 15):new Paddle(441, 585, "white", 65, 15);
    ball = (level !== 2) ? new GameBall(350, 350, "white", 10, 7):new GameBall(350, 350, "white", 10, 7.5);
}

function startRound() {
    gameScreen.canvas.removeEventListener("click", startRound);
    ball.velocityX = ball.acceleration;
    ball.velocityY = ball.acceleration;
}

function newRound() {
    pad = (level !== 2) ? new Paddle(441, 585, "white", 75, 15):new Paddle(441, 585, "white", 65, 15);
    ball = (level !== 2) ? new GameBall(350, 350, "white", 10, 7):new GameBall(350, 350, "white", 10, 7.5); 
    multiBricks(14, 8, 64, 13);
    gameScreen.canvas.addEventListener("click", startRound);
}

function restart() {
    clearInterval(gameScreen.interval);
    over = undefined;
    brickCount = 0;
    level = 1;
    initialize();
    document.getElementById('game-end').id = 'new-button';
}

// Custom types for the game with properties and methods.
function Sound(src) {
    var audioElement = document.createElement("audio"),
    isSupp = audioElement.canPlayType('audio/ogg'),
    audioFormat = (isSupp === "") ? ".mp3":".ogg";

    this.sound = audioElement;
    this.sound.src = src + audioFormat;
    this.sound.setAttribute("preload", "auto");
    this.sound.setAttribute("controls", "none");
    this.sound.style.display = "none";
    document.body.appendChild(this.sound);
    this.play = function() {this.sound.play();}
    this.stop = function() {this.sound.pause();}
}

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
    var ctx = gameScreen.context;
    ctx.fillStyle = this.color;
    ctx.fillRect(this.x, this.y, this.width, this.height);
};

function Brick(x, y, color, width, height) {
    GameObj.call(this, x, y, color, width, height);
    this.exist =  true;
}

Brick.prototype = new GameObj();
Brick.prototype.constructor = Brick;

Brick.prototype.draw = function () {
    if (this.exist === true) {
        var ctx = gameScreen.context;
        ctx.fillStyle = this.color;
        ctx.fillRect(this.x, this.y, this.width, this.height);
    }
};

// Creates all the bricks together.
function multiBricks(brickColumn, brickRow, brickWidth, brickHeight) {
    var c, r, color;

    for (c = 0; c < brickColumn; c++) {
        if (bricks[c] === undefined) {bricks[c] = [];}
        for (r = 0; r < brickRow; r++) {
            if (bricks[c][r] === undefined) {
                if (r < 2) {color = "blue";}
                else if (r > 1 && r < 4) {color = "green";}
                else if (r > 3 && r < 6)  {color = "rgb(255, 52, 0)";}
                else if (r < brickRow && r > (brickRow - 3)) {
                    color = "yellow";
                }
                    bricks[c][r] = 
                    new Brick((c * (brickWidth + 4) + 4), (r * (brickHeight + 4) + 100), color, brickWidth, brickHeight); 
            } else {ball.collide(bricks[c][r]);}            
            bricks[c][r].draw();
        }
    }
}

function Paddle(x, y, color, width, height) {
    GameObj.call(this, x, y, color, width, height);
    this.velocityX = 0;
}

Paddle.prototype = new GameObj();
Paddle.prototype.constructor = Paddle;

Paddle.prototype.newPos = function() {
    this.velocityX = 0;
    if (gameScreen.key && gameScreen.key === 37 && this.x >= 12) {this.velocityX = -12;}
    else if (gameScreen.key && gameScreen.key === 37 && this.x < 12) {this.velocityX = -this.x;}
    else if (gameScreen.key && gameScreen.key === 39 && (this.x + this.width) <= (gameScreen.canvas.width - 12)) {
        this.velocityX = 12;
    } else if (gameScreen.key && gameScreen.key === 39 && (this.x + this.width) > (gameScreen.canvas.width - 12)) {
        this.velocityX = gameScreen.canvas.width - (this.x + this.width);
    } 
    this.x += this.velocityX; 
};

Paddle.prototype.resize = function() {
    this.width = this.width / 2;
};

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
    this.sound = new Sound("audio/edgeSound");
    this.topSound = new Sound("audio/edgeSound");
    this.padSound = new Sound("audio/padSound");
    this.brickSound = new Sound("audio/brickSound");
    this.overSound = new Sound("audio/overSound");
    this.levelSound = new Sound("audio/levelSound");
    this.victorySound = new Sound("audio/victorySound");
}

GameBall.prototype = new GameObj();
GameBall.prototype.constructor = GameBall;

GameBall.prototype.draw = function() {
    var ctx = gameScreen.context;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
    ctx.fillStyle = this.color;
    ctx.fill();
};

GameBall.prototype.newPos = function() {
        this.x += this.velocityX;
        this.y += this.velocityY;
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

GameBall.prototype.collide = function(otherObj) {
    var randomize;

    /* Ball hits another game object that is not a former brick that was hit.
    Ensures the brick will only hit one at a time. */
    if (!(otherObj instanceof Brick && (otherObj.exist === false || this.brickHit === true))) {
        if ((this.x + this.radius) >= otherObj.x && (this.x - this.radius) <= (otherObj.x + otherObj.width) &&
        (this.y + this.radius) >= otherObj.y && (this.y - this.radius) <= (otherObj.y + otherObj.height)) {
            if (otherObj instanceof Brick) {
                this.brickSound.play();
                otherObj.exist = false; 
                this.brickHit = true;
                brickCount++;
                if (brickCount === (14 * 8)) {
                    gameScreen.nextLevel();
                }

                // Speed up if first time hitting that color in round.
                switch (otherObj.color) {
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
            }
            if (otherObj instanceof Paddle) {
                this.padSound.play();
                this.brickHit = false; this.padHit++;

                /* If ball hits pad 5 times it will change the bouncing angle,
                   to a random angle within a specified range, when ball
                   bounces off either the inner or outer part of paddle.  It will not
                   change the angle of both the inner and outer paddle at same time */
                if (this.padHit > 4) {
                    randomize = true;
                    this.padHit = 0;
                } else {randomize = false;}

                /* Ball hits outer paddle */
                if ((this.x + this.radius) < (otherObj.x + otherObj.width / 4) ||
                (this.x - this.radius) > (otherObj.x + 3 * otherObj.width / 4)) {
                    this.angle("low", randomize);

                /* Ball hits inner paddle */
                } else {this.angle("high", randomize);}

                /* Ball bounces left if hits left side of paddle and right if hits right side of paddle */
                if (((this.x + this.radius) < (otherObj.x + otherObj.width / 2) &&
                this.velocityX > 0) || ((this.x - this.radius) > (otherObj.x + otherObj.width / 2) &&
                this.velocityX < 0)) {this.velocityX = -this.velocityX;}
            }
            this.velocityY = -this.velocityY;
        } 
    }

    // Ball hits left or right side of game screen
    if ((this.x + this.radius) >= gameScreen.canvas.width || (this.x - this.radius) <= 0) {
        this.sound.play();
        this.velocityX = -this.velocityX;
        this.brickHit = false;
    }

    // Ball hits top of game screen
    if ((this.y - this.radius) < 0) {
        this.topSound.play();
        this.velocityY = -this.velocityY;
        this.brickHit = false;
        this.topHit++;

        if (this.topHit === 1) {
            pad.resize();
        }
    }

    // Ball hits bottom of game screen.  Check if game is over.
    if ((this.y - this.radius * 2) > gameScreen.canvas.height) {
        if (round < 5 && brickCount != 2 * (14 * 8)) { 
            round++;
            newRound(); 
        } else {
            over = new Text(310, 400, "white", "bold 50");

            // Ensure end sound does not loop.  Check if game was won.  Update db via ajax.
            if (count === 0) {  
                count++;
                newGame();
                if (brickCount === 2 * (14 * 8)) {
                    this.victorySound.play();
                    updateChamp();
                } else {
                    this.overSound.play(); 
                    highScore(brickCount);
                }
            }
        }
    }
};

function Text(x, y, color, fontPx) {
    GameObj.call(this, x, y, color);
    this.fontPx = fontPx;
}

Text.prototype = new GameObj();
Text.prototype.constructor = Text;

Text.prototype.draw = function () {
    var ctx = gameScreen.context;
    ctx.fillStyle = this.color;
    ctx.font = this.fontPx + "px Verdana";
    ctx.fillText(this.text, this.x, this.y);
};

function updateGameScreen() {
    if (over !== undefined) {clearInterval(gameScreen.interval);}
    gameScreen.clear();
    multiBricks(14, 8, 64, 13);
    pad.newPos();
    pad.draw();

    // Ensure blip sound does not repeat at end of game.
    if (over == undefined) {
        ball.collide(pad);
        ball.newPos();
        ball.draw();
    }
    levelText.text = "Level: " + level;
    levelText.draw();
    ballText.text = "Ball: " + round;
    ballText.draw();
    score.text = "Score: " + brickCount;
    score.draw();
    if (over instanceof Text) {
        over.text = (brickCount === 2 * (14 * 8)) ? "Victorious!!!":"Game Over!";
        over.draw();
    }
}

// Close the modal
signModal = document.getElementById('sign');
logModal = document.getElementById('login');

window.onclick = function(event) {
    if (event.target == signModal || event.target == logModal) {
        signModal.style.display = "none";
        logModal.style.display = "none";
    }
}

// Make button pulse at end of game
function newGame() {
    document.getElementById('new-button').id = 'game-end';
}

// Ajax for high score
function highScore(num) {
    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('high-score').innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "updatescore.php?q=" + num, true);
    xhttp.send();
}


// Ajax for championships
function updateChamp() {
    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("high-score").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "updatechamp.php", true);
    xhttp.send();
}
