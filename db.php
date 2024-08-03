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
  Comments LONGTEXT NULL,
  Rating VARCHAR(100),
  ProfileImage VARCHAR(255) NULL,
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
  ProfileImage VARCHAR(255) NULL,
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

// mysqli_query($conn, "INSERT INTO tblUser (FirstName, LastName, Contact, Email, Password, Gender, Profession, Comments, Rating) VALUES
//     ('Aneri', 'Patel', '9876543210', 'aneri.patel@example.com', '123456', 'Female', 'Software Engineer', 'It has been more than a couple of weeks since I started my Shoulder (AC Joint) & Back Injury recovery with FlexifyMe. Dr. Poonam expertise is visible with the way she systematically adjusts the session resulting in noticeable improvements in my movements compared to just a few weeks ago. Dr. Poonam ensures that not just during the session but I am consistent with the required exercises every day. Initially I was skeptical on how Flexifyme can help in my recovery with just online Zoom Sessions, but to my surprise I am really happy with my journey till now. Kudos to Dr. Poonam & Flexifyme\'s team members', 'Good'),
//     ('Rohan', 'Mehta', '8765432109', 'rohan.mehta@example.com', '123456', 'Male', 'Data Analyst', 'I am a sportsperson and I represent my company in cricket as a bowler. But since last 1 year, I was facing extreme pain in my left shoulder which due to bowling movement later started showing up in right shoulder as well. I also was suffering from thigh pain radiating to my leg due to playing football. I tried different treatments in past, including acupuncture and physiotherapy, but I could not find much comfort. These pains were really affecting my performance and I had to put my passion for sports on hold. Recently only I came across FlexifyMe, and though I had my own inhibitions about Online Physiotherapy, they were able to win my confidence over the first free Assessment session. Going through the thorough evaluation, I decided to enroll with the basic plan and to my surprise just 7 sessions in the plan and I already see a great improvement in my shoulder pain. I feel 70% recovered already. I am seeing noticeable difference in the mobility and strength in the muscles in the affected part. Also my leg pain has started to improve. At FlexifyMe, I have full control over choosing my desired schedule for the sessions without worrying of traffic jams, reaching late for my appointments or any hassles of visiting time and again for followups. They have all the solutions under one roof. I am much positive about recovering completely from my pains in another few sessions', 'Excellent'),
//     ('Neha', 'Sharma', '7654321098', 'neha.sharma@example.com', '123456', 'Female', 'Project Manager', 'I started with Flexify in March 2024 & the results are wonderful. I had lower back pain & a disc bulge due to which my pain was radiating to my legs and I was unable to stand for 2 minutes. I have tried everything from Allopathy, ayurvedic, naturopathy, homeopathy. With the help of Flexify I have recovered from the lower back pain, there is no more radiating pain to my legs and now I can stand without any pain. This journey of commitment & health transformation with Flexify is excellent. I recommend everyone looking for life changing experience to start their journey with them', 'Excellent')");
echo "<script>alert('Data inserted Successfully!')</script>";

}

?>