<?php



 require_once('/lib/Captcha.php');
(new Captcha)->upper()
             ->lower()
             ->number()
             ->create();



?>
