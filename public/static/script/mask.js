if ($("input[name=data_nascimento]").length) {
	$("input[name=data_nascimento]").mask("00/00/0000");
}

if ($("input[name=telefone]").length) {
	$("input[name=telefone]").mask("(00)0000-0000");
}

if ($("input[name=celular]").length) {
	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$("input[name=celular]").mask(SPMaskBehavior, spOptions);
}

if ($("input[name=cpf]").length) {
	$("input[name=cpf]").mask("000.000.000-00");
}

if ($("input[name=cnpj]").length) {
	$("input[name=cnpj]").mask("00.000.000/0000-00");
}

if ($("input[name=valor]").length) {
	$("input[name=valor]").mask('#.##0,00', {reverse: true});
}

if ($("input[name=price]").length) {
	$("input[name=price]").mask('#.##0,00', {reverse: true});
}

if ($("input[name=evaluation]").length) {
	$("input[name=evaluation]").mask('#.##0,00', {reverse: true});
}

if ($("input[name=tag]").length) {
	$("input[name=tag]").mask('0#');
}