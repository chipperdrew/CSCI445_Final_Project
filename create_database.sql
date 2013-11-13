USE team06;

-- disable foreign keys to delete tables succesfully
SET foreign_key_checks = 0;

-- ---
-- Table 'tag'
-- tags are applied to a request to help search for it, allows for sorting as well
-- ---

DROP TABLE IF EXISTS tag;
    
CREATE TABLE tag (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name MEDIUMTEXT NULL
);

-- ---
-- Table 'user'
-- we don't encrypt passwords, plaintext ftw
-- ---

DROP TABLE IF EXISTS user;
    
CREATE TABLE user (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  username VARCHAR(32) NULL,
  password MEDIUMTEXT NULL,
  first_name MEDIUMTEXT NULL,
  last_name MEDIUMTEXT NULL,
  email MEDIUMTEXT NULL
);

-- ---
-- Table 'submission'
-- response to a request
-- ---

DROP TABLE IF EXISTS submission;
    
CREATE TABLE submission (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  request_id INT NOT NULL,
  user_id INT NOT NULL,
  submission_timestamp TIMESTAMP NULL,
  content BLOB,
  filename MEDIUMTEXT NOT NULL
);

-- ---
-- Table 'request'
-- user submitted requests for code or algorithm
-- ---

DROP TABLE IF EXISTS request;
    
CREATE TABLE request (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  owner_id INT NOT NULL,
  accepted_submission_id INT NULL,
  title VARCHAR(1024) NOT NULL,
  description MEDIUMTEXT NULL,
  price_min DECIMAL NULL,
  price_max DECIMAL NULL,
  FOREIGN KEY(owner_id) REFERENCES user(id),
  FOREIGN KEY(accepted_submission_id) REFERENCES submission(id)
);

-- ---
-- Table 'request_tag'
-- join table
-- ---

DROP TABLE IF EXISTS request_tag;
    
CREATE TABLE request_tag (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  request_id INT NOT NULL,
  tag_id INT NOT NULL,
  FOREIGN KEY(request_id) REFERENCES request(id),
  FOREIGN KEY(tag_id) REFERENCES tag(id)
);

-- enable foreign key checks
SET foreign_key_checks = 1;

-- ---
-- Foreign Keys
-- ---
ALTER TABLE submission
  ADD CONSTRAINT FOREIGN KEY(request_id) REFERENCES request(id)
  ON DELETE CASCADE;

ALTER TABLE submission
  ADD CONSTRAINT FOREIGN KEY(user_id) REFERENCES `user`(id)
  ON DELETE CASCADE;

