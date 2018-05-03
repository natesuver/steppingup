//Generate random step and heartrate data for random users, for mongo.  you can optionally pass in a particular username as a single argument, and all steps and heartrates will be associated to that user.
//e.g. node telemetry-nosql.js
//e.g. node telemetry-nosql.js "bill_jones"

var mongoClient = require('mongodb').MongoClient;

var insertInterval = 1000; //the amount of time,in ms, between inserts of new telemetry.
mongoClient.connect("mongodb://localhost:27017/steppingup", function (err, db) {
    
     if(err)  {
         throw err;
     }
     else {
        console.log('Connected to Mongo Successfully' );
     }
     getUsernames(db); //obtain list of usernames, and then execute intervals for both heartrates and steps
    
                
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

function insertHeartrate(db) {
    var username = global.usernames[getRandomInteger(0,global.usernames.length-1)];
    if (process.argv[2]) {
        username = process.argv[2];
    }
    var rateEntry = {activityDate:formatNow(),heartRate:getRandomInteger(60,130)};
    db.collection('users', function (err, collection) {
        collection.update({username:username},{
            $addToSet: {
              heartrates : rateEntry
            }
           }, function(err, res) {
            if (err) throw err;
            console.log('MONGO: Heart rate recorded for ' + username + ': ' + rateEntry.heartRate + ' bpm' );
          });        
    });
}

function insertStep(db) {
    var username = global.usernames[getRandomInteger(0,global.usernames.length-1)];
    if (process.argv[2]) {
        username = process.argv[2];
    }
    var entry = {startDate:formatNow(),endDate: formatOneMinuteAgo(), stepsTaken:getRandomInteger(5,100)};
    db.collection('users', function (err, collection) {
        collection.update({username:username},{
            $addToSet: {
              steps : entry
            }
           }, function(err, res) {
            if (err) throw err;
            console.log('Steps recorded for ' + username + ': ' + entry.stepsTaken + ' steps' );
          });        
    });
}

function getUsernames(db) {
    db.collection('users', function (err, collection) {
        collection.find({},{username:1}).toArray(function(err, items) {
            if(err) throw err;
            var array_result = [];
            for (var i=0;i<items.length;i++) {
                array_result.push(items[i].username);
            }
            global.usernames = array_result;    
            setInterval(function() {insertHeartrate(db)},insertInterval); //start the interval timer for heartrate inserts
            setInterval(function() {insertStep(db)},insertInterval); //start the interval timer for step inserts   
        });
        
    });
}
