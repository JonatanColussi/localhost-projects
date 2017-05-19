jQuery(document).ready(function($) {
	$("[name=filter]").on('keydown keyup', function(){
		var pesquisa = $(this).val();
		pesquisa = pesquisa.toUpperCase();
		$(".projects > div").each(function(){
			if($(this).text().toUpperCase().indexOf(pesquisa) >= 0)
				$(this).show('fast');
			else
				$(this).hide('fast');
		});
	});
	$(".projects > div").on('click', function(){
		event.preventDefault();
		window.location.href = $(this).data('url');
	});

	if($(window).height() > $("body").height())
		$("footer").css('position', 'fixed');
	else
		$("footer").css('position', 'absolute');
});