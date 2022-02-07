<?php
require "config.php";
   
	$isUpdated = false;

	if ( !isset($_POST['title']) || empty($_POST['title']) 
		) {

		$error = "Please fill out the title.";
	}
	else {

		// Connect to the db
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		// Cover optional field
		if ( isset($_POST['contact']) && !empty($_POST['contact']) ) {
			$contact = $_POST['contact'];
		} else {
			$contact= "null";
		}

        // Cover optional field
		if ( isset($_POST['salary']) && !empty($_POST['salary']) ) {
			$salary = $_POST['salary'];
		} else {
			$salary= "null";
		}

        if ( isset($_POST['role']) && !empty($_POST['role']) ) {
			$role = $_POST['role'];
		} else {
			$role = "null";
		}


        


	
		$statement = $mysqli->prepare("UPDATE jobs SET title = ?, salary = ?, contact = ?, roles_id = ?
         WHERE id = ?");

		$statement->bind_param("sisii", $_POST['title'], $salary, $contact, $role, $_POST['id']);

		$executed = $statement->execute();
	
		if(!$executed) {
			echo $mysqli->error;
		}

		if($statement->affected_rows == 1) {
			$isUpdated = true;
		}

		$statement->close();
		$mysqli->close();
	}
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit.</title>
    <link rel = "shortcut icon" type = "image/png" href = "logo.png">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .container {
            color: white;
        }
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

            <h1 id = "welcome-text"><?php if ( $isUpdated ) :?>
					<?php echo $_POST['title'] ;?></span> was successfully updated.</div>
				<?php endif; ?></h1>
			
            <a href ="details.php?id=<?php echo $_POST['id'];?>"><h2>return back to job </h2></a>
        </div>
		
    </div>

   
    <script>
    </script>
</body>

