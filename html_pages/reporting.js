
var startDate;
function setDateDefaults() {
    var from = document.getElementById('from');
    var to = document.getElementById('to');
    var dt = new Date();
    from.value = new Date().toISOString().slice(0,10);
    to.value = new Date().toISOString().slice(0,10);
}
function search() {
    startDate = new Date();
    var rptId = document.getElementById('reportId').value;
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;
    if (!rptId) {
        alert('Select a Report');
        return;
    }
    if (!from) {
        alert('From Date is Required');
        return;
    }
    if (!to) {
        alert('To Date is Required');
        return;
    }
    $.ajax( {type:"Post", url:"reportSearch.php",data: {rptId:rptId, from: from, to: to}, success: function(result) {
        displaySearchResults(JSON.parse(result));
    } } );
}

function displaySearchResults(results) {
    var tableHeadersDiv = document.getElementById('tableHeaders');
    var tableResultDiv = document.getElementById('results');
    var fieldNames = Object.keys(results[0]); //get the names of the fields
    var headerText = '';
    for (var i=0;i<fieldNames.length;i++) {
        var fieldName = fieldNames[i];
        headerText += "<th>" + fieldName + "</th>";
    }
    tableHeadersDiv.innerHTML = headerText;


    var resultText = '';
    for (var i=0;i<results.length;i++) {
        resultText += "<tr>"
        var result = results[i];
        for (var col=0;col<fieldNames.length;col++) {
            resultText += "<td>" + Object.values( result )[col] + "</td>";
        }
        resultText += "</tr>"
    }
    tableResultDiv.innerHTML = resultText;
    var duration = new Date()-startDate;
    toastr.info('Report Executed in ' + duration + ' ms');
}

