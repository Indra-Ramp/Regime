document.addEventListener('DOMContentLoaded', function(){
    const evoCanvas = document.getElementById('countUserChart')
    const ctx = evoCanvas.getContext('2d');

    const evoLabels = JSON.parse(evoCanvas.getAttribute('data-labels'));
    const evoValues = JSON.parse(evoCanvas.getAttribute('data-values'));

    const userChart = new Chart(ctx,{
        type : 'line',
        data : {
            labels : labels,
            datasets : [{
                label : 'Nombre d\'utilisateurs',
                data : values,
                backgroundColor : 'rgba(54, 162, 235, 0.2)',
                borderColor : 'rgba(54, 162, 235, 1)',
                tension : 0.4,
                borderWidth : 1
            }]
        },
        options : {
            responsive : true,
            scales :{
                y :{
                    beginAtZero : true
                }
            }
        }
    });

    const canvas = document.getElementsById('typeAbonnementChart');
    const Typectx = canvas.getContext('2d');

    const labels = JSON.parse(canvas.getAttribute('data-labels'));
    const values = JSON.parse(canvas.getAttribute('data-values'));

    const typeAbonnementChart = new Chart(ctx,{
        type : 'doughnut',
        data : {
            labels : labels,
            datasets : [{
                label : 'Types d\'abonnement',
                data : values,
                backgroundColor : [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)', 
                ],
                borderColor : [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)', 
                ],
                borderWidth : 1
            }]
        },
        options : {
            responsive : true,
            plugins : {
                legend : {
                    position : 'top'
                }
            }
        }

    })

})