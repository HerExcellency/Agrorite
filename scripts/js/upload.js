
(function () {
    function processAccount() {
        // alert('here')
        let formOne = document.querySelector('#updatePicture');
        formOne.addEventListener('submit', function (e) {
            e.preventDefault()
            var email = document.querySelector('#userEmail').value
            var userImg = document.querySelector('#userPicture')
            //checking if email is submitted
            if (email.trim() === '') {
                alert('Please put in an email');
                return;
            }
            //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if (!re.test(email)) {
                alert('Please input a valid email address');
                return;
            }
            if (userImg.files[0] === '') {
                alert('Please select an Image file')
                return
            }

            // File type validation
            $("#userPicture").change(function () {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
                    $('#error_pmessage').show();
                    document.querySelector('#error_pmessage').textContent = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.';
                    $("#file").val('');
                    return false;
                }
                $('#error_pmessage').hide();
            });
            var formData = new FormData()
            formData.append('userPicture', userImg.files[0]);
            formData.append('userEmail', email);
            document.querySelector('#uploadBtn').textContent = 'UPLOADING...'

            //object to be sent to endpoint
            $.ajax({
                type: "POST",
                url: '/scripts/php/upload.php',//endpoint 
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    document.querySelector('#uploadBtn').textContent = 'UPLOAD'
                    if (data.success) {
                        $('#uploadSuccess').modal('show')
                    } else {
                        $('#errorMessage').innerHTML = data.error;
                        $('#uploadError').modal('show');
                    }
                }
            });
        })
    }
    processAccount()
})()