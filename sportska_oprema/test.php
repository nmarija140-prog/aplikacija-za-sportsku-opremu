<?php
require_once 'classes/Database.php';

$db = Database::getInstance()->getConnection();

if ($db) {
    echo "Konekcija na bazu uspesna! ✅";
} else {
    echo "Greška pri konekciji! ❌";
}