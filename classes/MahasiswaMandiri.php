<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa
{
    protected $golonganUkt;
    protected $namaWali;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWali)
    {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    public function getGolonganUkt() { return $this->golonganUkt; }
    public function getNamaWali() { return $this->namaWali; }

    public function hitungTagihanSemester()
    {
        // Untuk mandiri, tagihan sesuai tarif UKT normal
        return $this->tarifUktNominal;
    }

    public function tampilkanSpesifikasiAkademik()
    {
        return "Skema: Mandiri | Golongan UKT: {$this->golonganUkt} | Nama Wali: {$this->namaWali}";
    }

    // Method query (select-where)
    public static function getMahasiswaMandiri($conn)
    {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];
        foreach ($result as $row) {
            $data[] = new self(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['golongan_ukt'],
                $row['nama_wali']
            );
        }
        return $data;
    }
}
