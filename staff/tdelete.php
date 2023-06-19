<?php

include ("../connection.php"); // Using database connection file here
?>


<html>
    <head>
        <?php

echo '<script type="text/javascript"> alert("JavaScript Alert Box by PHP")</script>';  //not showing an alert box.
?>
</head>
</html>

<?php

$tracking_id = $_GET['tracking_id']; // get id through query string
echo $tracking_id;
$del = mysqli_query($connect," DELETE from `tracking` where tracking_id = '$tracking_id'"); // delete query


$booking_id = $_GET['booking_id'];
$delete = mysqli_query($connect,"DELETE FROM `usercourier` WHERE booking_id = '$booking_id'");

if($del)
{
    mysqli_close($connect); // Close connection
    header("location:tracking-request.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}

if($delete)
{
    mysqli_close($connect);
    header("location:accept-user-courier.php");
    exit;
}
else
{
 echo "error in deleteing ";
}
?>