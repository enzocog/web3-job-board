<?php 

require "config.php";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

//get the role ids
$sql = "SELECT * FROM roles;";
$results = $mysqli -> query($sql);
if ($results == false) {
    echo $mysqli -> error;
    exit();
}

$sql_companies = "SELECT * FROM companies;";
$companies_results = $mysqli -> query($sql_companies);
if ($companies_results == false) {
    echo $mysqli -> error;
    exit();
}
 

$mysqli->close();



?>


<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel = "shortcut icon" type = "image/png" href = "logo.png">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        
        </style>

<body>
     
<div class = "header">
        <button onclick="location.href='home.html';" type="button" id = "button-home">home</button>
        <button onclick="location.href='search.php';" type="button" id = "button-search">search</button>
        <button onclick="location.href='add.php';" type="button" id = "button-add" class = "active" >add</button>
        <button onclick="location.href='web3.html';" type="button" id = "button-delete">web3</button>
    </div>   

    <div class = "container" id = "search-container">
        <div class = "typewriter">
            <h1 id = "welcome-text"><span id = "contribute-text">contribute</span> to web3</h1>
        </div>
+
        <div id = "search-box">
            <form name = "add-form" action = "add-confirmation.php" onsubmit = "return validateForm()" method = "POST">

                <div id = "company-search">
                    <label for= "company-id">Company*:</label>
                   
                    
                    <select name="company" id="company-id" class="form-control">
                        <option value="" disabled selected>-- Select One --</option>
                        <?php while ( $row = $companies_results->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['company']; ?>
							</option>
						<?php endwhile; ?>
                    </select>                
                </div>

                <div id = "title-search">
                    <label for= "title-id">Title*:</label>
                    <input type = "text" class = "form-control" id = "title-id" name = "title">
                </div>

                <div id = "salary-search">
                    <label for= "salary-id">Salary*:</label>
                    <input type = "number" class = "form-control" id = "salary-id" name = "salary">
                </div>

                <div id = "role-search">
                    <label for= "role-id">Role*:</label>
                    <select name="role" id="role-id" class="form-control">
                        <option value="" disabled selected>-- Select One --</option>
                        <?php while ( $row = $results->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['roles']; ?>
							</option>
						<?php endwhile; ?>
                    </select>
                </div>

                <div id = "contact-search">
                    <label for= "contact-id">Contact*:</label>
                    <input type = "text" class = "form-control" id = "contact-id" name = "contact">
                </div>

                


                <button type="submit" id = "submit-button">Submit</button>
				<button type="reset" id = "reset-button">Reset</button>
            </form>
            
        </div>
       
    </div>
    

    <script>
        function validateForm() {
            let company = document.forms["add-form"]["company"].value;
            let title = document.forms["add-form"]["title"].value;
            let salary = document.forms["add-form"]["salary"].value;
            let role = document.forms["add-form"]["role"].value;
            let contact = document.forms["add-form"]["contact"].value;

            if (company == "") {
                alert("Company must be filled out");
                return false;
            }
            else if (title == "") {
                alert("title must be filled out");
                return false;
            }
            else if (salary == "") {
                alert("salary must be filled out");
                return false;
            }
            else if (contact == "") {
                alert("contact must be filled out");
                return false;
            }
            else if (role == "") {
                alert("role must be filled out");
                return false;
            }
        }
    </script>
</body>


