<?php

/**********************************************
 * Template name: Theme Signin Signup Page
 *********************************************/
?>
<?php

if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

get_header();

$err = '';
$success = '';

if (!empty($_POST['mytheme_register']) && $_POST['mytheme_register'] == 'Register') {
    // kiem tra truong hidden 'register_user_nonce' co ton tai ko ?
    // kiem tra gia tri value dc tao ra (value="adcb2b5792") = action cua hidden input ?
    if ( isset($_POST['register_user_nonce']) && 
            wp_verify_nonce($_POST['register_user_nonce'], 'mytheme_register_user') )  {
        
        require THEME_SUPPORT_DIRECTORY . '/register.php';
    }
}

$loginUrl = home_url('/wp-login.php');
$login_redirect = home_url('login-register');
$login_lostpwd = home_url('/wp-login.php?action=lostpassword');
?>
<!-- #top-wrap -->
<div class="site-main-wrap clr">
    <div id="main" class="site-main clr container">
        <div id="primary" class="content-area clr">
            <div id="content" class="site-content left-content clr" role="main">

                <article class="clr" id="post-387">
                    <div class="entry clr">
                        <div class="login-template-content clr"></div>
                        <!-- .login-template-content -->
                        <div class="login-template-forms clr">
                            <div class="login-form clr">
                                
                                <?php
                                // display the errors message of the authentication
                                if ( !empty($_GET['login']) ) {   
                                                                                                        
                                    $error_keys = explode('-', $_GET['login']);

                                    if ( !empty($error_keys[0]) && $error_keys[0] == 'failed' ) {
                                        if ( !empty($error_keys[1]) ) {
                                            echo '<div class="notice yellow registration-notice">';
                                            if ( $error_keys[1] == 'username' ) {
                                                echo 'The <strong>username</strong> is not registered on this site.';
                                            }
                                            if ( $error_keys[1] == 'password' ) {
                                                echo 'The <strong>password</strong> you entered is incorrect.';
                                            }
                                            echo '</div>';
                                        }
                                    }

                                    if ( !empty($error_keys[0]) && $error_keys[0] == 'empty' ) {
                                        if ( !empty($error_keys[1]) ) {
                                            echo '<div class="notice yellow registration-notice">';
                                            switch ( $error_keys[1] ) {
                                                case 'username' : echo 'The <strong>username</strong> is required.'; break;
                                                case 'password' : echo 'The <strong>password</strong> is required.'; break;
                                                case 'all'      : echo 'The <strong>username</strong> and the <strong>password</strong> are required.'; break;
                                            }                                        
                                            echo '</div>';
                                        }
                                    }                                    
                                } else {
                                    if ( empty($_POST['mytheme_register']) )
                                    echo    '<div class="notice yellow registration-notice">
                                                You have logged out.
                                            </div>';
                                }
                                ?>

                                <h2>Login to an account</h2>

                                <form method="post" action="<?=$loginUrl?>" id="loginform" name="loginform">

                                    <p class="login-username">
                                        <label for="user_login"></label>
                                        <input type="text" size="20" value="" class="input" 
                                                id="user_login" name="log" placeholder="Username" required >
                                    </p>
                                    <p class="login-password">
                                        <label for="user_pass"></label>
                                        <input type="password" size="20" value="" class="input" 
                                                id="user_pass" name="pwd" placeholder="Password" required>
                                    </p>
                                    <p class="login-submit">
                                        <input type="submit" value="Log In" class="button-primary" id="wp-submit" name="wp-submit">
                                        <input type="hidden" value="<?=$login_redirect?>" name="redirect_to">
                                    </p>
                                </form>

                                <a title="Lost Password? Recover it here." href="<?=$login_lostpwd?>">Lost Password?</a>
                            </div>
                            <!-- .login-form -->

                            <hr class="thick-hr">
                            <div class="register-form clr">
                                <?php 
                                if ( !empty($err) || !empty($success) ) {
                                    if ( !empty($err) ) {
                                        echo '<div class="notice yellow registration-notice">' . $err . '</div>';
                                    }
                                    if ( !empty($success) ) {
                                        echo '<div class="notice customize-success registration-notice">' . $success . '</div>';
                                    }
                                }
                                ?>

                                <h2>Register for an account</h2>
                                
                                <form autocomplete="off" action="" class="user-forms" id="adduser" method="POST">
                                    <input type="text" placeholder="Username *" value="" id="user_name" name="user_name" 
                                            class="text-input" autocomplete="username" required="required">
                                    
                                    <input type="email" placeholder="E-mail *" value="" 
                                            id="user_email" name="user_email" class="text-input" autocomplete="email">
                                    
                                    <input type="password" placeholder="Password *" value="" id="register_user_pass"
                                            name="register_user_pass" class="text-input">
                                    
                                    <input type="password" placeholder="Confirm Password *" value="" 
                                            id="register_user_pass_repeat" name="register_user_pass_repeat" class="text-input">
                                    
                                    <div class="strength">
                                        <span id="password-strength">Password strength</span>
                                        <?php 
                                            // password strength meter controlled by function coded in file /js/password_meter.js
                                            // and the script 'password-strength-meter' available of Wordpress added in functions.php 
                                        ?>
                                    </div>
                                    
                                    <p class="form-submit">
                                        <input type="submit" value="Register" class="submit button" id="addusersub" name="mytheme_register">
                                        <?php wp_nonce_field('mytheme_register_user', 'register_user_nonce' ); ?>
                                    </p>
                                </form>
                            </div>
                            <!-- .register-form -->
                        </div>
                        <!-- .login-template-forms -->
                    </div>
                    <!-- .entry -->
                </article>

                <div class="ad-spot home-bottom-ad clr">
                    <a href="#" title="Ad">
                        <img src="<?= THEME_IMAGES_DIRECTORY_URL ?>/ad-620x80.png" alt="Ad" />
                    </a>
                </div>
                <!-- .ad-spot -->
            </div>
            <!-- #content -->
            <?php
            get_sidebar();
            ?>
            <!-- #secondary -->
        </div>
        <!-- #primary -->

    </div>
    <!--.site-main -->
</div>
<!-- .site-main-wrap -->
</div>
<!-- #wrap -->

<?php
get_footer();
?>








