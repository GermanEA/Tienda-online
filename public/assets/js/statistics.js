window.onload = () => {
    chartMonth();
    chartProduct();
};

function chartMonth() {   

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open('POST', baseURL + 'administrator/statistics/updateChart', true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {

        if(peticionAjax.readyState == 4) {
            responseChartMonth(peticionAjax);
        }
    }   

    peticionAjax.send();
}

function responseChartMonth(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        let objJSON = JSON.parse(response);
        let totalPorMeses = getTotalForDate(objJSON);
        
        monthChart(totalPorMeses);
    }
}

function getTotalForDate(json) {
    let total = new Array(12);
    total.fill(0);

    for (const key in json) {
        let month = parseInt(moment(json[key].fecha_pedido).format('MM'));
        let totalM = parseFloat(json[key].total);

        
        total.forEach( (index, mes) => {
            if( month == mes + 1 ){
                total[mes] += totalM;
            }
        });
    }

    return total;
}

function chartProduct() {   

    let peticionAjax = new XMLHttpRequest();
    peticionAjax.open('POST', baseURL + 'administrator/statistics/productChart', true);
    peticionAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    peticionAjax.onreadystatechange = function() {

        if(peticionAjax.readyState == 4) {
            responseChartProduct(peticionAjax);
        }
    }   

    peticionAjax.send();
}

function responseChartProduct(peticionAjax) {
    if( peticionAjax.status == 200 ) {
        let response = peticionAjax.responseText;
        let objJSON = JSON.parse(response);
        let data = getChartProduct(objJSON);
        let labels = getIndexProduct(objJSON);
        
        productChart(data, labels);        
    }
}

function getChartProduct(json) {
    let total = [];

    for (const key in json) {
        total[key] = parseInt(json[key].total); 
    }

    console.log(total);

    return total;
}

function getIndexProduct(json) {
    let index = [];

    for (const key in json) {
        index[key] = json[key].tipo_producto; 
    }

    console.log(index);
    return index;
}


