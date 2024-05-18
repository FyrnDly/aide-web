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
    // Get Value
    var weekId = document.getElementById('weekChart');
    var weekData = JSON.parse(weekId.getAttribute('data-sm-week'));
    var timeWeek = JSON.parse(weekId.getAttribute('data-sm-time'));
    var todayDate = weekId.getAttribute('data-sm-date-today');
    var weekDate = weekId.getAttribute('data-sm-date-week');
    
    // Prepare Data
    var dataArray = [['Tanggal', ...timeWeek]];
    for (let [date, values] of Object.entries(weekData)) {
        let row = [date];
        for (let time of timeWeek) {
            row.push(values[time] || 0);
        }
        dataArray.push(row);
    }

    // Set Data
    var data = google.visualization.arrayToDataTable(dataArray);
    
    // Set Title
    var options = {
        chart: {
            title: 'Pembersihan Hama Wereng Seminggu Terakhir',
            subtitle: `Tanggal: ${weekDate} - ${todayDate}`,
        }
    };

    var chart = new google.charts.Bar(document.getElementById('weekChart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}

function monthChart() {
    // Get Value
    var monthId = document.getElementById('monthChart');
    var monthData = monthId.getAttribute('data-sm-month');
    var parseData = JSON.parse(monthData);
    var arrayData = Object.entries(parseData).map(([date, value]) => [date, value]);

    // Set Data
    var data = google.visualization.arrayToDataTable([
        ['Tanggal', 'Hama Terbasmi'],
        ...arrayData,
    ]);
    // Set Title
    const dateTime = new Date();
    const monthName = dateTime.toLocaleString("id-ID", {month: "long"});
    var options = {
        chart: {
            title: 'Pembersihan Hama Wereng Sebulan Terakhir',
            subtitle: `Bulan: ${monthName}`,
        }
    };

    var chart = new google.charts.Bar(document.getElementById('monthChart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}

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