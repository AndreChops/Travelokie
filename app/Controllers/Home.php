<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Home extends BaseController
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
		$this->captcha();
	}

	// Direct to homepage
	public function index()
	{
		$this->captcha();
		$data = [
			'hotels' => $this->hotelModel->getHotels(),
			'top3Hotels' => $this->hotelModel->getTop3Hotels(),
			'controller' => $this // For captcha refresh
		];
		return view('main', $data);
	}

	// Direct to admin page
	public function adminPage()
	{
		if ($this->isAdmin()) {
			$data = [
				'hotels' => $this->hotelModel->getHotels()
			];
			return view('admin/datahotel', $data);
		}

		return $this->index();
	}

	// User login data validation and verification
	public function login()
	{
		if (!$this->isLoginDataValid()) {
			$this->session->setFlashdata('showModal', TRUE);
			return redirect()->to('/')->withInput();
		}

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		$user = $this->userModel->login($email, $password);

		// If no user is found
		if (is_null($user)) {
			$this->session->setFlashdata('modalMessage', 'Your email or password is incorrect.');
			$this->session->setFlashdata('showModal', TRUE);
			return redirect()->to('/')->withInput();
		}

		// If error occured
		else if (!$user) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/')->withInput();
		}

		$nama = $user['firstName'] . ' ' . $user['lastName'];

		$this->session->setFlashdata('message', 'Successfully signed in as ' . $nama . '.');

		$data = $user;
		$data['log_sess'] = TRUE;

		$this->session->set($data);

		if ($this->isAdmin()) {
			$this->session->setFlashdata('message', 'Successfully signed in as ' . $nama . ' (admin).');
			return $this->adminPage();
		}

		return $this->index();
	}

	// Direct user to registration page
	public function toRegister()
	{
		return view('user/register', ['controller' => $this]);
	}

	// User registration data validation and action
	public function register()
	{
		if (!$this->isUserDataValid()) {
			return redirect()->to('/Home/toRegister')->withInput();
		}

		$path = 'assets/images/user/';

		$firstName = $this->request->getPost('firstName');
		$lastName = $this->request->getPost('lastName');
		$email = $this->request->getPost('email');
		$emailPrefix = explode('@', $email)[0];
		$password = $this->request->getPost('password');
		$hashedPassword = md5($password);
		$tanggalLahir = $this->request->getPost('tanggalLahir');
		$nomorTelepon = $this->request->getPost('nomorTelepon');
		$foto = $this->request->getFile('foto');

		$pathFoto = $path . 'default.png'; // Default photo file name is 'default.png'

		// If photo is uploaded
		if ($foto->getError() !== 4) {

			// Insert new photo using the email prefix of user
			$ext = "." . $foto->getExtension();
			$foto->move($path, $emailPrefix . $ext);

			// Get photo path for database input
			$pathFoto = $path . $foto->getName();
		}

		$success = $this->userModel->register('user', $firstName, $lastName, $email, $hashedPassword, $tanggalLahir, $nomorTelepon, $pathFoto);

		// If registration failed
		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Home/toRegister')->withInput();
		}

		$this->session->setFlashdata('message', 'Your account has been successfully registered.');
		return redirect()->to('/');
	}

	// Direct user to edit profile page
	public function toEditProfile()
	{
		$email = $this->session->get('email');
		if (isset($email)) {
			$user = $this->userModel->getUserWhereEmail($email);
			return view('user/editprofile', $user);
		}

		$this->session->setFlashdata('modalMessage', 'Please sign in before editing profile.');
		$this->session->setFlashdata('showModal', TRUE);
		return $this->index();
	}

	// User edit profile data validation and action
	public function editProfile()
	{
		if (!$this->isUserDataValid()) {
			return redirect()->to('/Home/toEditProfile')->withInput();
		}

		$path = 'assets/images/user/';

		$firstName = $this->request->getPost('firstName');
		$lastName = $this->request->getPost('lastName');
		$email = $this->session->get('email');
		$emailPrefix = explode('@', $email)[0];
		$password = $this->request->getPost('password');
		$hashedPassword = md5($password);
		$tanggalLahir = $this->request->getPost('tanggalLahir');
		$nomorTelepon = $this->request->getPost('nomorTelepon');
		$foto = $this->request->getFile('foto');

		$user = $this->userModel->getUserWhereEmail($email);
		$pathFoto = $path . 'default.png'; // Default photo file name is 'default.png'

		// If photo is uploaded
		if ($foto->getError() !== 4) {

			// Get the path of user's old photo

			$pathFotoLama = $user['pathFoto'];

			// If photo existed and is not default photo, delete photo
			if (is_file($pathFotoLama) && $pathFotoLama !== $pathFoto) {
				unlink($pathFotoLama);
			}

			// Insert new photo using the email prefix of user
			$ext = "." . $foto->getExtension();
			$foto->move($path, $emailPrefix . $ext);

			// Get photo path for database input
			$pathFoto = $path . $foto->getName();
		}

		$user = $this->userModel->editUser($firstName, $lastName, $email, $hashedPassword, $tanggalLahir, $nomorTelepon, $pathFoto);

		// If edit profile failed
		if (!$user) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Home/toEditProfile')->withInput();
		}

		$data = $user;
		$data['log_sess'] = TRUE;

		$this->session->set($data);

		$this->session->setFlashdata('message', 'Your profile has been successfully updated.');
		return redirect()->to('/');
	}

	// User logout, session destroyed
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}

	// Direct user to hotel booking page or to main page with modal opened
	public function toBookHotel($idHotel)
	{
		if ($this->session->get('log_sess')) {
			$hotel = $this->hotelModel->getHotelWhereId($idHotel);
			return view('user/booking', $hotel);
		}

		$this->session->setFlashdata('modalMessage', 'Please sign in before booking a hotel.');
		$this->session->setFlashdata('showModal', TRUE);
		return $this->index();
	}

	// Booking data validation and insertion
	public function bookHotel()
	{
		$idHotel = $this->request->getPost('idHotel');

		if (!$this->isBookingDataValid()) {
			return redirect()->to('/Home/toBookHotel/' . $idHotel)->withInput();
		}

		$hotel = $this->hotelModel->getHotelWhereId($idHotel);
		$namaHotel = $hotel['namaHotel'];
		$pathFotoHotel = $hotel['pathFoto'];

		$emailUser = $this->session->get('email');
		$namaPanjangTamu = $this->request->getPost('namaPanjangTamu');
		$nomorTeleponTamu = $this->request->getPost('nomorTeleponTamu');
		$emailTamu = $this->request->getPost('emailTamu');
		$jumlahKamar = $this->request->getPost('jumlahKamar');
		$checkin = $this->request->getPost('checkin');
		$checkout = $this->request->getPost('checkout');
		$harga = $this->request->getPost('hargaTotal');
		$jamBooking = Time::now('Asia/Jakarta');
		$idBooking = md5($emailUser . $jamBooking);

		$success = $this->bookingModel->newBooking($idBooking, $emailUser, $idHotel, $namaHotel, $pathFotoHotel, $namaPanjangTamu, $nomorTeleponTamu, $emailTamu, $jumlahKamar, $checkin, $checkout, $harga, $jamBooking);

		// If booking failed
		if (!$success) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/Home/toBookHotel/' . $idHotel)->withInput();
		}

		$this->session->setFlashdata('message', 'Hotel rooms successfully booked.');
		return redirect()->to('/Home/showInvoice/' . $idBooking);
	}

	// Searching hotels with given parameters
	public function searchHotels($rating = NULL, $hargaBawah = NULL, $hargaAtas = NULL, $lokasi = NULL)
	{
		$hotelsByRating = [];
		$hotelsByPrice = [];
		$hotelsByLocation = [];
		$data['hotels'] = [];

		// If rating parameter is given
		if (!is_null($rating)) {
			$hotelsByRating = $this->hotelModel->getHotelsWhereRating($rating);
		}

		// If lower price or higher price parameter is given
		if (!is_null($hargaBawah) || !is_null($hargaAtas)) {

			// If price is null, then set price to 0
			if (is_null($hargaBawah)) $hargaBawah = 0;
			if (is_null($hargaAtas)) $hargaAtas = 0;

			// Swap if lower price is greater than higher price
			if ($hargaBawah > $hargaAtas) {
				$temp = $hargaBawah;
				$hargaBawah = $hargaAtas;
				$hargaAtas = $temp;
			}

			$hotelsByPrice = $this->hotelModel->getHotelsWhereHargaBetween($hargaBawah, $hargaAtas);
		}

		// If location parameter is given
		if (!is_null($lokasi)) {
			$hotelsByLocation = $this->hotelModel->getHotelsWhereLokasi($lokasi);
		}

		// Intersect arrays to get final result
		$data['hotels'] = array_intersect($hotelsByRating, $hotelsByPrice, $hotelsByLocation);
		return view('main', $data);
	}

	// Get all user's booking history and pass to view
	public function toBookingHistory()
	{
		$email = $this->session->get('email');
		$bookings = $this->bookingModel->getBookingsWhereEmail($email);

		// If user haven't booked anything yet.
		if ($bookings == []) {
			$this->session->setFlashdata('message', 'You haven\'t book any hotel.');
			return redirect()->to('/');
		}

		// If error occured
		else if (!$bookings) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/');
		}

		$data = [
			'bookings' => $bookings
		];

		return view('user/history', $data);
	}

	// Show invoice upon hotel booking and clicking booking details
	public function showInvoice($idBooking)
	{
		$booking = $this->bookingModel->getBookingWhereId($idBooking);

		// If error occured
		if (!$booking) {
			$this->session->setFlashdata('message', 'Something went wrong, please try again.');
			return redirect()->to('/');
		}

		$hotel = $this->hotelModel->getHotelWhereId($booking['idHotel']);

		$data = [
			'booking' => $booking,
			'hotel' => $hotel
		];

		return view('user/invoice', $data);
	}

	// Create captcha for login
	public function captcha()
	{
		$permitted_chars = '1234567890ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		$captcha_string = $this->generate_string($permitted_chars, 6);
		$this->session->set('captcha', $captcha_string);
	}

	// Generate string for captcha
	public function generate_string($chars, $len)
	{
		$char_length = strlen($chars);
		$random_string = '';
		for ($i = 0; $i < $len; $i++) {
			$random_character = $chars[mt_rand(0, $char_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
}
