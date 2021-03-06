<?php

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $title = "Absolute Agency | Get in touch";
    include_once "header.php";
    include_once "map.php";

    $nameErr = "";
    $emailErr = "";
    $messageErr = "";
    $captchaErr = "";

    $errorCount = 0;

    if(isset($_POST["submit"])){
        if(isset($_POST["g-recaptcha-response"]) && !empty($_POST["g-recaptcha-response"])){

            //your site secret key
            $secret = "6LdR4BkUAAAAANykTHVfNIhEKvawb4O4yvGFa_Fj";
            //get verify response data
            $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$_POST["g-recaptcha-response"]);
            $responseData = json_decode($verifyResponse);

            if($responseData->success){
                //contact form submission code
                if (empty($_POST["name"])) {
                    $nameErr = "Please use a valid name";
                    $errorCount++;
                } else {
                    $name = test_input($_POST["name"]);
                }
    
                if (empty($_POST["tel"])) {
                    $tel = "";
                } else {
                    $tel = test_input($_POST["tel"]);
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Please use a valid email";
                    $errorCount++;
                } else {
                    $email = test_input($_POST["email"]);
                }

                if (empty($_POST["url"])) {
                    $url = "";
                } else {
                    $url = test_input($_POST["url"]);
                }

                if (empty($_POST["message"])) {
                    $messageErr = "Please send a valid message";
                    $errorCount++;
                } else {
                    $message = test_input($_POST["message"]);
                }

                if($errorCount === 0){

                    $to = "markdallen@me.com";
                    $subject = "You have a message from a customer";
                    $htmlContent = "
                        <h1>Contact request details</h1>
                        <p><b>Name: </b>".$name."</p>
                        <p><b>Telephone: </b>".$tel."</p>
                        <p><b>Email: </b>".$email."</p>
                        <p><b>Website: </b>".$url."</p>
                        <p><b>Message: </b>".$message."</p>";

                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // More headers
                    $headers .= "From:" . $name . " <" . $email . ">\r\n";
                    //send email
                    mail($to, $subject, $htmlContent, $headers);
                    echo "<div class='notification'>Your contact request was submitted. We will be in touch as soon as possible.</div>";

                }

            } else {
                $captchaErr = "Robot verification failed. Please try again";
            }

        } else {
            $captchaErr = "Please click on the reCAPTCHA box.";
        }

    }
?>  
<div class="contact-area">
<br>
    <h3 class="dotted-border">Contact us</h3>    

    <div class="contact-container contact-form">
        <h4>Contact form</h4>
        <form action="#contactform" method="post" id="contactform">
            <input type="text" name="name" placeholder="&#xf2c0;  Name*"/>
            <div class="error"><?php echo $nameErr;?></div>
            <input type="tel" name="tel" value="" placeholder="&#xf095;  Phone"/>
            <input type="email" name="email" value="" placeholder="&#xf003; Email*"/>
            <div class="error"><?php echo $emailErr;?></div>
            <input type="url" name="url" value="" placeholder="&#xf109;  Website"/>
            <textarea type="text" name="message" placeholder="&#xf040;  Message*"></textarea>
            <div class="error"><?php echo $messageErr;?></div>
            <div id="contact-captcha" class="g-recaptcha" data-sitekey="6LdR4BkUAAAAAKp1JfvvxAK-qbZ5zG_oiro0bnW4"></div>
            <input class="footer-button" type="submit" id="submit" type="button" name="submit" value="Send">
        </form>
    </div>
    <div class="contact-container contact-details">
        <h4>Contact details</h4>
        <a href="mailto:hello@absolute-agency.co.uk" title="Email us"><strong>Email:</strong> hello@absolute-agency.co.uk</a>
        <br><br>
        <a href="tel:01914998458" title="Call us"><strong>Tel:</strong> 0191 499 8458</a>
        <br><br>
            <a href="https://www.google.com/maps/place/54°57'59.2%22N+1°35'45.9%22W/@54.9664375,-1.5982792,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x0!8m2!3d54.9664375!4d-1.5960905"><strong>Address:</strong><br>
            <div class="address">
            Absolute<br>
            Northern Design Centre<br>
            Abbott’s Hill<br>
            Gateshead<br>
            Tyne and Wear<br>
            NE8 3DF
        </a>
        </div>
        <br><br>
        <h4>Social media</h4>
            <a href="https://twitter.com/absolute_hello" title="Twitter">
                <i class="fa fa-twitter" aria-hidden="true"></i> |
            </a>
            <a href="https://www.facebook.com/absoluteprofile" title="Facebook">
                <i class="fa fa-facebook" aria-hidden="true"></i> |
            </a>
            <a href="https://uk.pinterest.com/absolute_pin/" title="Pinterest">
                <i class="fa fa-pinterest" aria-hidden="true"></i> |
            </a>
            <a href="https://www.instagram.com/absolute_pics/" title="Instagram">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
    </div>
</div>
        
        <?php include_once "footer.php"; ?>