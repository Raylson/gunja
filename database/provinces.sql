CREATE TABLE IF NOT EXISTS provinces (
id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(25) UNIQUE NOT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT IGNORE INTO provinces (name)
VALUES
('Province no. 1'),
('Province no. 2'),
('Bagmati Pradesh'),
('Gandaki Pradesh'),
('Province no. 5'),
('Karnali Pradesh'),
('Sudurpashchim Pradesh');