// handle show menu
let iconMenu = document.querySelectorAll(".icon-menu-mobile");
let menu = document.getElementById("header__list");

iconMenu.forEach((element) => {
    element.addEventListener("click", () => {
        menu.classList.toggle("header__list-active");
    });
});
// handle show menu
let iconCategoryMobile = document.getElementById("project__category-btn");
let listCategory = document.getElementById("list-category");
iconCategoryMobile?.addEventListener("click", () => {
    listCategory.classList.toggle("show-category-mobile");
});
