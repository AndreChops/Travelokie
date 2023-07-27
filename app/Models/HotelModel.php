<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'idHotel';

    // Get all hotels
    public function getHotels()
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM hotel");
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return $query->getResultArray();
    }

    // Get top 3 hotels
    public function getTop3Hotels()
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM hotel ORDER BY rating DESC LIMIT 3");
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return $query->getResultArray();
    }

    // Get hotel with id parameter
    public function getHotelWhereId($idHotel)
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM hotel WHERE idHotel = :idHotel:", ['idHotel' => $idHotel]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return $query->getRowArray();
    }

    // Insert a new hotel
    public function newHotel($idHotel, $namaHotel, $deskripsi, $fasilitas, $jumlahKamar, $rating, $harga, $lokasi, $pathFoto)
    {
        $this->db->transBegin();

        $sql = "INSERT INTO hotel (idHotel, namaHotel, deskripsi, fasilitas, jumlahKamar, rating, harga, lokasi, pathFoto) VALUES (:idHotel:, :namaHotel:, :deskripsi:, :fasilitas:, :jumlahKamar:, :rating:, :harga:, :lokasi:, :pathFoto:)";
        $data = [
            'idHotel' => $idHotel,
            'namaHotel' => $namaHotel,
            'deskripsi' => $deskripsi,
            'fasilitas' => $fasilitas,
            'jumlahKamar' => $jumlahKamar,
            'rating' => $rating,
            'harga' => $harga,
            'lokasi' => $lokasi,
            'pathFoto' => $pathFoto
        ];

        $this->db->query($sql, $data);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return TRUE;
    }

    // Edit a hotel data with id parameter and other data
    public function editHotel($idHotel, $namaHotel, $deskripsi, $fasilitas, $jumlahKamar, $rating, $harga, $lokasi, $pathFoto)
    {
        $this->db->transBegin();

        $sql = "UPDATE hotel SET namaHotel = :namaHotel:, deskripsi = :deskripsi:, fasilitas = :fasilitas:, jumlahKamar = :jumlahKamar:, rating = :rating:, harga = :harga:, lokasi = :lokasi:, pathFoto = :pathFoto: WHERE idHotel = :idHotel:";
        $data = [
            'idHotel' => $idHotel,
            'namaHotel' => $namaHotel,
            'deskripsi' => $deskripsi,
            'fasilitas' => $fasilitas,
            'jumlahKamar' => $jumlahKamar,
            'rating' => $rating,
            'harga' => $harga,
            'lokasi' => $lokasi,
            'pathFoto' => $pathFoto
        ];

        $this->db->query($sql, $data);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return TRUE;
    }

    // Delete a hotel data with id parameter
    public function deleteHotel($idHotel)
    {
        $this->db->transBegin();
        $this->db->query("DELETE FROM hotel WHERE idHotel = :idHotel:", ['idHotel' => $idHotel]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return TRUE;
    }
}
