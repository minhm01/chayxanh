-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 12, 2022 lúc 12:55 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `chayxanh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_01_144120_create_tb1_employeee', 2),
(6, '2022_04_02_061842_create_tb1_branch', 3),
(7, '2022_04_11_133737_create_tb1_shift', 4),
(8, '2022_04_11_134809_create_tb1_work', 5),
(9, '2022_04_11_135708_create_tb1_attendance', 5),
(10, '2022_04_12_100240_tb1_weekday', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_admin`
--

CREATE TABLE `tb1_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb1_admin`
--

INSERT INTO `tb1_admin` (`admin_id`, `admin_user`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'minhm01', '1c479acf4b0191984233b0464f3012e1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_attendance`
--

CREATE TABLE `tb1_attendance` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `br_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `checkin` time NOT NULL,
  `checkout` time NOT NULL,
  `duration` time NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_branch`
--

CREATE TABLE `tb1_branch` (
  `br_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb1_branch`
--

INSERT INTO `tb1_branch` (`br_id`, `address`) VALUES
(1, '39 Lê Sao'),
(2, '28 Lê Sao'),
(3, '10 Nguyễn Sơn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_employee`
--

CREATE TABLE `tb1_employee` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `br_id` int(10) UNSIGNED NOT NULL,
  `emp_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_dob` date NOT NULL DEFAULT current_timestamp(),
  `emp_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_pid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb1_employee`
--

INSERT INTO `tb1_employee` (`emp_id`, `br_id`, `emp_name`, `gender`, `emp_dob`, `emp_phone`, `emp_pid`, `role`) VALUES
(2, 1, 'Minh Meo', 'Nữ', '2022-04-03', '1112', '11222', 'manager'),
(3, 3, 'Minn', 'Nam', '2022-04-06', '12121', '13331', 'manager'),
(4, 2, 'Mèo', 'Nam', '2022-04-06', '12312', '333', 'employee'),
(5, 3, 'Mòewww', 'Nam', '2022-04-06', '33', '123', 'employee'),
(6, 2, 'Meow', 'Nam', '2022-04-06', '3232', '333', 'manager'),
(7, 1, 'Awwwwww', 'Nam', '2022-04-06', '2323', '23232', 'employee');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_manager_account`
--

CREATE TABLE `tb1_manager_account` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb1_manager_account`
--

INSERT INTO `tb1_manager_account` (`emp_id`, `password`) VALUES
(2, '202cb962ac59075b964b07152d234b70'),
(3, '202cb962ac59075b964b07152d234b70'),
(6, '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_shift`
--

CREATE TABLE `tb1_shift` (
  `shift_id` int(10) UNSIGNED NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb1_shift`
--

INSERT INTO `tb1_shift` (`shift_id`, `start`, `end`, `duration`) VALUES
(1, '09:00:00', '14:00:00', 5),
(2, '17:00:00', '22:00:00', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_weekday`
--

CREATE TABLE `tb1_weekday` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb1_weekday`
--

INSERT INTO `tb1_weekday` (`id`, `day`, `day2`) VALUES
(1, 'Sunday', 'Chủ nhật'),
(2, 'Monday', 'Thứ hai'),
(3, 'Tuesday', 'Thứ ba'),
(4, 'Wednesday', 'Thứ tư'),
(5, 'Thursday', 'Thứ năm'),
(6, 'Friday', 'Thứ sáu'),
(7, 'Saturday', 'Thứ bảy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb1_work`
--

CREATE TABLE `tb1_work` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `br_id` int(10) UNSIGNED NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `tb1_admin`
--
ALTER TABLE `tb1_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tb1_attendance`
--
ALTER TABLE `tb1_attendance`
  ADD UNIQUE KEY `tb1_attendance_emp_id_checkin_unique` (`emp_id`,`checkin`),
  ADD KEY `br_id` (`br_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Chỉ mục cho bảng `tb1_branch`
--
ALTER TABLE `tb1_branch`
  ADD PRIMARY KEY (`br_id`);

--
-- Chỉ mục cho bảng `tb1_employee`
--
ALTER TABLE `tb1_employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `br_id` (`br_id`);

--
-- Chỉ mục cho bảng `tb1_manager_account`
--
ALTER TABLE `tb1_manager_account`
  ADD PRIMARY KEY (`emp_id`);

--
-- Chỉ mục cho bảng `tb1_shift`
--
ALTER TABLE `tb1_shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Chỉ mục cho bảng `tb1_weekday`
--
ALTER TABLE `tb1_weekday`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tb1_work`
--
ALTER TABLE `tb1_work`
  ADD UNIQUE KEY `tb1_work_emp_id_br_id_shift_id_unique` (`emp_id`,`br_id`,`shift_id`),
  ADD KEY `br_id` (`br_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tb1_admin`
--
ALTER TABLE `tb1_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tb1_branch`
--
ALTER TABLE `tb1_branch`
  MODIFY `br_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tb1_employee`
--
ALTER TABLE `tb1_employee`
  MODIFY `emp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tb1_manager_account`
--
ALTER TABLE `tb1_manager_account`
  MODIFY `emp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tb1_shift`
--
ALTER TABLE `tb1_shift`
  MODIFY `shift_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tb1_weekday`
--
ALTER TABLE `tb1_weekday`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tb1_attendance`
--
ALTER TABLE `tb1_attendance`
  ADD CONSTRAINT `tb1_attendance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tb1_employee` (`emp_id`),
  ADD CONSTRAINT `tb1_attendance_ibfk_2` FOREIGN KEY (`br_id`) REFERENCES `tb1_branch` (`br_id`),
  ADD CONSTRAINT `tb1_attendance_ibfk_3` FOREIGN KEY (`shift_id`) REFERENCES `tb1_shift` (`shift_id`);

--
-- Các ràng buộc cho bảng `tb1_employee`
--
ALTER TABLE `tb1_employee`
  ADD CONSTRAINT `tb1_employee_ibfk_1` FOREIGN KEY (`br_id`) REFERENCES `tb1_branch` (`br_id`),
  ADD CONSTRAINT `tb1_employee_ibfk_2` FOREIGN KEY (`br_id`) REFERENCES `tb1_branch` (`br_id`),
  ADD CONSTRAINT `tb1_employee_ibfk_3` FOREIGN KEY (`br_id`) REFERENCES `tb1_branch` (`br_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb1_employee_ibfk_4` FOREIGN KEY (`br_id`) REFERENCES `tb1_branch` (`br_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tb1_manager_account`
--
ALTER TABLE `tb1_manager_account`
  ADD CONSTRAINT `tb1_manager_account_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tb1_employee` (`emp_id`);

--
-- Các ràng buộc cho bảng `tb1_work`
--
ALTER TABLE `tb1_work`
  ADD CONSTRAINT `tb1_work_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tb1_employee` (`emp_id`),
  ADD CONSTRAINT `tb1_work_ibfk_2` FOREIGN KEY (`br_id`) REFERENCES `tb1_branch` (`br_id`),
  ADD CONSTRAINT `tb1_work_ibfk_3` FOREIGN KEY (`shift_id`) REFERENCES `tb1_shift` (`shift_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
