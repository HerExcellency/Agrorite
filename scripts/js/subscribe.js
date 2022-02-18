/**
 * This JavaScript files takes care of the login of users
 * it receives the user email address as the username and then password, validates and sends it to the endpoint
 */
(function () {
    function processLogin() {
        var formOne = document.querySelector('#subscribeMe')
        formOne.addEventListener('submit', function (e) {
            e.preventDefault()
            var email = document.querySelector('#subscribeEmail').value
            //regext to validate email         
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //check if emailis submitted
            if (email.trim() === '') {
                $('#subscribeEmail').css("border", "1px solid red");
                setInterval(function () { $('#subscribeEmail').css("border", "1px solid #07c507"); }, 5000);
                return;
            }
            //check if email is valid
            if (!re.test(email.trim())) {
                $('#subscribeEmail').css("border", "1px solid red");
                setInterval(function () { $('#subscribeEmail').css("border", "1px solid #07c507"); }, 5000);
                return;
            }

            //object to be sent to the endpoint
            let sendData = {
                email: email
            }
            document.querySelector('#subscribeMeBtn').textContent = 'Joining...'
            $.ajax({
                type: "POST",
                url: '/scripts/php/subscriber.php',//endpoint 
                data: sendData,
                //    dataType:'text',
                success: function (data) {
                    if (data.success) {
                        document.querySelector('#subscribeMeBtn').textContent = 'Joined'
                        $('#subscribeEmail').css("border", "1px solid #07c507");
                        document.querySelector('#subscribeEmail').value = ""
                    } else {
                        document.querySelector('#subscribeMeBtn').textContent = 'Join'
                        $('#subscribeEmail').css("border", "1px solid red");
                        setInterval(function () { $('#subscribeEmail').css("border", "1px solid #07c507"); }, 5000);
                    }
                }
            });
        })
    }
    processLogin()
})()