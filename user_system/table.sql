Create table `user_system`.`user`(  
  `user_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `reg_time` datetime NOT NULL,
  primary key (`user_id`)
) ENGINE=MyISAM charset=utf8 collate=utf8_general_ci;

