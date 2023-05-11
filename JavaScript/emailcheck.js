function checkEmailAvailability() {
    var email = $('#email').val();
    console.log(email);
    $.ajax({
        url: 'emailcheck.action.php',
        type: 'POST',
        data: { email: email },
        dataType: 'json',
        success: function(response) {
            if (response.available) {
                $('#feedback').text('This Email is available!').css('color', 'green');
            } else {
                $('#feedback').text('This account already exists').css('color', 'red');
            }
        }
    });
}