DELIMITER //

CREATE FUNCTION errorCodes
(
p_error int
) 
RETURNS varchar(50) CHARSET latin1
BEGIN
	declare v_error varchar(50);
    IF p_error = 0 THEN SET v_error = 'Code (0) handled in catch block';
    ELSEIF p_error = 1 THEN SET v_error = 'Code (1) Success';
    ELSEIF p_error = 2 THEN SET v_error = 'Code (2) Record not found, Cannot update';
    ELSEIF p_error = 3 THEN SET v_error = 'Code (3) Record not found, Cannot delete';
    ELSEIF p_error = 10 THEN SET v_error = 'Code (10) record already exists';
    END IF;
    
    RETURN v_error;
END//
DELIMITER ;
