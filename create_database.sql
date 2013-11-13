USE team06;
-- ---
-- Table 'request'
-- user submitted requests for code or algorithm
-- ---

DROP TABLE IF EXISTS `request`;
    
CREATE TABLE `request` (
  `id` PRIMARY KEY INT NULL AUTO_INCREMENT,
  `owner_id` INT NOT NULL,
  `accepted_submission_id` INT NULL,
  `title` VARCHAR(1024) NOT NULL DEFAULT 'NULL',
  `description` MEDIUMTEXT NULL,
  `price_min` DECIMAL NULL,
  `price_max` DECIMAL NULL,
  FOREIGN KEY(owner_id) REFERENCES user(id),
  FOREIGN KEY(accepted_submission_id) REFERENCES submission(id)
);

-- ---
-- Table 'user'
-- we don't encrypt passwords, plaintext ftw
-- ---

DROP TABLE IF EXISTS `user`;
    
CREATE TABLE `user` (
  `id` PRIMARY KEY INT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NULL,
  `password` MEDIUMTEXT NULL,
  `first_name` MEDIUMTEXT NULL,
  `last_name` MEDIUMTEXT NULL,
  `email` MEDIUMTEXT NULL
);

-- ---
-- Table 'submission'
-- response to a request
-- ---

DROP TABLE IF EXISTS `submission`;
    
CREATE TABLE `submission` (
  `id` PRIMARY KEY INT NULL AUTO_INCREMENT,
  `request_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `submission_timestamp` TIMESTAMP NULL,
  `content` BLOB NULL,
  `filename` MEDIUMTEXT NOT NULL DEFAULT 'NULL',
  FOREIGN KEY(request_id) REFERENCES request(id),
  FOREIGN KEY(user_id) REFERENCES user(id)
);

-- ---
-- Table 'tag'
-- tags are applied to a request to help search for it, allows for sorting as well
-- ---

DROP TABLE IF EXISTS `tag`;
    
CREATE TABLE `tag` (
  `id` PRIMARY KEY INT NULL AUTO_INCREMENT,
  `name` MEDIUMTEXT NULL
);

-- ---
-- Table 'request_tag'
-- join table
-- ---

DROP TABLE IF EXISTS `request_tag`;
    
CREATE TABLE `request_tag` (
  `id` INT NULL AUTO_INCREMENT,
  `request_id` INT NOT NULL,
  `tag_id` INT NOT NULL,
  PRIMARY KEY (`id`, `tag_id`, `request_id`),
  FOREIGN KEY(request_id) REFERENCES request(id),
  FOREIGN KEY(tag_id) REFERENCES tag(id)
);
