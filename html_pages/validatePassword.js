//code to validate that the password and confirm passwords match
var pword = '';
var cPword = '';
var username = '';

//set submit button to disabled to start
$('#enter').prop('disabled', true);

$('input').keyup(function () {
    verifyForm();
});

$('#enter').click(function () {
    submit();
});

$('input[type="password"]').keyup(function () {
    var passwordMatch = checkPasswords();
    if (passwordMatch) {
        var text = "Passwords match";
        updateFeedback(text, 'green');
    } else {
        var text = "Passwords don't match!";
        updateFeedback(text, 'red');
    }
});

function verifyForm() {
    pword = $('input[name="password"]').val();
    cPword = $('input[name="password_confirm"]').val();
    username = $('#login_username').val();

    if (pword && cPword && username) {
        var passwordsMatch = checkPasswords();
        if (passwordsMatch) {
            $('#enter').prop('disabled', false);
        } else {
            $('#enter').prop('disabled', true);
        }
    } else {
        $('#enter').prop('disabled', true);
    }

}

function updateFeedback(text, color = 'black') {
    $('#password_check').text(text);
    $('#password_check').css('color', color);
}

function checkPasswords() {
    pword = $('input[name="password"]').val();
    cPword = $('input[name="password_confirm"]').val();
    if (pword && cPword) {
        if (pword === cPword) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
