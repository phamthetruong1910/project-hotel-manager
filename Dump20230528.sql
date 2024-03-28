-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tms
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `updatedAt` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','2017-05-13 18:18:49',NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convenient`
--

DROP TABLE IF EXISTS `convenient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convenient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convenient`
--

LOCK TABLES `convenient` WRITE;
/*!40000 ALTER TABLE `convenient` DISABLE KEYS */;
INSERT INTO `convenient` VALUES (1,'Miễn phí bữa sáng','2023-05-27 21:19:39',NULL,'ENABLE'),(2,'Wifi miễn phí','2023-05-27 21:19:39',NULL,'ENABLE'),(3,'Không hút thuốc','2023-05-27 21:19:39',NULL,'ENABLE'),(4,'Miễn phí huỷ phòng','2023-05-27 21:19:39',NULL,'ENABLE'),(5,'Máy lạnh','2023-05-27 21:19:39',NULL,'ENABLE'),(6,'Nước nóng','2023-05-27 21:19:39',NULL,'ENABLE'),(7,'Quầy bar mini','2023-05-27 21:19:39',NULL,'ENABLE'),(8,'Nước đóng chai miễn phí','2023-05-27 21:19:39',NULL,'ENABLE'),(9,'Chiếu phim tại phòng','2023-05-27 21:19:39',NULL,'ENABLE'),(10,'TV','2023-05-27 21:19:39',NULL,'ENABLE'),(11,'Bàn làm việc','2023-05-27 21:19:39',NULL,'ENABLE'),(12,'Áo choàng tắm','2023-05-27 21:19:39',NULL,'ENABLE'),(20,'checker','2023-04-21 22:28:58','2023-04-21 22:29:02','DELETED'),(21,'Máy lọc không khí','2023-05-27 21:19:39',NULL,'ENABLE');
/*!40000 ALTER TABLE `convenient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobileNumber` char(10) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `postingDate` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiries`
--

LOCK TABLES `enquiries` WRITE;
/*!40000 ALTER TABLE `enquiries` DISABLE KEYS */;
INSERT INTO `enquiries` VALUES (1,'anuj','anuj.lpu1@gmail.com','2354235235','The standard Lorem Ipsum passage, used since the 1500s','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum','2017-05-14 05:23:53','1',NULL),(2,'efgegter','terterte@gmail.com','3454353453','The standard Lorem Ipsum passage','nventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat volup','2017-05-14 05:27:00','1',NULL),(3,'fwerwetrwet','fwsfhrtre@hdhdhqw.com','8888888888','erwt wet','nventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat volup','2017-05-14 05:28:11','1',NULL),(4,'Test','test@gm.com','4747474747','Test','iidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiid','2017-05-14 14:54:07','1',NULL);
/*!40000 ALTER TABLE `enquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ranking` int(11) DEFAULT NULL,
  `createdBy` varchar(255) DEFAULT NULL,
  `updatedBy` varchar(255) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `embedLocation` longtext DEFAULT NULL,
  `convenient` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `famousLocation` mediumtext DEFAULT NULL,
  `isBreakfastService` tinyint(4) NOT NULL,
  `hotline` varchar(10) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (103,'La Beach Hotel','Khách sạn','22 Lê Bình, Phước Mỹ, Sơn Trà, Đà Nẵng, Việt Nam','La Beach Hotel là đề xuất hàng đầu dành cho những tín đồ du lịch \"bụi\" mong muốn được nghỉ tại một khách sạn vừa thoải mái lại hợp túi tiền.\r\n\r\nDành cho những du khách muốn du lịch thoải mái cùng ngân sách tiết kiệm, La Beach Hotel sẽ là lựa chọn lưu trú hoàn hảo, nơi cung cấp các tiện nghi chất lượng và dịch vụ tuyệt vời.','2023-05-27 14:34:34',NULL,3,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.831052102792!2d108.2395389112824!3d16.074254584541823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142178897f01dad%3A0x3f94b6340c85efff!2zMjIgTMOqIEJpzIBuaCwgUGjGsOG7m2MgTeG7uSwgU8ahbiBUcsOgLCDEkMOgIE7hurVuZyA1NTAwMDAsIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1685189834833!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn',1,NULL,'Quận Hải Châu'),(104,'Adela Boutique Hotel','Khách sạn',' 10 An Thượng 36, My An, Ngũ Hành Sơn, Mỹ An, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 550000','Adela Boutique Hotel là lựa chọn sáng giá dành cho những ai đang tìm kiếm một trải nghiệm xa hoa đầy thú vị trong kỳ nghỉ của mình. Lưu trú tại đây cũng là cách để quý khách chiều chuộng bản thân với những dịch vụ xuất sắc nhất và khiến kỳ nghỉ của mình trở nên thật đáng nhớ.\r\n\r\nHãy sẵn sàng đón nhận trải nghiệm khó quên bằng dịch vụ độc đáo và hoàn hảo của khách sạn cùng các tiện nghi đầy đủ, đáp ứng mọi nhu cầu của quý khách.','2023-05-27 14:47:21','2023-05-28 02:41:07',1,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.243035217465!2d108.24149281128199!3d16.05287328456012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314217adf39f2995%3A0xda5a25ad499dfcf4!2sADELA%20BOUTIQUE%20HOTEL!5e0!3m2!1sen!2s!4v1685216381137!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.2433249174933!2d108.24143881098132!3d16.052858239811272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142177b6353c723%3A0x74f48eb905ce59a4!2zMTAgQW4gVGjGsOG7o25nIDM2LCBC4bqvYyBN4bu5IFBow7osIE5nxakgSMOgbmggU8ahbiwgxJDDoCBO4bq1bmcgNTUwMDAwLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1685190970225!5m2!1sen!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>',1,NULL,'Quận Ngũ Hành Sơn'),(105,'Melia Vinpearl Danang Riverfront','Khách sạn','341 Trần Hưng Đạo, Sơn Trà, An Hải Bắc, Sơn Trà, Đà Nẵng, Việt Nam, 550000','Melia Vinpearl Danang Riverfront là lựa chọn sáng giá dành cho những ai đang tìm kiếm một trải nghiệm xa hoa đầy thú vị trong kỳ nghỉ của mình. Lưu trú tại đây cũng là cách để quý khách chiều chuộng bản thân với những dịch vụ xuất sắc nhất và khiến kỳ nghỉ của mình trở nên thật đáng nhớ.\r\n\r\nTừ sự kiện doanh nghiệp đến họp mặt công ty, Melia Vinpearl Danang Riverfront cung cấp đầy đủ các dịch vụ và tiện nghi đáp ứng mọi nhu cầu của quý khách và đồng nghiệp.','2023-05-27 15:02:09',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8971679234655!2d108.22671511098163!3d16.0708251393304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142182ef14654ad%3A0x12b541ef197a770e!2zMzQxIMSQLiBUcuG6p24gSMawbmcgxJDhuqFvLCBBbiBI4bqjaSBC4bqvYywgU8ahbiBUcsOgLCDEkMOgIE7hurVuZyA1NTAwMDAsIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1685192281780!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Cầu sông Hàn -  Biển Mỹ Khê - Sân bay quốc tế Đà Nẵng (DAD)',1,NULL,'Quận Sơn Trà'),(106,'Khu nghỉ dưỡng và Spa Mikazuki Nhật Bản','Resort','Đường Nguyễn Tất Thành,Phường Hòa Hiệp Nam, Hòa Hiệp Nam, Liên Chiểu, Đà Nẵng, Việt Nam, 550000','Da Nang – Mikazuki JAPANESE RESORTS & SPA toạ lạc tại khu vực / thành phố Hòa Hiệp Nam.\r\n\r\nnơi nghỉ sở hữu vị trí đắc địa cách sân bay Sân bay quốc tế Đà Nẵng (DAD) 7,87 km.\r\n\r\nnơi nghỉ nằm cách Da Nang Railway Station 7,07 km.\r\n\r\nCó rất nhiều điểm tham quan lân cận như Chùa Linh Ứng ở khoảng cách 14 km, và Nhà hàng Bà Rô ở khoảng cách 11,85 km.','2023-05-27 15:07:41',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.2634396112585!2d108.135183910982!3d16.103667538450104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218b663cd7837%3A0xb8634694bc2c868a!2zTmd1eeG7hW4gVOG6pXQgVGjDoG5oLCBIw7JhIEhp4buHcCBOYW0sIExpw6puIENoaeG7g3UsIMSQw6AgTuG6tW5nLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1685192687118!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Sân bay quốc tế Đà Nẵng (DAD) - Cầu sông Hàn',1,NULL,'Quận Liên Chiểu'),(107,'InterContinental Hotels DANANG SUN PENINSULA RESORT','Khách sạn','Bai Bac, SonTra Peninsula, Thọ Quang, Sơn Trà, Đà Nẵng, Việt Nam, 550000','InterContinental Hotels DANANG SUN PENINSULA RESORT toạ lạc tại khu vực / thành phố Thọ Quang.\r\n\r\nkhách sạn sở hữu vị trí đắc địa cách sân bay Sân bay quốc tế Đà Nẵng (DAD) 14,29 km.\r\n\r\nCó rất nhiều điểm tham quan lân cận như Sen House Garden ở khoảng cách 32,52 km, và Thánh địa Mỹ Sơn ở khoảng cách 43,94 km.','2023-05-27 15:12:27',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30664.020552727776!2d108.26473566661231!3d16.117167987401135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31423e0b91b2da5d%3A0x19ee9ab44055d6d4!2sSouth%20Beach%20Son%20Tra!5e0!3m2!1sen!2s!4v1685192937203!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn',1,NULL,'Quận Sơn Trà'),(108,'Vinpearl Resort & Spa Da Nang- Wellness Villas By The Beach','Resort','Đường Trường Sa, Ngũ Hành Sơn, Hòa Hải, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 550000','Khách sạn này là nơi tốt nhất dành cho những ai mong muốn một nơi thanh bình, thư thái để ẩn mình khỏi đám đông ồn ã, xô bồ.\r\n\r\nDịch vụ thượng hạng song hành với hàng loạt tiện nghi phong phú sẽ đem đến cho quý khách trải nghiệm của một kỳ nghỉ viên mãn nhất.','2023-05-27 15:17:09',NULL,1,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122755.07053148178!2d108.23894666329724!3d15.95636472874772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314210cbebc12213%3A0xc6fc741592df54ec!2sDanang%20Marriott%20Resort%20%26%20Spa!5e0!3m2!1sen!2s!4v1685193228689!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Hải Châu'),(109,'Novotel Danang Premier Han River','Khách sạn','36 Bạch Đằng, Street, Hải Châu, Đà Nẵng 550000, Vietnam','Dịch vụ thượng hạng song hành với hàng loạt tiện nghi phong phú sẽ đem đến cho quý khách trải nghiệm của một kỳ nghỉ viên mãn nhất.\r\n\r\nHưởng thụ một ngày thư thái đầy thú vị tại hồ bơi dù quý khách đang du lịch một mình hay cùng người thân.\r\n\r\nNovotel Danang Premier Han River là khách sạn sở hữu đầy đủ tiện nghi và dịch vụ xuất sắc theo nhận định của hầu hết khách lưu trú.','2023-05-27 15:21:48',NULL,1,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.771130106449!2d108.22107801098174!3d16.077362139155355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142183afab4a42d%3A0xd52dbe9e28e83835!2sNovotel%20Danang%20Premier%20Han%20River!5e0!3m2!1sen!2s!4v1685193488273!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Hải Châu'),(110,'Khu nghỉ dưỡng Naman Retreat','Resort','Đường Trường Sa, Hòa Hải, Hòa Hải, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 550000','Dù quý khách muốn tổ chức một sự kiện hay các dịp kỷ niệm đặc biệt khác, Naman Retreat Resort là lựa chọn tuyệt vời cho quý khách với phòng chức năng rộng lớn, được trang bị đầy đủ để sẵn sàng đáp ứng mọi yêu cầu.\r\n\r\nKhách sạn này là lựa chọn hoàn hảo cho các kỳ nghỉ mát lãng mạn hay tuần trăng mật của các cặp đôi. Quý khách hãy tận hưởng những đêm đáng nhớ nhất cùng người thương của mình tại Naman Retreat Resort','2023-05-27 15:25:42',NULL,1,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.8401756144376!2d108.28166811098009!3d15.969720642029856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314210ffff49be83%3A0x4dc264a06ef8baa5!2sNaman%20Retreat!5e0!3m2!1sen!2s!4v1685193793150!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Ngũ Hành Sơn'),(111,'Hilton Đà Nẵng','Khách sạn','50 Bach Dang St, Hai Chau District, Hải Châu 1, Quận Hải Châu, Đà Nẵng, Việt Nam','Dịch vụ thượng hạng song hành với hàng loạt tiện nghi phong phú sẽ đem đến cho quý khách trải nghiệm của một kỳ nghỉ viên mãn nhất.\r\n\r\nTrung tâm thể dục của khách sạn là một trong những tiện nghi không thể bỏ qua khi lưu trú tại đây.\r\n\r\nHưởng thụ một ngày thư thái đầy thú vị tại hồ bơi dù quý khách đang du lịch một mình hay cùng người thân.','2023-05-27 15:29:41',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.86153649966!2d108.22170821098163!3d16.07267343928099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142183030cc0f53%3A0x9f7d7927946123f7!2sHilton%20Da%20Nang!5e0!3m2!1sen!2s!4v1685194011438!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Hải Châu'),(112,'Peninsula Hotel Danang','Khách sạn','84 Võ Nguyên Giáp - Mân Thái - Sơn Trà - Đà Nẵng, Mân Thái, Sơn Trà, Đà Nẵng, Việt Nam, 550000','Dịch vụ thượng hạng song hành với hàng loạt tiện nghi phong phú sẽ đem đến cho quý khách trải nghiệm của một kỳ nghỉ viên mãn nhất.\r\n\r\nTrung tâm thể dục của khách sạn là một trong những tiện nghi không thể bỏ qua khi lưu trú tại đây.\r\n\r\nHưởng thụ một ngày thư thái đầy thú vị tại hồ bơi dù quý khách đang du lịch một mình hay cùng người thân.','2023-05-27 15:33:04',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.688113019624!2d108.24463041098184!3d16.081666439039967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314217c3da7eb97d%3A0x11f8471bbae4b728!2sPeninsula%20Hotel%20Danang!5e0!3m2!1sen!2s!4v1685194224538!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Hải Châu'),(113,'Four Points by Sheraton Danang','Khách sạn','118-120 Vo Nguyen Giap, Phuoc My, Son Tra, Phước Mỹ, Sơn Trà, Đà Nẵng, Việt Nam, 550000','Dịch vụ thượng hạng song hành với hàng loạt tiện nghi phong phú sẽ đem đến cho quý khách trải nghiệm của một kỳ nghỉ viên mãn nhất.\r\n\r\nTrung tâm thể dục của khách sạn là một trong những tiện nghi không thể bỏ qua khi lưu trú tại đây.\r\n\r\nHưởng thụ một ngày thư thái đầy thú vị tại hồ bơi dù quý khách đang du lịch một mình hay cùng người thân.','2023-05-27 15:37:31',NULL,1,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.7642840357535!2d108.2426853109816!3d16.077717139145882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142178e95bda349%3A0x61ebd93becf8f96d!2zMTE4LCAxMjAgVsO1IE5ndXnDqm4gR2nDoXAsIFN0cmVldCwgU8ahbiBUcsOgLCDEkMOgIE7hurVuZyA1NTAwMDAsIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1685194480985!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Sơn Trà'),(114,'The Ocean Villas','Khách sạn','Đường Trường Sa, Phường Hòa Hải, Khuê Mỹ, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 550000','Dù quý khách muốn tổ chức một sự kiện hay các dịp kỷ niệm đặc biệt khác, The Ocean Villas là lựa chọn tuyệt vời cho quý khách với phòng chức năng rộng lớn, được trang bị đầy đủ để sẵn sàng đáp ứng mọi yêu cầu.\r\n\r\nKhách sạn này là lựa chọn hoàn hảo cho các kỳ nghỉ mát lãng mạn hay tuần trăng mật của các cặp đôi. Quý khách hãy tận hưởng những đêm đáng nhớ nhất cùng người thương của mình tại The Ocean Villas\r\n\r\nThe Ocean Villas là lựa chọn sáng giá dành cho những ai đang tìm kiếm một trải nghiệm xa hoa đầy thú vị trong kỳ nghỉ của mình. Lưu trú tại đây cũng là cách để quý khách chiều chuộng bản thân với những dịch vụ xuất sắc nhất và khiến kỳ nghỉ của mình trở nên thật đáng nhớ.','2023-05-27 15:41:11',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.730461079401!2d108.27908566098017!3d15.975446241877348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421121fab656c3%3A0xd44b6ddd23a3e107!2sOcean%20Beach%20Villas%20Danang!5e0!3m2!1sen!2s!4v1685194703726!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Hải Châu'),(115,'Wyndham Danang Golden Bay','Khách sạn','01 Lê Văn Duyệt, Nại Hiên Đông, Sơn Trà, Đà Nẵng, Việt Nam, 553895','Dù quý khách muốn tổ chức một sự kiện hay các dịp kỷ niệm đặc biệt khác, Wyndham Danang Golden Bay là lựa chọn tuyệt vời cho quý khách với phòng chức năng rộng lớn, được trang bị đầy đủ để sẵn sàng đáp ứng mọi yêu cầu.\r\n\r\nWyndham Danang Golden Bay là lựa chọn sáng giá dành cho những ai đang tìm kiếm một trải nghiệm xa hoa đầy thú vị trong kỳ nghỉ của mình. Lưu trú tại đây cũng là cách để quý khách chiều chuộng bản thân với những dịch vụ xuất sắc nhất và khiến kỳ nghỉ của mình trở nên thật đáng nhớ.','2023-05-27 15:44:58',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.3784340655143!2d108.21968044671469!3d16.097712899071258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142180fe039ce93%3A0xee9871ce9375932d!2zMDEgTMOqIFbEg24gRHV54buHdCwgTuG6oWkgSGnDqm4gxJDDtG5nLCBTxqFuIFRyw6AsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1685194926660!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Sơn Trà'),(116,'Melia Danang Beach Resort','Khách sạn',' 19 Trường Sa, Phường Hòa Hải, Hòa Hải, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 556873','','2023-05-27 15:50:47',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1917.6254896422215!2d108.26866535643919!3d16.000445224452406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314210c5cab81527%3A0xfd5b35311bbbd0fc!2sMeli%C3%A1%20Danang%20Beach%20Resort!5e0!3m2!1sen!2s!4v1685195249850!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Ngũ Hành Sơn'),(117,'Pullman Danang Beach Resort','Resort','101 VO NGUYEN GIAP STREET, KHUE MY WARD, NGU HANH SON DISTRICT, Khuê Mỹ, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 550000','Khách sạn này là nơi tốt nhất dành cho những ai mong muốn một nơi thanh bình, thư thái để ẩn mình khỏi đám đông ồn ã, xô bồ.\r\n\r\nDịch vụ thượng hạng song hành với hàng loạt tiện nghi phong phú sẽ đem đến cho quý khách trải nghiệm của một kỳ nghỉ viên mãn nhất.\r\n\r\nHưởng thụ một ngày thư thái đầy thú vị tại hồ bơi dù quý khách đang du lịch một mình hay cùng người thân.','2023-05-27 15:54:50',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.4798606947893!2d108.24750691098119!3d16.040569840139874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314217686dfcf229%3A0xa17b1ae3b14af658!2sPullman%20Danang%20Beach%20Resort!5e0!3m2!1sen!2s!4v1685195489633!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Ngũ Hành Sơn'),(118,'Khu nghỉ dưỡng Risemount Premier Đà Nẵng','Resort','120 Nguyễn Văn Thoại, Mỹ An, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 550000','Risemount Resort Danang thuộc quận Ngũ Hành Sơn, chỉ cách bãi biển Mỹ An xinh đẹp vài phút đi bộ. Các địa điểm du lịch nổi tiếng của thành phố cũng rất gần với khách sạn. Du khách chỉ cần 10 phút chạy xe là có thể đến được cầu Tình Yêu, bảo tàng Văn hóa Chăm, hoặc Asia Park Đà Nẵng.','2023-05-27 15:58:36',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.2093403204262!2d108.23949951098132!3d16.0546230397641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142177c46837343%3A0xf40f5197d1ba3cb1!2sRisemount%20Premier%20Resort%20Danang!5e0!3m2!1sen!2s!4v1685195741352!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Hải Châu'),(119,'Hyatt Regency Danang Resort & Spa','Khách sạn','05 Truong Sa Street, Hoa Hai Ward, Hòa Hải, Ngũ Hành Sơn, Đà Nẵng, Việt Nam','Dịch vụ thượng hạng song hành với hàng loạt tiện nghi phong phú sẽ đem đến cho quý khách trải nghiệm của một kỳ nghỉ viên mãn nhất.\r\n\r\nTrung tâm thể dục của khách sạn là một trong những tiện nghi không thể bỏ qua khi lưu trú tại đây.\r\n\r\nHưởng thụ một ngày thư thái đầy thú vị tại hồ bơi dù quý khách đang du lịch một mình hay cùng người thân.\r\n\r\nNhận ưu đãi đặc biệt dành cho các liệu pháp spa tinh tuý nhất giúp thư giãn tinh thần và làm tươi trẻ cơ thể.','2023-05-27 16:02:14',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.0095291692164!2d108.26161751098066!3d16.013019440875677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314210cf6a42c159%3A0xaeb535cc2b736240!2sHyatt%20Regency%20Danang%20Resort%20And%20Spa!5e0!3m2!1sen!2s!4v1685195979535!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Ngũ Hành Sơn'),(120,'Shilla Monogram Quangnam Danang','Resort','Lạc Long Quân, Điện Ngọc, Điện Bàn, Hòa Hải, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 51411','Dù quý khách muốn tổ chức một sự kiện hay các dịp kỷ niệm đặc biệt khác, Shilla Monogram Quangnam Danang là lựa chọn tuyệt vời cho quý khách với phòng chức năng rộng lớn, được trang bị đầy đủ để sẵn sàng đáp ứng mọi yêu cầu.\r\n\r\nKhách sạn này là lựa chọn hoàn hảo cho các kỳ nghỉ mát lãng mạn hay tuần trăng mật của các cặp đôi. Quý khách hãy tận hưởng những đêm đáng nhớ nhất cùng người thương của mình tại Shilla Monogram Quangnam Danang','2023-05-27 16:07:49','2023-05-28 02:41:07',5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.969739823658!2d108.2864196112804!3d15.962956584637515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142119c2c123e41%3A0x9d58506e75be29bf!2sShilla%20Monogram%20Quangnam%20Danang!5e0!3m2!1sen!2s!4v1685216446001!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','',1,NULL,'Quận Ngũ Hành Sơn'),(121,'Furama Resort Danang','Resort','105 Võ Nguyên Giáp, phường Mỹ An, Khuê Mỹ, Ngũ Hành Sơn, Đà Nẵng, Việt Nam, 550000','Dù quý khách muốn tổ chức một sự kiện hay các dịp kỷ niệm đặc biệt khác, Furama Resort Danang là lựa chọn tuyệt vời cho quý khách với phòng chức năng rộng lớn, được trang bị đầy đủ để sẵn sàng đáp ứng mọi yêu cầu.\r\n\r\nKhách sạn này là lựa chọn hoàn hảo cho các kỳ nghỉ mát lãng mạn hay tuần trăng mật của các cặp đôi. Quý khách hãy tận hưởng những đêm đáng nhớ nhất cùng người thương của mình tại Furama Resort Danang','2023-05-27 16:10:57',NULL,5,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15337.798882317975!2d108.22523299653344!3d16.04213617531675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31420fdbc8cc38ef%3A0x9a6a3e31121225d2!2sFurama%20Resort%20Danang!5e0!3m2!1sen!2s!4v1685196527194!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Ngũ Hành Sơn'),(122,'Gold Plaza Hotel Da Nang','Khách sạn','11 Trần Thị Lý, Quận Hải Châu, Đà Nẵng, Việt Nam, 550000','Không chỉ sở hữu vị trí giúp quý khách dễ dàng ghé thăm những địa điểm lý thú trong chuyến hành trình, Gold Plaza Hotel Da Nang cũng sẽ mang đến cho quý khách trải nghiệm lưu trú mỹ mãn.\r\n\r\nTọa lạc gần sân bay, Gold Plaza Hotel Da Nang là nơi nghỉ ngơi lý tưởng trong lúc quý khách đang chờ chuyến bay kế tiếp. Quý khách có thể tận hưởng không gian nghỉ dưỡng vừa ý nơi đây trong quá trình quá cảnh.','2023-05-27 16:14:44',NULL,4,'admin',NULL,'ENABLE','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.3155859373064!2d108.2187515109813!3d16.049105139911727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142198c5e6b6873%3A0x37dc5609062af71c!2sGold%20Plaza%20Hotel%20Da%20Nang!5e0!3m2!1sen!2s!4v1685196745531!5m2!1sen!2s','Máy lạnh - Nhà hàng - Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi','Biển Mỹ Khê - Cầu sông Hàn - Sân bay quốc tế Đà Nẵng (DAD) - Khu cáp treo Bà Nà Hills',1,NULL,'Quận Hải Châu');
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `objectId` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=432 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (209,118,'20001392-578c6c21348c542af11851d0d53581a7.webp','ROOMTYPE'),(210,118,'20001392-9890c320d3a34fb0fcd75aecd3786852.webp','ROOMTYPE'),(211,118,'20001392-ae053a122eb284ae3a82238c656e1b01.webp','ROOMTYPE'),(212,118,'20001392-bd6eee28d4a5b7a5c658f419f9cca822.webp','ROOMTYPE'),(213,118,'20001392-de8848310a504a1c088be03f95cb0065.webp','ROOMTYPE'),(214,118,'20001392-ef9d4e8c88e4c7383dd448ed9f7230e4.webp','ROOMTYPE'),(215,119,'20001392-0144051b6769e888e6ca3fffa7be407e.webp','ROOMTYPE'),(216,119,'20001392-c5a4b68a16e5ab86b3271f605681d720.webp','ROOMTYPE'),(217,119,'20001392-d4dc04365efeafe66e578307cd60f977.webp','ROOMTYPE'),(218,119,'20001392-de87c1f9b49d4bf5b3b282367f3e0eda.webp','ROOMTYPE'),(219,103,'20001392-666c93d005ac91e0d7cf72f469a9f969.webp','HOTEL'),(220,103,'20001392-0810a0d9d10b6a6f01f8db55e190a5cd.webp','HOTEL'),(221,103,'20001392-369ae82fff19e1a2070b36e851ec8454.webp','HOTEL'),(222,103,'20001392-0f2d44fe071c9e80b22ae1cc84db78bc.webp','HOTEL'),(223,120,'20044571-1d70defaf13790d6d33808f7ba96fefe.webp','ROOMTYPE'),(224,120,'20044571-3f2311000d3a2e1dbeceac67a7502e7d.webp','ROOMTYPE'),(225,120,'20044571-4797a8d9c6ba8e19918a679316e951f6.webp','ROOMTYPE'),(226,120,'20044571-abdbfd8e4a5e3449480a386ab222123c.webp','ROOMTYPE'),(227,104,'20044571-4b109ba50f685e1f3cf732a0058036ac.webp','HOTEL'),(228,104,'20044571-3d7e636d1c979289d4b7a2d9159f7dd5.webp','HOTEL'),(229,104,'20044571-b043704568cdc165f60ae845d40ad160.webp','HOTEL'),(230,104,'20044571-e4512ca6df283588737ad749d5104cf8.webp','HOTEL'),(231,121,'20044571-fceb9ff022dfceb889a75023da62fa00.webp','ROOMTYPE'),(232,121,'20044571-d9fd98535875b0e740bb403a774d91be.webp','ROOMTYPE'),(233,121,'20044571-847614a7f597820cd07a4f31dd1e6c7f.webp','ROOMTYPE'),(234,121,'20044571-229be5ba6e83e999b9b108c0100402e6.webp','ROOMTYPE'),(235,121,'20044571-88b36206892883b4a5617593ded5fdb3.webp','ROOMTYPE'),(236,121,'20044571-4a86f9a303aa8817bd24fd194fad885c.webp','ROOMTYPE'),(237,121,'20044571-6a6112d04f1a6d2089a908cf79c8863b.webp','ROOMTYPE'),(238,121,'20044571-847614a7f597820cd07a4f31dd1e6c7f.webp','ROOMTYPE'),(239,122,'20044571-4a86f9a303aa8817bd24fd194fad885c.webp','ROOMTYPE'),(240,122,'20044571-4d9248147b39b64b564769df783a8c8e.webp','ROOMTYPE'),(241,122,'20044571-011fdf8fc2e7faa3077c8fbc074c2710.webp','ROOMTYPE'),(242,122,'20044571-b023836d3937945f16d42d245a3f8f54.webp','ROOMTYPE'),(243,122,'20044571-c864e293ace20456e87832e11d5ca4eb.webp','ROOMTYPE'),(244,123,'20044571-fceb9ff022dfceb889a75023da62fa00.webp','ROOMTYPE'),(245,123,'20044571-847614a7f597820cd07a4f31dd1e6c7f.webp','ROOMTYPE'),(246,123,'20044571-229be5ba6e83e999b9b108c0100402e6.webp','ROOMTYPE'),(247,123,'20044571-88b36206892883b4a5617593ded5fdb3.webp','ROOMTYPE'),(248,123,'20044571-6a6112d04f1a6d2089a908cf79c8863b.webp','ROOMTYPE'),(249,123,'20044571-4a86f9a303aa8817bd24fd194fad885c.webp','ROOMTYPE'),(250,124,'20012109-4a2f4dbcd1a608dcbd060ebd0b2ff368.webp','ROOMTYPE'),(251,124,'20012109-61fcefe382fa89c9ab4d43a93af89299.webp','ROOMTYPE'),(252,124,'20012109-4979ac22114d22003c1c0d597fde525a.webp','ROOMTYPE'),(253,124,'20012109-cc085e0506bb6cfba390ccb45c040f4a.webp','ROOMTYPE'),(254,124,'20012109-fa21933e4b333398c6b276eb030f1f18.webp','ROOMTYPE'),(255,105,'20012109-faeb1bf4368426bb93f14c8241c60b23.webp','HOTEL'),(256,105,'20012109-a44997b6c4b5ef491b1926ba8e6a3835.webp','HOTEL'),(257,105,'20012109-6698d99896beeaa7dabf5f49037a839f.webp','HOTEL'),(258,105,'20012109-193a802d533959e2b91dec652b3d4371.webp','HOTEL'),(259,105,'20012109-27a6d966e7fc26844d32a6eb64dbbdf6.webp','HOTEL'),(260,105,'20012109-9e50d6cec736c1ee85a1b797cfd1c463.webp','HOTEL'),(261,125,'10019543-0b3a6a0cfad9b1a677268b21e5a18640.webp','ROOMTYPE'),(262,125,'10019543-0f1218618aa2536ba4f1dc7758551cc4.webp','ROOMTYPE'),(263,125,'10019543-5ec007e43776c6e55acf225564ffdec0.webp','ROOMTYPE'),(264,125,'10019543-ef8df8a125cc72dd8bd8e02185ce6173.webp','ROOMTYPE'),(265,106,'10019543-c993553c5f20bc92f46589dd5bc4c54e.webp','HOTEL'),(266,106,'10019543-c6390c1780bfbb73ff7eff0519ab6ea0.webp','HOTEL'),(267,106,'10019543-a0d04c84a7a5b549484b4943d901cca5.webp','HOTEL'),(268,106,'10019543-58635e56f2c397d68854d0953a4ade2c.webp','HOTEL'),(269,126,'DADHA_4065451455_P.webp','ROOMTYPE'),(270,126,'DADHA_4772479771_P.webp','ROOMTYPE'),(271,126,'DADHA_8118899097_P.webp','ROOMTYPE'),(272,126,'DADHA_8145999471_P.webp','ROOMTYPE'),(273,126,'DADHA_8145999495_P.webp','ROOMTYPE'),(274,107,'DADHA_4665775173_P.webp','HOTEL'),(275,107,'DADHA_4018520270_P.webp','HOTEL'),(276,107,'DADHA_4772532995_P.webp','HOTEL'),(277,107,'DADHA_5377833848_P.webp','HOTEL'),(278,107,'DADHA_5377834097_P.webp','HOTEL'),(279,107,'DADHA_5377834166_P.webp','HOTEL'),(280,127,'20002090-0f7876ff8d6f95a279785d8e1ed35f16.webp','ROOMTYPE'),(281,127,'20002090-3adedac4634298c5dd8f0a92a1acd96d.webp','ROOMTYPE'),(282,127,'20002090-a5ea6ba17c24b63511c0ca25dd8b09c2.webp','ROOMTYPE'),(283,127,'20002090-a50ab2dee3e454a553b4ff4e08608a3d.webp','ROOMTYPE'),(284,127,'20002090-cd7b5aa6630d572d5fbd358f1f5a7f17.webp','ROOMTYPE'),(285,127,'20002090-e9564d7db7f30b6ee7c44321290848fd.webp','ROOMTYPE'),(286,127,'20002090-f3f2516ad4315c9954addc0f046f51b3.webp','ROOMTYPE'),(287,108,'20002090-a50ab2dee3e454a553b4ff4e08608a3d.webp','HOTEL'),(288,108,'20002090-adb940bb5e3580365ef3fed94d6fc0d2.webp','HOTEL'),(289,108,'20002090-e87f9241b02efd030eb83003a0d6486b.webp','HOTEL'),(290,108,'20002090-d425cc633e07de386564c9f76bc5429e.webp','HOTEL'),(291,108,'20002090-0f7876ff8d6f95a279785d8e1ed35f16.webp','HOTEL'),(292,128,'005bfc2b_z.webp','ROOMTYPE'),(293,128,'42eed7fc_z.webp','ROOMTYPE'),(294,128,'50b8a42c_z.webp','ROOMTYPE'),(295,128,'54a91148_z.webp','ROOMTYPE'),(296,128,'92775c7e_z.webp','ROOMTYPE'),(297,128,'69432190_z.webp','ROOMTYPE'),(298,109,'68634162_XL.webp','HOTEL'),(299,109,'79464062_XL.webp','HOTEL'),(300,109,'68634190_XL.webp','HOTEL'),(301,109,'68634102_XL.webp','HOTEL'),(302,109,'68634040_XL.webp','HOTEL'),(303,129,'10021706-1024x682-FIT_AND_TRIM-c75ca0a0e727b99430086cdc7654e509.webp','ROOMTYPE'),(304,129,'10021706-1024x683-FIT_AND_TRIM-31d0c916d0512e96738a9d16c1affde1.webp','ROOMTYPE'),(305,129,'10021706-1024x683-FIT_AND_TRIM-abd66c6af69d5bf5d8a9a472a47c2171.webp','ROOMTYPE'),(306,129,'10021706-1024x683-FIT_AND_TRIM-f8f08c0c29dd9076c1dcf7b489857d80.webp','ROOMTYPE'),(307,129,'10021706-c914903b4a2470599c212b876141b75b.webp','ROOMTYPE'),(308,110,'10021706-1024x682-FIT_AND_TRIM-c75ca0a0e727b99430086cdc7654e509.webp','HOTEL'),(309,110,'10021706-7fadc26003f53c7d5095d7d89ea4d363.webp','HOTEL'),(310,110,'10021706-1024x683-FIT_AND_TRIM-9d418a86e99c0a09927daf5884707656.webp','HOTEL'),(311,110,'10021706-1024x683-FIT_AND_TRIM-3063645f42ce029994018dc24e25469a.webp','HOTEL'),(312,130,'610241a_hb_ro_003.webp','ROOMTYPE'),(313,130,'610241a_hb_ro_005.webp','ROOMTYPE'),(314,130,'610241a_hb_ro_037.webp','ROOMTYPE'),(315,111,'b536ac29_z.webp','HOTEL'),(316,111,'27333044_z.webp','HOTEL'),(317,111,'3626140d_z.webp','HOTEL'),(318,111,'2307489f_z.webp','HOTEL'),(319,131,'20062212-9b6c27abe107aa0c592e8bd1b348ac7a.webp','ROOMTYPE'),(320,131,'20062212-705948a91f78bbad1720364249e56ea1.webp','ROOMTYPE'),(321,131,'20062212-a075060490e009ff746096f17bb9bb22.webp','ROOMTYPE'),(322,131,'20062212-cbea93438195c1218d1884be930582eb.webp','ROOMTYPE'),(323,131,'20062212-d9e34541e1b6bc4b61294347a6e0993b.webp','ROOMTYPE'),(324,112,'20062212-515cf42090ee23066851ec9cce3a3fd0.webp','HOTEL'),(325,112,'20062212-9004ca755444cf6309a3a72225c87cee.webp','HOTEL'),(326,112,'20062212-318f441bfdb199c6f75f77d5a1d4cfde.webp','HOTEL'),(327,112,'20062212-12eeb0e0ebfb1db05bdd2c26e0416f07.webp','HOTEL'),(328,132,'8c790d19_z.webp','ROOMTYPE'),(329,132,'25fcaebf_z.webp','ROOMTYPE'),(330,132,'18726f04_z.webp','ROOMTYPE'),(331,132,'c04b39eb_z.webp','ROOMTYPE'),(332,113,'0c1eae35_z.webp','HOTEL'),(333,113,'b459bdf0_z.webp','HOTEL'),(334,133,'10030437-2bd685da5be2e99b1b8c2b0def5f3d44.webp','ROOMTYPE'),(335,133,'10030437-3c3713fade26304d677f025eea8ada18.webp','ROOMTYPE'),(336,133,'10030437-8bcd4de149e08c22afcc78fcb68b484b.webp','ROOMTYPE'),(337,133,'10030437-1024x768-FIT_AND_TRIM-123732b454a04b35b903a3a3d49cc799.webp','ROOMTYPE'),(338,133,'10030437-6618400b212cb4acdbfe4c0d26f5ba36.webp','ROOMTYPE'),(339,133,'10030437-d4d7213ef381876e6127bea5aa265ad8.webp','ROOMTYPE'),(340,114,'10030437-2f886777518398937bdf75ecb9304495.webp','HOTEL'),(341,114,'10030437-8fdf752c32b02e8f120a8ac107ce0547.webp','HOTEL'),(342,114,'10030437-1100x825-FIT_AND_TRIM-a994f3bcf0cb6afdbc40d9f98661cb0a.webp','HOTEL'),(343,114,'10030437-a16aecb3c1fa84b634ca9ffef13a79f8.webp','HOTEL'),(344,134,'20004722-04c3ed0bfafa327294c5dd60992ae65e.webp','ROOMTYPE'),(345,134,'20004722-67b7901524e9d579c8da545d0c964b75.webp','ROOMTYPE'),(346,134,'20004722-686ccb50069608f2c1937eb5d14b309d.webp','ROOMTYPE'),(347,134,'20004722-b71141d0f075d06759a20e1bfea2f720.webp','ROOMTYPE'),(348,134,'20004722-fec811bbb18141c2801b66dac9cdf901.webp','ROOMTYPE'),(349,115,'20004722-e75243df7074d378a6a40608ffd7dde7.webp','HOTEL'),(350,135,'10038874-94b7ca6c3a3b38e2cf8cb2c9f4949e5b.webp','ROOMTYPE'),(351,135,'10038874-1600x970-FIT_AND_TRIM-6f0154a4ab809a4dbbc16e95fa411344.webp','ROOMTYPE'),(352,135,'10038874-c91922090c185076a9b590f08b64242a.webp','ROOMTYPE'),(353,135,'10038874-cf9929582af59d531a31aceeef9c8926.webp','ROOMTYPE'),(354,135,'10038874-e6f961d301aed7ef6c11a83c708d5ed9.webp','ROOMTYPE'),(355,116,'10038874-6cef8a9844638e1f22c308ad53571027.webp','HOTEL'),(356,116,'10038874-623cc4c3ac6c8eac4f5dcb6395cd9966.webp','HOTEL'),(357,116,'10038874-094653ceee85342badb6b7cd31009974.webp','HOTEL'),(358,116,'10038874-1600x1200-FIT_AND_TRIM-795f592777cddea2608f8c678ea88bc1.webp','HOTEL'),(359,136,'68645082_XL.webp','ROOMTYPE'),(360,136,'68645946_XL.webp','ROOMTYPE'),(361,136,'79758643_XL.webp','ROOMTYPE'),(362,136,'79758645_XL.webp','ROOMTYPE'),(363,117,'73232271_XL.webp','HOTEL'),(364,117,'68645060_XL.webp','HOTEL'),(365,117,'73232273_XL.webp','HOTEL'),(366,117,'68645018_XL.webp','HOTEL'),(367,137,'10025979-268d2c50a758828fa1292b7e73df0924.webp','ROOMTYPE'),(368,137,'10025979-1024x683-FIT_AND_TRIM-7e8f2f68e4829677432811db98559b6b.webp','ROOMTYPE'),(369,137,'10025979-1024x683-FIT_AND_TRIM-253b5190bf76d6d7d59393d452203c1b.webp','ROOMTYPE'),(370,137,'10025979-1024x683-FIT_AND_TRIM-5352bba0e228335cdf151edf9005d76c.webp','ROOMTYPE'),(371,137,'10025979-1152x768-FIT_AND_TRIM-f9834d153f9656d218963fd5e4ec6594.webp','ROOMTYPE'),(372,118,'10025979-de3bfd1358a6ba76280f02d404cfaab8.webp','HOTEL'),(373,118,'10025979-3926caccfbcefa536ac21b9dd19be36e.webp','HOTEL'),(374,118,'10025979-672fb1bcde8fbcdaa8ffa4aa1deb7474.webp','HOTEL'),(375,118,'10025979-6aafae1d03c514e70c977d7d339d2478.webp','HOTEL'),(376,138,'1f194331_z.webp','ROOMTYPE'),(377,138,'5ec4d82d_z.webp','ROOMTYPE'),(378,138,'8247331d_z.webp','ROOMTYPE'),(379,119,'06584d3c_z.webp','HOTEL'),(380,119,'ce6314fa_z.webp','HOTEL'),(381,119,'d723ad62_z.webp','HOTEL'),(382,139,'20039161-257a25be0d701cd34961299bca3816e8.webp','ROOMTYPE'),(383,139,'20039161-110129d138f4a809cf2dc9ae183aace7.webp','ROOMTYPE'),(384,139,'20039161-f45e0783d6de542fedc3cf69252d6dd0.webp','ROOMTYPE'),(385,139,'20039161-f95390713f049e725e60972b148a7672.webp','ROOMTYPE'),(386,120,'20039161-b9149e10acee987800a19826736647ad.webp','HOTEL'),(387,120,'20039161-a605f0116d920724169313e2b0ea7aa4.webp','HOTEL'),(388,120,'20039161-89362dd1ee40d6de4d93ae69e055d22b.webp','HOTEL'),(389,120,'20039161-890f3355fe86773c249f338e494f6366.webp','HOTEL'),(390,140,'06e0895d_z.webp','ROOMTYPE'),(391,140,'7e731393_z.webp','ROOMTYPE'),(392,140,'38684e11_z.webp','ROOMTYPE'),(393,140,'c2ce7ae0_z.webp','ROOMTYPE'),(394,140,'d285b37f_z.webp','ROOMTYPE'),(395,121,'10024652-bc18297d4573af8399677d30a0363d4e.webp','HOTEL'),(396,121,'10024652-2500x1660-FIT_AND_TRIM-b5ca5fa8870f7e8634d0d855c4f44b73.webp','HOTEL'),(397,121,'10024652-1073x735-FIT_AND_TRIM-51f62b3859e789c4cedcf556594553c4.webp','HOTEL'),(398,141,'67782898-0cef02daedbed8adf768b71f5992df4d.webp','ROOMTYPE'),(399,141,'67782898-208b00caab6c340c0b649e17cf25b6e8.webp','ROOMTYPE'),(400,141,'67782898-377eabe29b557fc167a244b63eedb92f.webp','ROOMTYPE'),(401,141,'67782898-940ce2c3757833587ed10804d79b468f.webp','ROOMTYPE'),(402,141,'67782898-e13ce86c4806d306fe1633a78e9803cf.webp','ROOMTYPE'),(403,122,'67782898-dc3ad170eb0e4b1e647195959cafa136.webp','HOTEL'),(404,122,'67782898-1e873c8b5fa6684bd7820b55662f98c3.webp','HOTEL'),(405,122,'20040646-c4bd615f9b9edfb97efd6a3da706d950.webp','HOTEL'),(406,142,'67845456-4d4cb1979b5b845602bde74b94320e8f.webp','ROOMTYPE'),(407,142,'67845456-764bf28bf5df62420f11a4e5e218a985.webp','ROOMTYPE'),(408,142,'67845456-f2446dbb0384f90b0ef9bf92a3386407.webp','ROOMTYPE'),(409,142,'67845456-9527ccbed6af5cda628b915ade44c8b1.webp','ROOMTYPE'),(410,143,'67845456-1a9268e1c8c6a5f3320e0253f0d654e7.webp','ROOMTYPE'),(411,143,'67845456-9c56429117cb226b6f1b258deabbba82.webp','ROOMTYPE'),(412,143,'67845456-73fc41864512d8a1239dab67391abc5a.webp','ROOMTYPE'),(413,143,'67845456-ccc10e31ca930fc01c8990acb9c47f89.webp','ROOMTYPE'),(414,143,'67845456-dfa4c5cb83ba46aabdd45dacd92403b1.webp','ROOMTYPE'),(415,144,'c5526b31_z.webp','ROOMTYPE'),(416,144,'aef0fa16_z.webp','ROOMTYPE'),(417,144,'80768753_z.webp','ROOMTYPE'),(418,144,'933e2330_z.webp','ROOMTYPE'),(419,144,'3aa1d73c_z.webp','ROOMTYPE'),(420,145,'5bc3d131_z.webp','ROOMTYPE'),(421,145,'7c82bb71_z.webp','ROOMTYPE'),(422,145,'8b9702d6_z.webp','ROOMTYPE'),(423,145,'45ae4b2e_z.webp','ROOMTYPE'),(424,145,'933e2330_z.webp','ROOMTYPE'),(425,146,'45ae4b2e_z.webp','ROOMTYPE'),(426,146,'20039161-257a25be0d701cd34961299bca3816e8.webp','ROOMTYPE'),(427,146,'20039161-110129d138f4a809cf2dc9ae183aace7.webp','ROOMTYPE'),(428,146,'20039161-dca56c0367f19f2bbccff79480867db3.webp','ROOMTYPE'),(429,147,'1f194331_z.webp','ROOMTYPE'),(430,147,'5ec4d82d_z.webp','ROOMTYPE'),(431,147,'8247331d_z.webp','ROOMTYPE');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` mediumtext DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `cancelBy` varchar(255) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `userId` int(11) DEFAULT NULL,
  `paymentId` int(11) DEFAULT NULL,
  `createdBy` varchar(255) DEFAULT NULL,
  `updatedBy` varchar(255) DEFAULT NULL,
  `price` decimal(20,3) DEFAULT NULL,
  `emailContact` varchar(255) DEFAULT NULL,
  `mobileContact` int(11) DEFAULT NULL,
  `fromDate` datetime DEFAULT NULL,
  `toDate` datetime DEFAULT NULL,
  `numberDay` int(11) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `hotelId` int(11) DEFAULT NULL,
  `noteAdmin` longtext DEFAULT NULL,
  `reasonCancel` longtext DEFAULT NULL,
  `cancelAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (62,'tôi sẽ checkin sớm','2023-05-27 22:55:28','ENABLE',NULL,NULL,33,1,'duydanprovip@gmail.com',NULL,362000.000,'danCustomer@gmail.com',638944512,'2023-05-31 12:00:00','2023-06-01 12:00:00',1,NULL,122,NULL,NULL,NULL),(63,'','2023-05-27 23:08:58','ENABLE',NULL,NULL,34,1,'hung@gmail.com',NULL,1871100.000,'hung@gmail.com',988888888,'2023-05-28 12:00:00','2023-05-30 12:00:00',2,NULL,117,NULL,NULL,NULL),(64,'','2023-05-27 23:11:39','ENABLE',NULL,NULL,35,2,'ngoc@gmail.com',NULL,144800.000,'ngoc@gmail.com',988888888,'2023-05-29 12:00:00','2023-05-31 12:00:00',2,NULL,122,NULL,NULL,NULL),(65,'','2023-05-27 23:12:53','ENABLE',NULL,NULL,35,3,'ngoc@gmail.com',NULL,3637324.000,'ngocnm@rising-stars.vn',978445612,'2023-06-01 12:00:00','2023-06-09 12:00:00',8,NULL,119,NULL,NULL,NULL),(66,'','2023-05-28 04:56:06','ENABLE',NULL,NULL,35,1,'ngoc@gmail.com',NULL,3139329.000,'ngminhnhat@gmail.com',988888888,'2023-06-29 12:00:00','2023-06-30 12:00:00',1,NULL,121,NULL,NULL,NULL);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicedetails`
--

DROP TABLE IF EXISTS `invoicedetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicedetails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoiceId` int(11) DEFAULT NULL,
  `roomTypeId` int(11) DEFAULT NULL,
  `price` decimal(20,3) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `roomCode` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'ENABLE',
  `isUseDeposit` tinyint(1) DEFAULT NULL,
  `depositPercent` decimal(20,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicedetails`
--

LOCK TABLES `invoicedetails` WRITE;
/*!40000 ALTER TABLE `invoicedetails` DISABLE KEYS */;
INSERT INTO `invoicedetails` VALUES (64,62,141,362000.000,5,NULL,NULL,'ENABLE',1,10.000),(65,63,136,935550.000,1,NULL,NULL,'ENABLE',1,10.000),(66,63,136,935550.000,1,NULL,NULL,'ENABLE',1,10.000),(67,64,141,144800.000,1,NULL,NULL,'ENABLE',1,10.000),(68,65,138,3637324.000,1,NULL,NULL,'ENABLE',1,10.000),(69,66,140,912057.000,2,NULL,NULL,'ENABLE',1,10.000),(70,66,142,1000000.000,1,NULL,NULL,'ENABLE',1,10.000),(71,66,143,1227272.000,1,NULL,NULL,'ENABLE',1,10.000);
/*!40000 ALTER TABLE `invoicedetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicepayment`
--

DROP TABLE IF EXISTS `invoicepayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicepayment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoiceId` int(11) DEFAULT NULL,
  `cardNumber` varchar(255) DEFAULT NULL,
  `cardHolder` varchar(255) DEFAULT NULL,
  `expirationDate` varchar(255) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `eWalletId` varchar(255) DEFAULT NULL,
  `eWalletPassword` varchar(255) DEFAULT NULL,
  `bankName` varchar(255) DEFAULT NULL,
  `atmNumber` varchar(255) DEFAULT NULL,
  `atmPin` varchar(255) DEFAULT NULL,
  `paymentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicepayment`
--

LOCK TABLES `invoicepayment` WRITE;
/*!40000 ALTER TABLE `invoicepayment` DISABLE KEYS */;
INSERT INTO `invoicepayment` VALUES (51,62,'123456789','Đang','02/2023','123','','','','','',1),(52,63,'1234566789','Hùng nguyễn','08/2023','12346','','','','','',1),(53,64,'','','','','ngoc@gmail.com','852654','','','',2),(54,65,'','','','','','','Ngân hàng tpbank','123456789','852654',3),(55,66,'123456780','nhật','08/2023','123456','','','','','',1);
/*!40000 ALTER TABLE `invoicepayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Issue` varchar(100) DEFAULT '',
  `description` longtext DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `adminRemark` mediumtext DEFAULT NULL,
  `adminremarkDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `invoiceId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (4,'tôi cần thêm chăn','tôi dễ cảm nên cần thêm chăn','2023-05-27 23:13:43',NULL,NULL,'ENABLE','WAITING',65);
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'PRIVACY_TERMS','Các chỗ nghỉ STR có thể phải tuân theo các quy định cụ thể và khác nhau tùy theo quốc gia, khu vực và thành phố. Quy định về STR có thể bao gồm, nhưng không giới hạn ở:\n\nYêu cầu về giấy phép hoặc đăng ký\nYêu cầu về giấy phép và quy hoạch\nYêu cầu về sức khỏe và an toàn\nYêu cầu về lưu trú\nGiới hạn số khách mỗi lần thuê\nGiới hạn số đêm cho thuê mỗi năm\nYêu cầu báo cáo thông tin giữa đối tác và chính quyền địa phương (ví dụ: số lượng khách và độ dài lưu trú của mỗi đơn đặt)','Pháp lý và bảo mật','2023-05-13 15:20:08','2023-05-13 15:38:01','ENABLE'),(2,'LOST_POLICY','Các giải pháp thanh toán của Booking.com hoạt động ra sao?\nChúng tôi có thể giúp Quý vị xử lý thanh toán của khách theo cách phù hợp với nhu cầu của chỗ nghỉ. Chúng tôi có thể thanh toán cho Quý vị bằng thẻ tín dụng ảo (VCC) hoặc qua chuyển khoản ngân hàng. Để biết tùy chọn nào khả dụng cho chỗ nghỉ của Quý vị, vui lòng truy cập extranet > Tài chính > Cài đặt tài chính.\n\nTrước đây, có thể du khách quốc tế không đặt được chỗ nghỉ Quý vị vì không có lựa chọn thanh toán mà họ muốn. Để nhiều khách có thể đặt với Quý vị, chúng tôi giờ đây có hỗ trợ các giải pháp thanh toán sau:','Thanh toán: Những câu hỏi thường gặp','2023-05-13 15:49:31','2023-05-26 16:24:17','ENABLE'),(3,'CONTACT_ADMIN','Trợ giúp khách của Quý vị trong mùa cao điểm\nTrong mùa cao điểm du lịch, số khách cần đến sự trợ giúp từ đội ngũ Dịch vụ Khách hàng của chúng tôi nhiều hơn thông thường. Nếu khách của Quý vị cần liên hệ với chúng tôi, vui lòng hướng dẫn họ truy cập Trung tâm Trợ giúp của chúng tôi.\n\nThông qua Trung tâm Trợ giúp, chúng tôi có thể hỗ trợ khách của Quý vị theo ngôn ngữ mà họ mong muốn và ưu tiên thành viên Genius Cấp 3 cùng khách sắp đến ngày đi. Chúng tôi có thể cung cấp cho họ thông tin cần thiết để tự quản lý đặt chỗ của mình hoặc đề xuất họ liên hệ với đội ngũ Dịch vụ Khách hàng của chúng tôi qua email, chat trực tiếp hoặc điện thoại.\n\nVui lòng không chia sẻ cho khách các thông tin liên hệ mà Quý vị sử dụng để liên lạc với chúng tôi, vì chúng tôi không thể giúp khách nếu họ liên lạc theo cách này. Điều này còn có thể gây chậm trễ và bất tiện cho cả Quý vị lẫn khách trong lúc trải nghiệm dịch vụ.\n\n','Cách để liên hệ với chúng tôi','2023-05-13 15:52:15',NULL,'ENABLE');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentmethod`
--

DROP TABLE IF EXISTS `paymentmethod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymentmethod` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentmethod`
--

LOCK TABLES `paymentmethod` WRITE;
/*!40000 ALTER TABLE `paymentmethod` DISABLE KEYS */;
INSERT INTO `paymentmethod` VALUES (1,'Thẻ tín dụng / Ghi nợ','2023-05-13 15:20:08'),(2,'Thanh toán điện tử','2023-05-13 15:20:08'),(3,'Thẻ ATM nội địa','2023-05-13 15:20:08');
/*!40000 ALTER TABLE `paymentmethod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratehotels`
--

DROP TABLE IF EXISTS `ratehotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratehotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `hotelId` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratehotels`
--

LOCK TABLES `ratehotels` WRITE;
/*!40000 ALTER TABLE `ratehotels` DISABLE KEYS */;
INSERT INTO `ratehotels` VALUES (34,NULL,122,5,'Khách sạn tuyệt vời','ENABLE','2023-05-27 23:06:25','2023-05-27 23:16:33'),(35,NULL,122,5,'','WAITING','2023-05-28 04:59:51',NULL),(36,NULL,120,4,'Khách sạn checkin hơi lâu','WAITING','2023-05-28 05:00:17',NULL);
/*!40000 ALTER TABLE `ratehotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roomtype`
--

DROP TABLE IF EXISTS `roomtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roomtype` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `hotelId` int(11) NOT NULL,
  `feature` varchar(255) DEFAULT NULL,
  `benefit` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `doubleBed` int(11) DEFAULT NULL,
  `singleBed` int(11) DEFAULT NULL,
  `totalNumber` int(11) DEFAULT NULL,
  `price` decimal(20,3) DEFAULT NULL,
  `numberCustomer` int(11) DEFAULT NULL,
  `depositPercent` decimal(20,3) DEFAULT NULL,
  `isUseDeposit` tinyint(1) DEFAULT 1,
  `priceRoot` decimal(20,3) DEFAULT NULL,
  `acreage` varchar(45) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'ENABLE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roomtype`
--

LOCK TABLES `roomtype` WRITE;
/*!40000 ALTER TABLE `roomtype` DISABLE KEYS */;
INSERT INTO `roomtype` VALUES (118,'Deluxe Double',103,NULL,NULL,'DD',1,0,10,368000.000,2,10.000,1,NULL,'22','ENABLE'),(119,'Premier Double',103,NULL,NULL,'PD',1,0,10,460000.000,2,10.000,1,NULL,'25','ENABLE'),(120,'Superior Double',104,NULL,NULL,'SD',1,0,10,600600.000,2,10.000,1,NULL,'22','ENABLE'),(121,'Deluxe Twin',104,NULL,NULL,'DT',1,1,10,629000.000,2,10.000,0,NULL,'22','ENABLE'),(122,'Deluxe Double',104,NULL,NULL,'DD',1,0,10,715000.000,2,10.000,0,NULL,'22','ENABLE'),(123,'Deluxe Triple',103,NULL,NULL,'DT',1,1,10,972000.000,3,10.000,0,NULL,'2','ENABLE'),(124,'Deluxe Room - Breakfast - Bf1',105,NULL,NULL,'DR',0,2,10,1771621.000,2,10.000,1,NULL,'41','ENABLE'),(125,'Premium Family Panoramic Ocean View - Room Only, Quad Room',106,NULL,NULL,'PFPO',0,4,10,6390000.000,4,10.000,1,NULL,'90','ENABLE'),(126,'2 Queen Classic Panoramic Ocean View',107,NULL,NULL,'QC',0,1,10,15079867.000,1,10.000,1,NULL,'70','ENABLE'),(127,'Villa 2 Bedroom - Babb (breakfast)',108,NULL,NULL,'VB',1,0,10,10560000.000,4,10.000,1,NULL,'50','ENABLE'),(128,'Superior 1 King Bed Balcony',109,NULL,NULL,'SKB',0,1,10,2454386.000,1,10.000,1,NULL,'80','ENABLE'),(129,'Babylon Double',110,NULL,NULL,'BD',1,0,10,7113333.000,2,10.000,1,NULL,'45','ENABLE'),(130,'Twin Twin Guest Ocean View',111,NULL,NULL,'TTGOV',0,1,10,2599719.000,1,10.000,1,NULL,'37','ENABLE'),(131,'Deluxe City Queen',112,NULL,NULL,'DCQ',1,0,10,1748450.000,2,10.000,1,NULL,'25','ENABLE'),(132,'King Bed Ocean View',113,NULL,NULL,'KBOV',1,0,10,2869889.000,1,10.000,1,NULL,'50','ENABLE'),(133,'Bedroom Pool Villa',114,NULL,NULL,'BPV',1,0,10,6403050.000,2,10.000,1,NULL,'170','ENABLE'),(134,'Deluxe Twin Balcony',115,NULL,NULL,'DTB',1,0,10,2266137.000,2,10.000,1,NULL,'37','ENABLE'),(135,'Melia Guestroom Clg',116,NULL,NULL,'MGC',1,2,10,3216330.000,2,10.000,1,NULL,'28','ENABLE'),(136,'Superior 2 Single Beds Balcony',117,NULL,NULL,'SSBB',0,2,10,4677750.000,1,10.000,1,NULL,'50','ENABLE'),(137,'Superior King',118,NULL,NULL,'SK',0,2,10,1999861.000,2,10.000,1,NULL,'28','ENABLE'),(138,'1 King Bed',119,NULL,NULL,'KB',0,1,10,4546655.000,1,10.000,1,NULL,'28','ENABLE'),(139,'Superior Twin Partial Ocean View',120,NULL,NULL,'STPOV',0,2,10,4365919.000,2,10.000,1,NULL,'36','ENABLE'),(140,'Superior Pool View',121,NULL,NULL,'SPV',2,1,10,4560285.000,1,10.000,1,NULL,'38','ENABLE'),(141,'Superior Twin River View',122,NULL,NULL,'STRV',2,1,10,724000.000,2,10.000,0,NULL,'28','ENABLE'),(142,'Villa 03 Bedrooms With Gardenview',121,NULL,NULL,'V3D',1,2,10,10000000.000,6,10.000,1,NULL,'350','ENABLE'),(143,'Villa 04 Bedrooms With Gardenview',121,NULL,NULL,'VDB',2,2,10,12272728.000,8,10.000,0,NULL,'400','ENABLE'),(144,'Premium Family Quad Panoramic Ocean View',106,NULL,NULL,'PF',1,2,10,5413557.000,1,10.000,0,NULL,'60','ENABLE'),(145,'Superior Twin 2 Twin Beds Balcony',109,NULL,NULL,'STP',2,2,10,2454386.000,1,10.000,0,NULL,'50','ENABLE'),(146,'Deluxe Twin Ocean View',120,NULL,NULL,'DTO',2,2,10,4885671.000,1,10.000,0,NULL,'36','ENABLE'),(147,'1 King Bed Ocean View',119,NULL,NULL,'KB',1,1,10,4546655.000,2,10.000,0,NULL,'11','ENABLE');
/*!40000 ALTER TABLE `roomtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roomtypeconvenient`
--

DROP TABLE IF EXISTS `roomtypeconvenient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roomtypeconvenient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `convenientId` int(11) DEFAULT NULL,
  `roomTypeId` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1280 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roomtypeconvenient`
--

LOCK TABLES `roomtypeconvenient` WRITE;
/*!40000 ALTER TABLE `roomtypeconvenient` DISABLE KEYS */;
INSERT INTO `roomtypeconvenient` VALUES (819,1,116,NULL),(820,2,116,NULL),(821,3,116,NULL),(822,4,116,NULL),(823,5,116,NULL),(824,6,116,NULL),(825,7,116,NULL),(826,8,116,NULL),(827,9,116,NULL),(828,10,116,NULL),(829,11,116,NULL),(830,12,116,NULL),(831,1,118,NULL),(832,2,118,NULL),(833,3,118,NULL),(834,4,118,NULL),(835,5,118,NULL),(836,6,118,NULL),(837,7,118,NULL),(838,8,118,NULL),(839,9,118,NULL),(840,10,118,NULL),(841,11,118,NULL),(842,12,118,NULL),(843,1,120,NULL),(844,2,120,NULL),(845,3,120,NULL),(846,4,120,NULL),(847,5,120,NULL),(848,6,120,NULL),(849,7,120,NULL),(850,8,120,NULL),(851,9,120,NULL),(852,10,120,NULL),(853,11,120,NULL),(854,12,120,NULL),(855,1,121,NULL),(856,2,121,NULL),(857,3,121,NULL),(858,4,121,NULL),(859,5,121,NULL),(860,6,121,NULL),(861,7,121,NULL),(862,8,121,NULL),(863,9,121,NULL),(864,10,121,NULL),(865,11,121,NULL),(866,12,121,NULL),(867,1,122,NULL),(868,2,122,NULL),(869,3,122,NULL),(870,4,122,NULL),(871,5,122,NULL),(872,6,122,NULL),(873,7,122,NULL),(874,8,122,NULL),(875,9,122,NULL),(876,1,123,NULL),(877,2,123,NULL),(878,3,123,NULL),(879,4,123,NULL),(880,5,123,NULL),(881,6,123,NULL),(882,7,123,NULL),(883,8,123,NULL),(884,9,123,NULL),(885,10,123,NULL),(886,11,123,NULL),(887,12,123,NULL),(888,1,124,NULL),(889,2,124,NULL),(890,3,124,NULL),(891,4,124,NULL),(892,5,124,NULL),(893,6,124,NULL),(894,7,124,NULL),(895,8,124,NULL),(896,9,124,NULL),(897,10,124,NULL),(898,11,124,NULL),(899,12,124,NULL),(900,1,125,NULL),(901,2,125,NULL),(902,3,125,NULL),(903,4,125,NULL),(904,5,125,NULL),(905,6,125,NULL),(906,7,125,NULL),(907,8,125,NULL),(908,9,125,NULL),(909,10,125,NULL),(910,11,125,NULL),(911,12,125,NULL),(912,2,126,NULL),(913,3,126,NULL),(914,4,126,NULL),(915,5,126,NULL),(916,6,126,NULL),(917,7,126,NULL),(918,8,126,NULL),(919,9,126,NULL),(920,10,126,NULL),(921,11,126,NULL),(922,12,126,NULL),(923,1,127,NULL),(924,2,127,NULL),(925,3,127,NULL),(926,4,127,NULL),(927,5,127,NULL),(928,6,127,NULL),(929,7,127,NULL),(930,8,127,NULL),(931,9,127,NULL),(932,10,127,NULL),(933,11,127,NULL),(934,12,127,NULL),(935,1,128,NULL),(936,2,128,NULL),(937,3,128,NULL),(938,4,128,NULL),(939,5,128,NULL),(940,6,128,NULL),(941,7,128,NULL),(942,8,128,NULL),(943,9,128,NULL),(944,10,128,NULL),(945,11,128,NULL),(946,12,128,NULL),(947,1,129,NULL),(948,2,129,NULL),(949,3,129,NULL),(950,4,129,NULL),(951,5,129,NULL),(952,6,129,NULL),(953,7,129,NULL),(954,8,129,NULL),(955,9,129,NULL),(956,10,129,NULL),(957,11,129,NULL),(958,12,129,NULL),(959,1,130,NULL),(960,2,130,NULL),(961,3,130,NULL),(962,4,130,NULL),(963,5,130,NULL),(964,6,130,NULL),(965,7,130,NULL),(966,8,130,NULL),(967,9,130,NULL),(968,10,130,NULL),(969,11,130,NULL),(970,12,130,NULL),(971,1,131,NULL),(972,2,131,NULL),(973,3,131,NULL),(974,4,131,NULL),(975,5,131,NULL),(976,6,131,NULL),(977,7,131,NULL),(978,8,131,NULL),(979,9,131,NULL),(980,10,131,NULL),(981,11,131,NULL),(982,12,131,NULL),(983,1,132,NULL),(984,2,132,NULL),(985,3,132,NULL),(986,4,132,NULL),(987,5,132,NULL),(988,6,132,NULL),(989,7,132,NULL),(990,8,132,NULL),(991,9,132,NULL),(992,10,132,NULL),(993,11,132,NULL),(994,12,132,NULL),(995,1,133,NULL),(996,2,133,NULL),(997,3,133,NULL),(998,4,133,NULL),(999,5,133,NULL),(1000,6,133,NULL),(1001,7,133,NULL),(1002,8,133,NULL),(1003,9,133,NULL),(1004,10,133,NULL),(1005,11,133,NULL),(1006,12,133,NULL),(1007,1,134,NULL),(1008,2,134,NULL),(1009,3,134,NULL),(1010,4,134,NULL),(1011,5,134,NULL),(1012,6,134,NULL),(1013,7,134,NULL),(1014,8,134,NULL),(1015,9,134,NULL),(1016,10,134,NULL),(1017,11,134,NULL),(1018,12,134,NULL),(1019,1,135,NULL),(1020,2,135,NULL),(1021,3,135,NULL),(1022,4,135,NULL),(1023,5,135,NULL),(1024,6,135,NULL),(1025,7,135,NULL),(1026,8,135,NULL),(1027,9,135,NULL),(1028,10,135,NULL),(1029,11,135,NULL),(1030,12,135,NULL),(1031,1,136,NULL),(1032,2,136,NULL),(1033,3,136,NULL),(1034,4,136,NULL),(1035,5,136,NULL),(1036,6,136,NULL),(1037,7,136,NULL),(1038,8,136,NULL),(1039,9,136,NULL),(1040,10,136,NULL),(1041,11,136,NULL),(1042,12,136,NULL),(1043,1,137,NULL),(1044,2,137,NULL),(1045,3,137,NULL),(1046,4,137,NULL),(1047,5,137,NULL),(1048,6,137,NULL),(1049,7,137,NULL),(1050,8,137,NULL),(1051,9,137,NULL),(1052,10,137,NULL),(1053,11,137,NULL),(1054,12,137,NULL),(1055,1,138,NULL),(1056,2,138,NULL),(1057,3,138,NULL),(1058,4,138,NULL),(1059,5,138,NULL),(1060,6,138,NULL),(1061,7,138,NULL),(1062,8,138,NULL),(1063,9,138,NULL),(1064,10,138,NULL),(1065,11,138,NULL),(1066,12,138,NULL),(1067,1,139,NULL),(1068,2,139,NULL),(1069,3,139,NULL),(1070,4,139,NULL),(1071,5,139,NULL),(1072,6,139,NULL),(1073,7,139,NULL),(1074,8,139,NULL),(1075,9,139,NULL),(1076,10,139,NULL),(1077,11,139,NULL),(1078,12,139,NULL),(1079,1,140,NULL),(1080,2,140,NULL),(1081,3,140,NULL),(1082,4,140,NULL),(1083,5,140,NULL),(1084,6,140,NULL),(1085,7,140,NULL),(1086,8,140,NULL),(1087,9,140,NULL),(1088,10,140,NULL),(1089,11,140,NULL),(1090,12,140,NULL),(1129,1,143,NULL),(1130,2,143,NULL),(1131,3,143,NULL),(1132,4,143,NULL),(1133,5,143,NULL),(1134,6,143,NULL),(1135,7,143,NULL),(1136,8,143,NULL),(1137,9,143,NULL),(1138,10,143,NULL),(1139,11,143,NULL),(1140,12,143,NULL),(1141,1,144,NULL),(1142,2,144,NULL),(1143,3,144,NULL),(1144,4,144,NULL),(1145,5,144,NULL),(1146,6,144,NULL),(1147,7,144,NULL),(1148,8,144,NULL),(1149,9,144,NULL),(1150,10,144,NULL),(1151,11,144,NULL),(1152,12,144,NULL),(1153,21,144,NULL),(1154,1,145,NULL),(1155,2,145,NULL),(1156,3,145,NULL),(1157,4,145,NULL),(1158,5,145,NULL),(1159,6,145,NULL),(1160,7,145,NULL),(1161,8,145,NULL),(1162,9,145,NULL),(1163,10,145,NULL),(1164,11,145,NULL),(1165,12,145,NULL),(1166,1,146,NULL),(1167,2,146,NULL),(1168,3,146,NULL),(1169,4,146,NULL),(1170,5,146,NULL),(1171,6,146,NULL),(1172,7,146,NULL),(1173,8,146,NULL),(1174,9,146,NULL),(1175,10,146,NULL),(1176,11,146,NULL),(1177,12,146,NULL),(1178,21,146,NULL),(1179,1,147,NULL),(1180,2,147,NULL),(1181,3,147,NULL),(1182,4,147,NULL),(1183,5,147,NULL),(1184,6,147,NULL),(1185,7,147,NULL),(1186,8,147,NULL),(1187,9,147,NULL),(1188,10,147,NULL),(1254,1,142,NULL),(1255,2,142,NULL),(1256,3,142,NULL),(1257,4,142,NULL),(1258,5,142,NULL),(1259,6,142,NULL),(1260,7,142,NULL),(1261,8,142,NULL),(1262,9,142,NULL),(1263,10,142,NULL),(1264,11,142,NULL),(1265,12,142,NULL),(1266,21,142,NULL),(1267,1,141,NULL),(1268,2,141,NULL),(1269,3,141,NULL),(1270,4,141,NULL),(1271,5,141,NULL),(1272,6,141,NULL),(1273,7,141,NULL),(1274,8,141,NULL),(1275,9,141,NULL),(1276,10,141,NULL),(1277,11,141,NULL),(1278,12,141,NULL),(1279,21,141,NULL);
/*!40000 ALTER TABLE `roomtypeconvenient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) DEFAULT NULL,
  `mobileNumber` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (33,'Duy Đan','0815114785','duydanprovip@gmail.com','c4e33bbf6c3e0e19a6c93e350cbb14c1','2023-05-27 22:50:27',NULL,'ENABLE'),(34,'Hùng Nguyễn','0812223132','hung@gmail.com','c4e33bbf6c3e0e19a6c93e350cbb14c1','2023-05-27 23:05:39',NULL,'ENABLE'),(35,'ngọc','0986755745','ngoc@gmail.com','c4e33bbf6c3e0e19a6c93e350cbb14c1','2023-05-27 23:09:57',NULL,'ENABLE'),(36,'Nhật','0987445479','nhat@gmail.com','c4e33bbf6c3e0e19a6c93e350cbb14c1','2023-05-28 04:57:00',NULL,'ENABLE'),(37,'Tùng VIP','0789335468','tung@gmail.com','c4e33bbf6c3e0e19a6c93e350cbb14c1','2023-05-28 04:58:53',NULL,'ENABLE'),(38,'Huy Nguyễn','0777456893','ngminhhuy@gmail.com','c4e33bbf6c3e0e19a6c93e350cbb14c1','2023-05-28 04:59:33',NULL,'ENABLE');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-28  6:07:21
