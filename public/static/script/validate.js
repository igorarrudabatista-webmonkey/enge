$(".form").validate({
	messages: {
		nome: {
			required: "Este campo é obrigatório."
		},
		email: {
			required: "Este campo é obrigatório."
		},
		cpf: {
			required: "Este campo é obrigatório."
		},
		produto: {
			required: "Este campo é obrigatório."
		},
		carga_horaria: {
			required: "Este campo é obrigatório."
		},
		valor: {
			required: "Este campo é obrigatório."
		},
		analise: {
			required: "Este campo é obrigatório."
		},
		produto_id: {
			required: "Este campo é obrigatório."
		},
		competencia: {
			required: "Este campo é obrigatório."
		},
		analise_id: {
			required: "Este campo é obrigatório."
		},
		evento: {
			required: "Este campo é obrigatório."
		},
		cidade: {
			required: "Este campo é obrigatório."
		},
		uf: {
			required: "Este campo é obrigatório."
		},
		palestrante: {
			required: "Este campo é obrigatório."
		},
		data_inicio: {
			required: "Este campo é obrigatório."
		},
		data_fim: {
			required: "Este campo é obrigatório."
		},
		evento_id: {
			required: "Este campo é obrigatório."
		},
		lider_id: {
			required: "Este campo é obrigatório."
		},
		competencia_id: {
			required: "Este campo é obrigatório."
		},
		questao: {
			required: "Este campo é obrigatório."
		},
		tipo: {
			required: "Este campo é obrigatório."
		},
		pergunta: {
			required: "Este campo é obrigatório."
		},
		assunto: {
			required: "Este campo é obrigatório."
		},
		corpo: {
			required: "Este campo é obrigatório."
		},
		data_nascimento: {
			required: "Este campo é obrigatório."
		},
		telefone: {
			required: "Este campo é obrigatório."
		},
		celular: {
			required: "Este campo é obrigatório."
		},
		rg: {
			required: "Este campo é obrigatório."
		},
		nota_fiscal: {
			required: "Este campo é obrigatório."
		}
	}
});

var nome 			= $("input[name=nome]"),
	email 			= $("input[name=email]"),
	cpf 			= $("input[name=cpf]"),
	produto 		= $("input[name=produto]"),
	carga_horaria 	= $("input[name=carga_horaria]"),
	valor	 		= $("input[name=valor]"),
	analise			= $("input[name=analise]"),
	produto_id		= $("select[name=produto_id]"),
	competencia		= $("input[name=competencia]"),
	analise_id		= $("select[name=analise_id]"),
	evento			= $("input[name=evento]"),
	cidade			= $("input[name=cidade]"),
	uf				= $("select[name=uf]"),
	palestrante		= $("input[name=palestrante]"),
	data_inicio		= $("input[name=data_inicio]"),
	data_fim		= $("input[name=data_fim]"),
	evento_id		= $("select[name=evento_id]"),
	lider_id		= $("select[name=lider_id]"),
	competencia_id	= $("select[name=competencia_id]"),
	questao			= $("input[name=questao]"),
	tipo			= $("select[name=tipo]"),
	pergunta		= $("textarea[name=pergunta]"),
	assunto			= $("input[name=assunto]"),
	corpo			= $("textarea[name=corpo]"),
	data_nascimento	= $("input[name=data_nascimento]"),
	telefone		= $("input[name=telefone]"),
	celular			= $("input[name=celular]"),
	rg				= $("input[name=rg]"),
	nota_fiscal		= $("select[name=nota_fiscal]");

if (nome.length) {
	nome.rules("add", {
		required: true
	});
}

if (email.length) {
	email.rules("add", {
		required: true
	});
}

if (cpf.length) {
	cpf.rules("add", {
		required: true
	});
}

if (produto.length) {
	produto.rules("add", {
		required: true
	});
}

if (carga_horaria.length) {
	carga_horaria.rules("add", {
		required: true
	});
}

if (valor.length) {
	valor.rules("add", {
		required: true
	});
}

if (analise.length) {
	analise.rules("add", {
		required: true
	});
}

if (produto_id.length) {
	produto_id.rules("add", {
		required: true
	});
}

if (competencia.length) {
	competencia.rules("add", {
		required: true
	});
}

if (analise_id.length) {
	analise_id.rules("add", {
		required: true
	});
}

if (evento.length) {
	evento.rules("add", {
		required: true
	});
}

if (cidade.length) {
	cidade.rules("add", {
		required: true
	});
}

if (uf.length) {
	uf.rules("add", {
		required: true
	});
}

if (palestrante.length) {
	palestrante.rules("add", {
		required: true
	});
}

if (data_inicio.length) {
	data_inicio.rules("add", {
		required: true
	});
}

if (data_fim.length) {
	data_fim.rules("add", {
		required: true
	});
}

if (evento_id.length) {
	evento_id.rules("add", {
		required: true
	});
}

if (lider_id.length) {
	lider_id.rules("add", {
		required: true
	});
}

if (competencia_id.length) {
	competencia_id.rules("add", {
		required: true
	});
}

if (questao.length) {
	questao.rules("add", {
		required: true
	});
}

if (tipo.length) {
	tipo.rules("add", {
		required: true
	});
}

if (pergunta.length) {
	pergunta.rules("add", {
		required: true
	});
}

if (assunto.length) {
	assunto.rules("add", {
		required: true
	});
}

if (corpo.length) {
	corpo.rules("add", {
		required: true
	});
}

if (data_nascimento.length) {
	data_nascimento.rules("add", {
		required: true
	});
}

if (telefone.length) {
	telefone.rules("add", {
		required: true
	});
}

if (celular.length) {
	celular.rules("add", {
		required: true
	});
}

if (rg.length) {
	rg.rules("add", {
		required: true
	});
}

if (nota_fiscal.length) {
	nota_fiscal.rules("add", {
		required: true
	});
}