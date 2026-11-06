CREATE TABLE IF NOT EXISTS `world_entities` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(40) NOT NULL,
    `name` VARCHAR(160) NOT NULL,
    `description` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
