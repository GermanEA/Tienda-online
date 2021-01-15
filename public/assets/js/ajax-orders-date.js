let searchDateStart = document.getElementById('search-date-start');
let searchDateEnd = document.getElementById('search-date-end');
let tableBody = document.getElementById('table-body');

searchDateStart.addEventListener('change', searchPostAjaxDate, false);
searchDateEnd.addEventListener('change', searchPostAjaxDate, false);

function searchPostAjaxDate() {   

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open('POST', baseURL + 'administrator/dashboard/searchAjaxDate', true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {

        if(peticionAjax.readyState == 4) {
            searchResponseAjax(peticionAjax);
        }
    }   

    peticionAjax.send("dateStart=" + searchDateStart.value + "&dateEnd=" + searchDateEnd.value);
}

function searchResponseAjax(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        
        console.log(response);
        tableBody.innerHTML = response;
    }
}