(function () {
    function processBuyForm() {
        var formBuy = document.querySelector('#buyCommodityForm')
        formBuy.addEventListener('submit', function (e) {
            e.preventDefault()
            var fullname = document.querySelector('#userName').value
            var email = document.querySelector('#userEmail').value
            var companyName = document.querySelector('#contactCompany').value
            var country = document.querySelector('#country').value
            var phone = document.querySelector('#userMobile').value
            var proposal = document.querySelector('#proposal').value
            var message = document.querySelector('#userMessage').value
            var proposal =document.querySelector('#proposal').value
            // console.log(country)
            // return
            
            // proposalAvail = proposalAvail.trim()
            
            $('#proposal').change(function(){
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
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please put in a name';
            }
            $('#error_buymessage').hide();
            //checking the lenght of name
            if (fullname.length < 2 || fullname.length > 90) {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please input a proper name';
                return;
            }
            $('#error_buymessage').hide();
            //checking if name is alphanumeric
            if (!reg.test(fullname)) {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Name can only be Alphanumeric';
                return;
            }
            $('#error_buymessage').hide();
            
            //checking if email is submitted
            if (email.trim() === '') {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please put in an email';
                return;
            }
            $('#error_buymessage').hide();
            //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if (!re.test(email)) {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please input a valid email address';
                return;
            }
            $('#error_buymessage').hide();
            //checking company name
            if (companyName.trim() === '' || companyName.length < 2) {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please put in your company name or indicate self enquiry';
                return;
            }
            $('#error_buymessage').hide();
            //checking if mobile number is submitted
            if (phone.trim() === '') {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please put in a mobile number';
                return;
            }
            $('#error_buymessage').hide();
            //checking if mobile number submitted is a number
            if (!/^[0-9]+$/.test(phone)) {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Mobile number can only be numbers';
                return;
            }
            $('#error_buymessage').hide();
            //checking the length of mobile number
            if (phone.length < 6 || phone.length > 16) {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please input a proper Mobile number';
                return;
            }
            $('#error_buymessage').hide();
              
            //checking if any message is submitted
            if (message.trim() === '') {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please put in a message';
                return;
            }
            $('#error_buymessage').hide();
            //check for the lenght of the message
            if (message.length < 10) {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please input a valid message';
                return;
            }
            $('#error_buymessage').hide();
             //checking if country is selected
             if (country.trim() === '') {
                $('#error_buymessage').show();
                document.querySelector('#error_buymessage').textContent = 'Please choose a country';
            }
            $('#error_buymessage').hide();
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
            document.querySelector('#bSend').textContent = 'Sending now...'
            $.ajax({
                type: "POST",
                url: './scripts/php/buyForm.php', 
                data: sendData,
                // dataType:'text',
                success: function (data) {
                    if (data.success) {
                        $('#success_buymessage').show();
                        document.querySelector('#success_buymessage').textContent = data.success;

                        document.querySelector('#userName').value = ''
                        document.querySelector('#userEmail').value = ''
                        document.querySelector('#contactCompany').value = ''
                        document.querySelector('#country').value = ''
                        document.querySelector('#userMobile').value = ''
                        document.querySelector('#proposal').value = ''
                        document.querySelector('#userMessage').value = ''
                        document.querySelector('#bSend').textContent = 'Send Message'
                    } else {
                        $('#success_buymessage').hide();
                        $('#error_buymessage').show();
                        document.querySelector('#error_buymessage').textContent = data.error
                        document.querySelector('#bSend').textContent = 'Send Message'
                        return;
                    }
                    $('#error_buymessage').hide();
                }
            });
        })
    }
    processBuyForm()
})()