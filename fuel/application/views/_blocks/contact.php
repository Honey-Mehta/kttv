<div class="contact_us_6">
    <div class="container">


    <div class="row">
    <div class="col-xl-4 col-lg-4">
        <form class="form-box">
            <div class="container-block form-wrapper">

                <?php 
            // Fetch employee records
            $contact = fuel_model('contact', [
              
              'where' => ['published' => 'yes']
          ]);

           
            
            
            if (!empty($contact)): // Check if records are available
                //foreach ($vc_messages as $vc_message): 
                
                ?>
                    <div class="mob-text">
                        <p class="text-blk contactus-head">
                            Get in Touch
                        </p>
                        <p class="text-blk contactus-subhead">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Felis diam lectus sapien.
                        </p>

                        <p class="text-blk map-contactus-head" id="w-c-s-fc_p-1-dm-id">
                            Address
                        </p>
                        
                        <p class="text-blk map-contactus-subhead">
                          Location :<br/>
                            <?php echo $contact[0]['name']; ?>
                        </p>
                        <p class="text-blk map-contactus-subhead">
                            
                            <?php echo $contact[0]['location']; ?>
                        </p>


                    </div>



                    <?php 
        
      //endforeach; 
            else: ?>
                        <!-- No records message -->
                        <p class="text-center">No Contact Details Available.</p>
                        <?php endif; ?>


            </div>


            <div class="container-block form-wrapper">

                <?php 
// Fetch employee records
$contact = fuel_model('contact', [

'where' => ['published' => 'yes']
]);




if (!empty($contact)): // Check if records are available
//foreach ($vc_messages as $vc_message): 

?>
                    <div class="mob-text">
                        <p class="text-blk contactus-head">

                        </p>
                        <p class="text-blk contactus-subhead">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Felis diam lectus sapien.
                        </p>

                        <p class="text-blk map-contactus-head" id="w-c-s-fc_p-1-dm-id">
                            Telephone Number
                        </p>

                     
                        <p class="text-blk map-contactus-subhead">
                            Landline Number :
                            <?php echo $contact[0]['landline_number']; ?>
                        </p>

                        <p class="text-blk map-contactus-subhead">
                            Office Number :
                            <?php echo $contact[0]['office_number']; ?>
                        </p>

                        <p class="text-blk map-contactus-subhead">
                            HelpLine Number Whatsapp Number :
                            <?php echo $contact[0]['helpline_number_whatsapp_number']; ?>
                        </p>


                    </div>



                    <?php 

//endforeach; 
else: ?>
                        <!-- No records message -->
                        <p class="text-center">No Contact Details Available.</p>
                        <?php endif; ?>


            </div>



            <div class="container-block form-wrapper">

                <?php 
// Fetch employee records
$contact = fuel_model('contact', [

'where' => ['published' => 'yes']
]);




if (!empty($contact)): // Check if records are available
//foreach ($vc_messages as $vc_message): 

?>
                    <div class="mob-text">
                        <p class="text-blk contactus-head">

                        </p>
                        <p class="text-blk contactus-subhead">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Felis diam lectus sapien.
                        </p>

                        <p class="text-blk map-contactus-head" id="w-c-s-fc_p-1-dm-id">
                            Reach us at
                        </p>

                        <p class="text-blk map-contactus-subhead">
                            Email :
                            <?php echo $contact[0]['email']; ?>
                        </p>

                        <p class="text-blk map-contactus-subhead">
                            Contact timing :
                            <?php echo $contact[0]['contact_time']; ?>


                        </p>

                    </div>



                    <?php 

//endforeach; 
else: ?>
                        <!-- No records message -->
                        <p class="text-center">No Contact Details Available.</p>
                        <?php endif; ?>


            </div>







        </form>
</div>

       <div class="col-xl-8 col-lg-8">
        <div  id="i772w">
            <div class="map-part">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3626.9630391648698!2d77.29492707460666!3d24.624958754642126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397a5b69b845d1ff%3A0x3e1bf9be66f4132a!2sKrantiveer%20tatya%20tope%20university%2Cguna%2Cm.p!5e0!3m2!1sen!2sin!4v1736935503834!5m2!1sen!2sin"
                width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- <div class="map-box container-block"> -->
            </div>
        </div>

        </div>

                </div>
    </div>
</div>
</div>
<style>


@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800&amp;display=swap');

*,
*:before,
*:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  margin: 0;
}

.wk-desk-1 {
  width: 8.333333%;
}

.wk-desk-2 {
  width: 16.666667%;
}

.wk-desk-3 {
  width: 25%;
}

.wk-desk-4 {
  width: 33.333333%;
}

.wk-desk-5 {
  width: 41.666667%;
}

.wk-desk-6 {
  width: 50%;
}

.wk-desk-7 {
  width: 58.333333%;
}

.wk-desk-8 {
  width: 66.666667%;
}

.wk-desk-9 {
  width: 75%;
}

.wk-desk-10 {
  width: 83.333333%;
}

.wk-desk-11 {
  width: 91.666667%;
}

.wk-desk-12 {
  width: 100%;
}

@media (max-width: 1024px) {
  .wk-ipadp-1 {
    width: 8.333333%;
  }

  .wk-ipadp-2 {
    width: 16.666667%;
  }

  .wk-ipadp-3 {
    width: 25%;
  }

  .wk-ipadp-4 {
    width: 33.333333%;
  }

  .wk-ipadp-5 {
    width: 41.666667%;
  }

  .wk-ipadp-6 {
    width: 50%;
  }

  .wk-ipadp-7 {
    width: 58.333333%;
  }

  .wk-ipadp-8 {
    width: 66.666667%;
  }

  .wk-ipadp-9 {
    width: 75%;
  }

  .wk-ipadp-10 {
    width: 83.333333%;
  }

  .wk-ipadp-11 {
    width: 91.666667%;
  }

  .wk-ipadp-12 {
    width: 100%;
  }
}

@media (max-width: 768px) {
  .wk-tab-1 {
    width: 8.333333%;
  }

  .wk-tab-2 {
    width: 16.666667%;
  }

  .wk-tab-3 {
    width: 25%;
  }

  .wk-tab-4 {
    width: 33.333333%;
  }

  .wk-tab-5 {
    width: 41.666667%;
  }

  .wk-tab-6 {
    width: 50%;
  }

  .wk-tab-7 {
    width: 58.333333%;
  }

  .wk-tab-8 {
    width: 66.666667%;
  }

  .wk-tab-9 {
    width: 75%;
  }

  .wk-tab-10 {
    width: 83.333333%;
  }

  .wk-tab-11 {
    width: 91.666667%;
  }

  .wk-tab-12 {
    width: 100%;
  }
}

@media (max-width: 500px) {
  .wk-mobile-1 {
    width: 8.333333%;
  }

  .wk-mobile-2 {
    width: 16.666667%;
  }

  .wk-mobile-3 {
    width: 25%;
  }

  .wk-mobile-4 {
    width: 33.333333%;
  }

  .wk-mobile-5 {
    width: 41.666667%;
  }

  .wk-mobile-6 {
    width: 50%;
  }

  .wk-mobile-7 {
    width: 58.333333%;
  }

  .wk-mobile-8 {
    width: 66.666667%;
  }

  .wk-mobile-9 {
    width: 75%;
  }

  .wk-mobile-10 {
    width: 83.333333%;
  }

  .wk-mobile-11 {
    width: 91.666667%;
  }

  .wk-mobile-12 {
    width: 100%;
  }
}











.contact_us_6 * {
 
}

.contact_us_6 .text-blk {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  line-height: 25px;
}

.contact_us_6 .responsive-cell-block {
  min-height: 75px;
}

.contact_us_6 input:focus,
.contact_us_6 textarea:focus {
  outline-color: initial;
  outline-style: none;
  outline-width: initial;
}

.contact_us_6 .container-block {
  min-height: 75px;
  width: 100%;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
  display: block;
}

.contact_us_6 .responsive-container-block {
  min-height: 75px;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  margin-top: 0px;
  margin-right: auto;
  margin-bottom: 50px;
  margin-left: auto;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
}

.contact_us_6 .responsive-container-block.big-container {
  padding-top: 10px;
  padding-right: 30px;
  width: 35%;
  padding-bottom: 10px;
  padding-left: 30px;
  background-color: #03a9f4;
  position: absolute;
  height: 950px;
  right: 0px;
}

.contact_us_6 .responsive-container-block.container {
  position: relative;
  min-height: 75px;
  flex-direction: row;
  z-index: 2;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: center;
  padding-top: 0px;
  padding-right: 30px;
  padding-bottom: 0px;
  padding-left: 30px;
  max-width: 1320px;
  margin-top: 0px;
  margin-right: auto;
  margin-bottom: 0px;
  margin-left: auto;
}

.contact_us_6 .container-block.form-wrapper {
  background-color: white;

  text-align: center;
 padding: 20px;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 4px 20px 7px;
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
  border-bottom-left-radius: 6px;
  margin:10px 0 10px 0;
}

.contact_us_6 .text-blk.contactus-head {
  font-size: 36px;
  line-height: 52px;
  font-weight: 900;
}

.contact_us_6 .text-blk.contactus-subhead {
  color: #9c9c9c;
  width: 300px;
  margin-top: 0px;
  margin-right: auto;
  margin-bottom: 50px;
  margin-left: auto;
  display: none;
}

.contact_us_6 .responsive-cell-block.wk-desk-6.wk-ipadp-6.wk-tab-12.wk-mobile-12 {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 26px;
  margin-left: 0px;
  min-height: 50px;
}

.contact_us_6 .input {
  width: 100%;
  height: 50px;
  padding-top: 1px;
  padding-right: 15px;
  padding-bottom: 1px;
  padding-left: 15px;
  border-top-width: 2px;
  border-right-width: 2px;
  border-bottom-width: 2px;
  border-left-width: 2px;
  border-top-style: solid;
  border-right-style: solid;
  border-bottom-style: solid;
  border-left-style: solid;
  border-top-color: #eeeeee;
  border-right-color: #eeeeee;
  border-bottom-color: #eeeeee;
  border-left-color: #eeeeee;
  border-image-source: initial;
  border-image-slice: initial;
  border-image-width: initial;
  border-image-outset: initial;
  border-image-repeat: initial;
  font-size: 16px;
  color: black;
}

.contact_us_6 .textinput {
  width: 98%;
  min-height: 150px;
  padding-top: 20px;
  padding-right: 15px;
  padding-bottom: 20px;
  padding-left: 15px;
  border-top-width: 2px;
  border-right-width: 2px;
  border-bottom-width: 2px;
  border-left-width: 2px;
  border-top-style: solid;
  border-right-style: solid;
  border-bottom-style: solid;
  border-left-style: solid;
  border-top-color: #eeeeee;
  border-right-color: #eeeeee;
  border-bottom-color: #eeeeee;
  border-left-color: #eeeeee;
  border-image-source: initial;
  border-image-slice: initial;
  border-image-width: initial;
  border-image-outset: initial;
  border-image-repeat: initial;
  font-size: 16px;
}

.contact_us_6 .submit-btn {
  width: 98%;
  background-color: #03a9f4;
  height: 60px;
  font-size: 20px;
  font-weight: 700;
  color: white;
  border-top-width: 0px;
  border-right-width: 0px;
  border-bottom-width: 0px;
  border-left-width: 0px;
  border-top-style: outset;
  border-right-style: outset;
  border-bottom-style: outset;
  border-left-style: outset;
  border-top-color: #767676;
  border-right-color: #767676;
  border-bottom-color: #767676;
  border-left-color: #767676;
  border-image-source: initial;
  border-image-slice: initial;
  border-image-width: initial;
  border-image-outset: initial;
  border-image-repeat: initial;
  border-top-left-radius: 40px;
  border-top-right-radius: 40px;
  border-bottom-right-radius: 40px;
  border-bottom-left-radius: 40px;
}


.contact_us_6 .text-blk.input-title {
  text-align: left;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 10px;
  font-size: 14px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 5px;
  margin-left: 0px;
  color: #9c9c9c;
}

.contact_us_6 ::placeholder {
  color: #dadada;
}

.contact_us_6 .mob-text {
  display: block;
  text-align: left;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 25px;
  margin-left: 0px;
}

.contact_us_6 .responsive-cell-block.wk-tab-12.wk-mobile-12.wk-desk-12.wk-ipadp-12 {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 20px;
  margin-left: 0px;
}

.contact_us_6 .text-blk.contactus-subhead.color {
  color: white;
}

.contact_us_6 .map-box {
  max-width: 800px;
  max-height: 520px;
  width: 100%;
  height: 358px;
  background-color: #d9d9d9;
  background-image: url("https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/sc23.png");
  background-size: cover;
  background-position-x: 50%;
  background-position-y: 50%;
}
.map-part {
  padding: 30px;
}
.contact_us_6 .map-part {
  width: 100%;
  height: 100%;
}

.contact_us_6 .text-blk.map-contactus-head {
  font-size: 22px;
 
    margin-bottom: 6px;
  
    color: #1e2d5a;
    font-weight: 700;
}

.contact_us_6 .text-blk.map-contactus-subhead {

}

.contact_us_6 .social-media-links.mob {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 30px;
  margin-left: 0px;
  width: 230px;
  display: flex;
  justify-content: flex-start;
}

.contact_us_6 .link-img {
  width: 30px;
  height: 30px;
  margin-top: 0px;
  margin-right: 25px;
  margin-bottom: 0px;
  margin-left: 0px;
}

.contact_us_6 .link-img.image-block {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
}

.contact_us_6 .social-icon-link {
  margin: 0 25px 0 0;
  padding: 0 0 0 0;
}

@media (max-width: 1024px) {
  .contact_us_6 .responsive-container-block.container {
    justify-content: center;
  }

  .contact_us_6 .map-box {
    position: absolute;
    top: 0px;
    max-height: 320px;
  }

  .contact_us_6 .map-box {
    max-width: 100%;
    width: 100%;
  }

  .contact_us_6 .responsive-container-block.container {
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
  }

  .contact_us_6 .map-part {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .contact_us_6 .container-block.form-wrapper {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .contact_us_6 .mob-text {
    display: block;
  }



  .contact_us_6 .link-img {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    display: flex;
    justify-content: space-evenly;
  }

  .contact_us_6 .social-media-links.mob {
    justify-content: space-evenly;
  }

  .contact_us_6 .responsive-cell-block.wk-desk-7.wk-ipadp-12.wk-tab-12.wk-mobile-12 {
    text-align: center;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    flex-direction: row;
  }

  .contact_us_6 .text-blk.contactus-subhead {
    display: block;
  }

  .contact_us_6 .mob-text {
    text-align: center;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .contact_us_6 .responsive-container-block.container {
    flex-wrap: wrap;
  }

  
}

@media (max-width: 768px) {
  .contact_us_6 .submit-btn {
    width: 100%;
  }

  .contact_us_6 .input {
    width: 100%;
  }

  .contact_us_6 .textinput {
    width: 100%;
  }

  .contact_us_6 .container-block.form-wrapper {
    margin-top: 80px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .contact_us_6 .text-blk.input-title {
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
  }

  .contact_us_6 .form-box {
    padding-top: 0px;
    padding-right: 20px;
    padding-bottom: 0px;
    padding-left: 20px;
  }

  .contact_us_6 .container-block.form-wrapper {
    padding-top: 50px;
    padding-right: 15px;
    padding-bottom: 50px;
    padding-left: 15px;
  }

  .contact_us_6 .mob-text {
    display: block;
  }

  .contact_us_6 .responsive-container-block.container {
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
  }



  .contact_us_6 .container-block.form-wrapper {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

 

  .contact_us_6 .text-blk.contactus-head {
    font-size: 36px;
    line-height: 1.6;
    font-weight: 600;
    letter-spacing: 0px;
  }
}

@media (max-width: 500px) {
  .contact_us_6 .container-block.form-wrapper {
    padding-top: 50px;
    padding-right: 15px;
    padding-bottom: 50px;
    padding-left: 15px;
  }

  .contact_us_6 .container-block.form-wrapper {
    margin-top: 60px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .contact_us_6 .responsive-cell-block.wk-ipadp-6.wk-tab-12.wk-mobile-12.wk-desk-6 {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 15px;
    margin-left: 0px;
  }

  .contact_us_6 .responsive-container-block {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 35px;
    margin-left: 0px;
  }

  .contact_us_6 .text-blk.input-title {
    font-size: 12px;
  }

  .contact_us_6 .text-blk.contactus-head {
    font-size: 26px;
    line-height: 35px;
  }

  .contact_us_6 .input {
    height: 45px;
  }
}
</style>