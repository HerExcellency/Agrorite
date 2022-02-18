<?php require_once "header.php"; 
$row = mysqli_fetch_assoc($farmDetails);
$farmImg = $row['picture'];
$farmUnit = $row['units'];
$farmTitle = $row['title'];
$farmid = $row['id'];
$farmPercent = $row['percentage'];
$farmDuration = $row['duration'];
$farmPrice = number_format($row['cost'], 2);
$farmPrice1 = $row['cost'];
$percent = ($farmPercent/100) * $farmPrice1;
$expectedReturn1 = $farmPrice1 + $percent;
$expectedReturn = number_format($expectedReturn1, 2);
?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 mt-5">
                        <div class="card comp-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="m-t-5 m-b-20 mypl-20">You are about to sponsor this farm</h4>
                                    <p class="m-b-0 mypl-20">You can sponsor this farm by increasing or reducing the number of units to suit what you'd love to fund. As your number of farms changes, The Total Price, Payout (total price + the return percentage) are automatically calculated for you to see. Satisfied? Proceed and make your payment.</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="card">
                        <div class="card-body ">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="table-responsive">
                                                    <table class="table shoping-cart-table">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="cart-product-imitation">
                                                                        <img src="<?php echo $baseUrl; ?>/assets/img/product/<?php echo $farmImg; ?>"
                                                                            alt="">
                                                                    </div>
                                                                </td>
                                                                <td class="desc">
                                                                    <h3><?php echo $farmTitle; ?></h3>
                                                                    <p>
                                                                        <strong>ROI per unit:</strong> <span id="roi"><?php echo $farmPercent; ?></span>%
                                                                    </p>
                                                                    <p>
                                                                        <strong>Duration:</strong> <?php echo $farmDuration; ?> Months
                                                                    </p>
                                                                    <p>
                                                                        <strong>Unit Price: </strong> ₦<span id="unit-price"><?php echo $farmPrice; ?></span>
                                                                    </p>
                                                                    <p>
                                                                        <strong>Available Units: </strong><span id="availUnit"><?php echo $farmUnit; ?></span>
                                                                    </p>
                                                                    
                                                                </td>
                                                                <td style="text-align:left">
                                                                    <input type="number" id="unit-number" class="form-control inputwidth" min="1" value="1">
                                                                    <span class="small text-muted">Unit</span>
                                                                </td>
                                                                <td style="text-align:left">
                                                                    <h4>
                                                                    ₦<span id="total-price"><?php echo $farmPrice; ?></span>
                                                                    <span class="small text-muted">Total Price</span>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <button type="button" class="btn btn-primary waves-effect pull-right" data-toggle="modal" data-target="#openPayment">
                                                Pay Now
                                                </button>
                                                <p class="pull-right" style="margin:8px 20px; font-weight:bold">Payout: ₦<span id="payout"><?php echo $expectedReturn; ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
<div class="modal fade" id="openPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center">
            <h5 class="modal-title" style="color:#07c507">Payment Options</h5>
        </div>
        <p class="text-center mt-4">Hey <span style="color:#07c507"><?php echo $firstName; ?>,</span> We have created multiple payment options just for you. You can either pay with Card or via Bank. Your details are well secured.</p>
        <button type="button" onclick="getPayStack()" class="btn btn-border-radius btn-primary m-t-15 waves-effect w-100 mb-40">Pay With Paystack</button>
        <button type="button" onclick="getAmount()" class="btn btn-border-radius btn-primary m-t-15 waves-effect w-100 mb-40" data-toggle="modal" data-target="#bankPayment">Pay With Bank</button>
      </div>
      <div class="modal-footer mt-4">
      <p class="text-center">Have any troubles? call us or send us a whatsapp message at +234 803 542 9041 or email us at hello@agrorite.com</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bankPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center">
            <h5 class="modal-title" style="color:#07c507">Bank Payment Details</h5>
        </div>
        <div id="Berror_message" style="width:100%; display:none; color:red; text-align: center; margin: 5px"></div>
        <div id="Bsuccess_message" style="width:100%; display:none; color:green; text-align: center; margin: 5px"></div>
        <p class="text-center mt-4">Hey <span style="color:#07c507"><?php echo $firstName; ?>,</span> see Agrorite Limited bank details below. Please copy the details and click on the confirm transaction button to proceed.</p>
        <p class="" style="font-weight:bold">Amount to Pay: <span id="amountToPay"></span></p>
        
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <input id="" type="text" class="text-center" value="Agrorite Limited" placeholder="" disabled>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
        <input id="" type="text" class="text-center" value="6198280032" placeholder="" disabled>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
        <input id="" type="text" class="text-center" value="FCMB" placeholder="" disabled>
        </div>
        </div>
        <button id="myPayBtn" type="button" onclick="payWithBank()" class="btn btn-border-radius btn-primary m-t-15 waves-effect w-100 mb-40">Process Transaction</button>
      </div>
      <div class="modal-footer mt-4">
      <p class="text-center">Have any troubles? call us or send us a whatsapp message at +234 803 542 9041 or email us at hello@agrorite.com</p>
      </div>
    </div>
  </div>
</div>
<!-- paystack success -->
<div class="modal fade" id="paystackSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center">
            <h5 class="modal-title" style="color:#07c507">Your Payment Was Successful</h5>
        </div>
        <p class="text-center mt-4">Thank your for sponsoring our farm. The progress of your farm will appear on your dashboard soon</p>
        <button type="button" onclick="window.location.href='<?php echo $dashboardUrl; ?>'" class="btn btn-border-radius btn-primary m-t-15 waves-effect w-100 mb-40">Return to dashboard</button>
      </div>
      <div class="modal-footer mt-4">
      <p class="text-center">Have any troubles? call us or send us a whatsapp message at +234 803 542 9041 or email us at hello@agrorite.com</p>
      </div>
    </div>
  </div>
</div>
    

<?php require_once "footer.php"; ?>
<script src="<?php echo $dashboardUrl; ?>/assets/js/cart.js"></script>

<script>
//payment 
function getAmount(){
    var whatToPay = document.querySelector('#total-price').textContent
    document.querySelector('#amountToPay').textContent = whatToPay
}

</script>
<script>

function payWithBank(){
    var userId = <?php echo $userId; ?>;
    var farmId = <?php echo $farmid; ?>;
    var what2Pay = document.querySelector('#amountToPay').textContent
    var unit = document.querySelector('#unit-number').value
    function randomString(len) {
        var p = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return [...Array(len)].reduce(a=>a+p[~~(Math.random()*p.length)],'');
    }
    var invoiceId = randomString(4)
    sendData = {
        userid: userId,
        amount: what2Pay,
        invoice: invoiceId,
        unit:unit,
        farmid:farmId
    }
    document.querySelector('#myPayBtn').textContent = 'Processing...'
    $.ajax({
        type: "POST",
        url: '/scripts/php/bankpayment.php',//endpoint 
        data: sendData,
    //    dataType:'text',
        success: function(data){
        document.querySelector('#myPayBtn').textContent = 'Process Transaction'
            if(data.success){
                $('#openPayment').modal('hide')
                $('#Bsuccess_message').show();
                document.querySelector('#Bsuccess_message').textContent = data.success;
                setInterval(function(){ 
                    window.location = '../../dashboard/index'
                }, 3000);
            }else{
            $('#Bsuccess_message').hide();
            $('#Berror_message').show();
            document.querySelector('#Berror_message').textContent = data.error;
            return;
            }
            $('#Berror_message').hide();
        }
    });
}

</script>

<!-- Pay with paystack -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    var userMyId = <?php echo $userId; ?>;
    var farmMyId = <?php echo $farmid; ?>;
  function getPayStack(){
    var what2Pay2 = document.querySelector('#total-price').textContent
    var pay = what2Pay2.replace(/\,/g,'')
    var unit2 = document.querySelector('#unit-number').value
    function randomString1(len) {
        var p = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return [...Array(len)].reduce(a=>a+p[~~(Math.random()*p.length)],'');
    }
    var invoiceId2 = randomString1(4)
    sendData = {
        farmid:farmMyId,
        userid:userMyId,
        amount: what2Pay2,
        unit:unit2,
        invoice:invoiceId2
    }
    var handler = PaystackPop.setup({
      key: 'pk_live_b03e0062dc936307c9c4dfe63a50e995bf03851d',
      email: '<?php echo $email; ?>',
      amount: pay * 100,
      currency: "NGN", 
      ref: invoiceId2, 
      firstname: '<?php echo $firstName; ?>',
      lastname: '<?php echo $lastName; ?>',
      callback: function(response){
		  var status = response.status
		  if(status === 'success'){
			$.ajax({
                type: "POST",
                url: '/scripts/php/paystack.php',//endpoint 
                data: sendData,
            //    dataType:'text',
                success: function(data){
                    if(data.success){
                        $('#openPayment').modal('hide')
                        $('#paystackSuccess').modal('show')
                        // alert('Thank your for sponsoring our farm. The progress of your farm will appear on your dashboard soon')
                        // window.location = '../../dashboard/index'
                    }else{
                        alert(data.error)
                    }
                }
            });
		  }else{
			alert(status);
		  }
		  
			  
      },
    //   onClose: function(){
    //       alert('window closed');
    //   }
    });
    handler.openIframe();
  }
</script>