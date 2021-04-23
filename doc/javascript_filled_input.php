<?php
include '../lib/rules/RuleInterface.php';
include '../lib/rules/BaseRule.php';
include '../lib/rules/JavascriptFilledInputRule.php';
include '../lib/NoCaptchaAntiSpam.php';

use daxslab\nocaptcha\NoCaptchaAntiSpam;
use daxslab\nocaptcha\rules\JavascriptFilledInputRule;

$title = "JavaScript filled input";

// Declare no captcha anti spam object with javascript based hidden field check
$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            JavascriptFilledInputRule::create([
                // form input field name
                'name' => 'contact_required',
                // input value used for rule check
                'inputValue' => 'somevalue',
            ])
        ],
]);

?>

<?php
include_once('common/header.php');
?>

<div class="row">
    <div class="col-md-12">

        <h1><?= $title ?></h1>

        <p>
            A hidden input that will be automatically filled with a selected value using JavaScript.
        </p>

        <h2>Example:</h2>

        <!--  show an alert message if it's a bot submit  -->
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
            <button type="submit" name="submit_button" class="btn btn-primary">Submit</button>
            <!--  Include rules form elements  -->
            <?= $noCaptchaAntiSpam->renderRules() ?>
        </form>

        <br>
        <h2>PHP example code:</h2>

        <?php
        $code = <<< EOT
<?php
use daxslab\\nocaptcha\\NoCaptchaAntiSpam;
use daxslab\\nocaptcha\\rules\\JavascriptFilledInputRule;

// Declare no captcha anti spam object with javascript based hidden field check
\$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            JavascriptFilledInputRule::create([
                // form input field name
                'name' => 'contact_required',
                // input value used for rule check
                'inputValue' => 'somevalue',
            ])
        ],
]);

<!--  show an alert message if is a bot submit  -->
<?php if (\$_POST): ?>
    <?php if (\$noCaptchaAntiSpam->checkSubmit()): ?>
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
        <input type="email" name="contact_body" class="form-control" id="contactEmail1" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="contactBody">Body</label>
        <textarea name="contact_email" class="form-control" id="contactBody" placeholder="Write to us"></textarea>
    </div>
    <button type="submit" name="submit_button" class="btn btn-primary">Submit</button>
    <!--  Include rules form elements  -->
    <?= \$noCaptchaAntiSpam->renderRules() ?>
</form>

EOT;

        ?>

        <pre>
            <code class="HTML">
<?= htmlspecialchars($code) ?>
            </code>
        </pre>
    </div>
</div>

<?php
include_once('common/footer.php');
?>
