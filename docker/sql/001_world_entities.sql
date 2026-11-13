CREATE TABLE IF NOT EXISTS `world_entities` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(40) NOT NULL,
    `name` VARCHAR(160) NOT NULL,
    `description` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `world_notes` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `worldEntityId` INT UNSIGNED NOT NULL,
    `title` VARCHAR(160) NOT NULL,
    `content` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_world_notes_world_entity` (`worldEntityId`),
    CONSTRAINT `fk_world_notes_world_entity`
        FOREIGN KEY (`worldEntityId`) REFERENCES `world_entities` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
