<?php
include '../lib/rules/RuleInterface.php';
include '../lib/rules/BaseRule.php';
include '../lib/rules/CookieCheckRule.php';
include '../lib/NoCaptchaAntiSpam.php';

use daxslab\nocaptcha\NoCaptchaAntiSpam;
use daxslab\nocaptcha\rules\CookieCheckRule;

$title = "Cookie check";

// Declare no captcha anti spam object with cookie based check
$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            CookieCheckRule::create([
                // define cookie name
                'name' => 'cookie_rule',
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
            Most Spam bots doesn't use cookies, so, including a cookie and checking if it exists can detect a bot
            submission.
        </p>

        <h2>Example:</h2>

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
                <input type="email" name="contact_body" class="form-control" id="contactEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="contactBody">Body</label>
                <textarea name="contact_email" class="form-control" id="contactBody" placeholder="Write to us"></textarea>
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
use daxslab\\nocaptcha\\rules\\CookieCheckRule;

// Declare no captcha anti spam object with cookie based check
\$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            CookieCheckRule::create([
                // define cookie name
                'name' => 'cookie_rule',
            ])
        ],
]);

?>

<!--  show an alert message if it's a bot submit  -->
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
