"use strict";

const menuOpen = document.querySelector(".menu-icon");
const menuClose = document.querySelector(".burger-menu-close");
const overlay = document.querySelector(".burger-menu-overlay");

menuOpen.addEventListener("click", ()=>{
    overlay.classList.add("active")
})

menuClose.addEventListener("click", ()=>{
    overlay.classList.remove("active")
})