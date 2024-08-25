-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2020 at 12:00 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oceaninf_arogya1`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_india_income`
--

CREATE TABLE `all_india_income` (
  `id` int(11) NOT NULL,
  `transaction` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_credit` tinyint(1) NOT NULL,
  `time` varchar(50) NOT NULL,
  `down` varchar(100) NOT NULL,
  `direct` varchar(10) NOT NULL,
  `group_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `base_plan`
--

CREATE TABLE `base_plan` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `amountpv` varchar(100) NOT NULL,
  `amountbv` varchar(100) NOT NULL,
  `direct` varchar(100) NOT NULL,
  `binari` varchar(100) NOT NULL,
  `type` varchar(11) NOT NULL,
  `bn%` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `base_plan`
--

INSERT INTO `base_plan` (`id`, `name`, `amount`, `amountpv`, `amountbv`, `direct`, `binari`, `type`, `bn%`) VALUES
(1, 'package 1', '1000', '10', '600', '180', '42', 'self', '7'),
(2, 'package 2', '2500', '25', '1500', '450', '127.5', 'self', '8.5'),
(3, 'package 3', '10000', '100', '6000', '1800', '600', 'self', '10'),
(4, 'package 4', '20000', '200', '12000', '3600', '1440', 'self', '12');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(22) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `total_price` varchar(55) NOT NULL,
  `pay_by` varchar(111) NOT NULL,
  `txnid` varchar(111) NOT NULL,
  `total_cv` varchar(55) NOT NULL,
  `total_dp` varchar(55) NOT NULL,
  `delivery_status` varchar(11) NOT NULL,
  `remark` varchar(555) NOT NULL,
  `time` varchar(111) NOT NULL,
  `date` varchar(55) NOT NULL,
  `current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(22) NOT NULL,
  `booking_id` varchar(55) NOT NULL,
  `product_id` varchar(55) NOT NULL,
  `mrp` varchar(55) NOT NULL,
  `cv` varchar(55) NOT NULL,
  `dp` varchar(55) NOT NULL,
  `qty` varchar(55) NOT NULL,
  `totalamount` varchar(55) NOT NULL,
  `total_cv` varchar(55) NOT NULL,
  `total_dp` varchar(55) NOT NULL,
  `time` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(55) NOT NULL,
  `is_cancelled` int(1) NOT NULL DEFAULT '0',
  `canclled_date` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_details_panding`
--

CREATE TABLE `booking_details_panding` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(55) NOT NULL,
  `product_id` varchar(55) NOT NULL,
  `mrp` varchar(55) NOT NULL,
  `cv` varchar(55) NOT NULL,
  `dp` varchar(55) NOT NULL,
  `qty` varchar(55) NOT NULL,
  `totalamount` varchar(55) NOT NULL,
  `total_cv` varchar(55) NOT NULL,
  `total_dp` varchar(55) NOT NULL,
  `time` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(55) NOT NULL,
  `is_cancelled` int(1) NOT NULL DEFAULT '0',
  `canclled_date` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_panding`
--

CREATE TABLE `booking_panding` (
  `id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `total_price` varchar(55) NOT NULL,
  `pay_by` varchar(111) NOT NULL,
  `txnid` varchar(111) NOT NULL,
  `total_cv` varchar(55) NOT NULL,
  `total_dp` varchar(55) NOT NULL,
  `delivery_status` varchar(11) NOT NULL,
  `remark` varchar(555) NOT NULL,
  `time` varchar(111) NOT NULL,
  `date` varchar(55) NOT NULL,
  `current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `catlog`
--

CREATE TABLE `catlog` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `change_wallet`
--

CREATE TABLE `change_wallet` (
  `id` int(11) NOT NULL,
  `topup_old` varchar(20) NOT NULL,
  `topup_new` varchar(20) NOT NULL,
  `wallet_old` varchar(20) NOT NULL,
  `wallet_new` varchar(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `user_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_income`
--

CREATE TABLE `club_income` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `credit_date` varchar(30) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `club` varchar(30) NOT NULL,
  `credit_time` varchar(30) NOT NULL,
  `business` varchar(30) NOT NULL,
  `transaction` varchar(100) NOT NULL,
  `getForm` varchar(100) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `tds` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_plan`
--

CREATE TABLE `club_plan` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `PV` varchar(100) NOT NULL,
  `plan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_plan`
--

INSERT INTO `club_plan` (`id`, `name`, `PV`, `plan`) VALUES
(1, 'STAR', '1000', '1'),
(2, 'SUPERSTAR', '3500', '2'),
(3, 'GOLD', '8500', '3'),
(4, 'SUPERGOLD', '20000', '4'),
(5, 'DIAMOND', '75000', '5'),
(6, 'DOUBLE DIAMOND', '200000', '6'),
(7, 'TRIPLE DIAMOND', '750000', '7'),
(8, 'BLACK DIAMOND', '2500000', '8'),
(9, 'CROWN DIAMOND', '7500000', '9'),
(10, 'ROYAL DIAMOND', '16000000', '10');

-- --------------------------------------------------------

--
-- Table structure for table `club_users`
--

CREATE TABLE `club_users` (
  `id` int(22) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `date` varchar(40) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `direct` varchar(40) NOT NULL,
  `club` varchar(40) NOT NULL,
  `comm` varchar(100) NOT NULL,
  `getForm` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(22) NOT NULL,
  `transaction` varchar(50) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `sponcer_id` varchar(20) NOT NULL,
  `beneficiary` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `date` varchar(40) NOT NULL,
  `level` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_credit` tinyint(1) NOT NULL,
  `type` varchar(30) NOT NULL,
  `wallet_type` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission_repurchase`
--

CREATE TABLE `commission_repurchase` (
  `id` int(22) NOT NULL,
  `transaction` varchar(50) NOT NULL,
  `booking_id` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `sponcer_id` varchar(20) NOT NULL,
  `beneficiary` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `totalcv` varchar(100) NOT NULL,
  `date` varchar(40) NOT NULL,
  `level` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_credit` tinyint(1) NOT NULL,
  `type` varchar(30) NOT NULL,
  `wallet_type` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(22) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `detail` varchar(10000) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `gstNo` varchar(111) NOT NULL,
  `start_from` varchar(30) NOT NULL,
  `pin_amt` varchar(30) NOT NULL,
  `business` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `detail`, `mobile`, `owner`, `image`, `email`, `website`, `gstNo`, `start_from`, `pin_amt`, `business`) VALUES
(1, 'AROGYAM INTERNATIONALS PVT LTD', '569 CHA / 270 PREM NAGAR ALAMBAGH LUCKNOW ', 'Reselling Product', '7235000041', 'vidhaan rao', 'WhatsApp_Image_2019-04-28_at_00_54_21.jpeg', 'info@arogyaminternationals.com', 'www.arogyaminternationals.com', '09AASCA1089N1ZW', '2017-08-01', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(22) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `direct_comm`
--

CREATE TABLE `direct_comm` (
  `id` int(11) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `sponcer_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `beneficiary` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `transaction` varchar(100) NOT NULL,
  `create_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `time` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT '',
  `is_credit` varchar(100) NOT NULL DEFAULT '',
  `credited` varchar(20) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tds` varchar(100) NOT NULL,
  `admin` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(22) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_entry`
--

CREATE TABLE `expense_entry` (
  `id` int(22) NOT NULL,
  `expense_category` varchar(100) NOT NULL,
  `branch_id` int(30) NOT NULL,
  `entry_date` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `india_income`
--

CREATE TABLE `india_income` (
  `id` int(22) NOT NULL,
  `transaction` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `level` mediumint(2) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `token` int(10) NOT NULL,
  `direct` mediumint(2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `down` varchar(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_credit` tinyint(1) NOT NULL,
  `credited` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(22) NOT NULL,
  `level` varchar(100) NOT NULL,
  `bonus` varchar(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `team` varchar(20) NOT NULL,
  `direct` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level_repurchase`
--

CREATE TABLE `level_repurchase` (
  `id` int(22) NOT NULL,
  `level` varchar(100) NOT NULL,
  `bonus` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_repurchase`
--

INSERT INTO `level_repurchase` (`id`, `level`, `bonus`, `status`) VALUES
(1, '1', '20', '1000'),
(2, '2', '5', '3500'),
(3, '3', '5', '8500'),
(4, '4', '5', '75000');

-- --------------------------------------------------------

--
-- Table structure for table `level_statics`
--

CREATE TABLE `level_statics` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `club` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `created` datetime(6) NOT NULL,
  `lefta` varchar(100) NOT NULL,
  `righta` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_club`
--

CREATE TABLE `manage_club` (
  `id` int(11) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `amount` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monthly_income`
--

CREATE TABLE `monthly_income` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `credit_date` datetime(6) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `club` varchar(30) NOT NULL,
  `credit_time` varchar(30) NOT NULL,
  `business` varchar(30) NOT NULL,
  `transaction` varchar(100) NOT NULL,
  `getForm` varchar(100) NOT NULL,
  `netamt` varchar(100) NOT NULL DEFAULT '0',
  `monthb` varchar(100) NOT NULL DEFAULT '0',
  `admin` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tds` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monthly_users`
--

CREATE TABLE `monthly_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `date` varchar(40) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `direct` varchar(40) NOT NULL,
  `club` varchar(40) NOT NULL,
  `comm` varchar(100) NOT NULL,
  `getForm` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(22) NOT NULL,
  `date` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pairmaching`
--

CREATE TABLE `pairmaching` (
  `id` int(22) NOT NULL,
  `carryLft` varchar(100) NOT NULL,
  `rightAmt` varchar(100) NOT NULL,
  `leftAmt` varchar(100) NOT NULL,
  `pairAmt` varchar(100) NOT NULL,
  `extraAmtRight` varchar(100) NOT NULL,
  `extraAmtLeft` varchar(100) NOT NULL,
  `paidAmt` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  `currentPairMach` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL DEFAULT '0',
  `admin` varchar(100) NOT NULL,
  `tds` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pin`
--

CREATE TABLE `pin` (
  `id` int(22) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `gen_date` varchar(50) NOT NULL,
  `gen_time` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `req_id` varchar(10) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `activated_account` varchar(50) NOT NULL,
  `generate_by` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `is_transfer` varchar(20) NOT NULL,
  `receiver_id` varchar(20) NOT NULL,
  `transfer_date` varchar(40) NOT NULL,
  `transfer_time` varchar(40) NOT NULL,
  `transfer_quantity` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pin_request`
--

CREATE TABLE `pin_request` (
  `id` int(22) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `payment_detail` varchar(500) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `req_date` varchar(50) NOT NULL,
  `req_time` varchar(100) NOT NULL,
  `pin` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `gen_date` varchar(100) NOT NULL,
  `gen_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pin_transfer`
--

CREATE TABLE `pin_transfer` (
  `id` int(22) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `receiver_id` varchar(30) NOT NULL,
  `pin` varchar(30) NOT NULL,
  `quantity` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(22) NOT NULL,
  `name` varchar(111) NOT NULL,
  `cat_id` varchar(55) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `date` varchar(55) NOT NULL,
  `image` varchar(111) NOT NULL,
  `mrp` varchar(11) NOT NULL,
  `dp` varchar(11) NOT NULL,
  `cv` varchar(11) NOT NULL,
  `batch_no` varchar(111) NOT NULL,
  `qty` int(111) NOT NULL DEFAULT '0',
  `exp_date` varchar(111) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(22) NOT NULL,
  `name` varchar(55) NOT NULL,
  `img` varchar(555) NOT NULL,
  `date` varchar(55) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_parchase`
--

CREATE TABLE `product_parchase` (
  `id` int(22) NOT NULL,
  `supplier_id` varchar(111) NOT NULL,
  `invoiceno` varchar(100) NOT NULL,
  `product_id` varchar(111) NOT NULL,
  `product_price` int(11) NOT NULL,
  `batch_no` varchar(111) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_hsn` varchar(111) NOT NULL,
  `date` varchar(111) NOT NULL,
  `total_price` varchar(111) NOT NULL,
  `current` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_igst` varchar(111) NOT NULL,
  `product_sgst` varchar(111) NOT NULL,
  `product_cgst` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(22) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `time` varchar(50) NOT NULL,
  `sender` varchar(30) NOT NULL,
  `receiver_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `query_id` varchar(20) NOT NULL,
  `reply_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `id` int(22) NOT NULL,
  `transaction` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `get_from` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `date` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_credit` tinyint(1) NOT NULL,
  `time` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(22) NOT NULL,
  `query_id` varchar(20) NOT NULL,
  `receiver_id` varchar(20) NOT NULL,
  `reply_message` varchar(1000) NOT NULL,
  `reply_time` varchar(50) NOT NULL,
  `reply_date` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `repurchage_users`
--

CREATE TABLE `repurchage_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `bv` varchar(100) NOT NULL,
  `binari` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `updated_date` date NOT NULL,
  `place` varchar(100) NOT NULL,
  `pv` varchar(100) NOT NULL,
  `booking_id` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `club` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `self_upgrade`
--

CREATE TABLE `self_upgrade` (
  `id` int(11) NOT NULL,
  `plan_id` varchar(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `date` varchar(40) NOT NULL,
  `upgrade_date` varchar(20) NOT NULL,
  `time` varchar(40) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `pendng` int(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) NOT NULL,
  `old_pakg` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(20) NOT NULL,
  `supplier_id` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `reg_date` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `licence_no` varchar(111) NOT NULL,
  `gst_no` varchar(111) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `account_name` varchar(111) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `reg_time` varchar(100) NOT NULL,
  `pan` varchar(30) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `active_time` varchar(50) NOT NULL,
  `active_date` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TABLE 43`
--

CREATE TABLE `TABLE 43` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `access` varchar(9) DEFAULT NULL,
  `sponcer_id` varchar(10) DEFAULT NULL,
  `parent` varchar(10) DEFAULT NULL,
  `product` varchar(1) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `reg_date` varchar(10) DEFAULT NULL,
  `email` varchar(22) DEFAULT NULL,
  `address` varchar(41) DEFAULT NULL,
  `paytm` varchar(10) DEFAULT NULL,
  `account_number` varchar(10) DEFAULT NULL,
  `bank_name` varchar(10) DEFAULT NULL,
  `branch_name` varchar(10) DEFAULT NULL,
  `ifsc` varchar(10) DEFAULT NULL,
  `nomini_name` varchar(10) DEFAULT NULL,
  `nomini_rel` varchar(10) DEFAULT NULL,
  `nomini_dob` varchar(10) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `pin` varchar(14) DEFAULT NULL,
  `image` varchar(8) DEFAULT NULL,
  `wallet` varchar(10) DEFAULT NULL,
  `topup` varchar(10) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `fname` varchar(9) DEFAULT NULL,
  `reg_time` varchar(8) DEFAULT NULL,
  `pan` varchar(10) DEFAULT NULL,
  `block` varchar(1) DEFAULT NULL,
  `active_time` varchar(1) DEFAULT NULL,
  `active_date` varchar(8) DEFAULT NULL,
  `is_delete` varchar(10) DEFAULT NULL,
  `created` varchar(16) DEFAULT NULL,
  `activated` varchar(16) DEFAULT NULL,
  `place` varchar(10) DEFAULT NULL,
  `place_id` varchar(10) DEFAULT NULL,
  `updated` varchar(16) DEFAULT NULL,
  `nomini_mob` varchar(10) DEFAULT NULL,
  `cv` varchar(100) DEFAULT NULL,
  `re_cv` varchar(1) DEFAULT NULL,
  `statusMatch` varchar(1) DEFAULT NULL,
  `position` varchar(10) DEFAULT NULL,
  `pv` varchar(100) DEFAULT NULL,
  `kyc` varchar(1) DEFAULT NULL,
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `image3` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `TABLE 45`
--

CREATE TABLE `TABLE 45` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `name` varchar(35) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `access` varchar(40) DEFAULT NULL,
  `sponcer_id` varchar(50) DEFAULT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `product` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `reg_date` varchar(10) DEFAULT NULL,
  `email` varchar(22) DEFAULT NULL,
  `address` varchar(41) DEFAULT NULL,
  `paytm` varchar(10) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `bank_name` varchar(10) DEFAULT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `ifsc` varchar(20) DEFAULT NULL,
  `nomini_name` varchar(20) DEFAULT NULL,
  `nomini_rel` varchar(20) DEFAULT NULL,
  `nomini_dob` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `wallet` varchar(1000) DEFAULT NULL,
  `topup` varchar(40) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `reg_time` varchar(100) DEFAULT NULL,
  `pan` varchar(50) DEFAULT NULL,
  `block` int(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT NULL,
  `active_time` varchar(50) DEFAULT NULL,
  `active_date` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `activated` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `place_id` varchar(40) DEFAULT NULL,
  `updated` timestamp(6) NULL DEFAULT NULL,
  `nomini_mob` varchar(40) DEFAULT NULL,
  `cv` varchar(1000) DEFAULT NULL,
  `re_cv` varchar(50) DEFAULT NULL,
  `statusMatch` int(1) DEFAULT '0',
  `position` varchar(100) DEFAULT NULL,
  `pv` varchar(50) DEFAULT NULL,
  `kyc` int(1) DEFAULT '0',
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `image3` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tds`
--

CREATE TABLE `tds` (
  `id` int(10) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `tds_percent` varchar(30) NOT NULL,
  `amount` varchar(40) NOT NULL,
  `tds` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `reward_type` varchar(100) NOT NULL,
  `admin_percent` varchar(100) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `transaction` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `is_credit` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upgrade_comm`
--

CREATE TABLE `upgrade_comm` (
  `id` int(11) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `sponcer_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `beneficiary` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `transaction` varchar(100) NOT NULL,
  `create_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `time` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT '',
  `is_credit` varchar(100) NOT NULL DEFAULT '',
  `credited` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `name` varchar(35) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `access` varchar(40) DEFAULT NULL,
  `sponcer_id` varchar(50) DEFAULT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `product` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `reg_date` varchar(10) DEFAULT NULL,
  `email` varchar(22) DEFAULT NULL,
  `address` varchar(41) DEFAULT NULL,
  `paytm` varchar(10) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `bank_name` varchar(10) DEFAULT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `ifsc` varchar(20) DEFAULT NULL,
  `nomini_name` varchar(20) DEFAULT NULL,
  `nomini_rel` varchar(20) DEFAULT NULL,
  `nomini_dob` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `wallet` int(100) DEFAULT '0',
  `topup` varchar(40) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `reg_time` varchar(100) DEFAULT NULL,
  `pan` varchar(50) DEFAULT NULL,
  `block` int(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT NULL,
  `active_time` varchar(50) DEFAULT NULL,
  `active_date` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `activated` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `place_id` varchar(40) DEFAULT NULL,
  `updated` timestamp(6) NULL DEFAULT NULL,
  `nomini_mob` varchar(40) DEFAULT NULL,
  `cv` varchar(1000) DEFAULT NULL,
  `re_cv` varchar(50) DEFAULT NULL,
  `statusMatch` int(1) DEFAULT '0',
  `position` varchar(100) DEFAULT NULL,
  `pv` varchar(50) DEFAULT NULL,
  `kyc` int(1) DEFAULT '0',
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `image3` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `password`, `access`, `sponcer_id`, `parent`, `product`, `mobile`, `reg_date`, `email`, `address`, `paytm`, `account_number`, `bank_name`, `branch_name`, `ifsc`, `nomini_name`, `nomini_rel`, `nomini_dob`, `status`, `pin`, `image`, `wallet`, `topup`, `dob`, `fname`, `reg_time`, `pan`, `block`, `is_delete`, `active_time`, `active_date`, `created`, `activated`, `place`, `place_id`, `updated`, `nomini_mob`, `cv`, `re_cv`, `statusMatch`, `position`, `pv`, `kyc`, `image1`, `image2`, `image3`) VALUES
(1, '990091001', 'Admin', '123456', 'universal', 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(13, '990091007', 'app', '456123', 'limited', '990091002', '990091006', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '01-12-1973', 'app', '16:55:56', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(12, '990091006', 'app', '456123', 'limited', '990091002', '990091005', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '01-12-1973', 'app', '16:54:42', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(11, '990091005', 'app', '123456', 'limited', '990091004', '990091004', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '23-10-2019', 'app', '16:44:07', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(10, '990091004', 'app', '789456', 'limited', '990091001', '990091003', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '30-09-2019', 'app', '16:43:13', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(9, '990091003', 'app', '123456', 'limited', '990091001', '990091002', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '01-12-1973', 'app', '16:42:12', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(8, '990091002', 'app', '789456', 'limited', '990091001', '990091001', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '30-09-2019', 'app', '16:40:33', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(14, '990091008', 'app', '456123', 'limited', '990091002', '990091007', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '18-09-2000', 'app', '16:58:06', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(15, '990091009', 'app', '456123', 'limited', '990091002', '990091008', '1', '0723500004', '2020-02-12', '', 'bar', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '18-09-2000', 'app', '16:58:50', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(16, '990091010', 'KAMALKESH', '123456', 'limited', '990091002', '990091009', '1', '0730949626', '2020-02-13', '', 'VILL-BHADAURA TALUKA NAINIJOR POST-DEVARA', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '03-10-2019', 'KAMALKESH', '09:49:29', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(17, '990091011', 'AJAY KUMAR', '123456', 'limited', '990091002', '990091002', '2', '0900532615', '2020-02-13', '', 'VILL- MAJURI POST - NEWADA (SHIVPUR) HATA', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '25-12-2019', 'AJAY', '09:50:15', '', 0, NULL, NULL, NULL, NULL, NULL, 'Right', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(18, '990091012', 'zsdfsxc', '123456', 'limited', '990091001', '990091001', '2', '68456465', '2020-02-13', '', '', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '19-02-2020', 'xzcv', '10:28:04', '', 0, NULL, NULL, NULL, NULL, NULL, 'Right', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(19, '990091013', 'xzcvcx', '123456', 'limited', '990091012', '990091012', '2', '9456342535', '2020-02-13', '', '', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '11-02-2020', 'xczv', '11:47:25', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(20, '990091014', 'ZCX', '123456', 'limited', '990091003', '990091003', '3', '65463131', '2020-02-13', '', '', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '18-02-2020', 'xzc', '12:20:38', '', 0, NULL, NULL, NULL, NULL, NULL, 'Right', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(21, '990091015', 'dcfgvxz', '123456', 'limited', '990091012', '990091012', '2', '63532322', '2020-02-13', '', '', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '05-02-2020', 'xcvz', '12:33:50', '', 0, NULL, NULL, NULL, NULL, NULL, 'Right', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', ''),
(22, '990091016', 'SAU C', '123456', 'limited', '990091001', '990091010', '1', '8604069110', '2020-06-24', 'gyanesh.owspl@gmail.co', 'LKO', '', '', '', '', '', '', '', '', 0, NULL, 'blue.png', 0, NULL, '02-08-1989', 'stgbvw', '12:40:48', '', 0, NULL, NULL, NULL, NULL, NULL, 'Left', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(10) NOT NULL,
  `transaction` varchar(50) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `date` varchar(40) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `paid_date` varchar(50) NOT NULL,
  `paid_time` varchar(50) NOT NULL,
  `trnx_num` varchar(50) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `working_plan`
--

CREATE TABLE `working_plan` (
  `id` int(11) NOT NULL,
  `lvl` varchar(250) NOT NULL,
  `team` varchar(250) NOT NULL,
  `income_in_ptcntg` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `income_rs` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `working_plan`
--

INSERT INTO `working_plan` (`id`, `lvl`, `team`, `income_in_ptcntg`, `value`, `income_rs`) VALUES
(1, '1', '8', '8', '12000', '960'),
(2, '2', '64', '5', '96000', '4800'),
(3, '3', '512', '3', '768000', '23040'),
(4, '4', '4096', '2', '6144000', '122880'),
(5, '5', '32768', '2', '49152000', '983040'),
(6, '6', '262144', '2', '393216000', '7864320'),
(7, '7', '2097152', '2', '3145728000', '6  Cr'),
(8, '8', '16777216', '2', '25165824000', '50 Cr'),
(9, '9', '134217728', '1', '201326592000', '402 Cr'),
(10, '10', '1073741824', '1', '1610612736000', '1610 Cr'),
(12, '11', '8589934592', '1', '12884901888000', '1288 Cr'),
(13, '12', '68719476736', '1', '103079215104000', '10307 Cr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_india_income`
--
ALTER TABLE `all_india_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_plan`
--
ALTER TABLE `base_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details_panding`
--
ALTER TABLE `booking_details_panding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_panding`
--
ALTER TABLE `booking_panding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catlog`
--
ALTER TABLE `catlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `change_wallet`
--
ALTER TABLE `change_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_income`
--
ALTER TABLE `club_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_plan`
--
ALTER TABLE `club_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_users`
--
ALTER TABLE `club_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_repurchase`
--
ALTER TABLE `commission_repurchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `direct_comm`
--
ALTER TABLE `direct_comm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_entry`
--
ALTER TABLE `expense_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `india_income`
--
ALTER TABLE `india_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_repurchase`
--
ALTER TABLE `level_repurchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_statics`
--
ALTER TABLE `level_statics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_club`
--
ALTER TABLE `manage_club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_income`
--
ALTER TABLE `monthly_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_users`
--
ALTER TABLE `monthly_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pairmaching`
--
ALTER TABLE `pairmaching`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin_request`
--
ALTER TABLE `pin_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin_transfer`
--
ALTER TABLE `pin_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_parchase`
--
ALTER TABLE `product_parchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repurchage_users`
--
ALTER TABLE `repurchage_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `self_upgrade`
--
ALTER TABLE `self_upgrade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TABLE 43`
--
ALTER TABLE `TABLE 43`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TABLE 45`
--
ALTER TABLE `TABLE 45`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tds`
--
ALTER TABLE `tds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upgrade_comm`
--
ALTER TABLE `upgrade_comm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_plan`
--
ALTER TABLE `working_plan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_india_income`
--
ALTER TABLE `all_india_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base_plan`
--
ALTER TABLE `base_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_details_panding`
--
ALTER TABLE `booking_details_panding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_panding`
--
ALTER TABLE `booking_panding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catlog`
--
ALTER TABLE `catlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `change_wallet`
--
ALTER TABLE `change_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_income`
--
ALTER TABLE `club_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_plan`
--
ALTER TABLE `club_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `club_users`
--
ALTER TABLE `club_users`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission_repurchase`
--
ALTER TABLE `commission_repurchase`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `direct_comm`
--
ALTER TABLE `direct_comm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_entry`
--
ALTER TABLE `expense_entry`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `india_income`
--
ALTER TABLE `india_income`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level_repurchase`
--
ALTER TABLE `level_repurchase`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `level_statics`
--
ALTER TABLE `level_statics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_club`
--
ALTER TABLE `manage_club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monthly_income`
--
ALTER TABLE `monthly_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monthly_users`
--
ALTER TABLE `monthly_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pairmaching`
--
ALTER TABLE `pairmaching`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pin`
--
ALTER TABLE `pin`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pin_request`
--
ALTER TABLE `pin_request`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pin_transfer`
--
ALTER TABLE `pin_transfer`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_parchase`
--
ALTER TABLE `product_parchase`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repurchage_users`
--
ALTER TABLE `repurchage_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `self_upgrade`
--
ALTER TABLE `self_upgrade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TABLE 43`
--
ALTER TABLE `TABLE 43`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TABLE 45`
--
ALTER TABLE `TABLE 45`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tds`
--
ALTER TABLE `tds`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upgrade_comm`
--
ALTER TABLE `upgrade_comm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_plan`
--
ALTER TABLE `working_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
