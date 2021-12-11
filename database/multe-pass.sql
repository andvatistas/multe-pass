-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 08:56 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multe-pass`
--

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `abbreviation` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `name`, `abbreviation`) VALUES
('aodos', 'Attiki Odos', 'AO'),
('egnatia', 'Egnatia Odos', 'KO'),
('gefyra', 'Gefyra', 'GF'),
('kentriki_odos', 'Kentriki Odos', 'KO'),
('moreas', 'Moreas', 'MR'),
('nea_odos', 'Nea Odos', 'NO'),
('olympia_odos', 'Olympia Odos', 'OO');

-- --------------------------------------------------------

--
-- Table structure for table `pass`
--

CREATE TABLE `pass` (
  `id` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `tagId` varchar(20) NOT NULL,
  `stationRef` varchar(10) NOT NULL,
  `charge` decimal(13,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `id` varchar(10) NOT NULL,
  `stationName` varchar(40) NOT NULL,
  `stationProvider` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`id`, `stationName`, `stationProvider`) VALUES
('AO00', 'aodos tolls station 00', 'aodos'),
('AO01', 'aodos tolls station 01', 'aodos'),
('AO02', 'aodos tolls station 02', 'aodos'),
('AO03', 'aodos tolls station 03', 'aodos'),
('AO04', 'aodos tolls station 04', 'aodos'),
('AO05', 'aodos tolls station 05', 'aodos'),
('AO06', 'aodos tolls station 06', 'aodos'),
('AO07', 'aodos tolls station 07', 'aodos'),
('AO08', 'aodos tolls station 08', 'aodos'),
('AO09', 'aodos tolls station 09', 'aodos'),
('AO10', 'aodos tolls station 10', 'aodos'),
('AO11', 'aodos tolls station 11', 'aodos'),
('AO12', 'aodos tolls station 12', 'aodos'),
('AO13', 'aodos tolls station 13', 'aodos'),
('AO14', 'aodos tolls station 14', 'aodos'),
('AO15', 'aodos tolls station 15', 'aodos'),
('AO16', 'aodos tolls station 16', 'aodos'),
('AO17', 'aodos tolls station 17', 'aodos'),
('AO18', 'aodos tolls station 18', 'aodos'),
('AO19', 'aodos tolls station 19', 'aodos'),
('EG00', 'egnatia tolls station 00', 'egnatia'),
('EG01', 'egnatia tolls station 01', 'egnatia'),
('EG02', 'egnatia tolls station 02', 'egnatia'),
('EG03', 'egnatia tolls station 03', 'egnatia'),
('EG04', 'egnatia tolls station 04', 'egnatia'),
('EG05', 'egnatia tolls station 05', 'egnatia'),
('EG06', 'egnatia tolls station 06', 'egnatia'),
('EG07', 'egnatia tolls station 07', 'egnatia'),
('EG08', 'egnatia tolls station 08', 'egnatia'),
('EG09', 'egnatia tolls station 09', 'egnatia'),
('EG10', 'egnatia tolls station 10', 'egnatia'),
('EG11', 'egnatia tolls station 11', 'egnatia'),
('EG12', 'egnatia tolls station 12', 'egnatia'),
('GF00', 'gefyra tolls station 00', 'gefyra'),
('KO00', 'kentriki_odos tolls station 00', 'kentriki_odos'),
('KO01', 'kentriki_odos tolls station 01', 'kentriki_odos'),
('KO02', 'kentriki_odos tolls station 02', 'kentriki_odos'),
('KO03', 'kentriki_odos tolls station 03', 'kentriki_odos'),
('KO04', 'kentriki_odos tolls station 04', 'kentriki_odos'),
('KO05', 'kentriki_odos tolls station 05', 'kentriki_odos'),
('KO06', 'kentriki_odos tolls station 06', 'kentriki_odos'),
('KO07', 'kentriki_odos tolls station 07', 'kentriki_odos'),
('KO08', 'kentriki_odos tolls station 08', 'kentriki_odos'),
('KO09', 'kentriki_odos tolls station 09', 'kentriki_odos'),
('MR00', 'moreas tolls station 00', 'moreas'),
('MR01', 'moreas tolls station 01', 'moreas'),
('MR02', 'moreas tolls station 02', 'moreas'),
('MR03', 'moreas tolls station 03', 'moreas'),
('MR04', 'moreas tolls station 04', 'moreas'),
('MR05', 'moreas tolls station 05', 'moreas'),
('MR06', 'moreas tolls station 06', 'moreas'),
('MR07', 'moreas tolls station 07', 'moreas'),
('MR08', 'moreas tolls station 08', 'moreas'),
('NE00', 'nea_odos tolls station 00', 'nea_odos'),
('NE01', 'nea_odos tolls station 01', 'nea_odos'),
('NE02', 'nea_odos tolls station 02', 'nea_odos'),
('NE03', 'nea_odos tolls station 03', 'nea_odos'),
('NE04', 'nea_odos tolls station 04', 'nea_odos'),
('NE05', 'nea_odos tolls station 05', 'nea_odos'),
('NE06', 'nea_odos tolls station 06', 'nea_odos'),
('NE07', 'nea_odos tolls station 07', 'nea_odos'),
('NE08', 'nea_odos tolls station 08', 'nea_odos'),
('NE09', 'nea_odos tolls station 09', 'nea_odos'),
('NE10', 'nea_odos tolls station 10', 'nea_odos'),
('NE11', 'nea_odos tolls station 11', 'nea_odos'),
('NE12', 'nea_odos tolls station 12', 'nea_odos'),
('NE13', 'nea_odos tolls station 13', 'nea_odos'),
('NE14', 'nea_odos tolls station 14', 'nea_odos'),
('NE15', 'nea_odos tolls station 15', 'nea_odos'),
('NE16', 'nea_odos tolls station 16', 'nea_odos'),
('OO00', 'olympia_odos tolls station 00', 'olympia_odos'),
('OO01', 'olympia_odos tolls station 01', 'olympia_odos'),
('OO02', 'olympia_odos tolls station 02', 'olympia_odos'),
('OO03', 'olympia_odos tolls station 03', 'olympia_odos'),
('OO04', 'olympia_odos tolls station 04', 'olympia_odos'),
('OO05', 'olympia_odos tolls station 05', 'olympia_odos'),
('OO06', 'olympia_odos tolls station 06', 'olympia_odos'),
('OO07', 'olympia_odos tolls station 07', 'olympia_odos'),
('OO08', 'olympia_odos tolls station 08', 'olympia_odos'),
('OO09', 'olympia_odos tolls station 09', 'olympia_odos'),
('OO10', 'olympia_odos tolls station 10', 'olympia_odos'),
('OO11', 'olympia_odos tolls station 11', 'olympia_odos'),
('OO12', 'olympia_odos tolls station 12', 'olympia_odos'),
('OO13', 'olympia_odos tolls station 13', 'olympia_odos');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` varchar(20) NOT NULL,
  `vehicleId` varchar(20) NOT NULL,
  `providerId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `vehicleId`, `providerId`) VALUES
('AO11L5271', 'DP11ENT03275', 'aodos'),
('AO12K0807', 'MX39VOS38645', 'aodos'),
('AO13W1028', 'RR73DWB65452', 'aodos'),
('AO18S3731', 'PE73VJU23485', 'aodos'),
('AO19H6549', 'OC94ASJ72024', 'aodos'),
('AO19M3646', 'BM25PHF40639', 'aodos'),
('AO27P4628', 'LG64ARC91224', 'aodos'),
('AO31K4646', 'SU00RDZ36214', 'aodos'),
('AO49I8807', 'YL27IFD65117', 'aodos'),
('AO69I5108', 'HT62RDI04611', 'aodos'),
('AO87S8322', 'DV04FQL29609', 'aodos'),
('AO88V0724', 'SY96JDQ97089', 'aodos'),
('AO94O1451', 'BZ76ROL87339', 'aodos'),
('EG00X1873', 'TV81MAQ99005', 'egnatia'),
('EG05B7264', 'IW53OQE31439', 'egnatia'),
('EG13U6715', 'JD78PQD35395', 'egnatia'),
('EG23G6966', 'EC02LZC49528', 'egnatia'),
('EG36L0177', 'TE24LCO18661', 'egnatia'),
('EG47I2811', 'XE59BZM26378', 'egnatia'),
('EG47U1656', 'IN99SEN20660', 'egnatia'),
('EG52J0268', 'QU94IGC75528', 'egnatia'),
('EG56V3913', 'CR31GMR97972', 'egnatia'),
('EG74B6896', 'DW44ZOO26361', 'egnatia'),
('EG76E0993', 'VL67TFO75321', 'egnatia'),
('EG79G1284', 'TZ48CCW54765', 'egnatia'),
('EG87C3789', 'MU06LHX94338', 'egnatia'),
('EG87N4472', 'CM15YCB60994', 'egnatia'),
('GF17K5976', 'SL09NOT64494', 'gefyra'),
('GF26E1328', 'UF84JOS00561', 'gefyra'),
('GF26N8608', 'QN12NTR81378', 'gefyra'),
('GF48M7092', 'JE65QJK64802', 'gefyra'),
('GF51E2190', 'EN26OAB52983', 'gefyra'),
('GF52G9102', 'WU78BMX13511', 'gefyra'),
('GF52T0389', 'XF28DGK65250', 'gefyra'),
('GF61W4412', 'LM86GYO69819', 'gefyra'),
('GF62J1185', 'MP14WFM40909', 'gefyra'),
('GF64H7689', 'BY85QGR11636', 'gefyra'),
('GF84T8932', 'PF04UCA93312', 'gefyra'),
('GF84U4130', 'KW50MJG67260', 'gefyra'),
('GF85R2347', 'YX66XYW62640', 'gefyra'),
('GF85Z5553', 'CK97FAU13897', 'gefyra'),
('GF87C4626', 'IO09FGE68100', 'gefyra'),
('GF94Q2036', 'MA30QLI76818', 'gefyra'),
('GF96B8067', 'CP56DAO45598', 'gefyra'),
('KO37T8485', 'FL13UMN92207', 'kentriki_odos'),
('KO38E3788', 'ED51EWW52190', 'kentriki_odos'),
('KO44J2006', 'WY00MLL63827', 'kentriki_odos'),
('KO53F1683', 'MQ65WJJ60020', 'kentriki_odos'),
('KO57Z7727', 'IX01MVL33676', 'kentriki_odos'),
('KO58G5356', 'YH66OKD41942', 'kentriki_odos'),
('KO64Z6868', 'QW79CHL42244', 'kentriki_odos'),
('KO69R5975', 'RV87TIY76692', 'kentriki_odos'),
('KO72G8546', 'KB55KTM48860', 'kentriki_odos'),
('KO75W9528', 'UO75YNW62238', 'kentriki_odos'),
('KO80I5938', 'QO77TFN61853', 'kentriki_odos'),
('KO82C5500', 'HW75BKT77773', 'kentriki_odos'),
('KO87M8492', 'DO24BCW15511', 'kentriki_odos'),
('KO91P5387', 'ZY93PCY41868', 'kentriki_odos'),
('KO95P1306', 'JO50FSF60755', 'kentriki_odos'),
('MR06V9056', 'RR98KQE80731', 'moreas'),
('MR26E3126', 'QO68DIC93032', 'moreas'),
('MR30M7731', 'HA82SCK64299', 'moreas'),
('MR36J6829', 'QH15HWX24570', 'moreas'),
('MR39O1247', 'IZ65WAT29135', 'moreas'),
('MR55V8401', 'EZ65FLV39493', 'moreas'),
('MR56E8319', 'KF48RSD79865', 'moreas'),
('MR57I0349', 'UA13YTK28483', 'moreas'),
('MR58R4385', 'QN23UHH39091', 'moreas'),
('MR63V2295', 'XV91YMP27722', 'moreas'),
('MR72G8045', 'HE38BQH01623', 'moreas'),
('MR93N1400', 'HR53SRO94328', 'moreas'),
('MR98F8272', 'BI87HYL81972', 'moreas'),
('NE09V3603', 'UP28MBM38391', 'nea_odos'),
('NE31Q7933', 'EV77EDV52985', 'nea_odos'),
('NE43B7275', 'FY47TUN40300', 'nea_odos'),
('NE55G3669', 'PD45WOT56494', 'nea_odos'),
('NE61X5911', 'JV67MTI17124', 'nea_odos'),
('NE66B0405', 'NY14GZR94632', 'nea_odos'),
('NE66N5124', 'PM58XHX45588', 'nea_odos'),
('NE71H2256', 'NZ35XLQ89678', 'nea_odos'),
('NE74M0871', 'QP02SYE47964', 'nea_odos'),
('NE74M6592', 'NO82BAX82566', 'nea_odos'),
('NE80E5551', 'VX68BAR38623', 'nea_odos'),
('NE83K9493', 'IA29IQS63679', 'nea_odos'),
('NE91T5473', 'EG95RTB75032', 'nea_odos'),
('NE97X0282', 'OY94SZK34436', 'nea_odos'),
('OO01A7197', 'AY38OQF67603', 'olympia_odos'),
('OO14E0167', 'AT19HLV57173', 'olympia_odos'),
('OO20E8329', 'QX75YWC61835', 'olympia_odos'),
('OO26V4144', 'XV40HUQ04740', 'olympia_odos'),
('OO29X6651', 'EE22TMX10817', 'olympia_odos'),
('OO41Q9202', 'RK48BOP88344', 'olympia_odos'),
('OO43C8099', 'QR03XCJ37459', 'olympia_odos'),
('OO49W8536', 'JF94VYA88954', 'olympia_odos'),
('OO58I4183', 'EM54HQI58682', 'olympia_odos'),
('OO59B1482', 'VJ92OYV94295', 'olympia_odos'),
('OO65G9691', 'IC95TLY24827', 'olympia_odos'),
('OO67L7721', 'BK77KNV91142', 'olympia_odos'),
('OO68H9901', 'WG11QVY31890', 'olympia_odos'),
('OO85U6024', 'LC72NRN52084', 'olympia_odos');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) NOT NULL,
  `debitOperatorId` varchar(20) NOT NULL,
  `creditOperatorId` varchar(20) NOT NULL,
  `amount` decimal(13,3) NOT NULL,
  `dateFrom` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateTo` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` varchar(20) NOT NULL,
  `licenseYear` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `licenseYear`) VALUES
('AT19HLV57173', 2004),
('AY38OQF67603', 2020),
('BI87HYL81972', 2020),
('BK77KNV91142', 2007),
('BM25PHF40639', 2018),
('BY85QGR11636', 2018),
('BZ76ROL87339', 2017),
('CK97FAU13897', 2007),
('CM15YCB60994', 2005),
('CP56DAO45598', 2017),
('CR31GMR97972', 2000),
('DO24BCW15511', 2009),
('DP11ENT03275', 2008),
('DV04FQL29609', 2010),
('DW44ZOO26361', 2009),
('EC02LZC49528', 2001),
('ED51EWW52190', 2017),
('EE22TMX10817', 2001),
('EG95RTB75032', 2013),
('EM54HQI58682', 2008),
('EN26OAB52983', 2002),
('EV77EDV52985', 2001),
('EZ65FLV39493', 2012),
('FL13UMN92207', 2006),
('FY47TUN40300', 2002),
('HA82SCK64299', 2001),
('HE38BQH01623', 2016),
('HR53SRO94328', 2004),
('HT62RDI04611', 2000),
('HW75BKT77773', 2016),
('IA29IQS63679', 2010),
('IC95TLY24827', 2020),
('IN99SEN20660', 2014),
('IO09FGE68100', 2015),
('IW53OQE31439', 2014),
('IX01MVL33676', 2001),
('IZ65WAT29135', 2002),
('JD78PQD35395', 2002),
('JE65QJK64802', 2002),
('JF94VYA88954', 2000),
('JO50FSF60755', 2011),
('JV67MTI17124', 2000),
('KB55KTM48860', 2009),
('KF48RSD79865', 2012),
('KW50MJG67260', 2016),
('LC72NRN52084', 2001),
('LG64ARC91224', 2019),
('LM86GYO69819', 2010),
('MA30QLI76818', 2019),
('MP14WFM40909', 2008),
('MQ65WJJ60020', 2009),
('MU06LHX94338', 2016),
('MX39VOS38645', 2018),
('NO82BAX82566', 2000),
('NY14GZR94632', 2011),
('NZ35XLQ89678', 2015),
('OC94ASJ72024', 2002),
('OY94SZK34436', 2007),
('PD45WOT56494', 2010),
('PE73VJU23485', 2010),
('PF04UCA93312', 2007),
('PM58XHX45588', 2006),
('QH15HWX24570', 2009),
('QN12NTR81378', 2003),
('QN23UHH39091', 2014),
('QO68DIC93032', 2016),
('QO77TFN61853', 2004),
('QP02SYE47964', 2010),
('QR03XCJ37459', 2014),
('QU94IGC75528', 2003),
('QW79CHL42244', 2006),
('QX75YWC61835', 2019),
('RK48BOP88344', 2016),
('RR73DWB65452', 2017),
('RR98KQE80731', 2020),
('RV87TIY76692', 2001),
('SL09NOT64494', 2005),
('SU00RDZ36214', 2014),
('SY96JDQ97089', 2004),
('TE24LCO18661', 2009),
('TV81MAQ99005', 2000),
('TZ48CCW54765', 2015),
('UA13YTK28483', 2020),
('UF84JOS00561', 2020),
('UO75YNW62238', 2003),
('UP28MBM38391', 2010),
('VJ92OYV94295', 2000),
('VL67TFO75321', 2007),
('VX68BAR38623', 2005),
('WG11QVY31890', 2006),
('WU78BMX13511', 2008),
('WY00MLL63827', 2000),
('XE59BZM26378', 2020),
('XF28DGK65250', 2021),
('XV40HUQ04740', 2001),
('XV91YMP27722', 2012),
('YH66OKD41942', 2019),
('YL27IFD65117', 2006),
('YX66XYW62640', 2014),
('ZY93PCY41868', 2006);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKPass686987` (`tagId`),
  ADD KEY `FKPass482857` (`stationRef`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Has` (`stationProvider`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKTag673694` (`vehicleId`),
  ADD KEY `FKTag672545` (`providerId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKTransactio717013` (`debitOperatorId`),
  ADD KEY `FKTransactio523915` (`creditOperatorId`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pass`
--
ALTER TABLE `pass`
  ADD CONSTRAINT `FKPass482857` FOREIGN KEY (`stationRef`) REFERENCES `station` (`id`),
  ADD CONSTRAINT `FKPass686987` FOREIGN KEY (`tagId`) REFERENCES `tag` (`id`);

--
-- Constraints for table `station`
--
ALTER TABLE `station`
  ADD CONSTRAINT `Has` FOREIGN KEY (`stationProvider`) REFERENCES `operator` (`id`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `FKTag672545` FOREIGN KEY (`providerId`) REFERENCES `operator` (`id`),
  ADD CONSTRAINT `FKTag673694` FOREIGN KEY (`vehicleId`) REFERENCES `vehicle` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FKTransactio523915` FOREIGN KEY (`creditOperatorId`) REFERENCES `operator` (`id`),
  ADD CONSTRAINT `FKTransactio717013` FOREIGN KEY (`debitOperatorId`) REFERENCES `operator` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
