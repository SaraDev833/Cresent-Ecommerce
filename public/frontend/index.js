

const openNavbarButton= document.getElementById("openNavbarButton");
const sidebarNavbar= document.getElementById("sidebarNavbar");
const overlayNavbar = document.getElementById("overlayNavbar");
const closeButton=document.querySelectorAll(".closeButton");
const sidebarCategories= document.getElementById("sidebarCategories");
const categoryButton= document.getElementById("categoryButton");
const details = document.querySelectorAll("details");

// open mobile navbar
openNavbarButton.addEventListener("click" , openNavbar);
 function openNavbar(){
    sidebarNavbar.classList.remove('hidden');
    sidebarNavbar.classList.add('visible');
    sidebarNavbar.classList.add('opacity-100');
    overlayNavbar.classList.remove('hidden');
    overlayNavbar.classList.add('visible');
    overlayNavbar.classList.add('opacity-100');
 }
//  open category sidebar
categoryButton.addEventListener("click" , opened);
function opened(){
    sidebarCategories.classList.add('visible');
    sidebarCategories.classList.remove('hidden');
    overlayNavbar.classList.remove('hidden');
    overlayNavbar.classList.add('visible');
}

//  close mobile navbar

closeButton.forEach(button => {
    button.addEventListener('click', closed);
});
function closed() {
  sidebarNavbar.classList.remove("visible");
  sidebarNavbar.classList.add("hidden");

  overlayNavbar.classList.remove("visible");
  overlayNavbar.classList.add("hidden");

  sidebarCategories.classList.remove("visible");
  sidebarCategories.classList.add("hidden")

}

//  close summary tag when another is open
details.forEach((targetDetail)=>{
    targetDetail.addEventListener('click' , ()=>{
        details.forEach((detail)=>{
            if(detail != targetDetail){
                detail.removeAttribute('open');
            }
        })
    })
})

// view from shop page
document.addEventListener('DOMContentLoaded', () => {
  const viewButton = document.getElementById('view');
  const productGrid = document.querySelector('.product_togg');
  const productWide = document.getElementById('product_wide');

  // Initialize the page to show the grid view
  productWide.classList.add('hidden');
  productGrid.classList.remove('hidden');

  // Toggle view between grid and detailed view
  viewButton.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default anchor behavior

    // Check the current visibility status
    if (productWide.classList.contains('hidden')) {
      // If detailed view is hidden, show it and hide the grid view
      productWide.classList.remove('hidden');
      productGrid.classList.add('hidden');
      viewButton.innerHTML = 'View : <i class="text-lg text-red-500 fa-solid fa-layer-group"></i>'; // Change icon to grid view
    } else {
      // If detailed view is visible, hide it and show the grid view
      productWide.classList.add('hidden');
      productGrid.classList.remove('hidden');
      viewButton.innerHTML = 'View : <i class="text-lg text-red-500 fa-solid fa-list"></i>'; // Change icon to list view
    }

    // Scroll to the newly visible section
    const targetView = productWide.classList.contains('hidden') ? productGrid : productWide;
    targetView.scrollIntoView({ behavior: 'smooth' });
  });
});



//
 swiper = new Swiper(".mySwiper", {

  scrollbar: {
    el: ".swiper-scrollbar",

    hide: false,



    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false
    },

    on: {
      autoplayTimeLeft(s, time, progress) {
        progressCircle.style.setProperty("--progress", 1 - progress);
        progressContent.textContent = `${Math.ceil(time / 1000)}s`;
      }
    }
  },

});


const progressCircle = document.querySelector(".autoplay-progress svg");
const progressContent = document.querySelector(".autoplay-progress span");
var swiper = new Swiper(".mySwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false
  },


  on: {
    autoplayTimeLeft(s, time, progress) {
      progressCircle.style.setProperty("--progress", 1 - progress);
      progressContent.textContent = `${Math.ceil(time / 1000)}s`;
    }
  }
});

// slick
$(document).ready(function() {
  $('.responsive').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    prevArrow: '<i class="fa-solid fa-arrow-left left"></i>',
    nextArrow: '<i class="fa-solid fa-arrow-right right"></i>',
    responsive: [
        // {
        //     breakpoint: 1300,
        //     settings: {
        //       slidesToShow: 5,
        //       slidesToScroll: 5,
        //       infinite: true,
        //       dots: false
        //     }
        //   },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 300,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  }); // <-- Add this closing parenthesis and semicolon
});


  // deal of the day timer

var end_date_id=document.getElementById('demo');
var date_attr = end_date_id.getAttribute('data-end-date');

var countDownDate = new Date(date_attr).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    end_date_id.innerHTML = "EXPIRED";
  }
}, 1000);

// product single page
console.log("index.js is loaded");
document.addEventListener('DOMContentLoaded', function () {
  var swiper = new Swiper(".swiper-container", {
    // spaceBetween: 10,
    // slidesPerView: 1,
    // freeMode: true,
    // watchSlidesProgress: true,
  });

  var swiper2 = new Swiper(".swiper-container-2", {
    spaceBetween: 10,

    thumbs: {
      swiper: swiper,
    },
  });
});

// view

