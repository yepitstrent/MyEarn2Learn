USE e2l;

DELETE FROM users WHERE username = 'educator0'; 
INSERT INTO users (username, password, email, firstname, lastname, role, balance, educator) 
VALUES ('educator0', 'Wagic@2262', 'educator0@wagic.com', 'Trent', 'Russell', 1, 0.00, 0);

DELETE FROM users WHERE username = 'student0'; 
INSERT INTO users (username, password, email, firstname, lastname, role, balance, educator) 
VALUES ('student0', 'Wagic@2262', 'student0@wagic.com', 'Student0', 'Student0', 0, 0.00, 1);

DELETE FROM users WHERE username = 'student1'; 
INSERT INTO users (username, password, email, firstname, lastname, role, balance, educator) 
VALUES ('student1', 'Wagic@2262', 'student1@wagic.com', 'Student1', 'Student1', 0, 0.00, 1);

DELETE FROM users WHERE username = 'student2'; 
INSERT INTO users (username, password, email, firstname, lastname, role, balance, educator) 
VALUES ('student2', 'Wagic@2262', 'student2@wagic.com', 'Student2', 'Student2', 0, 0.00, 1);


