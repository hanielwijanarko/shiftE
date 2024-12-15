CREATE DATABASE pelatihan;
use pelatihan;
CREATE TABLE akun (
    id int NOT NULL AUTO_INCREMENT,
    nama varchar(100) NOT NULL,
    password varchar(250) NOT NULL,
    jenis_akun enum('admin','user') NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE peserta (
    id_peserta int NOT NULL AUTO_INCREMENT,
    nama varchar(100) NOT NULL,
    password varchar(250) NOT NULL,
    nama_program varchar(100) NOT NULL,
    PRIMARY KEY (id_peserta)
);

INSERT INTO akun (nama, password, jenis_akun) VALUES ('admin', '123', 'admin');

