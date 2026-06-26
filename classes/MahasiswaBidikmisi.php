<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa
{
    protected $nomorKipKuliah;
    protected $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi)
    {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    public function getNomorKipKuliah() { return $this->nomorKipKuliah; }
    public function getDanaSakuSubsidi() { return $this->danaSakuSubsidi; }

    public function hitungTagihanSemester()
    {
        // Bidikmisi tidak membayar UKT (atau Rp0)
        return 0;
    }

    public function tampilkanSpesifikasiAkademik()
    {
        return "Skema: Bidikmisi | No KIP: {$this->nomorKipKuliah} | Dana Saku: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    // Method query (select-where)
    public static function getMahasiswaBidikmisi($conn)
    {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi'";
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
                $row['nomor_kip_kuliah'],
                $row['dana_saku_subsidi']
            );
        }
        return $data;
    }
}
