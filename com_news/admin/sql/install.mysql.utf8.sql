DROP  TABLE  IF EXISTS  `#__news`;

CREATE TABLE  IF NOT EXISTS  `#__news` (
`id` int(11) NOT  NULL  AUTO_INCREMENT,
`title` VARCHAR(55) NOT NULL,
`published` tinyint(4) DEFAULT NULL,
`text` text NOT  NULL,
`images` varchar(1024) NOT NULL DEFAULT '',
`publish_up` datetime DEFAULT NULL,
`alias` varchar(45) DEFAULT NULL,
`language` char(7) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;