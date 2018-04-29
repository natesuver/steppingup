//Generate random step and heartrate data for random users, for mysql.  you can optionally pass in a particular username as a single argument, and all steps and heartrates will be associated to that user.
//e.g. node telemetry-mysql.js
//e.g. node telemetry-mysql.js "bill_jones"

var mysql      = require('mysql');
var insertInterval = 800;
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database: 'steppingup'
});

function formatNow() {
    var dt = new Date();
    return dt.getFullYear() + '-' + (dt.getMonth()+1) + '-' + dt.getDate() + ' ' + dt.getHours() + ':' + dt.getMinutes() + ':' + dt.getSeconds();
}

function formatOneMinuteAgo() {
    var dt = new Date(new Date() - 60000);
    return dt.getFullYear() + '-' + (dt.getMonth()+1) + '-' + dt.getDate() + ' ' + dt.getHours() + ':' + dt.getMinutes() + ':' + dt.getSeconds();
}

function getRandomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function insertHeartrate() {
    var username = global.usernames[getRandomInteger(0,global.usernames.length-1)].username;
    if (process.argv[2]) {
        username = process.argv[2];
    }
    var sql = 'INSERT INTO heartrates (username, activityDate, heartRate) VALUES (?,?,?)';
    var rateEntry = [username,formatNow(),getRandomInteger(60,130)];
    connection.query(mysql.format(sql, rateEntry), function (error, results, fields) {
        if (error) throw error;
        console.log('Heart rate recorded for ' + username + ': ' + rateEntry[2] + ' bpm' );
      });
}

function insertStep() {
    var username = global.usernames[getRandomInteger(0,global.usernames.length-1)].username;
    if (process.argv[2]) {
        username = process.argv[2];
    }
    var sql = 'INSERT INTO steps (username, startDate, endDate, stepsTaken)  VALUES (?,?,?,?)';
    var entry = [username,formatNow(),formatOneMinuteAgo(),getRandomInteger(5,100)];
    connection.query(mysql.format(sql, entry), function (error, results, fields) {
        if (error) throw error;
        console.log('Steps recorded for ' + username + ': ' + entry[3] + ' steps' );
      });
}

function start(){
    connection.connect(function(err) {
        if (err) {
          console.log('Connected Failure: ' + err);
        } else {
          console.log('Connected Successfully!');
        }
        
      });
    getUsernames()
}

function getUsernames() {
    var sql = 'Select username from users';
    connection.query(sql, function (error, results, fields) {
        if (error) throw error;
        global.usernames = results;
        setInterval(insertHeartrate,insertInterval);
        setInterval(insertStep,insertInterval);
      });
}


start();