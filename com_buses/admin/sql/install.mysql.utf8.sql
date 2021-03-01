DROP  TABLE  IF EXISTS  `#__buses`;

CREATE TABLE  IF NOT EXISTS  `#__buses` (
`id` int(11) NOT  NULL  AUTO_INCREMENT,
`language` char(7) NOT NULL,
`published` tinyint(4) DEFAULT NULL,
`brand` VARCHAR(25) NOT NULL,
`model` VARCHAR(25) NOT NULL,
`description` varchar(500) NOT  NULL,
`images` varchar(1024) NOT NULL DEFAULT '',
`wifi` tinyint(4) DEFAULT NULL,
`tv` tinyint(4) DEFAULT NULL,
`music` tinyint(4) DEFAULT NULL,
`wc` tinyint(4) DEFAULT NULL,
`climat` tinyint(4) DEFAULT NULL,
`comfort` tinyint(4) DEFAULT NULL,
`usb` tinyint(4) DEFAULT NULL,
`food` tinyint(4) DEFAULT NULL,
`alias` varchar(45) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;