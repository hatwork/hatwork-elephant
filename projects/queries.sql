DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `people_id` bigint NOT NULL auto_increment,
  `people_itsid` int(11) NOT NULL default '0',
  `people_pwd` varchar(250) NOT NULL default '0',
  `people_name` varchar(250) NOT NULL default '0',
  `people_email` varchar(250) NOT NULL default '0',
  `people_mobile` int(11) NOT NULL default '0',
  `people_role` int(1) NOT NULL default '0',
  PRIMARY KEY  (`people_id`)
) ENGINE=MyISAM auto_increment=100 ;

INSERT INTO people (people_itsid,people_pwd,people_name,people_email, people_mobile, people_role) 
VALUES (99999999, '99999999', 'Admin', 'admin@admin.com', 9999999999, 9);

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_id` bigint NOT NULL auto_increment,
  `course_name` varchar(250) NOT NULL default '0',
  `course_desc` text,
  `course_status` int(1) NOT NULL default 0,
  PRIMARY KEY  (`course_id`)
 ) ENGINE=MyISAM auto_increment=100 ;

INSERT INTO course (course_name,course_desc, course_status) VALUES ('Arabic Classes','', 0);

DROP TABLE IF EXISTS `course_schedule`;
CREATE TABLE `course_schedule` (
  `course_schedule_id` bigint NOT NULL auto_increment,
  `course_schedule_course_id` bigint NOT NULL,
  `course_schedule_datetime` varchar(250) NOT NULL default '0',
  `course_schedule_venue` varchar(250),
  `course_schedule_desc` text,
  `course_schedule_status` int(1) NOT NULL default 0,
  PRIMARY KEY  (`course_schedule_id`)
) ENGINE=MyISAM auto_increment=100 ;

INSERT INTO course_schedule (course_schedule_course_id,course_schedule_datetime,course_schedule_venue,course_schedule_desc, course_schedule_status) VALUES (100, '3/7/2017 7:30', 'Pune', '', 0);

DROP TABLE IF EXISTS `course_teacher`;
CREATE TABLE `course_teacher` (
  `course_teacher_id` bigint NOT NULL auto_increment,
  `course_teacher_people_id` bigint NOT NULL,
  `course_teacher_course_id` bigint NOT NULL,
  `course_teacher_status` int(1) NOT NULL default 0,
  PRIMARY KEY  (`course_teacher_id`)
) ENGINE=MyISAM auto_increment=100 ;

DROP TABLE IF EXISTS `course_student`;
CREATE TABLE `course_student` (
  `course_student_id` bigint NOT NULL auto_increment,
  `course_student_people_id` bigint NOT NULL,
  `course_student_course_id` bigint NOT NULL,
  `course_student_status` int(1) NOT NULL default 0,
  PRIMARY KEY  (`course_student_id`)
) ENGINE=MyISAM auto_increment=100 ;

DROP TABLE IF EXISTS `course_attendance`;
CREATE TABLE `course_attendance` (
  `course_attendance_id` bigint NOT NULL auto_increment,
  `course_attendance_people_id` bigint NOT NULL,
  `course_attendance_course_id` bigint NOT NULL,
  `course_attendance_status` int(1) NOT NULL default 0,
  PRIMARY KEY  (`course_attendance_id`)
) ENGINE=MyISAM auto_increment=100 ;





/*

DROP TABLE IF EXISTS `institute`;
CREATE TABLE `institute` (
  `institute_id` bigint NOT NULL auto_increment,
  `institute_name` varchar(250) NOT NULL default '0',
  `institute_desc` text,
  `institute_status` int(1) NOT NULL default 0,
  PRIMARY KEY  (`institute_id`)
) ENGINE=MyISAM auto_increment=100 ;

INSERT INTO institute (institute_name,institute_desc, institute_status) 
VALUES ('Institute', '', 0);

*/