<?php namespace App\Controllers;

class App extends BaseController {
	
	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		index
					(GET)
		Argumenty:	nie przyjmuje
		Funkcja:	Służy do wyświetlania strony głównej aplikacji
	*/
	public function index() {
		$View = [ // Zmienna dla przekazania niektórych informacji do widoku
			'Title' => 'Strona główna', // Ustalany jest tytuł strony (dla znacznika <title> w widoku)
			'PrzykladoweSamochody' => $this->Samochody->where('status', '1')->findAll(), // Pobranie informacji o dostępnych samochodach do przesuwnej prezentacji (tzw. "karuzela") na stronie głównej
			'WszystkieSamochody' => $this->Samochody->findAll(), // Pobranie wszystkich informacji o wszystkich samochodach
		];
		echo view('header', $View); // Załadowanie widoku nagłówka i przekazanie tam informacji
		echo view('index', $View); // Załadowanie widoku właściwego (<body>) i przekazanie tam informacji
		echo view('footer', $View); // Załadowanie widoku stopki i przekazanie tam informacji
	}

	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		login_page
					(GET)
		Argumenty:	nie przyjmuje
		Funkcja:	Służy do wyświetlania strony logowania do panelu zarządzania
	*/
	public function login_page() {
		$View = [ // Zmienna dla przekazania niektórych informacji do widoku
			'Title' => 'Strona logowania', // Ustalany jest tytuł strony (dla znacznika <title> w widoku)
		];
		echo view('header', $View); // Załadowanie widoku nagłówka i przekazanie tam informacji
		echo view('logowanie', $View); // Załadowanie widoku właściwego (<body>) i przekazanie tam informacji
		echo view('footer', $View); // Załadowanie widoku stopki i przekazanie tam informacji
	}
	
	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		login_process
					(POST)
		Argumenty:	nie przyjmuje
		Funkcja:	Służy do weryfikacji poprawności wprowadzonych danych do logowania
					Zmienne przekazyne są w formularzu metodą POST, dostępne są poprzez $this->request->getVar();
	*/
	public function login_process() {
		// Najpierw przyjmujemy właściwe dane do logowania
		$DaneLogowania = [
			'login'	=>	'admin',
			'haslo'	=>	'admin1',
		];
		// Instrukcja warunkowa: Jeśli wprowadzony login jest zgodny ze zdefiniowanym ORAZ wprowadzone hasło jest zgodne ze zdefiniowanym (a więc jeśli prawda)...
		if($this->request->getVar('login') == $DaneLogowania['login'] AND $this->request->getVar('haslo') == $DaneLogowania['haslo']){
			// Ustawiamy sesję użytkowanika jako zalogowanego
			$this->session->set('zalogowany', TRUE);
			// Przekierowanie na stronę panelu zarządzania
			header("Location:https://rezerwacja.onrop.pl/admin");
		// W przeciwnym wypadku (jeśli fałsz)...
		}else{
			// Ustawiamy błąd sesji do wyświetlenia w widoku
			$this->session->setFlashdata('error', 'Nieprawidłowe dane logowania!');
			// Przekierowanie na stronę logowania
			header("Location:https://rezerwacja.onrop.pl/login");
		}
	}
	
	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		logout
					(GET)
		Argumenty:	nie przyjmuje
		Funkcja:	Służy do wylogowania użytkownika poprzez usunięcie jego sesji
	*/
	public function logout() {
		// Zgodnie z dokumentacją frameworka CodeIgniter - alias dla session_destroy();
		$this->session->destroy();
		// Przekierowanie na stronę logowania
		header("Location:https://rezerwacja.onrop.pl/login");
	}

	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		admin
					(GET)
		Argumenty:	nie przyjmuje
		Funkcja:	Służy do wyświetlania strony panelu zarządzania wraz z formularzem do edycji informacji o pojazdach
	*/
	public function admin() {
		// Instrukcja warunkowa: Jeśli użytkownik NIE JEST (!=) zalogowany (jeśli fałsz)...
		if($this->session->zalogowany != TRUE){
			// Przekierowanie na stronę główną aplikacji
			header("Location:https://rezerwacja.onrop.pl/");
		// W przeciwnym wypadku (jeśli prawda)...
		}else{
			$View = [ // Zmienna dla przekazania niektórych informacji do widoku
				'Title' => 'Zarządzanie aplikacją', // Ustalany jest tytuł strony (dla znacznika <title> w widoku)
				'WszystkieSamochody' => $this->Samochody->findAll(), // Pobranie wszystkich informacji o wszystkich samochodach
			];
			echo view('header', $View); // Załadowanie widoku nagłówka i przekazanie tam informacji
			echo view('admin', $View); // Załadowanie widoku właściwego (<body>) i przekazanie tam informacji
			echo view('footer', $View); // Załadowanie widoku stopki i przekazanie tam informacji
		}
	}

	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		admin_edit
					(POST)
		Argumenty:	nie przyjmuje
		Funkcja:	Służy do edycji informacji o konkretnym pojeździe w panelu zarządzania
	*/
	public function admin_edit() {
		$id = $this->request->getVar('id'); // Pobranie ID pojazdu z formularza edycji
		
		// Przypisywanie informacji do zmiennych w celu aktualizacji
		// Można było zrobić to za pomocą serialize();, ale w sumie czemu nie tak dla prostej aplikacji
		$pojazd['marka']			=	$this->request->getVar('marka');
		$pojazd['model']			=	$this->request->getVar('model');
		$pojazd['produkcja']		=	$this->request->getVar('produkcja');
		$pojazd['stawka']			=	$this->request->getVar('stawka');
		$pojazd['miejsce_krotko']	=	$this->request->getVar('miejsce_krotko');
		$pojazd['miejsce_dokladne']	=	$this->request->getVar('miejsce_dokladne');
		$pojazd['obrazek']			=	$this->request->getVar('obrazek');
		if($this->request->getVar('status') == 'on'){$pojazd['status'] = '1';}else{$pojazd['status'] = '0';} // Konwersja dostępności pojazdu dla formy zrozumiałej dla naszej aplikacji
		
		$update = $this->Samochody->update($id, $pojazd); // Aktualizacja informacji o konkretnym pojeździe
		
		// Instrukcja warunkowa: Jeśli aktualizacja się udała (jeśli prawda)...
		if($update){
			// Ustawienie informacji sesyjnej z informacją o sukcesie
			$this->session->setFlashdata('edytowano', 'Dane zostały zaktualizowane!');
			// Przekierowanie na stronę administracyjną
			header("Location:https://rezerwacja.onrop.pl/admin");
		// W przeciwnym wypadku (jeśli fałsz)...
		}else{
			// Po prostu powrót na stronę administracyjną
			header("Location:https://rezerwacja.onrop.pl/admin");
		}
	}
	
	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		car
					(GET)
		Argumenty:	$id - przekazywana w URI strony
		Funkcja:	Służy do wyświetlania informacji o konkretnym pojeździe
	*/
	public function samochod($id) {
		$car = $this->Samochody->find($id); // Pobranie wszystkich informacji o konkretnym samochodzie
		// Instrukcja warunkowa: Jeśli podany samochód nie istnieje w bazie...
		if(!$car){
			// Przekierowanie na stronę główną
			header("Location:https://rezerwacja.onrop.pl/");
		}
		$View = [ // Zmienna dla przekazania niektórych informacji do widoku
			'Title' => $car['marka'] . ' ' . $car['model'], // Ustalany jest tytuł strony (dla znacznika <title> w widoku)
			'Samochod'	=>	$car, // Przekazanie informacji o pojeździe do widoku
		];
		echo view('header', $View); // Załadowanie widoku nagłówka i przekazanie tam informacji
		echo view('samochod', $View); // Załadowanie widoku właściwego (<body>) i przekazanie tam informacji
		echo view('footer', $View); // Załadowanie widoku stopki i przekazanie tam informacji
	}
	
	/** METODA
		-------------------------------------------------------------------------------------------------
		*************************************************************************************************
		-------------------------------------------------------------------------------------------------
		Metoda:		samochod_process
					(POST)
		Argumenty:	nie przyjmuje
		Funkcja:	Służy do wypożyczenia samochodu w dwóch etapach
					- Etap I: wprowadzenie dodatkowych informacji (np. imię, adres email)
					- Etap II: przetworzenie i zakończenie wysłaniem maila z potwierdzeniem
					Kod rozpoczyna się od sprawdzenia, czy nadeszła pora na etap II. Jeśli tak, to procedujemy, a jeśli nie, to dążymy do etapu II
	*/
	public function samochod_process() {
		// Instrukcja warunkowa: Jeśli w etapie I formularz przekazuje informacje do etapu II (jeśli prawda), to...
		// ... rozpoczynamy etap II
		if($this->request->getVar('etapII')){
			// Aktualizacja informacji o konkretnym pojeździe w taki sposób, że zmieniany jest jego status na 0 (zarezerwowany)
			$update = $this->Samochody->update($this->request->getVar('id'), ['status' => '0',]);
			// Instrukcja warunkowa: Jeśli aktualizacja się powiodła (jeśli prawda)...
			if($update){				
				$email = \Config\Services::email(); // Inicjujemy usługę obsługującą maile w aplikacji (dostarczone przez CodeIgniter)
				$email->setFrom('noreply@rezerwacja.onrop.pl', 'System do rezerwacji pojazdów'); // Ustanawiamy nadawcę
				$email->setTo($this->request->getVar('email')); // Pobieramy i ustanawiamy odbiorcę
				$email->setSubject('Rezerwacja pojazdu ' . $this->request->getVar('marka')); // Ustanawiamy tytuł maila
				// Ustanawiamy treść maila
				$emailContent = "Witaj, {$this->request->getVar('imie')}!<br />Udało Ci się prawidłowo wypożyczyć {$this->request->getVar('marka')} {$this->request->getVar('model')}.<br />Udaj się teraz do swojego samochodu, kluczyki już na Ciebie czekają! Rachunek otrzymasz w kolejnej wiadomości email, po zakończeniu czasu wypożyczenia samochodu. Pamiętaj - czas do końca rezerwacji to {$this->request->getVar('czas')}!<br /><br />Dziękujemy!";
				$email->setMessage($emailContent); // Podpinamy treść maila
				$email->send(); // Wysyłamy
				
				// Informujemy sesję użytkownika, że się udało
				$this->session->setFlashdata('wypozyczono', 'Samochód został wypożyczony!');
				// Przekierowanie na stronę główną aplikacji
				header("Location:https://rezerwacja.onrop.pl/");
			}
		// W przeciwnym wypadku (jeśli fałsz), to...
		// ... wyświetlenie informacji o etapie I
		}else{
			$car = $this->Samochody->find($this->request->getVar('id')); // Pobranie wszystkich informacji o konkretnym samochodzie
			$View = [ // Zmienna dla przekazania niektórych informacji do widoku
				'Title' => 'Wypożyczenie pojazdu', // Ustalany jest tytuł strony (dla znacznika <title> w widoku)
				'Samochod'	=>	$car, // Przekazanie informacji o konkretnym samochodzie do widoku
				'Czas'	=>	$this->request->getVar('czas'), // Przekazanie informacji o czasie do widoku
				'Koszt'	=>	$this->request->getVar('czas')*$car['stawka'], // Przekazanie informacji o stawce do widoku
			];
			echo view('header', $View); // Załadowanie widoku nagłówka i przekazanie tam informacji
			echo view('samochod_process', $View); // Załadowanie widoku właściwego (<body>) i przekazanie tam informacji
			echo view('footer', $View); // Załadowanie widoku stopki i przekazanie tam informacji
		}
	}
}
