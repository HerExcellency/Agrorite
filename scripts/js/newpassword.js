// js file for the validation of user registration

(function(){
    function updatePassword(){
        var formOne = document.querySelector('#pwdUpdate')
        formOne.addEventListener('submit', function(e){
            e.preventDefault()
           var email = document.querySelector('#email').value
           var password = document.querySelector('#password1').value
           var confirmPassword = document.querySelector('#password2').value
           
           //checking if password is submitted
           if(password.trim() === ''){
                $('#error_update').show();
                document.querySelector('#error_update').textContent = 'Please put in a password';
                return;
            }
            $('#error_update').hide();
            //checking the length of password
           if(password.trim().length < 6){
               $('#error_update').show();
               document.querySelector('#error_update').textContent = 'Put in a strong password';
               return;
           }
           $('#error_update').hide();
           //checking if confirm password is submitted
           if(confirmPassword.trim() === ''){
                $('#error_update').show();
                document.querySelector('#error_update').textContent = 'Please confirm your password';
                return;
            }
            $('#error_update').hide();
            //checking if the confirm password matches the password submited
           if(confirmPassword.trim() !== password.trim()){
                $('#error_update').show();
                document.querySelector('#error_update').textContent = 'Passwords do not match';
                return;
            }
            $('#error_update').hide();
            //object to be sent to endpoint
           let sendData = {
               email:email, 
               password:password.trim()
            }
            document.querySelector('#updateBtn').textContent = 'Processing...'
           $.ajax({
                   type: "POST",
                   url: '/scripts/php/updatepassword.php',//endpoint 
                   data: sendData,
                //    dataType:'text',
                   success: function(data){
                    document.querySelector('#updateBtn').textContent = 'Update Password'
                       if(data.success){
                            $('#success_update').show();
                            document.querySelector('#success_update').textContent = 'Your password was updated successfully';
                            setInterval(function(){ 
                                document.location = 'https://agrorite.com/login';
                            }, 3000);
                       }else{
                        $('#success_update').hide();
                        $('#error_update').show();
                        document.querySelector('#error_update').textContent = data.error;
                        return;
                       }
                       $('#error_update').hide();
                   }
               });
        })
    }
    updatePassword()
   })()