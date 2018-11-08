-- MySQL Functions and Triggers
-- Stored Procedures
-- Procedure to do checking on assigned_to table
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

-- Procedure to do checking on task table
DELIMITER $$

CREATE PROCEDURE check_insert_task(IN task_date DATE, IN task_start_time TIME, IN task_end_time TIME)
BEGIN
    IF (task_date < CURRENT_DATE) OR (task_end_time <= task_start_time) THEN
        SIGNAL SQLSTATE '45002'
            SET MESSAGE_TEXT = 'Please ensure that your date and timings are valid. Tasks cannot be scheduled before the current date, and the end time must not be earlier than the start time.';
    END IF;
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

-- Trigger on insertion of task
DELIMITER $$

CREATE TRIGGER check_insert_task
BEFORE INSERT ON task
FOR EACH ROW
BEGIN
    CALL check_insert_task(NEW.task_date, NEW.start_time, NEW.end_time);
END$$

DELIMITER ;



--PostgreSQL Functions and Triggers
-- Stored Functions
-- Function to check assigned_to table when user places a bid
CREATE FUNCTION check_assigned_to_on_bid()
RETURNS TRIGGER AS $$
DECLARE
    bid_task_date DATE := '1900-01-01';
    bid_task_start_time TIME := '00:00:00';
    bid_task_end_time TIME := '00:00:00';
    assigned_task_date DATE := '1900-01-01';
    assigned_task_start_time TIME := '00:00:00';
    assigned_task_end_time TIME := '00:00:00';
    myCursor SCROLL CURSOR FOR
        SELECT task_date, start_time, end_time
        FROM assigned_to a, task t
        WHERE a.task = t.taskid AND a.assignee = NEW.bidder;
BEGIN
    SELECT task_date, start_time, end_time INTO bid_task_date, bid_task_start_time, bid_task_end_time
    FROM task WHERE taskid = NEW.task;

    OPEN myCursor;

    LOOP
        FETCH myCursor INTO assigned_task_date, assigned_task_start_time, assigned_task_end_time;
        EXIT WHEN NOT FOUND;
        IF (bid_task_date == assigned_task_date) AND ((bid_task_start_time < assigned_task_end_time AND bid_task_start_time >= assigned_task_start_time) OR (bid_task_start_time < assigned_task_start_time AND bid_task_end_time > assigned_task_start_time)) THEN
            RAISE NOTICE 'Your bid has been rejected since a task that you are assigned to clashes with the one you are bidding for.';
            RETURN NULL;
        END IF;
    END LOOP;

    CLOSE myCursor;
    RETURN NEW;
END; $$
LANGUAGE PLPGSQL;

-- Function to check assigned_to table when task creator accepts a bid
CREATE FUNCTION check_assigned_to_on_assignment()
RETURNS TRIGGER AS $$
DECLARE
    bid_task_date DATE := '1900-01-01';
    bid_task_start_time TIME := '00:00:00';
    bid_task_end_time TIME := '00:00:00';
    assigned_task_date DATE := '1900-01-01';
    assigned_task_start_time TIME := '00:00:00';
    assigned_task_end_time TIME := '00:00:00';
    myCursor SCROLL CURSOR FOR
        SELECT task_date, start_time, end_time
        FROM assigned_to a, task t
        WHERE a.task = t.taskid AND a.assignee = NEW.assignee;
BEGIN
    SELECT task_date, start_time, end_time INTO bid_task_date, bid_task_start_time, bid_task_end_time
    FROM task WHERE taskid = NEW.task;

    OPEN myCursor;

    LOOP
        FETCH myCursor INTO assigned_task_date, assigned_task_start_time, assigned_task_end_time;
        EXIT WHEN NOT FOUND;
        IF (bid_task_date == assigned_task_date) AND ((bid_task_start_time < assigned_task_end_time AND bid_task_start_time >= assigned_task_start_time) OR (bid_task_start_time < assigned_task_start_time AND bid_task_end_time > assigned_task_start_time)) THEN
            RAISE NOTICE 'Cannot assign user to task. User\'s schedule clashes with the task you are assigning them to.';
            RETURN NULL;
        END IF;
    END LOOP;

    CLOSE myCursor;
    RETURN NEW;
END; $$
LANGUAGE PLPGSQL;

-- Function to validate task insertion
CREATE FUNCTION check_insert_task()
RETURNS TRIGGER AS $$
BEGIN
    IF (NEW.task_date < CURRENT_DATE) OR (NEW.end_time <= NEW.start_time) THEN
        RAISE NOTICE 'Please ensure that your date and timings are valid. Tasks cannot be scheduled before the current date, and the end time must not be earlier than the start time.';
        RETURN NULL;
    END IF;
    RETURN NEW;
END; $$
LANGUAGE PLPGSQL;



-- Triggers
-- Trigger on insertion for bid
CREATE TRIGGER check_assigned_to_on_bid
BEFORE INSERT ON bid
FOR EACH ROW
EXECUTE PROCEDURE check_assigned_to_on_bid();

-- Trigger on insertion for assigned_to
CREATE TRIGGER check_assigned_to_on_assignment
BEFORE INSERT ON assigned_to
FOR EACH ROW
EXECUTE PROCEDURE check_assigned_to_on_assignment();

-- Trigger on insertion for task
CREATE TRIGGER check_insert_task
BEFORE INSERT ON task
FOR EACH ROW
EXECUTE PROCEDURE check_insert_task();


-- Resources for Help
-- http://www.mysqltutorial.org/create-the-first-trigger-in-mysql.aspx
-- http://www.mysqltutorial.org/mysql-check-constraint/
-- https://dev.mysql.com/doc/refman/8.0/en/create-procedure.html
-- https://stackoverflow.com/questions/5817395/how-can-i-loop-through-all-rows-of-a-table-mysql
-- http://www.postgresqltutorial.com/postgresql-create-function/