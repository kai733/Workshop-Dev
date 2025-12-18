<?php

get_header();
$newsletter = get_field("newsletter");
$contact = get_field("contact_us");
$memberForm = get_field("member_form");

?>

<div class="newsletter">
    <div class="wrapper">
        <div class="newsletter-wrapper">
            <div class="newsletter-left">
                <h3><?php echo $newsletter["section_title"] ?></h3>
                <?php echo do_shortcode($newsletter["code_newsletter"]); ?>
                <p><?php echo $newsletter["collected_data"] ?></p>
            </div>
            <div class="newsletter-right">
                <img src="<?php echo $newsletter["contact_img"]["url"] ?>"
                    alt="<?php echo $newsletter["contact_img"]["alt"] ?>">
            </div>
        </div>
    </div>
</div>
<div class="contact-us">
    <div class="wrapper">
        <div class="contact-bottom">
            <div class="contact-wrapper">
                <h3><?php echo $contact["section_title"] ?></h3>
                <div class="section-adress">
                    <h4><?php echo $contact["adress_section"]["section_title"] ?></h4>
                    <div class="adress-bottom">
                        <img src="<?php echo $contact["adress_section"]["adress_icon"] ?>"
                            alt="<?php echo $contact["adress_section"]["adress_icon"] ?>">
                        <p><?php echo $contact["adress_section"]["adress"] ?></p>
                    </div>
                </div>
                <div class="section-socials">
                    <h4><?php echo $contact["social_media_section"]["section_title"] ?></h4>
                    <?php foreach ($contact["social_media_section"]["social_medias_icons"] as $logo): ?>
                        <a href="<?php echo $logo["social_media_link"]["url"] ?>"><img
                                src="<?php echo $logo["social_media_icon"]["url"] ?>"
                                alt="<?php echo $logo["social_media_icon"]["alt"] ?>"></a>
                    <?php endforeach ?>
                </div>
                <div class="section-mail">
                    <h4><?php echo $contact["mail_section"]["section_title"] ?></h4>
                    <div class="section-mail-line">
                        <img src="<?php echo $contact["mail_section"]["mail_icon"]["url"] ?>"
                            alt="<?php echo $contact["mail_section"]["mail_icon"]["alt"] ?>">
                    </div>
                    <p><?php echo $contact["mail_section"]["emanciper_mail"] ?></p>
                </div>
                <div class="section_forum">
                    <a class="button-1"
                        href="<?php echo $contact["forum_link"]["url"] ?>"><?php echo $contact["forum_link"]["title"] ?></a>
                </div>
            </div>
            <div class="member-form">
                <div class="member-form-top">
                    <a class="button-1"
                        href="<?php echo $memberForm["member_link"]["url"] ?>"><?php echo $memberForm["member_link"]["title"] ?></a>
                    <a class="button-3"
                        href="<?php echo $memberForm["volunteer_link"]["url"] ?>"><?php echo $memberForm["volunteer_link"]["title"] ?></a>
                </div>
                <?php echo do_shortcode($memberForm["member_form_code"]); ?>
                <p><?php echo $newsletter["collected_data"] ?></p>
            </div>
        </div>
    </div>
</div>

<pre><?php //var_dump($contact["forum_link"]) ?></pre>
<?php

get_footer();

?>