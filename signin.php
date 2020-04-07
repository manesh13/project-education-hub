<?php
$con=mysqli_connect("localhost","root",'');
mysqli_select_db($con,"details");
    

session_start();
//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /* so, the form has been posted, we'll process the data in three steps:
            1.  Check the data
            2.  Let the user refill the wrong fields (if necessary)
            3.  Varify if the data is correct and return the correct response
        */
        $errors = array();
         
        //the form has been posted without errors, so save it
        //notice the use of mysqli_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $sql = "SELECT 
                *
                FROM
                    details_db
                WHERE
                    Email = '" . mysqli_real_escape_string($con, $_POST['Email']) . "'
                AND
                    Password = '" . sha1($_POST['Password']) . "'";
                     
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            echo 'Something went wrong while signing in. Please try again later.';
            echo mysqli_error($con);
        }
        else
        {
            //the query was successfully executed, there are 2 possibilities
            //1. the query returned data, the user can be signed in
            //2. the query returned an empty result set, the credentials were wrong
            if(mysqli_num_rows($result) == 0)
            {
                sleep(5);
                header("Location: login.html");
            }
            else
            {
                // Set the $_SESSION['signed_in'] variable to TRUE
                $_SESSION['signed_in'] = true;
                 
                // We also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                while($row = mysqli_fetch_assoc($result))
                {
                    $_SESSION['Id']    = $row['Id'];
                    $_SESSION['Email']    = $row['Email'];
                    $_SESSION['First_name']  = $row['First_name'];
                    $_SESSION['Last_name']  = $row['Last_name'];
                }
                // Redirect back to the original page
                $referer = $_SERVER['HTTP_REFERER'];
                header("Location: blog.html");
            }
        }
    }
}
?>