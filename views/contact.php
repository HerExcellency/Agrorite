<?php
$title = "Contact Us || Agrorite Limited";
require_once "header.php";
?>
  <div class="header-space"></div>
 
  <nav class="breadcrumb-area bg-dark bg-6 ptb-20 n40">
    <div class="container d-md-flex">
      <h2 class="text-white mb-0">Contact Us</h2>
      <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
        <li class="breadcrumb-item"><a class="text-white" href="index">Home</a> <span class="text-white">/</span></li>
        <li aria-current="page" class="breadcrumb-item active text-white">Contact Us</li>
      </ol>
    </div>
  </nav>

  <section class="contact-area section-ptb white-bg">
    <div class="container">
      <div class="row mb-70 d-flex align-items-center">
        <div class="col-12 col-md-6 col-lg-8 mb-sm-30">
        <div class="shadow-div">
          <div class="gmap-area">
          <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d8760.060528442247!2d3.4676777864142188!3d6.4398985594286895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s1B%20Olabanji%20Olajide%20Crescent%2C%20Off%20Mobolaji%20Johnson%20Estate%2C%20Lekki%20Phase%201%2C%20Lagos.!5e0!3m2!1sen!2sng!4v1593293438526!5m2!1sen!2sng" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          </div>
          </div>
        </div>
        
        <!-- Contact Info End -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="contact-form">
            <h3>Leave a Message</h23>
            <div id="error_conmessage" style="width:100%; height:100%; display:none; color:red; text-align: center; margin:20px"></div>
            <div id="success_conmessage" style="width:100%; height:100%; display:none; color:green; text-align: center; margin:20px"></div>
            
            <form class="form-group" id="contact-form">
              <div class="row">
                <div class="col-12 col-md-6">
                  <input class="form-control" type="text" name="name" id="userName" placeholder="Name">
                </div>
                <div class="col-12 col-md-6">
                  <input class="form-control" type="email" name="email" id="userEmail" placeholder="Email">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6">
                  <input class="form-control" type="text" name="subject" id="contact_subject" placeholder="Subject">
                </div>
                <div class="col-12 col-md-6">
                  <input class="form-control" type="text" name="name" id="userMobile" placeholder="Mobile">
                </div>
              </div>
              <textarea class="form-control" name="message" id="userMessage" rows="3" placeholder=" Message"></textarea>
              <button class="btn btn-primary mt-5" type="submit" id="cSend" data-complete-text="Well done!">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Area End -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_Agsvf36du-7l_mp8iu1a-rXoKcWfs2I"></script>
	<script src="assets/js/map-active.js"></script>
  <?php require_once "footer.php"; ?>
  <script src="<?php echo $urlLink; ?>/scripts/js/contact.js"></script>



