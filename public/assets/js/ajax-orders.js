let searchTable = document.getElementById('search-bar');
let tableBody = document.getElementById('table-body');

searchTable.addEventListener('keyup', searchPostAjax, false);

function searchPostAjax() {   

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open('POST', baseURL + 'administrator/dashboard/searchAjax', true);
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
        
        console.log(response);
        tableBody.innerHTML = response;
    }
}