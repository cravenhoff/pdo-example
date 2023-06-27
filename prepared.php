<?php
    // Include header template
    include 'inc/header.php'; 
?>

<h3>PDO Prepared Statements</h3>

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
    // $author = 'Crystal';
    // $sql = 'SELECT * FROM posts WHERE author = ?';

    // Execute the query and assign the result to $posts    
    // $query = $connection->prepare($sql);
    // $query->execute([$author]);
    // $posts = $query->fetchAll(PDO::FETCH_OBJ);

    // Dump out posts to check that the records were retrieved
    // print_r($posts);

    // Fetch multiple posts using 'Named Parameters' via Prepared Statements
    $author = 'Crystal';
    $is_published = true;
    $sql = 'SELECT * FROM posts WHERE author = :author && is_published = :is_published';

    // Execute the sql statement and assign the result to $posts    
    $query = $connection->prepare($sql);
    $query->execute(['author' => $author, 'is_published' => $is_published]);
    $posts = $query->fetchAll(PDO::FETCH_OBJ);

    echo '<h4>Fetching All Records</h4>';

    // Loop through all the posts retrieved and output each one by their title
    foreach($posts as $post) {
        echo $post->title . '<br>';
    }

    echo '<h4>Fetching Single Record</h4>';

    // Fetch a single post record using 'Named Parameters' via Prepared Statements
    $id = 1;
    $sqlStmt = 'SELECT * FROM posts WHERE id = :id';

    // Execute the sql statement
    $stmt = $connection->prepare($sqlStmt);
    $stmt->execute(['id' => $id]);
    
    // Store retrieved record
    $post = $stmt->fetch();

    // Check that the post was retrieved
    print_r($post);

?>

<p><a href="./">Back</a></p>

<?php include 'inc/footer.php'; ?>