<?php
$con=mysqli_connect("localhost","root",'');
mysqli_select_db($con,"details");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /* We'll process the data in three steps:
        1.  Check the data
        2.  Let the user refill the wrong fields (if necessary)
        3.  Save the data 
    */
    $errors = array();

    /*if(!ctype_alnum($_POST['user_name']))
    {
        $errors[] = 'The username can only contain letters and digits.';
    }
    if(strlen($_POST['user_name']) > 30)
    {
        $errors[] = 'The username cannot be longer than 30 characters.';
    }

    if($_POST['user_pass'] != $_POST['user_pass_check'])
    {
        $errors[] = 'The two passwords did not match.';
    }*/
     
    if(!empty($errors))
    {
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
    }
    else
    {
        //the form has been posted without, so save it
        //notice the use of mysql_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $sql = "INSERT INTO details_db(First_name,Last_name, Password, Email)
                VALUES('" . mysqli_real_escape_string($con, $_POST['First_name']) . "',
                       '" . mysqli_real_escape_string($con, $_POST['Last_name']) . "',
                       '" . sha1($_POST['Password']) . "',
                       '" . mysqli_real_escape_string($con, $_POST['Email']) . "'
                        )";
                         
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            echo 'Something went wrong while registering. Please try again later.';
            echo mysqli_error($con);
        }
        else
        {
            // Set the $_SESSION['signed_in'] variable to TRUE
            $_SESSION['signed_in'] = true;
            $_SESSION['Id']    = $row['Id'];
            $_SESSION['First_name']  = $row['First_name'];
            $_SESSION['Last_name']  = $row['Last_name'];
            // Redirect back to the original page
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: login.html");
        }
    }
}

mysqli_close($con);
?>
