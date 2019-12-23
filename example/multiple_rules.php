<?php
include '../src/rules/RuleInterface.php';
include '../src/rules/BaseRule.php';
include '../src/rules/CssHiddenFieldRule.php';
include '../src/rules/JavascriptGeneratedHiddenFieldRule.php';
include '../src/rules/FormTimeTrapRule.php';
include '../src/rules/SessionTimeTrapRule.php';
include '../src/NoCaptchaAntiSpam.php';

use daxslab\nocaptcha\NoCaptchaAntiSpam;
use daxslab\nocaptcha\rules\CssHiddenFieldRule;
use daxslab\nocaptcha\rules\FormTimeTrapRule;
use daxslab\nocaptcha\rules\JavascriptGeneratedHiddenFieldRule;
use daxslab\nocaptcha\rules\SessionTimeTrapRule;

$title = "Multiple checks";

// Session based time trap needs an active session
session_start();

// Declare rules
$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            CssHiddenFieldRule::create([
                'name' => 'contact_field1'
            ]),
            JavascriptGeneratedHiddenFieldRule::create([
                'name' => 'contact_field2',
                'parentSelector' => 'form#contactForm',
            ]),
            FormTimeTrapRule::create([
                'name' => 'contact_field3',
                'time' => 3,
            ]),
            SessionTimeTrapRule::create([
                'time' => 3,
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
