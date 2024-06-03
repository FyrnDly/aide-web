// Load the Visualization API and the corechart package.
google.charts.load('current', {
    'packages': ['bar', 'gauge']
});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(percentageBattery);

// Callback function chart
function percentageBattery() {
    // Get Value
    const batteryId = document.getElementById('percentageBattery');
    const atributePercentage = Number(batteryId.getAttribute('data-sm-battery'));
    
    // Set Data
    var data = google.visualization.arrayToDataTable([
        ['Label', 'Percentage'],
        ['Battery', atributePercentage]
    ]);

    var options = {
        redColor: '#FF3E28',
        redFrom: 0,
        redTo: 20,
        yellowColor: '#FFE735',
        yellowFrom: 20,
        yellowTo: 60,
        greenColor: '#A3F161',
        greenFrom: 60,
        greenTo: 100,
        animation: {
            duration: 2500,
            easing: 'out'
        },
        minorTicks: 10,

    };

    var chart = new google.visualization.Gauge(document.getElementById('percentageBattery'));
    chart.draw(data, options);
}