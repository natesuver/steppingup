Create database SteppingUp;

use SteppingUp;

create table users (
	username varchar(255) not null,
	password varchar(255) not null,
	fName varchar(30) not null,
	lName varchar(30),
	address varchar(50),
	city varchar(50),
	state varchar(50) not null,
	pCode varchar(5),
	gender varchar(6) not null,
	birthDate date not null,
	height int,
	weight int,
	occupation varchar(100) not null,
	admin bit NOT NULL DEFAULT 0,
	primary key (username)
);

create table heartrates (
	id int NOT NULL AUTO_INCREMENT,
	username varchar(255) not null,
	activityDate datetime not null,
	heartRate int NOT NULL,
	primary key (id),
	foreign key (username) references users(username)
);

create table steps (
	id int NOT NULL AUTO_INCREMENT,
	username varchar(255) not null,
	startDate datetime not null,
	endDate datetime not null,
	stepsTaken int not null,
	primary key (id),
	foreign key (username) references users(username)
);
