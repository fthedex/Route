DELIMITER //

create procedure createDriver
(
    p_FN varchar(25),
    p_LN varchar(25),
    p_gender varchar(1),
    p_DoB varchar(11),
    p_number varchar(25),
    p_busID int,
    p_address varchar(50),
    p_lineID int,
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
				if exists(select 1 from line where lineID = p_lineID)
                then
					insert into driver(driverID, accountType, driverFN, driverLN, driverGender, driverDoB, driverNumber, driverBusID, driverAddress, driverlineID)
					values(null, 1, p_FN, p_LN, p_gender, STR_TO_DATE(p_DoB, '%d-%m-%y'), p_number, p_busID, p_address, p_lineID);
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
end//

DELIMITER ;


DELIMITER //

create procedure updateDriver
(
	p_driverID int,
    p_number varchar(25),
    p_busID int,
    p_lineID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from driver where driverID = p_driverID)
        then
			if exists(select 1 from bus where busID = p_busID)
            then
				if exists(select 1 from line where lineID = p_lineID)
                then
					update driver
                    set driverNumber = ifnull(p_number, driverNumber),
						driverBusID = ifnull(p_busID, driverBusID),
                        driverlineID = ifnull(p_lineID, driverlineID)
					where driverID = p_driverID;
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
end//

DELIMITER ;



DELIMITER //


create procedure deleteDriver
(
	in p_driverID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from driver where driverID = p_driverID)
        then
			delete from driver
            where driverID = p_driverID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end//

DELIMITER ;

DELIMITER //

create procedure retrieveDriver
(
	p_driverID int
)
begin
	select driverID AS 'Driver_ID',
		   accountType AS 'Account_Type',
           driverFN AS 'First_Name',
           driverLN AS 'Last_Name',
           driverGender AS 'Driver_Gender',
           driverDoB AS 'Driver_DoB',
           driverNumber AS 'Driver_Number',
           driverBusID AS 'Bus_ID',
           ddriverAddress AS 'Driver_Address',
           driverlineID AS 'Line_ID'
	from driver
    where driverID = ifnull(p_driverID, driverID);
		  
end//

DELIMITER ;
