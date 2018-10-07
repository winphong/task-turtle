CREATE TABLE userTable (
   user_name VARCHAR(32) PRIMARY KEY,
   password VARCHAR(32) NOT NULL,
   display_name VARCHAR(128) NOT NULL,
   user_profile VARCHAR(1024) NOT NULL DEFAULT ‘No biography provided’);

CREATE TABLE task (
   taskid SERIAL PRIMARY KEY,
   title VARCHAR(64) NOT NULL,
   description VARCHAR(1024) NOT NULL DEFAULT ‘No description provided’,
   task_date DATE NOT NULL,
   start_time TIME NOT NULL,
   end_time TIME NOT NULL,
   location VARCHAR(128) NOT NULL,
   category VARCHAR(32) NOT NULL,
   CONSTRAINT category CHECK(category = 'Mounting & Installation' OR category = 'Moving & Packing' OR category = 'Furniture Assembly' OR  category = 'Home Improvement'  OR category = 'General Handyman' OR  category = 'Heavy Lifting' OR  category = 'Others'),
   post_date DATE NOT NULL,
   creator VARCHAR(32) NOT NULL,
   FOREIGN KEY (creator) REFERENCES userTable(user_name) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE assigned_to (
  task INTEGER PRIMARY KEY,
  assignee VARCHAR(32) NOT NULL,
  FOREIGN KEY (assignee) REFERENCES userTable(user_name) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (task) REFERENCES task(taskid) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE bid (
  bidder VARCHAR(32) NOT NULL,
  task INTEGER NOT NULL,
  bid_value NUMERIC(18, 2) NOT NULL,
  status VARCHAR(10) NOT NULL,
  CONSTRAINT status CHECK(status = 'successful' OR status = 'failed' OR status = 'pending'),
  FOREIGN KEY (bidder) REFERENCES userTable(user_name) ON UPDATE CASCADE ON   DELETE CASCADE,
  FOREIGN KEY (task) REFERENCES task(taskid) ON UPDATE CASCADE ON DELETE CASCADE,
  PRIMARY KEY (bidder, task));

CREATE TABLE admin (
  admin_name VARCHAR(32) PRIMARY KEY,
  password VARCHAR(32) NOT NULL,
  display_name VARCHAR(128) NOT NULL);
