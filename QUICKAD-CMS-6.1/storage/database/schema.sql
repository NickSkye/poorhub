-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2016 at 07:49 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Quickadclassified`
--


--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `<<prefix>>cities`;
CREATE TABLE IF NOT EXISTS `<<prefix>>cities` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `country_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'ISO-3166 2-letter country code, 2 characters',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'name of geographical point (utf8) varchar(200)',
  `asciiname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name of geographical point in plain ascii characters, varchar(200)',
  `longitude` float DEFAULT NULL COMMENT 'longitude in decimal degrees (wgs84)',
  `latitude` float DEFAULT NULL COMMENT 'latitude in decimal degrees (wgs84)',
  `feature_class` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'see http://www.geonames.org/export/codes.html, char(1)',
  `feature_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'see http://www.geonames.org/export/codes.html, varchar(10)',
  `subadmin1_code` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'fipscode (subject to change to iso code), see exceptions below, see file admin1Codes.txt for display names of this code; varchar(20)',
  `subadmin2_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'code for the second administrative division, a county in the US, see file admin2Codes.txt; varchar(80)',
  `population` bigint(20) DEFAULT NULL COMMENT 'bigint (4 byte int) ',
  `time_zone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the timezone id (see file timeZone.txt)',
  `active` tinyint(3) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- Table structure for table `<<prefix>>countries`
--
DROP TABLE IF EXISTS `<<prefix>>countries`;
CREATE TABLE IF NOT EXISTS `<<prefix>>countries` (
  `id` int(10) unsigned NOT NULL,
  `code` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `iso3` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso_numeric` int(10) unsigned DEFAULT NULL,
  `fips` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asciiname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capital` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` int(10) unsigned DEFAULT NULL,
  `population` int(10) unsigned DEFAULT NULL,
  `continent_code` char(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tld` char(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code_format` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code_regex` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `languages` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighbours` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equivalent_fips_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `<<prefix>>currencies`
--

DROP TABLE IF EXISTS `<<prefix>>currencies`;
CREATE TABLE IF NOT EXISTS `<<prefix>>currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `html_entity` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'From Github : An array of currency symbols as HTML entities',
  `font_arial` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `font_code2000` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unicode_decimal` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unicode_hex` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `in_left` tinyint(1) DEFAULT '0',
  `decimal_places` int(10) UNSIGNED DEFAULT '2' COMMENT 'Currency Decimal Places - ISO 4217',
  `decimal_separator` varchar(10) COLLATE utf8_unicode_ci DEFAULT '.',
  `thousand_separator` varchar(10) COLLATE utf8_unicode_ci DEFAULT ',',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------


--
-- Table structure for table `<<prefix>>languages`
--

DROP TABLE IF EXISTS `<<prefix>>languages`;
CREATE TABLE IF NOT EXISTS `<<prefix>>languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `native` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `app_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `script` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `russian_pluralization` tinyint(1) UNSIGNED DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `<<prefix>>settings`
--

-- Table structure for table `<<prefix>>subadmin1`
--

DROP TABLE IF EXISTS `<<prefix>>subadmin1`;
CREATE TABLE IF NOT EXISTS `<<prefix>>subadmin1` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `asciiname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(3) unsigned DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `<<prefix>>subadmin2`
--

DROP TABLE IF EXISTS `<<prefix>>subadmin2`;
CREATE TABLE IF NOT EXISTS `<<prefix>>subadmin2` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asciiname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(3) unsigned DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `<<prefix>>time_zones`
--

DROP TABLE IF EXISTS `<<prefix>>time_zones`;
CREATE TABLE IF NOT EXISTS `<<prefix>>time_zones` (
  `id` int(10) unsigned NOT NULL,
  `country_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time_zone_id` varchar(40) COLLATE utf8_unicode_ci DEFAULT '',
  `gmt` float DEFAULT NULL,
  `dst` float DEFAULT NULL,
  `raw` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
--
-- Indexes for table `<<prefix>>cities`
--
ALTER TABLE `<<prefix>>cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_code` (`country_code`),
  ADD KEY `name` (`name`);


--
-- Indexes for table `<<prefix>>countries`
--
ALTER TABLE `<<prefix>>countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `<<prefix>>currencies`
--
ALTER TABLE `<<prefix>>currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);



--
-- Indexes for table `<<prefix>>languages`
--
ALTER TABLE `<<prefix>>languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abbr` (`abbr`);


--
-- Indexes for table `<<prefix>>subadmin1`
--
ALTER TABLE `<<prefix>>subadmin1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `<<prefix>>subadmin2`
--
ALTER TABLE `<<prefix>>subadmin2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `<<prefix>>time_zones`
--
ALTER TABLE `<<prefix>>time_zones`
  ADD PRIMARY KEY (`id`),
  ADD INDEX(`country_code`),
  ADD UNIQUE(`time_zone_id`);


--
-- AUTO_INCREMENT for table `<<prefix>>cities`
--
ALTER TABLE `<<prefix>>cities`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;


--
ALTER TABLE `<<prefix>>countries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `<<prefix>>currencies`
--
ALTER TABLE `<<prefix>>currencies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `<<prefix>>languages`
--
ALTER TABLE `<<prefix>>languages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `<<prefix>>subadmin1`
--
ALTER TABLE `<<prefix>>subadmin1`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `<<prefix>>subadmin2`
--
ALTER TABLE `<<prefix>>subadmin2`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `<<prefix>>time_zones`
--
ALTER TABLE `<<prefix>>time_zones`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;


  
  
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
