var mysql      = require('mysql');
require('./seeds.js');
var insertInterval = 10;
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database: 'steppingup'
});

connection.connect(function(err) {
  if (err) {
    console.log('Connected Failure: ' + err);
  } else {
    console.log('Connected Successfully!');
  }
  
});

function randomEntry(list) {
    return list[getRandomInteger(0,list.length-1)];
}

function generateRandomBirthDate() {
    var dt = randomDate(new Date(1972,1,1),new Date(2015,11,30));
    return dt.getFullYear() + '-' + dt.getMonth() + '-' + dt.getDate();
}
function randomDate(start, end) {
    return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()))
}

function getRandomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function insertRandomUsers() {
    setInterval(insertUser,insertInterval)
}

function insertUser() {
    var sql = 'INSERT INTO users (username, password, fName, lName, address, city, state, pCode, gender, birthDate, height, weight, occupation, admin) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
    var user = buildUser();
    connection.query("SELECT count(*) as cnt from users WHERE username = '" + user[0] + "';", function (error, results, fields) {
         if (error) throw error;
         if (results[0].cnt == 0) {
            connection.query(mysql.format(sql, user), function (error, results, fields) {
                if (error) throw error;
                console.log('Insert Completed for ' + user[0]);
              });
         }
         else {
            console.log('User ' + user[0] + ' already exists, skipping.');
         }
       });
}
function buildUser() {
    var first = randomEntry(global.firstNames);
    var last = randomEntry(global.lastNames);
    var city= randomEntry(global.cities);
    var state= randomEntry(global.states);
    var zip = randomEntry(global.zipCodes);
    var gender = randomEntry(global.genders);
    var username = first + "_" + last;
    var height = getRandomInteger(40,100);
    var weight = getRandomInteger(80,300);
    var bDate = generateRandomBirthDate();
    var address= getRandomInteger(100,300) + ' ' + randomEntry(global.firstNames) + ' St';
    var occupation =  randomEntry(global.occupations);
    
    var inserts = [username,'pw123',first,last,address,city,state,zip,gender,bDate, height, weight,occupation,0];
    return inserts;
   
}
insertRandomUsers();