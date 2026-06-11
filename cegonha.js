$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.carousel').carousel();
    $('.materialboxed').materialbox();
  });

      
  $(document).ready(function(){
    $('.carousel.carousel-slider').carousel({
      fullWidth: true,
      indicators: true,
      duration: 200,
      interval: 200
    });

    setInterval(function(){
      $('.carousel.carousel-slider').carousel('next');
    }, 4000);
  });

 
  
 

