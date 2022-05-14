<?php

// Informations d'identification
const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'reservesandwich';
const CHARSET = 'utf8mb4';
const PORT = '3306';

const OPTIONS = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
const DB_CREDENTIALS = "mysql:host=".DB_SERVER.";
        dbname=".DB_NAME.";
        charset=".CHARSET.";
        port=".PORT;

session_start();
