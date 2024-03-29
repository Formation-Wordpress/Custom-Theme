jQuery( document ).ready( function( $ ) {
    // trigger the wdmChkPwdStrength
    $( 'body' ).on( 'keyup', 'input[name=register_user_pass], input[name=register_user_pass_repeat]', function( event ) {
        wdmChkPwdStrength(
            // password field
            $('input[name=register_user_pass]'),
            // confirm password field
            $('input[name=register_user_pass_repeat]'),
            // strength status
            $('#password-strength'),
           // Submit button
           $('input[name=mytheme_register]'),
           // blacklisted words which should not be a part of the password
           ['admin', 'happy', 'hello', '1234']
        );
    });
});

function wdmChkPwdStrength( $pwd,  $confirmPwd, $strengthStatus, $submitBtn, blacklistedWords ) {
    var pwd = $pwd.val();
    var confirmPwd = $confirmPwd.val();

    // extend the blacklisted words array with those from the site data
    blacklistedWords = blacklistedWords.concat( wp.passwordStrength.userInputBlacklist() )

    // every time a letter is typed, reset the submit button and the strength meter status
    // disable the submit button
    $submitBtn.attr( 'disabled', 'disabled' );
    $strengthStatus.removeClass( 'short bad good strong' );

    // calculate the password strength
    var pwdStrength = wp.passwordStrength.meter( pwd, blacklistedWords, confirmPwd );

    // check the password strength
    switch ( pwdStrength ) {

        case 2:
        $strengthStatus.addClass( 'bad' ).html( pwsL10n.bad );
        break;
    
        case 3:
        $strengthStatus.addClass( 'good' ).html( pwsL10n.good );
        break;
    
        case 4:
        $strengthStatus.addClass( 'strong' ).html( pwsL10n.strong );
        break;
    
        case 5:
        $strengthStatus.addClass( 'mismatch' ).html( pwsL10n.mismatch );
        break;
    
        default:
        $strengthStatus.addClass( 'short' ).html( pwsL10n.short );
    
    }
    // set the status of the submit button
    if ( 4 === pwdStrength && '' !== confirmPwd.trim() ) {
        $submitBtn.removeAttr( 'disabled' );
    }

    return pwdStrength;
}