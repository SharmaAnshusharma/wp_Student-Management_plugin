<?php
/*
   Plugin Name: Student-Management 
   Plugin URI: http://my-awesomeness-emporium.com
   description: >- This Plugin is basically useful for the teacher to manage student record.
   Version: 1.2
   Author: Anshu Sharma
   */

   define('CUSTOME_PLUGIN_DIR_PATH',plugin_dir_path(__FILE__));

   /*Add Css Files*/
 	wp_enqueue_style('bootstrap-grid',plugins_url('Student-Management','' ) .'/css/bootstrap-grid.css');
	wp_enqueue_style('bootstrap-grid.min',plugins_url('Student-Management','' ).'/css/bootstrap-grid.min.css');
	wp_enqueue_style('bootstrap-reboot',plugins_url('Student-Management','' ).'/css/bootstrap-reboot.css');
	wp_enqueue_style('bootstrap-reboot.min',plugins_url('Student-Management','' ).'/css/bootstrap-reboot.min.css');
	wp_enqueue_style('bootstrap',plugins_url('Student-Management','' ).'/css/bootstrap.css');
	/*wp_enqueue_style('bootstrap-min',plugins_url('Student Management','' ).'/css/bootstrap-min.css');
*/
	/*Add js Files*/

	wp_enqueue_script('bootstrap.bundle',plugins_url('Student-Management','' ).'/js/bootstrap.bundle.js');
	wp_enqueue_script('bootstrap.bundle.min',plugins_url('Student-Management','' ).'/js/bootstrap.bundle.min.js');
	wp_enqueue_script('bootstrap',plugins_url('Student-Management','' ).'/js/bootstrap.js');
	wp_enqueue_script('bootstrap.min',plugins_url('Student-Management','' ).'/js/bootstrap.min.js');
	wp_enqueue_script('jquery',plugins_url('Student-Management','' ).'/js/jquery.js');



	/*Plugin Menu Development*/
function next_menu_development()
{
	add_menu_page("Stduent Mgmt","Student Mgmt","manage_options","wp-student-record-plugin","custom_wp_list_call");
   
   add_submenu_page("wp-student-record-plugin","List Student","List Student","manage_options","wp-student-record-plugin","custom_wp_list_call");

   add_submenu_page("wp-student-record-plugin","Add Student","Add Student","manage_options","wp-custom-add","custom_wp_add_call");
    add_submenu_page("wp-student-record-plugin","","","manage_options","wp-custom-update","custom_wp_update_call");

}
add_action('admin_menu','next_menu_development'); 


function custom_wp_list_call()
{
	include_once CUSTOME_PLUGIN_DIR_PATH .'/Templates/list-student.php';
}
function custom_wp_add_call()
{
   include_once CUSTOME_PLUGIN_DIR_PATH .'/Templates/add-student.php';  
}
function custom_wp_update_call()
{
   include_once CUSTOME_PLUGIN_DIR_PATH .'/Templates/update-student.php';  
}

/*insert data in to the database*/
wp_enqueue_script('jquery');
function addStudent()
{
   global $wpdb;

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if ( $wpdb->insert( 'wp_customers', array(
        'Name' => $name,
        'Email' => $email,
        'Address' => $address,
        'Phone' => $phone
    ) ) === false ) {
        echo 'Error';
    } else {
        echo "Stduent '".$name. "' successfully added";
    }
    die();


   }
add_action('wp_ajax_addStudent', 'addStudent');

/*end of Insertion*/
function delete()
{
  global $wpdb;
  $stu_id = $_POST['stu_id'];
  
  
  $query = $wpdb->delete("wp_customers",array("ID"=>$stu_id));
  if($query == true)
  {
    echo "data Deleted Succesfully";
  }
  else
  {
    echo "Data not Deleted";
  }

  
}
add_action('wp_ajax_delete', 'delete');

function updateStudent()
{
  global $wpdb;
  $query = $wpdb->update('wp_customers',array(
        "Name"=>$_POST['name'],
        "Email"=>$_POST['email'],
        "Phone"=>$_POST['phone'],
        "Address"=>$_POST['address']
      ),array(
        "ID"=>$_POST['id']
      )
    );
  if($query == true)
  {
    echo "Student Record Updated Successfully!";
  }
  else
  {
    echo "Problem in Updating Student Details";
  }
      
}
add_action('wp_ajax_updateStudent','updateStudent');



?>