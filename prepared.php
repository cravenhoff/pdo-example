<?php
    // Include header template
    include 'inc/header.php'; 
?>

<h4>PDO Prepared Statements</h4>

<?php    
    ### ------------------ PDO Prepared Statements (Prepare and Execute Methods) ------------------ ###

    /* Retrieve all records from database 'posts' table */
    // Create the query: UNSAFE METHOD
    $sql = "SELECT * FROM posts WHERE author = '$author'"; // This opens up the application to sql-injections submitted through data entered into a form.

    // Execute the query and assign the result to $posts    
    
    // Include footer template
    include 'inc/footer.php';

?>