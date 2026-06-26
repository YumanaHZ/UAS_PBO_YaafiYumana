CREATE DATABASE IF NOT EXISTS DB_UAS_PBO_TRPL1A_YaafiYumana;
USE DB_UAS_PBO_TRPL1A_YaafiYumana;

CREATE TABLE IF NOT EXISTS tabel_mahasiswa (
    id_mahasiswa INT AUTO_INCREMENT PRIMARY KEY,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL,
    semester INT NOT NULL,
    tarif_ukt_nominal DECIMAL(12,2) NOT NULL,
    jenis_pembiayaan ENUM('Mandiri', 'Bidikmisi', 'Prestasi') NOT NULL,
    
    -- Atribut Spesifik (Anak - Set wajib menjadi Nullable)
    golongan_ukt INT NULL,
    nama_wali VARCHAR(100) NULL,
    nomor_kip_kuliah VARCHAR(50) NULL,
    dana_saku_subsidi DECIMAL(12,2) NULL,
    nama_instansi_beasiswa VARCHAR(100) NULL,
    minimal_ipk_syarat DECIMAL(3,2) NULL
);

-- Insert 20 Data Sampel (minimal 2 per jenis pembiayaan)
INSERT INTO tabel_mahasiswa 
(nama_mahasiswa, nim, semester, tarif_ukt_nominal, jenis_pembiayaan, golongan_ukt, nama_wali, nomor_kip_kuliah, dana_saku_subsidi, nama_instansi_beasiswa, minimal_ipk_syarat)
VALUES
-- Mandiri (8 data)
('Agus Santoso', 'TRPL23001', 2, 4500000.00, 'Mandiri', 4, 'Budi Santoso', NULL, NULL, NULL, NULL),
('Siti Aminah', 'TRPL23002', 2, 5000000.00, 'Mandiri', 5, 'Rahmat', NULL, NULL, NULL, NULL),
('Budi Utomo', 'TRPL22003', 4, 3000000.00, 'Mandiri', 3, 'Supri', NULL, NULL, NULL, NULL),
('Dina Mariana', 'TRPL22004', 4, 6000000.00, 'Mandiri', 6, 'Handoko', NULL, NULL, NULL, NULL),
('Eko Prasetyo', 'TRPL21005', 6, 4500000.00, 'Mandiri', 4, 'Wagiman', NULL, NULL, NULL, NULL),
('Fina Melinda', 'TRPL21006', 6, 2000000.00, 'Mandiri', 2, 'Sutejo', NULL, NULL, NULL, NULL),
('Gilang Dirga', 'TRPL20007', 8, 5000000.00, 'Mandiri', 5, 'Ahmad', NULL, NULL, NULL, NULL),
('Hana Kirana', 'TRPL20008', 8, 7500000.00, 'Mandiri', 7, 'Lukman', NULL, NULL, NULL, NULL),

-- Bidikmisi (6 data)
('Iwan Fals', 'TRPL23009', 2, 0.00, 'Bidikmisi', NULL, NULL, 'KIP11223344', 950000.00, NULL, NULL),
('Joko Widodo', 'TRPL23010', 2, 0.00, 'Bidikmisi', NULL, NULL, 'KIP11223355', 950000.00, NULL, NULL),
('Kaesang Pangarep', 'TRPL22011', 4, 0.00, 'Bidikmisi', NULL, NULL, 'KIP11223366', 950000.00, NULL, NULL),
('Lesti Kejora', 'TRPL22012', 4, 0.00, 'Bidikmisi', NULL, NULL, 'KIP11223377', 950000.00, NULL, NULL),
('Mahalini', 'TRPL21013', 6, 0.00, 'Bidikmisi', NULL, NULL, 'KIP11223388', 950000.00, NULL, NULL),
('Nadin Amizah', 'TRPL21014', 6, 0.00, 'Bidikmisi', NULL, NULL, 'KIP11223399', 950000.00, NULL, NULL),

-- Prestasi (6 data)
('Oka Antara', 'TRPL23015', 2, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Beasiswa Plus', 3.50),
('Putri Marino', 'TRPL23016', 2, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', 3.25),
('Qory Sandioriva', 'TRPL22017', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'BCA Syariah', 3.40),
('Reza Rahadian', 'TRPL22018', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Gudang Garam', 3.50),
('Raisa Andriana', 'TRPL21019', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'LPDP', 3.75),
('Tulus', 'TRPL21020', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Telkomsel', 3.30);
