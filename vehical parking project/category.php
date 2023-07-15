
<?php

include "config.php";

$sql=""



?>


<?php

require "layouts/main.php";

?>

<div class=" mt-3 ms-2 me-2">

<h4 class="text-center">vehicals category</h4>

<a  href="add_category.php"><input class=" btn btn-dark" type="submit" value="Add a category"></a>

<?php

include "config.php";

$sql="SELECT * FROM category";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){

    


?>

<table class=" mt-3 table table-dark table-striped table-responsive">
    <thead>
        <tr>
            <td>Category_id</td>
            <td>Category_name</td>
            <td>Category_description</td>
            <td>Edit</td>
            <td>Action</td>

        </tr>
    </thead>



    <?php $i=1; while($row=mysqli_fetch_assoc($result)){



     ?>

    <tbody>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['c_name'] ?></td>
            <td class="text-area"><?php echo substr($row['c_description'],0,100 )?></td>
            <td class="button" name="edit"><a type="button" href="edit_category.php?eid=<?php echo $row['cid'] ?>"><i class="bi bi-pencil-square"></i></a></td>
            <td class="button" name="delete"><a type="button" href="delete_category.php?cid=<?php echo $row['cid'] ?>"><i class="bi bi-trash-fill"></i></a></td>
            

            
        </tr>
        

        <?php $i++; } ?>
        
    </tbody>

    <?php } ?>
    

</table>


