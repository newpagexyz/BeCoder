 CREATE DATABASE `becoder`;
 ALTER DATABASE `becoder` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

 CREATE USER 'becoder_user'@'localhost' IDENTIFIED BY 'password123';
 GRANT ALL PRIVILEGES ON `becoder`.* TO 'becoder_user'@'localhost';
 
 use becoder
 
 CREATE TABLE `users`(
    `id`            INT AUTO_INCREMENT NOT NULL,
    `email`         VARCHAR(255),
    `photo`         LONGTEXT,
    `password`      VARCHAR(64),
    `name`          VARCHAR(30),
    `surname`       VARCHAR(30),
    `power`         INT(1) DEFAULT 0,
    primary key(`id`)
 );
  CREATE TABLE `mail_confirm`(
   `id`            INT AUTO_INCREMENT NOT NULL,
   `uid`           INT,
   `token`         VARCHAR(64),
   primary key(`id`)
  );
  CREATE TABLE `session`(
   `id`            INT AUTO_INCREMENT NOT NULL,
   `uid`           INT,
   `session`         VARCHAR(64),
   `token`         VARCHAR(64),
   primary key(`id`,`session`)
  );
  CREATE TABLE `project`(
    `id`            INT AUTO_INCREMENT NOT NULL,
    `status`        TINYINT(1) DEFAULT 0,
    `name`          VARCHAR(100) DEFAULT "example",
    `logo`          VARCHAR(64),
    `description`   LONGTEXT DEFAULT "example",
    `JSON`          LONGTEXT DEFAULT "",
    primary key(`id`)
 );


 CREATE TABLE `projects`(
    `id`            INT AUTO_INCREMENT NOT NULL,
    `uid`           INT,
    `pid`           INT,
    primary key(`id`)
 );

 
