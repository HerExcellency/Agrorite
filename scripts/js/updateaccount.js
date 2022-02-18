// js file for the validation of user registration

(function () {
    function processRegister() {
        var formOne = document.querySelector('#updateUserInfo')
        formOne.addEventListener('submit', function (e) {
            e.preventDefault()
            var firstname = document.querySelector('#firstName').value
            var lastname = document.querySelector('#lastName').value
            var phone = document.querySelector('#userMobile').value
            var email = document.querySelector('#userEmail').value
            var userNationality = document.querySelector('#userNationality').value
            var userResidence = document.querySelector('#userResidence').value
            var selectGender = document.querySelector('#gender')
            var gender = selectGender.options[selectGender.selectedIndex].value
            var dob = document.querySelector('#dob').value
            var reg = /^[a-zA-Z0-9_.-\s]*$/
            //checking if firstname is present
            if (firstname.trim() === '') {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please put in a firstname';
                return;
            }
            $('#Aerror_update').hide();
            //checking the lenght of firstname
            if (firstname.trim().length < 2 || firstname.length > 45) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input a proper firstname';
                return;
            }
            $('#Aerror_update').hide();
            //checking if firstname is alphanumeric
            if (!reg.test(firstname.trim())) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Firstname can only be alphanumeric';
                return;
            }
            $('#Aerror_update').hide();
            //checking if lastname is present
            if (lastname.trim() === '') {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please put in a lastname';
                return;
            }
            $('#Aerror_update').hide();
            //checking the lenght of lastname
            if (lastname.trim().length < 2 || lastname.length > 45) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input a proper lastname';
                return;
            }
            $('#Aerror_update').hide();
            //checking if lastname is alphanumeric
            if (!reg.test(lastname.trim())) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Lastname can only be alphanumeric';
                return;
            }
            $('#Aerror_update').hide();
            //checking if email is submitted
            if (email.trim() === '') {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please put in an email';
                return;
            }
            $('#Aerror_update').hide();
            //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if (!re.test(email.trim())) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input a valid email address';
                return;
            }
            $('#Aerror_update').hide();
            //checking if mobile number is submitted
            if (phone.trim() === '') {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please put in a mobile number';
                return;
            }
            $('#Aerror_update').hide();
            //checking if mobile number submitted is a number
            if (!/^[0-9]+$/.test(phone.trim())) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Mobile number can only be numbers';
                return;
            }
            $('#Aerror_update').hide();
            //checking the length of mobile number
            if (phone.trim().length < 6 || phone.trim().length > 16) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input a proper Mobile number';
                return;
            }
            $('#Aerror_update').hide();
            //checking if user Nationality is present
            if (userNationality.trim() === '') {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input your country of origin';
                return;
            }
            $('#Aerror_update').hide();
            //checking the lenght of country of origin
            if (userNationality.trim().length < 2 || userNationality.length > 100) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input a valid country of origin';
                return;
            }
            $('#Aerror_update').hide();
            //checking if user residence is present
            if (userResidence.trim() === '') {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input a country of residence';
                return;
            }
            $('#Aerror_update').hide();
            //checking the lenght of country of Residence
            if (userResidence.trim().length < 2 || userResidence.length > 100) {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please input a valid country of residence';
                return;
            }
            $('#Aerror_update').hide();
            if (gender.trim() === 'gender') {
                $('#Aerror_update').show();
                document.querySelector('#Aerror_update').textContent = 'Please choose a gender';
                return;
            }
            $('#Aerror_update').hide();


            //object to be sent to endpoint
            let sendData = {
                firstname: firstname.trim(),
                lastname: lastname.trim(),
                phone: phone.trim(),
                email: email.trim(),
                residence: userResidence.trim(),
                nationality: userNationality.trim(),
                gender: gender,
                dateofbirth: dob
            }
            document.querySelector('#updateInfo').textContent = 'Processing...'
            $.ajax({
                type: "POST",
                url: '/scripts/php/updateaccount.php',//endpoint 
                data: sendData,
                //    dataType:'text',
                success: function (data) {
                    document.querySelector('#updateInfo').textContent = 'Update Account'
                    if (data.success) {
                        $('#Asuccess_update').show();
                        document.querySelector('#Asuccess_update').textContent = data.success;
                    } else {
                        $('#Asuccess_update').hide();
                        $('#Aerror_update').show();
                        document.querySelector('#Aerror_update').textContent = data.error;
                        return;
                    }
                    $('#Aerror_update').hide();
                }
            });
        })
    }
    processRegister()
})()