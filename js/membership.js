// Close the modal for the membership features.
signModal = document.getElementById('sign');
logModal = document.getElementById('login');

window.onclick = function(event) {
    if (event.target == signModal || event.target == logModal) {
        signModal.style.display = "none";
        logModal.style.display = "none";
    }
}
