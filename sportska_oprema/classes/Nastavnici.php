<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ICrud.php';

class Nastavnici implements ICrud {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO NASTAVNICI (ime, prezime, email, telefon, predmet) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['ime'], $data['prezime'], $data['email'], $data['telefon'], $data['predmet']);
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id) {
            $stmt = $this->db->prepare("SELECT * FROM NASTAVNICI WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } else {
            $result = $this->db->query("SELECT * FROM NASTAVNICI");
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE NASTAVNICI SET ime=?, prezime=?, email=?, telefon=?, predmet=? WHERE id=?");
        $stmt->bind_param("sssssi", $data['ime'], $data['prezime'], $data['email'], $data['telefon'], $data['predmet'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM NASTAVNICI WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}