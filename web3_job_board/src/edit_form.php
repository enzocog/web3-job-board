<?php
require "config.php";




if(!isset($_GET["id"]) || empty($_GET["id"])) {
	echo "Invalid job ID";
	exit();
}


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

// -- Get details of this job
$sql = "SELECT * FROM jobs
WHERE id =" . $_GET["id"] . ";";

// Query the db!
$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}

// Only getting one result back, so no need for while loop
$row = $results->fetch_assoc();


$sql_roles = "SELECT * FROM roles;";
$results_roles = $mysqli->query($sql_roles);
if ( $results_roles == false ) {
	echo $mysqli->error;
	exit();
}


// Close DB Connection
$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
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

    <div class = "container" id = "search-container">
        <div class = "typewriter">
            <h1 id = "welcome-text">edit</h1>
        </div>

        <div id = "search-box">
            <form name = "edit-form" onsubmit = "return validateForm()" action = "edit_confirmation.php?" method = "POST">

               

                <div id = "title-search">
                    <label for= "title-id">Title*:</label>
                    <input type = "text" class = "form-control" id = "title-id" name = "title">
                </div>

                <div id = "salary-search">
                    <label for= "salary-id">Salary:</label>
                    <input type = "number" class = "form-control" id = "salary-id" name = "salary">
                </div>

                

                <div id = "contact-search">
                    <label for= "contact-id">Contact:</label>
                    <input type = "text" class = "form-control" id = "contact-id" name = "contact">
                </div>

                <div id = "role-search">
                    <label for= "role-id">Role:</label>
                    <select name="role" id="role-id" class="form-control">
                        <option value="" disabled selected>-- Select One --</option>

                        <?php while ( $results_row = $results_roles->fetch_assoc() ) : ?>
							<option value="<?php echo $results_row['id']; ?>">
								<?php echo $results_row['roles']; ?>
							</option>
						<?php endwhile; ?>

                    </select>
                </div>
            

                <button type="submit" id = "submit-button">Submit</button>
				<button type="reset" id = "reset-button">Reset</button>
                <input type="hidden" name="id" value="<?php echo $row['id']?>">
            </form>
            
        </div>
       
    </div>
    

    <script>
        function validateForm() {
           
           let title = document.forms["edit-form"]["title"].value;

           if (title == "") {
               alert("Must input a title");
               return false;
           }
       }
    </script>
</body>