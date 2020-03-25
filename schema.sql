DROP TABLE IF EXISTS users, friends, messages, group, junction_table, blogfeed, personal;

CREATE DATABASE community_journal;

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


CREATE TABLE friends
(
    user_id serial,
    username varchar(255),
    online boolean,
    friend_request boolean,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


CREATE TABLE messages
(
    message_id serial PRIMARY KEY,
    sender_id serial,
    group_id serial,
    content varchar(255)
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
