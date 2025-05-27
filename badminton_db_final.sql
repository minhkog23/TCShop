-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 10:39 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `badminton_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `anh_chitietsp`
--

CREATE TABLE `anh_chitietsp` (
  `id_maSP` int(11) NOT NULL,
  `anh1` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anh2` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `anh3` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anh4` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anh_chitietsp`
--

INSERT INTO `anh_chitietsp` (`id_maSP`, `anh1`, `anh2`, `anh3`, `anh4`) VALUES
(1, '1748375280_1.jpg', '1748375280_11.jpg', '1748375280_12.jpg', '1748375280_13.jpg'),
(2, '1748376323_21.webp', '1748376323_22.webp', '1748376323_23.webp', '1748376323_24.webp'),
(3, '1748376462_3.webp', '1748376462_31.webp', '1748376462_32.webp', '1748376462_33.webp'),
(4, '1748376690_41.webp', '1748376690_42.webp', '1748376690_43.webp', '1748376690_44.webp'),
(5, '1748376795_51.webp', '1748376795_52.webp', '1748376795_53.webp', '1748376795_54.webp'),
(6, '1748376888_61.webp', '1748376888_62.webp', '1748376888_63.webp', '1748376888_64.webp'),
(7, '1748377045_111.webp', '1748377045_112.webp', '1748377045_113.webp', '1748377045_114.webp'),
(8, '1748377251_211.webp', '1748377251_212.webp', '1748377251_213.webp', '1748377251_214.webp');

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `id_HD` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `donGia` decimal(10,0) NOT NULL,
  `thanhTien` decimal(10,0) NOT NULL,
  `size` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_maSP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietsanpham`
--

CREATE TABLE `chitietsanpham` (
  `id_maSP` int(11) NOT NULL,
  `size` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chitietsanpham`
--

INSERT INTO `chitietsanpham` (`id_maSP`, `size`, `soLuong`) VALUES
(3, '3U5', 0),
(1, '3U5', 0),
(1, '4U5', 0),
(2, '3U5', 0),
(2, '4U5', 0),
(3, '3U5', 0),
(3, '4U5', 0),
(4, '3U5', 0),
(4, '4U5', 0),
(4, '5U5', 0),
(5, '4U5', 0),
(6, '3U5', 0),
(6, '3U6', 0),
(6, '4U5', 0),
(7, '3U5', 0),
(7, '4U5', 0),
(8, '3U5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `id_DG` int(10) UNSIGNED NOT NULL,
  `noiDung` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_maSP` int(11) NOT NULL,
  `id_KH` int(11) NOT NULL,
  `ngayTao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dongsanpham`
--

CREATE TABLE `dongsanpham` (
  `id_dongSP` int(10) UNSIGNED NOT NULL,
  `tenDongSP` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ThuongHieu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dongsanpham`
--

INSERT INTO `dongsanpham` (`id_dongSP`, `tenDongSP`, `id_ThuongHieu`) VALUES
(1, 'Voltric', 1),
(2, 'Duora', 1),
(3, 'Nanoflare', 1),
(4, 'Astrox', 1),
(5, 'ArcSaber', 1),
(8, 'Windstrorm', 2),
(9, '3D Calibar', 2),
(10, 'Aeronaut', 2),
(11, 'Axforce', 2),
(12, 'Tectonic', 2),
(13, 'Bladex', 2),
(14, 'Thruster', 3),
(15, 'Auraspeed', 3),
(16, 'DriveX', 3),
(17, 'Jetspeed', 3),
(18, 'Brave Sword', 3),
(19, 'Carbo Pro', 4),
(21, 'Fioria', 4),
(22, 'Promax', 4),
(23, 'Carliber', 4),
(24, 'Fortius', 4),
(25, 'JPX', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `id_HD` int(10) UNSIGNED NOT NULL,
  `ngayDat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngayGiao` datetime NOT NULL,
  `tinhTrang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tongTien` decimal(10,0) NOT NULL,
  `thanhToan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_KH` int(11) NOT NULL,
  `id_NV_banHang` int(11) NOT NULL,
  `id_NV_giaoHang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id_KH` int(10) UNSIGNED NOT NULL,
  `ho` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diaChi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matKhau` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinhTrang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id_KH`, `ho`, `ten`, `email`, `sdt`, `diaChi`, `matKhau`, `tinhTrang`) VALUES
(1, 'Nguyễn', 'Minh Công', 'cong@gmail.com', '0908511921', 'Đức Hòa, Long An', '202cb962ac59075b964b07152d234b70', 'Active'),
(3, 'Nguyễn', 'Trung', 'trung@gmail.com', '0908340299', 'Chu văn an bình thạnh', '202cb962ac59075b964b07152d234b70', 'Active'),
(5, 'demo', 'demoooo', 'demo@gmail.com', '0908511111', 'hậu nghĩa, đức hòa', '202cb962ac59075b964b07152d234b70', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `nguoinhan`
--

CREATE TABLE `nguoinhan` (
  `id_NN` int(10) UNSIGNED NOT NULL,
  `id_HD` int(11) NOT NULL,
  `ho_NN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_NN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diaChi_NN` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt_NN` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id_NV` int(11) NOT NULL,
  `hoNV` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenNV` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailNV` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdtNV` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diaChiNV` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matKhauNV` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinhTrang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_quyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id_NV`, `hoNV`, `tenNV`, `emailNV`, `sdtNV`, `diaChiNV`, `matKhauNV`, `tinhTrang`, `id_quyen`) VALUES
(1, 'Phạm', 'Thanh Hiền', 'phamhien@gmail.com', '0908511921', 'Bình Thạnh, Hồ Chí Minh', '202cb962ac59075b964b07152d234b70', 'Active', 1),
(2, 'Nguyễn ', 'Văn Đoàn', 'doan@gmail.com', '0708353484', 'Phú Nhuận, Bình Thạnh, Thành Phố Hồ Chí Minh', '202cb962ac59075b964b07152d234b70', 'Active', 3),
(3, 'Nguyễn Lê', 'Gia Hân', 'han@gmail.com', '0123456478', 'Bình Thạnh, Hồ Chí Minh', '202cb962ac59075b964b07152d234b70', 'Active', 4),
(4, 'Đặng ', 'Tiến Hoàng', 'hoang@gmail.com', '0908111444', 'Gò vấp, Hồ Chí Minh', '202cb962ac59075b964b07152d234b70', 'Active', 3),
(5, 'Lê', 'Hoàng Khôi', 'khoi@gmail.com', '0908111555', 'Thủ Đức, Hồ Chí Minh', '202cb962ac59075b964b07152d234b70', 'Active', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `id_quyen` int(11) NOT NULL,
  `ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moTa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`id_quyen`, `ten`, `moTa`) VALUES
(1, 'Admin', 'Quản trị của hệ thống'),
(2, 'Nhân viên bán hàng', 'Nhân viên phụ trách xử lý đơn'),
(3, 'Nhân viên giao hàng', 'Phụ trách giao hàng cho shop'),
(4, 'Quản lý giao hàng', 'Chịu trách nhiệm quản lý giao hàng, phân phối nhân viên giao hàng');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id_maSP` int(10) UNSIGNED NOT NULL,
  `tenSP` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moTa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `donGia` decimal(10,0) NOT NULL,
  `anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soLuong` int(11) NOT NULL,
  `id_SPTB` int(11) NOT NULL,
  `id_dongSP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id_maSP`, `tenSP`, `moTa`, `donGia`, `anh`, `soLuong`, `id_SPTB`, `id_dongSP`) VALUES
(1, 'Vợt cầu lông Victor Thruster Shenron', 'Vợt cầu lông Victor Thruster Shenron lấy cảm hứng từ Rồng Thần Shenron trong loạt anime huyền thoại Dragon Ball, Victor Thruster Shenron là hiện thân của sức mạnh, sự uy nghi và tốc độ bùng nổ trên sân đấu. Với thiết kế độc đáo, mang đậm dấu ấn huyền thoại và sắc xanh biểu tượng của Shenron, cây vợt này không chỉ gây ấn tượng về mặt hình ảnh mà còn nổi bật nhờ hiệu suất thi đấu cao. Thuộc dòng Thruster nổi tiếng của Victor, Thruster Shenron hướng đến lối chơi tấn công, với khả năng tạo ra những cú đập đầy uy lực và chính xác – lý tưởng cho các tay vợt yêu thích phong cách áp đảo đối thủ bằng sức mạnh.', '3250000', '1748375280_1.jpg', 0, 0, 14),
(2, 'Vợt Yonex Astrox 77 2020', 'Vợt Yonex Astrox 77 2020 là sản phẩm đang gây bão hiện nay. Được Yonex cho ra mắt vào đầu tháng 12 năm 2020. Với màu sắc khá độc đáo cùng hàng loạt công nghệ tiên tiến, cây vợt được xem là con cưng của Yonex. Astrox 77 cho ra mắt đến 3 phiên bản với 3 màu sắc khác nhau: xanh dương, xanh chuối và đây là phiên bản màu đỏ. Mặc dù mới ra mắt nhưng những phiên bản bản sắc của cây Astrox 77 đã được đặt lên bàn cân so sánh với nhau.', '3450000', '1748376323_21.webp', 0, 0, 4),
(3, 'Vợt cầu lông Yonex Astrox 99', 'Vợt Yonex Astrox 99 là siêu phẩm được đánh giá là ”đỉnh nhất trong năm” nối tiếp từ những cây vợt từ những cây vợt được yêu thích dòng vợt Astrox.Vợt cầu lông Yonex Astrox 99 là bản đặc biệt thiết kế cho Momota và Lee Chong Wei nên nó đang rất được săn lùng ưa chuộng. Nhưng chúng có đặc tính chung là nặng đầu thân cứng nên phù hợp cho những bạn có cổ tay khoẻ cũng như từng chơi qua dòng vợt nặng.', '5000000', '1748376462_3.webp', 0, 1, 4),
(4, 'Vợt Cầu Lông Lining Aeronaut 9000C', 'Vợt Cầu Lông Lining Aeronaut 9000C được đánh giá cao, đang được rất nhiều người yêu thích. Là sản phẩn cao cấp đang rất hot hit trên thị trường và được sản xuất vào năm 2019. Vợt thích hợp cho người chơi nhanh, có kỹ năng chuyển đổi nhanh giữa tấn công và phòng thủ. Là người anh em của Vợt Cầu Lông Lining Aeronaut 9000D. Với thiết kế hiện đại, công nghệ tiên tiến, vợt này hứa hẹn mang lại trải nghiệm tuyệt vời cho người chơi từ bán chuyên đến chuyên nghiệp.', '3590000', '1748376690_41.webp', 0, 1, 10),
(5, 'Vợt cầu lông Lining Aeronaut 7000i', 'Vợt cầu lông Lining Aeronaut 7000i này có 2 phiên bản với tông màu sắc bắt mắt. Phiên bản thứ nhất khá nổi bật với tông màu sáng là trắng, hồng, kết hợp với thân đen khỏe khoắn. Vợt có màu sơn lì, nhẵn ở phía đầu tạo vẻ ngoài trơn tru, sạch sẽ, chống trầy xước. Gần phía tay cầm, màu sơn trở nên bóng hơn và nổi bật hơn bởi những họa tiết chéo nhiều màu ( bạc, vàng). Bên cạnh đó còn có phiên bản màu xanh , tím, bạc được phối với nhau mang lại sự khỏe khoắn, phù hợp cho các chàng trai năng động. Chuôi cầm được in chìm logo thương hiệu Lining – điểm nhận biết sản phẩm chính hãng. Đây là dòng vợt cao cấp, được hãng thiết kế riêng biệt dành cho người kinh nghiệm, chuyên nghiệp.', '3250000', '1748376795_51.webp', 0, 0, 10),
(6, 'Vợt Lining Aeronaut 6000i', 'Lining Aeronaut 6000i là cây vợt nặng đầu, phù hợp với người có lối chơi thiên về tấn công nhưng vẫn xoay chuyển linh hoạt giữa tấn công và phòng thủ. Có thể nói cây Aeronaut 6000i là cây vợt dễ tiêos cận cho mọi người chơi ở cấp độ thể lực và ưu tiên hơn cho người chơi kinh nghiệm, thích lối đánh thiên công. Với thiết kế mạnh mẽ cùng những thông số kỹ thuật nổi bật giúp phát huy tối đa sức mạnh trong từng đường cầu. Là sự lựa chọn không thể bỏ qua cho các bạn đam mê cầu lông dòng vợt thiên công.', '1680000', '1748376888_61.webp', 0, 0, 10),
(7, 'Vợt cầu lông Yonex Astrox 88D', 'Vợt cầu lông Yonex Astrox 88D được đánh giá là cây vợt thiên công chuyên đánh đôi tốt nhất của yonex hiện giờ. Cũng là dòng nhiều vận động viên sử dụng nhất. Vợt cầu lông Yonex Astrox 88D là một phiên bản cải tiến của bản yonex Astrox 77 .\r\n\r\nĐây cũng là sản phẩm được các vận động viên trên thế giới sử dụng như: Kento Momota, Victor Axelsen, Akane Yamaguchi, …Yonex cũng là thương hiệu hàng đầu về cầu lông của việt nam cũng như trên toàn thế giới.\r\nMô tả: Là cây vợt mới của hãng được cải tiến mạnh về khung cũng như chất liệu\r\nMã sản phẩm:  AX88D\r\nTính chất: Cứng / Cứng\r\nKhung:  H.M. GRAPHITE,NANOMETRIC,Tungsten\r\nTrục:  H.M. Graphite + Namd\r\nTrọng lượng/ Kích thước: 4U (Ave.83g) G3,4,5  ,   3U (Ave.88g) G4,5\r\nDây đan:   4U 20-28 lbs (12,5 kg), 3U 21-29 lbs (13kg)\r\nĐiểm cân bằng: 295 (+3- mm)\r\nMàu sắc: Đỏ Ruby xanh\r\nXuất xứ: Nhật Bản', '2849000', '1748377045_111.webp', 0, 0, 4),
(8, 'Vợt cầu lông Yonex Duora Z Strike', 'Vợt cầu lông Yonex Duora Z Strike là cây vợt tấn công mang nhiều công nghệ tiên tiến bậc nhất để giúp người chơi tăng tối đa sức mạnh, tốc độ và sự kiểm soát. Vợt Yonex Duora Z Strike mang đến cho người chơi cảm giác tấn công ấn tượng đầy hiệu quả của sự chắc chắn, ổn định và còn mang đến lối chơi linh hoạt hơn cho người chơi tấn công. Khả năng tấn công của Duora Z Strike là cực kì ấn tượng, đường cầu đầy uy lực và mang sức nặng lớn khiến đối thủ gặp rất nhiều khó khăn trong việc chống đỡ. Ngoài ra, cây vợt đảm bảo hài hòa cả sức mạnh trong tấn công lẫn tốc độ trong phòng thủ.', '4500000', '1748377251_211.webp', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sanphamtieubieu`
--

CREATE TABLE `sanphamtieubieu` (
  `id_SPTB` int(10) UNSIGNED NOT NULL,
  `tenSPTB` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id_size` int(11) NOT NULL,
  `size` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id_size`, `size`) VALUES
(1, '3U5'),
(2, '3U6'),
(3, '4U5'),
(4, '4U6'),
(5, '5U5'),
(6, '5U6');

-- --------------------------------------------------------

--
-- Table structure for table `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `id_ThuongHieu` int(10) UNSIGNED NOT NULL,
  `tenThuongHieu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moTa` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thuonghieu`
--

INSERT INTO `thuonghieu` (`id_ThuongHieu`, `tenThuongHieu`, `moTa`) VALUES
(1, 'Yonex', 'Thương hiệu Nhật Bản hàng đầu trong ngành cầu lông, nổi bật với công nghệ tiên tiến, độ bền cao, và được nhiều tay vợt chuyên nghiệp sử dụng.'),
(2, 'Lining', 'Thương hiệu Trung Quốc có thiết kế sáng tạo, độ bền cao, được nhiều tuyển thủ cầu lông Trung Quốc sử dụng.'),
(3, 'Victor', 'Thương hiệu Đài Loan nổi tiếng với vợt nhẹ, linh hoạt, phù hợp cả người chơi phong trào và chuyên nghiệp.'),
(4, 'Mizuno', 'Thương hiệu Nhật Bản chuyên về giày và vợt cầu lông, nổi bật với độ êm ái, bám sân tốt, phù hợp với người chơi chuyên sâu.'),
(5, 'Apacs', 'Thương hiệu Malaysia có giá thành hợp lý, vợt bền và nhẹ, phù hợp với người chơi phong trào và bán chuyên.'),
(9, 'Forza', 'Forza là một thương hiệu vợt cầu lông nổi tiếng, được biết đến với chất lượng cao và sự đổi mới trong thiết kế sản phẩm. Hãng vợt này cung cấp các sản phẩm phù hợp với nhiều đối tượng người chơi, từ nghiệp dư đến chuyên nghiệp. Vợt Forza nổi bật với tính năng nhẹ, bền và khả năng kiểm soát tốt, giúp người chơi có những pha đánh mạnh mẽ và chính xác.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id_DG`);

--
-- Indexes for table `dongsanpham`
--
ALTER TABLE `dongsanpham`
  ADD PRIMARY KEY (`id_dongSP`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_HD`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_KH`);

--
-- Indexes for table `nguoinhan`
--
ALTER TABLE `nguoinhan`
  ADD PRIMARY KEY (`id_NN`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id_NV`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id_quyen`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_maSP`);

--
-- Indexes for table `sanphamtieubieu`
--
ALTER TABLE `sanphamtieubieu`
  ADD PRIMARY KEY (`id_SPTB`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`id_ThuongHieu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id_DG` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dongsanpham`
--
ALTER TABLE `dongsanpham`
  MODIFY `id_dongSP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_HD` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_KH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nguoinhan`
--
ALTER TABLE `nguoinhan`
  MODIFY `id_NN` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id_NV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `quyen`
--
ALTER TABLE `quyen`
  MODIFY `id_quyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_maSP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sanphamtieubieu`
--
ALTER TABLE `sanphamtieubieu`
  MODIFY `id_SPTB` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `id_ThuongHieu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
