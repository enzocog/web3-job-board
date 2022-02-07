<?php
require "config.php";

$isDeleted = false;

// Make sure that the track_id is provided on this page
if ( !isset($_GET['id']) || empty($_GET['id']) 
		|| !isset($_GET['id']) || empty($_GET['id']) ) {
	$error = "Invalid job.";
}
else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	
	// prepared statement way
	$statement = $mysqli->prepare("DELETE FROM jobs WHERE id = ?");
	$statement->bind_param("i", $_GET["id"]);
	$executed = $statement->execute();

	if(!$executed) {
		echo $mysqli->error;
		exit();
	}
	if($statement->affected_rows == 1) {
		$isDeleted = true;
	}
	$statement->close();
	$mysqli->close();
}

?>


<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
    <link rel = "shortcut icon" type = "image/png" href = "logo.png">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        
        </style>

<body>
<div class = "header">
        <button onclick="location.href='home.html';" type="button" id = "button-home">home</button>
        <button onclick="location.href='search.php';" type="button" id = "button-search"  class = "active">search</button>
        <button onclick="location.href='add.php';" type="button" id = "button-add" >add</button>
        <button onclick="location.href='web3.html';" type="button" id = "button-delete">web3</button>
    </div>   
    
	
				

    <div class = "container">
		
        <div class = "typewriter">
						<?php if ( isset($error) && !empty($error) ) : ?>
									<div class="text-danger">
										<?php echo $error; ?>
									</div>
					<?php endif; ?>

            <h1 id = "welcome-text"><?php if ( $isDeleted ) :?>
					<?php echo $_GET['title'] ;?></span> was successfully deleted.</div>
				<?php endif; ?></h1>
			
            
        </div>
		<a href ="search-results.php"> return back to search results </a>
    </div>

   
    <script>
    </script>
</body>


