CREATE DATABASE IF NOT EXISTS genshin_tp;
USE genshin_tp;


DROP TABLE IF EXISTS COLLECTION;
DROP TABLE IF EXISTS PERSONNAGE;
DROP TABLE IF EXISTS ELEMENT;
DROP TABLE IF EXISTS UNITCLASS;
DROP TABLE IF EXISTS ORIGIN;
DROP TABLE IF EXISTS USERS;



CREATE TABLE ELEMENT (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE ORIGIN (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE UNITCLASS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    url_img VARCHAR(255)
) ENGINE=InnoDB;


CREATE TABLE USERS (
    id VARCHAR(100) PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    hash_pwd VARCHAR(255) NOT NULL
)ENGINE=InnoDB;



CREATE TABLE PERSONNAGE (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    element INT NOT NULL,
    unitclass INT NOT NULL,
    origin INT NOT NULL,
    rarity INT NOT NULL,
    url_img VARCHAR(255) NOT NULL,
    FOREIGN KEY (element) REFERENCES ELEMENT(id),
    FOREIGN KEY (unitclass) REFERENCES UNITCLASS(id),
    FOREIGN KEY (origin) REFERENCES ORIGIN(id)
) ENGINE=InnoDB;



CREATE TABLE COLLECTION (
    user_id VARCHAR(100),    
    personnage_id VARCHAR(255),
    PRIMARY KEY (user_id, personnage_id),
    FOREIGN KEY (user_id) REFERENCES USERS(id) ON DELETE CASCADE,
    FOREIGN KEY (personnage_id) REFERENCES PERSONNAGE(id) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO USERS (id, username, hash_pwd)
VALUES ('69240706c7fc3', 'admin', '$2y$10$5xms6Cp3LAUHvm85CX3upe.evXtxft1tXf8fbs2SF3FVjNKIr9m.K');


INSERT INTO ELEMENT (name, url_img) VALUES
('Pyro',   'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Pyro.png?strip=all&quality=100&w=16'),
('Hydro',  'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Hydro.png?strip=all&quality=100&w=16'),
('Electro','https://i2.wp.com/images.genshin-builds.com/genshin/elements/Electro.png?strip=all&quality=100&w=16'),
('Cryo',   'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Cryo.png?strip=all&quality=100&w=16'),
('Geo',    'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Geo.png?strip=all&quality=100&w=16'),
('Anemo',  'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Anemo.png?strip=all&quality=100&w=16'),
('Dendro', 'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Dendro.png?strip=all&quality=100&w=16');



INSERT INTO UNITCLASS (name, url_img) VALUES
('Sword',    'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Sword.png?strip=all&quality=100&w=16'),
('Claymore', 'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Claymore.png?strip=all&quality=100&w=16'),
('Polearm',  'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Polearm.png?strip=all&quality=100&w=16'),
('Bow',      'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Bow.png?strip=all&quality=100&w=16'),
('Catalyst', 'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Catalyst.png?strip=all&quality=100&w=16');


INSERT INTO ORIGIN (id, name, url_img) VALUES
(1, 'Mondstadt',  'https://i2.wp.com/images.genshin-builds.com/genshin/nations/Mondstadt.png?strip=all&quality=100&w=16'),
(2, 'Liyue',      'https://i2.wp.com/images.genshin-builds.com/genshin/nations/Liyue.png?strip=all&quality=100&w=16'),
(3, 'Inazuma',    'https://i2.wp.com/images.genshin-builds.com/genshin/nations/Inazuma.png?strip=all&quality=100&w=16'),
(4, 'Sumeru',     'https://i2.wp.com/images.genshin-builds.com/genshin/nations/Sumeru.png?strip=all&quality=100&w=16'),
(5, 'Fontaine',   'https://i2.wp.com/images.genshin-builds.com/genshin/nations/Fontaine.png?strip=all&quality=100&w=16'),
(6, 'Natlan',     'https://i2.wp.com/images.genshin-builds.com/genshin/nations/Natlan.png?strip=all&quality=100&w=16'),
(7, 'Khaenri\'ah','https://i2.wp.com/images.genshin-builds.com/genshin/nations/Khaenriah.png?strip=all&quality=100&w=16');


INSERT INTO ORIGIN (id, name, url_img) VALUES
(1, 'Mondstadt',  'https://static.wikia.nocookie.net/gensin-impact/images/a/a2/Mondstadt_Emblem.png'),
(2, 'Liyue',      'https://static.wikia.nocookie.net/gensin-impact/images/4/47/Liyue_Emblem.png'),
(3, 'Inazuma',    'https://static.wikia.nocookie.net/gensin-impact/images/d/dd/Inazuma_Emblem.png'),
(4, 'Sumeru',     'https://static.wikia.nocookie.net/gensin-impact/images/a/ab/Sumeru_Emblem.png'),
(5, 'Fontaine',   'https://static.wikia.nocookie.net/gensin-impact/images/a/ae/Fontaine_Emblem.png'),
(6, 'Natlan',     'https://static.wikia.nocookie.net/gensin-impact/images/b/b3/Natlan_Emblem.png'),
(7, 'Khaenri\'ah', 'https://static.wikia.nocookie.net/gensin-impact/images/9/91/Khaenri%27ah_Emblem.png');

INSERT INTO PERSONNAGE (id, name, element, unitclass, origin, rarity, url_img) VALUES
('diluc',       'Diluc',            1, 2, 1, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/diluc/image.png?strip=all&quality=100&w=512'),
('kaeya',       'Kaeya',            4, 1, 1, 4, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/kaeya/image.png?strip=all&quality=100&w=512'),
('hu_tao',      'Hu Tao',           1, 3, 2, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/hu_tao/image.png?strip=all&quality=100&w=512'),
('xiao',        'Xiao',             6, 3, 2, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/xiao/image.png?strip=all&quality=100&w=512'),
('yae_miko',    'Yae Miko',         3, 5, 3, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/yae_miko/image.png?strip=all&quality=100&w=512'),
('zhongli',     'Zhongli',          5, 3, 2, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/zhongli/image.png?strip=all&quality=100&w=512'),
('raiden',      'Raiden Shogun',    3, 3, 3, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/raiden_shogun/image.png?strip=all&quality=100&w=512'),
('nahida',      'Nahida',           7, 5, 4, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/nahida/image.png?strip=all&quality=100&w=512'),
('furina',      'Furina',           2, 1, 5, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/furina/image.png?strip=all&quality=100&w=512'),
('neuvillette', 'Neuvillette',      2, 5, 5, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/neuvillette/image.png?strip=all&quality=100&w=512'),
('navia',       'Navia',            5, 2, 5, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/navia/image.png?strip=all&quality=100&w=512'),
('alhaitham',   'Alhaitham',        7, 1, 4, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/alhaitham/image.png?strip=all&quality=100&w=512'),
('ayaka',       'Kamisato Ayaka',   4, 1, 3, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/kamisato_ayaka/image.png?strip=all&quality=100&w=512'),
('ganyu',       'Ganyu',            4, 4, 2, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/ganyu/image.png?strip=all&quality=100&w=512'),
('keqing',      'Keqing',           3, 1, 2, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/keqing/image.png?strip=all&quality=100&w=512'),
('venti',       'Venti',            6, 4, 1, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/venti/image.png?strip=all&quality=100&w=512'),
('bennett',     'Bennett',          1, 1, 1, 4, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/bennett/image.png?strip=all&quality=100&w=512'),
('xingqiu',     'Xingqiu',          2, 1, 2, 4, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/xingqiu/image.png?strip=all&quality=100&w=512'),
('xiangling',   'Xiangling',        1, 3, 2, 4, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/xiangling/image.png?strip=all&quality=100&w=512'),
('wanderer',    'Wanderer',         6, 5, 4, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/wanderer/image.png?strip=all&quality=100&w=512');



INSERT INTO COLLECTION (user_id, personnage_id) VALUES
('69240706c7fc3', 'diluc'),
('69240706c7fc3', 'hu_tao');





