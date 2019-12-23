<?php
include '../src/rules/RuleInterface.php';
include '../src/rules/BaseRule.php';
include '../src/rules/JavascriptGeneratedHiddenFieldRule.php';
include '../src/NoCaptchaAntiSpam.php';

use daxslab\nocaptcha\NoCaptchaAntiSpam;
use daxslab\nocaptcha\rules\JavascriptGeneratedHiddenFieldRule;

$title = "Javascript generated field honeypot";

// Declare no captcha anti spam object with javascript based hidden field check
$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            JavascriptGeneratedHiddenFieldRule::create([
                // form input field name
                'name' => 'contact_accept',
                // CSS selector used for inserting input element
                'parentSelector' => 'form#contactForm',
            ])
        ],
]);

?>

<?php
include_once('common/header.php');
?>

<div class="row">
    <div class="col-md-12">

        <!--  show an alert message if is a bot submit  -->
        <?php if ($_POST): ?>
            <?php if ($noCaptchaAntiSpam->checkSubmit()): ?>
                <div class="alert alert-success" role="alert">
                    Form submitted correctly
                </div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Bot detected
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form id="contactForm" method="post">
            <div class="form-group">
                <label for="contactName">Name</label>
                <input class="form-control" name="contact_name" id="contactName" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="contactEmail1">Email address</label>
                <input type="email" name="contact_email" class="form-control" id="contactEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="contactBody">Body</label>
                <textarea name="contact_body" class="form-control" id="contactBody" placeholder="Write to us"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <!--  Include rules form elements  -->
            <?= $noCaptchaAntiSpam->renderRules() ?>
        </form>
    </div>
</div>

<?php
include_once('common/footer.php');
?>