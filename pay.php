<?php
$con=mysqli_connect("localhost","root",'');
mysqli_select_db($con,"details");

$sql = "SELECT link 
            FROM pdf 
			WHERE id = ". $_POST['id'];
     
    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'ERROR: ' . mysqli_error($con);
    }
    else
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
            header("Location: ".$row['link']);
    	}
    }
?>