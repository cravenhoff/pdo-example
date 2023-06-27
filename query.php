<?php
    // Include header template
    include 'inc/header.php'; 
?>

<a href="./">Back</a>

<h2>PDO Query</h2>

<?php    
    ### ------------------ PDO Query ------------------ ###

    /* Retrieve all records from database 'posts' table */
    // Create the query
    $query = $connection->query('SELECT * FROM posts');

    // Execute the query and assign the result to $posts
    // while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    //     echo $row['title'] . '<br>';
    // }
    
    while($row = $query->fetch()) {
        echo $row->title . '<br>';
    }

?>

<?php include 'inc/footer.php'; ?>