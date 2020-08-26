$(".widget").on("click", function (e) {
	e.preventDefault();

	var url = $(this).attr("data-url");

	location.href = url;
});

$('.fancybox').fancybox({
    openEffect	: 'none',
    closeEffect	: 'none'
});