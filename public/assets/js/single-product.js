/* DISABLE QUANTITY INPUT */
let btnAddCart = document.getElementById('btn-cart-single');
let quantityInput = document.getElementById('quantity');
let radioBtn = document.querySelectorAll('input[type="radio"]');
let sizeRadio;
let radioBtnChanged = [];
let maxStore;
let storageProduct = [];
let productSession;
let numberStockDiv = document.getElementById('number-stock');
let item = new Array();

window.onload = () => {
    document.getElementById('quantity').readOnly = true;

    checkStorage();
};

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
    sizeRadio = '';

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
    numberStockDiv = document.getElementById('number-stock');

    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        totalItemsDiv.innerHTML = response;
        quantityInput.max -= quantityInput.value;
        quantityInput.value = 1;
        numberStockDiv.innerText = quantityInput.max;
        maxStore = quantityInput.max;

        // checkStorage();

        radioBtn.forEach(element => {
            if(element.checked) {
                radioBtnChanged[element.id] = maxStore;
            };
        });        
        
        if(sizeRadio == '') {
            storageProduct = [];
            let element = {
                stock: maxStore
            };
            storageProduct.push(element);
            localStorage.setItem(productCode, JSON.stringify(storageProduct));
        } else {
            let check = false;
            let element = {
                [sizeRadio]: maxStore
            }            

            if( item ) {
                storageProduct = item;
            }
            
            if( storageProduct != null ) {
                storageProduct.forEach( (e, i) => {
                    for (let key in e) {
                        for(let keyE in element) {
                            if( key === keyE ){
                                storageProduct[i] = element;
                                check = true;
                            }
                        }
                    }
                });
            }

            if( check != true ){
                storageProduct.push(element);
            }

            localStorage.setItem(productCode, JSON.stringify(storageProduct));
        }
    }
}

/* CHANGE STOCK WHEN CHANGE SIZE */
radioBtn.forEach(element => {
    element.addEventListener('click', changeSize, false);
});

function changeSize() {
    let sizeRadio = '';
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

        if( item ) {
            // debugger;
            console.log(item);
            radioBtn.forEach(element => {
                if(element.checked) {
                    switch (switchSize(item, element)) {
                        case true:
                            console.log('Pinta la sesion');
                            for( let key in item ){
                                for(const keyE in item[key]) {
                                    if(element.id == keyE) {
                                        if( item[key][keyE] == 1 ){
                                            articulo = 'artículo';
                                        } else {
                                            articulo = 'artículos';
                                        }
                                        stockDiv.innerHTML = '<span>Quedan en stock: </span><span id="number-stock">' + item[key][keyE] + '</span><span> ' + articulo + '</span>'
                                        quantityInput.max = item[key][keyE];
                                    }
                                }
                            }
                            break;
                        case false:
                            if( response == 1) {
                                articulo = 'artículo';
                            } else {
                                articulo = 'artículos';
                            }

                            console.log('Pinta la db');
                            stockDiv.innerHTML = '<span>Quedan en stock: </span><span id="number-stock">' + response + '</span><span> ' + articulo + '</span>';
                            quantityInput.max = response;
                            break;
                    }
                                      
                }
            });

        } else {
            if( response == 1) {
                articulo = 'artículo';
            } else {
                articulo = 'artículos';
            }
    
            stockDiv.innerHTML = '<span>Quedan en stock: </span><span id="number-stock">' + response + '</span><span> ' + articulo + '</span>';
            quantityInput.max = response;
    
            radioBtn.forEach(element => {
                for( let key in radioBtnChanged ){
                    if(element.checked) {
                        if (typeof radioBtnChanged[key] !== 'function') {
                            if(element.id == key) {
                                stockDiv.innerHTML = '<span>Quedan en stock: </span><span id="number-stock">' + radioBtnChanged[key] + '</span><span> ' + articulo + '</span>'
                                quantityInput.max = radioBtnChanged[key];
                            }
                        }
                    }                   
                }
            });
        }         
    }
}

function switchSize(item, element) {
    let check = false;

    for( let key in item ){
        for(const keyE in item[key]) {
            if(element.id == keyE) {
                check = true;
            }
        }
    }

    return check;
}

function checkStorage() {
    item = JSON.parse(localStorage.getItem(productCode));

    if( item ) {
        item.forEach( (e, i) => {
            if( e.stock) {
                numberStockDiv.innerText = e.stock;
                quantityInput.max = e.stock;
            }
        });
    }
}
