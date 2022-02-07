<?php 
require "config.php";
   

if ( !isset($_POST['title']) || empty($_POST['title']) 
|| !isset($_POST['salary']) || empty($_POST['salary']) 
|| !isset($_POST['company']) || empty($_POST['company'])   
|| !isset($_POST['contact']) || empty($_POST['contact']) 
|| !isset($_POST['role']) || empty($_POST['role'])        
) {

    $error = "Please fill out the required information.";
}
else {

    // Connect to the db
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ( $mysqli->connect_errno ) {
        echo $mysqli->connect_error;
        exit();
    }

    



    $statement = $mysqli->prepare("INSERT INTO jobs (title, salary, contact, roles_id, companies_id)
     VALUES(?,?, ?, ?, ?);");

    $statement->bind_param("sisii", $_POST['title'], $_POST['salary'], $_POST['contact'], $_POST['role'], $_POST['company']);

    

    $executed = $statement->execute();



    if(!$executed) {
        echo $mysqli->error;
    }

    $statement->close();
    $mysqli->close();
}
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add confirmation.</title>
    <link rel = "shortcut icon" type = "image/png" href = "logo.png">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
<body>
<div class = "header">
        <button onclick="location.href='home.html';" type="button" id = "button-home">home</button>
        <button onclick="location.href='search.php';" type="button" id = "button-search">search</button>
        <button onclick="location.href='add.php';" type="button" id = "button-add" class = "active" >add</button>
        <button onclick="location.href='web3.html';" type="button" id = "button-delete">web3</button>
    </div>   
    
    <div class = "container">
        <div class = "typewriter">
            <?php if ( isset($error) && !empty($error) ) : ?>
                                        <div style = "color: white">
                                            <?php echo $error; ?>
                                        </div>
                    <?php else : ?> 
                        <h1 id = "welcome-text">job successfully added.</h1>
            <?php endif; ?>
            
            
            
        </div>
    </div>

   
    <script>
    </script>
</body>


