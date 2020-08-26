<?php

$this->loadView(ADM_VIEW_PATH, "index/header", $header);

?>
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5><?=$pageTitle?></h5>
	            <div class="ibox-tools">
	                <a class="collapse-link">
	                    <i class="fa fa-chevron-up"></i>
	                </a>
	            </div>
	        </div>
	        <div class="ibox-content">
	            <?php if (isset($_SESSION["error"])) : ?>
	            	<div class="alert <?=$_SESSION["error"]["type"]?>">
	            		<?=$_SESSION["error"]["msg"]?>
	            	</div>
	            <?php unset($_SESSION["error"]); endif;?>
	            <div class="dpl-tbl">
	            	<div class="pull-right">
		            	<a class="btn btn-w-m btn-warning delete-checked" data-href="<?=ADM_URL?>usuario/deletar-marcados/" data-value="">Excluir marcados</a>
		            	<a href="<?=ADM_URL?>usuario/novo" class="btn btn-w-m btn-primary">Novo</a>
		            </div>
	            </div>
	        	<table id="users-list" class="table table-stripped table-bordered table-hover dataTables-example">
					<thead>
						<tr>
							<th class="center no-sort">
								<div class="checkbox i-checks"><label><input class="check-all" type="checkbox" value="" /></label></div>
							</th>
							<th class="col-hide">ID</th>
							<th>#</th>
							<th>Nome</th>
							<th>Email</th>
							<th>Cargo</th>
							<th>Status</th>
							<th class="center no-sort">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php if (isset($users)) : $i = 0; ?>
							<?php foreach ($users as $user) : $i++; ?>
								<tr class="reg-row" data-edit="<?=ADM_URL?>usuario/editar/<?=$user["id"]?>">
									<td class="center">
										<div class="checkbox i-checks"><label><input class="check" type="checkbox" value="" /></label></div>
									</td>
									<td class="reg-id row-hide"><?=$user["id"]?></td>
									<td><?=$i?></td>
									<td><?=$user["name"]?></td>
									<td><?=$user["email"]?></td>
									<td><?=$user["office"]?></td>
									<td class="status"><?php if ($user["status"]) { echo "Ativado"; } else { echo "Desativado"; }?></td>
									<td class="action-panel center">
										<?php if ($user["status"]) : ?>
											<a href="#" data-activate="<?=ADM_URL?>usuario/ativar/<?=$user["id"]?>" data-deactivate="<?=ADM_URL?>usuario/desativar/<?=$user["id"]?>" class="actions btn-status deactivate" title="Desativar"><span class="fa fa-circle activated"></span></a>&nbsp;&nbsp;
										<?php else : ?>
											<a href="#" data-activate="<?=ADM_URL?>usuario/ativar/<?=$user["id"]?>" data-deactivate="<?=ADM_URL?>usuario/desativar/<?=$user["id"]?>" class="actions btn-status activate" title="Ativar"><span class="fa fa-circle disabled"></span></a>&nbsp;&nbsp;
										<?php endif; ?>
										<a href="<?=ADM_URL?>usuario/deletar/<?=$user["id"]?>" class="actions delete" title="Excluir"><span class="fa fa-trash-o"></span></a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
	        </div>
		</div>
	</div>
</div>
<?php

$this->loadView(ADM_VIEW_PATH, "index/footer");

?>
