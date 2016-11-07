DELIMITER //

create procedure createParent
(
    p_FN varchar(25),
    p_LN varchar(25),
    p_gender varchar(1),
    p_DoB varchar(11),
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
			values(null, 2, p_FN, p_LN, p_gender, STR_TO_DATE(p_DoB, '%d-%m-%y'), p_parentNumber, p_parentAddress);
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

create procedure deleteParent
(
	in p_parentID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from parent where parentID = p_parentID)
        then
			delete from parent
            where parentID = p_parentID;
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

create procedure updateParent
(
    p_parentID int,
    p_number varchar(25),
    p_address varchar(50),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from parent where parentID = p_parentID)
        then
			update parent
			set parentNumber = ifnull(p_number, parentNumber),
				parentAddress = ifnull(p_address, parentAddress)
			where parentID = p_parentID;
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

create procedure retrieveParent
(
	p_parentID int
)
begin
	select parentID AS 'Parent_ID',
		   accountType AS 'Account_Type',
           parentFN AS 'First_Name',
           parentLN AS 'Last_Name',
           parentGender AS 'Gender',
           parentNumber AS 'Parent_Number',
           parentAddress AS 'Parent_Address'
	from parent
    where parentID = ifnull(p_parentID, parentID);
		  
end//

DELIMITER ;
