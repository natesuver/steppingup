//Create random user accounts for either mongo or mysql.  specify in arguments which database type you wish to use
//e.g. node createUsers.js mongo
//e.g. node createUsers.js mysql
require('./seeds.js');
var mongoClient = require('mongodb').MongoClient;
var mysql      = require('mysql');
var insertInterval = 2;
var connection;

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
    if (process.argv[2]!="mongo") { //open a mysql connection
        connection = mysql.createConnection({
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
        setInterval(insertUser,insertInterval)
    }
    else {
        var mongoUrl = "mongodb://localhost:27017/steppingup";
        mongoClient.connect(mongoUrl, function (err, db) {
            if(err)  {
                throw err;
            }
            else {
                console.log('Connected to Mongo Successfully' );
            }
            setInterval( function() { insertUserMongo(db); }, insertInterval );
            //setInterval(insertUserMongo,insertInterval)
        });
        
    }
}

function insertUser() {
    var sql = 'INSERT INTO users (username, password, fName, lName, address, city, state, pCode, gender, birthDate, height, weight, occupation, admin) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
    var user = buildUser(false);

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

function insertUserMongo(db) {
    db.collection('users', function (err, collection) {
        var user = buildUser(true);
       // collection.insert(user);
        collection.find({username:user.username}).count(function (err, count) {
            if (count==0) {
                collection.insert(user, function(){
                    console.log('Insert Completed for ' + user.username);
                });                
            }
            else {
                console.log('User ' + user.username + ' already exists, skipping.');
            }
        });
    });
}

function buildUser(asJson) {
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
    if (asJson) {
        //username, password, fName, lName, address, city, state, pCode, gender, birthDate, height, weight, occupation, admin
        return {
            username: username, 
            password:'$2y$10$/iPtHOrDck.BEEPjcAbNQ.YmKlfddJeKmEnGE69QtVa',
            fName:first,
            lName:last,
            address:address,
            city:city,
            state:state,
            pCode:zip,
            gender:gender,
            birthDate:bDate,
            height:height,
            weight:weight,
            occupation:occupation,
            admin:0,
            heartrates:[],
            steps:[]
        }
    }
    return [username,'pw123',first,last,address,city,state,zip,gender,bDate, height, weight,occupation,0];  
}
insertRandomUsers();