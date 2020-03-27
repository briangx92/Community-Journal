DROP TABLE IF EXISTS users, friends, messages, group, junction_table, blogfeed, personal;

CREATE DATABASE community-journal;

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

<<<<<<< HEAD
CREATE TABLE users
(
    user_id serial PRIMARY KEY,
    Fname varchar(50),
    Lname varchar(50),
    email varchar(50),
    phone varchar(50),
    username varchar(50),
    password varchar(50),
    country varchar(100),
    profile_pic LONGBLOB,
    headline varchar(75),
    bio varchar(200),
    gender varchar(250),
);
=======
>>>>>>> merge-messages

  ALTER TABLE `users`
    MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

  --
  -- AUTO_INCREMENT for table `users_chat`
  --
  ALTER TABLE `users_chat`
    MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

    

CREATE TABLE friends
(
    user_id serial,
    username varchar(255),
    online boolean,
    friend_request boolean,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


CREATE TABLE group
(
    group_id serial FOREIGN KEY (group_id) REFERENCES messages(group_id)
);


CREATE TABLE junction_table
(
    user_id serial,
    group_id serial,
    message_id serial,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (group_id) REFERENCES messages(group_id),
    FOREIGN KEY (message_id) REFERENCES messages(message_id)
);

CREATE TABLE blogfeed
(
    title varchar(255),
    blogpic LONGBLOB,
    Dates timestamp,
    blog_id serial PRIMARY KEY,
    commment varchar(255)
);

CREATE TABLE personal
(
  personal_id serial PRIMARY KEY,
  saved_drafts varchar(255),
  list varchar(255),
);
