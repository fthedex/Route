DELIMITER //

create procedure createStudent
(
    p_FN varchar(25),
    p_LN varchar(25),
    p_gender varchar(1),
    p_DoB varchar(11),
    p_grade varchar(2),
    p_busID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from student where studentID = last_insert_id()+1)
        then
			if exists(select 1 from bus where busID = p_busID)
            then
				insert into student(studentID, accountType, studentFN, studentLN, studentGender, studentDoB, studentGrade, studentBus)
				values(null, 2, p_FN, p_LN, p_gender, STR_TO_DATE(p_DoB, '%d-%m-%y'), p_grade, p_busID);
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
end//

DELIMITER ;


DELIMITER //

create procedure deleteStudent
(
	in p_studentID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from student where studentID = p_studentID)
        then
			delete from student
            where studentID = p_studentID;
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

create procedure updateStudent
(
    p_studentID int,
    p_grade varchar(2),
    p_busID int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from student where studentID = p_studentID)
        then
			if exists(select 1 from bus where busID = p_busID)
            then
				update student
                set studentGrade = ifnull(p_grade, studentGrade),
					studentBus = ifnull(p_busID, studentBus)
				where studentID = p_studentID;
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
end//

DELIMITER ;


DELIMITER //

create procedure retrieveStudent
(
	p_studentID int
)
begin
	select studentID AS 'student_ID',
		   accountType AS 'Account_Type',
           studentFN AS 'First_Name',
           studentLN AS 'Last_Name',
           studentGender AS 'student_Gender',
           studentDoB AS 'student_DoB',
           studentGrade AS 'student_grade',
           studentBus AS 'Bus_ID'
	from student
    where studentID = ifnull(p_studentID, studentID);
		  
end//

DELIMITER ;
