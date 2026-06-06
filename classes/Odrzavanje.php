<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ICrud.php';

class Odrzavanje implements ICrud {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO ODRZAVANJE (oprema_id, datum_prepravke, opis_rada, troskovi, serviser) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issds", $data['oprema_id'], $data['datum_prepravke'], $data['opis_rada'], $data['troskovi'], $data['serviser']);
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id) {
            $stmt = $this->db->prepare("SELECT od.*, o.naziv as OPREMA 
                FROM ODRZAVANJE od
                LEFT JOIN OPREMA o ON od.oprema_id = o.id
                WHERE od.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } else {
            $result = $this->db->query("SELECT od.*, o.naziv as OPREMA 
                FROM ODRZAVANJE od
                LEFT JOIN OPREMA o ON od.oprema_id = o.id");
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE ODRZAVANJE SET oprema_id=?, datum_prepravke=?, opis_rada=?, troskovi=?, serviser=? WHERE id=?");
        $stmt->bind_param("issdsi", $data['oprema_id'], $data['datum_prepravke'], $data['opis_rada'], $data['troskovi'], $data['serviser'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM ODRZAVANJE WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}