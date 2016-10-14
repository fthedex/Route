--NOTES:

--IDENTITY:
--first value is the start value
--second value is the increment value



--Account info (Lock-up table)
-- 1:Driver, 2:Parent, 3:Student
CREATE TABLE accountInfo
(
	accountInfoID INT PRIMARY KEY,
	accountType VARCHAR(15) NULL
)

--Gender table (Lock-up table)
--1:Male, 2:Female
CREATE TABLE gender
(
	genderID INT PRIMARY KEY,
	genderType VARCHAR(15) NULL
)

--Grade table (Lock-up table)
--1:first grade, ...
CREATE TABLE grade
(
	gradeID INT PRIMARY KEY,
	gradeName VARCHAR(15) NULL
)

--Line table (Lock-up table)
--1: Madina line, ...
CREATE TABLE line
(
	lineID INT PRIMARY KEY,
	lineName VARCHAR(25) NULL
)

--Bus table
--starts from 1
CREATE TABLE bus
(
	busID INT PRIMARY KEY IDENTITY(1, 1),
	busModel VARCHAR(25) NULL,
	busModelYear DATETIME NULL,
	busCapacity INT NULL,
	busIdleTime DATETIME NULL
)

--Driver table
--starts from 101
--DoB: Date of Birth
CREATE TABLE driver
(
	driverID INT PRIMARY KEY IDENTITY(101, 1),
	driverPassword VARCHAR(255) NOT NULL,
	driverFirstName VARCHAR(25) NULL,
	driverLastName VARCHAR(25) NULL,
	driverGender INT FOREIGN KEY REFERENCES gender(genderID) ON UPDATE CASCADE ON DELETE SET NULL,
	driverDoB DATETIME NULL,
	driverNumber VARCHAR(25) NOT NULL,
	driverBusID INT FOREIGN KEY REFERENCES bus(busID) ON UPDATE CASCADE ON DELETE SET NULL,
	driverAddress VARCHAR(50) NULL,
	driverLineID INT FOREIGN KEY REFERENCES line(lineID) ON UPDATE CASCADE ON DELETE SET NULL
)

--Hotspot table
--Starts from 1001
--Like pokestops in Pokemon GO
--Are the points where student will wait
CREATE TABLE hotspot
(
	hotspotID INT PRIMARY KEY IDENTITY(1001,1),
	lineID INT FOREIGN KEY REFERENCES line(lineID),
	long DECIMAL(10, 6),
	lati DECIMAL(10, 6)
)

--Round table
--Starts from 10001
--Round is the jawla for example jawlit el 2 PM, jawlit el 7 AM
CREATE TABLE busRound
(
	roundID INT PRIMARY KEY IDENTITY(10001, 1), 
	busID INT FOREIGN KEY REFERENCES bus(busID) ON UPDATE CASCADE ON DELETE SET NULL,
	lineID INT FOREIGN KEY REFERENCES line(lineID) ON UPDATE CASCADE ON DELETE SET NULL,
	startTime DATETIME,
	finishTime DATETIME
)

--busRoundTime table (lock-up table)
--EAT: Estimated Arrival Time
CREATE TABLE busRoundTime
(
	roundID INT FOREIGN KEY REFERENCES busRound(roundID) ON UPDATE CASCADE,
	hotspotID INT FOREIGN KEY REFERENCES hotspot(hotspotID) ON UPDATE CASCADE,
	EAT DATETIME,
	primary key(roundID, hotspotID)
)

--busRoundHistory table (data taken from log file?)
--EAT: Estimated Arrival Time
--AA:  Actual Arrival Time
CREATE TABLE busRoundHistory
(
	roundID INT FOREIGN KEY REFERENCES busRound(roundID) ON UPDATE CASCADE,
	hotspotID INT FOREIGN KEY REFERENCES hotspot(hotspotID) ON UPDATE CASCADE,
	EAT DATETIME,
	AAT DATETIME,
	primary key(roundID, hotspotID)
)

--Parent table
--Starts from 2016001
CREATE TABLE parent
(
	parentID INT PRIMARY KEY IDENTITY(2016001, 1),
	parentPassword VARCHAR(255) NOT NULL,
	parentFirstName VARCHAR(15) NULL,
	parentLastName VARCHAR(15) NULL,
	parentDoB DATETIME NULL,
	parentGender INT FOREIGN KEY REFERENCES gender(genderID) ON UPDATE CASCADE ON DELETE SET NULL,
	parentNumber VARCHAR(25) NOT NULL,
	parentAddress VARCHAR(50) NULL
)

--Student table
--starts from 20160001
CREATE TABLE student
(
	studentID INT PRIMARY KEY IDENTITY(20160001, 1),
	studentPassword VARCHAR(255) NOT NULL,
	studentParent INT FOREIGN KEY REFERENCES parent(parentID),
	studentFirstName VARCHAR(15) NULL,
	studentLastName VARCHAR(15) NULL,
	studentGender INT FOREIGN KEY REFERENCES gender(genderID) ON UPDATE CASCADE ,
	studentDoB DATETIME NULL,
	studentGrade INT FOREIGN KEY REFERENCES grade(gradeID) ON UPDATE CASCADE,
	studentRound INT FOREIGN KEY REFERENCES busRound(roundID) ON UPDATE CASCADE
)
