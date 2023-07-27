<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
	protected $bookingModel;
	protected $hotelModel;
	protected $userModel;

	// Constructor, assigning models to variables
	public function __construct()
	{
		$this->bookingModel = model('BookingModel');
		$this->hotelModel = model('HotelModel');
		$this->userModel = model('UserModel');
		$this->session = session();
	}

	// Direct to admin homepage
	public function index()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		return $this->tableHotel();
	}

	// Hotel table page
	public function tableHotel()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$data = [
			'hotels' => $this->hotelModel->getHotels()
		];

		return view('admin/datahotel', $data);
	}

	// Booking table page
	public function tableBooking()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$data = [
			'bookings' => $this->bookingModel->getBookings()
		];

		return view('admin/databooking', $data);
	}

	// User table page
	public function tableUser()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$data = [
			'users' => $this->userModel->getUsers()
		];

		return view('admin/datauser', $data);
	}

	// Direct admin to edit user profile page
	public function toEditUser($email)
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$user = $this->userModel->getUserWhereEmail($email);
		return view('admin/edituser', $user);
	}

	// User delete data action
	public function deleteUser($email)
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$success = $this->userModel->deleteUser($email);

		// If delete user failed
		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Admin/tableUser');
		}

		$this->session->setFlashdata('message', 'User successfully deleted.');
		return redirect()->to('/Admin/tableUser');
	}

	// Direct admin to insert hotel page
	public function toNewHotel()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		return view('admin/inserthotel');
	}

	// Hotel insert data validation and action
	public function newHotel()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		if (!$this->isHotelDataValid()) {
			return redirect()->to('/Admin/toNewHotel')->withInput();
		}
		$path = 'assets/images/hotel/';

		$idHotel = md5(Time::now('Asia/Jakarta'));
		$namaHotel = $this->request->getPost('namaHotel');
		$slug = url_title($namaHotel, '-', true);
		$deskripsi = $this->request->getPost('deskripsi');
		$fasilitas = $this->request->getPost('fasilitas');
		$jumlahKamar = $this->request->getPost('jumlahKamar');
		$rating = $this->request->getPost('rating');
		$harga = $this->request->getPost('harga');
		$lokasi = $this->request->getPost('lokasi');
		$foto = $this->request->getFile('foto');

		$pathFoto = NULL;

		// Insert new photo using the slug of hotel
		$ext = "." . $foto->getExtension();
		$foto->move($path, $slug . $ext);

		// Get photo path for database input
		$pathFoto = $path . $foto->getName();

		$success = $this->hotelModel->newHotel($idHotel, $namaHotel, $deskripsi, $fasilitas, $jumlahKamar, $rating, $harga, $lokasi, $pathFoto);

		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Admin/toNewHotel')->withInput();
		}

		$this->session->setFlashdata('message', 'New hotel successfully inserted.');
		return redirect()->to('/Admin');
	}

	// Direct admin to edit hotel page
	public function toEditHotel($idHotel)
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$hotel = $this->hotelModel->getHotelWhereId($idHotel);
		return view('admin/edithotel', $hotel);
	}

	// Hotel edit data validation and action
	public function editHotel()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$idHotel = $this->request->getPost('idHotel');

		if (!$this->isHotelDataValid()) {
			return redirect()->to('/Admin/toEditHotel/' . $idHotel)->withInput();
		}
		$path = 'assets/images/hotel/';

		$namaHotel = $this->request->getPost('namaHotel');
		$slug = url_title($namaHotel, '-', true);
		$deskripsi = $this->request->getPost('deskripsi');
		$fasilitas = $this->request->getPost('fasilitas');
		$jumlahKamar = $this->request->getPost('jumlahKamar');
		$rating = $this->request->getPost('rating');
		$harga = $this->request->getPost('harga');
		$lokasi = $this->request->getPost('lokasi');
		$foto = $this->request->getFile('foto');

		$pathFoto = NULL;

		// If photo is uploaded
		if ($foto->getError() !== 4) {

			// Get the path of hotel's old photo
			$hotel = $this->hotelModel->getHotelWhereId($idHotel);
			$pathFotoLama = $hotel['pathFoto'];

			// If photo existed, delete photo
			if (is_file($pathFotoLama)) {
				unlink($pathFotoLama);
			}

			// Insert new photo using the slug of hotel
			$ext = "." . $foto->getExtension();
			$foto->move($path, $slug . $ext);

			// Get photo path for database input
			$pathFoto = $path . $foto->getName();
		}

		$success = $this->hotelModel->editHotel($idHotel, $namaHotel, $deskripsi, $fasilitas, $jumlahKamar, $rating, $harga, $lokasi, $pathFoto);

		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Admin');
		}

		$this->session->setFlashdata('message', 'Hotel successfully edited.');
		return redirect()->to('/Admin');
	}

	// Hotel delete data action
	public function deleteHotel($idHotel)
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		// Get the path of hotel's photo
		$hotel = $this->hotelModel->getHotelWhereId($idHotel);
		$pathFoto = $hotel['pathFoto'];

		// If photo existed, delete photo
		if (is_file($pathFoto)) {
			unlink($pathFoto);
		}

		$success = $this->hotelModel->deleteHotel($idHotel);

		// If delete hotel failed
		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Admin');
		}

		$this->session->setFlashdata('message', 'Hotel successfully deleted.');
		return redirect()->to('/Admin');
	}

	// Direct admin to edit booking page
	public function toeditBooking($idBooking)
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$booking = $this->bookingModel->getBookingWhereId($idBooking);
		return view('admin/editbooking', $booking);
	}

	// Booking edit data validation and action
	public function editBooking()
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$idBooking = $this->request->getPost('idBooking');

		if (!$this->isBookingDataValid()) {
			return redirect()->to('/Admin/toEditBooking/' . $idBooking)->withInput();
		}

		$idHotel = $this->request->getPost('idHotel');
		$hotel = $this->hotelModel->getHotelWhereId($idHotel);
		$namaHotel = $hotel['namaHotel'];
		$pathFotoHotel = $hotel['pathFoto'];

		$emailUser = $this->request->getPost('emailUser');
		$namaPanjangTamu = $this->request->getPost('namaPanjangTamu');
		$nomorTeleponTamu = $this->request->getPost('nomorTeleponTamu');
		$emailTamu = $this->request->getPost('emailTamu');
		$jumlahKamar = $this->request->getPost('jumlahKamar');
		$checkin = $this->request->getPost('checkin');
		$checkout = $this->request->getPost('checkout');
		$harga = $this->request->getPost('hargaTotal');
		$jamBooking = $this->request->getPost('jamBooking');

		$success = $this->bookingModel->editBooking($idBooking, $emailUser, $idHotel, $namaHotel, $pathFotoHotel, $namaPanjangTamu, $nomorTeleponTamu, $emailTamu, $jumlahKamar, $checkin, $checkout, $harga, $jamBooking);

		// If booking failed
		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Admin/tableBooking');
		}

		$this->session->setFlashdata('message', 'Booking successfully edited.');
		return redirect()->to('/Admin/tableBooking');
	}

	// Booking delete data action
	public function deleteBooking($idBooking)
	{
		if (!$this->isAdmin()) {
			$this->session->setFlashdata('message', 'Access denied.');
			return redirect()->to('/');
		}

		$success = $this->bookingModel->deleteBooking($idBooking);

		// If delete booking failed
		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Admin/tableBooking');
		}

		$this->session->setFlashdata('message', 'Booking successfully deleted.');
		return redirect()->to('/Admin/tableBooking');
	}
}
