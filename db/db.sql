DROP DATABASE IF EXISTS e2l;
CREATE DATABASE e2l DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,CREATE TEMPORARY TABLES,DROP,INDEX,ALTER ON e2l.* TO e2luser@localhost IDENTIFIED BY 'password';
