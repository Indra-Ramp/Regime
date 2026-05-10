document.addEventListener('DOMContentLoaded', function(){
    const evoCanvas = document.getElementById('countUserChart')
    const ctx = evoCanvas.getContext('2d');

    const evoLabels = JSON.parse(evoCanvas.getAttribute('data-labels'));
    const evoValues = JSON.parse(evoCanvas.getAttribute('data-values'));

    const userChart = new Chart(ctx,{
        type : 'line',
        data : {
            labels : evoLabels,
            datasets : [{
                label: 'Utilisateurs inscrits',
                data : evoValues,
                backgroundColor : 'rgba(45, 90, 76, 0.06)',
                borderColor : 'rgba(45, 90, 76, 1)',
                tension : 0.35,
                borderWidth : 1
            }]
        },
        options : {
            responsive : true,
            scales :{
                y :{
                    beginAtZero : true
                }
            },
            plugins:{
                legend : {
                    position :'right',
                    labels : {
                        color: '#1a2e28',
                        font: { family: 'Inter',
                            size: 13,
                            weight: '500'
                        },
                        padding: 15
                    }
                }
            }
        },
    });

    const canvas = document.getElementById('typeAbonnementChart');
    const Typectx = canvas.getContext('2d');

    const labels = JSON.parse(canvas.getAttribute('data-labels'));
    const values = JSON.parse(canvas.getAttribute('data-values'));

    const typeAbonnementChart = new Chart(Typectx,{
        type : 'doughnut',
        data : {
            labels : labels,
            datasets : [{
                label : 'Types d\'abonnement',
                data : values,
                backgroundColor : [
                    'rgb(242, 139, 109)',
                    'rgba(45, 90, 76, 1)', 
                ],
                borderColor : [
                    'rgb(242, 139, 109)',
                    'rgba(45, 90, 76, 1)', 
                ],
                borderWidth : 1
            }]
        },
        options : {
            responsive : true,
            maintainAspectRatio: false,
            plugins : {
                legend : {
                    // Change ici : 'right' pour la droite, 'left' pour la gauche
                    position : 'right', 
                    align: 'center', // Aligne les éléments au centre verticalement
                    labels : {
                        color: '#1a2e28',
                        font: {
                            family: 'Inter',
                            size: 13,
                            weight: '500'
                        },
                        padding: 15 // Espace entre les éléments de la légende
                    }
                }
            }
        },
        cutout : '70%',

    });

})