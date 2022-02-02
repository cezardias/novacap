$(document).ready(function() {
 // hides the slickbox as soon as the DOM is ready (a little sooner that page load)
  $('#slickbox').hide();
  
 // shows and hides and toggles the slickbox on click  
  $('#slick-show').click(function() {
    $('#slickbox').show('slow');
    return false;
  });
  $('#slick-hide').click(function() {
    $('#slickbox').hide('fast');
    return false;
  });
  
  $('#slick-toggle').click(function() {
    $('#slickbox').toggle(400);
    return false;
  });


  //$('#caixa1').hide();//FECHA CAIXA
  $('#toggle-caixa1').click(function() {
    $('#caixa1').toggle(400);
    return false;
  });

  //$('#caixa2').hide();
  $('#toggle-caixa2').click(function() {
    $('#caixa2').toggle(400);
    return false;
  });

  //$('#caixa3').hide();
  $('#toggle-caixa3').click(function() {
    $('#caixa3').toggle(400);
    return false;
  });  

  //$('#caixa4').hide();  
  $('#toggle-caixa4').click(function() {
    $('#caixa4').toggle(400);
    return false;
  });  

  //$('#caixa5').hide();  
  $('#toggle-caixa5').click(function() {
    $('#caixa5').toggle(400);
    return false;
  });  
  
  //$('#caixa6').hide();  
  $('#toggle-caixa6').click(function() {
    $('#caixa6').toggle(400);
    return false;
  });  
  
  //$('#caixa7').hide();  
  $('#toggle-caixa7').click(function() {
    $('#caixa7').toggle(400);
    return false;
  });  
  
  //$('#caixa8').hide();  
  $('#toggle-caixa8').click(function() {
    $('#caixa8').toggle(400);
    return false;
  });        

  //$('#caixa9').hide();  
  $('#toggle-caixa9').click(function() {
    $('#caixa9').toggle(400);
    return false;
  });  

 // slides down, up, and toggle the slickbox on click    
  $('#slick-down').click(function() {
    $('#slickbox').slideDown('slow');
    return false;
  });
  $('#slick-up').click(function() {
    $('#slickbox').slideUp('fast');
    return false;
  });
  $('#slick-slidetoggle').click(function() {
    $('#slickbox').slideToggle(400);
    return false;
  });
});