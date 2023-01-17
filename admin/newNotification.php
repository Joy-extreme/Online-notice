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
$q=mysqli_query($conn,"select * from notice where noticeIssuer='admin'order by notice_id desc");

?>
<h2 class="page-header" >Your Notices</h2>


		<?php 



while($row=mysqli_fetch_assoc($q))
{


    $name=$row['name'];
    $noticeIssuer=$row['noticeIssuer'];
    $filename=$row['FileName'];
    $like=$row['likeCount'];
    $date=$row['Date'];
    $des=$row['Description'];
    echo 
    "
    <div class='container' id='noticeBox' style='width:50%;' >
    <div class='row'>
        <div class='col-sm-1'>
        </div>
        <div id='posts' class='col-sm-12'>
            <div class='row'>
                
                <div class='col-sm-12'>
                    <h3><Strong style='text-decoration:none; cursor:pointer;color: #3897f0;'>$name</Strong></h3>
                    <h4><small style='color:black;'><strong>$noticeIssuer</strong> $date</small></h4>
                </div>
                <div class='col-sm-4'>
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-12'>
                    
                    <h4 >$des</h4>
                </div>
            </div>
            <br>
            <div class='row'>
            <div class='col-sm-12'>";
            ?>   
            
            <h6 >For more information, click <a href="../file/<?php echo $filename; ?>" title="Download"><span class="glyphicon glyphicon-download-alt"></span></a></h6>
            <?php
            echo "</div>
        </div><br>
        <h5 style='float:right; color: #3897f0;'>$like likes</h5>
            <a href='index.php?page=comment&notice_id=".$row['notice_id']."' style='float:right;' class='btn btn-info'>Comment & like</a><br>
        <a href='index.php?page=updateNotice&notice_id=".$row['notice_id']."' title='Edit Notice'style='color:green'><span class='glyphicon glyphicon-edit'></span></a>&nbsp&nbsp&nbsp
       ";
           ?>
           <a href="javascript:DeleteNotice('<?php echo $row['notice_id']; ?>')"  title='Delete Notice' style='color:Red'><span class='glyphicon glyphicon-trash'></span>></a>
            </div>
        <div class='col-sm-3'>
        </div>
    </div><br>
   

<?php 

echo "</div>
<br><br>
";

}
?>
		
