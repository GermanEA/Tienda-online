let searchTable = document.getElementById('search-bar');
let tableBody = document.getElementById('content-body');

searchTable.addEventListener('keyup', searchPostAjax, false);

function searchPostAjax() {   

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open('POST', baseURL + 'administrator/users/searchAjax', true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {

        if(peticionAjax.readyState == 4) {
            searchResponseAjax(peticionAjax);
        }
    }   

    peticionAjax.send("words=" + searchTable.value);
}

function searchResponseAjax(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        
        tableBody.innerHTML = response;
    }
}