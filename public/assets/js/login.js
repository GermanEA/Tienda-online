/* CHECK REGISTER */
let form      = document.forms['register-form'];
let fname     = form['name-reg'];
let lname     = form['lastname-reg'];
let email     = form['email-reg'];
let pass      = form['pass-reg'];
let passCheck = form['pass-reg-r'];
let address   = form['address-reg'];
let postal    = form['postal-reg'];
let phone     = form['phone-reg'];
let passOneOk = false;
let alertForm = document.getElementById('alert-form');
let btnReg    = document.getElementById('btn-reg');
let allCheck  = {
  'name-reg':     false,
  'lastname-reg': false,
  'email-reg':    false,
  'pass-reg':     false,
  'pass-reg-r':   false,
  'address-reg':  false,
  'postal-reg':   false,
  'phone-reg':    false
};

// Método para ir cambiando cuando un input es correcto
let changeAllCheck = (element, boolean) => {
  allCheck[element.name] = boolean;
}

// Método de validación del formulario
let setValidateButton = () => {
  let check = true;

  for (const key in allCheck) {
    if( allCheck[key] === false ){
      check = false;
    }
  }

  if( check === false ) {
    btnReg.disabled = true;
    return false;
  } else {
    btnReg.disabled = false;
    return true;
  }
}

// Método para añadir estilos y el mensaje a las comprobaciones válidas
let checked = (input) => {  
  alertForm.innerHTML = "";
  input.classList.add('checked');
  input.classList.remove('unchecked');
  changeAllCheck(input, true);
  setValidateButton();
}

// Método para añadir estilos y el mensaje a las comprobaciones NO válidas
let unchecked = (input, message) => {
  alertForm.style.display = 'initial';
  alertForm.innerHTML = message;
  input.classList.add('unchecked');
  input.classList.remove('checked');
  changeAllCheck(input, false);
  setValidateButton();
}

// Comprobación del nombre y apellido del usuario
let checkName = (input) =>  {
  let pattern = /^[A-z]{2,25}$/; //Solo se admiten letras y números entre 2 y 25

  if( input.value.match(pattern) ){
      checked(input);
  } else {
      unchecked(input, "Debe constar de entre 2 y 25 letras.");
  }
}

fname.addEventListener('keyup', function(){checkName(fname)}, false);
lname.addEventListener('keyup', function(){checkName(lname)}, false);

// Control de un formato de email válido
let checkEmail = () => {
  let pattern = /\S+@\S+\.\S+/; // \S non whitespace character

  if( email.value.match(pattern) ){
      checked(email);
  } else {
      unchecked(email, "El correo debe ser un correo válido.");
  }
}

email.addEventListener('keyup', checkEmail, false);

// Comprobación del primer password
let checkPassOne = () => {
    let pattern = /^[a-zA-Z0-9!"#$%&'()*+,-.\/:;<=>?\\@[\]^_`{|}~]{4,8}$/;

    pass.classList.remove('wrong-pass');

    if( pass.value.match(pattern) ){
      checked(pass);
      passOneOk = true;
    } else {
      unchecked(pass, "La contraseña debe tener longitud de entre 4 y 8 caracteres");
      passOneOk = false;
    }
}

pass.addEventListener('keyup', checkPassOne, false);

// Comprobar que los dos passwords son iguales
let checkPassEquals = () => {

    if( passOneOk ){

      if( passCheck.value === pass.value ){
          checked(passCheck);
          pass.readOnly = true;
          passCheck.readOnly = true;
      } else {
          unchecked(passCheck, 'La contraseña que has introducido no es correcta, primero inserta una contraseña válida.');
      }    
    } else {
      pass.classList.add('wrong-pass');
      unchecked(passCheck, 'La contraseña no es válida, introduce primero una correcta.');
    }
}

passCheck.addEventListener('keyup', checkPassEquals, false);

// Comprobar que la dirección es correcta
let checkAddress = () => {
  let pattern = /^[a-zA-Z0-9!"#$%&'()*+,-.\/:;<=>?\\@[\]^_`{|}~ºª\s]{1,50}$/;

  if( address.value.match(pattern) ){
    checked(address);
  } else {
    unchecked(address, "La dirección no puede contener más de 50 caracteres.");
  }
}

address.addEventListener('keyup', checkAddress, false);

// Comprobar el código postal
let checkPostal = () => {
  let pattern = /^[0-9]{5}$/;

  if( postal.value.match(pattern) ){
    checked(postal);
  } else {
    unchecked(postal, "Introduce un código postal válido.");
  }
}

postal.addEventListener('keyup', checkPostal, false);

// Comprobar el formato del teléfono
let checkPhone = () => {
  let pattern = /^[0-9]{9}$/;

  if( phone.value.match(pattern) ){
    checked(phone);
  } else {
    unchecked(phone, "Introduce un número de teléfono válido. Sin el prefijo internacional (+34)");
  }
}

phone.addEventListener('keyup', checkPhone, false);



