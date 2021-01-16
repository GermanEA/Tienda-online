let modal = document.getElementById('modal-details');
let modalContent = document.getElementById('modal-content-dynamic');
let modalClose = document.getElementById('modal-close');
let btnDetailsArray = document.querySelectorAll('.btn-details');

window.onload = () => {
    loadButton();
};

modalClose.addEventListener('click', closeModal, false);
window.addEventListener('click', closeModalWindow, false);

function loadButton() {
    btnDetailsArray = document.querySelectorAll('.btn-details');
    btnDetailsArray.forEach((e) => {
        e.addEventListener('click', openModal, false);
        e.addEventListener('click', searchPostAjaxDetails, false);
    });
}

function searchPostAjaxDetails(e) {
    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open('POST', baseURL + 'administrator/dashboard/detailsOrder', true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {

        if(peticionAjax.readyState == 4) {
            searchResponseAjaxDetails(peticionAjax);
        }
    }   
    peticionAjax.send("id=" + e.target.id);
}

function searchResponseAjaxDetails(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        
        console.log(response);
        modalContent.innerHTML = response;
    }
}

function openModal() {
    modal.style.display = "block";
}

function closeModal() {
    modal.style.display = "none";
}

function closeModalWindow(e) {
    if( e.target == modal ) {
        modal.style.display = "none";
    }
}