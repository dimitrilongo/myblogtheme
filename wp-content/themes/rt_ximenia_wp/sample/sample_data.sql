# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: wp_demo
# Generation Time: 2013-02-16 14:01:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table #__rokgallery_file_loves
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_file_loves`;

CREATE TABLE `#__rokgallery_file_loves` (
  `file_id` int(10) unsigned NOT NULL DEFAULT '0',
  `kount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `file_id` (`file_id`),
  CONSTRAINT `#__file_loves_file_id_files_id` FOREIGN KEY (`file_id`) REFERENCES `#__rokgallery_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table #__rokgallery_file_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_file_tags`;

CREATE TABLE `#__rokgallery_file_tags` (
  `file_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tag` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`file_id`,`tag`),
  KEY `#__rokgallery_file_tags_file_id_idx` (`file_id`),
  CONSTRAINT `#__file_tags_file_id_files_id` FOREIGN KEY (`file_id`) REFERENCES `#__rokgallery_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__rokgallery_file_tags` WRITE;
/*!40000 ALTER TABLE `#__rokgallery_file_tags` DISABLE KEYS */;

INSERT INTO `#__rokgallery_file_tags` (`file_id`, `tag`)
VALUES
	(9,'fp-rokgallery'),
	(10,'fp-rokgallery'),
	(11,'fp-rokgallery'),
	(12,'fp-rokgallery');

/*!40000 ALTER TABLE `#__rokgallery_file_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__rokgallery_file_views
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_file_views`;

CREATE TABLE `#__rokgallery_file_views` (
  `file_id` int(10) unsigned NOT NULL DEFAULT '0',
  `kount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `file_id` (`file_id`),
  CONSTRAINT `#__file_views_file_id__files_id` FOREIGN KEY (`file_id`) REFERENCES `#__rokgallery_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table #__rokgallery_files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_files`;

CREATE TABLE `#__rokgallery_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `guid` char(36) NOT NULL,
  `md5` char(32) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `license` varchar(255) DEFAULT NULL,
  `xsize` int(10) unsigned NOT NULL,
  `ysize` int(10) unsigned NOT NULL,
  `filesize` int(10) unsigned NOT NULL,
  `type` char(20) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `guid` (`guid`),
  UNIQUE KEY `#__files_sluggable_idx` (`slug`),
  KEY `#__rokgallery_files_published_idx` (`published`),
  KEY `#__rokgallery_files_md5_idx` (`md5`),
  KEY `#__rokgallery_files_guid_idx` (`guid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__rokgallery_files` WRITE;
/*!40000 ALTER TABLE `#__rokgallery_files` DISABLE KEYS */;

INSERT INTO `#__rokgallery_files` (`id`, `filename`, `guid`, `md5`, `title`, `description`, `license`, `xsize`, `ysize`, `filesize`, `type`, `published`, `created_at`, `updated_at`, `slug`)
VALUES
	(9,'img1.jpg','71098fd0-2533-4d82-a944-a795aa8dbe31','5ae93e54081ca79a4e9f89b60b141237','Image 1','',NULL,500,500,180937,'jpg',1,'2012-07-02 22:44:24','2012-07-02 22:44:34','img1'),
	(10,'img2.jpg','cef4f357-52c4-42b6-a02d-29891d73079b','5ae93e54081ca79a4e9f89b60b141237','Image 2','',NULL,500,500,180937,'jpg',1,'2012-07-02 22:44:24','2012-07-02 22:44:44','img2'),
	(11,'img3.jpg','fddba1ae-552f-4a1d-dd95-3fdd5107e62f','5ae93e54081ca79a4e9f89b60b141237','Image 3','',NULL,500,500,180937,'jpg',1,'2012-07-02 22:44:24','2012-07-02 22:44:55','img3'),
	(12,'img4.jpg','5cadcd7e-c6ff-4398-8095-df9414670ac8','5ae93e54081ca79a4e9f89b60b141237','Image 4','',NULL,500,500,180937,'jpg',1,'2012-07-02 22:44:24','2012-07-02 22:45:06','img4');

/*!40000 ALTER TABLE `#__rokgallery_files` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__rokgallery_files_index
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_files_index`;

CREATE TABLE `#__rokgallery_files_index` (
  `keyword` varchar(200) NOT NULL DEFAULT '',
  `field` varchar(50) NOT NULL DEFAULT '',
  `position` bigint(20) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`keyword`,`field`,`position`,`id`),
  KEY `#__rokgallery_files_index_id_idx` (`id`),
  CONSTRAINT `#__rokgallery_files_index_id_idx` FOREIGN KEY (`id`) REFERENCES `#__rokgallery_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__rokgallery_files_index` WRITE;
/*!40000 ALTER TABLE `#__rokgallery_files_index` DISABLE KEYS */;

INSERT INTO `#__rokgallery_files_index` (`keyword`, `field`, `position`, `id`)
VALUES
	('1','title',1,9),
	('image','title',0,9),
	('2','title',1,10),
	('image','title',0,10),
	('3','title',1,11),
	('image','title',0,11),
	('4','title',1,12),
	('image','title',0,12);

/*!40000 ALTER TABLE `#__rokgallery_files_index` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__rokgallery_filters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_filters`;

CREATE TABLE `#__rokgallery_filters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `query` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rokgallery_profiles_name_idx` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table #__rokgallery_galleries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_galleries`;

CREATE TABLE `#__rokgallery_galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `filetags` longtext,
  `width` int(10) unsigned NOT NULL DEFAULT '910',
  `height` int(10) unsigned NOT NULL DEFAULT '500',
  `keep_aspect` tinyint(1) DEFAULT '0',
  `force_image_size` tinyint(1) DEFAULT '0',
  `thumb_xsize` int(10) unsigned NOT NULL DEFAULT '190',
  `thumb_ysize` int(10) unsigned NOT NULL DEFAULT '150',
  `thumb_background` varchar(12) DEFAULT NULL,
  `thumb_keep_aspect` tinyint(1) DEFAULT '0',
  `auto_publish` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `#__rokgallery_galleries_auto_publish_idx` (`auto_publish`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__rokgallery_galleries` WRITE;
/*!40000 ALTER TABLE `#__rokgallery_galleries` DISABLE KEYS */;

INSERT INTO `#__rokgallery_galleries` (`id`, `name`, `filetags`, `width`, `height`, `keep_aspect`, `force_image_size`, `thumb_xsize`, `thumb_ysize`, `thumb_background`, `thumb_keep_aspect`, `auto_publish`)
VALUES
	(1,'FP RokGallery','a:1:{i:0;s:13:\"fp-rokgallery\";}',500,500,0,0,143,143,'transparent',0,1);

/*!40000 ALTER TABLE `#__rokgallery_galleries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__rokgallery_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_jobs`;

CREATE TABLE `#__rokgallery_jobs` (
  `id` char(36) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL,
  `properties` text,
  `state` varchar(255) NOT NULL,
  `status` text,
  `percent` bigint(20) unsigned DEFAULT NULL,
  `sm` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table #__rokgallery_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_profiles`;

CREATE TABLE `#__rokgallery_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `profile` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `#__rokgallery_profiles_name_idx` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table #__rokgallery_schema_version
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_schema_version`;

CREATE TABLE `#__rokgallery_schema_version` (
  `version` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__rokgallery_schema_version` WRITE;
/*!40000 ALTER TABLE `#__rokgallery_schema_version` DISABLE KEYS */;

INSERT INTO `#__rokgallery_schema_version` (`version`)
VALUES
	(2);

/*!40000 ALTER TABLE `#__rokgallery_schema_version` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__rokgallery_slice_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_slice_tags`;

CREATE TABLE `#__rokgallery_slice_tags` (
  `slice_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tag` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`slice_id`,`tag`),
  KEY `rokgallery_slice_tags_slice_id_idx` (`slice_id`),
  CONSTRAINT `#__slice_tags_slice_id_slices_id` FOREIGN KEY (`slice_id`) REFERENCES `#__rokgallery_slices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table #__rokgallery_slices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_slices`;

CREATE TABLE `#__rokgallery_slices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned NOT NULL,
  `gallery_id` int(10) unsigned DEFAULT NULL,
  `guid` char(36) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `caption` text,
  `link` text,
  `filesize` int(10) unsigned NOT NULL,
  `xsize` int(10) unsigned NOT NULL,
  `ysize` int(10) unsigned NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `admin_thumb` tinyint(1) NOT NULL DEFAULT '0',
  `manipulations` longtext,
  `palette` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `thumb_xsize` int(10) unsigned NOT NULL,
  `thumb_ysize` int(10) unsigned NOT NULL,
  `thumb_keep_aspect` tinyint(1) NOT NULL DEFAULT '1',
  `thumb_background` varchar(12) DEFAULT NULL,
  `ordering` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `guid` (`guid`),
  UNIQUE KEY `#__rokgallery_slices_sluggable_idx` (`slug`,`gallery_id`),
  KEY `rokgallery_slices_published_idx` (`published`),
  KEY `rokgallery_slices_guid_idx` (`guid`),
  KEY `file_id_idx` (`file_id`),
  KEY `gallery_id_idx` (`gallery_id`),
  CONSTRAINT `#__slices_file_id_files_id` FOREIGN KEY (`file_id`) REFERENCES `#__rokgallery_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `#__slices_gallery_id_galleries_id` FOREIGN KEY (`gallery_id`) REFERENCES `#__rokgallery_galleries` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__rokgallery_slices` WRITE;
/*!40000 ALTER TABLE `#__rokgallery_slices` DISABLE KEYS */;

INSERT INTO `#__rokgallery_slices` (`id`, `file_id`, `gallery_id`, `guid`, `title`, `caption`, `link`, `filesize`, `xsize`, `ysize`, `published`, `admin_thumb`, `manipulations`, `palette`, `created_at`, `updated_at`, `slug`, `thumb_xsize`, `thumb_ysize`, `thumb_keep_aspect`, `thumb_background`, `ordering`)
VALUES
	(17,9,NULL,'0c0fceba-926e-4696-b3bc-36f3d18cd9ca','Admin Thumbnail','Admin Thumbnail',NULL,51305,300,180,0,1,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:60;s:5:\"width\";i:300;s:6:\"height\";i:180;s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:44:24','2012-07-02 22:44:24','admin-thumbnail',150,150,1,NULL,3),
	(18,10,NULL,'af80a44b-ef31-4d06-93e5-b253c6503423','Admin Thumbnail','Admin Thumbnail',NULL,51305,300,180,0,1,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:60;s:5:\"width\";i:300;s:6:\"height\";i:180;s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:44:24','2012-07-02 22:44:24','admin-thumbnail-1',150,150,1,NULL,2),
	(19,11,NULL,'f2a85e47-ecda-4782-85fd-59dc9df599e5','Admin Thumbnail','Admin Thumbnail',NULL,51305,300,180,0,1,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:60;s:5:\"width\";i:300;s:6:\"height\";i:180;s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:44:24','2012-07-02 22:44:24','admin-thumbnail-2',150,150,1,NULL,1),
	(20,12,NULL,'2d8576c7-0b67-4565-cde0-a25ba5bd0a59','Admin Thumbnail','Admin Thumbnail',NULL,51305,300,180,0,1,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:60;s:5:\"width\";i:300;s:6:\"height\";i:180;s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:44:24','2012-07-02 22:44:24','admin-thumbnail-3',150,150,1,NULL,0),
	(21,9,1,'d71078d6-28f0-4744-b961-9d98c22bea1c','Image 1','',NULL,226949,500,500,1,0,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:0;s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:45:14','2012-07-02 22:45:14','image-1',143,143,0,'transparent',3),
	(22,10,1,'14c55bb4-3513-4b51-c305-4e837d6d2269','Image 2','',NULL,226949,500,500,1,0,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:0;s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:45:14','2012-07-02 22:45:14','image-2',143,143,0,'transparent',2),
	(23,12,1,'17cbef3b-a7c6-4e74-a9f1-d368738a046d','Image 4','',NULL,226949,500,500,1,0,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:0;s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:45:14','2012-07-02 22:45:14','image-4',143,143,0,'transparent',1),
	(24,11,1,'70a00633-32f8-409b-8352-08da4c5f028a','Image 3','',NULL,226949,500,500,1,0,'a:2:{i:0;O:37:\"RokGallery_Manipulation_Action_Resize\":4:{s:7:\"\0*\0type\";s:6:\"resize\";s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}i:1;O:35:\"RokGallery_Manipulation_Action_Crop\":6:{s:7:\"\0*\0type\";s:4:\"crop\";s:4:\"left\";i:0;s:3:\"top\";i:0;s:5:\"width\";s:3:\"500\";s:6:\"height\";s:3:\"500\";s:8:\"\0*\0setup\";b:1;}}',NULL,'2012-07-02 22:45:14','2012-07-02 22:45:14','image-3',143,143,0,'transparent',0);

/*!40000 ALTER TABLE `#__rokgallery_slices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__rokgallery_slices_index
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__rokgallery_slices_index`;

CREATE TABLE `#__rokgallery_slices_index` (
  `keyword` varchar(200) NOT NULL DEFAULT '',
  `field` varchar(50) NOT NULL DEFAULT '',
  `position` bigint(20) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`keyword`,`field`,`position`,`id`),
  KEY `rokgallery_slices_index_id_idx` (`id`),
  CONSTRAINT `#__rokgallery_slices_index_id_idx` FOREIGN KEY (`id`) REFERENCES `#__rokgallery_slices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__rokgallery_slices_index` WRITE;
/*!40000 ALTER TABLE `#__rokgallery_slices_index` DISABLE KEYS */;

INSERT INTO `#__rokgallery_slices_index` (`keyword`, `field`, `position`, `id`)
VALUES
	('admin','caption',0,17),
	('admin','title',0,17),
	('thumbnail','caption',1,17),
	('thumbnail','title',1,17),
	('admin','caption',0,18),
	('admin','title',0,18),
	('thumbnail','caption',1,18),
	('thumbnail','title',1,18),
	('admin','caption',0,19),
	('admin','title',0,19),
	('thumbnail','caption',1,19),
	('thumbnail','title',1,19),
	('admin','caption',0,20),
	('admin','title',0,20),
	('thumbnail','caption',1,20),
	('thumbnail','title',1,20),
	('1','title',1,21),
	('image','title',0,21),
	('2','title',1,22),
	('image','title',0,22),
	('4','title',1,23),
	('image','title',0,23),
	('3','title',1,24),
	('image','title',0,24);

/*!40000 ALTER TABLE `#__rokgallery_slices_index` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__roksprocket
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__roksprocket`;

CREATE TABLE `#__roksprocket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__roksprocket` WRITE;
/*!40000 ALTER TABLE `#__roksprocket` DISABLE KEYS */;

INSERT INTO `#__roksprocket` (`id`, `title`, `modified`, `params`)
VALUES
	(16,'RokSprocket Mosaic','2013-02-16 12:06:02','{\"provider\":\"wordpress\",\"layout\":\"mosaic\",\"wordpress_articles\":{\"1\":{\"root\":{\"article\":\"27\"}},\"2\":{\"root\":{\"article\":\"7\"}},\"3\":{\"root\":{\"article\":\"542\"}},\"4\":{\"root\":{\"article\":\"1336\"}},\"5\":{\"root\":{\"article\":\"94\"}},\"6\":{\"root\":{\"article\":\"36\"}},\"7\":{\"root\":{\"article\":\"33\"}},\"8\":{\"root\":{\"article\":\"39\"}},\"9\":{\"root\":{\"article\":\"1338\"}}},\"wordpress_sort\":\"manual\",\"wordpress_sort_manual_append\":\"after\",\"headlines_themes\":\"default\",\"tabs_themes\":\"default\",\"mosaic_themes\":\"default\",\"lists_themes\":\"default\",\"tabs_position\":\"top\",\"lists_enable_accordion\":\"1\",\"display_limit\":\"12\",\"features_themes\":\"slideshow\",\"headlines_label_text\":\"\",\"features_show_title\":\"1\",\"lists_previews_length\":\"20\",\"headlines_previews_length\":\"20\",\"tabs_animation\":\"slideandfade\",\"lists_strip_html_tags\":\"1\",\"lists_items_per_page\":\"5\",\"mosaic_columns\":\"3\",\"tabs_autoplay\":\"0\",\"features_show_article_text\":\"1\",\"headlines_show_arrows\":\"show\",\"features_previews_length\":\"\\u221e\",\"features_strip_html_tags\":\"1\",\"headlines_animation\":\"slideandfade\",\"lists_show_arrows\":\"show\",\"mosaic_previews_length\":\"38\",\"tabs_autoplay_delay\":\"5\",\"features_show_arrows\":\"show\",\"mosaic_strip_html_tags\":\"1\",\"mosaic_items_per_page\":\"6\",\"lists_show_pagination\":\"1\",\"features_show_pagination\":\"1\",\"headlines_autoplay\":\"0\",\"tabs_resize_enable\":\"0\",\"tabs_resize_width\":\"0\",\"tabs_resize_height\":\"0\",\"mosaic_article_details\":\"0\",\"features_animation\":\"crossfade\",\"headlines_autoplay_delay\":\"5\",\"tabs_previews_length\":\"0\",\"lists_autoplay\":\"0\",\"tabs_strip_html_tags\":\"0\",\"features_autoplay\":\"1\",\"lists_autoplay_delay\":\"5\",\"headlines_resize_enable\":\"0\",\"headlines_resize_width\":\"0\",\"headlines_resize_height\":\"0\",\"features_autoplay_delay\":\"5\",\"lists_resize_enable\":\"0\",\"lists_resize_width\":\"0\",\"lists_resize_height\":\"0\",\"features_resize_enable\":\"0\",\"features_resize_width\":\"0\",\"features_resize_height\":\"0\",\"headlines_description_default\":\"primary\",\"features_title_default\":\"title\",\"tabs_title_default\":\"title\",\"headlines_image_default\":\"primary\",\"lists_title_default\":\"title\",\"features_description_default\":\"primary\",\"lists_description_default\":\"primary\",\"headlines_image_default_custom\":\"\",\"lists_image_default\":\"primary\",\"tabs_icon_default\":\"primary\",\"features_image_default\":\"primary\",\"tabs_icon_default_custom\":\"\",\"lists_image_default_custom\":\"\",\"headlines_link_default\":\"primary\",\"lists_link_default\":\"primary\",\"headlines_link_default_custom\":\"\",\"features_image_default_custom\":\"\",\"tabs_link_default\":\"primary\",\"lists_link_default_custom\":\"\",\"features_link_default\":\"primary\",\"tabs_link_default_custom\":\"\",\"features_link_default_custom\":\"\",\"mosaic_resize_enable\":\"0\",\"mosaic_resize_width\":\"0\",\"mosaic_resize_height\":\"0\",\"mosaic_title_default\":\"title\",\"tabs_description_default\":\"primary\",\"mosaic_description_default\":\"primary\",\"mosaic_image_default\":\"primary\",\"mosaic_image_default_custom\":\"\",\"mosaic_link_default\":\"primary\",\"mosaic_link_default_custom\":\"\",\"mosaic_animations\":[\"fade\",\"scale\",\"rotate\"],\"mosaic_ordering\":[\"default\",\"title\",\"date\",\"random\"]}'),
	(17,'FP Top A - RokSprocket Headlines','2013-02-16 12:07:47','{\"provider\":\"wordpress\",\"layout\":\"headlines\",\"wordpress_filters\":{\"1\":{\"root\":{\"category\":\"3\"}}},\"wordpress_sort\":\"automatic\",\"wordpress_sort_manual_append\":\"after\",\"headlines_themes\":\"default\",\"tabs_themes\":\"default\",\"mosaic_themes\":\"default\",\"lists_themes\":\"default\",\"tabs_position\":\"top\",\"lists_enable_accordion\":\"1\",\"display_limit\":\"\\u221e\",\"features_themes\":\"slideshow\",\"headlines_label_text\":\"Newsflash\",\"features_show_title\":\"1\",\"lists_previews_length\":\"20\",\"headlines_previews_length\":\"9\",\"tabs_animation\":\"slideandfade\",\"lists_strip_html_tags\":\"1\",\"lists_items_per_page\":\"5\",\"mosaic_columns\":\"3\",\"tabs_autoplay\":\"0\",\"features_show_article_text\":\"1\",\"headlines_show_arrows\":\"show\",\"features_previews_length\":\"\\u221e\",\"features_strip_html_tags\":\"1\",\"headlines_animation\":\"slideandfade\",\"lists_show_arrows\":\"show\",\"mosaic_previews_length\":\"20\",\"tabs_autoplay_delay\":\"5\",\"features_show_arrows\":\"show\",\"mosaic_strip_html_tags\":\"1\",\"mosaic_items_per_page\":\"5\",\"lists_show_pagination\":\"1\",\"features_show_pagination\":\"1\",\"headlines_autoplay\":\"0\",\"tabs_resize_enable\":\"0\",\"tabs_resize_width\":\"0\",\"tabs_resize_height\":\"0\",\"mosaic_article_details\":\"0\",\"features_animation\":\"crossfade\",\"headlines_autoplay_delay\":\"5\",\"tabs_previews_length\":\"0\",\"lists_autoplay\":\"0\",\"tabs_strip_html_tags\":\"0\",\"features_autoplay\":\"1\",\"lists_autoplay_delay\":\"5\",\"headlines_resize_enable\":\"0\",\"headlines_resize_width\":\"0\",\"headlines_resize_height\":\"0\",\"features_autoplay_delay\":\"5\",\"lists_resize_enable\":\"0\",\"lists_resize_width\":\"0\",\"lists_resize_height\":\"0\",\"features_resize_enable\":\"0\",\"features_resize_width\":\"0\",\"features_resize_height\":\"0\",\"headlines_description_default\":\"primary\",\"features_title_default\":\"title\",\"tabs_title_default\":\"title\",\"headlines_image_default\":\"primary\",\"lists_title_default\":\"title\",\"features_description_default\":\"primary\",\"lists_description_default\":\"primary\",\"headlines_image_default_custom\":\"\",\"lists_image_default\":\"primary\",\"tabs_icon_default\":\"primary\",\"features_image_default\":\"primary\",\"tabs_icon_default_custom\":\"\",\"lists_image_default_custom\":\"\",\"headlines_link_default\":\"primary\",\"lists_link_default\":\"primary\",\"headlines_link_default_custom\":\"\",\"features_image_default_custom\":\"\",\"tabs_link_default\":\"primary\",\"lists_link_default_custom\":\"\",\"features_link_default\":\"primary\",\"tabs_link_default_custom\":\"\",\"features_link_default_custom\":\"\",\"mosaic_resize_enable\":\"0\",\"mosaic_resize_width\":\"0\",\"mosaic_resize_height\":\"0\",\"mosaic_title_default\":\"title\",\"tabs_description_default\":\"primary\",\"mosaic_description_default\":\"primary\",\"mosaic_image_default\":\"primary\",\"mosaic_image_default_custom\":\"\",\"mosaic_link_default\":\"primary\",\"mosaic_link_default_custom\":\"\",\"mosaic_animations\":[\"fade\",\"scale\",\"rotate\"],\"mosaic_ordering\":[\"default\",\"title\",\"date\",\"random\"]}'),
	(18,'Ximenia Guide','2013-02-16 12:10:05','{\"provider\":\"wordpress\",\"layout\":\"tabs\",\"wordpress_filters\":{\"1\":{\"root\":{\"category\":\"5\"}}},\"wordpress_sort\":\"automatic\",\"wordpress_sort_manual_append\":\"after\",\"headlines_themes\":\"default\",\"tabs_themes\":\"default\",\"mosaic_themes\":\"default\",\"lists_themes\":\"default\",\"tabs_position\":\"top\",\"lists_enable_accordion\":\"1\",\"display_limit\":\"\\u221e\",\"features_themes\":\"slideshow\",\"headlines_label_text\":\"\",\"features_show_title\":\"1\",\"lists_previews_length\":\"20\",\"headlines_previews_length\":\"20\",\"tabs_animation\":\"slideandfade\",\"lists_strip_html_tags\":\"1\",\"lists_items_per_page\":\"5\",\"mosaic_columns\":\"3\",\"tabs_autoplay\":\"0\",\"features_show_article_text\":\"1\",\"headlines_show_arrows\":\"show\",\"features_previews_length\":\"\\u221e\",\"features_strip_html_tags\":\"1\",\"headlines_animation\":\"slideandfade\",\"lists_show_arrows\":\"show\",\"mosaic_previews_length\":\"20\",\"tabs_autoplay_delay\":\"5\",\"features_show_arrows\":\"show\",\"mosaic_strip_html_tags\":\"1\",\"mosaic_items_per_page\":\"5\",\"lists_show_pagination\":\"1\",\"features_show_pagination\":\"1\",\"headlines_autoplay\":\"0\",\"tabs_resize_enable\":\"0\",\"tabs_resize_width\":\"0\",\"tabs_resize_height\":\"0\",\"mosaic_article_details\":\"0\",\"features_animation\":\"crossfade\",\"headlines_autoplay_delay\":\"5\",\"tabs_previews_length\":\"0\",\"lists_autoplay\":\"0\",\"tabs_strip_html_tags\":\"0\",\"features_autoplay\":\"1\",\"lists_autoplay_delay\":\"5\",\"headlines_resize_enable\":\"0\",\"headlines_resize_width\":\"0\",\"headlines_resize_height\":\"0\",\"features_autoplay_delay\":\"5\",\"lists_resize_enable\":\"0\",\"lists_resize_width\":\"0\",\"lists_resize_height\":\"0\",\"features_resize_enable\":\"0\",\"features_resize_width\":\"0\",\"features_resize_height\":\"0\",\"headlines_description_default\":\"primary\",\"features_title_default\":\"title\",\"tabs_title_default\":\"title\",\"headlines_image_default\":\"primary\",\"lists_title_default\":\"title\",\"features_description_default\":\"primary\",\"lists_description_default\":\"primary\",\"headlines_image_default_custom\":\"\",\"lists_image_default\":\"primary\",\"tabs_icon_default\":\"primary\",\"features_image_default\":\"primary\",\"tabs_icon_default_custom\":\"\",\"lists_image_default_custom\":\"\",\"headlines_link_default\":\"primary\",\"lists_link_default\":\"primary\",\"headlines_link_default_custom\":\"\",\"features_image_default_custom\":\"\",\"tabs_link_default\":\"none\",\"lists_link_default_custom\":\"\",\"features_link_default\":\"primary\",\"tabs_link_default_custom\":\"\",\"features_link_default_custom\":\"\",\"mosaic_resize_enable\":\"0\",\"mosaic_resize_width\":\"0\",\"mosaic_resize_height\":\"0\",\"mosaic_title_default\":\"title\",\"tabs_description_default\":\"primary\",\"mosaic_description_default\":\"primary\",\"mosaic_image_default\":\"primary\",\"mosaic_image_default_custom\":\"\",\"mosaic_link_default\":\"primary\",\"mosaic_link_default_custom\":\"\",\"mosaic_animations\":[\"fade\",\"scale\",\"rotate\"],\"mosaic_ordering\":[\"default\",\"title\",\"date\",\"random\"]}'),
	(19,'FP Showcase A - RokSprocket Features','2013-02-16 12:27:18','{\"provider\":\"wordpress\",\"layout\":\"features\",\"wordpress_articles\":{\"1\":{\"root\":{\"article\":\"27\"}},\"2\":{\"root\":{\"article\":\"7\"}},\"3\":{\"root\":{\"article\":\"94\"}}},\"wordpress_sort\":\"manual\",\"wordpress_sort_manual_append\":\"after\",\"headlines_themes\":\"default\",\"tabs_themes\":\"default\",\"mosaic_themes\":\"default\",\"lists_themes\":\"default\",\"tabs_position\":\"top\",\"lists_enable_accordion\":\"1\",\"display_limit\":\"\\u221e\",\"features_themes\":\"showcase\",\"headlines_label_text\":\"\",\"features_show_title\":\"1\",\"lists_previews_length\":\"20\",\"headlines_previews_length\":\"20\",\"tabs_animation\":\"slideandfade\",\"lists_strip_html_tags\":\"1\",\"lists_items_per_page\":\"5\",\"mosaic_columns\":\"3\",\"tabs_autoplay\":\"0\",\"features_show_article_text\":\"1\",\"headlines_show_arrows\":\"show\",\"features_previews_length\":\"\\u221e\",\"features_strip_html_tags\":\"1\",\"headlines_animation\":\"slideandfade\",\"lists_show_arrows\":\"show\",\"mosaic_previews_length\":\"20\",\"tabs_autoplay_delay\":\"5\",\"features_show_arrows\":\"show\",\"mosaic_strip_html_tags\":\"1\",\"mosaic_items_per_page\":\"5\",\"lists_show_pagination\":\"1\",\"features_show_pagination\":\"1\",\"headlines_autoplay\":\"0\",\"tabs_resize_enable\":\"0\",\"tabs_resize_width\":\"0\",\"tabs_resize_height\":\"0\",\"mosaic_article_details\":\"0\",\"features_animation\":\"crossfade\",\"headlines_autoplay_delay\":\"5\",\"tabs_previews_length\":\"0\",\"lists_autoplay\":\"0\",\"tabs_strip_html_tags\":\"0\",\"features_autoplay\":\"0\",\"lists_autoplay_delay\":\"5\",\"headlines_resize_enable\":\"0\",\"headlines_resize_width\":\"0\",\"headlines_resize_height\":\"0\",\"features_autoplay_delay\":\"5\",\"lists_resize_enable\":\"0\",\"lists_resize_width\":\"0\",\"lists_resize_height\":\"0\",\"features_resize_enable\":\"0\",\"features_resize_width\":\"0\",\"features_resize_height\":\"0\",\"headlines_description_default\":\"primary\",\"features_title_default\":\"title\",\"tabs_title_default\":\"title\",\"headlines_image_default\":\"primary\",\"lists_title_default\":\"title\",\"features_description_default\":\"primary\",\"lists_description_default\":\"primary\",\"headlines_image_default_custom\":\"\",\"lists_image_default\":\"primary\",\"tabs_icon_default\":\"primary\",\"features_image_default\":\"primary\",\"tabs_icon_default_custom\":\"\",\"lists_image_default_custom\":\"\",\"headlines_link_default\":\"primary\",\"lists_link_default\":\"primary\",\"headlines_link_default_custom\":\"\",\"features_image_default_custom\":\"\",\"tabs_link_default\":\"primary\",\"lists_link_default_custom\":\"\",\"features_link_default\":\"primary\",\"tabs_link_default_custom\":\"\",\"features_link_default_custom\":\"\",\"mosaic_resize_enable\":\"0\",\"mosaic_resize_width\":\"0\",\"mosaic_resize_height\":\"0\",\"mosaic_title_default\":\"title\",\"tabs_description_default\":\"primary\",\"mosaic_description_default\":\"primary\",\"mosaic_image_default\":\"primary\",\"mosaic_image_default_custom\":\"\",\"mosaic_link_default\":\"primary\",\"mosaic_link_default_custom\":\"\",\"mosaic_animations\":[\"fade\",\"scale\",\"rotate\"],\"mosaic_ordering\":[\"default\",\"title\",\"date\",\"random\"]}'),
	(20,'FP MainTop A - RokSprocket Tabs','2013-02-16 12:31:55','{\"provider\":\"wordpress\",\"layout\":\"tabs\",\"wordpress_filters\":{\"1\":{\"root\":{\"category\":\"4\"}}},\"wordpress_sort\":\"manual\",\"wordpress_sort_manual_append\":\"after\",\"headlines_themes\":\"default\",\"tabs_themes\":\"default\",\"mosaic_themes\":\"default\",\"lists_themes\":\"default\",\"tabs_position\":\"top\",\"lists_enable_accordion\":\"1\",\"display_limit\":\"\\u221e\",\"features_themes\":\"slideshow\",\"headlines_label_text\":\"\",\"features_show_title\":\"1\",\"lists_previews_length\":\"20\",\"headlines_previews_length\":\"20\",\"tabs_animation\":\"slideandfade\",\"lists_strip_html_tags\":\"1\",\"lists_items_per_page\":\"5\",\"mosaic_columns\":\"3\",\"tabs_autoplay\":\"0\",\"features_show_article_text\":\"1\",\"headlines_show_arrows\":\"show\",\"features_previews_length\":\"\\u221e\",\"features_strip_html_tags\":\"1\",\"headlines_animation\":\"slideandfade\",\"lists_show_arrows\":\"show\",\"mosaic_previews_length\":\"20\",\"tabs_autoplay_delay\":\"5\",\"features_show_arrows\":\"show\",\"mosaic_strip_html_tags\":\"1\",\"mosaic_items_per_page\":\"5\",\"lists_show_pagination\":\"1\",\"features_show_pagination\":\"1\",\"headlines_autoplay\":\"0\",\"tabs_resize_enable\":\"0\",\"tabs_resize_width\":\"0\",\"tabs_resize_height\":\"0\",\"mosaic_article_details\":\"0\",\"features_animation\":\"crossfade\",\"headlines_autoplay_delay\":\"5\",\"tabs_previews_length\":\"0\",\"lists_autoplay\":\"0\",\"tabs_strip_html_tags\":\"0\",\"features_autoplay\":\"1\",\"lists_autoplay_delay\":\"5\",\"headlines_resize_enable\":\"0\",\"headlines_resize_width\":\"0\",\"headlines_resize_height\":\"0\",\"features_autoplay_delay\":\"5\",\"lists_resize_enable\":\"0\",\"lists_resize_width\":\"0\",\"lists_resize_height\":\"0\",\"features_resize_enable\":\"0\",\"features_resize_width\":\"0\",\"features_resize_height\":\"0\",\"headlines_description_default\":\"primary\",\"features_title_default\":\"title\",\"tabs_title_default\":\"title\",\"headlines_image_default\":\"primary\",\"lists_title_default\":\"title\",\"features_description_default\":\"primary\",\"lists_description_default\":\"primary\",\"headlines_image_default_custom\":\"\",\"lists_image_default\":\"primary\",\"tabs_icon_default\":\"primary\",\"features_image_default\":\"primary\",\"tabs_icon_default_custom\":\"\",\"lists_image_default_custom\":\"\",\"headlines_link_default\":\"primary\",\"lists_link_default\":\"primary\",\"headlines_link_default_custom\":\"\",\"features_image_default_custom\":\"\",\"tabs_link_default\":\"none\",\"lists_link_default_custom\":\"\",\"features_link_default\":\"primary\",\"tabs_link_default_custom\":\"\",\"features_link_default_custom\":\"\",\"mosaic_resize_enable\":\"0\",\"mosaic_resize_width\":\"0\",\"mosaic_resize_height\":\"0\",\"mosaic_title_default\":\"title\",\"tabs_description_default\":\"primary\",\"mosaic_description_default\":\"primary\",\"mosaic_image_default\":\"primary\",\"mosaic_image_default_custom\":\"\",\"mosaic_link_default\":\"primary\",\"mosaic_link_default_custom\":\"\",\"mosaic_animations\":[\"fade\",\"scale\",\"rotate\"],\"mosaic_ordering\":[\"default\",\"title\",\"date\",\"random\"]}');

/*!40000 ALTER TABLE `#__roksprocket` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table #__roksprocket_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `#__roksprocket_items`;

CREATE TABLE `#__roksprocket_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` varchar(45) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `provider_id` varchar(45) NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `params` text,
  PRIMARY KEY (`id`),
  KEY `idx_module` (`widget_id`),
  KEY `idx_module_order` (`widget_id`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `#__roksprocket_items` WRITE;
/*!40000 ALTER TABLE `#__roksprocket_items` DISABLE KEYS */;

INSERT INTO `#__roksprocket_items` (`id`, `widget_id`, `provider`, `provider_id`, `order`, `params`)
VALUES
	(140,'16','wordpress','27',0,'{\"mosaic_item_title\":\"RokAjaxSearch\",\"mosaic_item_description\":\"The RokAjaxSearch widget brings fantastic search functionality to WordPress, via Mootools as well as full Google Search integration (Web, Images, Video and Blog). It offers AJAX powered real time search results.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img1.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_27__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/plugins\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(141,'16','wordpress','7',1,'{\"mosaic_item_title\":\"RokTwittie\",\"mosaic_item_description\":\"RokTwittie is a highly configurable widget that integrates Twitter into your WordPress site.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img2.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_7__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/plugins\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(142,'16','wordpress','33',2,'{\"mosaic_item_title\":\"RokSprocket\",\"mosaic_item_description\":\"A powerful switchblade content plugin, that provides an array of display options, all within one single modular framework with an intuitive control interface for all layouts.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img3.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_33__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/plugins\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(143,'16','wordpress','36',3,'{\"mosaic_item_title\":\"RokNavMenu\",\"mosaic_item_description\":\"Fusion has many features, inclusive of, but not limited to: Mootools animations, multiple columns, inline subtext and inline icons.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img5.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_36__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/theme-features\\/menu-options\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(144,'16','wordpress','94',4,'{\"mosaic_item_title\":\"82 Widget Positions\",\"mosaic_item_description\":\"A vast widget positions assortment, spread over Gantry Grid Rows, split into groupings of six, for maximum flexibility, diversity and control. Customize layouts per override.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img4.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_94__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/theme-features\\/widget-positions\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(145,'16','wordpress','542',5,'{\"mosaic_item_title\":\"Typography\",\"mosaic_item_description\":\"Individualize and enhance your article and\\/or widgetized content with the template\'s custom typography, such as a plethora of list formats and notice styles.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img11.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_542__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/theme-features\\/typography\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(146,'16','wordpress','1336',6,'{\"mosaic_item_title\":\"Logo Picker\",\"mosaic_item_description\":\"There are two methods of changing the Voxel logo: either via the logo picker or by manual change. You can set Logo Picker to either RokGallery or the Media Manager.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img6.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_1336__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/theme-features\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(147,'16','wordpress','39',7,'{\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"Ximenia has a range of widget variations, both stylistic and structural. These allow you to individualize a widget to create unique layouts and appearances.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img8.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_39__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/theme-features\\/widget-variations\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(148,'16','wordpress','1338',8,'{\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"RokGallery is an advanced gallery plugin, resting on a custom tag based architecture. It has an non-destructive slice editor to allow you edit photos easily and swiftly.\",\"mosaic_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/extensions\\/roksprocket-mosaic\\/img12.jpg\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_1338__params_mosaic_item_image&TB_iframe=1\'}\",\"mosaic_item_link\":\"@RT_SITE_URL@\\/plugins\\/\",\"mosaic_item_tags\":\"\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"lists_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_link\":\"-default-\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(149,'17','wordpress','1336',0,'{\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"features_item_description\":\"-default-\",\"features_item_image\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(150,'17','wordpress','1338',1,'{\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"features_item_description\":\"-default-\",\"features_item_image\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(151,'17','wordpress','1340',2,'{\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"features_item_description\":\"-default-\",\"features_item_image\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(152,'17','wordpress','1342',3,'{\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"features_item_description\":\"-default-\",\"features_item_image\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(153,'17','wordpress','1344',4,'{\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"features_item_description\":\"-default-\",\"features_item_image\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(154,'18','wordpress','1324',0,'{\"tabs_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(155,'18','wordpress','1326',1,'{\"tabs_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(156,'19','wordpress','94',0,'{\"features_item_title\":\"Styled in Elegance\",\"features_item_description\":\"<span><strong>Ximenia<\\/strong> has eight beautifully designed style variations that <strong>capture<\\/strong> the balance between luring visuals with soft and subtle <strong>undertones<\\/strong>. Utilizing dynamic layouts and module suffixes, you can easily shift the <strong>intensity<\\/strong> of design.<\\/span>\",\"features_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/frontpage\\/roksprocket-features\\/img-1.png\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_94__params_features_item_image&TB_iframe=1\'}\",\"features_item_link\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\"}'),
	(157,'19','wordpress','7',1,'{\"features_item_title\":\"Sprocket Layouts\",\"features_item_description\":\"<span>The template has styled support for all <strong>RokSprocket<\\/strong> Layout modes, which includes <strong>Moasic<\\/strong>, Features, Tabs, Lists and Headlines. RokSprocket is an all-in-one content widget with a rich user <strong>interface<\\/strong> for easy setup.<\\/span>\",\"features_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/frontpage\\/roksprocket-features\\/img-2.png\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_7__params_features_item_image&TB_iframe=1\'}\",\"features_item_link\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\"}'),
	(158,'19','wordpress','27',2,'{\"features_item_title\":\"Lots of Features\",\"features_item_description\":\"<span>There are a plethora of features included with Ximenia, the top being the <strong>Gantry Framework<\\/strong> which powers most of the functionality in the template. Other features include the powerful and configuration <strong>Fusion with MegaMenu<\\/strong>.<\\/span>\",\"features_item_image\":\"{\'type\':\'mediamanager\',\'path\':\'@RT_SITE_URL@\\/wp-content\\/rockettheme\\/rt_ximenia_wp\\/frontpage\\/roksprocket-features\\/img-7.png\',\'preview\':\'\',\'link\':\'@RT_SITE_URL@\\/wp-admin\\/media-upload.php?post_id=0&width=640&height=687&e_name=items_wordpress_27__params_features_item_image&TB_iframe=1\'}\",\"features_item_link\":\"-default-\",\"tabs_item_title\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"headlines_item_link\":\"-default-\",\"headlines_item_description\":\"-default-\"}'),
	(159,'20','wordpress','1334',0,'{\"tabs_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(160,'20','wordpress','1330',1,'{\"tabs_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(161,'20','wordpress','1332',2,'{\"tabs_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}'),
	(162,'20','wordpress','1328',3,'{\"tabs_item_title\":\"-default-\",\"tabs_item_icon\":\"-default-\",\"tabs_item_link\":\"-default-\",\"tabs_item_description\":\"-default-\",\"lists_item_title\":\"-default-\",\"mosaic_item_title\":\"-default-\",\"mosaic_item_description\":\"-default-\",\"lists_item_image\":\"-default-\",\"mosaic_item_image\":\"-default-\",\"mosaic_item_link\":\"-default-\",\"lists_item_link\":\"-default-\",\"mosaic_item_tags\":\"\",\"features_item_title\":\"-default-\",\"lists_item_description\":\"-default-\",\"headlines_item_image\":\"-default-\",\"features_item_description\":\"-default-\",\"headlines_item_link\":\"-default-\",\"features_item_image\":\"-default-\",\"headlines_item_description\":\"-default-\",\"features_item_link\":\"-default-\"}');

/*!40000 ALTER TABLE `#__roksprocket_items` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
