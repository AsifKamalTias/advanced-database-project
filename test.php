<?php
	$db_username = "TIAS";
	$db_password = "tiger";
	$connection_string="localhost/xe";
	$conn=oci_connect($db_username, $db_password, $connection_string);

	if($conn)
    {
        $query = "SELECT c_id FROM customer order by c_id desc";
        $result = oci_parse($conn, $query);
        oci_execute($result);
        $row = oci_fetch_array($result, OCI_BOTH);
        $num_rows = oci_num_rows($result);
        if($num_rows == 1)
        {
            $c_id = $row[0];
            $c_id = $c_id + 5;
            echo "Your customer ID is: " . $c_id;
        }
        else
        {
            echo "No customer found!";
        }
    }
    else
    {
        echo "Connection Failed!";
    }