(function () {
    function buyCommodity() {
        var formCommodity = document.querySelector('#commodity_buyForm')
        formCommodity.addEventListener('submit', function (e) {
            e.preventDefault()
            var fullName = document.querySelector('#clientName').value
            // var phone = document.querySelector('#telephone').value
            // var countryName = document.querySelector('#country').value
            // var email = document.querySelector('#clientEmail').value
            // var clientCompany = document.querySelector('#company').value
            // var clientRequest = document.querySelector('#request').value
            // var proposalFile = document.querySelector('#proposal').value
            // var reg = /^[a-zA-Z0-9\s]+$/
            //checking if name is present
            if (fullName.trim() === '') {
                $('#error_buyMesssage').show();
                document.querySelector('#error_buyMessage').textContent = 'Please put in a name';
                // return;
                console.log(fullName);
            }
            $('#error_buyMesssage').hide();
            //checking the lenght of name
            if (fullName.length < 2 || fullName.length > 90) {
                $('#error_buyMesssage').show();
                document.querySelector('#error_buyMesssage').textContent = 'Please input a proper name';
                return;
            }
            $('#error_conmessage').hide();
            //checking if name is alphanumeric
            if (!reg.test(fullName)) {
                $('#error_conmessage').show();
                document.querySelector('#error_conmessage').textContent = 'Name can only be Alphanumeric';
                return;
            }
            // $('#error_conmessage').hide();
            //checking if mobile number is submitted
            // if (telephone.trim() === '') {
            //     $('#error_conmessage').show();
            //     document.querySelector('#error_conmessage').textContent = 'Please put in a mobile number';
            //     return;
            // }
            // $('#error_conmessage').hide();
            //checking if mobile number submitted is a number
            // if (!/^[0-9]+$/.test(telephone)) {
            //     $('#error_conmessage').show();
            //     document.querySelector('#error_conmessage').textContent = 'Mobile number can only be numbers';
            //     return;
            // }
            // $('#error_conmessage').hide();
            //checking the length of mobile number
            // if (telephone.length < 6 || telephone.length > 16) {
            //     $('#error_conmessage').show();
            //     document.querySelector('#error_conmessage').textContent = 'Please input a proper Mobile number';
            //     return;
            // }
            // $('#error_conmessage').hide();
            //checking if email is submitted
            if (clientEmail.trim() === '') {
                $('#error_conmessage').show();
                document.querySelector('#error_conmessage').textContent = 'Please put in an email';
                return;
            }
            $('#error_conmessage').hide();
            //regex to validate email
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //checking if the email submitted is valid
            if (!re.test(clientEmail)) {
                $('#error_conmessage').show();
                document.querySelector('#error_conmessage').textContent = 'Please input a valid email address';
                return;
            }
            $('#error_conmessage').hide();
            //checking if any message is submitted
            if (request.trim() === '') {
                $('#error_conmessage').show();
                document.querySelector('#error_conmessage').textContent = 'Please put in a message';
                return;
            }
            $('#error_conmessage').hide();
            //check for the lenght of the message
            if (request.length < 10) {
                $('#error_conmessage').show();
                document.querySelector('#error_conmessage').textContent = 'Please input a valid message';
                return;
            }
            $('#error_conmessage').hide();
            //checking if any message is submitted
            if (company.trim() === '') {
                $('#error_conmessage').show();
                document.querySelector('#error_conmessage').textContent = 'Please put in your company name';
                return;
            }
            $('#error_conmessage').hide();
            //check for the lenght of the message
            if (company.length < 10) {
                $('#error_conmessage').show();
                document.querySelector('#error_conmessage').textContent = 'Please input a valid company name';
                return;
            }




        })
    }
    buyCommodity()
})()