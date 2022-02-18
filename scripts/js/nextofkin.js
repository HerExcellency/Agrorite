// js file for the validation of user registration

(function(){
    function processRegister(){
        var formOne = document.querySelector('#nextOfKinForm')
        formOne.addEventListener('submit', function(e){
            e.preventDefault()
           var fullname = document.querySelector('#nokName').value
           var phone = document.querySelector('#nokMobile').value
           var email = document.querySelector('#nokEmail').value
           var relationship = document.querySelector('#nokRelation').value
           var address = document.querySelector('#nokAddress').value
           var reg = /^[a-zA-Z0-9_.-\s]*$/
            //checking if firstname is present
           if(fullname.trim() === ''){
                $('#Nerror_update').show();
                document.querySelector('#Nerror_update').textContent = 'Next of kin Name cannot be empty';
                return;
            }
            $('#Nerror_update').hide();
            //checking the lenght of firstname
           if(fullname.trim().length < 2 || fullname.length > 90){
               $('#Nerror_update').show();
               document.querySelector('#Nerror_update').textContent = 'Please input a proper Name for your next of kin';
               return;
           }
           $('#Nerror_update').hide();
           //checking if firstname is alphanumeric
           if(!reg.test(fullname.trim())){
            $('#Nerror_update').show();
            document.querySelector('#Nerror_update').textContent = 'Next of kin name can only be Alphanumberic';
            return;
           }
           $('#Nerror_update').hide();
             //checking if email is submitted
           if(email.trim() === ''){
            $('#Nerror_update').show();
            document.querySelector('#Nerror_update').textContent = 'Please put in an email';
            return;
            }
            $('#Nerror_update').hide();
                //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if(!re.test(email.trim())){
                $('#Nerror_update').show();
                document.querySelector('#Nerror_update').textContent = 'Please input a valid email address';
                return;
            }
            $('#Nerror_update').hide();
            //checking if mobile number is submitted
            if(phone.trim() === ''){
                $('#Nerror_update').show();
                document.querySelector('#Nerror_update').textContent = 'Please put in a mobile number';
                return;
            }
            $('#Nerror_update').hide();
            //checking if mobile number submitted is a number
           if(!/^[0-9]+$/.test(phone.trim())){
               $('#Nerror_update').show();
               document.querySelector('#Nerror_update').textContent = 'Mobile number can only be numbers';
               return;
           }
           $('#Nerror_update').hide();
           //checking the length of mobile number
           if(phone.trim().length < 6 || phone.trim().length >16){
                $('#Nerror_update').show();
                document.querySelector('#Nerror_update').textContent = 'Please input a proper Mobile number';
                return;
            }
            $('#Nerror_update').hide();
            if(relationship.trim() === ''){
                $('#Nerror_update').show();
                document.querySelector('#Nerror_update').textContent = 'Whats the relationship between you and your next of kin';
                return;
            }
            $('#Nerror_update').hide();
            if(address.trim() === ''){
                $('#Nerror_update').show();
                document.querySelector('#Nerror_update').textContent = 'Please input a proper Address';
                return;
            }
            $('#Nerror_update').hide();
            

           
            //object to be sent to endpoint
           let sendData = { 
               fullname:fullname.trim(), 
               phone:phone.trim(), 
               email:email.trim(), 
               address: address.trim(),
               relationship:relationship.trim()
            }
            document.querySelector('#nokBtn').textContent = 'Processing...'
           $.ajax({
                   type: "POST",
                   url: '/scripts/php/nok.php',//endpoint 
                   data: sendData,
                //    dataType:'text',
                   success: function(data){
                    document.querySelector('#nokBtn').textContent = 'Update'
                       if(data.success){
                            $('#Nsuccess_update').show();
                            document.querySelector('#Nsuccess_update').textContent = data.success;
                       }else{
                        $('#Nsuccess_update').hide();
                        $('#Nerror_update').show();
                        document.querySelector('#Nerror_update').textContent = data.error;
                        return;
                       }
                       $('#Nerror_update').hide();
                   }
               });
        })
    }
    processRegister()
   })()