<?php 
$page = 'profile';
require_once "header.php"; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Profile</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix mbottom" style="background-color:#fff">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                    <div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
									<h5 class="m-t-5 m-b-25"><?php echo $fullName; ?></h5>
                                    <p class="m-b-0"><small>Email</small></p>
                                    <p class="m-b-2"><?php echo $email; ?></p>
                                    <p class="m-b-0"><small>Mobile</small></p>
									<p class="m-b-2"><?php echo $mobile; ?></p>
									<p class="m-b-0"><small>Password</small></p>
									<p class="m-b-2">xxxxxxxx  <a onclick="toggle(userPassReset)" style="color:#07c507; cursor: pointer;">Click to Change</a></p>
								</div>
								<div class="col-auto">
                                    <button type="button" onclick="toggle(userAccountDetails)" id="userAccountBtn" class="btn btn-primary m-t-15 waves-effect">Update Profile</button>
								</div>
							</div>
						</div>
                    </div>
                    <!-- to change user password  starts-->
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12" id="userPassReset" style="display:none">
                        <div class="card comp-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                    <div id="Perror_update" style="width:100%; display:none; color:red; margin: 5px"></div>
                                    <div id="Psuccess_update" style="width:100%; display:none; color:green; margin: 5px"></div>
                                        <form id="dashPassword">
                                            <input style="display:none" type="text" class="form-control" id="pemail" value="<?php echo $email; ?>">
                                            <input type="password" id="oldpassword" value="" placeholder="Old Password">
                                            <input type="password" id="password1" value="" placeholder="New Password">
                                            <input type="password" id="password2" value="" placeholder="Confirm Password">
                                            <button id="updatePassBtn" class="btn btn-primary m-t-15 waves-effect" type="submit">Reset Password</button>
                                        </form>
                                    </div>
                                    <div class="col-auto">
                                        <div class="chart chart-pie"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- to change user password ends-->

                    <!-- to change user info starts-->
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12" id="userAccountDetails" style="display:none;">
                        <div class="card comp-card">
                            <div class="card-body" style="border-left:1px solid black">
                                <div class="row align-items-center">
                                    <div class="col">
                                    <div id="Aerror_update" style="width:100%; display:none; color:red; text-align: center; margin: 5px"></div>
                                    <div id="Asuccess_update" style="width:100%; display:none; color:green; text-align: center; margin: 5px"></div>
                                        <form class="body" id="updateUserInfo">
                                            <input id="userEmail" style="display:none" type="text" class="form-control" value="<?php echo $email; ?>">
                                            <small>firstname</small>
                                            <input id="firstName" type="text" class="form-control" value="<?php echo $firstName; ?>" placeholder="First Name">
                                            <small>lastname</small>
                                            <input id="lastName" type="text" class="form-control" value="<?php echo $lastName; ?>" placeholder="Last Name">
                                            <small>mobile</small>
                                            <input id="userMobile" type="text" class="form-control" value="<?php echo $mobile; ?>" placeholder="Phone">
                                            <small>country of residence</small>
                                            <input id="userResidence" class="form-control" type="text" value="<?php echo $residence; ?>" placeholder="Country of residence">
                                            <small>country of origin</small>
                                            <input id="userNationality" class="form-control" type="text" value="<?php echo $nationality; ?>" placeholder="Country of Origin">
                                            <small>gender</small>
                                            <div class="form-group mt-3">
                                            <select id="gender" class="form-control select2" data-placeholder="Select">
                                            <?php
                                                if($userGender === 'male'){
                                                    echo '
                                                        <option value="'.$userGender .'">Male</option>
                                                        <option value="female">Female</option>
                                                    ';
                                                }elseif($userGender === 'female'){
                                                    echo '
                                                        <option value="'.$userGender .'">Female</option>
                                                        <option value="male">Male</option>
                                                    ';
                                                }else{
                                                    echo '
                                                        <option value="gender">Gender</option>
                                                        <option value="female">Female</option>
                                                        <option value="male">Male</option>
                                                    ';
                                                }
                                            ?>
                                            </select>
                                            </div>
                                            <small>dob</small>
                                            <input id="dob" type="text" onfocus="(this.type='date')" class="form-control" value="" placeholder = "Date of Birth">
                                                
                                            <button id="updateInfo" class="btn btn-primary m-t-15 waves-effect" type="submit">Update Account</button>
                                        </form>
                                    </div>
                                    <div class="col-auto">
                                        <div class="chart chart-pie"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- to change user info ends-->
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                    <div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center" style="border-left:1px solid black">
								<div class="col">
                                    <h5 class="m-t-5" style="color:#07c507">Account Verified <i class="fa fa-check-double"></i></h5>
									<p class="m-b-0"><small>Member since</small></p>
                                    <p class="m-b-2"><?php echo $dateJoin; ?></p>
                                    <p class="m-b-0"><small>Address</small></p>
                                    <p class="m-b-2" style="color:#07c507"><?php 
                                    if($userAddress === ''){
                                        echo 'Update your address';
                                    }else{
                                        echo $userAddress;
                                    }; ?></p>
                                    <p class="m-b-0"><small>Next of Kin</small></p>
                                    <p class="m-b-2"><?php 
                                    if($nextOfKin === ''){
                                        echo 'Update your Next of kin';
                                    }else{
                                        echo $nextOfKin;
                                    }; ?> <a onclick="toggle(nextOfKin)" id="nextOfKinBtn" style="color:#07c507; cursor: pointer;">Click to Change</a></p>
								</div>
								<div class="col-auto">
									<div class="chart chart-pie"></div>
								</div>
							</div>
						</div>
					</div>
                </div>
                 <!-- next of kins -->
                 <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12" id="nextOfKin" style="display:none">
                        <div class="card comp-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                    <div id="Nerror_update" style="width:100%; display:none; color:red; text-align: center; margin: 5px"></div>
                                    <div id="Nsuccess_update" style="width:100%; display:none; color:green; text-align: center; margin: 5px"></div>
                                        <form id="nextOfKinForm">
                                            <input id="nokEmail" style="display:none" type="text" class="form-control" value="<?php echo $email; ?>">
                                            <input id="nokName" type="text" value="<?php echo $nextOfKin; ?>" placeholder="Name of Next of kin">
                                            <input id="nokMobile" type="text" value="<?php echo $nokMobile; ?>" placeholder="Mobile Number">
                                            <input id="nokRelation" type="text" value="<?php echo $nokRelationship; ?>" placeholder = "Relationship">
                                            <input id="userResidence" type="text" value="<?php echo $nokAddress; ?>" placeholder="Address">
                                            <button id="nokBtn" class="btn btn-primary m-t-15 waves-effect" type="submit">Update</button>
                                        </form>
                                    </div>
                                    <div class="col-auto">
                                        <div class="chart chart-pie"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- next of kins -->
                <hr class="mt-3">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                    <div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
                                    <h5 class="m-t-5 m-b-20">Bank Information</h5>
									<p class="m-b-0">Bank Name</p>
                                    <p class="m-b-2"><?php 
                                    if($bankName === ''){
                                        echo 'Bank Name is empty';
                                    }else{
                                        echo $bankName;
                                    }; ?></p>
									<p class="m-b-0">Account Number</p>
                                    <p class="m-b-2"><?php 
                                    if($accountNumber === ''){
                                        echo 'Account Number is empty';
                                    }else{
                                        echo $accountNumber;
                                    }; ?></p>
									<p class="m-b-0">Account Name</p>
                                    <p class="m-b-0"><?php 
                                    if($accountName === ''){
                                        echo 'Account Name is empty';
                                    }else{
                                        echo $accountName;
                                    }; ?></p>
								</div>
								<div class="col-auto">
                                <?php 
                                if($bankName === '' || $accountName === '' || $accountNumber === ''){
                                    echo '<button type="button" onclick="toggle(bankDetails)" id="bankFormBtn" class="btn btn-primary m-t-15 waves-effect">Update Bank</button>';
                                }else{
                                    echo '<p>Please send a mail to hello@agrorite.com <br>to change your account details</p>';
                                }

                                ?>
                                    
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12" id="bankDetails" style="display:none">
                        <div class="card comp-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                    <div id="Berror_update" style="width:100%; display:none; color:red; text-align: center; margin: 5px"></div>
                                    <div id="Bsuccess_update" style="width:100%; display:none; color:green; text-align: center; margin: 5px"></div>
                                        <form class="body" id="mybankInfo">
                                            <input id="bankUserEmail" style="display:none" type="text" class="form-control" value="<?php echo $email; ?>">
                                            <input id="bankName" type="text" class="form-control" value="<?php echo $bankName; ?>" placeholder="Bank Name">
                                            <input id="bankNumber" type="text" class="form-control" value="<?php echo $accountNumber; ?>" placeholder="Account Number">
                                            <input id="bankAccountName" type="text" class="form-control" value="<?php echo $accountName; ?>" placeholder="Name on the Account">
                                            <input id="bankPassword" type="password" class="form-control" value="" placeholder="comfirm your password please">
                                            <button id="bankBtn" class="btn btn-primary m-t-15 waves-effect" type="submit">Update</button>
                                        </form>
                                    </div>
                                    <div class="col-auto">
                                        <!-- <div class="chart chart-pie"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                    <div class="card comp-card">
						<div class="card-body">
                        <h5 class=" m-b-20">Profile Picture</h5>
							<div class="row align-items-center">
                                <div class='image-edit mb-2'>
                                    <img id="imgTampil" alt="" src="<?php echo $baseUrl; ?>/assets/img/user/<?php if($userPicture){ echo $userPicture;}else {echo 'user-avatar.png';} ?>" class="imag-service"/>
                                </div>
                                <div class="custom-file">
                                    <form id="updatePicture" method="post" enctype="multipart/form-data">
                                        <input class="mb-2" id="userPicture" name="userPicture" onchange="displ_img();" value="<?php echo $userImg; ?>" type="file" accept="image/*" />
                                        <input type="email" value="<?php echo $email; ?>" id="userEmail" style="display:none" disabled>
                                        <button id="uploadBtn" type="submit" class="btn btn-primary waves-effect">UPLOAD</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once "footer.php"; ?>
    <script src="assets/js/form.min.js"></script>
    <script src="assets/js/pages/forms/basic-form-elements.js"></script>
    

    <script type="text/javascript">
    var show = function (elem) {
        elem.style.display = 'block';
        };
        // Hide an element
        var hide = function (elem) {
            elem.style.display = 'none';
        };
        // Toggle element visibility
        var toggle = function (elem) {
            // If the element is visible, hide it
            if (window.getComputedStyle(elem).display === 'block') {
                hide(elem);
                return;
            }
            // Otherwise, show it
            show(elem);

        };
</script>
<script src="<?php echo $baseUrl; ?>/scripts/js/newpassword2.js"></script>
<script src="<?php echo $baseUrl; ?>/scripts/js/updateaccount.js"></script>
<script src="<?php echo $baseUrl; ?>/scripts/js/nextofkin.js"></script>
<script src="<?php echo $baseUrl; ?>/scripts/js/bankdetails.js"></script>
<script src="<?php echo $baseUrl; ?>/scripts/js/upload.js"></script>
<script>
function displ_img() {
//to display the image
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("userPicture").files[0]);
	oFReader.onload = function (oFREvent) {
	document.getElementById("imgTampil").src = oFREvent.target.result;
	};
};
</script>

<div class="modal fade" id="uploadSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <p class="mt-4">Your Upload was Successful</p>
        <button type="button" onclick="window.location.href='<?php echo $dashboardUrl; ?>/profile'" class="btn btn-outline-primary m-t-15 waves-effect mb-40">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <p id="errorMessage" class="mt-4">There was an error with your upload</p>
        <button type="button" onclick="window.location.href='<?php echo $dashboardUrl; ?>/profile'" class="btn btn-outline-primary m-t-15 waves-effect mb-40">Close</button>
      </div>
    </div>
  </div>
</div>