<?php
global $wpdb;
$msg ="";

$action = isset($_GET['action'])? trim($_GET['action']) : "";
$id = isset($_GET['ID'])? intval($_GET['ID']) : "";

$row_details = $wpdb->get_row($wpdb->prepare("SELECT * FROM `wp_customers` WHERE `ID` =%d", $id),ARRAY_A);
?>
  <div class="container">
    <h1 class="text-center text-primary">Update Student</h1>
    <hr>
    <form type="post"id="update">

    <label for="name">Name:</label>
    <input name="name" class="form-control" type="text" value="<?php echo $row_details['Name'];?>"/><br>

    <label for="email">Email:</label>
    <input name="email" class="form-control" type="text" value="<?php echo $row_details['Email'];?>" /><br>

    <label for="phone">Phone:</label>
    <input name="phone" class="form-control" type="text" value="<?php echo $row_details['Phone'];?>"/><br>
    <input type="hidden" name="id" value="<?php  echo $row_details['ID'];?>">
    <label for="address">Address:</label>
    <input name="address" class="form-control" type="text" value="<?php echo $row_details['Address'];?>"/><br>
    <input type="hidden" name="action" value="updateStudent"/>
    <input type="submit" value="Update Record" class="btn btn-outline-primary col-sm-12">
</form>
<br/><br/>
<div id="feedback"></div>
<br/><br/>
</div>

<script type="text/javascript">
jQuery('#update').submit(ajaxSubmit);

function ajaxSubmit() {
    var update = jQuery(this).serialize();

    jQuery.ajax({
        type: "POST",
        url: "../wp-admin/admin-ajax.php",
        data: update,
        success: function(data){
            jQuery("#feedback").html(data);
            setTimeout(function(){window.location='admin.php?page=wp-student-record-plugin';},3000)
        }
    });

    return false;
}

</script>