<?php
$con=mysqli_connect("localhost","root",'');
mysqli_select_db($con,"details");

$PASSWORD= sha1($_POST['Password']);

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
    			$man ="UPDATE
						details_db
				 	SET  
						Password ='".$PASSWORD."'
					WHERE
						Email = '".$_POST['Email']."'" ;
						mysqli_query($con, $man);
    			echo "Password reseted successfully! <a href='login.html'>Click here to login.</a> ";
    		}
    	}
    }
?>