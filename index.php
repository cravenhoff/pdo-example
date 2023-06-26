<?php
    // Include database config file
    include 'config/database.php';

    ### ------------------ PDO Query ------------------ ###

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