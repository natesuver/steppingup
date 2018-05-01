var startDate;
function search() {
    startDate = new Date();
    var searchFor = document.getElementById('searchText').value;
    if (!searchFor) {
        alert('Enter at least one character');
        return;
    }
    $.ajax( {type:"Post", url:"userSearch.php",data: {searchtext:searchFor}, success: function(result) {
        displaySearchResults(JSON.parse(result));
    } } );
}

function displaySearchResults(results) {
    var tableResultDiv = document.getElementById('results');
    var resultText = '';
    for (var i=0;i<results.length;i++) {
        var result = results[i];
        resultText += "<tr><td><a href='user-info.php?user=" + result.username + "'>" + result.username + "</a></td><td>" + result.fName + "</td><td>" + result.lName + "</td><td>" + result.address  + "</td></tr>";
    }
    tableResultDiv.innerHTML = resultText;
    var duration = new Date()-startDate;
    toastr.info('Search Executed in ' + duration + ' ms, ' + results.length + ' records found');
}