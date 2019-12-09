DROP PROCEDURE IF EXISTS get_userType;
DELIMITER $$
CREATE PROCEDURE `get_userType`(IN i_username VARCHAR(50))
BEGIN
    DROP TABLE IF EXISTS user_type;
    CREATE TABLE user_type
		SELECT username,
			CASE 
				WHEN username in (select username from customer natural join manager natural join user) THEN "CustomerManager"
				WHEN username in (select username from customer natural join admin natural join user) THEN "CustomerAdmin"
				WHEN username in (select username from user natural join manager) THEN "Manager"
				WHEN username in (select username from user natural join admin) THEN "Admin"
				WHEN username in (select username from user natural join customer) THEN "Customer" 
                WHEN username in (select username from user) THEN "User" 
			END AS userType
		FROM user
		WHERE (username = i_username);
END$$
DELIMITER ;