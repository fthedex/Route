-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2016 at 07:33 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `createAccountInfo` (IN `p_accountID` INT, IN `p_accountPassword` VARCHAR(255), IN `p_accountType` INT, OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from accountInfo where accountInfoID = p_accountID)
        then
			insert into accountInfo(accountInfoID, accountPassword, accountType)
            values(p_accountID, p_accountPassword, p_accountType);
            set p_output = 1;
            commit;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `createBus` (`p_busID` INT, `p_busModel` VARCHAR(25), `p_busModelYear` DATE, `p_busCapacity` INT, `p_busIdleTime` TIME, OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from bus where busID = p_busID)
        then
			insert into bus(busID, busModel, busModelYear, busCapacity, busIdleTime)
            values(p_busID, p_busModel, p_busModelYear, p_busCapacity, p_busIdleTime);
            set p_output = 1;
            commit;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `createUpdateBusLocation` (`p_busID` INT, `p_busLong` FLOAT(10,6), `p_busLati` FLOAT(10,6), OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from updateBusLocation where busID = p_busID)
        then
			insert into busID(busID, busLong, busLati)
            values(p_busID,  p_busLong, p_busLati);
            set p_output = 1;
            commit;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteAccountInfo` (IN `p_accountID` INT, OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from accountInfo where accountInfoID = p_accountID)
        then
			delete from accountInfo
            where accountInfoID = p_accountInfo;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteBus` (IN `p_busID` INT, OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from busID where busID = p_busID)
        then
			delete from busID
            where busID = p_busID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUpdateBusLocation` (IN `p_busID` INT, OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from updateBusLocation where busID = p_busID)
        then
			delete from busID
            where busID = p_busID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `retrieveAccountInfo` (IN `p_accountID` INT, IN `p_accountType` INT)  begin
	select accountInfoID as 'account_ID',
		   accountType as 'account_type'
	from accountInfo
    where ifnull(p_accountID, accountInfoID) = accountInfoID AND ifnull(p_accountType, accountType) = accountType
    ;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `retrieveBus` (IN `p_busID` INT)  begin
	select busID as 'Bus_ID',
	       busModel as 'Bus_Model',
           busModelYear as 'Bus_Model_Year',
           busCapacity as 'Bus_Capacity',
           busIdleTime as 'Bus_Idle_Time'
	from bus
    where ifnull(p_busID, busID) = busID;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `retrieveUpdateBusLocation` (IN `p_busID` INT)  begin
	select busID as 'Bus_ID',
	       busLong as 'Bus_Longitude',
           busLati as 'Bus_Latitude'
	from updateBusLocation
    where ifnull(p_busID, busID) = busID;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAccountInfo` (IN `p_accountID` INT, IN `p_accountPassword` VARCHAR(255), OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from accountInfo where accountInfoID = p_accountID)
        then
			update accountInfo
            set accountPassword = p_accountPassword
            where accountInfoID = p_accountID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateBus` (`p_busID` INT, `p_busIdleTime` TIME, OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from bus where busID = p_busID)
        then
			update bus
            set busIdleTime = p_busIdleTime
            where busID = p_busID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUpdateBusLocation` (IN `p_busID` INT, IN `p_busLong` FLOAT(10,6), IN `p_lati` FLOAT(10,6), OUT `p_output` VARCHAR(50))  begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from updateBusLocation where busID = p_busID)
        then
			update updateBusLocation
            set busLong = p_busLong,
		busLati = p_buslati
            where busID = p_busID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `errorCodes` (`p_error` INT) RETURNS VARCHAR(50) CHARSET latin1 BEGIN
declare v_error varchar(50);
    IF p_error = 0 THEN SET v_error = 'Code (0) handled in catch block';
    ELSEIF p_error = 1 THEN SET v_error = 'Code (1) Success';
    ELSEIF p_error = 2 THEN SET v_error = 'Code (2) Record not found, Cannot update';
    ELSEIF p_error = 3 THEN SET v_error = 'Code (3) Record not found, Cannot delete';
    ELSEIF p_error = 10 THEN SET v_error = 'Code (10) record already exists';
    END IF;
    
    RETURN v_error;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accountinfo`
--

CREATE TABLE `accountinfo` (
  `accountInfoID` int(11) NOT NULL,
  `accountPassword` varchar(255) NOT NULL,
  `accountType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountinfo`
--

INSERT INTO `accountinfo` (`accountInfoID`, `accountPassword`, `accountType`) VALUES
(2013, 'blabla', 1),
(220130, 'ohurnioer', 1),
(20010049, '20010049', 2),
(20090049, '20090049', 1),
(20100049, '20100049', 2),
(20130031, 'Thisisapassword', 2),
(20130048, '20130048', 3),
(20130049, '20130049', 3),
(20130050, '20130050', 3),
(20130099, '20130099', 3),
(20130380, 'pass', 1),
(20130389, 'Password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `busID` int(11) NOT NULL,
  `busModel` varchar(25) DEFAULT NULL,
  `busModelYear` date DEFAULT NULL,
  `busCapacity` int(11) DEFAULT NULL,
  `busIdleTime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`busID`, `busModel`, `busModelYear`, `busCapacity`, `busIdleTime`) VALUES
(20130050, 'BMW', '2016-11-18', 30, '2016-11-03'),
(20130051, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `busround`
--

CREATE TABLE `busround` (
  `roundID` int(11) NOT NULL,
  `busID` int(11) DEFAULT NULL,
  `lineID` int(11) DEFAULT NULL,
  `startTime` date DEFAULT NULL,
  `finishTime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `busroundhistory`
--

CREATE TABLE `busroundhistory` (
  `roundID` int(11) NOT NULL,
  `hotspotID` int(11) NOT NULL,
  `roundDate` date DEFAULT NULL,
  `EAT` time DEFAULT NULL,
  `AAT` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `busroundtime`
--

CREATE TABLE `busroundtime` (
  `roundID` int(11) NOT NULL,
  `hotspotID` int(11) NOT NULL,
  `EAT` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverID` int(11) NOT NULL,
  `accountType` int(11) DEFAULT NULL,
  `driverFN` varchar(25) DEFAULT NULL,
  `driverLN` varchar(25) DEFAULT NULL,
  `driverGender` varchar(1) DEFAULT NULL,
  `driverDoB` date DEFAULT NULL,
  `driverNumber` varchar(25) NOT NULL,
  `driverBusID` int(11) DEFAULT NULL,
  `driverAddress` varchar(50) DEFAULT NULL,
  `driverlineID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverID`, `accountType`, `driverFN`, `driverLN`, `driverGender`, `driverDoB`, `driverNumber`, `driverBusID`, `driverAddress`, `driverlineID`) VALUES
(20050049, 1, 'Sa3eed', 'Mas3ood', 'M', NULL, '0789629404', 20130051, 'Bnyat', NULL),
(20090049, 1, 'Abu', 'Ga3ood', NULL, NULL, '0789629404', 20130050, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotspot`
--

CREATE TABLE `hotspot` (
  `hotspotID` int(11) NOT NULL,
  `lineID` int(11) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `line`
--

CREATE TABLE `line` (
  `lineID` int(11) NOT NULL,
  `lineName` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parentID` int(11) NOT NULL,
  `accountType` int(11) DEFAULT NULL,
  `parentFN` varchar(25) DEFAULT NULL,
  `parentLN` varchar(25) DEFAULT NULL,
  `parentDoB` date DEFAULT NULL,
  `parentGender` varchar(1) DEFAULT NULL,
  `parentNumber` varchar(25) DEFAULT NULL,
  `parentAddress` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parentID`, `accountType`, `parentFN`, `parentLN`, `parentDoB`, `parentGender`, `parentNumber`, `parentAddress`) VALUES
(20010049, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(20100049, 2, 'Abu', 'Khalil', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `accountType` int(11) DEFAULT NULL,
  `studentFN` varchar(25) DEFAULT NULL,
  `studentLN` varchar(25) DEFAULT NULL,
  `studentGender` varchar(1) DEFAULT NULL,
  `studentDoB` date DEFAULT NULL,
  `studentGrade` varchar(2) DEFAULT NULL,
  `studentRound` int(11) DEFAULT NULL,
  `tmwBusId` int(255) NOT NULL,
  `studentLong` double NOT NULL,
  `studentLati` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `accountType`, `studentFN`, `studentLN`, `studentGender`, `studentDoB`, `studentGrade`, `studentRound`, `tmwBusId`, `studentLong`, `studentLati`) VALUES
(20130048, 3, NULL, NULL, NULL, NULL, NULL, NULL, 20130050, 38.3265, 33.1452),
(20130049, 3, 'Mohammed', 'Khalil', 'M', '1995-12-16', '12', NULL, 20130050, 35.3254, 31.2546),
(20130050, 3, 'Ayyad', 'Muller', 'M', NULL, NULL, NULL, 20130050, 0, 0),
(99990049, 3, 'Malik', 'Khalil', 'M', NULL, NULL, NULL, 20130051, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentparent`
--

CREATE TABLE `studentparent` (
  `parentID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentparent`
--

INSERT INTO `studentparent` (`parentID`, `studentID`) VALUES
(20010049, 20130048),
(20100049, 20130049),
(20100049, 20130050),
(20100049, 99990049);

-- --------------------------------------------------------

--
-- Table structure for table `studentsawaitinglist`
--

CREATE TABLE `studentsawaitinglist` (
  `busID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `studentLong` double NOT NULL,
  `studentLati` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentsawaitinglist`
--

INSERT INTO `studentsawaitinglist` (`busID`, `studentID`, `studentLong`, `studentLati`) VALUES
(20130050, 20130048, 35.8400952, 31.9805839),
(20130050, 20130049, 35.867201, 31.9744539);

-- --------------------------------------------------------

--
-- Table structure for table `takenstudentslist`
--

CREATE TABLE `takenstudentslist` (
  `busID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `takenstudentslist`
--

INSERT INTO `takenstudentslist` (`busID`, `studentID`) VALUES
(20130051, 99990049);

-- --------------------------------------------------------

--
-- Table structure for table `testupdate`
--

CREATE TABLE `testupdate` (
  `busID` int(11) NOT NULL,
  `busLong` double(50,30) NOT NULL,
  `busLati` double(50,30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testupdate`
--

INSERT INTO `testupdate` (`busID`, `busLong`, `busLati`) VALUES
(1, -32.234400000000000000000000000000, 34.324320000000000000000000000000),
(13, -32432.234400000000000000000000000000, 34.324320000000000000000000000000);

-- --------------------------------------------------------

--
-- Table structure for table `updatebuslocation`
--

CREATE TABLE `updatebuslocation` (
  `busID` int(11) NOT NULL,
  `busLong` double NOT NULL,
  `busLati` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updatebuslocation`
--

INSERT INTO `updatebuslocation` (`busID`, `busLong`, `busLati`) VALUES
(20130050, 35.8456162, 31.9774332),
(20130051, 38.3434, 31.3423);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountinfo`
--
ALTER TABLE `accountinfo`
  ADD PRIMARY KEY (`accountInfoID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`busID`);

--
-- Indexes for table `busround`
--
ALTER TABLE `busround`
  ADD PRIMARY KEY (`roundID`),
  ADD KEY `busID` (`busID`),
  ADD KEY `lineID` (`lineID`);

--
-- Indexes for table `busroundhistory`
--
ALTER TABLE `busroundhistory`
  ADD PRIMARY KEY (`roundID`,`hotspotID`);

--
-- Indexes for table `busroundtime`
--
ALTER TABLE `busroundtime`
  ADD PRIMARY KEY (`roundID`,`hotspotID`),
  ADD KEY `hotspotID` (`hotspotID`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverID`),
  ADD KEY `driverBusID` (`driverBusID`),
  ADD KEY `driverlineID` (`driverlineID`);

--
-- Indexes for table `hotspot`
--
ALTER TABLE `hotspot`
  ADD PRIMARY KEY (`hotspotID`),
  ADD KEY `lineID` (`lineID`);

--
-- Indexes for table `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`lineID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `studentRound` (`studentRound`);

--
-- Indexes for table `studentparent`
--
ALTER TABLE `studentparent`
  ADD PRIMARY KEY (`parentID`,`studentID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `studentsawaitinglist`
--
ALTER TABLE `studentsawaitinglist`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `takenstudentslist`
--
ALTER TABLE `takenstudentslist`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `testupdate`
--
ALTER TABLE `testupdate`
  ADD PRIMARY KEY (`busID`);

--
-- Indexes for table `updatebuslocation`
--
ALTER TABLE `updatebuslocation`
  ADD PRIMARY KEY (`busID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `busID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20130052;
--
-- AUTO_INCREMENT for table `busround`
--
ALTER TABLE `busround`
  MODIFY `roundID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20090050;
--
-- AUTO_INCREMENT for table `hotspot`
--
ALTER TABLE `hotspot`
  MODIFY `hotspotID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20100050;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99990050;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `busround`
--
ALTER TABLE `busround`
  ADD CONSTRAINT `busRound_ibfk_1` FOREIGN KEY (`busID`) REFERENCES `bus` (`busID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `busRound_ibfk_2` FOREIGN KEY (`lineID`) REFERENCES `line` (`lineID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `busroundtime`
--
ALTER TABLE `busroundtime`
  ADD CONSTRAINT `busRoundTime_ibfk_1` FOREIGN KEY (`roundID`) REFERENCES `busround` (`roundID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `busRoundTime_ibfk_2` FOREIGN KEY (`hotspotID`) REFERENCES `hotspot` (`hotspotID`) ON UPDATE CASCADE;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`driverBusID`) REFERENCES `bus` (`busID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_ibfk_2` FOREIGN KEY (`driverlineID`) REFERENCES `line` (`lineID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `hotspot`
--
ALTER TABLE `hotspot`
  ADD CONSTRAINT `hotspot_ibfk_1` FOREIGN KEY (`lineID`) REFERENCES `line` (`lineID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`studentRound`) REFERENCES `busround` (`roundID`) ON UPDATE CASCADE;

--
-- Constraints for table `studentparent`
--
ALTER TABLE `studentparent`
  ADD CONSTRAINT `studentParent_ibfk_1` FOREIGN KEY (`parentID`) REFERENCES `parent` (`parentID`),
  ADD CONSTRAINT `studentParent_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `updatebuslocation`
--
ALTER TABLE `updatebuslocation`
  ADD CONSTRAINT `updateBusLocation_ibfk_1` FOREIGN KEY (`busID`) REFERENCES `bus` (`busID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
