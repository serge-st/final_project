CREATE DATABASE `doit_app_db`;

create table `doit_app_db`.`users` (
    `user_id` varchar(32) not null,
    `email` varchar(60) not null,
    `user_name` varchar(40) not null,
    `password` varchar(64) not null,
    PRIMARY KEY (`user_id`)
);

create table `doit_app_db`.`user_sessions` (
    `session_id` varchar(64) not null,
    `user_id` varchar(32) not null,
    PRIMARY KEY (`session_id`),
    FOREIGN KEY (`user_id`) REFERENCES `doit_app_db`.`users` (`user_id`)
);

create table `doit_app_db`.`user_tasks` (
    `id` INT AUTO_INCREMENT,
    `user_id` varchar(32) not null,
    `description` varchar(100) not null,
    `is_completed` bit DEFAULT 0,
    `list_order` int DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `doit_app_db`.`users`(`user_id`)
);