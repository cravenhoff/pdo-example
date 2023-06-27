<?php
    // Include header template
    include 'inc/header.php'; 
?>

<h4>PDO Prepared Statements</h4>

<?php    
    ### ------------------ PDO Prepared Statements (Prepare and Execute Methods) ------------------ ###

    ### Create the query: UNSAFE METHOD ---------------------------------------------------------------
    // $author = 'Crystal';
    // $sql = "SELECT * FROM posts WHERE author = '$author'"; // This opens up the application to sql-injections submitted through data entered into a form.

    ### Create the prepared statement: SAFE METHOD ----------------------------------------------------
    /* 
        There are Two Ways to Use Prepared Statements:
        1. Positional Parameters; and
        2. Named Parameters
    */

    // Fetch multiple posts using 'Positional Parameters' via Prepared Statements
    $author = 'Crystal';
    $sql = 'SELECT * FROM posts WHERE author = ?';

    // Execute the query and assign the result to $posts    
    $query = $connection->prepare($sql);
    $query->execute([$author]);
    $posts = $query->fetchAll(PDO::FETCH_OBJ);

    // Dump out posts to check that the records were retrieved
    // print_r($posts);

    // Loop through all the posts retrieved and output each one by their title
    foreach($posts as $post) {
        echo $post->title . '<br>';
    }

?>

<?php include 'inc/footer.php'; ?>