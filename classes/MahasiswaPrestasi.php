<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa
{
    protected $namaInstansiBeasiswa;
    protected $minimalIpkSyarat;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpkSyarat)
    {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    public function getNamaInstansiBeasiswa() { return $this->namaInstansiBeasiswa; }
    public function getMinimalIpkSyarat() { return $this->minimalIpkSyarat; }

    public function hitungTagihanSemester()
    {
        // Prestasi mendapat potongan 75%, sehingga mahasiswa cukup membayar 25% dari tarif ukt aslinya
        return $this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik()
    {
        return "Skema: Prestasi | Instansi Beasiswa: {$this->namaInstansiBeasiswa} | Syarat Min IPK: {$this->minimalIpkSyarat}";
    }

    // Method query (select-where)
    public static function getMahasiswaPrestasi($conn)
    {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi'";
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
                $row['nama_instansi_beasiswa'],
                $row['minimal_ipk_syarat']
            );
        }
        return $data;
    }
}
