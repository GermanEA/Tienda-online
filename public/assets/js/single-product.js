/* DISABLE QUANTITY INPUT */
window.onload = () => {
    document.getElementById('quantity').readOnly = true;
};

let btnAddCart = document.getElementById('btn-cart-single');
let quantityInput = document.getElementById('quantity');

/* CHEKCHING RADIO SIZE SINGLE PRODUCT */
btnAddCart.addEventListener('click', () => {  
    let radioBtn = document.querySelectorAll('input[type="radio"]');
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
    if(quantityInput.value > 0) {
        quantityInput.value ++;
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

/* NOTIFICATION SUCCES */
function notificationSuccess() {
    let notificationDiv = document.getElementById('notifications');

    notificationDiv.style.display = 'flex';

    setTimeout( function() {
        notificationDiv.style.display = 'none';
    }, 3000);
}

/* ADD CART AJAX */
function addCartPost() {
    let radioBtn = document.querySelectorAll('input[type="radio"]');
    let sizeRadio = '';
    
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
        "image": productImage
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
    peticionAjax.open("POST", baseURL + "cart/cart/addCartProduct",true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {
        if(peticionAjax.readyState == 4) {
            filterResponseAjax(peticionAjax);
        }
    }   

    peticionAjax.send(string);
}

function filterResponseAjax(peticionAjax) {  
    let totalItemsDiv = document.getElementById('total-items');

    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        totalItemsDiv.innerHTML = response;
    }
}