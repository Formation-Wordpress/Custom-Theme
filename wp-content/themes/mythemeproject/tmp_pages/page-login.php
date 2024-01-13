<?php

/******************************
 * Template name: Login Page
 *******************************/
?>

<style>
    body {
        background: #2E8D41;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5em;
    }

    .login-area {
        background: #FFF;
        margin: 100px auto;
        width: 960px;
        padding: 1em;
        overflow: hidden;
    }

    .note {
        float: left;
        margin-right: 20px;
    }

    .form {
        float: right;
        width: 250px;
        text-align: center;
    }

    label {
        display: block;
    }

    input[type=email],
    input[type=number],
    input[type=password],
    input[type=search],
    input[type=tel],
    input[type=text],
    input[type=url],
    select,
    textarea {
        border: 1px solid #DDD;
        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
        background-color: #FFF;
        color: #333;
        -webkit-transition: .05s border-color ease-in-out;
        transition: .05s border-color ease-in-out;
        padding: 5px 10px;

    }

    input[type=submit] {
        background: #51a818;
        background-image: -webkit-linear-gradient(top, #51a818, #3d8010);
        background-image: -moz-linear-gradient(top, #51a818, #3d8010);
        background-image: -ms-linear-gradient(top, #51a818, #3d8010);
        background-image: -o-linear-gradient(top, #51a818, #3d8010);
        background-image: linear-gradient(to bottom, #51a818, #3d8010);
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        font-family: Arial;
        color: #ffffff;
        padding: 10px 20px 10px 20px;
        border: solid #32a840 2px;
        text-decoration: none;
    }
</style>
<?php
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
} else {
?>
    <div class="login-area">

        <div class="note">
            <h3>Đăng nhập</h3>
            <p> Hãy sử dụng tài khoản của bạn để đăng nhập vào website. </p>
            <p> Nếu chưa có tài khoản, <a href="<?php bloginfo('url'); ?>/wp-login.php?action=register">đăng ký tại đây</a>. </p>
        </div>

        <div class="form">
            <?php

            $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

            if ( $login === "failed" ) {
                echo '<p><strong>ERROR:</strong> Sai username hoặc mật khẩu.</p>';

            } elseif ( $login === "empty" ) {
                echo '<p><strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.</p>';

            } elseif ( $login === "false" ) {
                echo '<p><strong>ERROR:</strong> Bạn đã thoát ra.</p>';
            }

            ?>
            <?php
            // echo $_SERVER['REQUEST_URI'];   //  /login/
            // echo '<br>';
            // echo site_url($_SERVER['REQUEST_URI']); // http://wordpress_project.test/login/

                $args = array(
                    'redirect'       => site_url($_SERVER['REQUEST_URI']),
                    'form_id'        => 'mythemeproject_login_form', //Để dành viết CSS
                    'label_username' => __('Username'),
                    'label_password' => __('Password'),
                    'label_remember' => __('Remember me'),
                    'label_log_in'   => __('Login'),
                );
                wp_login_form($args);
            ?>
        </div>

    </div>
<?php
}
?>