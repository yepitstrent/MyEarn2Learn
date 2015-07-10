USE e2l;

/*CREATE TABLE tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    creator INT(6) UNSIGNED NOT NULL,
    reward DECIMAL(10, 2) NOT NULL,
    instructions VARCHAR(255) NOT NULL,
    created TIMESTAMP,
    due TIMESTAMP
);*/

DELETE FROM tasks WHERE task_name = 'Clean your room';
INSERT INTO tasks (task_name, creator, reward, instructions, time ) 
VALUES ('Clean your room', 1, 2.00, 'Put away all of your toys and make your bed. After everything is off the floor, vacuum the floor and under your bed.', 90);

DELETE FROM tasks WHERE task_name = 'Take out the trash';
INSERT INTO tasks (task_name, creator, reward, instructions, time ) 
VALUES ('Take out the trash', 1, 0.50, 'Take the trash barels out to the curb the night before trash day. Make sure that the wheels are touching the curb and if there is any debris that has fallen out, put it in the trash.', 30);

DELETE FROM tasks WHERE task_name = 'Put away your laundry';
INSERT INTO tasks (task_name, creator, reward, instructions, time) 
VALUES ('Put away your laundry', 1, 1.00, 'Take the clothes out of the dryer and hang up the shirts and fold the pants. Put everything in it\'s place.', 90);

DELETE FROM tasks WHERE task_name = 'Walk the dog';
INSERT INTO tasks (task_name, creator, reward, instructions, time) 
VALUES ('Walk the dog', 1, 1.50, 'Take Barny out on a walk around the block and don\'t forget to pick up any dog doo!', 90);

DELETE FROM tasks WHERE task_name = 'Do your homework';
INSERT INTO tasks (task_name, creator, reward, instructions, time) 
VALUES ('Do your homework', 1, 1.00, 'Finish all of your homework before you paly XBox or watch TV. Come in and show me your work so I can help you if needed.', 90);

