<div class="innerpage-wrapper" style="min-height:500px;">
      
            <div class="container">
                <!-- Img on which you want to trigger carousel -->
                <div class="carousel-row row">

                <?php 
            $photo = fuel_model('photo', ['where' => ['published' => 'yes']]); 
            if (!empty($photo)): 
                foreach ($photo as $employee): ?>

                    <div class="carousel-row--img col-xl-3 col-lg-3 col-md-3 col-sm-12">

                        <img src="<?php echo img_path('gallery/' . $employee['image']); ?>" class="hover-shadow" />
                    </div>
                    <?php endforeach; 
            else: ?>
            
                <p class="text-center">No Photo found in the directory.</p>
            <?php endif; ?>

                </div>

                <!-- The Modal/Lightbox -->
                <div id="myModal" class="modal no-select" >
                    <span class="close cursor">&times;</span>
                    <!-- Next/previous controls -->
                    <a class="prev no-select">&#10094;</a>
                    <a class="next no-select">&#10095;</a>
                    <div class="modal-content">


                    <?php 
            $photo = fuel_model('photo', ['where' => ['published' => 'yes']]); 
            if (!empty($photo)): 
                foreach ($photo as $employee): ?>

                        <div class="my-slides">
                            <div class="my-slides--number"></div>
                            <img src="<?php echo img_path('gallery/' . $employee['image']); ?>" />
                        </div>


                        <?php endforeach; 
            else: ?>
            
                <p class="text-center">No Photo found in the directory.</p>
            <?php endif; ?>


                        <!-- Caption text -->
                        <div class="caption-container">
                            <p id="caption"></p>
                        </div>

                        <!-- Thumbnail image controls -->
                        <div class="column-box">
                        <?php 
            $photo = fuel_model('photo', ['where' => ['published' => 'yes']]); 
            if (!empty($photo)): 
                foreach ($photo as $employee): ?>

                            <div class="column">
                                <img class="demo" src="<?php echo img_path('gallery/' . $employee['image']); ?>" />
                            </div>
                            <?php endforeach; 
            else: ?>
            
                <p class="text-center">No Photo found in the directory.</p>
            <?php endif; ?>

                         
                        </div>
                    </div>
                </div>

            </div>
            </div>
    
        </div>






<style>
        /* New gallery 03.02.2025 */
                      
                      img.hover-shadow {
                        transition: all 0.3s; }
                      
                      .carousel-row {
                        /*max-width:90%;*/
                        margin: 0 auto;
                        /*margin-top: 20px;*/
                        display: flex;
                        /*justify-content: space-between;
                        align-items: center;*/
                        flex-wrap: wrap; }
                        .carousel-row--img {
                          width: 30%;
                          margin-bottom: 10px; }
                          .carousel-row--img img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            cursor: pointer;
                            transition: 0.4s;
                      
                      
                            min-height: 181px;
                        min-width: 267px;
                      border-radius: 5px;
                        border: 10px solid rgba(168, 168, 168, 0.1);
                      }
                      
                            .carousel-row--img img:hover {
                              box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2), 0 12px 20px 0 rgba(0, 0, 0, 0.19); }
                      
                      .column-box {
                        white-space: nowrap;
                        background-color: transparent;
                        width: 100%;
                        background: black;
                        overflow: hidden; }
                        .column-box .column {
                          width: 20%;
                          display: inline-block;
                          transition: all 1s;
                      }
                          .column-box .column img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            cursor: pointer; }
                      
                      /* The Modal */
                      .modal {
                        display: none;
                        position: fixed;
                        z-index: 1;
                        padding: 50px 0;
                        left: 0;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        overflow: hidden;
                        background-color: black; }
                        .modal.no-select {
                          -webkit-touch-callout: none;
                          -webkit-user-select: none;
                          -khtml-user-select: none;
                          -moz-user-select: none;
                          -ms-user-select: none;
                          user-select: none; 
                        top:0;
                        z-index: 999 !important;
                        }
                        .modal-content {
                          margin: auto;
                          width: 50% !important;
                          overflow: hidden;
                      }
                          @media only screen and (max-width: 37.5em) {
                            .modal-content {
                              width: 90%;
                              position: absolute;
                              top: 50%;
                              left: 50%;
                              transform: translate(-50%, -50%); } }
                      
                      @keyframes anime {
                        0% {
                          opacity: 0;
                          transform: scale(0.9); }
                        100% {
                          opacity: 1;
                          transform: scale(1); } }
                      
                      .my-slides {
                        display: none;
                        height: 60vh;
                        transition: all 2s;
                        overflow: hidden;
                        animation: anime 0.8s ease-in; 
                        position: relative;
                      }
                        @media only screen and (max-width: 56.25em) {
                          .my-slides {
                            height: 70vh; } }
                        @media only screen and (max-width: 37.5em) {
                          .my-slides {
                            height: 30vh; } }
                        .my-slides img {
                          object-fit: cover;
                          width: 100%;
                          height: 100%; }
                        .my-slides--number {
                          color: #f2f2f2;
                          font-size: 12px;
                          padding: 8px 12px;
                          position: absolute;
                          top: 0; }
                      
                      .demo {
                        opacity: 0.5;
                        transition: all 0.4s; }
                        .demo.active, .demo:hover {
                          opacity: 1; }
                      
                      /* Caption text */
                      .caption-container {
                        text-align: center;
                        background-color: black;
                        padding: 6px 16px;
                        color: white; }
                      
                      /* The Close Button */
                      .close {
                        color: white;
                        position: absolute;
                        top: 10px;
                        right: 25px;
                        font-size: 35px;
                        font-weight: bold; }
                        .close:hover, .close:focus {
                          color: #999;
                          text-decoration: none;
                          cursor: pointer; }
                      
                      /* Next & previous buttons */
                      .prev,
                      .next {
                        cursor: pointer;
                        position: fixed;
                        top: 50%;
                        width: auto;
                        padding: 16px;
                        color: white;
                        font-weight: bold;
                        font-size: 50px;
                        transition: 0.6s ease;
                        transform: translateY(-50%); }
                        @media only screen and (max-width: 37.5em) {
                          .prev,
                          .next {
                            position: fixed;
                            top: 95%;
                            padding: 10px;
                            font-size: 40px;
                            transform: translateY(-50%); } }
                        .prev:active,
                        .next:active {
                          font-size: 30px; }
                      
                      /* Position the "next button" to the right */
                      .next {
                        right: 0; }
                      
                      .prev {
                        left: 0; }
                        @media only screen and (max-width: 37.5em) {
                          .prev {
                            left: 80%; } }
                      
                      /* On hover, add a black background color with a little bit see-through */
                      .prev:hover,
                      .next:hover {
                        background-color: rgba(255, 255, 255, 0.1); }
                        @media only screen and (max-width: 37.5em) {
                          .prev:hover,
                          .next:hover {
                            background-color: transparent; } }
                        .footer-section {
                      
                          z-index:-1 !important;
                      }
                      </style>


    <!-- Gallery -->
    <!-- Gallery -->
  <!-- Gallery -->
  <script>
        // buttons
        const prev = document.querySelector(".prev");
        const next = document.querySelector(".next");
        const closeCur = document.querySelector(".close")

        // modal
        const modalContent = document.querySelector(".modal-content");
        const slides = Array.from(document.querySelectorAll(".my-slides"));
        const columns = document.querySelectorAll(".column");
        const demos = Array.from(document.querySelectorAll(".demo"));

        // text
        const numberText = document.querySelectorAll('.my-slides--number');
        const captionText = document.getElementById("caption");

        // img on page
        const hoverShadows = Array.from(document.querySelectorAll(".hover-shadow"));


        let slideIndex;
        let translate = 0;
        let columnWidth;


        // if window resize reset all values
        window.addEventListener("resize", () => {
            columnWidth = columns[0].offsetWidth;
            columns.forEach(el => {
                el.style.transform = `translateX(0)`;
            })
            slideIndex = 1;
            translate = 0;
            showSlides(slideIndex)
        })

        // buttons action

        prev.addEventListener("click", () => {
            if (slideIndex === 1) return false
            plusSlides(-1)
            if (translate === 0) return null
            translate += columnWidth + 4;
            columns.forEach(el => {
                el.style.transform = `translateX(${translate}px)`;
            })
        });

        next.addEventListener("click", () => {
            if (demos.length + 1 === 1) return false
            plusSlides(1)
            if (translate === -(columns.length - 3) * (columnWidth + 4)) return null
            translate -= columnWidth + 4;
            columns.forEach(el => {
                el.style.transform = `translateX(${translate}px)`;
            })
        });
        closeCur.addEventListener("click", () => closeModal());


        // add click to main img to trigger open carousel 

        hoverShadows.forEach((el, i) => {
            el.addEventListener("click", () => {
                openModal()
                currentSlide(i + 1)
            });
        })

        // add click thumbnails to show curent slide

        demos.forEach((el, i) => {
            el.addEventListener("click", () => currentSlide(i + 1));
        })

        // Open modal

        function openModal() {
            document.getElementById("myModal").style.display = "block";
            columnWidth = columns[0].offsetWidth;
            showAndClose();
            numberText.forEach((el, id) => {
                el.innerHTML = `${id + 1} / ${numberText.length}`
            })
        }

        // Close the Modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        slideIndex = 1;


        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }


        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
            let x = (n - 3) < 0 ? 0 : (n - 3);
            translate = -(columnWidth + 4) * x;
            columns.forEach(el => {
                el.style.transform = `translateX(${translate}px)`;
            })
        }

        // control showing slides

        function showSlides(n) {
            let i;
            showAndClose();
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < demos.length; i++) {
                demos[i].classList.remove("active")
            }
            slides[slideIndex - 1].style.display = "block";
            demos[slideIndex - 1].classList.add("active");
            captionText.innerHTML = demos[slideIndex - 1].alt;
        }

        // control buttons if reach to limit left or right

        function showAndClose() {
            if (slideIndex === 1) {
                prev.style.display = "none"
            } else {
                prev.style.display = "block"
            }

            if (slideIndex === demos.length) {
                next.style.display = "none";
            } else {
                next.style.display = "block";
            }
        }
    </script>