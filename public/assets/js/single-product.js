/* DISABLE QUANTITY INPUT */
window.onload = () => {
    document.getElementById('quantity').readOnly = true;
};

let btnAddCart = document.getElementById('btn-cart-single');
let quantityInput = document.getElementById('quantity');
let radioBtn = document.querySelectorAll('input[type="radio"]');
let radioBtnChanged = [];
let firstTime = true;
let maxStore;

/* CHEKCHING RADIO SIZE SINGLE PRODUCT */
btnAddCart.addEventListener('click', () => {
    let message = document.getElementById('size-message');
    let check = [];
    let canBuy = false; 

    radioBtn.forEach(element => {
        check.push(element.checked);
    });

    if( check.length === 0 ) {
        canBuy = true;
    } else {
        check.forEach(element => {
            if(element === true) {
                canBuy = true;
            }
        });
    }

    if(!canBuy) {
        message.style.display = 'flex';

        setTimeout( ()=> {
            message.style.display = 'none';
        }, 3000);
    } else {
        addCartPost();
        notificationSuccess();
    }
});
  
/* QUANTITY MODIFY SINGLE PRODUCT */
let minusDiv = document.getElementById('minus');
let plusDiv = document.getElementById('plus');

minusDiv.addEventListener('click', () => {
    if(quantityInput.value > 1) {
        quantityInput.value --;
    } else {
        quantityInput.value = 1;
    }
});

plusDiv.addEventListener('click', () => {
    let value = parseInt(quantityInput.value);
    let max = parseInt(quantityInput.max);
    
    if(value > 0) { 
        if(value < max) {
            quantityInput.value ++;
        }
    } else { 
        quantityInput.value = 1;
    }
});

/* ENTER PREVENT INPUT */
quantityInput.addEventListener('keydown', (event) => {
    if(event.key == 'Enter') {
        event.preventDefault();
        return false;
    }
});

/* NOTIFICATIONS */
function notificationSuccess() {
    let notificationDiv = document.getElementById('notifications');

    notificationDiv.style.display = 'flex';

    setTimeout( function() {
        notificationDiv.style.display = 'none';
    }, 3000);
}

function notificationError(message) {
    let notificationDiv = document.getElementById('notifications');
    notificationDiv.innerText = message;
    notificationDiv.style.borderTopColor = '#b10909';

    notificationDiv.style.display = 'flex';

    setTimeout( function() {
        notificationDiv.style.display = 'none';
    }, 3000);
}

/* ADD CART AJAX */
function addCartPost() {
    let radioBtn = document.querySelectorAll('input[type="radio"]');
    let sizeRadio = '';

    if( quantityInput.max <= 0) {
        notificationError('Lo sentimos el producto se acaba de quedar sin stock.');
    } else {
        radioBtn.forEach(element => {
            if(element.checked) {
              sizeRadio = element.value;
            };
        });
    
        let params = {
            "id": productCode + sizeRadio,
            "qty": quantityInput.value,
            "price": productPrice,
            "name": productName,
            "size": sizeRadio,
            "image": productImage,
            "id-producto": btnAddCart.value,
            "product-code": productCode
        };
    
        let string = "";
    
        for (const key in params) {
            if( key == "id") {
                string += key + "=" + params[key];
            } else {
                string += "&" + key + "=" + params[key];
            }
        }
    
        let peticionAjax = new XMLHttpRequest();
        peticionAjax.open("POST", baseURL + "cart/cart/addCartProduct",true);
        peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
        peticionAjax.onreadystatechange = function() {
            if(peticionAjax.readyState == 4) {
                filterResponseAjax(peticionAjax);
            }
        }
    
        peticionAjax.send(string);
    }
    
}

function filterResponseAjax(peticionAjax) {  
    let totalItemsDiv = document.getElementById('total-items');    
    let numberStockDiv = document.getElementById('number-stock');

    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        totalItemsDiv.innerHTML = response;
        quantityInput.max -= quantityInput.value;
        quantityInput.value = 1;
        numberStockDiv.innerText = quantityInput.max;
        maxStore = quantityInput.max;

        radioBtn.forEach(element => {
            if(element.checked) {
                radioBtnChanged[element.id] = maxStore;
            };
        });
    }
}

/* CHANGE STOCK WHEN CHANGE SIZE */
radioBtn.forEach(element => {
    element.addEventListener('click', changeSize, false);
});

function changeSize() {
    let sizeRadio = '';        
    let numberStockDiv = document.getElementById('number-stock');
    quantityInput.value = 1;
    
    radioBtn.forEach(element => {
        if(element.checked) {
          sizeRadio = element.value;
        };
    });

    let string = "cp=" + productCode + "&ct=" + sizeRadio;

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open("POST", baseURL + "products/product_single/getStock",true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {
        if(peticionAjax.readyState == 4) {
            filterResponseAjaxChange(peticionAjax);
        }
    }   

    peticionAjax.send(string);
}

function filterResponseAjaxChange(peticionAjax) {  
    let articulo;
    let stockDiv = document.getElementById('stock-wrapper');

    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        if( response == 1) {
            articulo = 'artículo';
        } else {
            articulo = 'artículos';
        }

        radioBtn.forEach(element => {
            // debugger;
            if(firstTime != true){
                if(element.checked) {
                    for( let key in radioBtnChanged ){
                        if (typeof radioBtnChanged[key] !== 'function') {
                            if(element.id == key) {
                                stockDiv.innerHTML = '<span>Quedan en stock: </span><span id="number-stock">' + radioBtnChanged[key] + '</span><span> ' + articulo + '</span>'
                                quantityInput.max = radioBtnChanged[key];
                            }
                        }
                    }                
                    
                }
            } else {
                stockDiv.innerHTML = '<span>Quedan en stock: </span><span id="number-stock">' + response + '</span><span> ' + articulo + '</span>';
                quantityInput.max = response;                
            }
        });
    }
}
