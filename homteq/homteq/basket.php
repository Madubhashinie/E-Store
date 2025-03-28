<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename="Smart Basket"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>";
//display name of the page as window title
echo "<body>";
include ("headfile.html");
include ("detectlogin.php");

//include header layout file
echo "<h4>".$pagename."</h4>";
//display name of the page on the web page
//display random text
$total = 0;
if (isset($_POST['h_prodid']))
{
	$newprodid =$_POST['h_prodid'];
	$reququantity =$_POST['p_quantity'];
	
	//echo "ID of selected Product:".$newprodid;
	//echo "Qty of selected Product:".$reququantity;
	
	//create a new cell in the basket session array. Index this cell with the new product id.
//Inside the cell store the required product quantity
	$_SESSION['basket'][$newprodid]=$reququantity;
}

else
{
	echo "<p>Current basket unchanged";
}
	echo "<table id='baskettable'>
	<tr>
		<th>Product Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>SubTotal</th>
		<th>Remove Product</th>
	</tr>";

//if the session array $_SESSION['basket'] is set
if(isset($_SESSION['basket'])){

	foreach($_SESSION['basket'] as $key => $value)
	{	
		$SQL="select prodId,prodName,prodPrice from product where prodId = '".$key."';";
		//Create a new variable containing the execution of the SQL query i.e. select the records or get out
		$exeSQL=mysqli_query($conn,$SQL) or die (mysqli_error());
		$arrayprod=mysqli_fetch_array($exeSQL);
		echo "<tr>
		<td>".$arrayprod['prodName']."</td>
		<td>".$arrayprod['prodPrice']."</td>
		<td>".$value."</td>
		<td> Rs ".$arrayprod['prodPrice']*$value."</td>";
		$total = $total+($arrayprod['prodPrice']*$value);
echo "<form action=basket.php method=post>";
echo "<td>";
echo "<input type=submit value='Remove' id='submitbtn'>";
echo "</td>";
echo "<input type=hidden name=del_prodid value=".$arrayprod['prodId'].">";
echo "</form>";
	}

		}
else{
	echo "Empty Basket";
	}

    echo "<tr>";
echo "<td colspan=4>TOTAL</td>";
echo "<td>&pound" . number_format($total, 2) . "</td>";
echo "</tr>"; 
echo"</table>";
        echo "<br><br>";
		echo "<a href='clearBasket.php'>Clear the basket</a>";
        if (isset($_SESSION['userid']))
{
    echo "<br><br>";
echo "<br><p>To finalise your order: <a href=checkout.php>CHECKOUT</a></p>";
}
else
{
    echo "<br><br>";
echo "<br><p>New homteq customers: <a href='signup.php'>Sign up</a></p>";
echo "<p>Returning homteq customers: <a href='login.php'>Login</a></p>";
}
		
	
		
		if (isset($_POST['del_prodid']))
		{
		//capture the posted product id and assign it to a local variable $delprodid
		$delprodid=$_POST['del_prodid'];
		//unset the cell of the session for this posted product id variable
		unset ($_SESSION['basket'][$delprodid]);
		//display a "1 item removed from the basket" message
		header("Refresh:0");
		echo "<p>1 item removed";
		}
		

include("footfile.html");
//include head layout
echo "</body>";
?>