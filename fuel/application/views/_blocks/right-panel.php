

<div class="home_panels panel-group wrap" id="bs-collapse">
   
   <?php echo fuel_block('Anouncement');?>


   <?php echo fuel_block('counter_Base_application');?>
   
   <?php echo fuel_block('Registration');?>

   <?php echo fuel_block('Enrollment-n-Examination');?>

   <?php echo fuel_block('results');?>



</div>

<script type="text/javascript">
   $(function() {
      $('.collapse').on('shown.bs.collapse', function(){
         
         $(this).parent().find(".right-arrow").text('-');
      }).on('hidden.bs.collapse', function(){

         $(this).parent().find(".right-arrow").text('+');
      });
});
</script>