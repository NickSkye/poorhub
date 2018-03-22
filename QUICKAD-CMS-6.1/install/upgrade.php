<?php
$q = "DROP TABLE IF EXISTS `".$config['db']['pre']."pages`";
@mysqli_query($mysqli,$q) or install_error('ERROR ('.mysqli_error($mysqli).')');

echo "Creating pages Table...  \t\t";
$table_pages = "CREATE TABLE `".$config['db']['pre']."pages` (
          `id` int(10) UNSIGNED NOT NULL,
          `translation_lang` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
          `translation_of` int(10) UNSIGNED DEFAULT NULL,
          `parent_id` int(10) UNSIGNED DEFAULT NULL,
          `type` enum('0','1') NOT NULL DEFAULT '0',
          `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
          `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
          `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
          `content` text COLLATE utf8_unicode_ci,
          `active` tinyint(1) DEFAULT '1',
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
@mysqli_query($mysqli,$table_pages) or install_error('ERROR ('.mysqli_error($mysqli).')');
echo "success<br>";

$sql = "ALTER TABLE `".$config['db']['pre']."pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translation_lang` (`translation_lang`),
  ADD KEY `translation_of` (`translation_of`),
  ADD KEY `parent_id` (`parent_id`)";
@mysqli_query($mysqli,$sql) or install_error('ERROR ('.mysqli_error($mysqli).')');
echo "success indexes<br>";

$sql2 = "ALTER TABLE `".$config['db']['pre']."pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
@mysqli_query($mysqli,$sql2) or install_error('ERROR ('.mysqli_error($mysqli).')');
echo "success AUTO_INCREMENT<br>";


$sql3 = "ALTER TABLE `".$config['db']['pre']."faq_entries`
        ADD `translation_lang` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `faq_id`, ADD `translation_of` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `translation_lang`, ADD `parent_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `translation_of`";
@mysqli_query($mysqli,$sql3) or install_error('ERROR ('.mysqli_error($mysqli).')');

$sql4 = "ALTER TABLE `".$config['db']['pre']."faq_entries`
        ADD INDEX( `translation_lang`, `translation_of`, `parent_id`)";
@mysqli_query($mysqli,$sql4) or install_error('ERROR ('.mysqli_error($mysqli).')');

$sql5 = "ALTER TABLE `".$config['db']['pre']."faq_entries`
        ADD `active` TINYINT(1) NULL DEFAULT '1' AFTER `faq_content`";
@mysqli_query($mysqli,$sql5) or install_error('ERROR ('.mysqli_error($mysqli).')');
echo "success ALTER TABLE faq_entries<br>";
?>