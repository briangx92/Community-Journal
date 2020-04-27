CREATE DATABASE `community-journal`;
CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `Fname` varchar(50) DEFAULT NULL,
  `Lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `profile_pic` longblob DEFAULT NULL,
  `headline` varchar(75) DEFAULT NULL,
  `bio` varchar(200) DEFAULT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `log_in` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `users_chat` (
  `msg_id` int(11) NOT NULL,
  `sender_username` varchar(255) NOT NULL,
  `reciever_username` varchar(255) NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `msg_status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);
--
-- Indexes for table `users_chat`
--
ALTER TABLE `users_chat`
  ADD PRIMARY KEY (`msg_id`);
  ALTER TABLE `users`
    MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
  --
  -- AUTO_INCREMENT for table `users_chat`
  --
  ALTER TABLE `users_chat`
    MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

CREATE TABLE user_blog (
  title varchar(255),
  blog_pic longblob,
  dates timestamp,
  blog_id bigint UNSIGNED,
  content text 
);

CREATE TABLE users_chat (
  msg_id int(11) NOT NULL,
  sender_username varchar(255) NOT NULL,
  receiver_username varchar(255) NOT NULL,
  msg_content varchar(255) NOT NULL,
  msg_status text NOT NULL,
  msg_date timestamp
);


CREATE TABLE recent_list (
  list_id serial PRIMARY KEY,
  list_owner varchar REFERENCES users(email),
  content text
);

CREATE TABLE friends (
  id serial PRIMARY KEY,
  sender text REFERENCES users(email),
  receiver text REFERENCES users(email),
  status SMALLINT
);

ALTER TABLE users
  ADD PRIMARY KEY (user_id);

ALTER TABLE user_blog
  ADD PRIMARY KEY (blog_id);


ALTER TABLE users_chat
  ADD PRIMARY KEY (msg_id);

ALTER TABLE users
  MODIFY user_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
  
ALTER TABLE user_blog
  MODIFY blog_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE users
  ADD image_text text;
