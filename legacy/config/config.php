<?php
// Database params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gcs_db');

// App Root
define('APPROOT', dirname(dirname(__FILE__)) . '/app');

// URL Root (Dynamic)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
// Defaulting to assuming localhost/G.C.S structure, can be adjusted
define('URLROOT', $protocol . "://" . $host . "/G.C.S/public");

// Site Name
define('SITENAME', 'Gestion Club Sportif');

// App Version
define('APPVERSION', '1.0.0');
