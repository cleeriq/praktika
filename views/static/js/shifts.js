

function selectStyle(obj) {
    if (obj.style.color === "rgb(31, 40, 46)") {
        obj.style.color = "rgb(255, 53, 0)";
        obj.style.textDecoration = "underline";
    } else {
        obj.style.color = "rgb(31, 40, 46)";
        obj.style.textDecoration = "none";
    }
}

createForm.employeeSelect.addEventListener("click", function() {
    selectStyle(this);
});

function addEmployee(obj, em) {
    var id = obj.value;
    var name = obj.options[obj.selectedIndex].text;
    obj.options[obj.selectedIndex].hidden = true;
    var label = document.createElement('label');
    var input = document.createElement('input');
    var div = document.createElement('div');
    div.className = "remove";
    div.textContent = "убрать";
    input.type = "checkbox";
    input.value = id;
    input.name = "employees[]";
    input.checked = true;
    label.textContent = name;
    label.append(input);
    label.append(div);
    em.append(label);
    obj.selectedIndex = 0;
    obj.selected = true;
}


createForm.employeeSelect.addEventListener("change", function() {
    addEmployee(this, employees);
});


$(document).on("click", ".remove", function() {
    var label = this.parentNode;
    var empId = label.querySelector('input').value;
    var form = this.parentNode.parentNode.parentNode;
    form.querySelector('option[value="'+empId+'"]').hidden = false;
    label.remove();
})

$(document).on("click", ".close-create-block", function() {
    this.parentNode.parentNode.remove();
})
$(document).on("click", ".change-bg", function(event) {
    if (event.target === document.getElementsByClassName("change-bg")[0]) {
        this.remove();
    }
})


document.getElementsByClassName('trigger')[0].addEventListener('click', function() {
    document.getElementsByClassName("create-bg")[0].style.transform = "scale(1)";
})

document.getElementsByClassName("close")[0].addEventListener("click", function() {
    document.getElementsByClassName("create-bg")[0].style.transform = "scale(0)";
})

document.getElementsByClassName("create-bg")[0].addEventListener("click", function (event) {
    if (event.target === document.getElementsByClassName("create-bg")[0]) {
        document.getElementsByClassName("create-bg")[0].style.transform = "scale(0)";
    }
});


$(document).on("click", ".change-btn", function() {
    var changeBlock = document.createElement("div");
    changeBlock.className = "change-bg";
    changeBlock.innerHTML = `
    <div class="create-block">
            <div class="close-create-block">
            <svg width="20.000000" height="20.000000" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="20.000000" height="20.000000" fill="#FFFFFF" fill-opacity="0"/>
                <path d="M12.09 9.94L17.09 4.9C17.32 4.67 17.32 4.32 17.09 4.09L16.32 3.28C16.09 3.05 15.75 3.05 15.51 3.28L10.48 8.32C10.32 8.48 10.09 8.48 9.94 8.32L4.9 3.25C4.67 3.01 4.32 3.01 4.09 3.25L3.28 4.05C3.05 4.28 3.05 4.63 3.28 4.86L8.32 9.9C8.48 10.05 8.48 10.28 8.32 10.44L3.25 15.51C3.01 15.75 3.01 16.09 3.25 16.32L4.05 17.13C4.28 17.36 4.63 17.36 4.86 17.13L9.9 12.09C10.05 11.94 10.28 11.94 10.44 12.09L15.48 17.13C15.71 17.36 16.05 17.36 16.28 17.13L17.09 16.32C17.32 16.09 17.32 15.75 17.09 15.51L12.09 10.48C11.94 10.32 11.94 10.09 12.09 9.94L12.09 9.94Z" fill="#706E6B" fill-opacity="1.000000" fill-rule="evenodd"/>
            </svg>
            </div>
            <form id="changeForm" method="GET" action="change-shift">
                <div id="shiftId"><input type="text" name="shift_id" value=""></div>
                <div>
                    <label>Дата</label>
                    <input type="date" name="date">
                </div>
                <div>
                    <label>Время</label>
                    <div class="time-form">
                        <input type="time" name="start">
                        <input type="time" name="end">
                    </div>
                </div>
                <div id="changeEmployees"></div>
                <div>
                    <select name="employeeSelect1">
                        <option disabled selected hidden value="">Добавить сотрудника</option>
                    </select>
                </div>
                <button type="submit">Сохранить</button>
            </form>
        </div>
    `;
    document.body.append(changeBlock);

    changeForm.start.value = this.parentNode.querySelector(".start").textContent;
    changeForm.end.value = this.parentNode.querySelector(".end").textContent;
    changeForm.date.value = this.parentNode.querySelector(".date").textContent;
    changeForm.shift_id.value = this.parentNode.getAttribute('value');

    var employees = [];
    var employeeId = [];
    employees = this.parentNode.querySelectorAll("li");
    employees.forEach(function(item, i, arr) {
        changeEmployees.innerHTML += `
        <label> `+ item.innerText +`
            <input type="checkbox" value="`+item.value+`" name="employees[]" checked>
            <div class="remove">убрать</div>
        </label>
        `;
        employeeId.push(String(item.value));
    })

    var options = [];
    options = createForm.querySelectorAll("option");
    options = Array.from(options);
    options.shift();
    options.forEach(function(item) {
        if (employeeId.includes(item.value)) {
            changeForm.employeeSelect1.innerHTML += `<option value="`+item.value+`" hidden>`+item.innerText+`</option>`;
        } else {
            changeForm.employeeSelect1.innerHTML += `<option value="`+item.value+`">`+item.innerText+`</option>`;
        }
    });

    document.getElementsByClassName("change-bg")[0].style.transform = "scale(1)";

    changeForm.employeeSelect1.addEventListener("change", function() {
        addEmployee(this, changeEmployees);
    });

    changeForm.employeeSelect1.addEventListener("click", function() {
        selectStyle(this);
    });

});

createForm.addEventListener("submit", function(e) {
    e.preventDefault();
    if (!createForm.date.value || !createForm.start.value || !createForm.end.value) {
        return;
    }
    this.submit();
})

