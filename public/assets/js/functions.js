/* STICKY NAVIGATION */
let navbar = document.getElementById("navbar");
let fixed = navbar.offsetTop;

let fixedNav = () => {
  if (window.pageYOffset > fixed) {
    document.body.style.paddingTop = navbar.offsetHeight + 'px';
    navbar.classList.add("fixed");
  } else {
    document.body.style.paddingTop = 0;
    navbar.classList.remove("fixed");
  }
}

window.addEventListener('scroll', fixedNav);

/* CAPITALIZE FILTER */
// let filterLabel = document.querySelectorAll('.form-check-label');

// window.onload = function() {

//   filterLabel.forEach(element => {
//     element.innerText = capitalizeFirstLetter(element.innerText);
//   });
// }  

// function capitalizeFirstLetter(string) {
//   return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
// }

/* TOOLTIPS JQUERY */
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})




