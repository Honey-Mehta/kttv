<footer class="footer-bg p-2" >
        <div class="links"></div>
        <p class="text-white m-0 text-center">Powered by: <img
                src="https://www.mponline.gov.in/QuicK Links/PortalImages/MPOHeaderFooterLogo/MPO_footer.png"
                alt="MPOnline Ltd"></p>
    </footer>



    <?php echo js('../js/bootstrap.js');?>
 

    <script>
(function () {
  "use strict";

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToggle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    
    if (mobileNavToggleBtn) {
      const currentIcon = mobileNavToggleBtn.getAttribute('src');
      const menuIcon = "<?php echo img_path('icons/menu-icon.svg'); ?>";
      const closeIcon = "<?php echo img_path('icons/close.svg'); ?>";
      
      if (currentIcon === menuIcon) {
        mobileNavToggleBtn.setAttribute('src', closeIcon);  // Change to close icon
      } else {
        mobileNavToggleBtn.setAttribute('src', menuIcon);  // Change back to menu icon
      }
    }
  }

  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToggle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.body.classList.contains('mobile-nav-active')) {
        mobileNavToggle();
      }
    });
  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function (e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      if (this.parentNode.nextElementSibling) {
        this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      }
      e.stopImmediatePropagation();
    });
  });

})();
</script>
