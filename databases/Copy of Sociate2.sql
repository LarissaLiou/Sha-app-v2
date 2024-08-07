CREATE TABLE `notifications` (
  `notification_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `sender_id` BIGINT,
  `notification_type` TINYINT NOT NULL COMMENT '0: like
1: comment
2: connection
3: mention
4: checking out
5: you might be interested',
  `content` TEXT NOT NULL,
  `is_read` BOOLEAN NOT NULL DEFAULT '0',
  `created_at` DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `events` (
  `event_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `event_name` TEXT NOT NULL,
  `min_price` BIGINT NOT NULL,
  `max_price` BIGINT COMMENT 'null if just use min_price',
  `min_attendees` BIGINT NOT NULL,
  `max_attendees` BIGINT COMMENT 'null means just use the min attenddees',
  `description` TEXT NOT NULL,
  `location` TEXT NOT NULL,
  `start` DATETIME NOT NULL,
  `end` DATETIME NOT NULL
);

CREATE TABLE `followers` (
  `follower_id` BIGINT NOT NULL COMMENT 'person following',
  `followee_id` BIGINT NOT NULL COMMENT 'person being followed',
  `time_followed` DATETIME NOT NULL,
  PRIMARY KEY (`follower_id`, `followee_id`)
);

CREATE TABLE `interests` (
  `interest_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `interest_name` TEXT NOT NULL,
  `category_id` BIGINT NOT NULL,
  `category_name` TEXT NOT NULL
);

CREATE TABLE `interest_categories` (
  `category_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `category_name` TEXT NOT NULL
);

CREATE TABLE `user_contact` (
  `user_id` BIGINT NOT NULL,
  `contact_method_id` BIGINT NOT NULL COMMENT '0:email
1:phone
2:',
  `contact` TEXT NOT NULL,
  PRIMARY KEY (`user_id`, `contact_method_id`)
);

CREATE TABLE `user_experiences` (
  `experience_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `position` TEXT NOT NULL,
  `organisation` TEXT NOT NULL,
  `started` DATE NOT NULL,
  `ended` DATE COMMENT 'if null, then position is until current',
  `image_path` TEXT NOT NULL
);

CREATE TABLE `events_types_junction` (
  `event_type_id` BIGINT NOT NULL,
  `event_id` BIGINT NOT NULL,
  PRIMARY KEY (`event_type_id`, `event_id`)
);

CREATE TABLE `user_details` (
  `user_id` BIGINT PRIMARY KEY NOT NULL,
  `age` SMALLINT NOT NULL,
  `about` TEXT NOT NULL,
  `desc` TEXT NOT NULL,
  `country` TEXT NOT NULL,
  `city` TEXT NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `status` TEXT NOT NULL,
  `profile_picture` TEXT NOT NULL
);

CREATE TABLE `users_interests_junction` (
  `user_id` BIGINT NOT NULL,
  `interest_id` BIGINT NOT NULL,
  PRIMARY KEY (`user_id`, `interest_id`)
);

CREATE TABLE `event_types` (
  `event_type_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `event_type` TEXT NOT NULL
);

CREATE TABLE `users` (
  `user_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_handle` TEXT NOT NULL,
  `username` TEXT NOT NULL,
  `email` TEXT NOT NULL,
  `password` TEXT NOT NULL COMMENT 'HASHED',
  `created_at` DATETIME NOT NULL
);

CREATE TABLE `users_skillset_junction` (
  `user_id` BIGINT NOT NULL,
  `skillset_id` BIGINT NOT NULL,
  PRIMARY KEY (`user_id`, `skillset_id`)
);

CREATE TABLE `skillsets` (
  `skillset_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `skillset` TEXT NOT NULL
);

CREATE TABLE `user_highlights` (
  `highlight_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `highlight` TEXT NOT NULL
);

CREATE TABLE `tokens` (
  `token_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `exp` DATETIME NOT NULL,
  `token` TEXT NOT NULL
);

CREATE TABLE `attendees` (
  `event_id` BIGINT NOT NULL,
  `user_id` BIGINT NOT NULL,
  `register_date` DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  PRIMARY KEY (`event_id`, `user_id`)
);

CREATE TABLE `messages` (
  `message_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `sender_id` BIGINT NOT NULL,
  `content` TEXT NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `conversation_id` BIGINT NOT NULL,
  `is_read` bool NOT NULL DEFAULT false
);

CREATE TABLE `conversations` (
  `conversation_id` BIGiNT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user1_id` BIGINT NOT NULL,
  `user2_id` BIGiNT NOT NULL,
  `created_at` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `connections` (
  `connection_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user1_id` BIGINT NOT NULL,
  `user2_id` BIGINT NOT NULL,
  `connected_at` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `connection_requests` (
  `request_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `notification_id` BIGINT NOT NULL,
  `user1_id` BIGINT NOT NULL,
  `user2_id` BIGINT NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `message_requests` (
  `request_id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `sender_id` BIGINT NOT NULL,
  `recipient_id` BIGINT NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE UNIQUE INDEX `connection_requests_index_0` ON `connection_requests` (`user1_id`, `user2_id`);

CREATE UNIQUE INDEX `message_requests_index_1` ON `message_requests` (`sender_id`, `recipient_id`);

ALTER TABLE `message_requests` ADD CONSTRAINT `message_requests_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `message_requests` ADD CONSTRAINT `message_requests_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `notifications` ADD CONSTRAINT `connection_requests_notification_id` FOREIGN KEY (`notification_id`) REFERENCES `connection_requests` (`notification_id`);

ALTER TABLE `connection_requests` ADD CONSTRAINT `connection_requests_user1_id_foreign` FOREIGN KEY (`user1_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `connection_requests` ADD CONSTRAINT `connection_requests_user2_id_foreign` FOREIGN KEY (`user2_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `connections` ADD CONSTRAINT `connections_user1_id_foreign` FOREIGN KEY (`user1_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `connections` ADD CONSTRAINT `connections_user2_id_foreign` FOREIGN KEY (`user2_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `conversations` ADD CONSTRAINT `conversations_user1_id_foreign` FOREIGN KEY (`user1_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `conversations` ADD CONSTRAINT `conversations_user2_id_foreign` FOREIGN KEY (`user2_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `messages` ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`);

ALTER TABLE `messages` ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `users_interests_junction` ADD CONSTRAINT `users_interests_junction_interest_id_foreign` FOREIGN KEY (`interest_id`) REFERENCES `interests` (`interest_id`);

ALTER TABLE `user_highlights` ADD CONSTRAINT `user_highlights_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `users_skillset_junction` ADD CONSTRAINT `skillsets_skillset_id_foreign` FOREIGN KEY (`skillset_id`) REFERENCES `skillsets` (`skillset_id`);

ALTER TABLE `users_skillset_junction` ADD CONSTRAINT `users_user_id_foreign1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `events_types_junction` ADD CONSTRAINT `events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

ALTER TABLE `users_interests_junction` ADD CONSTRAINT `users_user_id_foreign2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `notifications` ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `followers` ADD CONSTRAINT `users_user_id_foreign3` FOREIGN KEY (`followee_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `user_details` ADD CONSTRAINT `users_user_id_foreign4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `user_contact` ADD CONSTRAINT `users_user_id_foreign5` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `user_experiences` ADD CONSTRAINT `user_experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `notifications` ADD CONSTRAINT `notifications_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `followers` ADD CONSTRAINT `users_user_id_foreign6` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `events_types_junction` ADD CONSTRAINT `events_types_junction_event_type_id_foreign` FOREIGN KEY (`event_type_id`) REFERENCES `event_types` (`event_type_id`);

ALTER TABLE `tokens` ADD CONSTRAINT `tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `attendees` ADD CONSTRAINT `attendees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `attendees` ADD CONSTRAINT `attendees_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

ALTER TABLE `interests` ADD FOREIGN KEY (`category_id`) REFERENCES `interest_categories` (`category_id`);


--
-- Dumping data for table `interest_categories`, `interests`
--

INSERT INTO `interest_categories` (`category_id`, `category_name`) VALUES  (1, 'Art_and_Culture'), 
        (2, 'Career_and_Business'), 
        (3, 'Technology '),
        (4, 'Sports_and_Fitness '),
        (5, 'Food_and_Culinary_Arts ');



INSERT INTO `interests` (`interest_id`, `interest_name`, `category_id`, `category_name`) 
VALUES  (1, 'Digital Art', 1, 'Art_and_Culture'), 
        (2, 'Drawing', 1, 'Art_and_Culture'), 
        (3, 'Music', 1, 'Art_and_Culture'), 
        (4, 'Real Estate', 2, 'Career_and_Business'), 
        (5, 'Startup', 2, 'Career_and_Business'), 
        (6, 'Marketing', 2, 'Career_and_Business'),
        (7, 'Software Development', 3, 'Technology '),
        (8, 'Open Source', 3, 'Technology '),
        (9, 'Artificial Intelligent', 3, 'Technology '),
        (10, 'Basketball', 3, 'Sports_and_Fitness '),
        (11, 'Weightlifting', 3, 'Sports_and_Fitness '),
        (12, 'Yoga', 3, 'Sports_and_Fitness '),
        (13, 'Cooking', 3, 'Food_and_Culinary_Arts '),
        (14, 'Coffee', 3, 'Food_and_Culinary_Arts '),
        (15, 'Food Blogging', 3, ' Food_and_Culinary_Arts ');
 

