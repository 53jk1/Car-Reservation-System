<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller {
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
		parent::initController($request, $response, $logger);

		$this->session = \Config\Services::session(); // Zainicjowanie sesji
		$this->Samochody = new \App\Models\SamochodyModel(); // Zainicjowanie modelu z danymi
	}
}
