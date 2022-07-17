<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
	$db_username = "TIAS";
	$db_password = "tiger";
	$connection_string="localhost/xe";
	$conn=oci_connect($db_username, $db_password, $connection_string);

	if($conn)
	{
		if(isset($_POST['submit']))
		{
			if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['password']))
			{
				$name = $_POST['name'];
                $username = $_POST['username'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $c_id = 1;

                //generate new id
                $query = "SELECT c_id FROM customer order by c_id desc";
                $result = oci_parse($conn, $query);
                oci_execute($result);
                $row = oci_fetch_array($result, OCI_BOTH);
                $num_rows = oci_num_rows($result);
                if($num_rows == 1)
                {
                    $c_id = $row[0];
                    $c_id = $c_id + 5;
                }
                else
                {
                    $c_id = 1;
                }

                //insert into database
                $query = "INSERT INTO customer VALUES ('$c_id', '$name', '$username', '$address', '$phone', '$password', null)";
                $result = oci_parse($conn, $query);
                oci_execute($result);
                if($result)
                {
                    echo "Registration Successful!";
                }
                else
                {
                    echo "Registration Failed!";
                }
			}
			else
			{
				echo "Please fill up all the fields!";
			}

			echo "<br><br>";
		}
	}
	else
	{
		echo "Connection Failed!";
	}	
?>
        <form action="" method="POST">
            <fieldset>
                <legend>Customer Registration</legend>
                <label for="name">Name</label><br>
                <input type="text" name="name"><br><br>
                <label for="username">Username</label><br>
                <input type="text" name="username"><br><br>
                <label for="address">Address</label><br>
                <input type="text" name="address"><br><br>
                <label for="phone">Phone</label><br>
                <input type="text" name="phone"><br><br>
                <label for="password">Password</label><br>
                <input type="password" name="password"><br><br>
                <input type="submit" name="submit" id="submit-btn" value="Register">
            </fieldset>
        </form>
    </body>
</html>