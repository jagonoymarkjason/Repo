
<?php
if(ISSET($_POST['submit'])){
	$title = $_POST['title'];
	$pages = $_POST['pages'];
	$author = $_POST['author'];
	$publised_year = $_POST['published_year'];
	$conn = new mysqli("localhost", "root", "", "book") or die(mysqli_error());
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$q1 = $conn->query ("SELECT * FROM `books` WHERE `title` = '$title'") or die(mysqli_error());
	$f1 = $q1->fetch_array();
	$check = $q1->num_rows;
	if($check > 0){
		echo "<script> alert ('Book already exist!')</script>";
		echo "<script>document.location='index.php'</script>";
	}
	else {
		$conn->query("INSERT INTO `books` VALUES('', '$title', '$pages', '$author', '$published_year')") or die(mysqli_error());
		$conn->close();
		echo "<script type='text/javascript'>alert('Successfully added new book!');</script>";
		echo "<script>document.location='addbook.php'</script>";  
	}
}

?>
<html>

<head>
	<title>Book Information</title>
    <link href="assets/css/reg.css" rel="stylesheet">
</head>

<body>
	<form action="" method="post">
	<h1>Library Database</h1>
	<fieldset>
		<legend>Book Information</legend>
		<label>Title:</label> <input type="text" name="title" required/><br />
		<label>Pages:</label> <input type="number" min=1 name="pages" required/><br />
		<label>Author:</label> <input type="text" name="author" required/><br />
		<label>Published Year:</label> <input type="text" name="published_year" required/>
        <div><br/></div>
    <input style="float:right" type="submit" value="Add Book" name="submit"/>
    </fieldset>
    <h3>List of Stored Books</h3>
    <table border="2" align="center" cellpadding=5>
            <thead>
                <tr><th>Title</th>
                    <th>Pages</th>
                    <th>Author</th>
                    <th>Published Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
							$conn = new mysqli("localhost", "root", "", "book") or die(mysqli_error());
							$query = $conn->query("SELECT * FROM `books` ORDER BY `id` DESC") or die(mysqli_error());
							while($row = $query->fetch_array()){
							?>
							<tr>
								<td><center><?php echo $row['title']?></center></td>
								<td><center><?php echo $row['pages']?></center></td>
								<td><center><?php echo $row['author']?></center></td>
								<td><center><?php echo $row['publishyear']?></center></td>
								<td><center>
									<a >Delete</a>
									</center>
								</td>
							</tr>
							<?php
							}
							$conn->close();
							?>
            
                </tbody>
        </table>
	</form>

</body>
</html>