window.onload = () => {
    destroy();
}

function destroy(){
    let cookie = getCookie('destroyed');

    if( cookie == 1) {
        let n = localStorage.length;

        while(n--) {
            let key = localStorage.key(n);
            localStorage.removeItem(key);
        }

        deleteCookie('destroyed');
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function deleteCookie(name) {
    document.cookie = name +'=; Path=/cart/cart; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}