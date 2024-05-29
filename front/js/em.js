document.getElementsByClassName('trigger')[0].addEventListener('click', function() {
    document.getElementsByClassName("add-bg")[0].style.transform = "scale(1)";
})

document.getElementsByClassName("close")[0].addEventListener("click", function() {
    document.getElementsByClassName("add-bg")[0].style.transform = "scale(0)";
})

document.getElementsByClassName("add-bg")[0].addEventListener("click", function (event) {
    if (event.target === document.getElementsByClassName("add-bg")[0]) {
        document.getElementsByClassName("add-bg")[0].style.transform = "scale(0)";
    }
});




$('.header').click(function() {
    var parent = this.parentNode;
    if (parent.querySelector(".info").style.display === "block") {
        parent.querySelector(".info").style.display = "none";
        this.querySelector("svg").style.transform = "rotate(0deg)";
    } else {
        parent.querySelector(".info").style.display = "block";
        this.querySelector("svg").style.transform = "rotate(180deg)";
    }
})

