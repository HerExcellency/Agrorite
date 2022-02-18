// js file for the validation of user registration

(function(){
    function processRegister(){
        var formOne = document.querySelector('#registerAgro')
        formOne.addEventListener('submit', function(e){
            e.preventDefault()
           var firstname = document.querySelector('#firstName').value
           var lastname = document.querySelector('#lastName').value
           var phone = document.querySelector('#userMobile').value
           var email = document.querySelector('#userEmail').value
           var password = document.querySelector('#password').value
           var userNationality = document.querySelector('#userNationality').value
           var userResidence = document.querySelector('#userResidence').value
           var reg = /^[a-zA-Z0-9_.-\s]*$/
           var confirmPassword = document.querySelector('#confirm-password').value
            //checking if firstname is present
           if(firstname.trim() === ''){
                $('#nameError').show();
                document.querySelector('#nameError').textContent = 'Please put in a firstname';
                return;
            }
            $('#nameError').hide();
            //checking the lenght of firstname
           if(firstname.trim().length < 2 || firstname.length > 45){
               $('#nameError').show();
               document.querySelector('#nameError').textContent = 'Please input a proper firstname';
               return;
           }
           $('#nameError').hide();
           //checking if firstname is alphanumeric
           if(!reg.test(firstname.trim())){
            $('#nameError').show();
            document.querySelector('#nameError').textContent = 'Firstname can only be Alphanumberic';
            return;
           }
           $('#nameError').hide();
           //checking if lastname is present
           if(lastname.trim() === ''){
                $('#lnameError').show();
                document.querySelector('#lnameError').textContent = 'Please put in a lastname';
                return;
            }
            $('#lnameError').hide();
            //checking the lenght of lastname
           if(lastname.trim().length < 2 || lastname.length > 45){
                $('#lnameError').show();
                document.querySelector('#lnameError').textContent = 'Please input a proper lastname';
                return;
             }
             $('#lnameError').hide();
             //checking if lastname is alphanumeric
            if(!reg.test(lastname.trim())){
                $('#lnameError').show();
                document.querySelector('#lnameError').textContent = 'Lastname can only be alphanumeric';
                return;
            }
            $('#lnameError').hide();
             //checking if email is submitted
           if(email.trim() === ''){
            $('#emailError').show();
            document.querySelector('#emailError').textContent = 'Please put in an email';
            return;
            }
            $('#emailError').hide();
                //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if(!re.test(email.trim())){
                $('#emailError').show();
                document.querySelector('#emailError').textContent = 'Please input a valid email address';
                return;
            }
            $('#emailError').hide();
            //checking if mobile number is submitted
            if(phone.trim() === ''){
                $('#mobileError').show();
                document.querySelector('#mobileError').textContent = 'Please put in a mobile number';
                return;
            }
            $('#mobileError').hide();
            //checking if mobile number submitted is a number
           if(!/^[0-9]+$/.test(phone.trim())){
               $('#mobileError').show();
               document.querySelector('#mobileError').textContent = 'Mobile number can only be numbers';
               return;
           }
           $('#mobileError').hide();
           //checking the length of mobile number
           if(phone.trim().length < 6 || phone.trim().length >16){
                $('#mobileError').show();
                document.querySelector('#mobileError').textContent = 'Please input a proper Mobile number';
                return;
            }
            $('#mobileError').hide();
             //checking if user Nationality is present
           if(userNationality.trim() === ''){
            $('#nationalityError').show();
            document.querySelector('#nationalityError').textContent = 'Please put in your Country of Origin';
            return;
            }
            $('#nationalityError').hide();
            //checking the lenght of country of origin
            if(userNationality.trim().length < 2 || userNationality.length > 100){
                $('#nationalityError').show();
                document.querySelector('#nationalityError').textContent = 'Please input a proper Country of Origin';
                return;
            }
             //checking if user residence is present
           if(userResidence.trim() === ''){
            $('#residenceError').show();
            document.querySelector('#residenceError').textContent = 'Please put in your Country of Residence';
            return;
            }
            $('#residenceError').hide();
            //checking the lenght of country of Residence
            if(userResidence.trim().length < 2 || userResidence.length > 100){
                $('#residenceError').show();
                document.querySelector('#residenceError').textContent = 'Please input a proper Country of Residence';
                return;
            }
           //checking if password is submitted
           if(password.trim() === ''){
                $('#passwordError').show();
                document.querySelector('#passwordError').textContent = 'Please put in a password';
                return;
            }
            $('#passwordError').hide();
            //checking the length of password
           if(password.trim().length < 6){
               $('#passwordError').show();
               document.querySelector('#passwordError').textContent = 'Put in a strong password';
               return;
           }
           $('#passwordError').hide();
           //checking if confirm password is submitted
           if(confirmPassword.trim() === ''){
                $('#cpasswordError').show();
                document.querySelector('#cpasswordError').textContent = 'Please confirm your password';
                return;
            }
            $('#cpasswordError').hide();
            //checking if the confirm password matches the password submited
           if(confirmPassword.trim() !== password.trim()){
                $('#cpasswordError').show();
                document.querySelector('#cpasswordError').textContent = 'Passwords do not match';
                return;
            }
            $('#cpasswordError').hide();
            //checking id the agreed button is checked
            if(!document.querySelector('#remember').checked){
                $('#termError').show();
                document.querySelector('#termError').textContent = 'required';
                return;
            }
            $('#termError').hide();
            //object to be sent to endpoint
           let sendData = { 
               firstname:firstname.trim(), 
               lastname:lastname.trim(), 
               phone:phone.trim(), 
               email:email.trim(), 
               userNationality:userNationality.trim(), 
               userResidence:userResidence.trim(), 
               password:password.trim()
            }
            document.querySelector('#registerBtn').textContent = 'Processing...'
           $.ajax({
                   type: "POST",
                   url: '/onlineagro/scripts/php/register.php',//endpoint 
                   data: sendData,
                //    dataType:'text',
                   success: function(data){
                    document.querySelector('#registerBtn').textContent = 'Register'
                       if(data.success){
                            $('#rsuccess_message').show();
                            document.querySelector('#rsuccess_message').textContent = data.success;
                            document.querySelector('#registerBtn').textContent = 'Successful'
                       }else{
                        $('#rsuccess_message').hide();
                        $('#rerror_message').show();
                        document.querySelector('#rerror_message').textContent = data.error;
                        return;
                       }
                       $('#rerror_message').hide();
                   }
               });
        })
    }
    processRegister()
   })()