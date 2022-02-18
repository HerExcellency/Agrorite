// js file for the validation of user password changing from dashboard

(function(){
    function updatePassword(){
        var formOne = document.querySelector('#dashPassword')
        formOne.addEventListener('submit', function(e){
            e.preventDefault()
           var email = document.querySelector('#pemail').value
           var oldpassword = document.querySelector('#oldpassword').value
           var password = document.querySelector('#password1').value
           var confirmPassword = document.querySelector('#password2').value
           
           //checking if password is submitted
           if(oldpassword.trim() === ''){
            $('#Perror_update').show();
            document.querySelector('#Perror_update').textContent = 'Please put in your previous password';
            return;
            }
            $('#Perror_update').hide();
           //checking if password is submitted
           if(password.trim() === ''){
                $('#Perror_update').show();
                document.querySelector('#Perror_update').textContent = 'Please put in your new password';
                return;
            }
            $('#Perror_update').hide();
            //checking the length of password
           if(password.trim().length < 6){
               $('#Perror_update').show();
               document.querySelector('#Perror_update').textContent = 'Put in a strong new password';
               return;
           }
           $('#Perror_update').hide();
           //checking if confirm password is submitted
           if(confirmPassword.trim() === ''){
                $('#Perror_update').show();
                document.querySelector('#Perror_update').textContent = 'Please confirm your password';
                return;
            }
            $('#Perror_update').hide();
            //checking if the confirm password matches the password submited
           if(confirmPassword.trim() !== password.trim()){
                $('#Perror_update').show();
                document.querySelector('#Perror_update').textContent = 'Your new Passwords do not match';
                return;
            }
            $('#Perror_update').hide();
            //object to be sent to endpoint
           let sendData = {
               email:email, 
               oldpassword:oldpassword.trim(),
               newpassword:password.trim()
            }
            document.querySelector('#updatePassBtn').textContent = 'Processing...'
           $.ajax({
                   type: "POST",
                   url: '/scripts/php/updatepassword2.php',//endpoint 
                   data: sendData,
                   success: function(data){
                    document.querySelector('#updatePassBtn').textContent = 'Reset Password'
                       if(data.success){
                            $('#Psuccess_update').show();
                            document.querySelector('#Psuccess_update').textContent = data.success;
                            setInterval(function(){ 
                                document.location = '../logout';
                            }, 2000);
                       }else{
                        $('#Psuccess_update').hide();
                        $('#Perror_update').show();
                        document.querySelector('#Perror_update').textContent = data.error;
                        return;
                       }
                       $('#Perror_update').hide();
                   }
               });
        })
    }
    updatePassword()
   })()