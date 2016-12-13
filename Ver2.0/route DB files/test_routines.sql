CREATE DATABASE  IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `test`;
-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping events for database 'test'
--

--
-- Dumping routines for database 'test'
--
/*!50003 DROP FUNCTION IF EXISTS `errorCodes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `errorCodes`(`p_error` INT) RETURNS varchar(50) CHARSET latin1
BEGIN
	declare v_error varchar(50);
    IF p_error = 0 THEN SET v_error = 'Code (0) handled in catch block';
    ELSEIF p_error = 1 THEN SET v_error = 'Code(1): Success';
    ELSEIF p_error = 2 THEN SET v_error = 'Code(2): Record not found, Cannot update';
    ELSEIF p_error = 3 THEN SET v_error = 'Code(3): Record not found, Cannot delete';
    ELSEIF p_error = 4 THEN SET v_error = 'Code(4): Record does not exist';
    ELSEIF p_error = 5 THEN SET v_error = 'Code(5): Account type not valid';
    ELSEIF p_error = 6 THEN SET v_error = 'Code(6): Password must be more than 50 character';
    ELSEIF p_error = 10 THEN SET v_error = 'Code(10): record already exists';
    END IF;
    RETURN v_error;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createAccountInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createAccountInfo`(
	in p_accountID int,
    in p_accountType int,
    in p_accountPassword varchar(65),
    in p_salt varchar(65),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if length(p_accountPassword) < 6
        then
			set p_output = 6;
            rollback;
		else
			if not exists(select 1 from accountinfo where accountInfoID = p_accountID)
			then
				if p_accountType = 1
				then
					if exists(select 1 from driver where driverID = p_accountID)
					then
						insert into accountinfo(accountInfoID, accountType, accountSalt, accountPassword)
						values(p_accountID, p_accountType, p_salt, p_accountPassword);
						set p_output = 1;
						commit;
					else
						set p_output = 4;
						rollback;
					end if;
				elseif p_accountType = 2
				then
					if exists(select 1 from parent where parentID = p_accountID)
					then
						insert into accountinfo(accountInfoID, accountType, accountSalt, accountPassword)
						values(p_accountID, p_accountType, p_salt, p_accountPassword);
						set p_output = 1;
						commit;
					else
						set p_output = 4;
						rollback;
					end if;
				elseif p_accountType = 3
				then
					if exists(select 1 from student where studentID = p_accountID)
					then
						insert into accountinfo(accountInfoID, accountType, accountSalt, accountPassword)
						values(p_accountID, p_accountType, p_salt, p_accountPassword);
						set p_output = 1;
						commit;
					else
						set p_output = 4;
						rollback;
					end if;
				elseif p_accountType = 4
                then
					if exists(select 1 from admin where adminID = p_accountID)
                    then
						insert into accountinfo(accountInfoID, accountType, accountSalt, accountPassword)
						values(p_accountID, p_accountType, p_salt, p_accountPassword);
						set p_output = 1;
						commit;
                    else
						set p_output = 4;
						rollback;
                    end if;
				else
					set p_output = 5;
					rollback;
				end if;
			else
				set p_output = 10;
				rollback;
			end if;
        end if;
        set p_output = errorCodes(p_output);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createBus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createBus`(
    p_busModel varchar(25),
    p_busModelYear varchar(30),
    p_busCapacity int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select busID from bus where busID = last_insert_id()+1)
        then
			insert into bus(busID, busModel, busModelYear, busCapacity)
            values(null, p_busModel, p_busModelYear, p_busCapacity);
            set p_output = 1;
            commit;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createDriver` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createDriver`(
    p_FN varchar(25),
    p_LN varchar(25),
    p_gender varchar(1),
    p_DoB varchar(30),
    p_number varchar(25),
    p_busID int(11),
    p_address varchar(50),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from driver where driverID = last_insert_id()+1)
        then
			if exists(select 1 from bus where busID = p_busID)
            then
				insert into driver(driverID, accountType, driverFN, driverLN, driverGender, driverDoB, driverNumber, driverBusID, driverAddress)
				values(null, 1, p_FN, p_LN, p_gender, p_DoB, p_number, p_busID, p_address);
				set p_output = 1;
				commit;
            else
				set p_output = 4;
				rollback;
            end if;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createParent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createParent`(
    p_FN varchar(25),
    p_LN varchar(25),
    p_gender varchar(1),
    p_DoB varchar(30),
	p_parentNumber varchar(25),
    p_parentAddress varchar(50),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from parent where parentID = last_insert_id()+1)
        then
			insert into parent(parentID, accountType, parentFN, parentLN, parentGender, parentDoB, parentNumber, parentAddress)
			values(null, 2, p_FN, p_LN, p_gender, p_DoB, p_parentNumber, p_parentAddress);
			set p_output = 1;
			commit;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createStudent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createStudent`(
    p_FN varchar(25),
    p_LN varchar(25),
    p_gender varchar(1),
    p_DoB varchar(30),
    p_grade varchar(2),
    p_busID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from bus where busID = p_busID)
            then
				insert into student(studentID, accountType, studentFN, studentLN, studentGender, studentDoB, studentGrade, studentBus)
				values(null, 3, p_FN, p_LN, p_gender, p_DoB, p_grade, p_busID);
				set p_output = 1;
				commit;
            else
				set p_output = 4;
				rollback;
            end if;
        set p_output = errorCodes(p_output);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createStudentAwaiting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createStudentAwaiting`(
	in p_busID int,
    in p_studentID int,
    in p_Long double,
    in p_Lati double,
    out p_output varchar(50)
)
BEGIN
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from bus where busID = p_busID)
            then
				if exists(select 1 from student where studentID = p_studentID)
                then
					if not exists(select 1 from studentsawaitinglist where studentID = p_studentID)
                    then
						insert into studentsawaitinglist(busID, studentID, studentLong, studentLati)
						values(p_busID, p_studentID, p_Long, p_Lati);
						set p_output = 1;
						commit;
                    else
						set p_output = 10;
						rollback;
                    end if;
                else
					set p_output = 4;
					rollback;
                end if;
            else
				set p_output = 4;
				rollback;
            end if;
        set p_output = errorCodes(p_output);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createStudentParent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createStudentParent`(
	in p_studentID int, 
    in p_parentID int,
    out  p_output varchar(50)
)
BEGIN
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from studentparent where studentID = p_studentID AND parentID = p_parentID)
        then
			if exists(select 1 from student where studentID = p_studentID)
            then
				if exists(select 1 from parent where parentID = p_parentID)
                then
					insert into studentparent(studentID, parentID)
					values(p_studentID, p_parentID);
					set p_output = 1;
					commit;
                else
					set p_output = 4;
					rollback;
                end if;
            else
				set p_output = 4;
				rollback;
            end if;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createStudentTaken` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createStudentTaken`(
	in p_busID int,
    in p_studentID int,
    out p_output varchar(50)
)
BEGIN
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from bus where busID = p_busID)
            then
				if exists(select 1 from student where studentID = p_studentID)
                then
					if not exists(select 1 from takenstudentslist where studentID = p_studentID)
                    then
						insert into takenstudentslist(busID, studentID)
						values(p_busID, p_studentID);
						set p_output = 1;
						commit;
                    else
						set p_output = 10;
						rollback;
                    end if;
                else
					set p_output = 4;
					rollback;
                end if;
            else
				set p_output = 4;
				rollback;
            end if;
        set p_output = errorCodes(p_output);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `retrieveBus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `retrieveBus`(IN `p_busID` INT)
begin
select busID as 'Bus_ID',
       busModel as 'Bus_Model',
           busModelYear as 'Bus_Model_Year',
           busCapacity as 'Bus_Capacity',
           busIdleTime as 'Bus_Idle_Time'
from bus
    where ifnull(p_busID, busID) = busID;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `retrieveUpdateBusLocation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `retrieveUpdateBusLocation`(IN `p_busID` INT)
begin
select busID as 'Bus_ID',
       busLong as 'Bus_Longitude',
           busLati as 'Bus_Latitude'
from updateBusLocation
    where ifnull(p_busID, busID) = busID;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-13 23:33:28
