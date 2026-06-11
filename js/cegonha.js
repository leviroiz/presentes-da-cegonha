$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.carousel').carousel();
    $('.materialboxed').materialbox();
  });

      
  $(document).ready(function(){
    $('.carousel.carousel-slider').carousel({
      fullWidth: true,
      indicators: true,
      duration: 500,
      interval: 3000
    });

    setInterval(function(){
      $('.carousel.carousel-slider').carousel('next');
    }, 3000);
  });

