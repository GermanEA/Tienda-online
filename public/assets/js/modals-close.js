/* LOGIN MODAL */
let user_modal = document.getElementById("user-modal");
let modal = document.getElementById("modal-logging");
let modal_close = document.querySelectorAll(".modal-close");
// let time;

user_modal.addEventListener('mouseenter', function() {
  modal.style.display = "flex";
});

// modal.addEventListener('mouseleave', function() {
//   time = setTimeout( () => {
//     modal.style.display = "none";
//   }, 500);
// });

// modal.addEventListener('mouseenter', function() {
//   clearTimeout(time);
// });

document.body.addEventListener('click', function(e) {
  let check;

  modal_close.forEach(element => {

    if ( e.target == element || e.target.nodeType == 3 ) {
      check = true;
    }
  
  });

  if ( !check ) {    
    modal.style.display = "none";
    searchModal.style.display = "none";
  }
  
});
