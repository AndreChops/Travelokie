<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\I18n\Time;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->session = session();
		helper('form');
		$this->validation = \Config\Services::validation();
		$this->db = db_connect();
	}

	// User login data validation
	public function isLoginDataValid()
	{
		return $this->validate([
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'Email field is required.',
					'valid_email' => 'Please enter a valid email address.'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password field is required.'
				]
			],
			'captcha' => [
				'rules' => 'required|matches[sess_captcha]',
				'errors' => [
					'required' => 'Captcha field is required.',
					'matches' => 'Captcha doesn\'t match.'
				]
			]
		]);
	}

	// User register and edit profile data validation
	public function isUserDataValid()
	{
		return $this->validate([
			'firstName' => [
				'rules' => 'required|max_length[16]',
				'errors' => [
					'required' => 'First Name field is required.',
					'max_length' => 'First Name field can hold up to 16 characters.'
				]
			],
			'lastName' => [
				'rules' => 'required|max_length[48]',
				'errors' => [
					'required' => 'Last Name field is required.',
					'max_length' => 'Last Name field can hold up to 48 characters.'
				]
			],
			'email' => [
				'rules' => 'required|valid_email|max_length[64]',
				'errors' => [
					'required' => 'Email field is required.',
					'valid_email' => 'Please enter a valid email address.',
					'max_length' => 'Email field can hold up to 64 characters.'
				]
			],
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'Password field is required.',
					'min_length' => 'Password field must have at least 8 characters.'
				]
			],
			'confirmPassword' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => 'Confirm Password field is required.',
					'matches' => 'Password doesn\'t match.'
				]
			],
			'tanggalLahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Birth Date field is required.'
				]
			],
			'nomorTelepon' => [
				'rules' => 'required|numeric|exact_length[12]',
				'errors' => [
					'required' => 'Phone Number field is required.',
					'numeric' => 'Phone Number field must contain numbers only.',
					'exact_length' => 'Phone Number field must contain 12 numbers.'
				]
			],
			'foto' => [
				'rules' => 'is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|max_size[foto,1024]',
				'errors' => [
					'is_image' => 'Uploaded file must be type of image.',
					'mime_in' => 'Uploaded file must be type of image (mime).',
					'max_size' => 'The uploaded file exceeds maximum allowed size.'
				]
			]
		]);
	}

	// Hotel insert and edit data validation
	public function isHotelDataValid()
	{
		return $this->validate([
			'namaHotel' => [
				'rules' => 'required|max_length[64]',
				'errors' => [
					'required' => 'Hotel Name field is required.',
					'max_length' => 'Hotel Name field can hold up to 64 characters.'
				]
			],
			'deskripsi' => [
				'rules' => 'required|max_length[255]',
				'errors' => [
					'required' => 'Description field is required.',
					'max_length' => 'Description field can hold up to 255 characters.'
				]
			],
			'fasilitas' => [
				'rules' => 'max_length[128]',
				'errors' => [
					'max_length' => 'Facility field can hold up to 128 characters.'
				]
			],
			'jumlahKamar' => [
				'rules' => 'required|numeric|greater_than[0]',
				'errors' => [
					'required' => 'Number of Rooms field is required.',
					'numeric' => 'Number of Rooms field must contain numbers only.',
					'greater_than' => 'Number of Rooms must be at least 1.'
				]
			],
			'rating' => [
				'rules' => 'required|numeric|greater_than[0]|less_than[6]',
				'errors' => [
					'required' => 'Rating field is required.',
					'numeric' => 'Rating field must contain numbers only.',
					'greater_than' => 'Rating must be at least 1.',
					'less_than' => 'Rating must be at most 5.'
				]
			],
			'harga' => [
				'rules' => 'required|numeric|greater_than[0]',
				'errors' => [
					'required' => 'Price field is required.',
					'numeric' => 'Price field must contain numbers only.',
					'greater_than' => 'Price must be greater than 0.'
				]
			],
			'lokasi' => [
				'rules' => 'required|max_length[128]',
				'errors' => [
					'required' => 'Location field is required.',
					'max_length' => 'Location field can hold up to 128 characters.'
				]
			],
			'foto' => [
				'rules' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|max_size[foto,1024]',
				'errors' => [
					'uploaded' => 'Photo field is required.',
					'is_image' => 'Uploaded file must be type of image.',
					'mime_in' => 'Uploaded file must be type of image (mime).',
					'max_size' => 'The uploaded file exceeds maximum allowed size.'
				]
			]
		]);
	}

	// Booking insert and edit data validation
	public function isBookingDataValid()
	{
		return $this->validate([
			'namaPanjangTamu' => [
				'rules' => 'required|max_length[64]',
				'errors' => [
					'required' => ' Guest\'s Full Name field is required.',
					'max_length' => 'Guest\'s Full Name field can hold up to 128 characters.'
				]
			],
			'nomorTeleponTamu' => [
				'rules' => 'required|numeric|exact_length[12]',
				'errors' => [
					'required' => 'Guest\'s Phone Number field is required.',
					'numeric' => 'Guest\'s Phone Number field must contain numbers only.',
					'exact_length' => 'Guest\'s Phone Number field must contain 12 numbers.'
				]
			],
			'emailTamu' => [
				'rules' => 'required|valid_email|max_length[64]',
				'errors' => [
					'required' => 'Guest\'s Email field is required.',
					'valid_email' => 'Please enter a valid email address.',
					'max_length' => 'Guest\'s Email field can hold up to 64 characters.'
				]
			],
			'jumlahKamar' => [
				'rules' => 'required|numeric|greater_than[0]',
				'errors' => [
					'required' => 'Rooms field is required.',
					'numeric' => 'Rooms field must contain numbers only.',
					'greater_than' => 'Rooms must be at least 1.'
				]
			],
			'checkin' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Check In Date field is required.'
				]
			],
			'checkout' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Check Out Date field is required.'
				]
			]
		]);
	}

	// Function to check if session user is admin
	public function isAdmin()
	{
		if ($this->session->get('role') === 'admin') {
			return TRUE;
		}
		return FALSE;
	}
}
