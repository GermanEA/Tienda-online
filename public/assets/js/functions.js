/* STICKY NAVIGATION */
let navbar = document.getElementById("navbar");
let fixed = navbar.offsetTop;

function fixedNav() {
  if (window.pageYOffset > fixed) {
    document.body.style.paddingTop = navbar.offsetHeight + 'px';
    navbar.classList.add("fixed");
  } else {
    document.body.style.paddingTop = 0;
    navbar.classList.remove("fixed");
  }
}

window.addEventListener('scroll', fixedNav);





