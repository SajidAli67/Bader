$('.counting').each(function() {
    var $this = $(this),
    countTo = $this.attr('data-count');

  $({ countNum: $this.text()}).animate({
    countNum: countTo
    },

  {

  duration: 3000,
  easing:'linear',
  step: function() {
  $this.text(Math.floor(this.countNum));
},
  complete: function() {
  $this.text(this.countNum);
  //alert('finished');
}

});  


});



$(document).ready (function(){
    $('.menu-toggle').click(function(){
      $('.menu-toggle').toggleClass('active')
      $('.menu').toggleClass('active')
    })
  })


window.addEventListener("scroll",function(){
    var header_nav = document.querySelector('._main_nav');
    header_nav.classList.toggle('sticky',window.scrollY> 0);
  })