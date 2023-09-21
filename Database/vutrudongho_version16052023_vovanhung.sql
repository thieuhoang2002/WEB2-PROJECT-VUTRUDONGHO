-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 16, 2023 lúc 07:59 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vutrudongho`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(4) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`AdminID`, `FullName`, `Email`, `Password`) VALUES
('AD01', 'Võ Quang Đăng Khoa', 'dangkhoa1509@gmail.com', '123456'),
('AD02', 'Võ Văn Hùng', 'vovanhung2864@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `BrandID` varchar(5) NOT NULL,
  `BrandName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`, `Description`, `Status`) VALUES
('BR001', 'Seiko', 'SEIKO, thương hiệu đồng hồ có bề dày lịch sử lâu đời nhất tại Nhật Bản. Với hơn 130 năm kinh nghiệm, hãng đồng hồ SEIKO sẽ đem đến cho bạn những trải nghiệm về sự Tinh Tế, Sang Trọng trong thiết kế cũng như chất lượng hoàn hảo đến từ sản phẩm đồng hồ SEIKO nam nữ, cặp đôi chính hãng. Bộ máy đồng hồ SEIKO được tạo nên dựa trên những tinh hoa công nghệ hàng đầu nước Nhật, cho sự “Ổn Định” cũng như độ “Chính Xác” cao trong từng chuyển động. Các dòng đồng hồ SEIKO nam nữ chính hãng mẫu mới, đẹp được quan tâm nhiều nhất hiện nay như: Seiko 5, Seiko Kinetic, Seiko Automatic.. vv', 1),
('BR002', 'Casio', 'Đồng hồ Casio được biết đến là thương hiệu đồng hồ lâu đời trong ngành công nghiệp đồng hồ tại Nhật Bản. Những mẫu đồng hồ Casio nam và đồng hồ Casio nữ được yêu thích bởi thiết kế đơn giản, dễ dàng để xem giờ, được trang bị đầy đủ các công nghệ mới nhất và có giá bán cực kỳ rẻ.', 1),
('BR003', 'Citizen', 'Citizen – Thương hiệu đồng hồ được thành lập bởi các nhà đầu tư Nhật Bản và Thụy Sỹ vào năm 1918. Trụ sở chính của hãng được đặt tại Nhật Bản, bao gồm cả dây chuyền sản xuất bộ máy độc lập do tập đoàn nắm giữ. Thương hiệu trực tiếp lắp ráp 3 dòng sản phẩm là đồng hồ Citizen Automatic, Quartz và Eco-Drive. Tín đồ đánh giá đồng hồ Citizen nam, nữ có chất lượng tốt và đa dạng về chất liệu (dây da, kim loại, kính cứng, sapphire), nhiều kiểu dáng (mặt vuông, mặt tròn).', 1),
('BR004', 'Orient', 'Orient – Thương hiệu đồng hồ Nhật Bản thuộc Seiko Epson được thành lập vào năm 1950. Đồng hồ Orient chính hãng được chế tác từ vật liệu thượng hạng, bộ máy tiêu chuẩn cao cấp, độ hoàn thiện tinh xảo. Orient sở hữu tệp khách hàng rộng khắp nhờ thiết kế đa dạng trong dây đeo (dây da, kim loại), kiểu dáng (tròn, mặt vuông, chữ nhật), phong cách (Quartz, automatic, cơ tự động lộ máy), vật liệu (sapphire, kính cứng) hay màu sắc (đỏ, xanh, đen,…).', 1),
('BR005', 'Apple', 'Nổi tiếng với tính năng thông minh và kết nối tốt với hệ sinh thái của Apple như iPhone và MacBook. Apple Watch cung cấp nhiều tính năng hữu ích như đo nhịp tim, theo dõi hoạt động thể chất và quản lý tình trạng sức khỏe, cùng với các ứng dụng tiện ích và tính năng như Siri, Apple Pay, và hỗ trợ cho các ứng dụng của bên thứ ba.', 1),
('BR006', 'Rolex ', 'Thương hiệu đồng hồ xa xỉ, sang trọng.', 1),
('BR007', 'Omega', 'Đồng hồ cao cấp, đẳng cấp.', 1),
('BR008', 'Swatch', 'Đồng hồ trẻ trung, màu sắc đa dạng.', 1),
('BR009', 'Tissot', 'Đồng hồ giá cả phải chăng, chất lượng tốt.', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `UserID` varchar(8) NOT NULL,
  `ProductID` varchar(8) NOT NULL,
  `Quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventoryreceivingvoucher`
--

CREATE TABLE `inventoryreceivingvoucher` (
  `InID` varchar(10) NOT NULL,
  `SupplierID` varchar(8) NOT NULL,
  `Date` date NOT NULL,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `OrderID` varchar(10) NOT NULL,
  `UserID` varchar(8) NOT NULL,
  `OderDate` datetime NOT NULL,
  `ShippingFee` int(11) NOT NULL,
  `OrderDiscount` int(11) NOT NULL,
  `OrderTotal` double NOT NULL,
  `Address` varchar(150) NOT NULL,
  `PaymentID` varchar(4) NOT NULL,
  `VoucherID` varchar(5) NOT NULL,
  `OrderStatus` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`OrderID`, `UserID`, `OderDate`, `ShippingFee`, `OrderDiscount`, `OrderTotal`, `Address`, `PaymentID`, `VoucherID`, `OrderStatus`) VALUES
('OR00000001', 'US000001', '2023-05-16 04:07:33', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S01'),
('OR00000002', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S01'),
('OR00000003', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S02'),
('OR00000004', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S02'),
('OR00000005', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S03'),
('OR00000006', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S04'),
('OR00000007', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S04'),
('OR00000008', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S05'),
('OR00000009', 'US000001', '2023-05-16 04:09:04', 30000, 10000, 1000000, '521/91E CMT8#P13#Q10#HCM', 'PA01', 'VO001', 'S05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderstatus`
--

CREATE TABLE `orderstatus` (
  `StatusID` varchar(3) NOT NULL,
  `StatusName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderstatus`
--

INSERT INTO `orderstatus` (`StatusID`, `StatusName`) VALUES
('S01', 'Chưa xác nhận'),
('S02', 'Đã xác nhận'),
('S03', 'Đang giao hàng'),
('S04', 'Đã giao hàng'),
('S05', 'Đã hủy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_line`
--

CREATE TABLE `order_line` (
  `OrderID` varchar(10) NOT NULL,
  `ProductID` varchar(8) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UnitPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `PaymentID` varchar(4) NOT NULL,
  `PaymentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`PaymentID`, `PaymentName`) VALUES
('PA01', 'Thanh toán khi nhận hàng'),
('PA02', 'Internet Banking');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(8) NOT NULL,
  `BrandID` varchar(5) NOT NULL,
  `ProductName` varchar(300) NOT NULL,
  `PriceToSell` double NOT NULL,
  `ImportPrice` double NOT NULL,
  `Discount` double DEFAULT NULL,
  `Model` varchar(100) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Description` text DEFAULT NULL,
  `ProductImg` varchar(200) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `CanDel` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ProductID`, `BrandID`, `ProductName`, `PriceToSell`, `ImportPrice`, `Discount`, `Model`, `Color`, `Gender`, `Description`, `ProductImg`, `Status`, `CanDel`) VALUES
('PR000001', 'BR001', 'Seiko 5 Field Sports Style SRPG29K1 – Nam – Automatic (Tự Động) – Mặt Số 39.4mm, Chống Nước 10ATM, Bộ Máy In-House', 7090000, 6090000, 0, 'Đồng hồ cơ', 'Bạc', 'Nam', 'Mẫu Seiko SRPG29K1 thiết kế đơn giản chức năng 3 kim, chi tiết kim chỉ cùng các cọc chấm tròn nhỏ được phủ dạ quang trên nền mặt số xanh 39.4mm.', 'SRPG29K1-699x699.png', 1, 1),
('PR000002', 'BR001', 'Seiko 5 Field Specialist Style SRPG41K1 – Nam – Automatic (Tự Động) – Mặt Số 39.4mm, Chống Nước 10ATM, Bộ Máy In-House', 8050000, 7050000, 0, 'Đồng hồ cơ', 'Đen', 'Nam', 'Mẫu Seiko SRPG41K1 thiết kế đơn giản chức năng 3 kim, chi tiết kim chỉ cùng các cọc chấm nhỏ được phủ dạ quang trên nền mặt số kích thước 39.4mm.', 'SRPG41K1.png', 1, 1),
('PR000003', 'BR001', 'Seiko SSB351P1 – Nam – Kính Cứng – Quartz (Pin) – Mặt Số 43.9mm, Dạ Quang, Chống Nước 10ATM.', 6375000, 5375000, 0, 'Đồng hồ cơ', 'Đen', 'Nam', 'Mẫu Seiko SSB351P1 phiên bản nam tính với tính năng Chronograph (đo thời gian) tạo nên kiểu dáng đồng hồ 6 kim trên nền mặt số lớn kích thước 43.9mm.', 'SSB351P1-699x699.png', 1, 1),
('PR000004', 'BR002', 'Casio EFV-550L-1AVUDF – Quartz (Pin) – Mặt Số 47mm, Kính Cứng, Chống Nước 10ATM', 3529000, 2529000, 0, 'Đồng hồ cơ', 'Đen', 'Unisex', 'Mẫu Casio EFV-550L-1AVUDF mang đến cho phái mạnh vẻ ngoài lịch lãm nhưng cũng không kém phần trẻ trung đặc trưng thuộc dòng Edifice với kiểu dáng đồng hồ 6 kim đi kèm tính năng đo thời gian Chronograph.', '68_EFV-550L-1AVUDF-1-699x699.png', 1, 1),
('PR000005', 'BR002', 'Casio MTP-1302D-7A1VDF – Nữ – Quartz (Pin) – Mặt Số 38.5mm, Kính Cứng, Chống Nước 5ATM.', 1347000, 1000000, 0, 'Đồng hồ cơ', 'Bạch kim', 'Nữ', 'Đồng hồ Casio MTP-1302D-7A1VDF có kiểu dáng truyền thống với mặt số tròn, niềng được tạo khía nổi bật quanh nền trắng mặt số, kim chỉ và vạch số được mạ bạc trên nền số.', '35_MTP-1302D-7A1VDF-699x699.png', 1, 1),
('PR000006', 'BR002', 'Casio AEQ-110W-3AVDF – Nam – Kính Nhựa – Quartz (Pin) – Mặt Số 46.6mm, Bộ Bấm Giờ, Chống Nước 10ATM', 1581000, 1281000, 0, 'Đồng hồ điện tử', 'Đen', 'Nam', 'Mẫu Casio AEQ-110W-3AVDF thiết kế phong cách dành cho các tín đồ yêu thích các hoạt động thể thao ngoài trời hoặc dân đi phượt với nền mặt số điện tử đi kèm đa chức năng cùng khả năng chịu nước 10 ATM.', '118_AEQ-110W-3AVDF-699x699.png', 1, 1),
('PR000007', 'BR003', 'Citizen BM7370-89E – Kính Sapphire – Eco-Drive (Năng Lượng Ánh Sáng) – Dây Kim Loại', 8000000, 7000000, 0, 'Đồng hồ cơ', 'Bạch kim', 'Unisex', 'Mẫu Citizen BM7370-89E ấn tượng một vẻ ngoài mạnh mẽ với tổng thể vỏ máy cùng dây đeo bằng kim loại bao phủ tông màu bạc sang trọng hiện khi đồng hồ được trang bị công nghệ Eco-Drive (Năng Lượng Ánh Sáng).', 'BM7370-89E-699x699.png', 1, 1),
('PR000008', 'BR003', 'Citizen AN8195-58E – Quartz (Pin) – Mặt Số 42mm, Kính Cứng, Chống Nước 10ATM', 5985000, 4985000, 0, 'Đồng hồ cơ', 'Đen', 'Unisex', 'Mẫu Citizen AN8195-58E thiết kế 3 núm vặn điều chỉnh các tính năng Chronograph (đo thời gian) hiện thị trên nền mặt số đen size 42mm.', 'AN8195-58E-699x699.png', 1, 1),
('PR000009', 'BR003', 'Citizen NP1020-15A – Kính Sapphire – Automatic (Tự Động) – Dây Da', 8450000, 7450000, 0, 'Đồng hồ cơ', 'Bạc', 'Unisex', 'Vẻ ngoài quý ông lịch lãm với mẫu Citizen NP1020-15A với thiết kế độc đáo cùng ô chân kính trong suốt phô diễn ra 1 phần bên trong của bộ máy cơ chứa đựng cả một trải nghiệm đầy nam tính.', '138_NP1020-15A-699x699.png', 1, 1),
('PR000010', 'BR004', 'Orient Sun And Moon RA-AS0103A10B – Nam – Automatic (Tự Động) – Mặt Số 41.5mm, Trữ Cót 40 Giờ, Hacking Second.', 11490000, 10490000, 0, 'Đồng hồ cơ', 'Xanh dương', 'Nam', 'Mẫu Orient RA-AS0103A10B phiên bản máy cơ thiết kế kiểu dáng cơ lộ tim tạo nên vẻ độc đáo trên nền mặt số với kích thước 41mm.', 'RA-AS0103A10B-699x699.png', 1, 1),
('PR000011', 'BR004', 'Orient Bambino FAC08003A0 – Nam – Automatic (Tự Động) – Mặt Số 42mm, Kính Cứng Cong, Trữ Cót 40 Giờ', 7510000, 6510000, 0, 'Đồng hồ cơ', 'Nâu', 'Nam', 'Đồng hồ nam Orient FAC08003A0 thiết kế với phong cách cổ điển, kim chỉ và vạch số được phủ đồng trên nền màu xám mạnh mẽ, kết hợp với dây đeo bằng da màu nâu tạo nên vẻ lịch lãm cho phái mạnh.', 'FAC08003A0-1-699x699.png', 1, 1),
('PR000012', 'BR004', 'Orient Nam – Quartz (Pin) – Kính Sapphire – Dây Da (FGW01004A0)', 4160000, 3160000, 0, 'Đồng hồ cơ', 'Nâu', 'Nam', 'Đồng hồ Orient FGW01004A0 dành cho nam giới với mặt kính Sapphire chống trầy xước, mặt nền đen trắng hài hòa, còn có 2 kim chỉ cùng 1 lịch ngày, dây da có vân.', 'FGW01004A0-699x699.png', 1, 1),
('PR000013', 'BR005', 'Apple Watch SE Nhôm 2022 GPS - 40mm', 8990000, 7990000, 5, 'Đồng hồ thông minh', 'Đen', 'Unisex', 'Apple Watch SE 2022 Nhôm GPS: Các tính năng mới hoàn toàn. Giá vẫn nhẹ nhàng. Các tính năng thiết yếu giúp bạn luôn kết nối, năng động, khỏe mạnh, và an toàn.', '0011842_midnight_550.png', 1, 1),
('PR000014', 'BR005', 'Apple Watch Ultra LTE 49mm Ocean Band Vàng', 23990000, 21990000, 5, 'Đồng hồ thông minh', 'Trắng', 'Nữ', 'Các tính năng và cảm biến chuyên dụng, cùng với ba dây đeo mới được thiết kế cho các hoạt động khám phá, phiêu lưu, và rèn luyện sức bền.', '0001670_white_550.png', 1, 1),
('PR000015', 'BR005', 'Apple Watch 8 45mm nhôm GPS + Cellular Đỏ', 15990000, 14990000, 5, 'Đồng hồ thông minh', 'Đỏ', 'Unisex', 'Apple Watch 8 45mm (GPS + Cellular) sở hữu các cảm biến và ứng dụng sức khỏe tối tân, vì vậy bạn có thể đo điện tâm đồ (ECG),1 đo nhịp tim và nồng độ oxy trong máu,2 theo dõi sự thay đổi nhiệt độ3 để nắm bắt thông tin chuyên sâu về chu kỳ kinh nguyệt.4 Các tính năng Phát Hiện Va Chạm, theo dõi giai đoạn ngủ và các chỉ số tập luyện chuyên sâu giúp bạn luôn năng động, khỏe mạnh, an toàn, và kết nối.', '0014063_apple-watch-series-8-45mm-nhom-gps-cellular-sao-chep_550.png', 1, 1),
('PR000016', 'BR001', 'SEIKO 5 FIELD SPORTS STYLE SRPD77K1 – NAM – AUTOMATIC (TỰ ĐỘNG) – MẶT SỐ 42.5MM, CHỐNG NƯỚC 5ATM, BỘ MÁY IN-HOUSE', 8090000, 7090000, 0, 'Đồng hồ cơ', 'Xanh lá', 'Nam', 'Mẫu Seiko SRPD77K1 với phần vỏ máy cơ bề dày 13mm đi kèm khả năng chống nước lên đến 10ATM, vẻ ngoài nam tính không kém cạnh thời trang với mẫu dây vải tone xanh.', 'SRPG33K1-699x699.png', 1, 1),
('PR000017', 'BR002', 'CASIO ECB-900DB-1BDR – NAM – SOLAR (NĂNG LƯỢNG ÁNH SÁNG) – DÂY KIM LOẠI', 6909000, 5909000, 0, 'Đồng hồ cơ', 'Xanh đen', 'Nam', 'Mẫu Casio ECB-900DB-1BDR tính năng vượt trội pin được trang bị công nghệ Solar (Năng lượng ánh sáng), Edifice phiên bản đặc biệt mặt số kim chỉ kết hợp ô số điện tử.', '52_ECB-900DB-1BDR-699x699.png', 1, 1),
('PR000018', 'BR004', 'Orient SK RA-AA0B01G19B – Nam – Automatic (Tự Động) – Mặt Số 41.7mm, Trữ Cót 40 Giờ, Hacking Second', 7909000, 6909000, 2, 'Đồng hồ cơ', 'Vàng đen', 'Nam', 'Mẫu Orient RA-AA0B01G19B phiên bản mạ vàng trên mẫu kim chỉ trên mặt số size 41.7mm đi kèm thiết kế 2 núm vặn điều chỉnh, vỏ máy kim loại mạ bạc kiểu dáng dày dặn của bô máy cơ.', 'AQ-S810W-1A4VDF-699x699.png', 1, 1),
('PR000019', 'BR003', 'CITIZEN BI5054-53L – NAM – QUARTZ (PIN) – DÂY KIM LOẠI', 4270000, 3270000, 1, 'Đồng hồ cơ', 'Xanh đen', 'Nam', 'Mẫu Citizen BI5054-53L không khỏi ngước nhìn khi mang trên mình một vẻ ngoài mặt số tông nền xanh của sự trẻ trung kèm theo vạch số tạo hình dày dặn đầy vẻ nam tính.', '177_BI5054-53L-699x699.png', 1, 1),
('PR000020', 'BR003', 'Citizen AR1135-10E – Nam – Eco-Drive (Năng Lượng Ánh Sáng) – Mặt Số 39mm, Kính Sapphire, Chống Nước 3ATM', 6900000, 5900000, 2, 'Đồng hồ cơ', 'Đen', 'Nam', 'Mẫu Citizen AR1135-10E nổi bật với đồng hồ sử dụng công nghệ hiện đại Eco-Drive (Năng Lượng Ánh Sáng), ấn tượng với thiết kế đầy nam tính kết hợp giữa vỏ máy cùng dây đeo bằng da đen đầy lịch lãm.', 'AR1135-10E-699x699.png', 1, 1),
('PR000021', 'BR003', 'Citizen Nam – Eco-Drive (Năng Lượng Ánh Sáng) – Kính Sapphire – Dây Da (AR1113-12A) Được xếp hạng', 8530000, 7530000, 0, 'Đồng hồ cơ', 'Trắng', 'Nam', 'Đồng hồ nam Eco-Drive AR1113-12A thuộc dòng đồng hồ siêu mỏng, mặt số tròn màu trắng viền vàng, dây da nâu đen có vân, đồng hồ 2 kim với vẻ ngoài giản dị.', 'AR1113-12A-699x699.png', 1, 1),
('PR000022', 'BR003', 'Citizen BM9012-02A  – Kính Sapphire – Eco-Drive (Năng Lượng Ánh Sáng) – Dây Da', 6900000, 5900000, 0, 'Đồng hồ cơ', 'Trắng', 'Unisex', 'Vẻ ngoài quý ông lịch lãm với Citizen BM9012-02A với mẫu dây da nâu có vân sang trọng quý phái khi kết hợp cùng các chi tiết vỏ máy cho đến vạch số vàng hồng.', '159_BM9012-02A-699x699.png', 1, 1),
('PR000023', 'BR003', 'Citizen BI5006-81P – Quartz (Pin) – Mặt Số 39 Mm, Lịch Ngày, Chống Nước 5 ATM', 4985000, 3985000, 0, 'Đồng hồ cơ', 'Vàng trắng', 'Unisex', 'Mẫu Citizen BI5006-81P sang trọng và lịch lãm là yếu tố tạo nên khí chất đàn ông với thiết kế các chi tiết vạch số tạo nét mỏng của sự tinh tế được bao phủ tông màu vàng đầy cuốn hút.', '86_BI5006-81P-699x699.png', 1, 1),
('PR000024', 'BR003', 'Citizen ER0210-55Y – Nữ – Quartz (Pin) – Mặt Số 30mm, Kính Cứng, Khảm Xà Cừ', 3785000, 2785000, 0, 'Đồng hồ cơ', 'Bạch kim', 'Nữ', 'Mẫu Citizen ER0210-55Y mặt số hồng size 30mm phiên bản tone màu xà cừ thời trang, nổi bật với thiết kế sang trọng đính các viên pha lê trên phần vỏ viền đồng hồ.', '18_ER0210-55Y-699x699.png', 1, 1),
('PR000025', 'BR003', 'Citizen ED8180-52X – Nữ – Quartz (Pin) – Mặt Số 33mm, Kính Cứng, Chống Nước 3atm', 4855000, 3855000, 0, 'Đồng hồ cơ', 'Trắng', 'Nữ', 'Mẫu Citizen ED8180-52X phiên bản sang trọng 11 viên đá pha lê được đính tương ứng với các múi giờ hiện thị trên nền mặt số kích thước vừa vặn không quá lớn 33mm.', 'ED8180-52X.png', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_quantity`
--

CREATE TABLE `product_quantity` (
  `ProductID` varchar(8) NOT NULL,
  `Date` datetime NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_quantity`
--

INSERT INTO `product_quantity` (`ProductID`, `Date`, `Quantity`) VALUES
('PR000001', '2023-05-16 12:53:57', 21),
('PR000002', '2023-05-16 07:35:17', 34),
('PR000003', '2023-05-15 16:41:13', 31),
('PR000004', '2023-04-24 20:13:35', 1),
('PR000005', '2023-04-24 20:13:35', 15),
('PR000006', '2023-04-24 20:13:35', 50),
('PR000007', '2023-04-24 20:13:35', 50),
('PR000008', '2023-04-24 20:13:35', 50),
('PR000009', '2023-04-24 20:13:35', 60),
('PR000010', '2023-04-24 20:13:35', 23),
('PR000011', '2023-05-15 16:12:13', 34),
('PR000012', '2023-05-15 16:43:01', 48),
('PR000013', '2023-04-24 20:13:35', 16),
('PR000014', '2023-04-24 20:13:35', 8),
('PR000015', '2023-05-15 16:43:01', 36),
('PR000018', '2023-05-16 06:16:43', 0),
('PR000021', '2023-05-15 16:45:50', 10),
('PR000022', '2023-05-15 16:43:01', 7),
('PR000023', '2023-05-15 16:43:01', 6),
('PR000024', '2023-05-15 16:43:01', 6),
('PR000025', '2023-05-15 16:44:26', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `receivingdetail`
--

CREATE TABLE `receivingdetail` (
  `InID` varchar(10) NOT NULL,
  `ProductID` varchar(10) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ReceivingUnitPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bẫy `receivingdetail`
--
DELIMITER $$
CREATE TRIGGER `trg_receivingdetail_afterdel` AFTER DELETE ON `receivingdetail` FOR EACH ROW update `product` set `CanDel` = 1 where ProductID = old.ProductID and canDel = 0 and ProductID not in (select distinct ProductID from `order_line` where ProductID = old.ProductID) and ProductID not in (select distinct ProductID from `receivingdetail` where ProductID = old.ProductID)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` varchar(8) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `NumberPhone` varchar(10) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `Name`, `NumberPhone`, `Address`, `Email`, `Status`) VALUES
('SU000001', 'Tân Phúc', '0987675433', '770 CMT8, P13, Q10, Hồ Chí Minh', 'tanphuc@gmail.com', 1),
('SU000002', 'Thịnh Long', '0976543234', '4 Cao Lỗ, P4, Q8, Hồ Chí Minh', 'thinhlong@gmail.com', 1),
('SU000003', 'Kim Long', '0363468765', '772 3/2, P13, Q10, Hồ Chí Minh', 'thinhgia@gmail.com', 1),
('SU000004', 'Thế Giới Đồng Hồ', '0907876588', 'Lê Văn Việt, Q11, Hồ Chí Minh', 'thegioidongho@gmail.com', 1),
('SU000005', 'Minh Tân', '0908765432', 'Gò Vấp, Hồ Chí Minh', 'minhtan@gmail.com', 1),
('SU000006', 'Đức Tài', '0907865222', 'Chợ Bến Thành, Quận 1, Hồ Chí Minh', 'ductai@gmail.com', 1),
('SU000007', 'Nam Sơn', '0908777888', '33 CMT8, P11, Q10, Hồ Chí Minh', 'namson@gmail.com', 1),
('SU000008', 'Thịnh Hưng', '0393678444', 'Hà Nội', 'thinhhung@gmail.com', 1),
('SU000009', 'Duy Anh', '0987654111', '445, Hoàng Kiếm, Hà Nội', 'duyanh@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `UserID` varchar(8) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `NumberPhone` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `HouseRoadAddress` varchar(50) NOT NULL,
  `Ward` varchar(30) NOT NULL,
  `District` varchar(30) NOT NULL,
  `Province` varchar(30) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`UserID`, `FullName`, `NumberPhone`, `Email`, `Password`, `HouseRoadAddress`, `Ward`, `District`, `Province`, `Status`) VALUES
('US000001', 'Võ Văn Hùng', '0907604514', 'vovanhung2864@gmail.com', '123456', '521/91E, CMT8', 'Phường 13', 'Quận 10', 'Thành phố Hồ Chí Minh', 1),
('US000002', 'Lê Phan Huỳnh Như', '0907604532', 'nhuhuynh2862@gmail.com', '123456', '45', 'Xã Khuôn Hà', 'Huyện Lâm Bình', 'Tỉnh Tuyên Quang', 1),
('US000003', 'Võ Quang Đăng Khoa', '0907685643', 'dangkhoa2345@gmail.com', '123456', '34', 'Xã Lương Can', 'Huyện Hà Quảng', 'Tỉnh Cao Bằng', 1),
('US000004', 'Thiều Việt Hoàng', '0908675435', 'thieuhoang2346@gmail.com', '123456', '34', 'Phường Bồng Lai', 'Thị xã Quế Võ', 'Tỉnh Bắc Ninh', 1),
('US000005', 'Hoàng Bình Minh', '0908765367', 'binhminh@gmail.com', '123456', '31', 'Phường Mỹ Long', 'Thành phố Long Xuyên', 'Tỉnh An Giang', 1),
('US000006', 'Thiều Bảo Trâm', '0907604999', 'baotram2345@gmail.com', '123456', '61 An Định A', 'Thị trấn Ba Chúc', 'Huyện Tri Tôn', 'Tỉnh An Giang', 1),
('US000007', 'Lê Hồng Cẩm thu', '0327794675', 'camthu@gmail.com', '123456', '1', 'Phường An Hòa', 'Quận Ninh Kiều', 'Thành phố Cần Thơ', 1),
('US000008', 'Lê Ngọc Trâm', '0976543678', 'ngoctram567@gmail.com', '123456', '770 CMT8', 'Phường 05', 'Quận Tân Bình', 'Thành phố Hồ Chí Minh', 1),
('US000009', 'Phạm Cẩm Thơ', '0976548762', 'camtho234@gmail.com', '123456', '521/91E CMT8', 'Phường 13', 'Quận 10', 'Thành phố Hồ Chí Minh', 1),
('US000010', 'Đào Công Trứ', '0327794829', 'congtru2865@gmail.com', '123456', 'Đường 19/5', 'Xã Tân Ân', 'Huyện Cần Đước', 'Tỉnh Long An', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `VoucherID` varchar(5) NOT NULL,
  `VoucherName` varchar(50) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Unit` varchar(5) NOT NULL,
  `DateFrom` date NOT NULL,
  `DateTo` date NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`VoucherID`, `VoucherName`, `Discount`, `Unit`, `DateFrom`, `DateTo`, `Status`) VALUES
('VO001', '30/4', 5, '%', '2023-04-24', '2023-04-30', 1),
('VO002', '5/5', 2, '%', '2023-05-04', '2023-05-07', 1),
('VO003', '1/1 Tết Dương Lịch', 1, '%', '2022-01-01', '2022-01-03', 1),
('VO004', 'Valentine', 2, '%', '2022-02-14', '2022-02-14', 1),
('VO005', 'Ngày thành lập Đảng Cộng Sản Việt Nam 3/2', 2, '%', '2022-02-03', '2022-02-03', 1),
('VO006', 'Ngày Quốc Tế Phụ Nữ 8/3', 3, '%', '2022-03-08', '2022-03-08', 1),
('VO007', 'Ngày sinh của Bác Hồ', 3, '%', '2022-05-19', '2022-05-19', 1),
('VO008', 'Lễ Giáng Sinh', 3, '%', '2022-12-15', '2022-12-25', 1),
('VO009', 'Quốc tế lao động', 3, '%', '2022-05-01', '2022-05-01', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`UserID`,`ProductID`),
  ADD KEY `FK_ProductID_Cart` (`ProductID`);

--
-- Chỉ mục cho bảng `inventoryreceivingvoucher`
--
ALTER TABLE `inventoryreceivingvoucher`
  ADD PRIMARY KEY (`InID`),
  ADD KEY `FK_SupplierID` (`SupplierID`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_Order_User` (`UserID`),
  ADD KEY `FK_Order_VoucherID` (`VoucherID`),
  ADD KEY `FK_Order_Status` (`OrderStatus`),
  ADD KEY `FK_Order_PaymentID` (`PaymentID`);

--
-- Chỉ mục cho bảng `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`StatusID`);

--
-- Chỉ mục cho bảng `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `FK_OrderLine_ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_BrandID` (`BrandID`);

--
-- Chỉ mục cho bảng `product_quantity`
--
ALTER TABLE `product_quantity`
  ADD PRIMARY KEY (`ProductID`,`Date`);

--
-- Chỉ mục cho bảng `receivingdetail`
--
ALTER TABLE `receivingdetail`
  ADD PRIMARY KEY (`InID`,`ProductID`),
  ADD KEY `FK_ProductID_Re` (`ProductID`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`VoucherID`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_ProductID_Cart` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `FK_UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Các ràng buộc cho bảng `inventoryreceivingvoucher`
--
ALTER TABLE `inventoryreceivingvoucher`
  ADD CONSTRAINT `FK_SupplierID` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_Order_PaymentID` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Order_Status` FOREIGN KEY (`OrderStatus`) REFERENCES `orderstatus` (`StatusID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Order_User` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Order_VoucherID` FOREIGN KEY (`VoucherID`) REFERENCES `voucher` (`VoucherID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `FK_OrderLine_OrderID` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_OrderLine_ProductID` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_BrandID` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_quantity`
--
ALTER TABLE `product_quantity`
  ADD CONSTRAINT `FK_ProductID` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `receivingdetail`
--
ALTER TABLE `receivingdetail`
  ADD CONSTRAINT `FK_InID` FOREIGN KEY (`InID`) REFERENCES `inventoryreceivingvoucher` (`InID`),
  ADD CONSTRAINT `FK_ProductID_Re` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
