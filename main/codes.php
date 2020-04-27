<html>
<head>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Coupon Generate View</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="shortcut icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
  <script type="text/javascript" src="js/switchery.min.js"></script>
</head>
<?php
$name=$_GET['name'];
$id=$_GET['order'];
$contact=$_GET['phone'];
$email=$_GET['email'];
$amount=$_GET['amount'];
$rn=$_GET['restaurant'];
$date=$_GET['date'];
$con=mysqli_connect("localhost","root","") or die(mysqli_error($con));
mysqli_select_db($con,"coupon") or die(mysqli_error($con));
$r1=mysqli_query($con,"Select * from details") or die(mysqli_error());
while($row=mysqli_fetch_assoc($r1))
{
    if($row['oid']==$id)
    {
        ?>
        <script>
        alert("Coupon Code already created for this Order Id");
        window.location.href='index.html';
        </script>
        <?php
    }
}
$off=rand(50,100);
$da=date("Y-m-d", strtotime($date));
$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$res = "";
for ($i = 0; $i < 10; $i++) 
{
    $res .= $chars[mt_rand(0, strlen($chars)-1)];
}
$r2=mysqli_query($con,"Select * from offer") or die(mysqli_error());
while($r=mysqli_fetch_assoc($r2))
{
    if($r['ccode']==$res)
    {
        for ($i = 0; $i < 10; $i++) 
        {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
    }
}   
$query="Insert into details Values('".$name."','".$id."','".$contact."','".$email."','".$amount."','".$rn."','".$da."')";
$result=mysqli_query($con,$query) or die(mysqli_error());
$q2="Insert into offer Values('".$id."','".$res."','".$off."','".$da."','Not Reademed')" or die(mysqli_error());
$r2=mysqli_query($con,$q2) or die(mysqli_error());
?>
<body>
<div id="wrapper">
  <h1><font size="50px">View Coupons</font></h1>
    <p style="background-color: white;font-family:Times New Roman;font-size: 30px;color:black;text-align: center;margin-left: 5%;margin-right: 5%;margin-top: 7%; border-color: black;border-width: 20px;padding-top: 5%;padding-bottom: 5%">
        <b>Coupon Code Generated is:</b><font color="Red" size="40px"> <?php echo $res;?></font><br>
        <br>
        <b>The discounted amount is Rs. </b><font color="Red" size="40px"> <?php echo $off;?></font>
    </p>
    <div class="col-submit">
        <a href="index.html"><button class="submitbtn">Back</button></a>
  </div>
    </div>
    
</body>
<?php
mysqli_close($con);
?>