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

/* LOGIN MODAL OPEN-CLOSE */
let userModal = document.getElementById("user-modal");
let modal = document.getElementById("modal-logging");
let modalClose = document.querySelectorAll(".modal-close");

userModal.addEventListener('click', function() {
    modal.style.display = "flex";
});

document.body.addEventListener('click', function(e) {
    let check;

    modalClose.forEach(element => {

        if ( e.target == element || e.target.nodeType == 3 ) {
            check = true;
        }
    
    });

    if ( !check ) {
        modal.style.display = "none";
        searchModal.style.display = "none";
    }  
}, false);

/* CART MODAL OPEN-CLOSE AND AJAX PETITION */
let time;
let modalCart = document.getElementById('modal-cart-resume');
let modalCloseCart = document.getElementById('modal-close-cart');

function showCartModal(e) {
    
    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open("POST", baseURL + "cart/cart/showCartProduct",true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {
        if(peticionAjax.readyState == 4) {
            filterResponseAjaxCart(peticionAjax);
        }
    }   

    peticionAjax.send();
}

function filterResponseAjaxCart(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        modalCart.innerHTML = response;
        modalCart.style.display = 'flex';
    }
}

modalCloseCart.addEventListener('mouseenter', showCartModal, false);

modalCloseCart.addEventListener('mouseleave', function(e) {
    modalCart.style.display = "none";    
}, false);