-- MySQL Functions and Triggers
-- Stored Procedures
-- assigned_to checking for bidding
DELIMITER $$

CREATE PROCEDURE check_assigned_to(IN username VARCHAR(32), IN bid_task_date DATE, IN bid_task_start_time TIME, IN bid_task_end_time TIME, IN message_type INTEGER)
BEGIN
    DECLARE assigned_task_start_time TIME DEFAULT '00:00:00';
    DECLARE assigned_task_end_time TIME DEFAULT '00:00:00';
    DECLARE finished INTEGER DEFAULT 0;

    DECLARE rowCursor CURSOR FOR
        SELECT start_time, end_time FROM assigned_to a, task t
        WHERE a.task = t.taskid AND task_date = bid_task_date AND assignee = username;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    OPEN rowCursor;

    get_row_time_values : LOOP
        FETCH rowCursor INTO assigned_task_start_time, assigned_task_end_time;

        IF finished = 1 THEN
            LEAVE get_row_time_values;
        END IF;

        IF (bid_task_start_time < assigned_task_end_time AND bid_task_start_time >= assigned_task_start_time) OR (bid_task_start_time < assigned_task_start_time AND bid_task_end_time > assigned_task_start_time) THEN
            SET finished = 1;
            CASE message_type
                WHEN 1 THEN
                    SIGNAL SQLSTATE '45001'
                        SET MESSAGE_TEXT = 'Cannot assign user to task. User\'s schedule clashes with the task you are assigning them to.';
                ELSE
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Your bid has been rejected since a task that you are assigned to clashes with the one you are bidding for.';
            END CASE;
        END IF;
    END LOOP get_row_time_values;

    CLOSE rowCursor;

END$$

DELIMITER ;



-- Triggers
-- Trigger on insertion of bid
DELIMITER $$

CREATE TRIGGER check_assigned_to_on_bid
BEFORE INSERT ON bid
FOR EACH ROW
BEGIN
    DECLARE bid_task_date DATE DEFAULT '1900-01-01';
    DECLARE bid_task_start_time TIME DEFAULT '00:00:00';
    DECLARE bid_task_end_time TIME DEFAULT '00:00:00';
    SELECT task_date, start_time, end_time INTO bid_task_date, bid_task_start_time, bid_task_end_time
    FROM task
    WHERE taskid = NEW.task;
    CALL check_assigned_to(NEW.bidder, bid_task_date, bid_task_start_time, bid_task_end_time, 0);
END$$

DELIMITER ;

-- Trigger on insertion of assigned_to
DELIMITER $$

CREATE TRIGGER check_assigned_to_on_assignment
BEFORE INSERT ON assigned_to
FOR EACH ROW
BEGIN
    DECLARE bid_task_date DATE DEFAULT '1900-01-01';
    DECLARE bid_task_start_time TIME DEFAULT '00:00:00';
    DECLARE bid_task_end_time TIME DEFAULT '00:00:00';
    SELECT task_date, start_time, end_time INTO bid_task_date, bid_task_start_time, bid_task_end_time
    FROM task
    WHERE taskid = NEW.task;
    CALL check_assigned_to(NEW.assignee, bid_task_date, bid_task_start_time, bid_task_end_time, 1);
END$$

DELIMITER ;

-- Resources for Help
-- http://www.mysqltutorial.org/create-the-first-trigger-in-mysql.aspx
-- http://www.mysqltutorial.org/mysql-check-constraint/
-- https://dev.mysql.com/doc/refman/8.0/en/create-procedure.html
-- https://stackoverflow.com/questions/5817395/how-can-i-loop-through-all-rows-of-a-table-mysql
-- http://www.postgresqltutorial.com/postgresql-create-function/