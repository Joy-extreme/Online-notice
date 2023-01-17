<script>
	function DeleteNotice(id)
	{
		if(confirm("You want to delete this record ?"))
		{
		window.location.href="deleteNotice.php?id="+id;
		}
	}
</script>
<?php 
$q=mysqli_query($conn,"select * from notice where noticeIssuer='admin'");

?>
<h2 class="page-header" >All Notice</h2>

<table class="table table-bordered">

	<Tr class="success">
		<th>No</th>
		<th>Details</th>
		<th>Date</th>
		<th>Delete</th>
		<th>Update</th>
	</Tr>
		<?php 


$i=1;
while($row=mysqli_fetch_assoc($q))
{

echo "<Tr>";
echo "<td>".$i."</td>";
echo "<td>".$row['Description']."</td>";
echo "<td>".$row['Date']."</td>";

?>

<Td><a href="javascript:DeleteNotice('<?php echo $row['notice_id']; ?>')"  title='Delete Notice' style='color:Red'><span class='glyphicon glyphicon-trash'></span>></a></td>


<?php 
echo "<Td><a href='index.php?page=updateNotice&notice_id=".$row['notice_id']."' title='Edit Notice'style='color:green'><span class='glyphicon glyphicon-edit'></span></a></td>";
echo "</Tr>";
$i++;
}
		?>
		
</table>
