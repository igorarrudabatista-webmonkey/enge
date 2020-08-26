var value = [];

function datatable(columnToOrder) {
	$('.dataTables-example').each(function (i) {
		$(this).dataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Nenhum registro encontrado :(",
				"info": "Mostrando _START_ até _END_ de _TOTAL_ entradas de registro",
				"infoEmpty": "Nenhum registro disponível",
				"loadingRecords": "Carregando...",
				"processing": "Processando...",
				"search": "Pesquisar: ",
				"paginate": {
					"first": "Primeira",
					"last": "Última",
					"next": "Próxima",
					"previous": "Anterior"
				}
			},
			columnDefs: [
				{targets: 'no-sort', orderable: false},
				{targets: 'col-hide', visible: false}
			],
			"order": [[columnToOrder, "asc"]],
			"fnDrawCallback": function() {

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.activate-inscription'
				 *
				 * Funcionalidade:
				 * - Ativar inscrições canceladas. (DESABILITADO)
				 */
				if ($(".activate-inscription").length) {
					$(".activate-inscription").off("click");
					$(".activate-inscription").on("click", function (e) {
						e.preventDefault();

						$(".modal-body-title").html("Você deseja, realmente, ativar essa inscrição?");

						$(".confirm").attr("data-href", $(this).attr("href"));

						$(".confirm").on("click", function (e) {
							e.preventDefault();

							var url = $(this).attr("data-href");

							location.href = url;
						});

						$(".modal").modal("toggle");
					});
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.cancel-inscription'
				 *
				 * Funcionalidade:
				 * - Cancelar inscrições.
				 */
				if ($(".cancel-inscription").length) {
					$(".cancel-inscription").off("click");
					$(".cancel-inscription").on("click", function (e) {
						e.preventDefault();

						$(".modal-body-title").html("Você deseja, realmente, cancelar essa inscrição?");

						$(".confirm").attr("data-href", $(this).attr("href"));

						$(".confirm").on("click", function (e) {
							e.preventDefault();

							var url = $(this).attr("data-href");

							location.href = url;
						});

						$(".modal").modal("toggle");
					});	
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.confirm-inscription'
				 *
				 * Funcionalidade:
				 * - Confirmar inscrições públicas no evento.
				 */
				if ($(".confirm-inscription").length) {
					$(".confirm-inscription").off("click");
					$(".confirm-inscription").on("click", function (e) {
						e.preventDefault();

						$(".modal-body-title").html("Você deseja, realmente, confirmar essa inscrição?");

						$(".confirm").attr("data-href", $(this).attr("href"));

						$(".confirm").on("click", function (e) {
							e.preventDefault();

							var url = $(this).attr("data-href");

							location.href = url;
						});

						$(".modal").modal("toggle");
					});
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.generate-key'
				 *
				 * Funcionalidade:
				 * - Gerar nova chave para inscrição.
				 *
				 * OBS:
				 * - Esta ação apaga todos os registros relacionados à chave anterior, como liderados, votações e respostas.
				 */
				if ($(".generate-key").length) {
					$(".generate-key").off("click");
					$(".generate-key").on("click", function (e) {
						e.preventDefault();

						$(".modal-body-title").html("Você deseja, realmente, gerar uma nova chave para essa inscrição?");

					    var url = $(this).attr("href"),
					    	key = $(this).attr("data-key");

					    $(".confirm").on("click", function (e) {
					    	var form = $("<form action='" + url + "' method='post'></form>");

					    	var input = $("<input />").attr("type", "hidden").attr("name", "old_key").val(key).appendTo(form);

					    	form.appendTo("body").submit().remove();
					    });

					    $(".modal").modal("toggle");
					});
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.generate-key'
				 *
				 * Funcionalidade:
				 * - Gerar nova chave para inscrição.
				 *
				 * OBS:
				 * - Esta ação apaga todos os registros relacionados à chave anterior, como liderados, votações e respostas.
				 */
				if ($(".remand").length) {
					$(".remand").off("click");
					$(".remand").on("click", function (e) {
						e.preventDefault();

						$(".modal-body-title").html("Você deseja, realmente, reenviar o email de inscrição deste registro?");

					    var url = $(this).attr("href"),
					    	key = $(this).attr("data-key");

					    $(".confirm").on("click", function (e) {
					    	var form = $("<form action='" + url + "' method='post'></form>");

					    	var input = $("<input />").attr("type", "hidden").attr("name", "key").val(key).appendTo(form);

					    	form.appendTo("body").submit().remove();
					    });

					    $(".modal").modal("toggle");
					});
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.get-key'
				 *
				 * Funcionalidade:
				 * - Apresentar chave de inscrição em uma Modal Box para que o usuário possa acessá-la e copiá-la.
				 */
				if ($(".get-key").length) {
					$(".get-key").off("click");
					$(".get-key").on("click", function (e) {
						e.preventDefault();

						if ($(".input-key").length) {
							$(".input-key").remove();
						}

						var input = $("<input />").attr("type", "text").addClass("input-key form-control").attr("value", $(this).attr("data-key")).appendTo(".modal-body");

						$(".modal-body-title").html("A chave da inscrição é: ");

						$(".input-key").on("click", function (e) {
							$(this).select();
						});

						$(".modal-footer").hide();

					    $(".modal").modal("toggle");

						$(".modal").on("hidden.bs.modal", function () {
							$(".input-key").remove();
							$(".modal-footer").show();
						});
					});
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.finalize'
				 *
				 * Funcionalidade:
				 * - Finalizar os eventos.
				 */
				if ($(".finalize").length) {
					$(".finalize").off("click");
					$(".finalize").on("click", function (e) {
					    e.preventDefault();

					    $(".modal-body-title").html("Você deseja, realmente, finalizar esse evento?");

					    $(".confirm").attr("data-href", $(this).attr("href"));

					    $(".confirm").on("click", function (e) {
					        e.preventDefault();

					        var url = $(this).attr("data-href");

					        location.href = url;
					    });

					    $(".modal").modal("toggle");
					});
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.delete'
				 *
				 * Funcionalidade:
				 * - Deletar os registros.
				 */
				if ($(".delete").length) {
					$(".delete").off("click");
					$(".delete").on("click", function (e) {
					    e.preventDefault();

					    $(".modal-body-title").html("Você deseja, realmente, excluir esse registro?");

					    $(".confirm").attr("data-href", $(this).attr("href"));

					    $(".confirm").on("click", function (e) {
					        e.preventDefault();

					        var url = $(this).attr("data-href");

					        location.href = url;
					    });

					    $(".modal").modal("toggle");
					});
				}

				/**
				 *
				 * Atrelando evento click à todos os links da Datatable que possuem a classe '.btn-status'
				 *
				 * Funcionalidade:
				 * - Ativar e Desativar os registros.
				 */
				if ($(".btn-status").length) {
					$(".btn-status").off("click");
					$(".btn-status").on("click", function (e) {
						e.preventDefault();

						var url,
							elm = $(this),
							span = $(this).find("span"),
							id = $(this).parent().siblings(".reg-id").text();

						if (elm.hasClass("activate")) {
							url = $(this).attr("data-activate");
						} else {
							url = $(this).attr("data-deactivate");
						}

						$.ajax({
							method: "POST",
							url: url,
							success: function (data) {
								if (elm.hasClass("activate")) {
									elm.removeClass("activate").addClass("deactivate").attr("title", "Desativar");
									span.removeClass("disabled").addClass("activated");
									$(".reg-id").each(function (i) {
										var idReg = $(".reg-id:eq(" + i + ")");

										if (idReg.text() == id) {
											idReg.siblings(".status").html("Ativado");
										}
									});
								} else {
									elm.removeClass("deactivate").addClass("activate").attr("title", "Ativar");
									span.removeClass("activated").addClass("disabled");
									$(".reg-id").each(function (i) {
										var idReg = $(".reg-id:eq(" + i + ")");

										if (idReg.text() == id) {
											idReg.siblings(".status").html("Desativado");
										}
									});
								}
							}
						});
					});
				}

				/**
				 *
				 * Configurações dos Checkboxes das datatables.
				 */

				var table = this;

				if (table.attr("id") == $(this).attr("id")) {
					var rows = table.fnGetNodes(),
						data = table.fnGetData(),
						checks = [];

					for (var i = 0; i < rows.length; i++) {
						checks.push(data[i][1]);
					}

					table.find(".check-all").on("ifChecked", function (e) {
						for (var i = 0; i < rows.length; i++) {
							var check = $(rows[i]).find(".check");

							$(check).iCheck("check");
							
							if ($.inArray(checks[i], value) < 0) {
								value.push(checks[i]);
							}
						}
					});

					table.find(".check-all").on("ifUnchecked", function (e) {
						for (var i = 0; i < rows.length; i++) {
							var check = $(rows[i]).find(".check");

							$(check).iCheck("uncheck");

							if ($.inArray(checks[i], value) >= 0) {
								var index = value.indexOf(checks[i]);

								if (index > -1) {
									value.splice(index, 1);
								}
							}
						}
					});

					for (var i = 0; i < rows.length; i++) {
						var check = $(rows[i]).find(".check"),
							count = 0;

						check.on("ifChecked", {i: i, count: count, table: table}, function (e) {
							if ($.inArray(data[e.data.i][1], value) < 0) {
								value.push(data[e.data.i][1]);
								count += 1;
							}

							if (count == rows.length) {
								e.data.table.find(".check-all").prop("checked", "checked").iCheck("update");
							}
						});

						check.on("ifUnchecked", {i: i, count: count, table: table}, function (e) {
							count -= 1;

							var index = value.indexOf(data[e.data.i][1]);

							if (index > -1) {
								value.splice(index, 1);
							}

							e.data.table.find(".check-all").removeProp("checked").iCheck("update");
						});
					}
				}

				/**
				 *
				 * Atrelando evento click à todas as linhas da Datatable que possuem a classe '.reg-row'
				 *
				 * Funcionalidade:
				 * - Abrir página de edição do registro.
				 */
				$(".reg-row").off("click");
				$(".reg-row").on("click", function (e) {
					var url = $(this).attr("data-edit");

					location.href = url;
				});

				/**
				 *
				 * Atrelando evento click à todas as TD's da Datatable que possuem a classe '.action-panel'
				 *
				 * Funcionalidade:
				 * - Parar propragação do evento click ao clicar na TD, evitando a abertura da tela de edição do registro.
				 */
				$(".action-panel").off("click");
				$(".action-panel").on("click", function (e) {
					e.stopPropagation();
				});
			}
		});
	});
}

/**
 *
 * Configurações das DataTables Jquery
 */
if ($("#leaders-list").length) {
	datatable(1);
}

if ($("#users-list").length) {
	datatable(1);
}

if ($("#charts-list").length) {
	datatable(0);
}

if ($("#products-list").length) {
	datatable(6);
}

if ($(".analyzes-list").length) {
	datatable(1);
}

if ($(".skills-list").length) {
	datatable(1);
}

if ($("#events-list").length) {
	datatable(1);
}

if ($(".inscriptions-list").length) {
	datatable(1);
}

if ($(".objq-list").length) {
	datatable(1);
}

if ($(".sbjq-list").length) {
	datatable(1);
}

if ($("#staff-list").length) {
	datatable(1);
}

if ($(".templates-list").length) {
	datatable(1);
}

/**
 *
 * Atrelando evento click à todos os botões que possuem a classe '.delete-checked'
 *
 * Funcionalidade:
 * - Deletar todos os registros marcados.
 */

$(".delete-checked").on("click", function (e) {
	e.preventDefault();

	$(".modal-body-title").html("Você deseja, realmente, excluir esses registros?");

	var url = $(this).attr("data-href");

	$(".confirm").on("click", function (e) {
		var form = $("<form action='" + url + "' method='post'></form>");

		var input = $("<input />").attr("type", "hidden").attr("name", "ids").val(value.toString()).appendTo(form);

		form.appendTo("body").submit().remove();
	});

	$(".modal").modal("toggle");
});

$(".remand-checked").on("click", function (e) {
	e.preventDefault();

	$(".modal-body-title").html("Você deseja, realmente, reenviar o email desses registros?");

	var url = $(this).attr("data-href");

	$(".confirm").on("click", function (e) {
		var form = $("<form action='" + url + "' method='post'></form>");

		var input = $("<input />").attr("type", "hidden").attr("name", "ids").val(value.toString()).appendTo(form);

		form.appendTo("body").submit().remove();
	});

	$(".modal").modal("toggle");
});
