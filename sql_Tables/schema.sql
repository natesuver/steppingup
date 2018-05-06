CREATE DATABASE IF NOT EXISTS steppingup DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE steppingup;

CREATE TABLE heartrates (
  id int(11) NOT NULL,
  username varchar(255) NOT NULL,
  activityDate datetime NOT NULL,
  heartRate int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE steps (
  id int(11) NOT NULL,
  username varchar(255) NOT NULL,
  startDate datetime NOT NULL,
  endDate datetime NOT NULL,
  stepsTaken int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----
CREATE TABLE users (
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  fName varchar(30) NOT NULL,
  lName varchar(30) DEFAULT NULL,
  address varchar(50) DEFAULT NULL,
  city varchar(50) DEFAULT NULL,
  state varchar(50) NOT NULL,
  pCode varchar(5) DEFAULT NULL,
  gender varchar(6) NOT NULL,
  birthDate date NOT NULL,
  height int(11) DEFAULT NULL,
  weight int(11) DEFAULT NULL,
  occupation varchar(100) NOT NULL,
  admin bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE heartrates
  ADD PRIMARY KEY (id),
  ADD KEY idx_hr_activityDate (activityDate),
  ADD KEY idx_hr_username (username);

ALTER TABLE steps
  ADD PRIMARY KEY (id),
  ADD KEY idx_step_startDate (startDate),
  ADD KEY idx_step_username (username);

ALTER TABLE users
  ADD PRIMARY KEY (username),
  ADD KEY idx_first_name (fName),
  ADD KEY idx_last_name (lName);

ALTER TABLE heartrates
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260600;

ALTER TABLE steps
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260466;

ALTER TABLE heartrates
  ADD CONSTRAINT heartrates_ibfk_1 FOREIGN KEY (username) REFERENCES users (username);

ALTER TABLE steps
  ADD CONSTRAINT steps_ibfk_1 FOREIGN KEY (username) REFERENCES users (username);
