let codigoProducto = document.getElementById('codigo-producto');
let descripcion = document.getElementById('descripcion');
let material = document.getElementById('material');
let color = document.getElementById('color');
let btnAdd = document.getElementById('btn-add');
let modal = document.getElementById('modal-details');
let modalContent = document.getElementById('modal-content-dynamic');
let modalClose = document.getElementById('modal-close');
let allCheck = {
    'codigo': false,
    'descripcion': false,
};

codigoProducto.addEventListener('change', checkCP, false);
descripcion.addEventListener('change', checkDesc, false);
material.addEventListener('change', checkMaterial, false);
color.addEventListener('change', checkColor, false);

modalClose.addEventListener('click', closeModal, false);
window.addEventListener('click', closeModalWindow, false);

function setValidateButton() {
    let check = true;
  
    for (const key in allCheck) {
      if( allCheck[key] === false ){
        check = false;
      }
    }
  
    if( check === false ) {
      btnAdd.disabled = true;
    } else {
      btnAdd.disabled = false;
    }
}

function checkCP() {
    if( codigoProducto.value.length != 8) {
        allCheck['codigo'] = false;
        openModal('El código de producto debe contener 8 caracteres.');
        setValidateButton();
    } else {
        allCheck['codigo'] = true;
        setValidateButton();
    }
}

function checkDesc() {
    console.log(descripcion.value.length);
    if( descripcion.value.length < 1 || descripcion.value.length > 50 ) {
        allCheck['descripcion'] = false;
        openModal('El código de producto debe contener menos de 50 caracteres.');
        setValidateButton();
    } else {
        allCheck['descripcion'] = true;
        setValidateButton();
    }
}

function checkMaterial() {
    if( material.value.length < 1 || material.value.length > 50 ) {
        allCheck['material'] = false;
        openModal('El material debe contener menos de 50 caracteres.');
    }
}

function checkColor() {
    if( color.value.length < 1 || color.value.length > 25 ) {
        allCheck['color'] = false;
        openModal('El color debe contener menos de 25 caracteres.');
    }
}

function openModal(message) {
    let div = '<div class="modal-message-content text-center"><span><i class="fas fa-exclamation-triangle"></i></span><span>' + message + '</span></div>'
    modalContent.innerHTML = div;
    modal.style.display = "block";
}

function closeModal() {
    modal.style.display = "none";
}

function closeModalWindow(e) {
    if( e.target == modal ) {
        modal.style.display = "none";
    }
}