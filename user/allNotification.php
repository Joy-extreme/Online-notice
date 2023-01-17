<?php 
$q=mysqli_query($conn,"select * from notice where userType='All' or userType='Student' order by notice_id desc ");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No  notice for You !!!</h2>";
}
else
{
?>
<h2 class="page-header">All Notification</h2>

<?php


while($row=mysqli_fetch_assoc($q))
{
    $name=$row['name'];
    $noticeIssuer=$row['noticeIssuer'];
    $filename=$row['FileName'];
    $date=$row['Date'];
    $des=$row['Description'];
    $like=$row['likeCount'];
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
                <h4 class='page-header'><small style='color:black;'><strong>$noticeIssuer</strong> $date</small></h4>
            </div>
            <div class='col-sm-4'>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-12'>
                
                <h4 >$des</h4>
            </div>
        </div><br>";
        ?>
        <div class='row'>
                    <div class='col-sm-12'>
                        
                        <h6 >For more information, click <a href="../file/<?php echo $filename; ?>" title="Download"><span class="glyphicon glyphicon-download-alt"></span></a></h6>
                    </div>
                </div><br>
        <?php

       echo "<h5 style='float:left; color: #3897f0;'>$like likes</h5>
       <a href='index.php?page=comment&notice_id=".$row['notice_id']."' style='float:right;' class='btn btn-info'>Comment and like</a><br>
    </div>
    <div class='col-sm-3'>
    </div>
</div><br>
</div>
<br><br>
";

}
		?>
        
<?php }?>

