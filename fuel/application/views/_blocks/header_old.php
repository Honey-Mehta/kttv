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
    <meta name="keywords" content="<?php echo fuel_var('meta_keywords') ?>">
    <meta name="description" content="<?php echo fuel_var('meta_description') ?>"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php echo css('../bootstrap/css/bootstrap.min.css'); ?> 
    <!-- <?php echo css('../font-awesome/css/font-awesome.min.css') ?> -->
    <?php echo  css('../Css/StyleSheet.css');?>
    <?php echo css('../Css/carousel.min.css') ; ?> 

    
    <?php  
    if (!empty($is_blog)):
        echo $CI->fuel->blog->header();
    endif;
    ?>
    <?php echo js('../bootstrap/js/bootstrap.min.js'); ?>   
    <?php echo js('jquery.min') . js($js); ?> 
    <script src="assets/Js/carousel.min.js"></script>

</head>

<!-- /#body -->

<body>
    <!-- //mycode -->
    <div class="pre_haederavanti">
        <div class="container">
            <div class="col-md-12">
                <div class="preheader_links float-end">
                    <a href="https://rablu.mponline.gov.in">Mponline Portal</a> | <a href="">UTD Results</a>
                </div>
            </div>
        </div>
    </div>
    <div class="header_avantibai">
        <div class="container">
            <div class="col-md-12">
                <div class="dept_logo">
                <img src="<?php echo img_path('dept_logo.png');?>"/>
                    <!-- <img src="assets/images/dept_logo.png" /> -->
                </div>
            </div>
        </div>
    </div> 
     
         
    <header class="header_menu" id="header">
        <section class="wrapper_menu container">
            <a href="./index.html" class="brand"></a>
            <div class="burger" id="burger">
                <span class="burger-line"></span>
                <span class="burger-line"></span>
                <span class="burger-line"></span>
            </div>
            <span class="overlay"></span>
                 
                    <?php echo bootstrap_menu(array('container_tag_id' => 'menu'), NULL, TRUE); // last arg switches toggle behaviour for drop-downs ?>
                     
                 
          </section>
    </header> 
    

    <!--Navigation Script Start-->
    <script>
        const navbarMenu = document.getElementById("navbar");
        const burgerMenu = document.getElementById("burger");
        const overlayMenu = document.querySelector(".overlay");

        // Show and Hide Navbar Function
        const toggleMenu = () => {
            navbarMenu.classList.toggle("active");
            overlayMenu.classList.toggle("active");
        };

        // Collapsible Mobile Submenu Function
        const collapseSubMenu = () => {
            navbarMenu
               .querySelector(".menu-dropdown.active .submenu")
               .removeAttribute("style");
            navbarMenu.querySelector(".menu-dropdown.active").classList.remove("active");
        };

        // Toggle Mobile Submenu Function
        const toggleSubMenu = (e) => {
            if (e.target.hasAttribute("data-toggle") && window.innerWidth <= 992) {
                e.preventDefault();
                const menuDropdown = e.target.parentElement;

                // If Dropdown is Expanded, then Collapse It
                if (menuDropdown.classList.contains("active")) {
                    collapseSubMenu();
                } else {
                    // Collapse Existing Expanded Dropdown
                    if (navbarMenu.querySelector(".menu-dropdown.active")) {
                        collapseSubMenu();
                    }

                    // Expanded the New Dropdown
                    menuDropdown.classList.add("active");
                    const subMenu = menuDropdown.querySelector(".submenu");
                    subMenu.style.maxHeight = subMenu.scrollHeight + "px";
                }
            }
        };

        // Fixed Resize Window Function
        const resizeWindow = () => {
            if (window.innerWidth > 992) {
                if (navbarMenu.classList.contains("active")) {
                    toggleMenu();
                }
                if (navbarMenu.querySelector(".menu-dropdown.active")) {
                    collapseSubMenu();
                }
            }
        };

        // Initialize Event Listeners
        burgerMenu.addEventListener("click", toggleMenu);
        overlayMenu.addEventListener("click", toggleMenu);
        navbarMenu.addEventListener("click", toggleSubMenu);
        window.addEventListener("resize", resizeWindow);

    </script>
    <!--Navigation Script End-->
    