/********************
     MENU
    *********************/
const menuList = document.getElementById("menu-list");
const tamgiacphai = document.getElementsByClassName(" fa-caret-right");
const accessoriesList = document.getElementById("accesories-list-item");
const tamgiactrai = document.getElementsByClassName("fa-caret-left");

function menuIconclick() {
  menuList.classList.toggle("hidden");
}

function closeMenuclick() {
  menuList.classList.add("hidden");
  accessoriesList.classList.add("hidden1");
}

for (let i = 0; i < tamgiacphai.length; i++) {
  tamgiacphai[i].addEventListener("click", function () {
    accessoriesList.classList.toggle("hidden1");
  });
}
for (let i = 0; i < tamgiactrai.length; i++) {
  tamgiactrai[i].addEventListener("click", function () {
    accessoriesList.classList.add("hidden1");
  });
}

