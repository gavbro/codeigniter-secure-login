DELIMITER $$
DROP PROCEDURE IF EXISTS `test_database`.`login_checkEmail`$$
CREATE PROCEDURE `test_database`.`login_checkEmail`
(
	IN userEmail VARCHAR(100), -- inputed email address, pre-verified as valid.
	OUT isEmailOK INT(11) -- Return 0 (Not found) UserID (Found).
)
BEGIN
DECLARE uID INT(11);
# Get the ID of any active user with the entered email address. Return 1 if you find it, 0 if you do not.
SELECT `user_table`.`usr_id` INTO uID FROM `test_database`.`user_table` WHERE userEmail = `user_table`.`usr_email` LIMIT 1;
	CASE uID WHEN uID > 0 THEN
		SET isEmailOK = uID;
	ELSE
		SET isEmailOK = 0;
	END CASE ;
END $$
DELIMITER ;

# Check email again, just to be sure. Also check password and return session set data on success.

DELIMITER $$
DROP PROCEDURE IF EXISTS `test_database`.`login_checkPass`$$
CREATE PROCEDURE `test_database`.`login_checkPass`
(
	IN userEmail VARCHAR(100), -- The email address entered on the login page.
	OUT passwordHash VARCHAR(255), -- Stored 1-way encrypted password for comparison in PHP.
	OUT firstName VARCHAR(50), -- First Name
	OUT lastName VARCHAR(50), -- Last Name
	OUT userId INT(11) -- user ID assigned my MySQL on creation (PRIMARY, AUTO_INCREMENT).
)
BEGIN
	# Select each OUT variable individually using the pre-verified email address as the reference.
	SELECT `user_table`.`usr_pass` INTO passwordHash FROM `test_database`.`user_table` WHERE userEmail = `user_table`.`usr_email` LIMIT 1;
	SELECT `user_table`.`usr_fname` INTO firstName FROM `test_database`.`user_table` WHERE userEmail = `user_table`.`usr_email` LIMIT 1;
	SELECT `user_table`.`usr_lname` INTO lastName FROM `test_database`.`user_table` WHERE userEmail = `user_table`.`usr_email` LIMIT 1;
	SELECT `user_table`.`usr_id` INTO userId FROM `test_database`.`user_table` WHERE userEmail = `user_table`.`usr_email` LIMIT 1;
END $$
DELIMITER ;