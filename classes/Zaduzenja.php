<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ICrud.php';

class Zaduzenja implements ICrud {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO ZADUZENJA (oprema_id, nastavnik_id, datum_zaduzenja, datum_vracanja, napomena) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $data['oprema_id'], $data['nastavnik_id'], $data['datum_zaduzenja'], $data['datum_vracanja'], $data['napomena']);
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id) {
            $stmt = $this->db->prepare("SELECT z.*, o.naziv as oprema, n.ime, n.prezime 
                FROM ZADUZENJA z
                LEFT JOIN OPREMA o ON z.oprema_id = o.id
                LEFT JOIN NASTAVNICI n ON z.nastavnik_id = n.id
                WHERE z.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } else {
            $result = $this->db->query("SELECT z.*, o.naziv as oprema, n.ime, n.prezime 
                FROM ZADUZENJA z
                LEFT JOIN OPREMA o ON z.oprema_id = o.id
                LEFT JOIN NASTAVNICI n ON z.nastavnik_id = n.id");
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE ZADUZENJA SET oprema_id=?, nastavnik_id=?, datum_zaduzenja=?, datum_vracanja=?, napomena=? WHERE id=?");
        $stmt->bind_param("iisssi", $data['oprema_id'], $data['nastavnik_id'], $data['datum_zaduzenja'], $data['datum_vracanja'], $data['napomena'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM ZADUZENJA WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}