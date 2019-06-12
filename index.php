<?php
/* Pagination is a technique to divide content into several pages.
 Here we can assign each page a separate URL. By Clicking that URL or Page Number,
 user can view this Page. For every page we assign a incremental 
 Page number */
$conn=mysqli_connect("localhost","root","","form");


$start=0;
$limit=2;
// limit=1,2;
// limit=2,2;

$t=mysqli_query($conn,"select * from form_table");
$total=mysqli_num_rows($t);



if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
	//$start=2*1;
	//$start=2;
}
else
{
	$id=1;
}
$page=ceil($total/$limit);

$query=mysqli_query($conn,"select * from form_table limit $start,$limit");
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Table</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Hobbies</th>
        <th>Course</th>
      </tr>
    </thead>
    <tbody>
	
	<?php
	while($ft=mysqli_fetch_array($query))
	{?>
	 <tr>
        <td><?= $ft['0']?></td>
        <td><?= $ft['1']?></td>
        <td><?= $ft['2']?></td>
        <td><?= $ft['3']?></td>
        <td><?= $ft['4']?></td>
      </tr>
	<?php
	}
	
	?>


    </tbody>
  </table>
  <ul class="pagination">
	 <?php if($id > 1) {?> <li><a href="?id=<?php echo ($id-1) ?>">Previous</a></li><?php }?>
	 <?php
	 for($i=1;$i <= $page;$i++){
	 ?>
		<li><a href="?id=<?php echo $i ?>"><?php echo $i;?></a></li>
	  <?php
	 }
	  ?>
	<?php if($id!=$page)
	//3!=4
	{?> 
	  <li><a href="?id=<?php echo ($id+1); ?>">Next</a></li>
	<?php }?>
 </ul>
  
  
</div>

</body>
</html>

