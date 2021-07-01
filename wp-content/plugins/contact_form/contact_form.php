<?php
/**
 * @package contact_form
 */
/*
  Plugin Name: contact_form
  Plugin URI: http://contact_form/plugin
  Description:       plugin avec le quel vous pouvez ajouter une form de contact flexible.
  Version:           1.0.0
  Author:           Laila
 */


/*
Plugin Name: Goo Contact
Plugin URI: http://github.com/devnart/go-contact
Description: Simple WordPress Contact Form
Version: 1.0
Author: Hamza Bouchikhi
Author URI: http://github.com/devnart
*/

wp_register_style( 'namespace', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );

add_action('admin_menu', 'go_contact_setup_menu');

function go_contact_setup_menu()
{
    add_menu_page('Goo Contact Page', 'Go Contact', 'manage_options', 'go-contact', 'goo_contact_init','dashicons-database-add',5);
}


function goo_contact_init()
{
wp_enqueue_style('namespace'); 


    echo '<h1>Hi There,</h1>';

    $html = '';
    $html .= '<form method ="post" action = "">';

    $html .= '<div>';
        $html .= '<label class="form-label" for ="name"> Name : </label>';
        $html .= '<input type = "checkbox" name ="name" id="name1" value="true" />';
    $html .= '</div>';

    $html .= '<div>';
        $html .= '<label for ="email"> Email : </label>';
        $html .= '<input type = "checkbox" name ="email" value="true" class="form-control"/>';
    $html .= '</div>';

    $html .= '<div>';
        $html .= '<label for ="subject"> Subject : </label>';
        $html .= '<input type = "checkbox" name ="subject" value="true" class="form-control"/>';
    $html .= '</div>';

    $html .= '<div>';
        $html .= '<label for ="message"> Message : </label>';
        $html .= '<input type = "checkbox" name ="message" value="true"  class="form-control"/>';
    $html .= '</div>';

    $html .= '<input class="btn btn-primary" type="submit" name="submit-contact" class=" btn btn-md" value= "Submit"/>';

    $html .= '</form>';

    echo $html;

    echo 'shortcod : ' . '[go_contact]';
}

function html_form_code()
{

    getData();


    echo '<form action="" method="post">';

    if (getData()->name) {

        echo 'Your Name (required) <br />';
        echo '<input type="text" name="cname" size="40" /><br>';
    }
    if (getData()->email) {

        echo 'Your Email (required) <br />';
        echo '<input type="email" name="email" size="40" /><br>';
    }
    if (getData()->subject) {

        echo 'Subject (required) <br />';
        echo '<input type="text" name="subject" size="40" /><br>';
    }
    if (getData()->message) {

        echo 'Your Message (required) <br />';
        echo '<textarea rows="10" cols="35" name="message"></textarea><br>';
    }

    echo '<p><input type="submit" name="cf-submitted" value="Send"/></p>';
    echo '</form>';
}

function createtable()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $tablename = 'goo_contact_fields';
    $sql = "CREATE TABLE $wpdb->base_prefix$tablename (
        id INT,
        name BOOLEAN,
        email BOOLEAN,
        subject BOOLEAN,
        message BOOLEAN
        ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    maybe_create_table($wpdb->base_prefix . $tablename, $sql);
}

function createDataTable()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $tablename = 'goo_contact_data';
    $sql = "CREATE TABLE $wpdb->base_prefix$tablename (
         id INT AUTO_INCREMENT,
        name varchar(255) DEFAULT null,
        email varchar(255) DEFAULT null,
        subject varchar(255) DEFAULT null,
        message varchar(255) DEFAULT null,
        PRIMARY key(id)
        ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    maybe_create_table($wpdb->base_prefix . $tablename, $sql);
}


function insertData()
{
    global $wpdb;
    $wpdb->insert(
        'wp_goo_contact_fields',
        [
            'id' => 1,
            'name' => true,
            'email' => true,
            'subject' => true,
            'message' => true
        ]
    );
}

function getData()
{

    global $wpdb;
    $fields = $wpdb->get_row("SELECT * FROM wp_goo_contact_fields WHERE id = 1;");
    return $fields;
}


if (isset($_POST['submit-contact'])) {


    $name = filter_var($_POST['name'], FILTER_VALIDATE_BOOLEAN);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_BOOLEAN);
    $subject = filter_var($_POST['subject'], FILTER_VALIDATE_BOOLEAN);
    $message = filter_var($_POST['message'], FILTER_VALIDATE_BOOLEAN);

    global $wpdb;
    $wpdb->update(
        'wp_goo_contact_fields',
        [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ],
        ['id' => 1]
    );
}

if (isset($_POST['cf-submitted'])) {
    $arr = $_POST;
    unset($arr['cf-submitted']);


    global $wpdb;
    $wpdb->insert(
        'wp_goo_contact_data',
        $arr
    );
}
function cf_shortcode()
{
    ob_start();
    html_form_code();

    return ob_get_clean();
}

add_shortcode('go_contact', 'cf_shortcode');


register_activation_hook(__FILE__, 'createDataTable');
register_activation_hook(__FILE__, 'createtable');
register_activation_hook(__FILE__, 'insertData');





//JAMAL


require_once(ABSPATH . 'wp-config.php');
$connex = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($connex, DB_NAME);


function newTableData()
{
    global $connex;

    $sql = "CREATE TABLE contactfrm(id int NOT NULL PRIMARY KEY AUTO_INCREMENT, name varchar(255) NOT NULL, email varchar(255) NOT NULL, phone varchar(255) NOT NULL, message text NOT NULL)";
    $result = mysqli_query($connex, $sql);
    return $result;
}

if ($connex == true){
    newTableData();
}



add_action("admin_menu", "addMenu");
function addMenu()
{
  add_menu_page("contact_form", "contact_form", 4, "contact-frm", "contactform" );

}

// function mytheme_files() { 
//     wp_enqueue_style('mytheme_main_style', get_stylesheet_uri()); 
//     wp_enqueue_style('mytheme_mobile_style', get_theme_file_uri('/css/contact.css')); 
// } 

// add_action('wp_enqueue_scripts', 'mytheme_files');

function contactform()
{
echo <<< 'EOD'
<div class="container1">
  <form class="contact1-form validate-form" method="post">
    <span class="contact1-form-title">
					Contact Us
	</span>

                <div class="wrap-input1 validate-input" data-validate = "Name is required">
					<input class="input1" type="text" name="name" placeholder="Name">
					    <span class="shadow-input1"></span>
				</div>

                <div class="wrap-input1 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input1" type="text" name="email" placeholder="Email">
					    <span class="shadow-input1"></span>
				</div>
    
				<div class="wrap-input1 validate-input" data-validate = "Phone is required">
					<input class="input1" type="text" name="phone" placeholder="Phone">
					    <span class="shadow-input1"></span>
				</div>

                <div class="wrap-input1 validate-input" data-validate = "Message is required">
                    <textarea class="input1" name="message" placeholder="Message"></textarea>
                        <span class="shadow-input1"></span>
                 </div>

                 <div class="container-contact1-form-btn">
                 <button name="save" class="contact1-form-btn">
                     <span>
                         Send Email
                         <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                     </span>
                 </button>
             </div>
         </form>
</div>

EOD;
}




    function contact($atts){
        extract(shortcode_atts(
            array(
                'name' => 'true',
                'email' => 'true',
                'phone' => 'true',
                'message' => 'true'

        ), $atts));

        if($name== "true"){
            $name1 = '<div class="wrap-input1 validate-input" data-validate = "Name is required">
            <input class="input1" type="text" name="name" placeholder="Name">
                <span class="shadow-input1"></span>
        </div>';
        }else{
            $name1 = "";
        }

        if($email== "true"){
            $email1 = '<div class="wrap-input1 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input1" type="text" name="email" placeholder="Email">
                <span class="shadow-input1"></span>
        </div>';
        }else{
            $email1 = "";
        }

        if($phone== "true"){
            $phone1 = '<div class="wrap-input1 validate-input" data-validate = "Phone is required">
            <input class="input1" type="text" name="phone" placeholder="Phone">
                <span class="shadow-input1"></span>
        </div>';
        }else{
            $phone1 = "";
        }

         if($message== "true"){
            $message1 = '<div class="wrap-input2 validate-input" data-validate = "Message is required">
            <textarea class="input2" name="message" placeholder="Message"></textarea>
                <span class="shadow-input2"></span>
         </div>';
        }else{
            $message1 = "";
        }



        echo '<form method="POST"  >' .$name1 . $email1 . $phone1 . $message1 . '<br /><br />    <input type="submit" name="save" value="Submit">

        </form><br />';
    }
    add_shortcode('contact_form', 'contact');



    function form($name, $email,  $phone, $message)
    {
        global $connex;

      $sql = "INSERT INTO contactfrm(name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
      $result = mysqli_query($connex , $sql);

      return $result;
    }

    if(isset($_POST['save'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        form($name, $email, $phone, $message);



    }





