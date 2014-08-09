-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-08-09 06:24:47
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii2advanced`
--

-- --------------------------------------------------------

--
-- 表的结构 `achievement`
--

CREATE TABLE IF NOT EXISTS `achievement` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `exp_id` int(20) DEFAULT NULL,
  `content` varchar(500) NOT NULL,
  `time_unit` varchar(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `achieve_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `exp_time` (`achieve_time`),
  KEY `user_id` (`user_id`),
  KEY `exp_id` (`exp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `achievement`
--

INSERT INTO `achievement` (`id`, `exp_id`, `content`, `time_unit`, `user_id`, `achieve_time`, `create_time`, `update_time`) VALUES
(1, NULL, '明天就是我农历30岁的生日了，到现在也没有什么大的出息，工作平平，手里也没有什么存货，到现在也还没有个容身的地方，还是租着别人的房子的住。4年前的一个愿望是能够坐在自己的房子里边看世界杯，看来，这个愿望只能等下次世界杯的时候才能实现了。要说什么成就的话，那就是有了个好媳妇，然后今年还能有自己的孩子。以后为了我的媳妇和孩子，努力吧，努力让生活过得更好。加油吧，显锋！', 'SECOND', 10, '2014-06-07 10:01:26', '2014-06-07 10:08:06', '2014-06-07 10:08:06'),
(2, 253, '今天是我农历30岁生日的前一天，我自己做的系统已经可以记录“经历”、“成就”了，今天成就功能也算是完成了，从今天起，我就可以用我自己的系统记录自己的“经历”，这也算是一件成就吧。', 'SECOND', 10, '2014-06-07 10:24:13', '2014-06-07 10:27:38', '2014-06-07 10:27:38');

-- --------------------------------------------------------

--
-- 表的结构 `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `time_unit` varchar(20) NOT NULL,
  `exp_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `exp_time` (`exp_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=275 ;

--
-- 转存表中的数据 `experience`
--

INSERT INTO `experience` (`id`, `content`, `time_unit`, `exp_time`, `user_id`, `create_time`, `update_time`) VALUES
(219, '今天又是带饭过来上班的，现在人都去吃饭了，屋里没几个人。', 'SECOND', '2014-06-03 04:34:02', 10, '2014-06-03 04:34:36', '2014-06-03 04:34:36'),
(228, '今天陪老婆去做了唐氏筛查，听到了儿子的心跳声，很快，后来得知每分钟160次呢，小伙子还挺壮。', 'SECOND', '2014-06-04 00:00:00', 10, '2014-06-04 11:57:52', '2014-06-04 11:57:52'),
(250, '今天趁午饭的时间，把“经历”的删除功能做好了，很有成就感，哈哈。。。', 'SECOND', '2014-06-05 05:00:00', 10, '2014-06-05 07:32:36', '2014-06-05 07:32:36'),
(251, '周末了，又能做些功能了，今天差些“记入成就”功能没有做，不知道啥时候能够做完。', 'SECOND', '2014-06-06 12:51:01', 10, '2014-06-06 12:51:46', '2014-06-06 12:51:46'),
(253, '今天是我农历30岁生日的前一天，我自己做的系统已经可以记录“经历”、“成就”了，今天成就功能也算是完成了，从今天起，我就可以用我自己的系统记录自己的“经历”，这也算是一件成就吧。', 'SECOND', '2014-06-07 10:24:13', 10, '2014-06-07 10:26:52', '2014-06-07 10:26:52'),
(254, '今天是阳历的30岁生日，要去江苏省中医院做个脑部的核磁共振，最近老头疼，不知道什么原因，查查看看。希望一切安好！', 'SECOND', '2014-06-10 00:35:21', 10, '2014-06-10 00:36:30', '2014-06-10 00:36:30'),
(255, '今天在中医院转悠了一圈，拿到了上次做的磁共振的报告，一切都没有问题，谢天谢地！\r\n另外，医生又让到耳鼻喉科看，又做了个鼻镜检查，也没有问题。\r\n但是最近老是头疼，头胀，到底什么问题呢？\r\n拿了一些药，吃吃看吧。\r\n看病也不容易啊，检查了一圈，花了千把块钱，最后什么也没看出来，还得稀里糊涂地吃药。', 'SECOND', '2014-06-11 09:30:29', 10, '2014-06-11 09:33:16', '2014-06-11 09:33:16'),
(256, '今晚小系统接入南京和常州上线，由于第一次上线，折腾了好久，至13号凌晨3点多才解决完。13号正好是世界杯开幕，本想回来看一下揭幕战的，谁知道电视不是很给力，看直播卡得很。今天打算去有线电视营业厅看看，看有线电视的价格能不能接受，如果能接收到的话还是弄个有线电视吧，这样看直播就不用那么憋屈了。', 'SECOND', '2014-06-12 12:30:00', 10, '2014-06-13 07:29:54', '2014-06-13 07:29:54'),
(257, '此刻老婆正在鼓楼区妇保所拿唐氏筛查的检查报告，不知道结果如何，希望一切都好。', 'SECOND', '2014-06-17 06:53:45', 10, '2014-06-17 06:54:23', '2014-06-17 06:54:23'),
(258, '听到老婆说没有问题，心里轻松了许多。不求大富大贵，只愿健健康康平平淡淡地生活。', 'SECOND', '2014-06-17 07:02:39', 10, '2014-06-17 07:08:50', '2014-06-17 07:08:50'),
(259, '昨天晚上上线，晚上2点多才到家，然后又看了英格兰和乌拉圭之间的世界杯比赛，看着看着还睡着了。今天待了一天，感觉挺无聊，总是不知道干什么，还是得看看书啊。', 'SECOND', '2014-06-20 10:42:29', 10, '2014-06-20 10:43:54', '2014-06-20 10:43:54'),
(260, '经过了2周的艰苦摸索，终于把头像功能做好了，这个功能做得有点艰苦，虽然如此，但是实现之后，感觉还是很有成就感的。', 'SECOND', '2014-06-22 11:22:51', 10, '2014-06-22 11:23:44', '2014-06-22 11:23:44'),
(261, '今天趁午饭的时间把滑动鼠标的时候隐藏导航栏也做好了，很有成就感，哈哈。。。', 'SECOND', '2014-06-24 04:49:35', 10, '2014-06-24 04:50:26', '2014-06-24 04:50:26'),
(262, '睡得比较早，0点过几分钟的时候被测试网络的电话吵醒，起来测试网络，这时大概是晚上0：19分，搞了搞无线网，都到0:30分了，测试完网络意大利和乌拉圭的上半场已经踢完了，0:0，下半场结果谁都无法预料。本来看着裁判好像偏向意大利，但是过了一会儿，一个不太严重的犯规，意大利被罚下一人，这时，天平完全偏向了乌拉圭，在乌拉圭人的猛烈攻势下，意大利终于在80分钟的时候失守了。中间还穿插了个小插曲，苏亚雷斯咬了基耶利尼。在我看来，意大利人踢球好像是乌龟守蛋，任你怎么攻，想要拿我的蛋，我就缩着头，凭借着坚硬的外壳守着自己身下的蛋，当苏牙用锋利的牙齿咬了一口之后就再也守不住了，丢了一个蛋，然后就疯狂的反击，到了最后一刻，甚至所有的蛋都暴露在了对手面前，但最终还是没能打赢。', 'SECOND', '2014-06-24 16:00:00', 10, '2014-06-25 08:49:56', '2014-06-25 08:49:56'),
(264, '今天去参加了一个维护室的会议，虽然没有什么内容，但是还是感触颇深，感觉现在好像很多人都是在混日子，日子混过去就行了，没有什么想法，没有什么理想，也不知道自己在做什么，也不知道自己想要做什么，只是按照以往的“惯例”在循规蹈矩地生活着。我的生活似乎也是这样，怎么才能做出改变呢？', 'SECOND', '2014-06-27 06:00:00', 10, '2014-06-27 08:06:43', '2014-06-27 08:06:43'),
(265, '下半年开始的第一天，也是我工作整整6年的时间。工作了6年了，得到了什么呢？又失去了什么，都不知道自己在干些什么，也不知道以后能够干些什么，以后的路该怎么走，是时候规划一下了。', 'SECOND', '2014-07-01 09:30:13', 10, '2014-07-01 09:31:34', '2014-07-01 09:31:34'),
(267, '自动加载更多功能已经放下许久了，今天又重新开始了，希望尽快完工，王显锋，加油！', 'SECOND', '2014-07-11 07:05:24', 10, '2014-07-11 07:05:38', '2014-07-11 07:05:38'),
(268, '自动加载更多经历的功能做好了，很有成就感，哈哈。。。', 'SECOND', '2014-07-11 09:06:59', 10, '2014-07-11 09:07:24', '2014-07-11 09:07:24'),
(269, '现在开始做返回顶部的功能，一次加载了很多经历，想要返回顶部还需要拖动滚动条，加个返回顶部的功能应该不错，嘿嘿。。。', 'SECOND', '2014-07-11 09:24:56', 10, '2014-07-11 09:25:56', '2014-07-11 09:25:56'),
(270, '返回顶部的功能也做完了，哈哈。。。', 'SECOND', '2014-07-11 10:05:38', 10, '2014-07-11 10:05:42', '2014-07-11 10:05:42'),
(271, '媳妇今天晚上的火车，明天早上到南京，好期待啊，赶快回来吧！想你，媳妇！', 'SECOND', '2014-07-12 05:19:24', 10, '2014-07-12 05:19:59', '2014-07-12 05:19:59'),
(272, '基本功能已经实现得差不多了，还差几个想要的功能，以后没事慢慢实现，下面的事情就是想办法把程序部署到免费主机上面去，又能够正常的使用，这是个比较麻烦的事情。慢慢摸索吧。', 'SECOND', '2014-07-12 12:55:02', 10, '2014-07-12 12:56:31', '2014-07-12 12:56:31'),
(273, '看看默认的头像是什么东西。哈哈。。。', 'SECOND', '2014-07-20 04:03:17', 11, '2014-07-20 04:03:24', '0000-00-00 00:00:00'),
(274, '重装了一下系统把数据库搞丢了，把imagick插件搞丢了，重新装也装不好了，很郁闷啊，以后不能再犯这样的错误了，记得备份啊，数据无价，血的教训啊！', 'SECOND', '2014-08-09 04:22:13', 10, '2014-08-09 04:23:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `goal`
--

CREATE TABLE IF NOT EXISTS `goal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `time_unit` varchar(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `goal_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `goal_time` (`goal_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `memory`
--

CREATE TABLE IF NOT EXISTS `memory` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `time_unit` varchar(20) NOT NULL,
  `memory_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `exp_time` (`memory_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_care`
--

CREATE TABLE IF NOT EXISTS `my_care` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `order_num` int(20) NOT NULL,
  `nick_name` varchar(100) DEFAULT NULL,
  `relationship` varchar(100) NOT NULL,
  `solar_birthday` datetime NOT NULL,
  `lunar_birthday` datetime NOT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  `create_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `update_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `my_care`
--

INSERT INTO `my_care` (`id`, `user_id`, `name`, `order_num`, `nick_name`, `relationship`, `solar_birthday`, `lunar_birthday`, `remark`, `create_time`, `update_time`) VALUES
(1, 10, '王晴', 1, '', '老婆', '1986-04-21 16:00:00', '1986-03-13 16:00:00', '', '2014-08-05 22:01:22.000000', '2014-08-05 23:49:05.783267'),
(2, 10, '亚峰', 4, '', '三弟', '1991-09-08 16:00:00', '1991-08-01 16:00:00', '', '2014-08-05 23:26:16.000000', '2014-08-05 23:50:39.208610'),
(3, 10, '小静', 3, '', '小妹', '1989-04-28 16:00:00', '1989-03-23 16:00:00', '', '2014-08-05 23:48:40.000000', '2014-08-05 23:50:46.356019'),
(4, 10, '妈', 11, '', '妈', '1957-02-11 00:00:00', '1957-01-12 00:00:00', '', '2014-08-06 03:42:15.000000', '2014-08-06 03:42:15.823576'),
(5, 10, '爸', 12, '', '爸', '1957-10-27 00:00:00', '1958-09-15 00:00:00', '', '2014-08-06 03:43:19.000000', '2014-08-06 03:43:19.414213');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `birthday` timestamp NULL DEFAULT NULL,
  `public_flag` varchar(10) DEFAULT '0',
  `leave_age` bigint(20) DEFAULT '100',
  `time_unit` varchar(20) DEFAULT 'DAY',
  `mobile` varchar(120) DEFAULT NULL,
  `face` varchar(1000) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `username_2` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `nickname`, `birthday`, `public_flag`, `leave_age`, `time_unit`, `mobile`, `face`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`, `create_time`, `update_time`) VALUES
(10, 'wangxianfeng', '王显锋', '1984-06-09 16:00:00', '1', 100, 'SECOND', '13213939922', '', 'Ko2jNAFrVkDo3Hski6E-mXxLIJi4iS04', '$2y$13$PEnm1foOWIlmvB1yXT88ZOIqV0hu1rs/fldFSDIBJ/OAR.cCTUFz2', '', 'wangxianfeng@auvtime.com', 10, 10, 1401108560, 1405840626, '2014-05-26 12:49:20', '2014-07-20 07:17:06'),
(11, 'hejing', '', '2014-05-19 20:40:00', '0', 100, 'SECOND', '18901322313', '', 'hmBUuat7WqJws7OQD6OmPPTM1FTDFakr', '$2y$13$ew1efn9IWFEf7vbZqgg7feJSaHjKzN65VAUAPLDHckfb5H/7zDOMO', NULL, 'hejing@qq.com', 10, 10, 1401581249, 1401709497, '2014-06-01 00:07:29', '2014-06-02 11:44:57'),
(12, 'wangqing', NULL, '1986-04-21 16:00:00', '0', 100, 'DAY', NULL, NULL, 'o8NvEEHGeq9QR9ZwqOW57GY4M21UC2Gt', '$2y$13$amP0vklFlVGdypJsHNkz4enR1mIBz8a.frWHmbb0LgeD/FO8EATlO', NULL, 'wangqing@qq.com', 10, 10, 1405827562, 1405827562, '2014-07-20 03:39:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `user_face`
--

CREATE TABLE IF NOT EXISTS `user_face` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `face_url` varchar(1000) NOT NULL,
  `face_type` varchar(20) DEFAULT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  `file_size` int(10) DEFAULT NULL,
  `upload_ip` int(11) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `user_face`
--

INSERT INTO `user_face` (`id`, `user_id`, `face_url`, `face_type`, `file_type`, `file_size`, `upload_ip`, `create_time`, `update_time`) VALUES
(8, 10, '/images/userfaces/20140711/1405086705-10.jpg', '1', 'jpg', 0, NULL, '2014-06-22 08:52:14', '2014-07-11 13:51:45');

--
-- 限制导出的表
--

--
-- 限制表 `achievement`
--
ALTER TABLE `achievement`
  ADD CONSTRAINT `achievement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `achievement_ibfk_2` FOREIGN KEY (`exp_id`) REFERENCES `experience` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
