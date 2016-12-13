DELIMITER //

create procedure createStudentParent
(
    p_parentID int,
    p_studentID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from studentParent where studentID = p_studentID AND parentID = p_parentID)
        then
			if exists(select 1 from student where studentID = p_studentID)
            then
				if exists(select 1 from parent where parentID = p_parentID)
                then
					insert into studentParent (parentID, studentID)
                    values(p_parentID, p_studentID);
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

create procedure deleteStudentParent
(
	p_parentID int,
    p_studentID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from studentParent where studentID = p_studentID AND parentID = p_parentID)
        then
			delete from studentParent
            where studentID = p_studentID AND parentID = p_parentID;
            set p_output = 1;
            commit;
        else
			set p_output = 3;
			rollback;
		end if;
        set p_output = errorCodes(p_output);
end//

DELIMITER ;
