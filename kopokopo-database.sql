CREATE TABLE IF NOT EXISTS `kopokopo_transactions` (
  `id` varchar(3) CHARACTER SET utf8 NOT NULL,
  `paysys` varchar(255) CHARACTER SET utf8 NOT NULL,
  `account_number` varchar(255) CHARACTER SET utf8 NULL,
  `amount` int(11) CHARACTER SET utf8 NOT NULL,
  `balance` int(11) CHARACTER SET utf8 NULL,
  `business_number` int(11) CHARACTER SET utf8 NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `internal_transaction_id` int(11) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8 NULL,
  `sender_phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `service_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `signature` varchar(255) CHARACTER SET utf8 NOT NULL,
  `transaction_reference` varchar(255) CHARACTER SET utf8 NOT NULL,
  `transaction_timestamp` varchar(50) CHARACTER SET utf8 NOT NULL,
  `transaction_type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kopokopo_transactions` (`paysys`, `account_number`, `amount`, `balance`, `business_number`, `currency`, `first_name`, `internal_transaction_id`, `last_name`, `middle_name`, `sender_phone`, `service_name`, `signature`, `transaction_reference`, `transaction_timestamp`, `transaction_type`, `username`, `created_at`) VALUES
('kopokopo', '', 20, 0, 896330, 'KSh', 'Justus', 11898813, 'Musili', '', '+254722000001', 'M-PESA', 'MzOvYZICcmPgt69Hckq/IIf+F2w=', 'KL95GY3X4P', '2016-12-09T15:06:30Z', 'buygoods', 'Asuredbet', '2017-10-09 07:29:13');

CREATE TABLE IF NOT EXISTS `kopokopo_subscriptions` (
  `id` int(11) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) CHARACTER SET utf8 NOT NULL,
  `start_at` timestamp CHARACTER SET utf8 NOT NULL,
  `end_at` timestamp CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kopokopo_subscriptions` (`user_id`, `start_at`, `end_at`) VALUES
('1', '2017-10-09 07:29:13', '2017-11-08 07:29:13');