
DELIMITER //

create procedure createUpdateBusLocation
(
    p_busID int,
    p_busLong double,
    p_busLati double,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from bus where busID = p_busID)
        then
			if not exists(select 1 from updateBusLocation where busID = p_busID)
            then
            insert into bsCurrentLocation(busID, busLong, busLati)
			values(p_busID, p_busLong, p_busLati);
            set p_output = 1;
            commit;
            end if;
        else
			set p_output = 10;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end//

DELIMITER ;

DELIMITER //

create procedure updateUpdateBusLocation
(
	p_busID int,
    p_busLong double,
    p_busLati double,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from updateBusLocation where busID = p_busID)
        then
			update updateBusLocation
            set busLong = ifnull(p_busLong, busLong),
				busLati = ifnull(p_busLati, busLati)
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

create procedure deleteUpdateBusLocation
(
	in p_busID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from updateBusLocation where busID = p_busID)
        then
			delete from updateBusLocation
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

create procedure retrieveBusLocationAll
(
	p_busID int
)
begin
	select busID as 'Bus_ID',
	       busLang as 'Bus_Lang',
           busLati as 'Bus_Lati'
	from updateBusLocation
    where ifnull(p_busID, busID) = busID;
    
end//

DELIMITER ;



DELIMITER //

create procedure retrieveBusLocationStudent
(
	p_studentID int
)
begin
	select busID as 'Bus_ID',
	       busLang as 'Bus_Lang',
           busLati as 'Bus_Lati'
	from updateBusLocation
    inner join student
    on p_studentID = studentID 
    where ifnull(student.studentBus, updateBusLocation.busID) = updateBusLocation.busID;
    
end//

DELIMITER ;


DELIMITER //

create procedure retrieveBusLocationParent
(
	p_parentID int
)
begin
	select busID as 'Bus_ID',
	       busLang as 'Bus_Lang',
           busLati as 'Bus_Lati'
	from updateBusLocation b
    inner join studentParent p
    on parentID = p_parentID
    inner join student s
    on p.studentID = s.studentID
    where ifnull(s.studentBus, b.BusID) = b.busID; 
end//

DELIMITER ;
