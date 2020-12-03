/* STICKY NAVIGATION */

var navbar = document.getElementById("navbar");
var fixed = navbar.offsetTop;

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

/* LOGIN MODAL */

var user_modal = document.getElementById("user-modal");
var modal = document.getElementById("modal-logging");
var modal_close = document.querySelectorAll(".modal-close");

user_modal.addEventListener('mouseenter', function() {
  modal.style.display = "flex";
});

document.body.addEventListener('click', function(e) {
  var check;

  modal_close.forEach(element => {
    if ( e.target == element){
      check = true;
    }
  });

  if ( !check ) {    
    modal.style.display = "none";
  }
  
});
// modal.addEventListener('mouseleave', function(){
//   modal.style.display = "none";
// });



