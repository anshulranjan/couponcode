<?php
$con=mysqli_connect("localhost","root","") or die(mysqli_error($con));
mysqli_select_db($con,"coupon") or die(mysqli_error($con));
$aa="Reademed";
session_start();
$acode=$_SESSION['status'];
$qq="UPDATE offer SET status='$aa' WHERE ccode='$acode'";
$rr1=mysqli_query($con,$qq) or die(mysqli_error());
if($rr1)
{
    ?>
    <script>
    alert("Coupon Code Successfully Reademed");
    window.location.href='viewcode.html';
    </script>
    <?php
}
else
{
    ?>
    <script>
    alert("Can't Reademed Now. Try again");
    window.location.href='viewcode.html';
    </script>
    <?php
}
?>
