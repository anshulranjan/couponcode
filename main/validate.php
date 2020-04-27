<html>
<head>
<title> Check Coupon Status</title>    
<meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Coupon Code Validate</title>
  <style type="text/css">
      .io{
          color: black;
          font-family: Times New Roman;
          font-size: 40px;
          font-weight: 800;
          text-align: center;
          margin-top: 3%;
      }
      .box{
        background:white;
        margin-left:5%;
        margin-right:5%;
        margin-top: 1%; 
        border-width: 20px;
        padding-top: 3%; 
        padding-bottom: 3%;
      }
      .form11{
         white-space: nowrap;
        margin-left: 10%;
        border:none;
}
       .col-submit{
          text-align: center;
      }
      .submitbtn{
           background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
          
      }
    </style>
</head>
<?php
$code=$_GET['code'];
$num=$_GET['contact'];
$con=mysqli_connect("localhost","root","") or die(mysqli_error($con));
mysqli_select_db($con,"coupon") or die(mysqli_error($con));
$r1=mysqli_query($con,"Select cnumber from details Where oid=(Select oid from offer where ccode='$code')") or die(mysqli_error($con));
$r22=mysqli_fetch_assoc($r1);
if(mysqli_num_rows($r1) == 0) {
    ?>
    <script>
        alert("No coupons found");
        window.location.href='viewcode.html';
        </script>
    <?php
}
if($r22['cnumber']!=$num){
?>
        <script>
        alert("Contact Details Invalid. Please try again");
        window.location.href='view.html';
        </script>
        <?php
}
$qq="SELECT details.name, details.oid, details.cnumber, offer.ccode, offer.offer, offer.dop, offer.status FROM details, offer WHERE  details.oid =offer.oid AND offer.ccode='$code'";
$rr=mysqli_query($con,$qq) or die(mysqli_error($con));
$r3=mysqli_fetch_assoc($rr);
$dat=$r3['dop'];
$start_date = strtotime($dat); 
$datenow = date("Y-m-d");
$end_date=strtotime($datenow);
$difference=($start_date-$end_date)/60/60/24;
$rrr="Reademed";
session_start();
$_SESSION['status'] = $r3['ccode'];
?>
<body bgcolor="azure">
<h1 class="io">Coupon Code Validate</h1>
<div class="box">
    <div class="form11"><b><font size="26px"> Coupon Code is:</font></b><font style ="color:green;font-size:50px;padding-left:10%;"> <?php echo $r3['ccode'];?></font></div><br>
    <div class="form11"><b><font size="20px"> Amount Off is: </font></b><font style ="color:green;font-size:50px;padding-left:13%;"> <?php echo $r3['offer'];?></font></div><br>
    <div class="form11"><b><font size="26px"> Name of User is:  </font> </b><font style ="color:green;font-size:50px;padding-left:10%;"> <?php echo $r3['name'];?></font></div><br>
    <div class="form11"><b><font size="26px"> Order id is:  </font> </b><font style ="color:green;font-size:50px;padding-left:19%;"> <?php echo $r3['oid'];?></font></div><br>
    <div class="form11"><b><font size="26px">Status: </font></b><font style ="color:green;font-size:50px;padding-left:28%;"> <?php echo 
    $r3['status'];?></font></div>
    <br>
    <br>
    <?php
    if($difference>90){
        ?>
        <p style="padding-left:34%;color:Red;font-size:40px;">Sorry Coupon Expired</p>
    <?php
    }
    else if($r3['status']==$rrr)
    {
        ?>
        <p style="padding-left:30%;color:Red;font-size:40px;">Sorry Coupon Already Reademed.</p>
        <?php
    }
    else{
        ?>
        <a href="reademcoupon.php"><div class="col-submit">
        <button class="submitbtn">Readem Coupon</button>
            </div></a>
        <?php
    }
    ?>
    </div>
      </body>
      </html>
<?php
mysqli_close($con);
?>
