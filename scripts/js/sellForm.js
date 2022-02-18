(function () {
    function processSellForm() {
        var formSell = document.querySelector('#sellCommodityForm')
        formSell.addEventListener('submit', function (e) {
            e.preventDefault()
            var fullname = document.querySelector('#sellerName').value
            var email = document.querySelector('#sellerEmail').value
            var companyName = document.querySelector('#sellerCompany').value
            var country = document.querySelector('#country').value
            var phone = document.querySelector('#sellerMobile').value
            var proposal = document.querySelector('#sellerproposal').value
            var message = document.querySelector('#sellerMessage').value
            // var proposal =document.querySelector('#proposal').value
            
            // proposalAvail = proposalAvail.trim()
            
            $('#sellerproposal').change(function(){
                var file = this.files[0]
                var filetype = file.type;
                var match = ["file/doc", 'file/docx', 'file/pdf']
                
                if (!((filetype == match[0]) || (filetype == match[1]) || (filetype == match[2]))){
                    return showError("Upload either a doc, docx or pdf file")
                }
            })

            let proposalAvail = proposal
            var reg = /^[a-zA-Z0-9\s]+$/

            // fullname = fullname.trim()
            // message = message.trim()
            // proposalAvail = proposalAvail.trim()
            // company = companyName.trim()
            // email = email.trim()
            // country = country.trim()
            // phone = phone.trim()

    
        
    
            //checking if name is present
            if (fullname.trim() === '') {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please put in a name';
            }
            $('#error_sellmessage').hide();
            //checking the lenght of name
            if (fullname.length < 2 || fullname.length > 90) {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please input a proper name';
                return;
            }
            $('#error_sellmessage').hide();
            //checking if name is alphanumeric
            if (!reg.test(fullname)) {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Name can only be Alphanumeric';
                return;
            }
            $('#error_sellmessage').hide();
            
            //checking if email is submitted
            if (email.trim() === '') {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please put in an email';
                return;
            }
            $('#error_sellmessage').hide();
            //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if (!re.test(email)) {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please input a valid email address';
                return;
            }
            $('#error_sellmessage').hide();
            //checking company name
            if (companyName.trim() === '' || companyName.length < 2) {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please put in your company name or indicate self enquiry';
                return;
            }
            $('#error_sellmessage').hide();
            //checking if mobile number is submitted
            if (phone.trim() === '') {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please put in a mobile number';
                return;
            }
            $('#error_sellmessage').hide();
            //checking if mobile number submitted is a number
            if (!/^[0-9]+$/.test(phone)) {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Mobile number can only be numbers';
                return;
            }
            $('#error_sellmessage').hide();
            //checking the length of mobile number
            if (phone.length < 6 || phone.length > 16) {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please input a proper Mobile number';
                return;
            }
            $('#error_sellmessage').hide();
              
            //checking if any message is submitted
            if (message.trim() === '') {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please put in a message';
                return;
            }
            $('#error_sellmessage').hide();
            //check for the lenght of the message
            if (message.length < 10) {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please input a valid message';
                return;
            }
            $('#error_sellmessage').hide();
             //checking if country is selected
             if (country.trim() === '') {
                $('#error_sellmessage').show();
                document.querySelector('#error_sellmessage').textContent = 'Please choose a country';
            }
            $('#error_sellmessage').hide();
            //object to be sent to endpoint
            let sendData = {
                fullname: fullname,
                email: email,
                companyName : companyName,
                country : country,
                phone: phone,
                proposalAvail: proposalAvail,
                message: message
            }
            document.querySelector('#cSend').textContent = 'Sending now...'
            $.ajax({
                type: "POST",
                url: '/scripts/php/sellForm.php',//endpoint 
                data: sendData,
                // dataType:'text',
                success: function (data) {
                    if (data.success) {
                        $('#success_sellmessage').show();
                        document.querySelector('#success_sellmessage').textContent = data.success;

                        document.querySelector('#userName').value = ''
                        document.querySelector('#userEmail').value = ''
                        document.querySelector('#contactCompany').value = ''
                        document.querySelector('#country').value = ''
                        document.querySelector('#userMobile').value = ''
                        document.querySelector('#proposal').value = ''
                        document.querySelector('#userMessage').value = ''
                        document.querySelector('#cSend').textContent = 'Send Message'
                    } else {
                        $('#success_sellmessage').hide();
                        $('#error_sellmessage').show();
                        document.querySelector('#error_sellmessage').textContent = data.error
                        document.querySelector('#cSend').textContent = 'Send Message'
                        return;
                    }
                    $('#error_sellmessage').hide();
                }
            });
        })
    }
    processSellForm()
})()