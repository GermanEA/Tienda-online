let btnArray = document.querySelectorAll('.btn-cart-remove');
let codigoProducto = document.getElementById('product-code');

btnArray.forEach( e => {
    e.addEventListener('click', () => {
        let productCode = e.parentElement.firstElementChild.firstElementChild.innerText;
        let productArray = JSON.parse(sessionStorage.getItem(productCode));

        if( productArray.length <= 1) {
            sessionStorage.removeItem(productCode);
        } else {
            let size = e.previousElementSibling.lastElementChild.firstElementChild.innerText;
            
            productArray.forEach( ( e, i) => {
                for (const key in e) {
                    if( size == key ) {
                        productArray.splice(i, 1);
                    }
                }
            });

            sessionStorage.setItem(productCode, JSON.stringify(productArray));
        }
    })
});