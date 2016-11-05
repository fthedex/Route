

DELIMITER //

create procedure createAccountInfo
(
	in p_accountID int,
    in p_accountPassword varchar(255),
    in p_accountType int,
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if not exists(select 1 from accountInfo where accountInfoID = p_accountID)
        then
			insert into accountInfo(accountInfoID, accountPassword, accountType)
            values(p_accountID, aes_encrypt(p_accountPassword, 'route2016'), p_accountType);
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

create procedure deleteAccountInfo
(
	in p_accountID int,
    out p_output varchar(50)
)
begin
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
end//

DELIMITER ;


DELIMITER //

create procedure updateAccountInfo
(
	in p_accountID int,
    in p_accountPassword varchar(255),
    out p_output varchar(50)
)
begin
	declare exit handler for sqlexception rollback;
    set autocommit=0;
    start transaction;
		if exists(select 1 from accountInfo where accountInfoID = p_accountID)
        then
			update accountInfo
            set accountPassword = aes_encrypt(p_accountPassword, 'route2016') 
            where accountInfoID = p_accountID;
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

create procedure retrieveAccountInfo
(
	in p_accountID int,
    in p_accountType int
)
begin
	select accountInfoID as 'account_ID',
		   accountType as 'account_type'
	from accountInfo
    where ifnull(p_accountID, accountInfoID) = accountInfoID AND ifnull(p_accountType, accountType) = accountType
    ;
end//

DELIMITER ;

