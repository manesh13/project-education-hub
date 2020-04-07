<?php
$con=mysqli_connect("localhost","root",'');
mysqli_select_db($con,"details");

$sql = "SELECT *
            FROM details_db
            WHERE Email ='".mysqli_real_escape_string($con, $_POST['Email'])."'" ; 
			
     
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
    			$man ="DELETE FROM
						details_db
					WHERE
						Email = '".$_POST['Email']."'" ;
						mysqli_query($con, $man);
    			echo "Account deleted successfully! <a href='login.html'><a href='signout.php'>Click here to go to home page.</a></a> ";
    		}
    	}
    }
?>