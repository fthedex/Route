DELIMITER //

create procedure createline
(
    p_lineName varchar(25),
    p_lineDesc varchar(50),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from line where lineID = last_insert_id()+1)
        then
			insert into line(lineID, lineName, lineDesc)
            values(null, p_lineName, p_lineDesc);
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

create procedure retrieveLine
(
	p_LineID int,
    p_lineName varchar(25)
)
begin
	select lineID as 'Line_ID',
		   lineName as 'line_Name',
           lineDesc as 'Line_Desc'
	from line
    where ifnull(p_lineID, lineID) = lineID
		  AND ifnull(p_lineName, lineName) = lineName;
end//

DELIMITER ;





DELIMITER //

create procedure deleteLine
(
	in p_lineID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from line where lineID = p_lineID)
        then
			delete from line
            where lineID = p_lineID;
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

create procedure updateLine
(
	p_lineID int,
    p_lineName varchar(25),
    p_lineDesc varchar(50),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from line where lineID = p_lineID)
        then
			update line
            set lineName = ifnull(p_lineName, lineName)
				AND lineDesc = ifnull(p_lineDesc, lineDesc)
            where lineID = p_lineID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end//

DELIMITER ;


