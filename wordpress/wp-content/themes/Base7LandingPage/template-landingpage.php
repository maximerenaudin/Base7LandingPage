<?php /* Template Name: Landing Page */ ?>


<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title><?php echo get_the_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content='Landingpage - landingpage'/>
    <meta name="keywords" content="landingpage"/>
    <!-- Google Fonts -->
    <!--<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>-->
    <!-- Font Awesome -->
    <link href="/wordpress/wp-content/themes/html5blank-stable/fonts/FontAwesome/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Main style -->
    <link href="/wordpress/wp-content/themes/Base7LandingPage/stylesheets/screen.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/wordpress/wp-content/themes/Base7LandingPage/stylesheets/print.css" media="print" rel="stylesheet" type="text/css" />
    <!--[if IE]>
    <!-- <link href="stylesheets/ie.css" media="screen" rel="stylesheet" type="text/css" />-->
    <![endif]-->
</head>
<body>
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <img src="<?php echo get_stylesheet_directory_uri() . "/images/logo.png"?>" alt="" class="logo"/>
            <img src="<?php echo get_stylesheet_directory_uri() . "/images/trivago.png"?>"" alt="" class="logo trivago"/>
        </div>
    </nav>
    <!-- /Navbar -->
</header>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "marketingLead";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Get current language
    $lang = qtranxf_getLanguage();
    // Get user's IP
    $ip_adress = $_SERVER['REMOTE_ADDR'];

    // Get entered name
    $leadname = $_POST['leadname'];
    // Check if name is not empty and only contains letters and space
    if(!empty($leadname)):
        if(!preg_match("/^[a-zA-Z ]*$/",$leadname)): 
            if($lang == "en"): $nameErr = "Only letters and white space allowed";
            elseif($lang == "fr"): $nameErr = "Seulement des lettres et des espaces";
            endif; 
        else: $nameErr = "";
        endif;
    else: 
        if($lang == "en"): $nameErr = "This field can't be empty"; 
        elseif($lang == "fr"): $nameErr = "Ce champ ne peut être vide";
        endif;
    endif;

    // Get entered company
    $leadcompany = $_POST['leadcompany'];
    // Check if company is not empty
    if(!empty($leadcompany)): $companyErr = "";
    else: 
        if($lang == "en"): $companyErr = "This field can't be empty";
        elseif($lang == "fr"): $companyErr = "Ce champ ne peut être vide";
        endif;
    endif;

    // Get entered telephone
    $leadtelephone = $_POST['leadtelephone'];
    // Check if telephone is not empty 
    if(!empty($leadtelephone)): $telErr = "";
    else: 
        if($lang == "en"): $telErr = "This field can't be empty";
        elseif($lang == "fr"): $telErr = "Ce champ ne peut être vide";
        endif;
    endif;

    // Get entered email
    $leademail = $_POST['leademail'];
    // Check if email is not empty and has correct format
    if(!empty($leademail)): 
        if(!filter_var($leademail, FILTER_VALIDATE_EMAIL)): 
            if($lang == "en"): $emailErr = "Invalid email format"; 
            elseif ($lang == "fr"): $emailErr = "Format de mail invalide";
            endif;
        else: $emailErr = "";
        endif;   
    else: 
        if($lang == "en"): $emailErr = "This field can't be empty";
        elseif($lang == "fr"): $emailErr = "Ce champ ne peut être vide";
        endif;
    endif;

    // Get entered initials
    $leadconsultant = $_POST['leadconsultant'];
    // Check if consultant is not empty
    if(!empty($leadconsultant)): $consultantErr = "";
    else: 
        if($lang == "en"): $consultantErr = "This field can't be empty";
        elseif($lang == "fr"): $consultantErr = "Ce champ ne peut être vide";
        endif;
    endif;
    
?>

<div class='main-container'>
    <section class='wrap-body-section'>
        <div class="section-hero">
            <div class="container">
                <?php 
                // If the form is submitted and there are no errors (ie. all error var are empties)
                if(isset($_POST['submited']) && empty($nameErr or $companyErr or $telErr or $emailErr or $consultantErr)) {

                    // Put SQL query into $sql var
                    $sql = "INSERT INTO lead (name, company, telephone, email, consultant, language, ip)
                    VALUES ('$leadname', '$leadcompany', '$leadtelephone', '$leademail', '$leadconsultant', '$lang', '$ip_adress')";

                    // If not error occured when pushing data to database present validation message else present error message
                    if ($conn->query($sql) === TRUE) { ?>
                        <img src="<?php echo get_stylesheet_directory_uri() . "/images/check.png"?>" alt="" class="img-hero"/><h2 class="validation-message"><?php _e("<!--:en-->Your information are now in our possession.<br>We will contact you soon!<br>Thanks for your interest!<!--:--><!--:fr-->Vos informations sont en notre possession.<br>Nous vous recontacterons rapidement.<br>Merci !<br><!--:-->"); ?></h2>' <?php ;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                        $conn->close();
                    } 

                // If the form has not been submitted    
                if(!isset($_POST['submited'])) { ?>
                <div class="container-hero-left">
                	<h1><?php echo get_post_meta($post->ID, 'a_HeroH1', true) ?></h1>
                    <h2><?php echo get_post_meta($post->ID, 'b_HeroH2', true) ?></h2>
                </div>
                <div class="container-hero-right">
                    <form action="" method="POST">
                        <fieldset class="form-group">
                            <label for="nameL"><?php _e("<!--:en-->Your Name *<!--:--><!--:fr-->Votre nom *<!--:-->"); ?></label>
                            <input type="text" name="leadname" class="field-input" id="nameL" maxlength="256" placeholder="ex. Norman Bates" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="companyL"><?php _e("<!--:en-->Company *<!--:--><!--:fr-->Votre entreprise *<!--:-->"); ?></label>
                            <input type="text" name="leadcompany" class="field-input" id="companyL" maxlength="256" placeholder="ex. Hotel Cortez" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="emailL"><?php _e("<!--:en-->Email *<!--:--><!--:fr-->Votre email *<!--:-->"); ?></label>
                            <input type="text" name="leademail" class="field-input" id="emailL" maxlength="256" placeholder="ex. info@hotelcortez.com" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="phoneL"><?php _e("<!--:en-->Phone Number * *<!--:--><!--:fr-->Votre numéro de téléphone *<!--:-->"); ?></label>
                            <input type="text" name="leadtelephone" class="field-input" id="phoneL" maxlength="256" placeholder="ex. +41 21 784 28 53" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="consultantL"><?php _e("<!--:en-->Consultant *<!--:--><!--:fr-->Consultant *<!--:-->"); ?></label>
                            <input type="text" name="leadconsultant" class="field-input" id="consultantL" maxlength="256" placeholder="<?php _e('<!--:en-->Initials only, ex. Leonardo DiCaprio is LDC<!--:--><!--:fr-->Initiales uniquement, ex. JR pour Jean Reno<!--:-->'); ?>" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="submit" name="submited" class="btn-submit-L" id="submitL" maxlength="256" placeholder="Submit" required="required">
                        </fieldset>
                    </form>
                </div>

                <?php } 

                // If the form has been submitted with errors (ie. some error var are not empty)
                elseif(isset($_POST['submited']) && !empty($nameErr or $companyErr or $telErr or $emailErr or $consultantErr)) { ?>
                <div class="container-hero-left">
                    <h1><?php echo get_post_meta($post->ID, 'a_HeroH1', true) ?></h1>
                    <h2><?php echo get_post_meta($post->ID, 'b_HeroH2', true) ?></h2>
                </div>
                <div class="container-hero-right">
                    <form action="" method="POST">
                        <fieldset class="form-group">
                            <label for="nameL"><?php _e("<!--:en-->Your Name *<!--:--><!--:fr-->Votre nom *<!--:-->"); ?> 
                                <span class="error-message">
                                    <?php if (!empty($nameErr)): echo $nameErr; endif;?>
                                </span>
                            </label>
                            <input type="text" name="leadname" <?php if (empty($nameErr)): echo 'class="field-input"'; else: echo 'class="field-input wrong"'; endif;?>  id="nameL" maxlength="256" <?php if (empty($leadname)): echo 'placeholder="ex. Norman Bates"';  else: echo 'value=' . $leadname ; endif;?> required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="companyL">
                                <?php _e("<!--:en-->Company *<!--:--><!--:fr-->Votre entreprise *<!--:-->"); ?> 
                                <span class="error-message">
                                    <?php if (!empty($companyErr)): echo $companyErr; endif;?>
                                </span>
                            </label>
                            <input type="text" name="leadcompany" <?php if (empty($companyErr)): echo 'class="field-input"'; else: echo 'class="field-input wrong"'; endif;?> id="companyL" maxlength="256" <?php if (empty($leadcompany)): echo 'placeholder="ex. Hotel Cortez"';  else: echo 'value=' . $leadcompany ; endif;?> required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="emailL">
                                <?php _e("<!--:en-->Email *<!--:--><!--:fr-->Votre email *<!--:-->"); ?> 
                                <span class="error-message">
                                    <?php if (!empty($emailErr)): echo $emailErr; endif;?>
                                </span>
                            </label>
                            <input type="email" name="leademail" <?php if (empty($emailErr)): echo 'class="field-input"'; else: echo 'class="field-input wrong"'; endif;?> id="emailL" maxlength="256" <?php if (empty($leademail)): echo 'placeholder="ex. info@hotelcortez.com"';  else: echo 'value=' . $leademail ; endif;?> required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="phoneL">
                                <?php _e("<!--:en-->Phone Number * *<!--:--><!--:fr-->Votre numéro de téléphone *<!--:-->"); ?> 
                                <span class="error-message">
                                    <?php if (!empty($telErr)): echo $telErr; endif;?>
                                </span>
                            </label>
                            <input type="text" name="leadtelephone" <?php if (empty($telErr)): echo 'class="field-input"'; else: echo 'class="field-input wrong"'; endif;?> id="phoneL" maxlength="256" <?php if (empty($leadtelephone)): echo 'placeholder="ex. +41 21 784 28 53"';  else: echo 'value=' . $leadtelephone ; endif;?> required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="consultantL">
                                <?php _e("<!--:en-->Consultant *<!--:--><!--:fr-->Consultant *<!--:-->"); ?> 
                                <span class="error-message">
                                    <?php if (!empty($consultantErr)): echo $consultantErr; endif;?>
                                </span>
                            </label>
                            <input type="text" name="leadconsultant" <?php if (empty($consultantErr)): echo 'class="field-input"'; else: echo 'class="field-input wrong"'; endif;?> id="consultantL" maxlength="256" <?php if (empty($leadconsultant)): echo 'placeholder="Initials only, ex. Leonardo DiCaprio is LDC"';  else: echo 'value=' . $leadconsultant ; endif;?> required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="submit" name="submited" class="btn-submit-L" id="submitL" maxlength="256" placeholder="Submit" required="required">
                        </fieldset>
                    </form>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
    <section class='wrap-body-section'>
        <div class="section-mid">
            <div class="container">
                <h1>
                    <?php echo get_post_meta($post->ID, 'c_1stSectionTitle', true) ?>
                </h1>
                <h2>
                    <?php echo get_post_meta($post->ID, 'd_1stSectionContent', true) ?>
                </h2>
            </div>
            <div class="images-mid">
                <img src="<?php echo get_stylesheet_directory_uri() . "/images/mid1.png"?>" alt="" class="img-mid"/>
                <img src="<?php echo get_stylesheet_directory_uri() . "/images/mid2.png"?>" alt="" class="img-mid"/>
                <img src="<?php echo get_stylesheet_directory_uri() . "/images/mid3.png"?>" alt="" class="img-mid"/>
            </div>
        </div>
    </section>
    <section class='wrap-body-section'>
        <div class="section-mid2">
            <div class="container">
                <div class="box c1">
                    <h2><span>Property Management</span>
                        System</h2>
                    <p><?php _e("<!--:en-->Manage your frontdesk efficiently<!--:--><!--:fr-->Gérez votre hôtel efficacement<!--:-->"); ?></p>
                    <button class="btn-submit-L btn-s2"><?php _e("<!--:en-->Find out more<!--:--><!--:fr-->En savoir plus<!--:-->"); ?></button>
                </div>
                <div class="box c2">
                    <h2><?php _e("<!--:en--><span>Free Booking</span>
                        Engine<!--:--><!--:fr--><span>Moteur de réservation</span>
                        gratuit<!--:-->"); ?></h2>
                    <p><?php _e("<!--:en-->Sell your rooms commision free<!--:--><!--:fr-->Vendez vos chambres sans frais<!--:-->"); ?></p>
                    <button class="btn-submit-L btn-s2"><?php _e("<!--:en-->Find out more<!--:--><!--:fr-->En savoir plus<!--:-->"); ?></button>
                </div>
                <div class="box c3">
                    <h2><span>2-Way Channel</span>
                        Manager</h2>
                    <p><?php _e("<!--:en-->Distribute your rooms worldwide<!--:--><!--:fr-->Distribuez vos chambres online<!--:-->"); ?></p>
                    <button class="btn-submit-L btn-s2"><?php _e("<!--:en-->Find out more<!--:--><!--:fr-->En savoir plus<!--:-->"); ?></button>
                </div>
            </div>
        </div>
    </section>
    <section class='wrap-body-section'>
        <div class="section-mid3">
            <div class="container">
                <h1><?php echo get_post_meta($post->ID, 'e_3rdSectionTitle', true) ?></h1>
                <h2><?php echo get_post_meta($post->ID, 'f_3rdSectionContent', true) ?></h2>
                <img src="<?php echo get_stylesheet_directory_uri() . "/images/statistics.png"?>" alt="" />
            </div>
        </div>
    </section>
    <section class='wrap-body-section'>
        <div class="section-mid section-bottom">
            <div class="container">
                <h1>
                    <?php echo get_post_meta($post->ID, 'g_4thSectionTitle', true) ?>
                </h1>
                <div class="testimonials">
                    <div class="testimonial">
                        <p><?php echo get_post_meta($post->ID, 'h_1stTestimContent', true) ?></p>
                        <div class="author"><?php echo get_post_meta($post->ID, 'i_1stTestimAuthor', true) ?></div>
                    </div>
                    <div class="testimonial">
                        <p><?php echo get_post_meta($post->ID, 'j_2ndTestimContent', true) ?></p>
                        <div class="author"><?php echo get_post_meta($post->ID, 'k_2ndTestimAuthor', true) ?></div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="images-b">
                    <div class="img-b img-b1"><img src="<?php echo get_stylesheet_directory_uri() . "/images/bottom1.jpg"?>" alt="" class="img-bt1"/></div>
                    <div class="img-b img-b2"><img src="<?php echo get_stylesheet_directory_uri() . "/images/bottom2.jpg"?>" alt="" class="img-bt2"/></div>
                    <div class="img-b img-b3"><img src="<?php echo get_stylesheet_directory_uri() . "/images/bottom3.jpg"?>" alt="" class="img-bt3"/></div>
                </div>
            </div>
            <div class="container">
                <div class="testimonials">
                    <div class="testimonial testimonial-full">
                        <p><?php echo get_post_meta($post->ID, 'l_3rdTestimContent', true) ?></p>
                        <div class="author"><?php echo get_post_meta($post->ID, 'm_3rdTestimAuthor', true) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class='wrap-body-section'>
        <div class="section-tel">
            <div class="container">
                <h1>
                    <?php echo get_post_meta($post->ID, 'n_TelephoneTitle', true) ?>
                </h1>
                <a href="callto:<?php echo get_post_meta($post->ID, 'o_TelephoneContent', true) ?>">
                    <button class="btn-submit-L btn-s2"><?php echo get_post_meta($post->ID, 'o_TelephoneContent', true) ?></button>
                </a>
            </div>
        </div>
    </section>
</div>
<!-- /wrap -->

<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <nav>
            </nav>
        </div>
    </div><!-- footer top -->
    <div class="footer-bottom">
        <div class="container">
            Copyright &copy; 2016
            <a href="">Base7booking</a>
            . All Rights Reserved.
            <?php _e("<!--:en-->Language: <!--:--><!--:fr-->Langue : <!--:-->"); ?><?=qtranxf_generateLanguageSelectCode('dropdown');?>
        </div>
    </div>
</footer><!-- footer -->
</body>
</html>