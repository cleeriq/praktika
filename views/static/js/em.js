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


document.getElementsByClassName('role')[0].addEventListener("change", function() {
    if (this.value == "") {
        window.location.href = '/employees';
    } else {
        window.location.href = '/employees?role='+this.value;
    }
})

var url = new URL(window.location.href);

var options = [];
options = document.getElementsByClassName('role')[0].querySelectorAll("option");
options = Array.from(options);
options.shift();
options.forEach(function(item) {
    if (item.value == url.searchParams.get('role')) {
        item.selected = true;
    }
});



addForm.addEventListener("submit", function(e) {
    e.preventDefault();
    if (!addForm.name.value || !addForm.login.value || !addForm.password.value || !addForm.role_id.value) {
        return;
    }
    this.submit();
})
