<?php
    // Include header template
    include 'inc/header.php'; 
?>

<a href="./">Back</a>

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
    // $posts = $query->fetchAll();

    // Dump out posts to check that the records were retrieved
    // print_r($posts);

    // Fetch multiple posts using 'Named Parameters' via Prepared Statements
    $author = 'Crystal';
    $is_published = true;
    $limit = 2;
    $sql = 'SELECT * FROM posts WHERE author = ? && is_published = ? LIMIT ?';

    // Execute the sql statement and assign the result to $posts    
    $query = $connection->prepare($sql);
    $query->execute([$author, $is_published, $limit]);
    $posts = $query->fetchAll();

    echo '<h3>Fetching All Records</h3>';

    // Loop through all the posts retrieved and output each one by their title
    foreach($posts as $post) {
        echo $post->title . '<br>';
    }

    echo '<h3>Fetching Single Record</h3>';

    // Fetch a single post record using 'Named Parameters' via Prepared Statements
    $id = 10;
    $sqlStmt = 'SELECT * FROM posts WHERE id = :id';

    // Execute the sql statement
    $stmt = $connection->prepare($sqlStmt);
    $stmt->execute(['id' => $id]);
    
    // Store retrieved record
    $post = $stmt->fetch();

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
    $title = 'Post Nine';
    $body = 'This is post nine.';
    $author = 'Crystal';

    $sqlCheck = 'SELECT * FROM posts WHERE title = ?';
    $checkStmt = $connection->prepare($sqlCheck);
    $checkStmt->execute([$title]);
    $postCheck = $checkStmt->fetch();

    // var_dump($postCheck);

    if(!$postCheck) {
        $sqlInsert = 'INSERT INTO posts (title, body, author) VALUES (:title, :body, :author)';
        $sqlStmt = $connection->prepare($sqlInsert);
        $sqlStmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);

        echo 'Insert Successful: New Record Added.';
    } else {
        echo 'Post Registered.';
    }

    echo '<h3>Update Data</h3>';

    // Update a specific post record
    $postId = $postCheck->id;
    $updatedBody = 'This is the ninth post.';

    if($postCheck) {
        $sqlUpdate = 'UPDATE posts SET body = :body WHERE id = :id';
        $updateStmt = $connection->prepare($sqlUpdate);
        $updateStmt->execute(['body' => $updatedBody, 'id' => $postId]);

        echo 'Post Successfully Updated.';
    } else {
        echo 'Sorry, Cannot Update Non-Existent Post.';
    }

    echo '<h3>Delete Data</h3>';

    // Delete a specific post record
    $postDeleteId = 4;

    $postTwoSql = $connection->prepare('SELECT * FROM posts WHERE id = ?');
    $postTwoSql->execute([$postDeleteId]);
    $post2 = $postTwoSql->fetch();

    if($post2) {
        $sqlDelete = 'DELETE FROM posts WHERE id = :id';
        $deleteStmt = $connection->prepare($sqlDelete);
        $deleteStmt->execute(['id' => $postDeleteId]);

        echo 'Post Successfully Deleted.';
    } else {
        echo 'Sorry, Cannot Delete Non-Exist Post.';
    }

    echo '<h3>Search Data</h3>';

    // Search for a specific keyboard in the database records
    $keyword = '%n%';

    $searchSql = 'SELECT * FROM posts WHERE title LIKE ?';
    $searchStmt = $connection->prepare($searchSql);
    $searchStmt->execute([$keyword]);
    $postsMatch = $searchStmt->fetchAll();

    foreach($postsMatch as $postMatch) {
        echo $postMatch->title . '<br>';
    }

?>

<?php include 'inc/footer.php'; ?>