CREATE DATABASE `community-journal`;

CREATE TABLE blogfeed (
  title varchar(255) DEFAULT NULL,
  blogpic longblob,
  Dates timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  blog_id bigint(20) UNSIGNED NOT NULL,
  commment varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE friends (
  user_id bigint(20) UNSIGNED NOT NULL,
  username varchar(255) DEFAULT NULL,
  online tinyint(1) DEFAULT NULL,
  friend_request tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE personal (
  personal_id bigint(20) UNSIGNED NOT NULL,
  saved_drafts varchar(255) DEFAULT NULL,
  list varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE users (
  user_id bigint(20) UNSIGNED NOT NULL,
  Fname varchar(50) DEFAULT NULL,
  Lname varchar(50) DEFAULT NULL,
  email varchar(50) DEFAULT NULL,
  phone varchar(50) DEFAULT NULL,
  username varchar(50) DEFAULT NULL,
  password varchar(50) DEFAULT NULL,
  country varchar(100) DEFAULT NULL,
  profile_pic longblob,
  headline varchar(75) DEFAULT NULL,
  bio varchar(200) DEFAULT NULL,
  gender varchar(250) DEFAULT NULL,
  log_in varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE users_chat (
  msg_id int(11) NOT NULL,
  sender_username varchar(255) NOT NULL,
  receiver_username varchar(255) NOT NULL,
  msg_content varchar(255) NOT NULL,
  msg_status text NOT NULL,
  msg_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users_chat (msg_id, sender_username, receiver_username, msg_content, msg_status, msg_date) VALUES
(1, 'tyler', 'fink', 'hello ', 'unread', '2020-03-20 20:02:30'),
(2, 'tyler', 'fink', 'hello', 'unread', '2020-03-20 20:06:50'),
(3, 'user_name', 'username', 'msg', 'unread', '2020-03-20 20:08:21'),
(4, '', 'MrChief1', 'hey ', 'unread', '2020-03-20 20:09:13'),
(5, '', 'MrChief1', 'hi ', 'unread', '2020-03-20 20:09:16'),
(6, 'MrChief1', '', 'hi ', 'unread', '2020-03-20 20:10:04'),
(7, 'MrChief1', '', 'hey', 'unread', '2020-03-20 20:10:19'),
(8, 'MrChief1', '', 'hey', 'unread', '2020-03-20 20:16:52'),
(9, 'MrChief1', '', 'hey', 'unread', '2020-03-20 20:22:18'),
(10, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:25:00'),
(11, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:27:34'),
(12, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:27:50'),
(13, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:28:19'),
(14, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:28:42'),
(15, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:29:00'),
(16, 'tfink123', '', 'hey ', 'unread', '2020-03-20 20:29:27'),
(17, 'Tfinkerwqerqew', '', 'Hello', 'unread', '2020-03-20 20:29:51'),
(18, 'Tfinkerwqerqew', '', 'Hello', 'unread', '2020-03-20 20:32:13'),
(19, 'Tfinkerwqerqew', '', 'hey', 'unread', '2020-03-20 20:33:01'),
(20, 'Tfinkerwqerqew', '', 'hey', 'unread', '2020-03-20 20:34:29'),
(21, 'Tfinkerwqerqew', '', 'hey', 'unread', '2020-03-20 20:34:37'),
(22, 'Tfinkerwqerqew', '', 'hey', 'unread', '2020-03-20 20:34:58'),
(23, 'Tfinkerwqerqew', '', 'hey', 'unread', '2020-03-20 20:35:08'),
(24, 'Tfinkerwqerqew', '', 'hey ', 'unread', '2020-03-20 20:35:21'),
(25, 'Tfinkerwqerqew', '', 'hey', 'unread', '2020-03-20 20:35:36'),
(26, 'MrChief1', '', 'hey ', 'unread', '2020-03-20 20:42:52'),
(27, 'Tfinkerwqerqew', '', 'hey ', 'unread', '2020-03-20 20:43:00'),
(28, 'MrChief1sdasddas', '', 'hi ', 'unread', '2020-03-20 20:43:13'),
(29, 'asdfdsa', '', 'hey ', 'unread', '2020-03-20 20:43:41'),
(30, 'asdfdsa', '', 'hey', 'unread', '2020-03-20 20:46:37'),
(31, 'asdfdsa', '', 'hey', 'unread', '2020-03-20 20:46:40'),
(32, 'MrChief1', '', 'hey ', 'unread', '2020-03-20 20:47:54'),
(33, 'MrChief1', '', 'hey ', 'unread', '2020-03-20 20:48:01'),
(34, 'asdasdsadad', '', 'hey ', 'unread', '2020-03-20 20:52:13'),
(35, 'asdasdsadad', '', 'hey ', 'unread', '2020-03-20 20:52:16'),
(36, 'MrChief1', '', 'hi ', 'unread', '2020-03-20 21:08:24'),
(37, 'MrChief1', '', 'hi ', 'unread', '2020-03-20 21:08:27'),
(38, 'MrChief1', '', 'hi', 'unread', '2020-03-20 22:15:21'),
(39, 'MrChief1', '', 'hello', 'unread', '2020-03-23 16:14:22'),
(40, 'MrChief1', '', 'hello', 'unread', '2020-03-23 16:14:28'),
(41, 'asdasdsadad', '', 'hi ', 'unread', '2020-03-23 16:28:30'),
(42, 'asdasdsadad', '', 'hi ', 'unread', '2020-03-23 16:28:39'),
(43, 'asdasdsadad', '', 'hi', 'unread', '2020-03-23 16:28:45'),
(44, 'asdasdsadad', '', 'hey', 'unread', '2020-03-23 16:28:50'),
(45, 'asdasdsadad', '', 'hello', 'unread', '2020-03-23 16:28:59'),
(46, 'MrChief1', '', 'Hi', 'unread', '2020-03-23 18:06:57');


ALTER TABLE blogfeed
  ADD PRIMARY KEY (blog_id);

ALTER TABLE friends
  ADD UNIQUE KEY user_id (user_id);

ALTER TABLE personal
  ADD PRIMARY KEY (personal_id);

ALTER TABLE users
  ADD PRIMARY KEY (user_id);

ALTER TABLE users_chat
  ADD PRIMARY KEY (msg_id);


ALTER TABLE blogfeed
  MODIFY blog_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE friends
  MODIFY user_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE personal
  MODIFY personal_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE users
  MODIFY user_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE friends
  ADD CONSTRAINT friends_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (user_id);
