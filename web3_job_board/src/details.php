<?php 

require "config.php";

if ( !isset($_GET['id']) || empty($_GET['id']) ) {
	$error = "Invalid Job ID.";
} 

else {

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

$sql = "SELECT title as Title, salary as Salary, companies.company as Company, roles.roles as Role, contact as Contact
 FROM jobs 
 LEFT JOIN companies 
    ON companies.id = jobs.companies_id 
LEFT JOIN roles
ON roles.id = jobs.roles_id 
WHERE jobs.id =" . $_GET['id'] . ";";

$results = $mysqli->query($sql);

if ( $results == false ) {
	echo $mysqli->error;
	exit();
}

$row = $results->fetch_assoc();

// Close DB Connection.
$mysqli->close();
}
?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome.</title>
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
            <h1 id = "search-results-text">here's the fine print</h1>
        </div>
    
        <div id = "search-results-box">
            
				<?php if ( isset($error) && !empty($error) ) : ?>

					<div class="text-danger">
						<?php echo $error; ?>
					</div>

				<?php else : ?>

            <div class = "search-results-row">
                
                <table>
                        <tr>
                            <th>
                                Title
                            </th>
                            <td><?php echo $row['Title'];?></td>
                        </tr>
                        <tr>   
                            <th>
                                Salary
                            </th>
                            <td><?php echo $row['Salary'];?></td>   
                        </tr>
                        <tr>
                            <th>
                                Company
                            </th>
                            <td><?php echo $row['Company'];?></td>  
                        </tr>
                        <tr>
                            <th>
                                Role
                            </th>
                            <td><?php echo $row['Salary'];?></td>
                        </tr> 
                        <tr>  
                            <th>
                                Contact
                            </th>
                            <td><?php echo $row['Contact'];?></td>  
                        </tr>
                        <tr>
                            <th>Edit </th>
                        <td><a href = "edit_form.php?id=<?php echo $_GET['id'];?>" class = "edit-link">Click me!</a> </td>
                </table>
                <?php endif; ?>
            </div>
            
        </div>

        <a href="search-results.php">Back to Search Results</a>
        
    </div>


</body>
</html>