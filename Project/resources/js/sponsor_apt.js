$(document).ready(function(){

  $('#button_basic').click(
    function(){
      $('#dropdown_sponsor_standard').hide();
      $('#dropdown_sponsor_premium').hide();
      $('#button_standard').text('Scegli');
      $('#button_premium').text('Scegli');
      $('#dropdown_sponsor_basic').slideToggle(500);
      if ($(this).text() === 'Scegli') {
        $(this).text('Chiudi')
      } else if ($(this).text()=== 'Chiudi') {
        $(this).text('Scegli')
      }
    }
  );

  $('#button_standard').click(
    function(){
      $('#dropdown_sponsor_basic').hide();
      $('#dropdown_sponsor_premium').hide();
      $('#button_basic').text('Scegli');
      $('#button_premium').text('Scegli');
      $('#dropdown_sponsor_standard').slideToggle(500);
      if ($(this).text() === 'Scegli') {
        $(this).text('Chiudi')
      } else if ($(this).text()=== 'Chiudi') {
        $(this).text('Scegli')
      }
    }
  );

  $('#button_premium').click(
    function(){
      $('#dropdown_sponsor_basic').hide();
      $('#dropdown_sponsor_standard').hide();
      $('#button_basic').text('Scegli');
      $('#button_standard').text('Scegli');
      $('#dropdown_sponsor_premium').slideToggle(500);
      if ($(this).text() === 'Scegli') {
        $(this).text('Chiudi')
      } else if ($(this).text()=== 'Chiudi') {
        $(this).text('Scegli')
      }
    }
  );
});
