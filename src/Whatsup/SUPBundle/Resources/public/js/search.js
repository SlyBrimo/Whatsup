$(document).ready(function()
{
  $('.search input[type="submit"]').hide();
  
  //filter options
  $("#eventDisplayNav li a").click(function(){
	$("#eventDisplayNav .current").removeClass("current");
	$(this).parent().addClass("current");
	$('#loader').show();
      $('#events').load(
		this.href,
		{ query: this.id },
		function() { $('#loader').hide(); }
	  );
	return false;
  });
 
  //search funtion
  $('#search_keywords').keyup(function(key)
  {
    if (this.value.length >= 3 || this.value == '')
    {
      $('#loader').show();
      $('#events').load(
        $(this).parents('form').attr('action'),
        { query: this.value + '*' },
        function() { $('#loader').hide(); }
      );
    }
  });
});