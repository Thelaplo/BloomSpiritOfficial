-- Création de la base de données
DROP DATABASE IF EXISTS gestion_excursions;
CREATE DATABASE IF NOT EXISTS gestion_excursions;
USE gestion_excursions;

-- Table Categorie
CREATE TABLE if not exists Categorie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lib VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Table TypeTransport
CREATE TABLE if not exists TypeTransport (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Table TypeLieu
CREATE TABLE if not exists TypeLieu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lib VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Table Hebergement
CREATE TABLE if not exists Hebergement (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    type VARCHAR(50),
    etoiles INT CHECK (etoiles BETWEEN 0 AND 5),
    rue VARCHAR(255),
    image VARCHAR(255),
    cp VARCHAR(10),
    ville VARCHAR(100),
    capacite INT
) ENGINE=InnoDB;

-- Table Excursion
CREATE TABLE if not exists Excursion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    commentaire TEXT,
    difficulte VARCHAR(20),
    nbLimitPers INT,
    prix DECIMAL(10, 2),
    idCat INT NOT NULL,
    FOREIGN KEY (idCat) REFERENCES Categorie(id)
) ENGINE=InnoDB;

-- Table Lieu
CREATE TABLE if not exists Lieu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    commentaire TEXT,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    note DECIMAL(3, 2) CHECK (note BETWEEN 0 AND 5),
    image VARCHAR(255),
    idTypeLieu INT NOT NULL,
    FOREIGN KEY (idTypeLieu) REFERENCES TypeLieu(id)
) ENGINE=InnoDB;

-- Table Etape (association entre Excursion, Lieu et Hebergement)
CREATE TABLE if not exists Etape (
    idExcursion INT,
    numOrdre INT,
    commentaire varchar(255),
    dureeEst INT,
    idLieu INT,
    idHebergement INT,
    PRIMARY KEY (idExcursion, numOrdre),
    FOREIGN KEY (idExcursion) REFERENCES Excursion(id),
    FOREIGN KEY (idLieu) REFERENCES Lieu(id),
    FOREIGN KEY (idHebergement) REFERENCES Hebergement(id)
) ENGINE=InnoDB;

-- Table Transporter (association entre TypeTransport et Excursion)
CREATE TABLE if not exists Transporter (
    idTypeTransport INT,
    idExcursion INT,
    PRIMARY KEY (idTypeTransport, idExcursion),
    FOREIGN KEY (idTypeTransport) REFERENCES TypeTransport(id),
    FOREIGN KEY (idExcursion) REFERENCES Excursion(id)
) ENGINE=InnoDB;

-- Insertion de données de test

-- Catégories d'excursions
INSERT INTO Categorie (lib) VALUES
('Détente et Bien-être'),
('Nourriture et oenologie'),
('Culture et Patrimoine'),
('Nature et Vie Sauvage'),
('Sport et Aventure'),
('Famille et Tribu'),
('Randonnée');

-- Types de transport
INSERT INTO TypeTransport (type) VALUES
('Bus'),
('Minibus'),
('Voiture'),
('Train'),
('Bateau');

-- Types de lieux
INSERT INTO TypeLieu (lib) VALUES
('Monument historique'),
('Parc naturel'),
('Musée'),
('Point de vue'),
('Restaurant'),
('Cascade'),
('Plage'),
('Ville'),
('Temple');

-- Hébergements
INSERT INTO Hebergement (nom, type, etoiles, rue, image, cp, ville, capacite) VALUES
-- Le japon sous la neige 
('Daiichi Ryogoku', 'Hôtel', 3, '1 chome-6-1', 'hotel_parc.jpg', '130-0015', 'Tokyo', 334),
('Fuji View ', 'Hôtel', 4, '511 Katsuyama', 'auberge_montagne.jpg', '401-0310', 'Fujikawaguchiko', 100),
('Kambayashi Hotel Senjukaku', 'Hôtel', 4, '1410 Hirao', 'camping_pins.jpg', '381-0401', 'Yamanouchi', 100),
('Daiwa Roynet', 'Hôtel', 4, 'Hirooka, 1-3-37', 'daiwa_photo.png', '920-0031', 'Kanazawa', 100),
('Ryokan Futari Shizuka Hakuun - Takayama', 'Hôtel', 4, 'Horibatamachi', 'ryokan_photo.png', '506-0837', 'Takayama', 100), 
('Daiwa Roynet Hotel Kyoto Hachijoguchi', 'Hôtel', 4, '9-2 Higashikujo Kitakarasumacho', 'Daiwa_Photo.png', '601-8017', 'Minami Ward', 100),

-- Trésors du Japon
-- 7 ->
('Dormy Inn 3* - Kurashiki', 'Hôtel', 3, '3-21-11 Achi', 'Dormy_Inn_3_photo.png', '710-0055', 'Kurashiki', 100),
('Hotel Vista Hiroshima', 'Hôtel', 3, '6-15 Teppocho', 'Vista_Hiroshima_photo.png', '730-0017', 'Hiroshima', 100),
('Okayama City Hotel Kuwatacho', 'Hôtel', 3, '3-30 Kuwadacho', 'Okayama_photo.png', '700-0984', 'Okayama', 100),
('Shukubo Gyokuzo-in', 'Hôtel', 2, '2280 Shigisan', 'Shukubo_photo.png', '636-0923', 'Heguri-chō' , 100), 
('Vessel Hotel Campana Kyoto Gojo', 'Hôtel', 4, '498 Shimomanjujichō', 'Vessel_Campana_Kyoto_Gojo.png', '600-8180', 'Kyoto', 100), 
('Ichinoyu Honkan', 'Hôtel', 3, '90 Tonosawa', 'Ichinoyu_Honkan.png', '250-0315', 'Hakone', 100), 
('Tokyu Rei Kichijoji - Tokyo', 'Hôtel', 3, '1-6-3 Kichijoji Minamicho', 'Tokyo_Rei_Kichijoji_photo.png', '180-0003', 'Musashino', 100), 

-- L\'archipel aux trésors 
-- 14 ->
('Hotel Keihan Tenmabashi', 'Hotel', 3, '1-2-10 Tanimachi', 'Keihan_Photo.png', '540-0012', 'Osaka', 100), 
('Miyajima Seaside Hotel', 'Hotel', 3, '967 Miyajima-chō', 'Keihan_photo.png', '739-0541', 'Hatsukaichi', 100), 
('Urban Hotel Kyoto Shijo Premium', 'Hotel', 4, '272-6 Shijohorikawacho', 'Kyoto_photo.png', '600-8481', 'Kyoto', 100),
('Agora Place Asakusa - Tokyo', 'Hôtel', 3, '2-2-9 Kotobuki', 'AgoraPlace_photo.png', '111-0042', 'Tokyo', 100);

-- Excursions
INSERT INTO Excursion (nom, commentaire, difficulte, nbLimitPers, prix, idCat) VALUES
('Le Japon sous la neige', 'Plongez dans la magie du Japon sous la neige, où temples ancestraux, villages traditionnels et jardins zen se parent d’un manteau blanc. Une escapade hivernale qui révèle la beauté sereine du pays, entre paysages paisibles et traditions chaleureuses.', 
'Facile', 12, 3020, 1),
('Trésors du Japon', 'Partez à la découverte des Trésors du Japon, une excursion captivante qui vous mène au cœur des sites culturels, naturels et historiques les plus emblématiques du pays. Entre temples majestueux, villages traditionnels et paysages enchanteurs, vivez un voyage riche en beauté, en héritage et en émotions.',
'Facile', 10, 3849, 2), 
('L\'archipel aux trésors', 'Explorez l’archipel aux trésors, un voyage à travers les merveilles naturelles, culturelles et spirituelles du Japon. Entre temples majestueux, paysages enchanteurs, traditions vivantes et villes vibrantes, découvrez un pays aux richesses infinies et au charme intemporel.', 
'Facile', 14, 2750.99, 3);

-- Lieux
INSERT INTO Lieu (nom, commentaire, latitude, longitude, note, image, idTypeLieu) VALUES
-- Le japon sous la neige 
('Tokyo', 'Tokyo, partez explorer librement une capitale fascinante, où gratte-ciel ultramodernes, ruelles traditionnelles, quartiers animés et parcs paisibles se succèdent. De Shinjuku à Asakusa, d’Akihabara aux jardins bordés de cerisiers, Tokyo dévoile toute la richesse de ses contrastes.',
35.689444, 139.691667, 4.5, 'tokyo_photo.png', 8),
('Shinjuku, quartier', 'Shinjuku, quartier vibrant de Tokyo, mêle boutiques tendance, restaurants, bars et gratte-ciel impressionnants, tout en abritant le paisible jardin de Shinjuku, l’un des plus grands espaces verts de la capitale.',
 35.693889, 139.703333, 4.5, 'shinjuku_photo.png', 8),
('Harajuku, quartier', 'Harajuku, quartier branché de Tokyo, est le royaume de la mode avant-gardiste, où l\'on croise de jeunes Tokyotes aux styles audacieux et créatifs.',
35.900000, 139.350000, 4.5, 'harajuku_photo.png', 8),
('Mont Fuji', 'Symbole emblématique du Japon, le mont Fuji se dresse majestueusement avec son cône parfait. Entouré de lacs paisibles et souvent couronné de neige, il offre des paysages d’une beauté sereine et inspire depuis toujours artistes et voyageurs.',
 35.360556, 138.727500, 5, 'montFuji_Photo.png', 4),
('Jigokudani', 'Une agréable balade en forêt vous conduit jusqu’à la vallée des singes de Jigokudani, où vivent les célèbres « singes des neiges ». Ces macaques japonais, uniques primates du pays, se laissent observer au cœur des montagnes, souvent lovés dans les sources chaudes.',
36.732778, 138.462778, 4.5, 'Vallee_des_singes_photo.png', 2),
('Kanazawa','Kanazawa, plongée dans le Japon féodal, séduit par ses rues bordées de résidences seigneuriales, ses quartiers historiques, son château et le somptueux jardin Kenrokuen, offrant un voyage à la fois culturel et dépaysant.',
36.566667, 136.650000, 4.5, 'Kanazawa_photo.png', 8),
('Shirakawa-go','Shirakawa-go, village isolé au cœur des montagnes, séduit par ses maisons traditionnelles et son authenticité préservée, classée au patrimoine mondial de l’UNESCO. En hiver, la neige transforme le village en un décor féerique. Vous poursuivez ensuite vers Takayama, la "petite Kyoto", célèbre pour ses monuments historiques et son artisanat traditionnel.',
36.254167, 136.903831, 4.5, 'shirakawa-go_photo.png', 8),
('Takayama','Journée libre à Takayama pour explorer son centre historique aux maisons en bois du XVIIe siècle. Flânez au marché matinal, découvrez la maison Kusakabe et ses brasseries de saké, et visitez l’ancien siège du gouvernement shogunal, témoin de l’histoire locale. ',
36.150000, 137.266667, 4.5, 'Takayama_photo.png', 8),
('Tenryu-ji','Le temple Tenryū-ji, situé à Kyoto, est un site classé au patrimoine mondial de l’UNESCO et l\'un des plus célèbres temples zen du Japon. Fondé au XVe siècle, il est réputé pour son magnifique jardin paysager, intégrant parfaitement la nature environnante, et pour sa vue sur la vallée de l’Arashiyama, offrant un cadre paisible et inspirant.',
35.016111, 135.673889, 4.5, 'Tenryu-ji_photo.png', 9),
('Yasaka-jinja', 'Le sanctuaire Yasaka-jinja, situé au cœur du quartier historique de Gion à Kyoto, est l\'un des plus célèbres du Japon. Connu pour ses magnifiques lanternes et ses festivals traditionnels, il est un lieu incontournable pour découvrir l’atmosphère authentique et festive de Gion.',
35.003611, 135.778611, 4.5, 'yasaka-jinja', 9),
('Nara', 'Nara, ancienne capitale du Japon, est célèbre pour ses temples historiques, ses jardins paisibles et ses cerfs en liberté qui se promènent dans le parc de la ville. Véritable centre culturel, elle abrite des trésors tels que le Todai-ji et sa gigantesque statue de Bouddha, offrant un voyage au cœur de l’histoire japonaise.',
34.683333, 135.833333, 4.5, 'nara_photo.png', 8),

-- Trésors du Japon (nom, commentaire, latitude, longitude, note, image, idTypeLieu)
-- 12 ->
('Osaka', 'Partez à la découverte d’Osaka, grande ville dynamique réputée pour son ambiance chaleureuse, ses quartiers animés et sa gastronomie incontournable. Entre modernité éclatante et sites historiques, Osaka offre une immersion vibrante au cœur du Japon urbain.',
34.693611, 135.501944, 4.5, 'Osaka_photo.png', 8), 
('Hiroshima', 'Découvrez une brasserie de saké et savourez ce vin de riz fermenté, avant de poursuivre vers Hiroshima. Explorez le Parc du Mémorial de la Paix et le Musée du Souvenir, œuvres emblématiques dédiées à la mémoire et à la paix, inscrits au patrimoine mondial de l’UNESCO.', 
34.386944, 132.445278, 4.5, 'Hiroshima_photo.png', 8),
('Miyajima', 'Visitez le magnifique sanctuaire d’Itsukushima, classé au patrimoine mondial de l’UNESCO. Reconnaissable à son grand torii rouge dressé dans la baie, le sanctuaire sur pilotis semble flotter sur l’eau à marée haute, offrant un spectacle d’une beauté saisissante.', 
34.275556, 132.307778 , 4.5, 'Miyajima_photo.png', 8),
('Himeji', 'Poursuivez vers Himeji pour découvrir le splendide Château du Héron Blanc, chef-d’œuvre d’architecture féodale vieux de 530 ans et considéré comme le plus beau château du Japon, avec ses murs immaculés et son allure majestueuse.', 
34.815278, 134.685278, 4.5, 'Himeji_photo.png', 8), 
-- Nara -> Le japon sous la neige n°11
('Kyoto', 'Commencez la journée par la visite du temple Ryoan-ji, connu pour son jardin zen, chef-d’œuvre de minimalisme et de sérénité. Poursuivez avec le splendide Kinkaku-ji, le célèbre Pavillon d’Or, dont les façades recouvertes de feuilles d’or se reflètent dans l’étang, offrant l’une des images les plus mémorables de Kyoto.', 
35.016667, 135.766667, 4.5, 'Kyoto_photo.png',9),
-- Mont Fuji -> Le japon sous la neige n°4
-- Tokyo -> Le japon sous la neige n°1
-- Harajuku -> Le japon sous la neige n°3

-- L\'archipel aux trésors (nom, commentaire, latitude, longitude, note, image, idTypeLieu)
-- Osaka -> Trésors du Japon n°12
-- Hiroshima -> Trésors du Japon n°13
-- Miyajima -> Trésors du Japon n°14
-- Kyoto -> Trésors du Japon n°16
-- Tokyo -> Le japon sous la neige n°1
-- 17 -> 
('Kamakura', 'Journée libre à Kamakura, charmante ville côtière où se mêlent temples zen, sanctuaires shinto et jardins pittoresques. Explorez le temple Engaku-ji, le sanctuaire Hachiman-gu et le temple Hase-dera, puis flânez dans les rues animées menant à la plage de Yuigahama.', 
35.316667, 139.550000, 4.5, 'Kamakura_photo.png', 8);



-- Étapes pour les excursions
INSERT INTO Etape (idExcursion, numOrdre, commentaire, dureeEst, idLieu, idHebergement) VALUES
-- Le Japon sous la neige 
(1, 1, 'Arrivée à Tokyo + visite', 1, 1, 1),
(1, 2, 'Quartier de shinjuku à tokyo', 1, 2, 1),
(1, 3, 'Quartier d\'Harajuku à Tokyo', 1, 3, 1),
(1, 4, 'Visite du Mont Fuji et ses alentours', 1, 4, 2),
(1, 5, 'Jogokudani et la vallée des singes', 1, 5, 3),
(1, 6, 'Visite de Kanazawa', 2, 6, 4),
(1, 7, 'Visite de Shirakawa-go', 1, 7, 5),
(1, 8, 'Visite de Takayama', 1, 8, 6),
(1, 9, 'Visite du temple Tenryu-ji + Kyoto', 1, 9, 6),
(1, 10, 'Visite du sanctuaire d\'Yasaka-jinja', 1, 10, 6),
(1, 11, 'Visite de Nara et Départ', 1, 11, 6), 

-- Trésors du Japon (idExcursion, numOrdre, commentaire, dureeEst, idLieu, idHebergement)
(2, 1, 'Arrivee Osaka + visite ', 1, 12, 7),
(2, 2, 'Visite Hiroshime + dégustation saké', 1, 13, 8),
(2, 3, 'Ile sacrée de Miyajima', 1, 14, 9),
(2, 4, 'Visite de Himeji', 1, 15, 10),
(2, 5, 'Visite de Nara + Todai-ji + kasuga Taisha', 1, 11, 11),
(2, 6, 'Hakone', 1, 16, 12),
(2, 7, 'Mont Fuji', 1, 4, 13),
(2, 8, 'Visite Tokyo', 1, 1, 13),
(2, 9, 'Visite Harajuku + Départ', 1, 3, 13), 

-- L\'archipel aux trésors (idExcursion, numOrdre, commentaire, dureeEst, idLieu, idHebergement)
(3, 1, 'Arrivée à Osaka + visite ', 2, 12, 14),
(3, 2, 'Hiroshima', 1, 13, 15),
(3, 3, 'Miyajima', 1, 14, 15),
(3, 4, 'Miyajima + Kyoto', 1, 16, 16),
(3, 5, 'Visite de Kyoto', 2, 16, 16),
(3, 6, 'Direction Tokyo', 1, 1, 17),
(3, 7, 'Kamakura', 1, 17, 17),
(3, 8, 'Visite Tokyo + Départ', 1, 1, 17);

-- Transports utilisés pour les excursions
INSERT INTO Transporter (idTypeTransport, idExcursion) VALUES
-- Le Japon sous la neige 
(1, 1), 

-- Trésors du Japon 
(1, 2),

-- L\'archipel aux trésors 
(1, 3);


select * from excursion;