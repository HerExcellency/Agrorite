// js file for initiate the process of password reset
(function(){
    function resetPass(){
        var formOne = document.querySelector('#pwdReset')
        formOne.addEventListener('submit', function(e){
            e.preventDefault()
           var email = document.querySelector('#resetEmail').value
            //checking if email is submitted
           if(email.trim() === ''){
                $('#error_reset').show();
                document.querySelector('#error_reset').textContent = 'Please put in an email';
                return;
            }
            $('#error_reset').hide();
            //regex to validate email
           var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
           //checking if the email submitted is valid
           if(!re.test(email.trim())){
               $('#error_reset').show();
               document.querySelector('#error_reset').textContent = 'Please input a valid email address';
               return;
           }
           $('#error_reset').hide();
            //object to be sent to endpoint
           let sendData = {  
               email:email.trim()
            }
            document.querySelector('#resetBtn').textContent = 'Processing...'
           $.ajax({
                   type: "POST",
                   url: '/scripts/php/forgetpwd.php',//endpoint 
                   data: sendData,
                //    dataType:'text',
                   success: function(data){
                    document.querySelector('#resetBtn').textContent = 'Reset Password'
                       if(data.success){
                        $('#success_reset').show();
                            document.querySelector('#success_reset').textContent = 'Please check your email for your reset pin';
                            
                       }else{
                        $('#success_reset').hide();
                        $('#error_reset').show();
                        document.querySelector('#error_reset').textContent = data.error;
                        return;
                       }
                       $('#error_reset').hide();
                   }
               });
        })
    }
    resetPass()
   })()