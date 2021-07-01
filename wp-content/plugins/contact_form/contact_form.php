<?php
/*
Plugin Name: contact_form
Plugin URI: https://github.com/FIKRILaila/plugin_contact_wp
Description: Simple WordPress Contact Form
Version: 1.0
Author: FIKRI Laila
Author URI: https://github.com/FIKRILaila
*/
wp_register_style( 'namespace', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );

add_action('admin_menu', 'contact_form_setup_menu');

function contact_form_setup_menu()
{
    add_menu_page('contact form Page', 'contact_form', 'manage_options', 'contact_form', 'contact_form_init','dashicons-database-add',5);
}


function contact_form_init()
{
wp_enqueue_style('namespace'); 

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

    echo 'shortcod : ' . '[contact_form]';
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
    $tablename = 'contact_form_fields';
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
    $tablename = 'contact_form';
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
        'wp_contact_form_fields',
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
    $fields = $wpdb->get_row("SELECT * FROM wp_contact_form_fields WHERE id = 1;");
    return $fields;
}


if (isset($_POST['submit-contact'])) {


    global $wpdb;
    $wpdb->update(
        'wp_contact_form_fields',
        [
            'name' => ($_POST['name']??false)=='true' ? true : false,
            'email' =>( $_POST['email']??false)=='true' ? true : false,
            'subject' =>( $_POST['subject']??false)=='true' ? true : false,
            'message' => ($_POST['message']??false)=='true' ? true : false
        ],
        ['id' => 1]
    );
}

if (isset($_POST['cf-submitted'])) {
    $arr = $_POST;
    unset($arr['cf-submitted']);
    global $wpdb;
    $wpdb->insert(
        'wp_contact_form',
        $arr
    );
}
function cf_shortcode()
{
    ob_start();
    html_form_code();
    return ob_get_clean();
}

add_shortcode('contact_form', 'cf_shortcode');


register_activation_hook(__FILE__, 'createDataTable');
register_activation_hook(__FILE__, 'createtable');
register_activation_hook(__FILE__, 'insertData');



