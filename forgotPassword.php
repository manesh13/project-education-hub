<?php
$con=mysqli_connect("localhost","root",'');
mysqli_select_db($con,"details");

$sql = "SELECT Email 
            FROM details_db"; 
			
     
    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'ERROR: ' . mysqli_error($con);
    }
    else
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
    		if ($_POST['Email'] == $row['Email']) 
    		{
    			header("Location: resetpassword.html");
    		}
    		else
    		{
    			echo "No account exist with this email. <a href='forgotpassword.html'>Click here to try again.</a>";
    		}
    	}
    }
?>