<?php
include '../lib/rules/RuleInterface.php';
include '../lib/rules/BaseRule.php';
include '../lib/rules/CssHiddenFieldRule.php';
include '../lib/NoCaptchaAntiSpam.php';

use daxslab\nocaptcha\NoCaptchaAntiSpam;
use daxslab\nocaptcha\rules\BaseRule;
use daxslab\nocaptcha\rules\CssHiddenFieldRule;

session_start();

$title = "Random field name";

// Declare no captcha anti spam object with CSS based hidden field check
$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            CssHiddenFieldRule::create([
                // form input field name
                'random_name' => BaseRule::RANDOM_MD5,
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
            Random field names can be applied for an extra security layer. Random field names are stored in session and 
            spam bots will find different field names on each visit.
        </p>
        
        <h2>Allowed <code>random_name</code> values</h2>

        <ul>
            <li><code>RANDOM_MD5</code>: Will generate a random MD5 hash as field name</li>
            <li><code>RANDOM_SHA1</code>: Will generate a random SHA1 hash as field name</li>
            <li><code>RANDOM_SHA256</code>: Will generate a random SHA256 hash as field name</li>
            <li><code>RANDOM_UNIQID</code>: Will generate a random field name from <code>uniqid()</code></li>
            <li>An integer value: Will generate a random field name with the integer length</li>
            <li>A list: Will generate a field named from a randomly selected list element</li>
        </ul>

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
use daxslab\\nocaptcha\\rules\\CssHiddenFieldRule;

session_start();

\$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            CssHiddenFieldRule::create([
                // form input field name
                'random_name' => BaseRule::RANDOM_MD5,
            ])
        ],
]);
?>

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
