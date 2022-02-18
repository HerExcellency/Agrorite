<?php
$title = "Place an order || Agrorite Limited";
require_once "header.php";
?>
<form id="frmContact" action="" method="post">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Name</label> <span
            id="userName-info" class="info"></span><br /> <input
            type="text" name="userName" id="userName"
            class="demoInputBox">
    </div>
    <div>
        <label>Email</label> <span id="userEmail-info" class="info"></span><br />
        <input type="text" name="userEmail" id="userEmail"
            class="demoInputBox">
    </div>
    <div>
        <label>Attachment</label><br /> <input type="file"
            name="attachmentFile" id="attachmentFile"
            class="demoInputBox">
    </div>
    <div>
        <label>Subject</label> <span id="subject-info" class="info"></span><br />
        <input type="text" name="subject" id="subject"
            class="demoInputBox">
    </div>
    <div>
        <label>Content</label> <span id="content-info" class="info"></span><br />
        <textarea name="content" id="content" class="demoInputBox"
            cols="60" rows="6"></textarea>
    </div>
    <div>
        <input type="submit" value="Send" class="btnAction" />
    </div>
</form>
<div id="loader-icon" style="display: none;">
    <img src="LoaderIcon.gif" />
</div>

<?php require_once "footer.php"; ?>
<script src="<?php echo $urlLink; ?>/scripts/js/testing.js"></script>