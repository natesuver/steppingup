var refreshRate = 400;
var accumulatedHrData = [];
var accumulatedStepData = [];
var hrChart;
var stepChart;
function initChart() {
    google.charts.load('current', {'packages':['corechart']});
    accumulatedHrData.push(['Date', 'Heartrate']);
    accumulatedStepData.push(['Date', 'Steps']);
    setTimeout(process,800);
   // process();
}
function process() {
        setInterval(getData,refreshRate)
}
function getData() {
    $.ajax( {type:"Get", url:"step-telemetry.php",data: null, success: function(result) {
        drawStepChart(JSON.parse(result));
    } } );
    $.ajax( {type:"Get", url:"heartrate-telemetry.php",data: null, success: function(result) {
        drawHeartrateChart(JSON.parse(result));
    } } );
}


function drawHeartrateChart(data) {
    for (var i=0;i<data.length;i++) {
        accumulatedHrData.push([new Date(Date.parse(data[i].activityDate.replace('-','/','g'))), parseInt(data[i].heartRate)]);
        if (accumulatedHrData.length > 3000) {
            accumulatedHrData.shift();
            accumulatedHrData[0] = ['Date', 'Heartrate'];
        }
    }

    var data = google.visualization.arrayToDataTable(accumulatedHrData);
    var prior = new Date()
    prior.setSeconds(prior.getSeconds() - 60);
    var now = new Date()
    var options = {
        title: 'Heartrates',
        hAxis: {title: 'Date', minValue: prior, maxValue: now},
        vAxis: {title: 'Heartrate', minValue: 60, maxValue: 130},
        legend: 'none'
    };
    if (hrChart) {
        hrChart.clearChart();
    }
    hrChart = new google.visualization.ScatterChart(document.getElementById('hr_chart'));

    hrChart.draw(data, options);
}

function drawStepChart(data) {
    for (var i=0;i<data.length;i++) {
        accumulatedStepData.push([new Date(Date.parse(data[i].startDate.replace('-','/','g'))), parseInt(data[i].stepsTaken)]);
        if (accumulatedStepData.length > 3000) {
            accumulatedStepData.shift();
            accumulatedStepData[0] = ['Date', 'Steps'];
        }
    }

    var data = google.visualization.arrayToDataTable(accumulatedStepData);
    var prior = new Date()
    prior.setSeconds(prior.getSeconds() - 60);
    var now = new Date()
    var options = {
        title: 'Steps',
        hAxis: {title: 'Date', minValue: prior, maxValue: now},
        vAxis: {title: 'Steps Taken', minValue: 5, maxValue: 100},
        legend: 'none'
    };
    if (stepChart) {
        stepChart.clearChart();
    }
    stepChart = new google.visualization.ScatterChart(document.getElementById('steps_chart'));

    stepChart.draw(data, options);
}