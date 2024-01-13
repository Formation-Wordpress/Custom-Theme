<?php
global $wpdb, $PasswordHash;

$pwd1       = trim($_POST['register_user_pass']);
$pwd2       = trim($_POST['register_user_pass_repeat']);
$email      = trim($_POST['user_email']);
$username   = trim($_POST['user_name']);

if ($email == "" || $pwd1 == "" || $pwd2 == "" || $username == "") {
    $err = 'Please fill all required fields.';

} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err = 'The email is incorrect.';

} else if (email_exists($email)) {
    $err = 'The email address has been used.';

} else if (username_exists($username)) {
    $err = 'The username has been used.';

} else if ($pwd1 <> $pwd2) {
    $err = 'The confirmed password did not match.';

} else {
    $user_id = wp_insert_user(array(
        'user_pass'     => apply_filters('pre_user_user_pass', $pwd1), 
        'user_login'    => apply_filters('pre_user_user_login', $username), 
        'user_email'    => apply_filters('pre_user_user_email', $email), 
        'role'          => 'subscriber'));

    if (is_wp_error($user_id)) {
        $err = 'Error on user creation.';
    } else {
        $success = "Your account has been saved with success. You can now log in.";

        /*Send e-mail to admin and new user - 
        You could create your own e-mail instead of using this function*/
        wp_new_user_notification( $user_id, null, 'user');
        // new_user_notification($user_id, $pwd1);
    }
}

