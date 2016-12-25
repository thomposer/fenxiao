<?php



$sql = "
	DROP TABLE IF EXISTS `ims_xsign_record`;
	DROP TABLE IF EXISTS `ims_xsign_reply`;
";

pdo_run($sql);