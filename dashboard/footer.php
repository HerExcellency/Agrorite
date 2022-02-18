<!-- Plugins Js -->
<!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5db01e1bdf22d91339a0976b/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
<!--End of Tawk.to Script-->

<script src="//code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="<?php echo $dashboardUrl; ?>/assets/js/app.min.js"></script>
<script src="<?php echo $dashboardUrl; ?>/assets/js/table.min.js"></script>
<script src="<?php echo $dashboardUrl; ?>/assets/js/chart.min.js"></script>
<script src="<?php echo $dashboardUrl; ?>/assets/js/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Custom Js -->
<script src="<?php echo $dashboardUrl; ?>/assets/js/admin.js"></script>
<script src="<?php echo $dashboardUrl; ?>/assets/js/pages/index.js"></script>
<script src="<?php echo $dashboardUrl; ?>/assets/js/pages/ecommerce/product-detail.js"></script>
<script src="<?php echo $dashboardUrl; ?>/assets/js/pages/tables/jquery-datatable.js"></script>

<!--Floating WhatsApp css-->
<link rel="stylesheet" href="//rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
<!--Floating WhatsApp javascript-->
<script type="text/javascript" src="//rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
<!--Div where the WhatsApp will be rendered-->
<div id="WAButton"></div>
</body>
</html>
<!-- script for the current navigation -->

<script>
  $(function() {
    var myDate2 = new Date();  
    if (myDate2.getHours() < 12) {
        var greeting = "Good Morning, ";
    }
    else if(myDate2.getHours() >=12 && myDate.getHours() <=17){
        var greeting = "Good Afternoon, ";
    }
    else if (myDate2.getHours() > 17 && myDate.getHours() <=24) {
        var greeting = "Good Evening, ";
    }
  $('#WAButton').floatingWhatsApp({
    phone: '2348035429041', //WhatsApp Business phone number International format-
    //Get it with Toky at https://toky.co/en/features/whatsapp.
    headerTitle: 'Chat with us on WhatsApp!', //Popup Title
    popupMessage: greetings +'how can we help you?', //Popup Message
    showPopup: true, //Enables popup display
    buttonImage: '<img src="//rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
    //headerColor: 'crimson', //Custom header color
    //backgroundColor: 'crimson', //Custom background button color
    position: "left"    
  });
});
</script>
