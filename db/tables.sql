DROP DATABASE IF EXISTS e2l;
CREATE DATABASE e2l DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP USER 'e2luser'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,CREATE TEMPORARY TABLES,DROP,INDEX,ALTER ON e2l.* TO e2luser@localhost IDENTIFIED BY 'password';

USE e2l;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    role INT NOT NULL,
    balance DECIMAL(10,2) NOT NULL, 
    educator INT(6) UNSIGNED NOT NULL
);

DROP TABLE IF EXISTS lessons;
CREATE TABLE lessons (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lesson_name VARCHAR(50) NOT NULL,   
    creator INT(6) UNSIGNED NOT NULL,
    reward DECIMAL(10, 2) NOT NULL,
    preview VARCHAR(255),
    description VARCHAR(255),
    created  TIMESTAMP,
    due  TIMESTAMP
);

DROP TABLE IF EXISTS tasks;
CREATE TABLE tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    creator INT(6) UNSIGNED NOT NULL,
    reward DECIMAL(10, 2) NOT NULL,
    instructions TEXT NOT NULL,
    created TIMESTAMP,
    due TIMESTAMP,
    time INT(6) UNSIGNED NOT NULL
);

DROP TABLE IF EXISTS user_tasks;
CREATE TABLE user_tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uid INT(6) UNSIGNED NOT NULL,
    tid INT(6) UNSIGNED NOT NULL,
    grade INT(6) UNSIGNED NOT NULL

);

DROP TABLE IF EXISTS questions;
CREATE TABLE questions(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    q_name VARCHAR(30) NOT NULL,
    lid INT(6) UNSIGNED NOT NULL,
    the_question VARCHAR(255) NOT NULL,
    order_of INT(6) UNSIGNED NOT NULL
);

DROP TABLE IF EXISTS answers;
CREATE TABLE answers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    qid INT(6) UNSIGNED NOT NULL,
    lid INT(6) UNSIGNED NOT NULL,
    the_answer VARCHAR(255) NOT NULL,
    correct BOOLEAN NOT NULL
);

DROP TABLE IF EXISTS user_lessons;
CREATE TABLE user_lessons (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    u_id INT(6) UNSIGNED NOT NULL,
    l_id INT(6) UNSIGNED NOT NULL,
    score INT(6) UNSIGNED NOT NULL,
    total_q INT(6) UNSIGNED NOT NULL,
    earned DECIMAL(10,2) NOT NULL  
);

DROP TABLE IF EXISTS user_questions;
CREATE TABLE user_questions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    u_id INT(6) UNSIGNED NOT NULL,
    l_id INT(6) UNSIGNED NOT NULL,
    q_id INT(6) UNSIGNED NOT NULL,
    grade INT(6) UNSIGNED
);


DROP TABLE IF EXISTS lesson_questions;
CREATE TABLE lesson_questions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    l_id INT(6) UNSIGNED NOT NULL,
    q_id INT(6) UNSIGNED NOT NULL
);

DROP TABLE IF EXISTS user_tasks;
CREATE TABLE user_tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    u_id INT(6) UNSIGNED NOT NULL,
    t_id INT(6) UNSIGNED NOT NULL,
    time_amt INT(6) UNSIGNED NOT NULL,
    time_cur TIMESTAMP NOT NULL,
    grade INT(6) UNSIGNED
);


\. db/users.sql
\. db/lessons.sql
\. db/tasks.sql