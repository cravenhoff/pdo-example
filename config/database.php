<?php
    /* Establish database connection */
    $host = 'localhost';
    $user = 'crys';
    $password = 'crys3000';
    $dbname = 'pdo-posts';

    // Create DSN (Data Source Name)
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    // Create new PDO instance
    $connection = new PDO($dsn, $user, $password);
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>