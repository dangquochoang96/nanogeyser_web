-- Tạo bảng nk_partners cho đối tác phân phối (slider)
CREATE TABLE IF NOT EXISTS `nk_partners` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Tên đối tác',
  `phone` varchar(50) DEFAULT NULL COMMENT 'Số điện thoại',
  `address` text DEFAULT NULL COMMENT 'Địa chỉ',
  `image` varchar(255) DEFAULT NULL COMMENT 'Logo/Ảnh đối tác',
  `order` int(11) DEFAULT 0 COMMENT 'Thứ tự hiển thị',
  `is_active` tinyint(1) DEFAULT 1 COMMENT 'Trạng thái: 1=Kích hoạt, 0=Khóa',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
