-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 03. čen 2025, 20:32
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

import { neon } from '@netlify/neon';
const sql = neon(); // automatically uses env NETLIFY_DATABASE_URL
const [post] = await sql`SELECT * FROM posts WHERE id = ${postId}`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `database`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `cold_weapons`
--

CREATE TABLE `cold_weapons` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `material` text NOT NULL,
  `descript` text NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `cold_weapons`
--

INSERT INTO `cold_weapons` (`id`, `name`, `material`, `descript`, `picture`) VALUES
(1, 'Nůž', 'Ocel', 'Velmi efektivní zbraň na blízku, která se hodí při všech situacích.', 'weapon-images/683c8614b5ecbnuz.webp');

-- --------------------------------------------------------

--
-- Struktura tabulky `favorite_weapons`
--

CREATE TABLE `favorite_weapons` (
  `weapon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `weapon_type` enum('hot','cold') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `favorite_weapons`
--

INSERT INTO `favorite_weapons` (`weapon_id`, `user_id`, `weapon_name`, `weapon_type`) VALUES
(44, 2, 'Colt 1911', 'hot'),
(45, 2, 'Nůž', 'cold'),
(46, 1, 'Glock 17', 'hot');

-- --------------------------------------------------------

--
-- Struktura tabulky `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `creator` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `modern_weapons`
--

CREATE TABLE `modern_weapons` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `caliber` text NOT NULL,
  `descript` text NOT NULL,
  `rang` int(11) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `modern_weapons`
--

INSERT INTO `modern_weapons` (`id`, `name`, `caliber`, `descript`, `rang`, `picture`) VALUES
(1, 'Colt 1911', '.45 ACP', 'Tato pistole z roku 1911 od Johna M. Browninga je i přes své stáří velice oblíbenou pistolí mnoha jednotek v různých státech.\r\nPistole nabízí kapacitu zásobníku na 7+1 náboj, případně některé novější verze pak na 8+1 náboj.', 250, 'gun-images/683c83c3e11ad1911.webp'),
(2, 'Glock 17', '9 mm Luger', 'Tato pistole byla vytvořena v Rakousku jako náhrada za pistoli Walther P38 v 80. letech 20. století.\r\nJedná se o nejrozšířenější pistoli na světě, která je populární mj. i ve hrách či filmech.\r\nZásobník pojme obvykle 17 či 19 nábojů, některé verze Glocku 17 nabízejí však rozšířené zásobníky pro 31 či 33 nábojů (+ 1 do komory).', 360, 'gun-images/683c85043cf3eglock-17.jpg'),
(7, 'AK-47', '7,62 × 39 mm', 'Snad nejznámější střelná zbraň světa, celým svým názvem \"Avtomat Kalašnikova obrazca 1947 goda\" (Kalašnikův automat vzor 1947), která byla vytvořena právě v roce 1947.\r\nJe velmi oblíbená zejména na západě, a lidé této zbrani dali mnoho přezdívek - např. Kalach, Kalašnikov, atd.', 715, 'gun-images/683da74a64457ak47.jpeg');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `isadmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `isadmin`) VALUES
(1, 'Jan', 'email12345@email.com', '$2y$10$aWsXnlXYyi5x4hgorfce2.yudg3fSamiM0GfTw.KR4ykcANV4oWaa', 0),
(2, 'JanAdmin', 'email12345@email.com', '$2y$10$Nz1thK7YeUiYRciEKj.Ipesgh4RYoapdIjwCaDsWHbJcR8G0pzAlO', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `cold_weapons`
--
ALTER TABLE `cold_weapons`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `favorite_weapons`
--
ALTER TABLE `favorite_weapons`
  ADD PRIMARY KEY (`weapon_id`),
  ADD UNIQUE KEY `unique_favorite` (`user_id`,`weapon_name`);

--
-- Indexy pro tabulku `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexy pro tabulku `modern_weapons`
--
ALTER TABLE `modern_weapons`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `cold_weapons`
--
ALTER TABLE `cold_weapons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `favorite_weapons`
--
ALTER TABLE `favorite_weapons`
  MODIFY `weapon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pro tabulku `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `modern_weapons`
--
ALTER TABLE `modern_weapons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `favorite_weapons`
--
ALTER TABLE `favorite_weapons`
  ADD CONSTRAINT `favorite_weapons_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
