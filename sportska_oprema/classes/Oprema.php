<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ICrud.php';

class Oprema implements ICrud {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO OPREMA (naziv, tip, kolicina, stanje, prostorija_id, datum_nabavke) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $data['naziv'], $data['tip'], $data['kolicina'], $data['stanje'], $data['prostorija_id'], $data['datum_nabavke']);
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id) {
            $stmt = $this->db->prepare("SELECT o.*, p.naziv as prostorija 
                FROM OPREMA o 
                LEFT JOIN PROSTORIJE p ON o.prostorija_id = p.id 
                WHERE o.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } else {
            $result = $this->db->query("SELECT o.*, p.naziv as prostorija 
                FROM OPREMA o 
                LEFT JOIN PROSTORIJE p ON o.prostorija_id = p.id");
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE OPREMA SET naziv=?, tip=?, kolicina=?, stanje=?, prostorija_id=?, datum_nabavke=? WHERE id=?");
        $stmt->bind_param("ssisssi", $data['naziv'], $data['tip'], $data['kolicina'], $data['stanje'], $data['prostorija_id'], $data['datum_nabavke'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM OPREMA WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}