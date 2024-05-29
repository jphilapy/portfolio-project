--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
    `id`         int(11)      NOT NULL,
    `username`   varchar(50)  NOT NULL,
    `email`      varchar(100) NOT NULL,
    `password`   varchar(255) NOT NULL,
    `is_active`  tinyint(1)        DEFAULT '0',
    `access_token` json DEFAULT NULL,
    `refresh_token` text DEFAULT NULL,
    `created_at` timestamp    NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;
