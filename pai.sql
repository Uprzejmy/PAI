-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2018 at 05:12 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pai`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

CREATE TABLE `blocked` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `login` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `blocked`
--
DELIMITER $$
CREATE TRIGGER `blocked_creation` BEFORE INSERT ON `blocked` FOR EACH ROW SET NEW.created_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `login` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `logins`
--
DELIMITER $$
CREATE TRIGGER `logins_creation` BEFORE INSERT ON `logins` FOR EACH ROW SET NEW.created_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `match_order` int(11) NOT NULL,
  `match_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `session_key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `token` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `sessions`
--
DELIMITER $$
CREATE TRIGGER `session_creation` BEFORE INSERT ON `sessions` FOR EACH ROW SET NEW.created_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `name` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `teams`
--
DELIMITER $$
CREATE TRIGGER `teams_creation` BEFORE INSERT ON `teams` FOR EACH ROW SET NEW.created_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teams_invites`
--

CREATE TABLE `teams_invites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `invited_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `teams_invites`
--
DELIMITER $$
CREATE TRIGGER `teams_invites_creation` BEFORE INSERT ON `teams_invites` FOR EACH ROW SET NEW.invited_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teams_matches`
--

CREATE TABLE `teams_matches` (
  `id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `scores` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams_members`
--

CREATE TABLE `teams_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `joined_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `teams_members`
--
DELIMITER $$
CREATE TRIGGER `teams_members_creation` BEFORE INSERT ON `teams_members` FOR EACH ROW SET NEW.joined_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teams_tournaments`
--

CREATE TABLE `teams_tournaments` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `joined_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `teams_tournaments`
--
DELIMITER $$
CREATE TRIGGER `teams_tournaments_creation` BEFORE INSERT ON `teams_tournaments` FOR EACH ROW SET NEW.joined_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `started` int(11) NOT NULL DEFAULT '0',
  `ended` int(11) NOT NULL DEFAULT '0',
  `winner_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `tournaments`
--
DELIMITER $$
CREATE TRIGGER `tournament_creation` BEFORE INSERT ON `tournaments` FOR EACH ROW SET NEW.created_at = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `registered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `users_registration` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.registered_at = NOW()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked`
--
ALTER TABLE `blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matches_tournaments_tournament_id` (`tournament_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id` (`leader_id`);

--
-- Indexes for table `teams_invites`
--
ALTER TABLE `teams_invites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_invites_unique` (`user_id`,`team_id`),
  ADD KEY `teams_invites_user_id` (`user_id`),
  ADD KEY `teams_invites_team_id` (`team_id`);

--
-- Indexes for table `teams_matches`
--
ALTER TABLE `teams_matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_matches_match_id` (`match_id`),
  ADD KEY `teams_matches_team_id` (`team_id`);

--
-- Indexes for table `teams_members`
--
ALTER TABLE `teams_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_members_unique` (`user_id`,`team_id`),
  ADD KEY `teams_members_user_id` (`user_id`),
  ADD KEY `teams_members_team_id` (`team_id`);

--
-- Indexes for table `teams_tournaments`
--
ALTER TABLE `teams_tournaments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_tournaments_unique` (`tournament_id`,`team_id`),
  ADD KEY `teams_tournaments_team_id` (`team_id`),
  ADD KEY `teams_tournaments_tournament_id` (`tournament_id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournaments_users_id` (`admin_id`),
  ADD KEY `tournaments_teams_id` (`winner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked`
--
ALTER TABLE `blocked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams_invites`
--
ALTER TABLE `teams_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams_matches`
--
ALTER TABLE `teams_matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams_members`
--
ALTER TABLE `teams_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams_tournaments`
--
ALTER TABLE `teams_tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_tournaments_tournament_id` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_leader_id` FOREIGN KEY (`leader_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teams_invites`
--
ALTER TABLE `teams_invites`
  ADD CONSTRAINT `teams_invites_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `teams_invites_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teams_matches`
--
ALTER TABLE `teams_matches`
  ADD CONSTRAINT `teams_matches_match_id` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`),
  ADD CONSTRAINT `teams_matches_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `teams_members`
--
ALTER TABLE `teams_members`
  ADD CONSTRAINT `teams_members_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `teams_members_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teams_tournaments`
--
ALTER TABLE `teams_tournaments`
  ADD CONSTRAINT `teams_tournaments_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `teams_tournaments_tournament_id` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Constraints for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournaments_teams_id` FOREIGN KEY (`winner_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `tournaments_users_id` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
