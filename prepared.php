<?php
    // Include header template
    include 'inc/header.php'; 
?>

<h2>PDO Prepared Statements</h2>

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
    $author = 'Carl';
    $is_published = true;
    $sql = 'SELECT * FROM posts WHERE author = :author && is_published = :is_published';

    // Execute the sql statement and assign the result to $posts    
    $query = $connection->prepare($sql);
    $query->execute(['author' => $author, 'is_published' => $is_published]);
    $posts = $query->fetchAll(PDO::FETCH_OBJ);

    echo '<h3>Fetching All Records</h3>';

    // Loop through all the posts retrieved and output each one by their title
    foreach($posts as $post) {
        echo $post->title . '<br>';
    }

    echo '<h3>Fetching Single Record</h3>';

    // Fetch a single post record using 'Named Parameters' via Prepared Statements
    $id = 2;
    $sqlStmt = 'SELECT * FROM posts WHERE id = :id';

    // Execute the sql statement
    $stmt = $connection->prepare($sqlStmt);
    $stmt->execute(['id' => $id]);
    
    // Store retrieved record
    $post = $stmt->fetch(PDO::FETCH_OBJ);

    // Check that the post was retrieved
    // print_r($post);

    // Output retrieved post
    echo '<strong>' . $post->title . '</strong>' . '<br>' . $post->body;

    echo '<h3>Row Count</h3>';

    // Count the number of rows that belong to a specific author
    $rowStmt = $connection->prepare('SELECT * FROM posts WHERE author = ?');
    $rowStmt->execute([$author]);
    $postCount = $rowStmt->rowCount();

    echo 'Author ' . $author . ' has a total of ' . $postCount . ' row(s), also known as records.';

    echo '<h3>Insert Data</h3>';

    // Add a new post record to the database using the SQL INSERT statement
    $title = 'Post Seven';
    $body = 'This is post the seventh post, or post number seven.';
    $author = 'Carl';

    $sqlCheck = 'SELECT * FROM posts WHERE title = ?';
    $checkStmt = $connection->prepare($sqlCheck);
    $checkStmt->execute([$title]);
    $postCheck = $checkStmt->fetch(PDO::FETCH_OBJ);

    // var_dump($postCheck);

    if(!$postCheck) {
        $sqlInsert = 'INSERT INTO posts (title, body, author) VALUES (:title, :body, :author)';
        $sqlStmt = $connection->prepare($sqlInsert);
        $sqlStmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);

        echo 'Insert Successful: New Record Added.';
    } else {
        echo 'Post Registered.';
    }
?>

<p><a href="./">Back</a></p>

<?php include 'inc/footer.php'; ?>