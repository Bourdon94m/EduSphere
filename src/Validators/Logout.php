<?php

session_start();

unset($_SESSION['user_id']);

// Détruis les données de la session
session_destroy();

// Redirect to index
header('Location: /EduSphere/src/index.php');
exit();
