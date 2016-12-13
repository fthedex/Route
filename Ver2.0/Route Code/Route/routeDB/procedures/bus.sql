
DELIMITER //

create procedure createBus
(
    p_busModel varchar(25),
    p_busModelYear varchar(11),
    p_busCapacity int,
    p_busIdleTime varchar(20),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from bus where busID = last_insert_id()+1)
        then
			insert into bus(busID, busModel, busModelYear, busCapacity, busIdleTime)
            values(null, p_busModel, STR_TO_DATE(p_busModelYear, '%d-%m-%y'), p_busCapacity, TIME(p_busIdleTime));
            set p_output = 1;
            commit;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end//

DELIMITER ;



DELIMITER //

create procedure retrieveBus
(
	p_busID int,
    p_Model varchar(25),
    p_ModelYear varchar(11)
)
begin
	select busID as 'Bus_ID',
	       busModel as 'Bus_Model',
           busModelYear as 'Bus_Model_Year',
           busCapacity as 'Bus_Capacity',
           busIdleTime as 'Bus_Idle_Time'
	from bus
    where ifnull(p_busID, busID) = busID
		  AND ifnull(p_Model, busModel) = busModel
          AND ifnull(str_to_date(p_ModelYear, '%d-%m-%y'), busModelYear) = busModelYear;
end//

DELIMITER ;




DELIMITER //

create procedure deleteBus
(
	in p_busID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from bus where busID = p_busID)
        then
			delete from bus
            where busID = p_busID;
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

create procedure updateBus
(
	p_busID int,
    p_busIdleTime varchar(20),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from bus where busID = p_busID)
        then
			update bus
            set busIdleTime = TIME(p_busIdleTime)
            where busID = p_busID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end//

DELIMITER ;

