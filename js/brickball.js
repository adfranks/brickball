// Object literal for the game with properties and methods.
var brickBall = {
    canvas: document.getElementById("breakoutCanvas"),
    overSound: new Sound("audio/overSound"),
    levelSound: new Sound("audio/levelSound"),
    victorySound: new Sound("audio/victorySound"),
    over: new Text(310, 400, "white", "bold 50"),
    levelText: new Text(14, 55, "white", 15),
    ballText: new Text(102, 55, "white", 15),
    score: new Text(177, 55, "white", 15),
    level: 1, 
    round: 1,
    brickCount: 0,
    end: false,
    pad: (this.level !== 2) ? new Paddle(441, 585, "white", 75, 15):new Paddle(441, 585, "white", 65, 15),
    ball: (this.level !== 2) ? new GameBall(350, 350, "white", 10, 7):new GameBall(350, 350, "white", 10, 7.5),
    bricks: [],
    gameScreen: function() {
        this.canvas.width = 956;
        this.canvas.height = 600;
        this.context = this.canvas.getContext("2d");
        this.interval = setInterval(this.updateGameScreen, 20);
    },
    init: function() {
        this.gameScreen();
        if (this.level === 1) {this.round = 1;} // Ensure user doesn't gain rounds entering level two.
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
        this.end = false;
        this.brickCount = 0;
        this.level = 1;
        this.bricks = [];
        this.newRound();
        this.init();
        document.getElementById('game-end').id = 'new-button';
    },
    endRound: function() {
        if (this.round < 5 && this.brickCount != 2 * (14 * 8)) { 
            this.round++;
            this.newRound(); 
        } else {
            this.end = true;
            this.newGame();

            // Check if game was won. 
            if (this.brickCount === 2 * (14 * 8)) {
                this.victorySound.play();
                this.updateChamp(); // Update db via ajax.
                this.over.text = "Victorious!!!"; 
            } else {
                this.overSound.play(); 
                this.over.text = "Game Over!"; 
                this.highScore(this.brickCount);
            }
        }
    },
    newRound: function() {
        this.pad = (this.level !== 2) ? new Paddle(441, 585, "white", 75, 15):new Paddle(441, 585, "white", 65, 15);
        this.ball = (this.level !== 2) ? new GameBall(350, 350, "white", 10, 7):new GameBall(350, 350, "white", 10, 7.5); 
        brickBall.multiBricks(14, 8, 64, 13);
    },
    newGame: function() {
        var newButton = document.getElementById('new-button');
      
        if (newButton) {newButton.id = 'game-end';} // Button pulse at end of game.
    },
    nextLevel: function() {
        this.levelSound.play();
        clearInterval(this.interval);
        brickBall.level = 2; 
        brickBall.init();
    },
    multiBricks: function(brickColumn, brickRow, brickWidth, brickHeight) {
        var c, r, color;

        for (c = 0; c < brickColumn; c++) {
            if (this.bricks[c] === undefined) {this.bricks[c] = [];}
            for (r = 0; r < brickRow; r++) {
                if (this.bricks[c][r] === undefined) {
                    if (r < 2) {color = "blue";}
                    else if (r > 1 && r < 4) {color = "green";}
                    else if (r > 3 && r < 6)  {color = "rgb(255, 52, 0)";}
                    else if (r < brickRow && r > (brickRow - 3)) {color = "yellow";}
                    this.bricks[c][r] = 
                    new Brick((c * (brickWidth + 4) + 4), (r * (brickHeight + 4) + 100), color, brickWidth, brickHeight); 
                } else {this.ball.collide(this.bricks[c][r]);}            
                this.bricks[c][r].draw();
            }
        }
    },
    highScore: function(num) {
        var high = document.getElementById('high-score');
        xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200 && high) {
                high.innerHTML = this.responseText;
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
        brickBall.clear();
        brickBall.multiBricks(14, 8, 64, 13);
        brickBall.pad.newPos();
        brickBall.pad.draw();
        brickBall.ball.collide(brickBall.pad);
        brickBall.ball.newPos();
        brickBall.ball.draw();
        brickBall.levelText.text = "Level: " + brickBall.level;
        brickBall.levelText.draw();
        brickBall.ballText.text = "Ball: " + brickBall.round;
        brickBall.ballText.draw();
        brickBall.score.text = "Score: " + brickBall.brickCount;
        brickBall.score.draw();
        if (brickBall.end === true) {
            brickBall.over.draw();
            clearInterval(brickBall.interval);
        } 
        if (brickBall.key && brickBall.key === 83 && brickBall.ball.velocityY === 0) {brickBall.ball.serve();} 
    }
};
