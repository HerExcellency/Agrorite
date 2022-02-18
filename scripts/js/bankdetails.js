// js file for the validation of user registration

(function(){
    function processRegister(){
        var formOne = document.querySelector('#mybankInfo')
        formOne.addEventListener('submit', function(e){
            e.preventDefault()
           var bankname = document.querySelector('#bankName').value
           var accountnumber = document.querySelector('#bankNumber').value
           var accountname = document.querySelector('#bankAccountName').value
           var email = document.querySelector('#bankUserEmail').value
           var password = document.querySelector('#bankPassword').value
            //checking if bank name is present
           if(bankname.trim() === ''){
                $('#Berror_update').show();
                document.querySelector('#Berror_update').textContent = 'Please put in your bank name';
                return;
            }
            $('#Berror_update').hide();
            //checking the lenght of bank name
           if(bankname.trim().length < 2 ){
               $('#Berror_update').show();
               document.querySelector('#Berror_update').textContent = 'Please input a valid bank name';
               return;
           }
           $('#Berror_update').hide();
           //checking if account name is present
           if(accountname.trim() === ''){
                $('#Berror_update').show();
                document.querySelector('#Berror_update').textContent = 'Please fill in your bank account name';
                return;
            }
            $('#Berror_update').hide();
            //checking the lenght of account name
           if(bankname.trim().length < 2 ){
                $('#Berror_update').show();
                document.querySelector('#Berror_update').textContent = 'Please put your name as it is in your bank account';
                return;
             }
             $('#Berror_update').hide();
             //checking if email is submitted
           if(email.trim() === ''){
            $('#Berror_update').show();
            document.querySelector('#Berror_update').textContent = 'Please put in an email';
            return;
            }
            $('#Berror_update').hide();
                //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if(!re.test(email.trim())){
                $('#Berror_update').show();
                document.querySelector('#Berror_update').textContent = 'Please input a valid email address';
                return;
            }
            $('#Berror_update').hide();
            //checking if account number is submitted
            if(accountnumber.trim() === ''){
                $('#Berror_update').show();
                document.querySelector('#Berror_update').textContent = 'Please put in bank account number';
                return;
            }
            $('#Berror_update').hide();
            //checking if account number submitted is a number
           if(!/^[0-9]+$/.test(accountnumber.trim())){
               $('#Berror_update').show();
               document.querySelector('#Berror_update').textContent = 'Account number can only be numbers';
               return;
           }
           $('#Berror_update').hide();
           //checking the length of account number
           if(accountnumber.trim().length != 10){
                $('#Berror_update').show();
                document.querySelector('#Berror_update').textContent = 'Please put in your 10 digit bank account number';
                return;
            }
            $('#Berror_update').hide();
           //checking if password is submitted
           if(password.trim() === ''){
                $('#Berror_update').show();
                document.querySelector('#Berror_update').textContent = 'Please put in your password';
                return;
            }
            $('#Berror_update').hide();
           
            //object to be sent to endpoint
           let sendData = { 
               bankname:bankname.trim(), 
               accountname:accountname.trim(), 
               accountnumber:accountnumber.trim(), 
               email:email.trim(), 
               password:password.trim()
            }
            document.querySelector('#bankBtn').textContent = 'Processing...'
           $.ajax({
                   type: "POST",
                   url: '/scripts/php/bankdetails.php',//endpoint 
                   data: sendData,
                //    dataType:'text',
                   success: function(data){
                    document.querySelector('#bankBtn').textContent = 'Update'
                       if(data.success){
                            $('#Bsuccess_update').show();
                            document.querySelector('#Bsuccess_update').textContent = data.success;
                       }else{
                        $('#rsuccess_update').hide();
                        $('#Berror_update').show();
                        document.querySelector('#Berror_update').textContent = data.error;
                        return;
                       }
                       $('#Berror_update').hide();
                   }
               });
        })
    }
    processRegister()
   })()