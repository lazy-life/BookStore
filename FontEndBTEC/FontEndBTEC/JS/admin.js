var popup = document.getElementById("popup");
var popupBtn = document.getElementById("popup-btn");
var closeBtn = document.getElementById("close-btn");

popupBtn.onclick = function() {
    popup.style.display = "block";
}

closeBtn.onclick = function() {
    popup.style.display = "none";
}