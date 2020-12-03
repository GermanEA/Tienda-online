var btn_actions = document.querySelectorAll("#btnActions button");
var content_divs = document.querySelectorAll("[class^='content-']");

console.log(content_divs);

btn_actions.forEach( element => {
    element.addEventListener( "click", showSales );
});

function showSales( e ) {
    
    var check = e.target.id;

    content_divs.forEach( element => {        

        if ( check === element.getAttribute("data-id") ) {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
        
    });
}

