
# No Captcha Form Spam Filter

No Captcha Form Spam Filter is a PHP utility library for dealing with 
spam bots using unobtrusive and user friendly techniques.

Applaying this techniques will help to reduce the span in your sites in 
more than 90% and users will not be annoyed with intrusive Captchas or 
extra fields.

## The NoCaptchaAntiSpam Class

The NoCaptchaAntiSpam Class can be used to declare Protection Rules, 
Include security code in forms and check if the form submission does 
not trigger any rule validation.

For creating an instance of the NoCaptchaAntiSpam Class, the create() 
static function can be used:
    
```php
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
```

## Including form elements

Using the NoCaptchaAntiSpam created instance you can include the needed 
elements inside a form with the renderRules() function:

```php
<form id="contactForm" method="post">
    <div class="form-group">
        <label for="contactName">Name</label>
        <input class="form-control" name="contact_name" id="contactName" placeholder="Enter name">
    </div>
    
    <!--  Include rules form elements  -->
    <?= $noCaptchaAntiSpam->renderRules() ?>
    
    <button type="submit" name="submit_button" class="btn btn-primary">Submit</button>
</form>    
```

## Verifying form submission

Using the checkSubmit() function from the NoCaptchaAntiSpam created 
instance you can check if any of the declared Rules triggers when the 
form is submitted:

```php
if ($_POST){
    if ($noCaptchaAntiSpam->checkSubmit()){
        echo 'Form submitted correctly';
    } else {
        echo 'Bot detected';
    }
}
```

## Rules

Rule classes implements different security checks including:

- CssHiddenFieldRule: A honeypot field hidden ussing CSS
- JavascriptGeneratedHiddenFieldRule: A honeypot field generated ussing JavaScript
- JavascriptFilledInputRule: A JavaScript filled hidden input
- SessionTimeTrapRule: A time trap using session stored variables
- FormTimeTrapRule: A time trap using a form field
- CookieCheckRule: A cookie verification

A NoCaptchaAntiSpam instance can contain one or multiple rules.

## Random field names

Random field names can be applied for an extra security layer, they are 
stored in PHP sessions and rules field names will change making 
difficult to bots identify them. Random field names cam be applied 
to single rules or multiple rules.

## Documentation

For extended documentation and examples you can put the `doc` folder 
behind a PHP capable web server.
