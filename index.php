<?php
    /* Establish database connection */
    // Create constants to store the database credentials
    $host = 'localhost';
    $user = 'crys';
    $password = 'crys3000';
    $dbname = 'pdo-posts';

    // Create DSN (Data Source Name)
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    // Create new PDO instance
    $connection = new PDO($dsn, $user, $password);
    
    /* Retrieve all records from database 'posts' table */
    // Create the query
    $query = $connection->query('SELECT * FROM posts');

    // Execute the query and assign the result to $posts
    // while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    //     echo $row['title'] . '<br>';
    // }
    
    while($row = $query->fetch(PDO::FETCH_OBJ)) {
        echo $row->title . '<br>';
    }


?>