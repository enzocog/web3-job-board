<?php 

require "config.php";



$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

$sql = "SELECT title as Title, salary as Salary, companies.company as Company, roles.roles as Role, contact as Contact, jobs.id
FROM jobs
LEFT JOIN companies
    ON companies.id = jobs.companies_id
LEFT JOIN roles
    ON roles.id = jobs.roles_id
WHERE 1=1";

if ( isset($_GET['company']) && !empty($_GET['company']) ) {
	$sql = $sql . " AND companies.company LIKE '%" . $_GET['company'] . "%'";
}

if ( isset($_GET['title']) && !empty($_GET['title']) ) {
	$sql = $sql . " AND jobs.title = " . $_GET['title'];
}

if ( isset($_GET['role']) && !empty($_GET['role']) ) {
	$sql = $sql . " AND roles.roles = " . $_GET['role'];
}

if ( isset($_GET['salary']) && !empty($_GET['salary']) ) {
	$sql = $sql . " AND jobs.salary = " . $_GET['salary'];
}


$sql = $sql . ";";




$results = $mysqli->query($sql);

if ( $results == false ) {
	echo $mysqli->error;
	exit();
}

// Close DB Connection.
$mysqli->close();


?>


<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search results</title>
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
            <h1 id = "search-results-text">here's what i found</h1>
        </div>

        <div id = "search-results-box">
            <div class = "search-results-row">
                
                <table>
                    <thead>
                        <tr>
                            

                            <th>
                                Title
                            </th>
                            <th>
                                Salary
                            </th>
                            <th>
                                Company
                            </th>
                            <th>
                                Role
                            </th>
                            <th>
                                Contact
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class = "table-row">
                    <?php while ( $row = $results->fetch_assoc() ) : ?>
                        <tr>
                        
                        </td>
                        <td>
                            <a href="details.php?id=<?php echo $row['id']; ?>">
				                 <?php echo $row['Title']; ?>
			                </a>
                        </td>
                                    <td> <?php echo $row['Salary']; ?></td>
                                    <td> <?php echo $row['Company']; ?></td>
                                    <td> <?php echo $row['Role']; ?></td>
                                    <td> <?php echo $row['Contact']; ?></td>
                        <td>
                        <a onclick="return confirm('Are you sure you want to delete this listing?')" href="delete.php?id=<?php echo $row['id'];?>&title=<?php echo $row['Title'];?>">
				            Delete
			            </a>
                        </tr>
                <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
            
        </div>

        
        <a href="search.php">Back to Form</a>
    </div>
    

    <script>
    </script>
</body>


