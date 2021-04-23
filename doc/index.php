<?php

$title = "noCaptcha form spam filter - Example";

?>

<?php
include_once('common/header.php');
?>

<h1>No Captcha Form Spam Filter</h1>

<p>No Captcha Form Spam Filter is a PHP utility library for dealing with spam bots using unobtrusive and user friendly techniques.</p>

<p>Applying this techniques will help to reduce the span in your sites in more than 90% and users will not be annoyed with intrusive Captchas or extra fields.</p>

<h2>Installation</h2>

<pre><code>composer require daxslab/no-captcha</code></pre>

<h2>The NoCaptchaAntiSpam Class</h2>

<p>
    The <code>NoCaptchaAntiSpam</code> Class can be used to declare Protection Rules, Include security code in forms and
    check if the form submission does not trigger any rule validation.
</p>

<p>
    For creating an instance of the <code>NoCaptchaAntiSpam</code> Class, the <code>create()</code> static function can be used:
</p>

<pre>
    <code class="PHP">
use daxslab\nocaptcha\NoCaptchaAntiSpam;
use daxslab\nocaptcha\rules\CssHiddenFieldRule;

// Declare no captcha anti spam object with CSS based hidden field check
$noCaptchaAntiSpam = NoCaptchaAntiSpam::create([
        'rules' => [
            CssHiddenFieldRule::create([
                // form input field name
                'name' => 'css_hidden_field',
            ])
        ],
]);
    </code>
</pre>

<h2>Including form elements</h2>

<p>
    Using the <code>NoCaptchaAntiSpam</code> created instance you can include the needed elements inside a form with
    the <code>renderRules()</code> function:
</p>

<?php
$code = <<< EOT
<form id="contactForm" method="post">
    <div class="form-group">
        <label for="contactName">Name</label>
        <input class="form-control" name="contact_name" id="contactName" placeholder="Enter name">
    </div>
    
    <!--  Include rules form elements  -->
    <?= \$noCaptchaAntiSpam->renderRules() ?>
    
    <button type="submit" name="submit_button" class="btn btn-primary">Submit</button>
</form>
EOT;

?>

<pre>
    <code class="HTML">
<?php echo htmlspecialchars( $code ); ?>
    </code>
</pre>

<h3>Verifying form submission</h3>

<p>
    Using the <code>checkSubmit()</code> function from the <code>NoCaptchaAntiSpam</code> created instance you can
    check if any of the declared Rules triggers when the form is submitted:
</p>

<pre>
    <code class="PHP">
if ($_POST){
    if ($noCaptchaAntiSpam->checkSubmit()){
        echo 'Form submitted correctly';
    } else {
        echo 'Bot detected';
    }
}
    </code>
</pre>

<h3>Rules</h3>

<p>
    Rule classes implements different security checks including:
</p>
<ul>
    <li><a href="css_hidden_field_honeypot.php"><code>CssHiddenFieldRule</code></a>: A honeypot field hidden using CSS</li>
    <li><a href="javascript_generated_hidden_field_honeypot.php"><code>JavascriptGeneratedHiddenFieldRule</code></a>: A honeypot field generated using JavaScript</li>
    <li><a href="javascript_filled_input.php"><code>JavascriptFilledInputRule</code></a>: A JavaScript filled hidden input</li>
    <li><a href="session_time_trap.php"><code>SessionTimeTrapRule</code></a>: A time trap using session stored variables</li>
    <li><a href="form_time_trap.php"><code>FormTimeTrapRule</code></a>: A time trap using a form field</li>
    <li><a href="cookie_check.php"><code>CookieCheckRule</code></a>: A cookie verification</li>
</ul>

<p>
    A <code>NoCaptchaAntiSpam</code> instance can contain one or <a href="multiple_rules.php">multiple rules</a>.
</p>

<h3>Random field names</h3>

<p>
    Random field names can be applied for an extra security layer, they are stored in PHP sessions and rules field names
    will change making difficult to bots identify them. Random field names cam be applied to
    <a href="random_field_name.php">single rules</a> or <a href="multiple_random_field_names.php">multiple rules</a>.
</p>

<?php
include_once('common/footer.php');
?>
