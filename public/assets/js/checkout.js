let addressChange = document.getElementById('new-address');
let checkboxAddress = document.getElementById('other-address');
let titleBill = document.getElementById('title-bill');

/* Función para agregar los datos de envío en la pantalla de comprar ahora */
let showAddress = () => {
    if( checkboxAddress.checked == true ) {
        addressChange.style.display = 'block';
        titleBill.innerText = 'Dirección de factura';
    } else {
        addressChange.style.display = 'none';
        titleBill.innerText = 'Datos de facturación';
    }    
}

checkboxAddress.addEventListener('click', showAddress, false);

/* Función para poner todos los inputs obligatorios
 si el usuario elige la opción de enviar a otra dirección */
let formSendActive = () => {
    let form = document.forms['formShop'];
    let formArray = [];
    formArray.push(
        form['name-other'],
        form['lname-other'],
        form['cif-other'],
        form['address-other'],
        form['postal-other'],
        form['city-other']
    );

    if( checkboxAddress.checked == true ) {
        formArray.forEach(element => {
            element.required = true;
        });
    } else {
        formArray.forEach(element => {
            element.required = false;
        });
    }
}

checkboxAddress.addEventListener('click', formSendActive, false);