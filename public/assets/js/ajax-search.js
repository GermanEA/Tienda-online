// Peticiones Ajax del buscador 
let principalContainer = document.getElementById('principal-container');
let searchHeader = document.getElementById('search-bar');

// searchHeader.addEventListener('click', redirectPage, false);
searchHeader.addEventListener('keyup', searchPostAjax, false);

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
            principalContainer.innerHTML = response;
    }
}

// function filterPostAjax() {
    
//     let params = {
//         "Packs": checkboxPacks.checked,
//         "Discos": checkboxDiscs.checked,
//         "Camisetas": checkboxShirt.checked,
//         "Sudaderas": checkboxSweetshirt.checked,
//         "Gorras": checkboxCap.checked,
//         "Otros": checkboxOthers.checked,
//     };

//     let string = "";

//     for (const key in params) {
//         if( key == "packs") {
//             string += key + "=" + params[key];
//         } else {
//             string += "&" + key + "=" + params[key];
//         }
//     }

//     let peticionAjax = new XMLHttpRequest();
//     peticionAjax.open("POST", baseURL + "products/product_search/index",true);
//     peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

//     peticionAjax.onreadystatechange = function() {

//         if(peticionAjax.readyState == 4) {
//             filterResponseAjax(peticionAjax);
//         }
//     }   

//     peticionAjax.send(string);
// }

// function filterResponseAjax(peticionAjax) {
//     if( peticionAjax.status == 200 ) {
//         let response = peticionAjax.responseText;
//             searchHtml.innerHTML = response;
//     }
// }