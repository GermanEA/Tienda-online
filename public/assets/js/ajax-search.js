// Peticiones Ajax del buscador 
let searchHeader = document.getElementById('search-bar');
let searchModal = document.getElementById('modal-search');

// searchHeader.addEventListener('click', redirectPage, false);
searchHeader.addEventListener('keyup', searchPostAjax, false);
searchHeader.addEventListener('keyup', showModal, false);

function showModal() {
    if( searchHeader.value === "" ){
        searchModal.style.display = "none";
    } else {
        searchModal.style.display = "block";
    }
    
}

function searchPostAjax() {   

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open('POST', baseURL + 'products/product_search/searchAjax', true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {

        if(peticionAjax.readyState == 4) {
            searchResponseAjax(peticionAjax);
        }
    }   

    peticionAjax.send("words=" + searchHeader.value);

}

function searchResponseAjax(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        
        searchModal.innerHTML = response;
    }
}




