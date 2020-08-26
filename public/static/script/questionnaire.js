$(".voting").barrating({
	theme: "fontawesome-stars"
});

var count = $(".employee-data").length;

$(".add-employee").on("click", function (e) {
	e.preventDefault();

	if ($("input[name=email]").val() !== "") {
		count++;

		var tr 		= $("<tr></tr>"),
			td1		= $("<td></td>").attr("width", "400px"),
			strong	= $("<strong></strong>").text($("input[name=email]").val()).appendTo(td1),
			input 	= $("<input />").attr("type", "hidden").attr("name", "employee-" + count).val($("input[name=email]").val()).appendTo(td1),
			td2 	= $("<td></td>"),
			button 	= $("<button></button>").addClass("remove-employee").attr("type", "button").html("<i class='fa fa-trash-o'></i>").appendTo(td2);

		td1.appendTo(tr);
		td2.appendTo(tr);
		tr.appendTo(".invite-employee");

		$("input[name=email]").val("");
	}
});

$("body").on("click", ".remove-employee", function (e) {
	e.preventDefault();

	$(this).parent().parent().remove();
});