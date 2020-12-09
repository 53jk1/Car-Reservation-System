<?php namespace App\Models;

use CodeIgniter\Model;

class SamochodyModel extends Model {
    protected $table      = 'samochody';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
	    'marka', 'model', 'produkcja', 'stawka', 'status', 'miejsce_krotko', 'miejsce_dokladne', 'obrazek',
    ];
}