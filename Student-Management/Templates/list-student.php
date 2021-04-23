<h1 class="text-center text-primary">Student List</h1>
<p id="msg"></p>
<hr>
<?php
global $wpdb;
$all_students = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_customers`",""),ARRAY_A
        );
        if($all_students > 0)
        {

            ?>
            <table class="table table-striped table-hovered">
                <tr>
                    <th>SR No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>

                    <th>Action</th>
                    <th>Action</th>
                </tr>
            <?php
            $count=1;
            foreach($all_students as $index=> $student)
            {
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $student['Name']; ?></td>
                    <td><?php echo $student['Email']; ?></td>
                    <td><?php echo $student['Phone']; ?></td>
                    <td><?php echo $student['Address']; ?></td>
                    <td><button onclick="deleteData(<?php echo $student['ID'];?>)" class="btn btn-danger">Delete</button></td>
                        <td><a href="admin.php?page=wp-custom-update&action=edit&ID=<?php echo $student['ID'];?>" style="text-decoration: none;color:blue;color:white; " class="btn btn-success">Edit</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
            <?php
        }
        else
        {
            echo "<h1>No Data found</h1>";
        }


?>


<script type="text/javascript">
        function deleteData(id)
        {   
            jQuery.ajax({
                url: '../wp-admin/admin-ajax.php',
                type: 'POST',
                data: {action:'delete' ,stu_id:id},
                success:function(html)
                {
                    jQuery('#msg').html(html);
                    setTimeout(function(){location.reload();},3000)
                }
            });
        }
</script>

