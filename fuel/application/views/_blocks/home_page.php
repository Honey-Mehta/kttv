
    
     
          <?php 
          
          //echo fuel_block('carousel');
          
          ?>

         <?php echo fuel_block('herosection');?>
          <?php echo fuel_block('about-us');?>

          <?php echo fuel_block('mission');?>
          <?php echo fuel_block('message');?>
          <?php //echo fuel_block('imp_link');?>
          <?php //echo fuel_block('news');?>
          <?php //echo fuel_block('contact_us')?>
                      

         

    <script>
        const animatedEls = document.querySelectorAll("[data-animation]");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                const animation = entry.target.getAttribute("data-animation");

                if (entry.isIntersecting) {
                    entry.target.classList.add("animated", `${animation}`);
                } else {
                    entry.target.classList.remove("animated", `${animation}`);
                }
            });
        });

        animatedEls.forEach((el) => observer.observe(el));
    </script>


<!-- 
<div class="innerpage-wrapper">
    <div class="container">
        <div class="table-responsive">
            <table class="datatable table">
                <tbody>
                    <tr>
                        <td>
                            <input type="date" style="float:right;width:200px;" class="form-control ninja_filter_date_picker" 
                                   data-date_format="DD/MMM/YYYY" placeholder="Search Date" spellcheck="false" 
                                   autocorrect="off" autocapitalize="none" id="nt_cf_0_table_31602">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> -->
<!-- Notification Button -->

   <!-- Button to Open Modal -->
   <div class="buttons noticebtn"><a href="#">Notice Board</a></div>
 
<!-- Modal -->
<div id="modal" class="modal overlay noticeoverlay is-on">
    <div class="modal-content container">
        <?php 
        // Fetch notifications where published = 'yes'
        $notice_boards = fuel_model('notice_board', [
            'where' => [
                'published' => 'yes'
            ]
        ]); 
        ?>

        <h2 class="border-bottom modal-heading">Notice Board</h2>
        <!-- <button id="closeModal">Close</button> -->
        <div id="close" class="closeModal">
                <!-- <img src="images/svgs/closeicn.svg" /> -->
                <img src="<?php echo img_path('svgs/closeicn.svg');?>">

            </div>
        <div id="DivScroll" style="height: 280px;" class="scroll-y"> 
            <?php if (!empty($notice_boards)): ?> 
                <?php foreach ($notice_boards as $notice_board): ?>
                    <h3 style="background-color: rgba(33, 65, 122, .1); text-align:left;" ><?php echo $notice_board['headline']; ?></h3>
                    <ul>
                        <li style="list-style-type:none;">
                            <div style="z-index: 720; text-align:left;">
                                <span style="font-size: 13.3333px; ">
                                    <?php echo $notice_board['description']; ?>
                                    <?php
$pdf_link = !empty($notice_board['pdf']) 
    ? site_url('assets/images/notice_board/' . $notice_board['pdf']) 
    : site_url('#');
?>
&nbsp;<a href="<?php echo $pdf_link; ?>" <?php echo !empty($notice_board['pdf']) ? 'target="_blank"' : ''; ?>>क्लिक करें।</a>
                                </span>
                            </div>
                        </li>
                    </ul>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No Information Available at Notice Board.</p>
            <?php endif; ?>   
        </div>
    </div>
</div>

<!-- JavaScript to Handle Modal -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const closeModal = document.getElementsByClassName("closeModal")[0]; 

    // Show the modal when the page loads
    setTimeout(() => {
        modal.classList.add("show");
    }, 500); // Delay to enhance the effect

    // Close the modal on button click
    closeModal.addEventListener("click", () => {
        modal.classList.remove("show");
    });
});

</script>

<!-- Modal Styling -->
<style>


#close {
    position: absolute;
    right: -26px;
    top: -26px;
    font-size: 15px;
    color: #999;
    cursor: pointer;
    z-index: 9999999;
    opacity: .5;
}



/* Modal overlay */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden; /* Hidden by default */
    opacity: 0;
    transition: visibility 0s, opacity 0.3s;
    Z-index: 9998;
}

/* Modal content */
.modal-content {
    width:50%;
    background: white;
    padding: 20px;
    /* border-radius: 10px; */
    height:60%;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    /* text-align: center; */
    transform: translateY(-100%); /* Start off-screen */
    animation: slideIn 0.8s ease forwards; /* Animate when modal becomes visible */
}

/* Modal visible state */
.modal.show {
    visibility: visible;
    opacity: 1;
}

/* Slide-in animation */
@keyframes slideIn {
    from {
        transform: translateY(-100%); /* Off-screen at the top */
    }
    to {
        transform: translateY(0); /* Centered position */
    }
}

.modal-heading {
    text-align: left;
    font-size: 24px;
    font-weight: 600;
    padding-bottom: 8px;

}


.overlay.is-on {
        display: flex; /* Show overlay */
        justify-content: center;
        align-items: center;
       /* Apply animation */
    }

    @media (max-width: 540px){
       .modal-content {
        width: 100%;
       }
    }
</style>

  

       <!-- Tab Side -->
       <script>
        $(".buttons").on("click", function () {
            $(".overlay").addClass("is-on");
        });

        $("#close").on("click", function () {
            $(".overlay").removeClass("is-on");
        });

    </script>