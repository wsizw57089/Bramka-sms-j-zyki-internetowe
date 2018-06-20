$(function() {
  
  $(document).on('click', '#checkAll', function() {
  
    if ($(this).val() == 'Check All') {
      $('.button input').prop('checked', true);
      $(this).val('Uncheck All');
    } else {
      $('.button input').prop('checked', false);
      $(this).val('Check All');
    }
  });
  
});