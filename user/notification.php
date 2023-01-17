<?php 
$q=mysqli_query($conn,"select * from notice order by notice_id, likeCount asc");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No  notice for You !!!</h2>";
}
else
{
?>
<h2>All Notification</h2>

<table class="table table-bordered">
	<Tr class="success">
		<th>No</th>
		<th>Details</th>
		<th>Date</th>
		</Tr>
		<?php


$i=1;
while($row=mysqli_fetch_assoc($q))
{

echo "<Tr>";
echo "<td>".$i."</td>";
echo "<td>".$row['Description']."</td>";
echo "<td>".$row['Date']."</td>";

echo "</Tr>";
$i++;
}
		?>

</table>
<?php }?>
