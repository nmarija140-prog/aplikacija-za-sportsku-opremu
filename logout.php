<?php
require_once 'classes/Session.php';

Session::start();
session_destroy();

header("Location: login.php");
exit();