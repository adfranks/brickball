// Start creating the game by declaring variables. 
var pad, ball, bricks, brickCount, round, levelText, ballText, score, over,
count, signModal, logModal;

// Object literal for the game with properties and methods.
var brickBall = {
    canvas: document.getElementById("breakoutCanvas"),
    level: 1, 
    gameScreen: function() {
        this.canvas.width = 956;
        this.canvas.height = 600;
        this.context = this.canvas.getContext("2d");
        this.interval = setInterval(this.updateGameScreen, 20);
    },
    init: function() {
        this.gameScreen();
        levelText = new Text(14, 55, "white", 15);
        ballText = new Text(102, 55, "white", 15);
        score = new Text(177, 55, "white", 15);
        bricks = [];
        brickBall.multiBricks(14, 8, 64, 13);
        count = 0;
        if (this.level === 1) {round = 1;}
        if (brickCount === undefined) {brickCount = 0;} 
        pad = (this.level !== 2) ? new Paddle(441, 585, "white", 75, 15):new Paddle(441, 585, "white", 65, 15);
        ball = (this.level !== 2) ? new GameBall(350, 350, "white", 10, 7):new GameBall(350, 350, "white", 10, 7.5);
        window.addEventListener("keydown", function(e) {
            brickBall.key = e.keyCode; 
        });
        window.addEventListener("keyup", function(e) {
            brickBall.key = false;
        });
    },
    clear: function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    restart: function() {
        clearInterval(this.interval);
        over = undefined;
        brickCount = 0;
        this.level = 1;
        this.init();
        document.getElementById('game-end').id = 'new-button';
    },
    newRound: function() {
        pad = (this.level !== 2) ? new Paddle(441, 585, "white", 75, 15):new Paddle(441, 585, "white", 65, 15);
        ball = (this.level !== 2) ? new GameBall(350, 350, "white", 10, 7):new GameBall(350, 350, "white", 10, 7.5); 
        brickBall.multiBricks(14, 8, 64, 13);
    },
    newGame: function() {
        document.getElementById('new-button').id = 'game-end'; // Button pulse at end of game.
    },
    nextLevel: function() {
        ball.levelSound.play();
        clearInterval(this.interval);
        brickBall.level = 2; 
        brickBall.init();
    },
    multiBricks: function(brickColumn, brickRow, brickWidth, brickHeight) {
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
    },
    highScore: function(num) {
        xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('high-score').innerHTML = this.responseText;
            }
        };

        xhttp.open("GET", "updatescore.php?q=" + num, true);
        xhttp.send();
    },
    updateChamp: function() {
        xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("high-score").innerHTML = this.responseText;
            }
        };

        xhttp.open("GET", "updatechamp.php", true);
        xhttp.send();
    },
    updateGameScreen: function() {
        if (over !== undefined) {clearInterval(this.interval);}
        brickBall.clear();
        brickBall.multiBricks(14, 8, 64, 13);
        pad.newPos();
        pad.draw();

        // Ensure blip sound does not repeat at end of game.
        if (over == undefined) {
            ball.collide(pad);
            ball.newPos();
            ball.draw();
        }
        levelText.text = "Level: " + brickBall.level;
        levelText.draw();
        ballText.text = "Ball: " + round;
        ballText.draw();
        score.text = "Score: " + brickCount;
        score.draw();
        if (over instanceof Text) {
            over.text = (brickCount === 2 * (14 * 8)) ? "Victorious!!!":"Game Over!";
            over.draw();
        }
        if (brickBall.key && brickBall.key === 83 && ball.velocityY === 0) {ball.serve();} 
    }
};
