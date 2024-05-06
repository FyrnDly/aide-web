// Load the Visualization API and the corechart package.
google.charts.load('current', {
    'packages': ['bar', 'gauge']
});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(weekChart);
google.charts.setOnLoadCallback(monthChart);
google.charts.setOnLoadCallback(percentageBattery);

// Callback function chart
function weekChart() {
    // Set Data
    var data = google.visualization.arrayToDataTable([
        ['Hari', '08.00 WIB', '13.00 WIB', '17.00 WIB'],
        ['Minggu', 101, 212, 200],
        ['Senin', 321, 120, 50],
        ['Selasa', 209, 129, 69],
        ['Rabu', 103, 102, 20],
        ['Kamis', 112, 20, 70],
        ['Jumat', 120, 240, 350],
        ['Sabtu', 112, 243, 101],
    ]);
    // Set Title
    var options = {
        chart: {
            title: 'Pembersihan Hama Wereng Seminggu Terakhir',
            subtitle: 'Tanggal: 21/04/2024 - 27/04/2024',
        }
    };

    var chart = new google.charts.Bar(document.getElementById('weekChart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}

function monthChart() {
    // Set Data
    var data = google.visualization.arrayToDataTable([
        ['Tanggal', 'Hama'],
        ['01', 513],
        ['02', 491],
        ['03', 209],
        ['04', 321],
        ['05', 112],
        ['06', 120],
        ['07', 112],
        ['08', 101],
        ['09', 321],
        ['10', 209],
        ['11', 201],
        ['12', 101],
        ['13', 321],
        ['14', 112],
        ['15', 321],
        ['16', 120],
        ['17', 112],
        ['18', 112],
        ['19', 120],
        ['20', 101],
        ['21', 321],
        ['22', 112],
        ['23', 112],
        ['24', 120],
        ['25', 209],
        ['26', 112],
        ['27', 112],
        ['28', 120],
        ['29', 321],
        ['30', 120],
        ['31', 90],
    ]);
    // Set Title
    var options = {
        chart: {
            title: 'Pembersihan Hama Wereng Sebulan Terakhir',
            subtitle: 'Bulan: April',
        }
    };

    var chart = new google.charts.Bar(document.getElementById('monthChart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}

function percentageBattery() {
    const batteryId = document.getElementById('percentageBattery');
    const atributePercentage = Number(batteryId.getAttribute('data-sm-battery'));

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