
<!DOCTYPE html>
<html>
<head>
	<title>Add Student</title>
</head>
<body>
	<div class="container">
		<h1 class="text-center text-primary">Add Student</h1>
		<hr>
<form type="post"id="newCustomerForm">

    <label for="name">Name:</label>
    <input name="name" class="form-control" type="text"/><br>

    <label for="email">Email:</label>
    <input name="email" class="form-control" type="text" /><br>

    <label for="phone">Phone:</label>
    <input name="phone" class="form-control" type="text"/><br>

    <label for="address">Address:</label>
    <input name="address" class="form-control" type="text"/><br>
    <input type="hidden" name="action" value="addStudent"/>
    <input type="submit" class="btn btn-outline-primary">
</form>
<br/><br/>
<div id="feedback"></div>
<br/><br/>

	</div>
</body>
<script type="text/javascript">
jQuery('#newCustomerForm').submit(ajaxSubmit);

function ajaxSubmit() {
    var newCustomerForm = jQuery(this).serialize();

    jQuery.ajax({
        type: "POST",
        url: "../wp-admin/admin-ajax.php",
        data: newCustomerForm,
        success: function(data){
            jQuery("#feedback").html(data);
        }
    });

    return false;
}

</script>
</html>





