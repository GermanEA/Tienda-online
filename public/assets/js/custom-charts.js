function monthChart(data) {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre',
            ],
            datasets: [{
                label: 'Ventas por mes',
                // backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(177, 9, 9)',
                data: data
            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: true,
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    // fontColor: 'black',
                    // fontSize: '2rem'
                }
            }
        }
    });

    chart.canvas.parentNode.style.height = '400px';
    chart.canvas.parentNode.style.width = '400px';
}

function productChart(data, labels) {
    var horizontalBarChartData = {
        labels: labels,
        datasets: [{
            label: 'Ventas por categorías',
            backgroundColor: ["#e23333", "#ff9100", "#14A76C", "#1888e4", "#d471bf", "#5de220"],
            borderColor: '#ffffff',
            borderWidth: 1,
            data: data
        },]

    };

    var ctx = document.getElementById('myChart2').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: horizontalBarChartData,
        options: {
            responsive: true,
            legend: {
                position: 'left',
            },
            title: {
                display: true,
                text: 'Ventas por categorías'
            },
        }
    });

    chart.canvas.parentNode.style.height = '400px';
    chart.canvas.parentNode.style.width = '400px';
}