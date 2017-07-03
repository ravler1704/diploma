<?php
use lib\App;
?>

<section class="cd-faq">

    <ul class="cd-faq-categories">
        <li><a class="selected" href="#basics">Basics</a></li>
        <li><a href="#mobile">Mobile</a></li>
        <li><a href="#account">Account</a></li>
        <li><a href="#payments">Payments</a></li>
        <li><a href="#privacy">Privacy</a></li>
        <li><a href="#delivery">Delivery</a></li>
    </ul> <!-- cd-faq-categories -->

    <div class="cd-faq-items">
        <? foreach ($themes as $value) { ?>
        <ul id="<? echo $value['id']; ?>" class="cd-faq-group">
            <li class="cd-faq-title"><h2><? echo $value['name']; ?></h2></li>
            <? foreach ($questions as $questionInTheme) { ?>
            <li>
                <a class="cd-faq-trigger" href="#<? echo $questionInTheme['id'] ?>"><? echo $questionInTheme['question'] ?></a>
                <div class="cd-faq-content">
                    <p><? echo $questionInTheme['answer']; ?></p>
                </div> <!-- cd-faq-content -->
            </li>
            <? } ?>

        </ul> <!-- cd-faq-group -->
        <? } ?>

    </div> <!-- cd-faq-items -->
    <a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->

