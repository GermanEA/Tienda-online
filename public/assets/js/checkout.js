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