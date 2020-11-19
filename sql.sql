drop DATABASE `doit_app`;

create database `doit_app_db`;

create table `doit_app`.`users` (
    `email` varchar(60) not null,
    `user_name` varchar(40) not null,
    `password` varchar(64) not null,
    `user_id` varchar(32) not null,
    primary key (`email`)
);

-- php hashing for this table:

-- <?php
-- $algo = "sha256";
-- $password = "passaaaaaaaa";
-- $key = "randomkey671";

-- $email = "bob@email.com";

-- $hashedPw = hash_hmac($algo , $password, $key);
-- $user_id = md5($email);

-- var_dump($hashedPw, $userId);

-- ?>