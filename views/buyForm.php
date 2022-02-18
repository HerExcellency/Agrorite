<?php
$title = "Place an order || Agrorite Limited";
require_once "header.php";
?>

<div class="header-space"></div>
  <!-- Header End -->
  <!-- Breadcrumb Area Start -->
  <nav class="breadcrumb-area bg-dark bg-6 ptb-20 n40">
    <div class="container d-md-flex">
      <h2 class="text-white mb-0">Purchase Form</h2>
      <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
        <li class="breadcrumb-item"><a class="text-white" href="index">Home</a> <span class="text-white">/</span></li>
        <li aria-current="page" class="breadcrumb-item active text-white">Purchase Form</li>
      </ol>
    </div>
  </nav>
  <!-- Breadcrumb Area End -->
  <!-- Contact Area Start -->
  <section class="contact-area section-ptb white-bg">
    <div class="container">
      <div class="row mb-70 d-flex align-items-center">
        
        
        <!-- Contact Info End -->
        <div class="col-12 col-md-8 col-lg-8 center-form">
          <div class="contact-form">
            <h2>Leave a Message</h2>
            <div id="error_buymessage" style="width:100%; height:100%; display:none; color:red; text-align: center; margin:20px"></div>
            <div id="success_buymessage" style="width:100%; height:100%; display:none; color:green; text-align: center; margin:20px"></div>
            
            <form class="form-group" id="buyCommodityForm" method="POST" >
              <div class="row">
                <div class="col-12 col-md-6">
                  <input class="form-control" type="text" name="name" id="userName"   placeholder="Your Name">
                </div>
                <div class="col-12 col-md-6">
                  <input class="form-control" type="email" name="email" id="userEmail"  placeholder="Your Email">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6">
                  <input class="form-control" type="text" name="subject"  id="contactCompany" placeholder="Company's Name">
                </div>
                <div class="col-12 col-md-6">
                  <input class="form-control" type="text"  name="name" id="userMobile" placeholder="Mobile Number">
                </div>
              </div>
            <div class="row">
                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <label>Location</label>
                        <select id="country" name="country" type="text"  class="form-control" placeholder="Select Country">
                            <option value=''>Select Location</option>
                            <option>Afghanistan</option>
                            <option>Aland Islands</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                            <option>American Samoa</option>
                            <option>Andorra</option>
                            <option>Angola</option>
                            <option>Anguilla</option>
                            <option>Antarctica</option>
                            <option>Antigua and Barbuda</option>
                            <option>Argentina</option>
                            <option>Armenia</option>
                            <option>Aruba</option>
                            <option>Australia</option>
                            <option>Austria</option>
                            <option>Azerbaijan</option>
                            <option>Bahamas</option>
                            <option>Bahrain</option>
                            <option>Bangladesh</option>
                            <option>Barbados</option>
                            <option>Belarus</option>
                            <option>Belgium</option>
                            <option>Belize</option>
                            <option>Benin</option>
                            <option>Bermuda</option>
                            <option>Bhutan</option>
                            <option>Bolivia</option>
                            <option>Bonaire, Sint Eustatius and Saba</option>
                            <option>Bosnia and Herzegovina</option>
                            <option>Botswana</option>
                            <option>Bouvet Island</option>
                            <option>Brazil</option>
                            <option>British Indian Ocean Territory</option>
                            <option>Brunei Darussalam</option>
                            <option>Bulgaria</option>
                            <option>Burkina Faso</option>
                            <option>Burundi</option>
                            <option>Cambodia</option>
                            <option>Cameroon</option>
                            <option>Canada</option>
                            <option>Cape Verde</option>
                            <option>Cayman Islands</option>
                            <option>Central African Republic</option>
                            <option>Chad</option>
                            <option>Chile</option>
                            <option>China</option>
                            <option>Christmas Island</option>
                            <option>Cocos (Keeling) Islands</option>
                            <option>Colombia</option>
                            <option>Comoros</option>
                            <option>Congo</option>
                            <option>Congo, Democratic Republic of the Congo</option>
                            <option>Cook Islands</option>
                            <option>Costa Rica</option>
                            <option>Cote D'Ivoire</option>
                            <option>Croatia</option>
                            <option>Cuba</option>
                            <option>Curacao</option>
                            <option>Cyprus</option>
                            <option>Czech Republic</option>
                            <option>Denmark</option>
                            <option>Djibouti</option>
                            <option>Dominica</option>
                            <option>Dominican Republic</option>
                            <option>Ecuador</option>
                            <option>Egypt</option>
                            <option>El Salvador</option>
                            <option>Equatorial Guinea</option>
                            <option>Eritrea</option>
                            <option>Estonia</option>
                            <option>Ethiopia</option>
                            <option>Falkland Islands (Malvinas)</option>
                            <option>Faroe Islands</option>
                            <option>Fiji</option>
                            <option>Finland</option>
                            <option>France</option>
                            <option>French Guiana</option>
                            <option>French Polynesia</option>
                            <option>French Southern Territories</option>
                            <option>Gabon</option>
                            <option>Gambia</option>
                            <option>Georgia</option>
                            <option>Germany</option>
                            <option>Ghana</option>
                            <option>Gibraltar</option>
                            <option>Greece</option>
                            <option>Greenland</option>
                            <option>Grenada</option>
                            <option>Guadeloupe</option>
                            <option>Guam</option>
                            <option>Guatemala</option>
                            <option>Guernsey</option>
                            <option>Guinea</option>
                            <option>Guinea-Bissau</option>
                            <option>Guyana</option>
                            <option>Haiti</option>
                            <option>Heard Island and Mcdonald Islands</option>
                            <option>Holy See (Vatican City State)</option>
                            <option>Honduras</option>
                            <option>Hong Kong</option>
                            <option>Hungary</option>
                            <option>Iceland</option>
                            <option>India</option>
                            <option>Indonesia</option>
                            <option>Iran, Islamic Republic of</option>
                            <option>Iraq</option>
                            <option>Ireland</option>
                            <option>Isle of Man</option>
                            <option>Israel</option>
                            <option>Italy</option>
                            <option>Jamaica</option>
                            <option>Japan</option>
                            <option>Jersey</option>
                            <option>Jordan</option>
                            <option>Kazakhstan</option>
                            <option>Kenya</option>
                            <option>Kiribati</option>
                            <option>Korea, Democratic People's Republic of</option>
                            <option>Korea, Republic of</option>
                            <option>Kosovo</option>
                            <option>Kuwait</option>
                            <option>Kyrgyzstan</option>
                            <option>Lao People's Democratic Republic</option>
                            <option>Latvia</option>
                            <option>Lebanon</option>
                            <option>Lesotho</option>
                            <option>Liberia</option>
                            <option>Libyan Arab Jamahiriya</option>
                            <option>Liechtenstein</option>
                            <option>Lithuania</option>
                            <option>Luxembourg</option>
                            <option>Macao</option>
                            <option>Macedonia, the Former Yugoslav Republic of</option>
                            <option>Madagascar</option>
                            <option>Malawi</option>
                            <option>Malaysia</option>
                            <option>Maldives</option>
                            <option>Mali</option>
                            <option>Malta</option>
                            <option>Marshall Islands</option>
                            <option>Martinique</option>
                            <option>Mauritania</option>
                            <option>Mauritius</option>
                            <option>Mayotte</option>
                            <option>Mexico</option>
                            <option>Micronesia, Federated States of</option>
                            <option>Moldova, Republic of</option>
                            <option>Monaco</option>
                            <option>Mongolia</option>
                            <option>Montenegro</option>
                            <option>Montserrat</option>
                            <option>Morocco</option>
                            <option>Mozambique</option>
                            <option>Myanmar</option>
                            <option>Namibia</option>
                            <option>Nauru</option>
                            <option>Nepal</option>
                            <option>Netherlands</option>
                            <option>Netherlands Antilles</option>
                            <option>New Caledonia</option>
                            <option>New Zealand</option>
                            <option>Nicaragua</option>
                            <option>Niger</option>
                            <option>Nigeria</option>
                            <option>Niue</option>
                            <option>Norfolk Island</option>
                            <option>Northern Mariana Islands</option>
                            <option>Norway</option>
                            <option>Oman</option>
                            <option>Pakistan</option>
                            <option>Palau</option>
                            <option>Palestinian Territory, Occupied</option>
                            <option>Panama</option>
                            <option>Papua New Guinea</option>
                            <option>Paraguay</option>
                            <option>Peru</option>
                            <option>Philippines</option>
                            <option>Pitcairn</option>
                            <option>Poland</option>
                            <option>Portugal</option>
                            <option>Puerto Rico</option>
                            <option>Qatar</option>
                            <option>Reunion</option>
                            <option>Romania</option>
                            <option>Russian Federation</option>
                            <option>Rwanda</option>
                            <option>Saint Barthelemy</option>
                            <option>Saint Helena</option>
                            <option>Saint Kitts and Nevis</option>
                            <option>Saint Lucia</option>
                            <option>Saint Martin</option>
                            <option>Saint Pierre and Miquelon</option>
                            <option>Saint Vincent and the Grenadines</option>
                            <option>Samoa</option>
                            <option>San Marino</option>
                            <option>Sao Tome and Principe</option>
                            <option>Saudi Arabia</option>
                            <option>Senegal</option>
                            <option>Serbia</option>
                            <option>Serbia and Montenegro</option>
                            <option>Seychelles</option>
                            <option>Sierra Leone</option>
                            <option>Singapore</option>
                            <option>Sint Maarten</option>
                            <option>Slovakia</option>
                            <option>Slovenia</option>
                            <option>Solomon Islands</option>
                            <option>Somalia</option>
                            <option>South Africa</option>
                            <option>South Georgia and the South Sandwich Islands</option>
                            <option>South Sudan</option>
                            <option>Spain</option>
                            <option>Sri Lanka</option>
                            <option>Sudan</option>
                            <option>Suriname</option>
                            <option>Svalbard and Jan Mayen</option>
                            <option>Swaziland</option>
                            <option>Sweden</option>
                            <option>Switzerland</option>
                            <option>Syrian Arab Republic</option>
                            <option>Taiwan, Province of China</option>
                            <option>Tajikistan</option>
                            <option>Tanzania, United Republic of</option>
                            <option>Thailand</option>
                            <option>Timor-Leste</option>
                            <option>Togo</option>
                            <option>Tokelau</option>
                            <option>Tonga</option>
                            <option>Trinidad and Tobago</option>
                            <option>Tunisia</option>
                            <option>Turkey</option>
                            <option>Turkmenistan</option>
                            <option>Turks and Caicos Islands</option>
                            <option>Tuvalu</option>
                            <option>Uganda</option>
                            <option>Ukraine</option>
                            <option>United Arab Emirates</option>
                            <option>United Kingdom</option>
                            <option>United States</option>
                            <option>United States Minor Outlying Islands</option>
                            <option>Uruguay</option>
                            <option>Uzbekistan</option>
                            <option>Vanuatu</option>
                            <option>Venezuela</option>
                            <option>Viet Nam</option>
                            <option>Virgin Islands, British</option>
                            <option>Virgin Islands, U.s.</option>
                            <option>Wallis and Futuna</option>
                            <option>Western Sahara</option>
                            <option>Yemen</option>
                            <option>Zambia</option>
                            <option>Zimbabwe</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6" style="align-self: center">
                    <div class="form-group">
                        
                        <label for="img">
                            <input type="file" id="proposal" name="proposal" accept=".doc,.docx,application/msword,.pdf">

                    </div>
                </div>
            </div>
              <textarea class="form-control" name="message" id="userMessage" rows="3" placeholder="Your Message"></textarea>
              <button class="btn btn-primary mt-5" type="submit" id="bSend" data-complete-text="Well done!">Send Message</button>
            </form>   
            <div id="status"></div>  
            

          </div>
          
        </div>
      </div>
    </div>
  </section>



<?php require_once "footer.php"; ?>
<script src="<?php echo $urlLink; ?>/scripts/js/buyForm.js"></script>

        
        