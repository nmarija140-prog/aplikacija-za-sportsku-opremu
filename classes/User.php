<?php
require_once __DIR__ .'/Database.php';
class User {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }
    public function register ($ime, $prezime, $email, $lozinka, $uloga = 'nastavnik'){
    $lozinka_hash = password_hash($lozinka, PASSWORD_DEFAULT);
    $stmt = $this->db->prepare("INSERT INTO korisnici (ime, prezime, email, lozinka, uloga") VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $ime, $prezime, $email, $lozinka_hash, $uloga);
    return $stmt->execute();}
}
    public function login($email, $lozinka) {
        $stmt = $this->db->prepare("SELECT * FROM
        KORISNICI WHERE email =?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $korisnik = $result();
        if($korisnik&&password_verify($lozinka, $korisnik
        ['lozinka'])){
        return $korisnik;
        }
        return false;
    }
        public funtion emailPostoji ($email){
        $stmt = $this->db->prepare("SELECT id FROM KORISNICI WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows>0;
        }
        }
