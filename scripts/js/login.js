/**
 * This JavaScript files takes care of the login of users
 * it receives the user email address as the username and then password, validates and sends it to the endpoint
 */
(function () {
    function processLogin() {
        var formOne = document.querySelector('#loginForm')
        formOne.addEventListener('submit', function (e) {
            e.preventDefault()
            var email = document.querySelector('#loginEmail').value
            var password = document.querySelector('#loginPassword').value
            //regext to validate email         
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //check if emailis submitted
            if (email.trim() === '') {
                $('#emailError').show();
                document.querySelector('#emailError').textContent = 'Please put in an email';
                return;
            }
            $('#emailError').hide();
            //check if email is valid
            if (!re.test(email.trim())) {
                $('#emailError').show();
                document.querySelector('#emailError').textContent = 'Please input a valid email address';
                return;
            }
            $('#emailError').hide();
            //check if password is submitted
            if (password.trim() === '') {
                $('#passwordError').show();
                document.querySelector('#passwordError').textContent = 'Please put in a password';
                return;
            }
            $('#passwordError').hide();

            //object to be sent to the endpoint
            let sendData = {
                email: email,
                password: password
            }
            document.querySelector('#loginButton').textContent = 'Processing...'
            $.ajax({
                type: "POST",
                url: '/onlineagro/scripts/php/login.php',//endpoint 
                data: sendData,
                //    dataType:'text',
                success: function (data) {
                    document.querySelector('#loginButton').textContent = 'Login'
                    if (data.success) {
                        document.location = 'https://agrorite.com/dashboard'
                    } else {
                        $('#lerror_message').show();
                        document.querySelector('#lerror_message').textContent = data.error;
                        return;
                    }
                    $('#lerror_message').hide();
                }
            });
        })
    }
    processLogin()
})()