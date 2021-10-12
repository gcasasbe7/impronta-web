var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
var euros = document.getElementById("pointsInEuros");
output.value = 0;

slider.oninput = function() {
    output.value = this.value;
    euros.innerHTML = output.value / 10;
}