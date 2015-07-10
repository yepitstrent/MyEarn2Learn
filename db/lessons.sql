USE e2l;

DELETE FROM lessons WHERE lesson_name = 'Bugs';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Bugs', 1, 1.50, 'pTQZAiuDoTg', 'Amazing Bugs You Probably Didn\'t Know Exist!' );

DELETE FROM questions WHERE q_name = 'Bugs: Q1';
INSERT INTO questions (q_name, lid, the_question, order_of ) VALUES ('Bugs: Q1', 1, 'WHAT ARE BUGS?', 1);

DELETE FROM answers WHERE qid = 1;
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (1, 1, 'Bugs are animals.', true);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (1, 1, 'Nothing, bugs don\'t exist.', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (1, 1, 'Bugs are tiny robots.', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (1, 1, 'They are plants.', false);

DELETE FROM questions WHERE q_name = 'Bugs: Q2';
INSERT INTO questions (q_name, lid, the_question, order_of ) VALUES ('Bugs: Q2', 1, 'SECOND QUESTION ABOUT BUGS?', 2);

DELETE FROM answers WHERE qid = 2;
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (2, 1, 'THIS IS THE CORRECT ANSWER. BUGS: Q2', true);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (2, 1, 'WRONG 1. BUGS: Q2', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (2, 1, 'WRONG 2. BUGS: Q2', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (2, 1, 'WRONG 3. BUGS: Q2', false);

DELETE FROM questions WHERE q_name = 'Bugs: Q3';
INSERT INTO questions (q_name, lid, the_question, order_of ) VALUES ('Bugs: Q3', 1, 'THIRD QUESTION ABOUT BUGS?', 3);

DELETE FROM answers WHERE qid = 3;
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (3, 1, 'THIS IS THE CORRECT ANSWER. BUGS: Q3', true);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (3, 1, 'WRONG 1. BUGS: Q3', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (3, 1, 'WRONG 2. BUGS: Q3', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (3, 1, 'WRONG 3. BUGS: Q3', false);

DELETE FROM lessons WHERE lesson_name = 'Monkeys';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Monkeys', 1, 2.25 , 'DUh-jGSLx_E', 'Amusing Snow Monkeys Full Documentary');

DELETE FROM questions WHERE q_name = 'Monkeys: Q1';
INSERT INTO questions (q_name, lid, the_question, order_of ) VALUES ('Monkeys: Q1', 2, 'First Monkey question?', 1);

DELETE FROM answers WHERE qid = 4;
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (4, 2, 'THIS IS THE CORRECT ANSWER. Monkeys: Q1', true);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (4, 2, 'WRONG 1. Monkeys: Q1', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (4, 2, 'WRONG 2. Monkeys: Q1', false);
INSERT INTO answers (qid, lid, the_answer, correct) VALUES (4, 2, 'WRONG 3. Monkeys: Q1', false);


DELETE FROM lessons WHERE lesson_name = 'Eagles';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Eagles', 1, 0.99, 'ycSuT5FfQtU', 'The American Bald Eagle - National Geographic Documentary' );

DELETE FROM lessons WHERE lesson_name = 'Animals';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Animals', 1, 1.50, '2pnnm8lQ6mc', 'Animals Video II - Real Animals: Names, Sounds, and Babies\' Names ' );

DELETE FROM lessons WHERE lesson_name = 'Birds';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Birds', 1, 2.25 , 'VwhVltCGocA', 'Amazing Animal Facts: The Birds (Animal Atlas)');

DELETE FROM lessons WHERE lesson_name = 'Puppies';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Puppies', 1, 0.99, 'uO7EBXfIHAY', 'Caring for Neonatal orphaned puppies' );

DELETE FROM lessons WHERE lesson_name = 'Cats';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Cats', 1, 1.50, '65aCqGGG9eA', 'It\'s A Cats Life - 1957 Kittens & Cats Educational Documentary' );

DELETE FROM lessons WHERE lesson_name = 'Math';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Math', 1, 2.25 , 'PGmVvIglZx8', 'Fundamental Theorem of Calculus Part 1');

DELETE FROM lessons WHERE lesson_name = 'Music';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Music', 1, 0.99, 'R0JKCYZ8hng', 'How playing an instrument benefits your brain - Anita Collins' );

DELETE FROM lessons WHERE lesson_name = 'Siftables';
INSERT INTO lessons (lesson_name, creator, reward, preview, description) VALUES ('Siftables', 1, 0.59, 'qf7UnH1AHYA', 'Toy tiles that talk to each other - David Merrill' );



