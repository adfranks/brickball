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
