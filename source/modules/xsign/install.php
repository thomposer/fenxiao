<?php



$sql = "
CREATE TABLE IF NOT EXISTS `ims_xsign_record` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `rid` int(11) NOT NULL,
		  `fromuser` text NOT NULL,
		  `username` text NOT NULL,
		  `today_rank` int(11) NOT NULL,
		  `sign_time` int(11) NOT NULL,
		  `last_sign_time` int(11) NOT NULL,
		  `continue_sign_days` int(11) NOT NULL,
		  `maxcontinue_sign_days` int(11) NOT NULL,
		  `total_sign_num` int(11) NOT NULL,
		  `maxtotal_sign_num` int(11) NOT NULL,
		  `first_sign_days` int(11) NOT NULL,
		  `maxfirst_sign_days` int(11) NOT NULL,
		  `credit` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


CREATE TABLE IF NOT EXISTS `ims_xsign_reply` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `rid` int(11) NOT NULL,
		  `title` text NOT NULL,
		  `picture` text NOT NULL,
		  `description` text NOT NULL,
		  `content` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


";

pdo_run($sql);