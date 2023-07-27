<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'idBooking';

    // Get all booking history
    public function getBookings()
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM booking");
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return $query->getResultArray();
    }

    // Get all booking history of a user by email parameter
    public function getBookingsWhereEmail($emailUser)
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM booking WHERE emailUser = :emailUser:", ['emailUser' => $emailUser]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return $query->getResultArray();
    }

    // Get booking history by id parameter
    public function getBookingWhereId($idBooking)
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM booking WHERE idBooking = :idBooking:", ['idBooking' => $idBooking]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return $query->getRowArray();
    }

    // Insert a new booking data
    public function newBooking($idBooking, $emailUser, $idHotel, $namaHotel, $pathFotoHotel, $namaPanjangTamu, $nomorTeleponTamu, $emailTamu, $jumlahKamar, $checkin, $checkout, $harga, $jamBooking)
    {
        $this->db->transBegin();

        $sql = "INSERT INTO booking (idBooking, emailUser, idHotel, namaHotel, pathFotoHotel, namaPanjangTamu, nomorTeleponTamu, emailTamu, jumlahKamar, checkin, checkout, harga, jamBooking) VALUES (:idBooking:, :emailUser:, :idHotel:, :namaHotel:, :pathFotoHotel:, :namaPanjangTamu:, :nomorTeleponTamu:, :emailTamu:, :jumlahKamar:, :checkin:, :checkout:, :harga:, :jamBooking:)";
        $data = [
            'idBooking' => $idBooking,
            'emailUser' => $emailUser,
            'idHotel' => $idHotel,
            'namaHotel' => $namaHotel,
            'pathFotoHotel' => $pathFotoHotel,
            'namaPanjangTamu' => $namaPanjangTamu,
            'nomorTeleponTamu' => $nomorTeleponTamu,
            'emailTamu' => $emailTamu,
            'jumlahKamar' => $jumlahKamar,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'harga' => $harga,
            'jamBooking' => $jamBooking
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

    // Edit a booking data with id parameter and other data
    public function editBooking($idBooking, $emailUser, $idHotel, $namaHotel, $pathFotoHotel, $namaPanjangTamu, $nomorTeleponTamu, $emailTamu, $jumlahKamar, $checkin, $checkout, $harga, $jamBooking)
    {
        $this->db->transBegin();

        $sql = "UPDATE booking SET emailUser = :emailUser:, idHotel = :idHotel:, namaHotel = :namaHotel:, namaHotel = :namaHotel:, namaPanjangTamu = :namaPanjangTamu:, nomorTeleponTamu = :nomorTeleponTamu:, emailTamu = :emailTamu:, jumlahKamar = :jumlahKamar:, checkin = :checkin:, checkout = :checkout:, harga = :harga:, jamBooking = :jamBooking: WHERE idBooking = :idBooking:";
        $data = [
            'idBooking' => $idBooking,
            'emailUser' => $emailUser,
            'idHotel' => $idHotel,
            'namaHotel' => $namaHotel,
            'pathFotoHotel' => $pathFotoHotel,
            'namaPanjangTamu' => $namaPanjangTamu,
            'nomorTeleponTamu' => $nomorTeleponTamu,
            'emailTamu' => $emailTamu,
            'jumlahKamar' => $jumlahKamar,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'harga' => $harga,
            'jamBooking' => $jamBooking
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

    // Delete a booking data with id parameter
    public function deleteBooking($idBooking)
    {
        $this->db->transBegin();
        $this->db->query("DELETE FROM booking WHERE idBooking = :idBooking:", ['idBooking' => $idBooking]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return TRUE;
    }
}
