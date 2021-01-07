/* FILTER AJAX SIDEBAR */
let searchHtml = document.getElementById('search');

let checkboxPacks = document.getElementById('Packs');
let checkboxDiscs = document.getElementById('Discos');
let checkboxShirt = document.getElementById('Camisetas');
let checkboxSweetshirt = document.getElementById('Sudaderas');
let checkboxCap = document.getElementById('Gorras');
let checkboxOthers = document.getElementById('Otros');

checkboxPacks.addEventListener('click', filterPostAjax, false);
checkboxDiscs.addEventListener('click', filterPostAjax, false);
checkboxShirt.addEventListener('click', filterPostAjax, false);
checkboxSweetshirt.addEventListener('click', filterPostAjax, false);
checkboxCap.addEventListener('click', filterPostAjax, false);
checkboxOthers.addEventListener('click', filterPostAjax, false);

function filterPostAjax() {
    
    let params = {
        "Packs": checkboxPacks.checked,
        "Discos": checkboxDiscs.checked,
        "Camisetas": checkboxShirt.checked,
        "Sudaderas": checkboxSweetshirt.checked,
        "Gorras": checkboxCap.checked,
        "Otros": checkboxOthers.checked,
    };

    let string = "";

    for (const key in params) {
        if( key == "packs") {
            string += key + "=" + params[key];
        } else {
            string += "&" + key + "=" + params[key];
        }
    }

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open("POST", baseURL + "products/product_search/index",true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {

        if(peticionAjax.readyState == 4) {
            filterResponseAjax(peticionAjax);
        }
    }   

    peticionAjax.send(string);
}

function filterResponseAjax(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
            searchHtml.innerHTML = response;
    }
}



