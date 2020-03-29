CREATE DATABASE `community-journal`;

CREATE TABLE users (
  user_id bigint(20) UNSIGNED UNIQUE,
  Fname varchar(50) DEFAULT NULL,
  Lname varchar(50) DEFAULT NULL,
  email varchar(50) DEFAULT NULL,
  phone varchar(50) DEFAULT NULL,
  username varchar(50) UNIQUE,
  password varchar(50) DEFAULT NULL,
  country varchar(100) DEFAULT NULL,
  profile_pic longblob,
  headline varchar(75) DEFAULT NULL,
  bio varchar(200) DEFAULT NULL,
  gender varchar(250) DEFAULT NULL,
  log_in varchar(250) DEFAULT NULL
);

CREATE TABLE user_blog (
  title varchar(255),
  blogpic longblob,
  Dates timestamp,
  blog_id bigint UNSIGNED,
  commment varchar(255),
  content text 
);

CREATE TABLE friends (
  user_id bigint(20),
  username varchar(255),
  online tinyint(1) DEFAULT NULL,
  friend_request tinyint(1)
);

CREATE TABLE personal (
  personal_id bigint(20) UNSIGNED UNIQUE,
  saved_drafts varchar(255) DEFAULT NULL,
  list varchar(255) DEFAULT NULL
);



CREATE TABLE users_chat (
  msg_id int(11) NOT NULL,
  sender_username varchar(255) NOT NULL,
  receiver_username varchar(255) NOT NULL,
  msg_content varchar(255) NOT NULL,
  msg_status text NOT NULL,
  msg_date timestamp
);

CREATE TABLE comment_box (
  comment_id serial PRIMARY KEY,
  comment_content text REFERENCES user_blog(content),
  comment_blog bigint REFERENCES user_blog(blog_id),
  comment_time TIMESTAMP,
  comment_user text REFERENCES users(email)
);

CREATE TABLE recent_list (
  list_owner varchar(255) REFERENCES users(email),
  content text
);

INSERT INTO users_chat (msg_id, sender_username, receiver_username, msg_content, msg_status, msg_date) VALUES
(1, 'tyler', 'fink', 'hello ', 'unread', '2020-03-20 20:02:30'),
(2, 'tyler', 'fink', 'hello', 'unread', '2020-03-20 20:06:50'),
(3, 'user_name', 'username', 'msg', 'unread', '2020-03-20 20:08:21'),
(4, '', 'MrChief1', 'hey ', 'unread', '2020-03-20 20:09:13'),
(5, '', 'MrChief1', 'hi ', 'unread', '2020-03-20 20:09:16'),
(6, 'MrChief1', '', 'hi ', 'unread', '2020-03-20 20:10:04'),
(7, 'MrChief1', '', 'hey', 'unread', '2020-03-20 20:10:19'),
(8, 'MrChief1', '', 'hey', 'unread', '2020-03-20 20:16:52'),
(10, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:25:00'),
(11, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:27:34'),
(17, 'Tfinkerwqerqew', '', 'Hello', 'unread', '2020-03-20 20:29:51'),
(18, 'Tfinkerwqerqew', '', 'Hello', 'unread', '2020-03-20 20:32:13'),
(19, 'Tfinkerwqerqew', '', 'hey', 'unread', '2020-03-20 20:33:01');

ALTER TABLE users
  ADD PRIMARY KEY (user_id);

ALTER TABLE user_blog
  ADD PRIMARY KEY (blog_id);

ALTER TABLE friends
  ADD PRIMARY KEY (user_id);

ALTER TABLE personal
  ADD PRIMARY KEY (personal_id);

ALTER TABLE users_chat
  ADD PRIMARY KEY (msg_id);


ALTER TABLE friends
  MODIFY user_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE personal
  MODIFY personal_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE users
  MODIFY user_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
  
ALTER TABLE user_blog
  MODIFY blog_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

