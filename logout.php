<?php
// Initialiser la session
session_start();
session_destroy();
header("Location: index.php");

