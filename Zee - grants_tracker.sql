-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 03, 2021 at 09:26 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grants_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
CREATE TABLE IF NOT EXISTS `awards` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grant_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `awarded_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awards_grant_id_foreign` (`grant_id`),
  KEY `awards_subcategory_id_foreign` (`subcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `grant_id`, `subcategory_id`, `amount`, `awarded_at`, `created_at`, `updated_at`) VALUES
(1, 34, 2, 260000, '2021-03-17', '2021-04-01 10:37:40', '2021-04-01 10:37:40'),
(4, 38, 21, 225000, '2020-10-01', '2021-04-01 11:15:21', '2021-04-01 11:15:21'),
(5, 39, 13, 500000, '2021-02-01', '2021-04-01 11:24:28', '2021-04-01 11:24:28'),
(6, 38, 21, 225000, '2021-04-01', '2021-04-01 11:25:47', '2021-04-01 11:25:47'),
(7, 41, 2, 500000, '2020-08-20', '2021-04-02 15:26:18', '2021-04-02 15:26:18'),
(8, 42, 23, 500000, '2020-08-27', '2021-04-02 15:39:42', '2021-04-02 15:39:42'),
(9, 43, 24, 1500000, '2021-02-16', '2021-04-02 15:54:08', '2021-04-02 15:54:08'),
(10, 40, 23, 200000, '2021-03-31', '2021-04-09 13:43:21', '2021-04-09 13:43:21'),
(11, 49, 19, 450000, '2021-04-09', '2021-04-09 15:27:16', '2021-04-09 15:27:16'),
(12, 44, 18, 950000, '2021-04-12', '2021-04-12 09:05:16', '2021-04-12 09:05:16'),
(13, 46, 2, 280000, '2021-04-10', '2021-04-14 12:26:55', '2021-04-14 12:26:55'),
(14, 46, 2, 1000000, '2021-04-01', '2021-04-14 17:19:54', '2021-04-14 17:19:54'),
(15, 50, 2, 390000, '2021-07-19', '2021-07-24 20:14:54', '2021-07-24 20:14:54'),
(16, 75, 2, 1000000, '2021-08-10', '2021-08-11 20:16:32', '2021-08-11 20:16:32'),
(17, 45, 18, 950000, '2021-07-07', '2021-08-11 20:18:52', '2021-08-11 20:18:52'),
(18, 54, 2, 100000, '2021-08-02', '2021-08-11 20:20:34', '2021-08-11 20:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Food Bank', NULL, NULL),
(2, 'CAP', NULL, NULL),
(3, 'Building', NULL, NULL),
(4, 'Fundraising', NULL, NULL),
(5, 'Youth Work', '2021-04-02 15:51:36', '2021-04-02 15:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `folder_name`, `file_name`, `description`, `location`, `created_at`, `updated_at`) VALUES
(18, NULL, 'Kirti Kulhari 17, Father - FB_IMG_1602498140567.jpg', 'one night', 'Finance', '2021-07-28 14:45:40', '2021-07-28 14:45:40'),
(16, NULL, 'Bibhuti Thakur twtr.jpg', 'A paradising', 'Important Donors', '2021-07-28 08:23:52', '2021-07-28 09:10:27'),
(17, 'Beginning', NULL, 'Test', 'C:\\wamp64\\www\\Grants-tracker-main\\storage\\app\\test2\\Beginning', '2021-07-28 09:25:33', '2021-07-28 09:25:33'),
(14, NULL, 'VVI - Laravel Livewire Drag-n-Drop Files Upload Using AlpineJS.docx', 'Testing purposes only', 'Finance', '2021-07-27 08:36:21', '2021-07-28 09:10:39'),
(13, 'Important Donors', NULL, 'The people who donated heavily in the past.', 'C:\\wamp64\\www\\Grants-tracker-main\\storage\\app\\test2\\Important Donors', '2021-07-27 08:35:06', '2021-07-27 08:35:06'),
(12, 'Finance', NULL, 'Everything related to all the bills.', 'C:\\wamp64\\www\\Grants-tracker-main\\storage\\app\\test2\\Finance', '2021-07-27 08:34:24', '2021-07-27 08:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `grants`
--

DROP TABLE IF EXISTS `grants`;
CREATE TABLE IF NOT EXISTS `grants` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applied_amount` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'application',
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `decision_date` date DEFAULT NULL,
  `submitted_date` date NOT NULL,
  `awarded_date` date DEFAULT NULL,
  `spend_by_date` date DEFAULT NULL,
  `reporting_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grants`
--

INSERT INTO `grants` (`id`, `organization`, `applied_amount`, `description`, `notes`, `contact_person`, `website`, `phone_number`, `email_address`, `status`, `is_completed`, `decision_date`, `submitted_date`, `awarded_date`, `spend_by_date`, `reporting_date`, `created_at`, `updated_at`) VALUES
(34, 'Trussel Trust', 260000, 'Tesco Top up', NULL, 'Becky Ewing', 'www.trusseltrust.org', '07783 517144', 'grants@trusselltrust.org', 'won', 0, '2021-03-23', '2021-03-22', '2021-03-17', '2025-04-01', NULL, '2021-04-01 10:09:23', '2021-04-14 15:26:35'),
(38, 'Charnwood Council', 450000, 'For CAP Fee', NULL, 'Rebecca Dobson', 'www.charnwood.gov.uk', '01509 634730', 'rebecca.dobson@charnwood.gov.uk', 'won', 1, NULL, '2020-10-01', '2020-10-01', '2021-04-10', '2021-04-21', '2021-04-01 11:13:21', '2021-04-23 13:43:58'),
(39, 'Trussel Trust', 500000, 'For Vicki fundraising and family work', 'When was the £5k for Vicki received?', 'James', 'www.trusseltrust.org', NULL, 'grants@trusselltrust.org', 'won', 0, '2021-02-01', '2025-01-31', '2021-02-01', '2025-07-31', NULL, '2021-04-01 11:23:10', '2021-04-14 15:27:15'),
(40, 'EMA Community Fund', 200000, 'New Food Store Project', 'Doesn\'t provide grants for electrics etc but was advised to apply for the whole project and they can fund whichever part they want.', 'Colleen Hempson', 'www.trusseltrust.org', '01332 852801', 'Community@eastmidlandsairport.com', 'won', 0, '2021-04-09', '2021-03-26', '2021-03-31', '2022-04-01', '2022-05-31', '2021-04-01 11:30:48', '2021-04-09 13:43:21'),
(41, 'Shire / Leics County Council', 500000, 'General running costs', 'Apparently kept vague (according to Jules and Matthew) so can be used on anything in the Foodbank?', 'Noel / Andy', NULL, NULL, NULL, 'won', 0, '2020-08-20', '2020-08-10', '2020-08-20', '2021-09-30', '2021-10-31', '2021-04-02 13:59:49', '2021-04-02 15:28:39'),
(42, 'Trussel Trust', 500000, 'New Food Store.', NULL, NULL, NULL, NULL, NULL, 'won', 0, NULL, '2020-08-20', '2020-08-27', '2021-08-27', NULL, '2021-04-02 14:02:42', '2021-04-14 15:29:33'),
(43, 'Shire / Leics County Council', 1500000, 'Won: 15000 for Families & Youth Worker', '*. Awarded: 16/2/21\r\n\r\n\r\nNathaniel starting 1st August 2021 because of Uni and commitments.', 'Andy', NULL, NULL, NULL, 'won', 0, '2021-02-16', '2021-02-10', '2021-02-16', '2022-08-31', '2021-09-30', '2021-04-02 14:06:16', '2021-04-02 15:54:57'),
(44, 'TNL Community Fund (Lottery)', 950000, 'For Pete Talbot\'s Salary', 'If haven\'t heard in 12 weeks contact them.  End of June\r\n\r\nApplication number: 20166350\r\n\r\nWide ranges of funds available, worth looking at other things to apply for.\r\nWe have already had £26k in 2020 from them.', NULL, 'www.tnlcommunityfund.org.uk', '028 9568 0143', 'general.enquiries@tnlcommunityfund.org.uk', 'won', 0, '2021-06-30', '2021-03-25', '2021-04-12', '2022-04-30', '2022-05-31', '2021-04-02 16:37:01', '2021-04-12 09:05:16'),
(45, 'Police Commissioner Grant', 950000, 'Pete Talbot\'s Salary', 'Michael.Macleod@leics.pcc.pnn.gov.uk - contact', 'Michael Macleod', 'www.leics.pcc.police.uk/Planning-and-Money/Commissioning/Current-Funding-Available/PCCs-Prevention-Fund-2020-21.aspx', '0116 2298980', 'PCCPreventionFund@leics.pcc.pnn.gov.uk', 'won', 0, '2021-07-10', '2021-04-10', '2021-07-07', '2022-08-31', '2022-08-31', '2021-04-02 16:38:39', '2021-08-11 20:18:52'),
(46, 'Donations - Individuals', 500000, 'Non-Grant Donations from Individuals', 'April 2021 - Andrew Grey £2800', NULL, NULL, NULL, NULL, 'won', 0, NULL, '2020-04-01', '2021-04-10', '2026-04-30', NULL, '2021-04-05 13:44:12', '2021-04-14 15:30:03'),
(47, 'Donations - Companies', 500000, 'Non-Grants  Donations from Companies', 'Not including donations from individuals', NULL, NULL, NULL, NULL, 'application', 0, NULL, '2020-04-01', NULL, NULL, NULL, '2021-04-05 13:45:08', '2021-04-05 13:45:08'),
(48, 'Postcode Places Trust', 1500000, 'For Vicki\'s salary', 'Core Funding for salary\r\nPreventing or reducing the impact of poverty - Theme', 'Enrique Sanchez', 'www.postcodeplacestrust.org.uk/apply-for-a-grant/', NULL, 'info@postcodeplacestrust.org.uk', 'not won', 0, '2021-05-28', '2021-04-02', NULL, NULL, NULL, '2021-04-06 16:26:43', '2021-06-17 19:43:33'),
(49, 'The Beatrice Laing Trust', 16000000, 'Pete Talbot\'s Salary', '*. Have to wait 12 months before applying again (April 2022) but then can apply for the building.\r\n* They don\'t like email\r\nOriginally applied for many things.  They awarded £4500 to buy container but we already have the container.  Spoke to Elizabeth Harley on the phone on 9th April 4pm.  She agreed for us to use the money for Pete\'s salary.  No time scale given, just need to send them a letter saying we have received the money.  Letter should be attached.', 'Ms Elizabeth Harley', 'https://www.laingfamilytrusts.org.uk', '02082388890', NULL, 'won', 0, '2021-04-05', '2020-12-01', '2021-04-09', '2022-04-30', NULL, '2021-04-09 15:24:56', '2021-04-14 15:45:13'),
(50, 'Charnwood Community Grants', 396000, 'For Vicki\'s Family Worker Salary', '1 year of salary for Vicki \r\nCan apply again 10th September 2021', 'Tina Robinson', 'www.charnwood.gov.uk/pages/commdevgrants', NULL, 'VCSupport@charnwood.gov.uk', 'won', 0, '2021-07-01', '2021-04-30', '2021-07-19', '2021-07-31', '2022-07-31', '2021-04-28 19:28:44', '2021-07-24 20:14:54'),
(51, 'Everards Community Excellence Fund', 400000, 'For Meeting Room', 'Must be used in three months', NULL, 'www.everards.co.uk/communityfund/', NULL, NULL, 'not won', 0, '2021-05-31', '2021-04-29', NULL, NULL, NULL, '2021-04-28 19:34:24', '2021-06-17 19:43:22'),
(52, 'Persimmon Community Champions', 100000, 'For core costs -Foodbank', 'Short online application - can apply next month if not successful this time.', NULL, 'www.persimmonhomes.com/community-champions/', NULL, NULL, 'application', 0, '2021-08-01', '2021-07-07', NULL, NULL, NULL, '2021-05-10 10:39:26', '2021-07-07 20:57:00'),
(53, 'The Screwfix Foundation', 500000, 'For Meeting Room', NULL, NULL, 'www.screwfix.com/help/screwfixfoundation/', NULL, NULL, 'not won', 0, '2021-06-30', '2021-05-10', NULL, NULL, NULL, '2021-05-10 13:06:05', '2021-06-29 13:46:49'),
(54, 'The Arnold Clark Community Fund', 100000, 'Core costs - CAP and Foodbank', NULL, NULL, 'www.arnoldclark.com/community-fund/', NULL, NULL, 'won', 0, '2021-06-30', '2021-05-10', '2021-08-02', '2022-08-02', NULL, '2021-05-10 15:11:09', '2021-08-11 20:20:34'),
(55, 'Co-op Local Community Fund', 466000, 'For Family Worker Salary for one year', 'If you are successful your cause will receive your share of the funding in 2 payments - one in April 2022 and one in November 2022.\r\nYour Cause ID is: 58408.\r\nhttps://causes.coop.co.uk/terms-and-conditions - Terms and Conditions', NULL, 'causes.coop.co.uk/', '0800 0686 727', NULL, 'application', 0, '2021-10-31', '2021-05-21', NULL, NULL, NULL, '2021-05-21 16:20:12', '2021-05-21 16:21:34'),
(57, 'Florence Turner Trust ', 1500000, 'Johnny\'s CAP salary ', NULL, 'Helen Pole ', 'https://register-of-charities.charitycommission.gov.uk/charity-search/-/charity-details/502721/what-who-how-where', NULL, 'helen.pole@shma.co.uk', 'application', 0, NULL, '2021-06-01', NULL, NULL, NULL, '2021-05-28 20:39:35', '2021-05-28 20:39:35'),
(58, 'Edith Murphy Foundation ', 1500000, 'Johnny\'s CAP salary ', NULL, NULL, 'edithmurphy.co.uk/', NULL, 'charitabletrusts@ludlowtrust.com', 'application', 0, NULL, '2021-06-01', NULL, NULL, NULL, '2021-05-28 20:43:14', '2021-05-28 20:43:14'),
(59, 'Everard Foundation', 750000, 'Youth Worker Salary', 'Application sent by post', 'Richard Everard', 'fundsonline.org.uk/funds/the-everard-foundation/', NULL, NULL, 'application', 0, NULL, '2021-06-17', NULL, NULL, NULL, '2021-06-17 19:32:39', '2021-06-17 19:49:09'),
(60, 'Dromintee Trust', 750000, 'Youth Worker Salary', 'Application sent by post', 'Hugh Murphy', 'fundsonline.org.uk/funds/dromintee-trust/', '0116 260 3877', 'drominteetrust@gmail.com', 'application', 0, NULL, '2021-06-17', NULL, NULL, NULL, '2021-06-17 19:35:31', '2021-06-17 19:44:59'),
(61, 'Elise Talbot Will Trust', 750000, 'Youth Worker Salary', 'Application sent by post: \r\n11 ST GEORGES PLACE\r\nLORD STREET\r\nSOUTHPORT\r\nMERSEYSIDE\r\nPR9 0AL', NULL, 'opencharities.org/charities/279288', '01704542002', 'law@brownturnerross.com', 'application', 0, NULL, '2021-06-17', NULL, NULL, NULL, '2021-06-17 19:38:15', '2021-06-17 19:46:42'),
(62, 'Chetwode Foundation', 750000, 'Youth Worker Salary', 'Recurrent grants may be considered.', NULL, 'www.thechetwodefoundation.co.uk/', '0115 9893722', 'info@thechetwodefoundation.co.uk', 'application', 0, '2021-11-30', '2021-06-17', NULL, NULL, NULL, '2021-06-17 19:42:13', '2021-06-18 15:30:47'),
(63, 'Leicestershire and Rutland Community Foundation', 300000, 'Foodbank and CAP - core costs/salaries', 'Making Local Life Better Fund - category 2', NULL, 'www.llrcommunityfoundation.org.uk/apply-for-funds/making-local-life-better-fund-currently-open/', '0116 2624 916', 'grants@llrcommunityfoundation.org.uk', 'application', 0, NULL, '2021-06-18', NULL, NULL, NULL, '2021-06-18 15:22:59', '2021-06-18 15:24:57'),
(64, 'Sainsbury Family Charitable Trust', 100, 'CAP and Foodbank', 'No specific amount applied for. This was an initial funding enquiry.', NULL, 'sfct.org.uk/index.html', NULL, NULL, 'application', 0, '2021-09-30', '2021-06-18', NULL, NULL, NULL, '2021-06-18 15:28:51', '2021-06-18 15:29:14'),
(65, 'Assura Community Fund', 476000, 'Family Worker Salary', 'https://cheshirecommunityfoundation.org.uk/grants/assura-community-fund/ - managed by Cheshire Community Foundation \r\n\r\nNote - application saved here was not the final version (it had a few changes online after this version was saved)', NULL, 'assura.co.uk/assura-community-fund/', '01606 330 607', 'grants@cheshirecommunityfoundation.org.uk', 'application', 0, '2021-10-18', '2021-06-28', NULL, NULL, NULL, '2021-06-28 09:32:59', '2021-06-28 09:34:43'),
(66, 'The George Ernest Ellis Foundation', 474000, 'Family Worker Salary', 'Trustees meet in the summer to consider applications\r\n\r\nReceived a letter from Matthew Ellis. Application was received and will be considered in a trustee meeting in June 2022.', 'Mr Matthew Ellis', 'register-of-charities.charitycommission.gov.uk/charity-search/-/charity-details/701510/charity-overview', '0116 258 1640', 'matthew@mywealthmanagement.co.uk', 'application', 0, '2021-09-01', '2021-06-28', NULL, NULL, NULL, '2021-06-28 11:19:39', '2021-08-11 20:25:24'),
(67, 'The Helen Jean Cope Charity', 474000, 'Family Worker Salary', 'The Secretary, HJC Charity, 1 Woodgate, Loughborough, Leics, LE11 2TY', NULL, 'thehelenjeancopecharity.co.uk/', '01509 218 298', 'info@thehelenjeancopecharity.co.uk', 'not won', 0, '2021-09-01', '2021-06-28', NULL, NULL, NULL, '2021-06-28 11:33:09', '2021-07-01 11:31:33'),
(68, 'The Woodward Charitable Trust', 300000, 'Youth Worker Salary', NULL, NULL, 'woodwardcharitabletrust.org.uk/', '020 7410 0330', 'contact@woodwardcharitabletrust.org.uk', 'application', 0, '2021-11-30', '2021-06-28', NULL, NULL, NULL, '2021-06-28 11:42:50', '2021-06-28 11:47:59'),
(70, 'doit.life', 1050000, 'Youth Worker Salary', 'Needs to be spent between 1/8 and 31/1/22', 'n/a', 'doit.life/ukyouth', 'n/a', 'funding@ukyouth.org', 'application', 0, '2021-07-28', '2021-07-07', NULL, NULL, NULL, '2021-07-07 10:31:33', '2021-07-07 10:31:33'),
(74, 'Intelligent Energy', 2200000, 'Mental Health Worker Salary', '•	The funds applied for must be able to meet the whole cost of the project and must only be used for the project you have detailed in your application\r\n•	Funds donated must be claimed within a three-month period of applicant receiving notification of successful award', NULL, 'www.intelligent-energy.com/about-ie/charitable-trust/overview/', NULL, 'charitable.trust@intelligent-energy.com', 'application', 0, NULL, '2021-07-02', NULL, NULL, NULL, '2021-07-07 20:21:55', '2021-07-07 20:22:41'),
(75, 'Shire Community Grant 2021/22', 1000000, 'Mental Health Worker Salary', NULL, NULL, NULL, NULL, NULL, 'won', 0, NULL, '2021-07-07', '2021-08-10', '2022-08-31', '2021-08-31', '2021-07-07 20:26:49', '2021-08-11 20:16:32'),
(76, 'Trussell Trust Strategic Resources', 3260000, 'Next Steps Facilitator', 'We have applied for two years (total £32,600) \r\nYear 1:\r\nSalary – £15,000\r\nNI – £850\r\nPension - £450\r\nTotal – £16,300\r\n\r\nYear 2\r\nSalary – £15,000\r\nNI – £850\r\nPension - £450\r\nTotal - 16,300', NULL, 'hub.foodbank.org.uk/grants/current-grant-streams/', NULL, NULL, 'application', 0, NULL, '2021-07-07', NULL, NULL, NULL, '2021-07-07 20:33:23', '2021-07-07 20:37:03'),
(77, 'Albert Hunt Trust', 500000, '£5000 for mental health worker', 'Contacted prior to application and they said they would be happy to receive an application for a mental health worker.', NULL, 'www.alberthunttrust.org.uk', '0330 113 7280', 'info@alberttrust.org.uk', 'application', 0, NULL, '2021-07-09', NULL, NULL, NULL, '2021-07-09 16:23:50', '2021-07-09 16:23:50'),
(78, 'Tesco Community Grant', 150000, 'Foodbank General Costs', 'For Foodbank Costs:\r\nFood purchases - £500\r\nShopping Card Printing - £300\r\nRefreshments for clients - £350\r\nBaskets - £350  \r\nTotal - £1500', NULL, 'tescocommunitygrants.org.uk/', NULL, NULL, 'application', 0, '2022-07-31', '2021-07-24', NULL, NULL, NULL, '2021-07-24 20:16:37', '2021-07-24 20:20:30'),
(79, 'Severn Trent Community Fund', 1200000, 'Mental Health Worker', NULL, NULL, 'stwater.co.uk/communityfund', NULL, 'communityfund@severntrent.co.uk', 'application', 0, '2021-10-31', '2021-08-25', NULL, NULL, NULL, '2021-08-25 08:56:37', '2021-08-25 08:57:48'),
(80, 'Trussell Trust Financial Inclusion ', 3504000, 'Johnny\'s CAP salary (two years)', NULL, NULL, 'https://hub.foodbank.org.uk/grants/current-grant-streams/', NULL, NULL, 'application', 0, NULL, '2021-08-26', NULL, NULL, NULL, '2021-08-26 10:40:19', '2021-08-26 10:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Grant', 44, '2f67cdc5-f83c-4d44-82ea-e7b6e785cbdf', 'default', 'VOQVKm85m2RzsYVlKQtG7805FnBJq4-metaVE5MRlVOREFQUC5wZGY=-', 'TNLFUNDAPP.pdf', 'application/pdf', 'public', 'public', 106337, '[]', '[]', '[]', '[]', 1, '2021-04-02 16:37:24', '2021-04-02 16:37:24'),
(2, 'App\\Models\\Grant', 48, 'd90cb06e-3532-41a6-aa76-ec1e0eddb284', 'default', 'NOEEiyU8xoLKbthhAHQ1AWrAoiGZHP-metaUG9zdGNvZGVfR3JhbnRbMTIzXS5kb2N4-', 'Postcode_Grant[123].docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 122213, '[]', '[]', '[]', '[]', 2, '2021-04-06 16:27:03', '2021-04-06 16:27:03'),
(3, 'App\\Models\\Grant', 45, '7ecf5bb9-e341-4e30-811b-7d6a70923009', 'default', 'vxknGfowZRdEaYXR0b0akgryNCIphn-metaUENDIEdyYW50IFByb3Bvc2FsIEZvb2RiYW5rIFByb2plY3QuZG9jeA==-', 'PCC-Grant-Proposal-Foodbank-Project.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 122809, '[]', '[]', '[]', '[]', 3, '2021-04-06 16:29:52', '2021-04-06 16:29:52'),
(4, 'App\\Models\\Grant', 45, '0a2db472-a340-48be-b1ce-13917ff8b167', 'default', 'CRaA78fZrX4vDFQMX7OuYgA0xLgONu-metaRWxpZ2liaWxpdHktU3RhdGVtZW50LTIwMjAtMjEgRm9vZGJhbmsgUHJvamVjdC5kb2N4-', 'Eligibility-Statement-2020-21-Foodbank-Project.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 156516, '[]', '[]', '[]', '[]', 4, '2021-04-06 16:29:58', '2021-04-06 16:29:58'),
(5, 'App\\Models\\Grant', 49, '94ca5e40-d63c-41a8-a5f4-fe8ce58417ba', 'default', 'B8ncf8MWVyZqv2UNIDGw8dcPiJjfVh-metaTGV0dGVyIHRvIExhaW5nVHJ1c3QucGRm-', 'Letter-to-LaingTrust.pdf', 'application/pdf', 'public', 'public', 274639, '[]', '[]', '[]', '[]', 5, '2021-04-09 15:25:51', '2021-04-09 15:25:51'),
(6, 'App\\Models\\Grant', 49, 'bdae3e11-6ac9-428a-9e8e-1f65e7e0905e', 'default', 'B8Etrs58iUtBUZF17up6wGgAa3Z5Ug-metabGFpbmcuanBlZw==-', 'laing.jpeg', 'image/jpeg', 'public', 'public', 52668, '[]', '[]', '[]', '[]', 6, '2021-04-09 15:30:43', '2021-04-09 15:30:43'),
(7, 'App\\Models\\Grant', 44, '2280c3b8-fad5-4199-bc0f-8bba55629b1c', 'default', 'bPKXo2wLjx5Nv7AYzb023AfqusEPHz-metaVE5MX2VtYWlsLnBkZg==-', 'TNL_email.pdf', 'application/pdf', 'public', 'public', 93597, '[]', '[]', '[]', '[]', 7, '2021-04-12 09:04:21', '2021-04-12 09:04:21'),
(8, 'App\\Models\\Grant', 40, 'd3f41e3a-2d65-4b83-88d5-6e05d19cb295', 'default', 'yWcUD4eay3A4u4FSm9lKksaMu9qbAZ-metaRU1BX0VtYWlsLnBkZg==-', 'EMA_Email.pdf', 'application/pdf', 'public', 'public', 67894, '[]', '[]', '[]', '[]', 8, '2021-04-12 09:13:33', '2021-04-12 09:13:33'),
(9, 'App\\Models\\Grant', 43, 'f1e23198-c99b-41f7-9902-3823c0f5e31c', 'default', 'adVmfv7yal18iigoFvOZ6qibepDBAI-metaMjgxNSBDRlIzIEdyYW50IEFwcHJvdmFsIExldHRlci5wZGY=-', '2815-CFR3-Grant-Approval-Letter.pdf', 'application/pdf', 'public', 'public', 147799, '[]', '[]', '[]', '[]', 9, '2021-04-12 09:57:34', '2021-04-12 09:57:34'),
(10, 'App\\Models\\Grant', 43, '7afedf7b-5bcf-4c0e-a0c9-6c46011ff2b5', 'default', '1qFJQxEPtfDJrQAuDJgKRoyBK5IXIY-metaRXhwZW5kaXR1cmUgUmVwb3J0IDIwMjAtMjEgVGVtcGxhdGUueGxzeA==-', 'Expenditure-Report-2020-21-Template.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'public', 'public', 18475, '[]', '[]', '[]', '[]', 10, '2021-04-12 09:57:40', '2021-04-12 09:57:40'),
(11, 'App\\Models\\Grant', 40, '7a3dd1fb-58fc-44ac-9be7-3aa2132d7184', 'default', 'jkLxOSHdUvibVFg7EvU9le7QZIDoxi-metaSU1HLTIwMjEwNDEyLVdBMDAwM1sxNDFdLmpwZw==-', 'IMG-20210412-WA0003[141].jpg', 'image/jpeg', 'public', 'public', 155273, '[]', '[]', '[]', '[]', 11, '2021-04-12 10:03:57', '2021-04-12 10:03:57'),
(14, 'App\\Models\\Grant', 43, '2083d305-ee1b-4d6e-9b9a-db8252dd2e39', 'default', 'rgce554HK8BL5krfPZG4lFUCqypFhD-metaR3JhbnQgQ29uZGl0aW9ucyBhbmQgUmVwb3J0aW5nIEZvcm0uZG9jeA==-', 'Grant-Conditions-and-Reporting-Form.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 528508, '[]', '[]', '[]', '[]', 12, '2021-04-12 10:14:13', '2021-04-12 10:14:13'),
(16, 'App\\Models\\Grant', 38, '349b214c-932c-4297-af2d-b06e5f12ca82', 'default', '2z0YYWgAL5ac1E4iGPwBF6BUtvtA0Z-metaMjAwODI3IDI4IE5ldyBMaWZlIENodXJjaCAtIEdyYW50IEF3YXJkZWQgTGV0dGVyLmRvYw==-', '200827-28-New-Life-Church---Grant-Awarded-Letter.doc', 'application/msword', 'public', 'public', 179200, '[]', '[]', '[]', '[]', 13, '2021-04-12 10:22:53', '2021-04-12 10:22:53'),
(17, 'App\\Models\\Grant', 41, 'aaa23387-f4a7-41e3-ae32-74a205c26134', 'default', 'KOxjZApzNUoRj4Y6zwz0lDhi1G5d8m-metaR3JhbnQgQXBwcm92YWwgTGV0dGVyIC0gTG91Z2ggQXJlYSBGb29kYmFuay5wZGY=-', 'Grant-Approval-Letter---Lough-Area-Foodbank.pdf', 'application/pdf', 'public', 'public', 127988, '[]', '[]', '[]', '[]', 14, '2021-04-12 13:48:27', '2021-04-12 13:48:27'),
(18, 'App\\Models\\Grant', 41, '73bd6feb-d7a2-459a-9a76-ed8107843365', 'default', 'WurGiJa4XFDlZsy4wo6vthwy7pQ2UB-metaR3JhbnQgQ29uZGl0aW9ucyBhbmQgUmVwb3J0aW5nIEZvcm0uZG9jeA==-', 'Grant-Conditions-and-Reporting-Form.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 528498, '[]', '[]', '[]', '[]', 15, '2021-04-12 13:48:34', '2021-04-12 13:48:34'),
(19, 'App\\Models\\Grant', 41, '86873c72-fdf9-42fe-995c-52edd9fae9d1', 'default', '6uIVlTJWWf6hBqUSlvUGvv2jOoBvpp-metaUmVwb3J0IExDQyBmb29kIGFuZCBlc3NlbnRpYWwgc3VwcGxpZXMgZnVuZC5kb2N4-', 'Report-LCC-food-and-essential-supplies-fund.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 80688, '[]', '[]', '[]', '[]', 16, '2021-04-12 13:48:43', '2021-04-12 13:48:43'),
(20, 'App\\Models\\Grant', 38, '41d51ecb-5e03-4291-9652-8ae8be12478a', 'default', 'W1VjA4yNqnD8tQcPqZm1ps4DDy8TVf-metaRW5kIG9mIFByb2plY3QgTW9uaXRvcmluZyBGb3JtIC0gQ292aWQgUmVjb3ZlcnkgR3JhbnRzLmRvY3g=-', 'End-of-Project-Monitoring-Form---Covid-Recovery-Grants.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 47905, '[]', '[]', '[]', '[]', 17, '2021-04-14 15:10:27', '2021-04-14 15:10:27'),
(21, 'App\\Models\\Grant', 44, 'af5fc484-91b1-4a44-b8e7-243bd2b523bb', 'default', 'sxf3voSr67vEWXk0VI0niPiM4cgbk2-metaUGF5bWVudCBSZW1pdHRhbmNlWzE5Ml0ucGRm-', 'Payment-Remittance[192].pdf', 'application/pdf', 'public', 'public', 114917, '[]', '[]', '[]', '[]', 18, '2021-04-22 09:42:39', '2021-04-22 09:42:39'),
(23, 'App\\Models\\Grant', 38, '0f9da25a-66f7-43f0-aeaa-34a4a998fc47', 'default', 'FCnf66sOH015PtIhddF3WkVKNcSkKC-metaY2FwcmVjZWlwdGVtYWlsWzE5N10ucGRm-', 'capreceiptemail[197].pdf', 'application/pdf', 'public', 'public', 31410, '[]', '[]', '[]', '[]', 19, '2021-04-22 19:38:02', '2021-04-22 19:38:02'),
(24, 'App\\Models\\Grant', 38, '242c38d9-ba76-4897-8c0e-155813dc1036', 'default', 'fMNU2gFh644PqTzcvfMiID6X2Unk4R-metaRW5kLW9mLVByb2plY3QtTW9uaXRvcmluZy1Gb3JtLS0tQ292aWQtUmVjb3ZlcnktR3JhbnRzIC0gTmV3IExpZmUgQ29tbXVuaXR5IENodXJjaCAucGRm-', 'End-of-Project-Monitoring-Form---Covid-Recovery-Grants---New-Life-Community-Church-.pdf', 'application/pdf', 'public', 'public', 207884, '[]', '[]', '[]', '[]', 20, '2021-04-23 13:43:46', '2021-04-23 13:43:46'),
(25, 'App\\Models\\Grant', 50, 'ee4a2ec3-867e-460d-bfb5-3ef339974d59', 'default', 'bkpeQHjDOrnZQU6LT2GN9sCjeJvgo8-metaQ2hhcm53b29kIENvbW11bml0eSBHcmFudHMgLSBBcHBsaWNhdGlvbiBGb3JtIDIwMjEtMjIgTmV3IExpZmUgQ29tbXVuaXR5IENodXJjaC5wZGY=-', 'Charnwood-Community-Grants---Application-Form-2021-22-New-Life-Community-Church.pdf', 'application/pdf', 'public', 'public', 306231, '[]', '[]', '[]', '[]', 21, '2021-04-28 19:29:14', '2021-04-28 19:29:14'),
(27, 'App\\Models\\Grant', 51, 'ab545bd7-ab3d-4f48-861b-86f6b123a148', 'default', 'ae5wOZwVXSPopsO4STdYmOHfEIGeKG-metaUXVvdGUgZm9yIG1lZXRpbmcgcm9vbS5wZGY=-', 'Quote-for-meeting-room.pdf', 'application/pdf', 'public', 'public', 183963, '[]', '[]', '[]', '[]', 23, '2021-04-28 19:34:50', '2021-04-28 19:34:50'),
(28, 'App\\Models\\Grant', 51, 'fb85a2e8-53c0-4613-88e7-4612bf0f61c3', 'default', 'VQ85X8YKTZkWTuB7y2f8N0zvbuRV0T-metaRXZlcmFyZHMgQXBwbGljYXRpb24uZG9jeA==-', 'Everards-Application.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 24394, '[]', '[]', '[]', '[]', 24, '2021-04-28 19:36:15', '2021-04-28 19:36:15'),
(29, 'App\\Models\\Grant', 53, '13ffbed5-34f8-4d88-b77a-7cf730467e16', 'default', 'wMba5wu8XqLzQX9PNHpsjlun3MaWgI-metaU2NyZXdmaXggRm91bmRhdGlvbiBBcHBsaWNhdGlvbiBRdWVzdGlvbnMuZG9jeA==-', 'Screwfix-Foundation-Application-Questions.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 16577, '[]', '[]', '[]', '[]', 25, '2021-05-10 13:06:23', '2021-05-10 13:06:23'),
(31, 'App\\Models\\Grant', 54, 'fce6e2f1-faae-46fc-8905-936800dcf371', 'default', 'yZtyarISjxrL9tUQKHADk5zJawQr8B-metaQXJub2xkIENsYXJrIEFwcGxpY2F0aW9uIFF1ZXN0aW9ucy5kb2N4-', 'Arnold-Clark-Application-Questions.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 14331, '[]', '[]', '[]', '[]', 27, '2021-05-10 15:13:18', '2021-05-10 15:13:18'),
(32, 'App\\Models\\Grant', 55, 'd2c9d74d-78d7-44e0-81b4-200bd67ca590', 'default', 'pvjsaVipZJgdp3v91Ft2CVhpbI7vHa-metaWW91ciBMb2NhbCBDb21tdW5pdHkgRnVuZCBhcHBsaWNhdGlvbi5kb2N4-', 'Your-Local-Community-Fund-application.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 15564, '[]', '[]', '[]', '[]', 28, '2021-05-21 16:20:33', '2021-05-21 16:20:33'),
(33, 'App\\Models\\Grant', 57, '4d2572be-421b-44ad-9e3f-120ddc07b2a8', 'default', 'Slpv2cD9Af7jEQW7PRIu2qROwTrSgw-metaRmxvcmVuY2UgVHVybmVyIFRydXN0IFByb3Bvc2FsLnBkZg==-', 'Florence-Turner-Trust-Proposal.pdf', 'application/pdf', 'public', 'public', 198153, '[]', '[]', '[]', '[]', 29, '2021-05-28 20:39:53', '2021-05-28 20:39:53'),
(34, 'App\\Models\\Grant', 57, 'c0a05354-3472-4e5c-87b5-af2043c1cd3d', 'default', 'KCJIdWhZKHam5GIooSe8t4PiB5IFQF-metaQ292ZXJpbmcgTGV0dGVyLmRvY3g=-', 'Covering-Letter.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 166519, '[]', '[]', '[]', '[]', 30, '2021-05-28 20:40:36', '2021-05-28 20:40:36'),
(35, 'App\\Models\\Grant', 58, 'a4157d02-a422-4441-abd5-8ea31abebd50', 'default', 'B9bXXY77AItEDPuUIuHtdPt6VbpmIY-metaRWRpdGggTXVycGh5IEZvdW5kYXRpb24gUHJvcG9zYWwuZG9jeA==-', 'Edith-Murphy-Foundation-Proposal.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 33064, '[]', '[]', '[]', '[]', 31, '2021-05-28 20:43:49', '2021-05-28 20:43:49'),
(36, 'App\\Models\\Grant', 62, '5391c58d-45ae-4bbe-848f-945c9aecbc84', 'default', 'dx01nYRkQW54ycNrKwTSJYceIbPCwL-metaQXBwbGljYXRpb24gRm9ybSByZXZpc2VkIEphbl8yMCAoMSkuZG9j-', 'Application-Form-revised-Jan_20-(1).doc', 'application/msword', 'public', 'public', 67072, '[]', '[]', '[]', '[]', 32, '2021-06-17 19:43:00', '2021-06-17 19:43:00'),
(37, 'App\\Models\\Grant', 62, '5caaf977-fa3e-4cc5-8031-dde011443cf7', 'default', 'p4ZWXL7rAA6exktJWcY3vZPOWuVBI5-metaQ2hldHdvZGUgRm91bmRhdGlvbiBBcHBsaWNhdGlvbi5kb2N4-', 'Chetwode-Foundation-Application.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 232032, '[]', '[]', '[]', '[]', 33, '2021-06-17 19:43:08', '2021-06-17 19:43:08'),
(38, 'App\\Models\\Grant', 60, 'e5c5025e-1774-4d36-81cb-cd9b23c8f41e', 'default', 'Eku3OgB8TVNGDS6alz3ngrica58cwo-metaQ292ZXJpbmcgTGV0dGVyLmRvY3g=-', 'Covering-Letter.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 166708, '[]', '[]', '[]', '[]', 34, '2021-06-17 19:44:51', '2021-06-17 19:44:51'),
(39, 'App\\Models\\Grant', 60, 'e7eac2f3-be9f-4622-baf2-d9a7ea3d2255', 'default', 'kXNMSZlIJ7f4UbmFdgv7PyM2PkFwTZ-metaRHJvbWludGVlIFRydXN0IFByb3Bvc2FsLmRvY3g=-', 'Dromintee-Trust-Proposal.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 272543, '[]', '[]', '[]', '[]', 35, '2021-06-17 19:44:56', '2021-06-17 19:44:56'),
(40, 'App\\Models\\Grant', 61, '2fe8b995-83ea-4976-8be7-b4da832ec6ba', 'default', '1xAiiSavkW2G47jCEAfsJ2XKJxM217-metaRWxzaWUgVGFsYm90IFRydXN0IFByb3Bvc2FsLmRvY3g=-', 'Elsie-Talbot-Trust-Proposal.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 272557, '[]', '[]', '[]', '[]', 36, '2021-06-17 19:46:39', '2021-06-17 19:46:39'),
(41, 'App\\Models\\Grant', 59, 'aba3a6fd-1ec8-4a07-9874-fbec7ee4a8ec', 'default', 'wpDBzeGSpPeD0U2RRCIb76x2WnviB3-metaRXZlcmFyZCBGb3VuZGF0aW9uIFByb3Bvc2FsLmRvY3g=-', 'Everard-Foundation-Proposal.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 382798, '[]', '[]', '[]', '[]', 37, '2021-06-17 19:49:05', '2021-06-17 19:49:05'),
(42, 'App\\Models\\Grant', 63, '5498e34a-a959-436b-88fe-85b6b07de8d5', 'default', 'cv7pVVyoomOISazdlsj8oj5VKB29r0-metaTGVpY2VzdGVyc2hpcmUgYW5kIFJ1dGxhbmQgQ29tbXVuaXR5IEZvdW5kYXRpb24gR3JhbnQgQXBwbGljYXRpb24gRHJhZnQgKE5IIGNvbW1lbnRzKVsyMDRdLmRvY3g=-', 'Leicestershire-and-Rutland-Community-Foundation-Grant-Application-Draft-(NH-comments)[204].docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 49219, '[]', '[]', '[]', '[]', 38, '2021-06-18 15:23:27', '2021-06-18 15:23:27'),
(43, 'App\\Models\\Grant', 63, '7caff66b-54d3-4ca7-b383-252e00d0b3d1', 'default', 'euY8vXyfBKGdTrtjmRiBrAcc0Joi39-metaR3JhbnQtQXBwbGljYXRpb24tc3VwcG9ydC1ndWlkZS5wZGY=-', 'Grant-Application-support-guide.pdf', 'application/pdf', 'public', 'public', 841269, '[]', '[]', '[]', '[]', 39, '2021-06-18 15:23:34', '2021-06-18 15:23:34'),
(44, 'App\\Models\\Grant', 63, 'b90884dc-f171-438f-b6ea-0572bdb29eac', 'default', 'lsKm6UNmozfwoZgTxLgZMXNk9cR62n-metaTWFraW5nLUxvY2FsLUxpZmUtQmV0dGVyLUVsaWdpYmlsaXR5LWFuZC1HdWlkYW5jZS0yMDIxLnBkZg==-', 'Making-Local-Life-Better-Eligibility-and-Guidance-2021.pdf', 'application/pdf', 'public', 'public', 263248, '[]', '[]', '[]', '[]', 40, '2021-06-18 15:24:34', '2021-06-18 15:24:34'),
(45, 'App\\Models\\Grant', 65, '75fb1a1e-bc00-4bfd-a035-c87ac53cd45d', 'default', 'AfpvGuHC7HT1cGzGtGboxHI5iwRDE3-metaQXNzdXJhLUNGR1BDLUJyb2NodXJlLTIwMjEucGRm-', 'Assura-CFGPC-Brochure-2021.pdf', 'application/pdf', 'public', 'public', 234548, '[]', '[]', '[]', '[]', 41, '2021-06-28 09:33:33', '2021-06-28 09:33:33'),
(46, 'App\\Models\\Grant', 65, '6e73ce85-b469-4fde-abac-d7a48ae8c55b', 'default', 'fBTBsc0fmCM3z7fidXxdw0IBujIbZb-metaQ2FkZSBzdHVkaWVzIGZvciBmYW1pbHkgd29ya2VyIHJvbGUgLnBkZg==-', 'Cade-studies-for-family-worker-role-.pdf', 'application/pdf', 'public', 'public', 101620, '[]', '[]', '[]', '[]', 42, '2021-06-28 09:33:39', '2021-06-28 09:33:39'),
(47, 'App\\Models\\Grant', 65, '04b5671c-6c61-41c7-9b13-fc2705429bc1', 'default', '4MjSljT0XWhqI6fc3pVXgCZMQ7gWWj-metaQXNzdXJhIENvbW11bml0eSBGdW5kIEdyYW50cyBQcm9ncmFtbWUgMjAyMS5kb2N4-', 'Assura-Community-Fund-Grants-Programme-2021.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 298956, '[]', '[]', '[]', '[]', 43, '2021-06-28 09:33:46', '2021-06-28 09:33:46'),
(48, 'App\\Models\\Grant', 66, '2ae9cb67-621b-4787-8d50-d749a1dfcd23', 'default', 'uv0bHywD6i7soXtKMBb3ed9THFFNKe-metaRmFtaWx5IFdvcmtlciBQcm9wb3NhbC5kb2N4-', 'Family-Worker-Proposal.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 265762, '[]', '[]', '[]', '[]', 44, '2021-06-28 11:20:03', '2021-06-28 11:20:03'),
(49, 'App\\Models\\Grant', 66, '54efa303-a311-4ae0-950c-381cea27b62b', 'default', 'cNiSenzHCDwcDmScdy9TeRo2mNYX5g-metaQ292ZXJpbmcgTGV0dGVyLmRvY3g=-', 'Covering-Letter.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 175602, '[]', '[]', '[]', '[]', 45, '2021-06-28 11:20:09', '2021-06-28 11:20:09'),
(50, 'App\\Models\\Grant', 67, 'cd29785a-e72e-4ec7-93b8-ed532519bf2b', 'default', '3M5pXXLHl7gyNiFpxX3XpH5O9yndxe-metaSGVsZW4gSmVhbiBDb3BlIFByb3Bvc2FsLmRvY3g=-', 'Helen-Jean-Cope-Proposal.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 265650, '[]', '[]', '[]', '[]', 46, '2021-06-28 11:33:23', '2021-06-28 11:33:23'),
(51, 'App\\Models\\Grant', 67, '92061516-f3eb-4416-9164-59661aa5fe89', 'default', 'fOELwbhpl7ehdVby97JafgA2D0A0LU-metaQ292ZXJpbmcgTGV0dGVyLmRvY3g=-', 'Covering-Letter.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 175457, '[]', '[]', '[]', '[]', 47, '2021-06-28 11:33:29', '2021-06-28 11:33:29'),
(52, 'App\\Models\\Grant', 68, '0ba727d4-2bea-4564-9eed-12942548f79e', 'default', 'KbelnqQPRo0yWUDM0hllDNL5THBmii-metaVGhlIFdvb2R3YXJkIENoYXJpdGFibGUgVHJ1c3QgQXBwbGljYXRpb24uZG9jeA==-', 'The-Woodward-Charitable-Trust-Application.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 79590, '[]', '[]', '[]', '[]', 48, '2021-06-28 11:47:55', '2021-06-28 11:47:55'),
(53, 'App\\Models\\Grant', 70, 'd0720f07-e7d4-4537-a85f-edacc98a58d0', 'default', 'friCnzkr4WW4Fs8NKeghybZjkXiHj6-metaQ292aWRfRnVuZF9SZXNpbGllbmNlX0FwcGxpY2F0aW9uX0ZBUXMucGRm-', 'Covid_Fund_Resilience_Application_FAQs.pdf', 'application/pdf', 'public', 'public', 416619, '[]', '[]', '[]', '[]', 49, '2021-07-07 10:32:47', '2021-07-07 10:32:47'),
(54, 'App\\Models\\Grant', 70, 'ea8a0573-335c-455a-964c-c8e39a92c1fc', 'default', 'WByoqQbwmqUwVrciVVk9TBwEym1teG-metaQ292aWRfUmVzaWxpZW5jZV8tX0d1aWRhbmNlX05vdGVzLnBkZg==-', 'Covid_Resilience_-_Guidance_Notes.pdf', 'application/pdf', 'public', 'public', 256638, '[]', '[]', '[]', '[]', 50, '2021-07-07 10:32:47', '2021-07-07 10:32:47'),
(55, 'App\\Models\\Grant', 70, 'd78b9d0a-1126-4241-9644-337000741c69', 'default', 'b8vLFeq3gZOE0y8rUbV0ndPx7Fn3SL-metaUXVlc3Rpb25zIGFuZCByZXNwb25zZXMuZG9jeA==-', 'Questions-and-responses.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 15113, '[]', '[]', '[]', '[]', 51, '2021-07-07 10:32:47', '2021-07-07 10:32:47'),
(56, 'App\\Models\\Grant', 74, '15642d6f-0f06-4809-80a4-cb5a60e4e612', 'default', 'kezGAIirBVleCSSN0dTBRoZWMKBcev-metaU3VibWl0IGFuIGFwcGxpY2F0aW9uLmRvY3g=-', 'Submit-an-application.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 20457, '[]', '[]', '[]', '[]', 52, '2021-07-07 20:23:04', '2021-07-07 20:23:04'),
(57, 'App\\Models\\Grant', 75, '6778dd3e-a76f-4525-b7e8-4a546c9b9dba', 'default', 'jplQwbbVgtK8RlQZ2W9H6bi1KqW8ex-metac2hpcmUtY29tbXVuaXR5LWdyYW50cy0yMDIxLTIyLWd1aWRhbmNlLW5vdGVzLnBkZg==-', 'shire-community-grants-2021-22-guidance-notes.pdf', 'application/pdf', 'public', 'public', 252334, '[]', '[]', '[]', '[]', 53, '2021-07-07 20:28:51', '2021-07-07 20:28:51'),
(59, 'App\\Models\\Grant', 75, '4707b32b-60a0-45ae-80ad-3234371be3c2', 'default', 'itfsoeyagJ9Sd67CyX8SdLneJLZGQP-metac2hpcmUtZ3JhbnQtMjAyMS0yMi1hcHBsaWNhdGlvbi1mb3JtLWZpbmFsIChUcmV2J3MgdmVyc2lvbilbNjMyXVs2NjFdLmRvYw==-', 'shire-grant-2021-22-application-form-final-(Trev\'s-version)[632][661].doc', 'application/msword', 'public', 'public', 102912, '[]', '[]', '[]', '[]', 54, '2021-07-07 20:29:09', '2021-07-07 20:29:09'),
(60, 'App\\Models\\Grant', 76, '4a080186-5dcc-47a9-9ab6-357c0f78ce4f', 'default', 'cqetu9f5wi9TG6XvcpQycUoM0IscrB-metaSm9iLWRlc2NyaXB0aW9uIC0gTmV4dCBTdGVwcyBGYWNpbGl0YXRvci5wZGY=-', 'Job-description---Next-Steps-Facilitator.pdf', 'application/pdf', 'public', 'public', 102951, '[]', '[]', '[]', '[]', 55, '2021-07-07 20:36:20', '2021-07-07 20:36:20'),
(61, 'App\\Models\\Grant', 76, 'e1a7b6ab-0ef5-465c-805e-23b4a898e415', 'default', '4EBooLA7jErtjxGBTvFEdsA7MICXru-metaU1ItR3JhbnRzLWd1aWRhbmNlLnBkZg==-', 'SR-Grants-guidance.pdf', 'application/pdf', 'public', 'public', 175356, '[]', '[]', '[]', '[]', 56, '2021-07-07 20:36:26', '2021-07-07 20:36:26'),
(62, 'App\\Models\\Grant', 76, 'f3583a2e-4c46-405f-b7b1-1aeb702fd216', 'default', 'n0Sp0zYoWIhg5hD6BXJrfB6hDrneaZ-metaVFQgU3RyYXRlZ2ljIFJlc291cmNlcyBHcmFudHMgQXBwbGljYXRpb24gRm9ybS5kb2N4-', 'TT-Strategic-Resources-Grants-Application-Form.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 85913, '[]', '[]', '[]', '[]', 57, '2021-07-07 20:36:34', '2021-07-07 20:36:34'),
(63, 'App\\Models\\Grant', 52, '0ad5bfed-0802-4ad6-b359-4a482a0fbcb5', 'default', 'hodt2TpovjZWaHUQTz813nhi4hojJV-metaUGVyc2ltbW9uIEFwcGxpY2F0aW9uIFF1ZXN0aW9ucy5kb2N4-', 'Persimmon-Application-Questions.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 14080, '[]', '[]', '[]', '[]', 58, '2021-07-07 20:57:29', '2021-07-07 20:57:29'),
(64, 'App\\Models\\Grant', 77, '8e057eac-4501-4f66-8360-00dec480b4c4', 'default', 'YtYYgEOevQriPgAD3yQhVz9qPbN6WR-metaTWVudGFsIEhlYWx0aCBHcmFudC5wZGY=-', 'Mental-Health-Grant.pdf', 'application/pdf', 'public', 'public', 183170, '[]', '[]', '[]', '[]', 59, '2021-07-09 16:24:12', '2021-07-09 16:24:12'),
(65, 'App\\Models\\Grant', 78, '996b0a47-1058-40da-a850-308aea7ca5af', 'default', 'Xm5pYY4SweUF9PrGNgbQGM6LxgG0a6-metaVGVzY28gQ29tbXVuaXR5IEdyYW50cyBBcHBsaWNhdGlvbiBGb3JtLmRvY3g=-', 'Tesco-Community-Grants-Application-Form.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'public', 'public', 46071, '[]', '[]', '[]', '[]', 60, '2021-07-24 20:26:38', '2021-07-24 20:26:38'),
(66, 'App\\Models\\Grant', 45, 'f6dc13fb-c1af-4241-9b3f-00b51c27cf17', 'default', 'tjy6Z5HD7jZ0bVbNnNf4JwmGYOJHYf-metaTmV3IExpZmUgQ29tbXVuaXR5IENodXJjaCBTaWduZWQgT1BDQ1s3MDBdLmRvYw==-', 'New-Life-Community-Church-Signed-OPCC[700].doc', 'application/msword', 'public', 'public', 738816, '[]', '[]', '[]', '[]', 61, '2021-08-09 19:45:12', '2021-08-09 19:45:12'),
(67, 'App\\Models\\Grant', 45, '60e00491-cbfe-4273-85f5-02c694618ad0', 'default', 'oQlXZNAjISp7ih57FiplYWBBnFfzOi-metaSW52b2ljZSBJTlYtMDAwMVs3MDRdLnBkZg==-', 'Invoice-INV-0001[704].pdf', 'application/pdf', 'public', 'public', 56311, '[]', '[]', '[]', '[]', 62, '2021-08-09 19:45:18', '2021-08-09 19:45:18'),
(68, 'App\\Models\\Grant', 75, 'ab5d9c10-b10f-483f-bd44-f3ad296f5207', 'default', 'y6JdDuWUVamEDFO3Ck8E4xN3544Ixf-metaU0NHIDIwMjEtMjIgMzExMiBHcmFudCBBcHByb3ZhbCBMZXR0ZXIgWzExNTVdLnBkZg==-', 'SCG-2021-22-3112-Grant-Approval-Letter-[1155].pdf', 'application/pdf', 'public', 'public', 148334, '[]', '[]', '[]', '[]', 63, '2021-08-11 20:09:26', '2021-08-11 20:09:26'),
(69, 'App\\Models\\Grant', 75, '91baca8f-4735-4da0-9078-9ba58d487382', 'default', 'YPQC74jIRzzAQg0XDyzGCWIE2H4hXl-metaQ29weSBvZiBFeHBlbmRpdHVyZSBSZXBvcnQgVGVtcGxhdGUgLSBTQ0cgMjAyMS0yMi54bHN4-', 'Copy-of-Expenditure-Report-Template---SCG-2021-22.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'public', 'public', 18509, '[]', '[]', '[]', '[]', 64, '2021-08-11 20:09:39', '2021-08-11 20:09:39'),
(70, 'App\\Models\\Grant', 75, '23a20be4-7cb6-4afc-8bd4-69b1d5c3085e', 'default', 'slQFkdqs2on3ZqX2G6V0i9bvRSXyhH-metaU0NHIDIwMjEtMjIgR3JhbnQgQ29uZGl0aW9ucyBGb3JtWzExNTRdLnBkZg==-', 'SCG-2021-22-Grant-Conditions-Form[1154].pdf', 'application/pdf', 'public', 'public', 134132, '[]', '[]', '[]', '[]', 65, '2021-08-11 20:14:11', '2021-08-11 20:14:11'),
(71, 'App\\Models\\Grant', 79, 'd2b96c56-29d0-43d7-8485-00e9c35ea29c', 'default', 'j6MTJa0u2xBvSNiN6iND6wWmCtFKJt-metacHJvamVjdF9jb3N0cy54bHN4-', 'project_costs.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'public', 'public', 13096, '[]', '[]', '[]', '[]', 66, '2021-08-25 08:58:35', '2021-08-25 08:58:35'),
(72, 'App\\Models\\Grant', 44, '94cf6a4c-f3c8-424f-a58f-e8ef966cf5f2', 'default', '9XC1u6m5ogAFk5veYxaGoyWruzjpac-metaYW5keS5qcGVn-', 'andy.jpeg', 'image/jpeg', 'public', 'public', 261861, '[]', '[]', '[]', '[]', 67, '2021-08-30 17:12:28', '2021-08-30 17:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_02_20_152305_create_grants_table', 1),
(6, '2021_02_21_162822_create_media_table', 1),
(7, '2021_02_22_210706_create_categories_table', 1),
(8, '2021_02_24_135657_create_subcategories_table', 1),
(9, '2021_02_24_160039_create_spendings_table', 1),
(10, '2021_02_25_103122_create_receivings_table', 1),
(11, '2021_03_17_162126_create_awards_table', 1),
(12, '2021_07_30_071704_create_multimedia_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `multimedia`
--

DROP TABLE IF EXISTS `multimedia`;
CREATE TABLE IF NOT EXISTS `multimedia` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multimedia`
--

INSERT INTO `multimedia` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(10, 'Symfony installed in video.png', 'Final day of ', '2021-09-03 03:02:56', '2021-09-03 03:02:56'),
(11, 'Biv.jpg', 'Finally', '2021-09-03 03:19:29', '2021-09-03 03:20:33'),
(7, 'rasha.jpg', 'sdfdf', '2021-09-02 13:04:50', '2021-09-02 13:04:50'),
(5, 'Kirti 10.jpg', 'dfdsdfs', '2021-09-01 04:54:21', '2021-09-02 04:54:51'),
(6, 'Some test.pdf', 'test image', '2021-09-02 09:20:11', '2021-09-02 09:20:11'),
(8, 'urvashi sharma crime patrol 3.jpg', 'Final try', '2021-09-03 01:08:06', '2021-09-03 01:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('contact@larslommen.com', '$2y$10$mBJFesEJayz0B5Bov9KKdOEpDQQip8UuHXLvmX6Lf6pW/rPOe2Rn.', '2021-04-05 13:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `receivings`
--

DROP TABLE IF EXISTS `receivings`;
CREATE TABLE IF NOT EXISTS `receivings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grant_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `received_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receivings_grant_id_foreign` (`grant_id`),
  KEY `receivings_subcategory_id_foreign` (`subcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receivings`
--

INSERT INTO `receivings` (`id`, `grant_id`, `subcategory_id`, `amount`, `received_at`, `created_at`, `updated_at`) VALUES
(1, 34, 2, 260000, '2021-03-26', '2021-04-01 10:38:43', '2021-04-01 10:38:43'),
(4, 38, 21, 225000, '2020-10-16', '2021-04-01 11:16:06', '2021-04-01 11:16:06'),
(5, 38, 21, 225000, '2021-03-25', '2021-04-01 11:40:59', '2021-04-01 11:40:59'),
(6, 41, 2, 500000, '2020-09-28', '2021-04-02 15:29:11', '2021-04-02 15:29:11'),
(7, 42, 23, 500000, '2020-12-15', '2021-04-02 15:41:42', '2021-04-02 15:41:42'),
(8, 43, 24, 1500000, '2021-03-10', '2021-04-02 15:55:43', '2021-04-02 15:55:43'),
(9, 39, 13, 500000, '2021-03-15', '2021-04-02 15:58:00', '2021-04-02 15:58:00'),
(10, 49, 18, 450000, '2021-04-09', '2021-04-09 15:28:26', '2021-04-09 15:28:26'),
(11, 46, 2, 280000, '2021-04-10', '2021-04-14 12:27:39', '2021-04-14 12:27:39'),
(12, 46, 2, 5000, '2021-04-02', '2021-04-14 17:20:48', '2021-04-14 17:20:48'),
(13, 46, 2, 5000, '2021-04-04', '2021-04-14 17:21:49', '2021-04-14 17:21:49'),
(14, 46, 2, 300, '2021-04-05', '2021-04-14 17:22:52', '2021-04-14 17:22:52'),
(15, 46, 2, 3000, '2021-04-07', '2021-04-14 17:23:22', '2021-04-14 17:23:22'),
(16, 46, 2, 10000, '2021-04-10', '2021-04-14 17:23:57', '2021-04-14 17:23:57'),
(17, 46, 2, 2000, '2021-04-10', '2021-04-14 17:24:32', '2021-04-14 17:24:32'),
(18, 46, 2, 5000, '2021-04-12', '2021-04-14 17:25:27', '2021-04-14 17:25:27'),
(19, 46, 2, 800, '2021-04-12', '2021-04-14 17:26:09', '2021-04-14 17:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `spendings`
--

DROP TABLE IF EXISTS `spendings`;
CREATE TABLE IF NOT EXISTS `spendings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grant_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `evidence_outstanding` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spent_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spendings_grant_id_foreign` (`grant_id`),
  KEY `spendings_subcategory_id_foreign` (`subcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spendings`
--

INSERT INTO `spendings` (`id`, `grant_id`, `subcategory_id`, `amount`, `evidence_outstanding`, `description`, `spent_at`, `created_at`, `updated_at`) VALUES
(3, 38, 21, 225000, 1, 'Paid to CAP', '2020-10-16', '2021-04-01 11:16:34', '2021-04-01 11:43:06'),
(4, 38, 21, 225000, 1, 'Paid to CAP', '2021-04-28', '2021-04-01 11:50:04', '2021-04-01 11:50:04'),
(5, 41, 2, 68668, 0, 'Summer Millage expenses for delivering food parcels', '2020-10-30', '2021-04-02 15:31:09', '2021-04-02 15:31:09'),
(6, 42, 23, 109050, 0, 'Deposit for building', '2021-02-22', '2021-04-02 15:43:23', '2021-04-02 15:43:23'),
(7, 42, 23, 327000, 0, 'Balance paid for new building', '2021-03-12', '2021-04-02 15:44:16', '2021-04-02 15:44:16'),
(8, 39, 13, 125010, 0, 'Few days in Feb & March Invoice from Vicki', '2021-03-30', '2021-04-02 16:00:31', '2021-04-02 16:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategories_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'General', 1, NULL, NULL),
(3, 'Overheads', 1, NULL, NULL),
(6, 'General', 2, NULL, NULL),
(7, 'Overheads', 2, NULL, NULL),
(10, 'General', 3, NULL, NULL),
(13, 'Salaries', 4, NULL, NULL),
(14, 'General', 4, NULL, NULL),
(18, 'Warehouse Salary', 1, '2021-04-01 09:24:45', '2021-04-01 09:24:45'),
(19, 'Manager Salary', 1, '2021-04-01 09:25:03', '2021-04-01 09:25:03'),
(21, 'CAP Fee', 2, '2021-04-01 09:26:26', '2021-04-01 09:26:26'),
(22, 'Manager Salary', 2, '2021-04-01 09:29:20', '2021-04-01 09:29:20'),
(23, 'Capital Items', 1, '2021-04-01 11:32:38', '2021-04-01 11:32:38'),
(24, 'Youth Worker Salary', 5, '2021-04-02 15:52:12', '2021-04-02 15:52:12'),
(25, 'General', 5, '2021-04-02 15:52:29', '2021-04-02 15:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'lars admin', 'admin', 'contact@larslommen.com', NULL, '$2y$10$ZG60tvnXDW2DizATEN.psOqI05r5.jIdcGkNx1R2HDGCtMKH2JsbS', NULL, NULL, 'FiSUev8Ekqq1boK4XO2B1mxCJHOFeHzktuK3U3aAseZDFbnQwWtwEyINLimg', NULL, '2021-04-02 16:04:52'),
(2, 'lars user', 'user', 'lj.lommen@gmail.com', NULL, '$2y$10$fPl6aB3VsdH2flnnQZhbMu9v8j4sa59/.3G44UnTc/sVXXRrAmP7.', NULL, NULL, NULL, NULL, NULL),
(3, 'Katrina', 'admin', 'katrina_g5@yahoo.com', NULL, '$2y$10$xOD0w6QNIREMC457DlT3e.dEsDUk4D/IIwnV/ULp.NqNlSw8fcO8a', NULL, NULL, NULL, '2021-04-01 09:05:43', '2021-04-01 09:05:43'),
(4, 'Trevor Allin', 'admin', 'trevor.nlcc@gmail.com', NULL, '$2y$10$AT4xwTn.Xj/p7w0Dqn5zze8yZQdiLY8WBiEtffna3e2wdQU8T4c0O', NULL, NULL, 'oWiGIl2D0vRRoLMOr0bTEFM5yBiiBnljh2P86nVymTgYQiL37zl2CNVjXAwg', '2021-04-01 09:06:27', '2021-04-02 16:09:09'),
(5, 'NLCC Accounts', 'admin', 'accounts@nlccl.org.uk', NULL, '$2y$10$usEtymvzshmbWUUPU20x7ubRmVXFfJMmH3FHPctYeE3nGgjmO5OkS', NULL, NULL, NULL, '2021-04-02 16:14:15', '2021-04-02 16:14:15'),
(6, 'Jules Ibbitt', 'user', 'jules@loughborougharea.foodbank.org.uk', NULL, '$2y$10$EfRu9ZeupFpTI2rv.JjMBOCFOF81TWaGW.ckxifpEvYnr46wjoi6W', NULL, NULL, 'sb17z97aCG4H8HRRl9UJ1OwO7uiELHUMxqOfqR48J5M71wl0JcWNYvysPOlb', '2021-04-02 16:19:21', '2021-07-13 09:56:41'),
(7, 'Fred Whitesmith', 'admin', 'fred@nlccl.org.uk', NULL, '$2y$10$GVbkazTOxhLL79ZhBZNAJuJuauGjsicrmCG2nAeSLsOTmezhgtNYm', NULL, NULL, '1xDGGK4vc6QKPkeoumu0xrDdskVvLnnkeChABmzPOXOzRBeu07xFu3VRQDlI', '2021-04-02 16:23:02', '2021-04-02 16:23:02'),
(8, 'Vicki Stacey', 'user', 'vicki@nlccl.org.uk', NULL, '$2y$10$Y1xjxtM1b8XiudfsQ.o3GurTtKZlLVTvceZoyLBfGdPqcQ6nVFMv2', NULL, NULL, '37BRElQEyx7PzimITaZz6mIWhZQfnN8uH5WsRio4tWMDYrGfPujGPbWF86AO', '2021-04-02 16:49:21', '2021-06-24 12:52:02'),
(9, 'Nick Harris', 'user', 'theharrisfamily7@icloud.com', NULL, '$2y$10$TBQfG18V4MLmV8Y5H/KnLevNBhAg6Ytv9a0htgJqyKT2NIoqYQ2Vu', NULL, NULL, NULL, '2021-04-13 20:18:38', '2021-05-05 13:36:17'),
(10, 'test', 'admin', 'mzhasan2016@gmail.com', NULL, '$2y$10$bCU9Q2dFD/Ak9RAGdbs80edWshJSqfetBdettSxxyrfavO0JpCi72', NULL, NULL, NULL, '2021-08-31 15:41:52', '2021-08-31 15:41:52');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `awards_grant_id_foreign` FOREIGN KEY (`grant_id`) REFERENCES `grants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `awards_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `receivings`
--
ALTER TABLE `receivings`
  ADD CONSTRAINT `receivings_grant_id_foreign` FOREIGN KEY (`grant_id`) REFERENCES `grants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receivings_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `spendings`
--
ALTER TABLE `spendings`
  ADD CONSTRAINT `spendings_grant_id_foreign` FOREIGN KEY (`grant_id`) REFERENCES `grants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `spendings_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
