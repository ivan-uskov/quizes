CREATE DATABASE IF NOT EXISTS quizes;
USE quizes;

CREATE TABLE IF NOT EXISTS question
(
  question_id SERIAL,
  title VARCHAR(255),
  q_text TEXT,
  answer_id BIGINT UNSIGNED NOT NULL,
  add_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(question_id)
);

CREATE TABLE IF NOT EXISTS answer
(
  answer_id SERIAL,
  question_id BIGINT UNSIGNED NOT NULL,
  a_text TEXT,
  add_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (question_id) REFERENCES question(question_id) ON DELETE CASCADE,
  PRIMARY KEY(answer_id)
);

CREATE TABLE IF NOT EXISTS user
(
  user_id SERIAL,
  login_key VARCHAR(255) NOT NULL UNIQUE,
  status BIGINT NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(255) NULL,
  last_name VARCHAR(255) NULL,
  phone BIGINT UNSIGNED NULL,
  country VARCHAR(255) NULL,
  add_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(user_id)
);

CREATE TABLE IF NOT EXISTS user_question
(
  user_question_id SERIAL,
  user_id BIGINT UNSIGNED NOT NULL,
  question_id BIGINT UNSIGNED NOT NULL,
  answer_id BIGINT UNSIGNED NULL,
  FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (question_id) REFERENCES question(question_id) ON DELETE CASCADE,
  PRIMARY KEY(user_id)
);

INSERT INTO user_question
SET
  user_id = 1,
  question_id = 1;

INSERT INTO user
SET
  email  = 'ivan.uskov@cpslabs.net',
  first_name = 'ivan',
  last_name = 'uskov',
  status = 1,
  login_key = '54c791edd0ce54.75658910',
  password = 'd43107e00ecdcf83d3a652835a350213';

INSERT INTO question
SET
  title  = 'My first question',
  q_text = 'Where the elephant lives?',
  answer_id = 1;

INSERT INTO answer
SET
  question_id  = 1,
  a_text = 'In the desert';

INSERT INTO answer
SET
  question_id  = 1,
  a_text = 'In the sky';

INSERT INTO answer
SET
  question_id  = 1,
  a_text = 'In the field';

INSERT INTO answer
SET
  question_id  = 1,
  a_text = 'In the garage';
