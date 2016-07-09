CREATE DATABASE marketingLead;

USE marketingLead;

CREATE TABLE `lead` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `company` varchar(256) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `consultant` varchar(256) NOT NULL,
  `language` varchar(2) NOT NULL,
  `ip` varchar(39) NOT NULL,
  `time_of_request` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;