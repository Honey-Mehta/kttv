<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        <?php
        if (!empty($is_blog)):
            echo $CI->fuel->blog->page_title($page_title, ' : ', 'right');
        else:
            echo fuel_var('page_title', '');
        endif;
        ?>
    </title>
    <meta name="keywords" content="<?php echo fuel_var('meta_keywords') ?>"/>
    <meta name="description" content="<?php echo fuel_var('meta_description') ?>"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php echo css('../css/styles.css');?>
    <?php echo css('../css/bootstrap.css');?>
    <?php 
    
    //echo css('../css/bootstrap-icons.min.css');
    
    ?>

    <?php echo js('../js/jquery-3.6.0.min');?> 

  
    <?php  
    if (!empty($is_blog)):
        echo $CI->fuel->blog->header();
    endif;
    ?>
   

</head>

<!-- /#body -->

<body>
      <!-- header start  -->
      <!-- <header>
        <div class="fixed-header">
            <div class="container">
                <nav>
                    <div class="nav-container d-flex justify-content-between align-items-center">
                        <div class="logo"><img class="logo-img" src="<?php echo img_path('KTTU_logo.png');?>" alt="KTTU"></div>

                        <input type="checkbox" id="menu-toggle" />
                        <label for="menu-toggle" class="menu-icon">☰</label>
                        <label for="menu-toggle" class="close-icon">✕</label> -->


                        
                        <?php
                        // echo bootstrap_menu(array('container_tag_id' => 'menu'), NULL, TRUE); // last arg switches toggle behaviour for drop-downs ?>
                        <!-- <ul class="nav-links mb-0">
                            <li><a href="#home">Home</a></li>
                            <li><a href="#vision">Vision</a></li>
                            <li><a href="#mission">Mission</a></li>
                            <li><a href="#message">Message from VC</a></li>
                        </ul> -->
                    <!-- </div>
                </nav>
            </div>
        </div>

    </header> -->



    <header>
        <div class="fixed-header">
            <div class="">
                <div class="">
                    <div class="nav-container d-flex flex-column justify-content-center">
                        <!-- pre-header  -->
                        <div class="pre-header">
                            <div class="container">
                                <ul class="d-flex justify-content-end m-0 py-1">
                                    <li class="px-2 pre-header--list"><a href="<?php echo base_url(); ?>"  style="text-decoration: none;">Home</a></li>
                                    <li class="px-2">|</li>
                                    <li class="px-2 pre-header--list"><a href="https://kttv.mponline.gov.in/portal/index.aspx"  style="text-decoration: none;" target="_blank">Online Services</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="logo container">
                        <img class="logo-img img-fluid" src="<?php echo img_path('KTTU_logo.png');?>" alt="KTTU">
                        </div>
                        <nav id="navmenu" class="navmenu">
                        <?php echo bootstrap_menu(array('container_tag_id' => ''), NULL, TRUE); // last arg switches toggle behaviour for drop-downs ?>
                            <!-- <ul>
                                <li><a href="#hero" class="active">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#features">Features</a></li>
                                <li><a href="#services">Services</a></li>
                                <li><a href="#pricing">Pricing</a></li>
                                <li class="dropdown"><a href="#"><span>Dropdown</span>
                                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                    <ul>
                                        <li><a href="#">Dropdown 1</a></li>
                                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                                            <ul>
                                                <li><a href="#">Deep Dropdown 1</a></li>
                                                <li><a href="#">Deep Dropdown 2</a></li>
                                                <li><a href="#">Deep Dropdown 3</a></li>
                                                <li><a href="#">Deep Dropdown 4</a></li>
                                                <li><a href="#">Deep Dropdown 5</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Dropdown 2</a></li>
                                        <li><a href="#">Dropdown 3</a></li>
                                        <li><a href="#">Dropdown 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#contact">Contact</a></li>
                            </ul> -->
                            <img class="mobile-nav-toggle d-xl-none" src="<?php echo img_path("icons/menu-icon.svg");?>"
                                style="display: block; float: right;" />
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </header>



   






