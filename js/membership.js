// Close the modal for the membership features.

window.onclick = function(event) {
    var i, modal = document.getElementsByClassName("modal");
    
    for (i = 0; i < modal.length; i++) {
        if (event.target == modal[i]) {
            event.target.style.display = "none";
        } 
    }    
}
