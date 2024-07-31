<?php 

$testConnection = mysqli_connect("localhost","root","");

$checkDatabase = mysqli_query($testConnection,"show databases like 'curecornerdb'");

if (mysqli_num_rows($checkDatabase) == 0) {
    mysqli_query($testConnection,"Create database IF NOT EXISTS `curecornerdb`");
    echo "<script>alert('Database Created Successfully!')</script>";
}

$conn = mysqli_connect("localhost","root","","curecornerdb");

$checkTable = mysqli_query($conn,"show tables like 'tbluser'");

if (mysqli_num_rows($checkTable) == 0) {

// Create tblUser
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblUser (
  UserID INT NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(50) NULL,
  LastName VARCHAR(50) NULL,
  Email VARCHAR(50) NULL,
  Password VARCHAR(50) NULL,
  Contact INT NULL,
  Gender VARCHAR(50) NULL,
  Profession VARCHAR(50) NULL,
  PRIMARY KEY (UserID)
) ENGINE=InnoDB");

// Create tblExpert for Expert
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblExpert (
  ExpertID INT NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(50) NULL,
  LastName VARCHAR(50) NULL,
  Contact INT NULL,
  Email VARCHAR(50),
  Password VARCHAR(50),
  Gender VARCHAR(50) NULL,
  Expertise VARCHAR(50) NULL,
  PRIMARY KEY (ExpertID)
) ENGINE=InnoDB");

// Create tblUserProfile
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblUserProfile (
  HealthInfoID INT NOT NULL AUTO_INCREMENT,
  Age INT NULL,
  Profession VARCHAR(45) NULL,
  Height VARCHAR(45) NULL,
  Weight VARCHAR(45) NULL,
  WorkEnvironment VARCHAR(45) NULL,
  WorkType VARCHAR(45) NULL,
  SittingDuration VARCHAR(45) NULL,
  StandingDuration VARCHAR(45) NULL,
  PainArea VARCHAR(45) NULL,
  PainDescription VARCHAR(450) NULL,
  PainIntensity VARCHAR(45) NULL,
  CaloriesIntake VARCHAR(45) NULL,
  CurrentHealthConditions VARCHAR(45) NULL,
  UserID INT NOT NULL,
  PRIMARY KEY (HealthInfoID),
  INDEX fk_tblUserProfile_tblUser_idx (UserID ASC),
  CONSTRAINT fk_tblUserProfile_tblUser
    FOREIGN KEY (UserID)
    REFERENCES tblUser (UserID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB");

// // Create tblReminder
// mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblReminder (
//   ReminderID INT NOT NULL AUTO_INCREMENT,
//   ReminderTime VARCHAR(45) NULL,
//   Frequency VARCHAR(45) NULL,
//   tblUser_UserID INT NOT NULL,
//   PRIMARY KEY (ReminderID),
//   INDEX fk_tblReminder_tblUser1_idx (tblUser_UserID ASC),
//   CONSTRAINT fk_tblReminder_tblUser1
//     FOREIGN KEY (tblUser_UserID)
//     REFERENCES tblUser (UserID)
//     ON DELETE NO ACTION
//     ON UPDATE NO ACTION
// ) ENGINE=InnoDB");

// Create tblConsultation
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblConsultation (
  ConsultationID INT NOT NULL AUTO_INCREMENT,
  ConsultationDate DATE NULL,
  KeyNotes VARCHAR(45) NULL,
  tblUser_UserID INT NOT NULL,
  tblExpert_ExpertID INT NOT NULL,
  PRIMARY KEY (ConsultationID),
  INDEX fk_tblConsultation_tblUser1_idx (tblUser_UserID ASC),
  INDEX fk_tblConsultation_tblExpert1_idx (tblExpert_ExpertID ASC),
  CONSTRAINT fk_tblConsultation_tblUser1
    FOREIGN KEY (tblUser_UserID)
    REFERENCES tblUser (UserID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tblConsultation_tblExpert1
    FOREIGN KEY (tblExpert_ExpertID)
    REFERENCES tblExpert (ExpertID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB");

// Create tblExpertAvailability
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblExpertAvailability (
  AvailabilityID INT NOT NULL AUTO_INCREMENT,
  AvailableDate DATE NULL,
  StartTime VARCHAR(50) NULL,
  EndTime VARCHAR(50) NULL,
  tblExpert_ExpertID INT NOT NULL,
  PRIMARY KEY (AvailabilityID),
  INDEX fk_tblExpertAvailability_tblExpert1_idx (tblExpert_ExpertID ASC),
  CONSTRAINT fk_tblExpertAvailability_tblExpert1
    FOREIGN KEY (tblExpert_ExpertID)
    REFERENCES tblExpert (ExpertID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB");


// Create tblDiet
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblDiet (
  DietID INT NOT NULL AUTO_INCREMENT,
  DietDescription LONGTEXT NULL,
  Meal VARCHAR(45) NULL,
  Period VARCHAR(45) NULL,
  tblUser_UserID INT NOT NULL,
  PRIMARY KEY (DietID),
  INDEX fk_tblDiet_tblUser1_idx (tblUser_UserID ASC),
  CONSTRAINT fk_tblDiet_tblUser1
    FOREIGN KEY (tblUser_UserID)
    REFERENCES tblUser (UserID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB");

// Create tblBookings
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tblBookings (
  BookingID INT NOT NULL AUTO_INCREMENT,
  BookingDate VARCHAR(50) NULL,
  tblExpert_ExpertID INT NOT NULL,
  tblUser_UserID INT NOT NULL,
  BookingTime VARCHAR(50) NULL,
  PRIMARY KEY (BookingID),
  INDEX fk_tblBookings_tblExpert1_idx (tblExpert_ExpertID ASC),
  INDEX fk_tblBookings_tblUser1_idx (tblUser_UserID ASC),
  CONSTRAINT fk_tblBookings_tblExpert1
    FOREIGN KEY (tblExpert_ExpertID)
    REFERENCES tblExpert (ExpertID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tblBookings_tblUser1
    FOREIGN KEY (tblUser_UserID)
    REFERENCES tblUser (UserID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB");
echo "<script>alert('Tables created Successfully!')</script>";

mysqli_query($conn,"INSERT INTO tblExpert (FirstName,LastName,Contact,Email,Password,Gender,Expertise) VALUES
    ('Smeet','Parmar','1234556655','smeet@gmail.com','123456','Male','Knee Specialist'),
    ('Shefali','Patel','1224556655','shefali11@gmail.com','123456','Female','Orthopedic'),
    ('Rahul','Sharma','1234556475','rahul@yahoo.com','123456','Male','Neck')");

mysqli_query($conn, "INSERT INTO tblUser (FirstName, LastName, Contact, Email, Password, Gender, Profession) VALUES
    ('Aneri', 'Patel', '9876543210', 'aneri.patel@example.com', '123456', 'Female', 'Software Engineer'),
    ('Rohan', 'Mehta', '8765432109', 'rohan.mehta@example.com', '123456', 'Male', 'Data Analyst'),
    ('Neha', 'Sharma', '7654321098', 'neha.sharma@example.com', '123456', 'Female', 'Project Manager')");
echo "<script>alert('Data inserted Successfully!')</script>";
}

?>