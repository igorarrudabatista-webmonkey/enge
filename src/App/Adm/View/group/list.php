<?php

$this->loadView(ADM_VIEW_PATH, "index/header", $header);

?>
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<div>
					<h5><?=$pageTitle?></h5>
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
		            	<a class="btn btn-w-m btn-warning delete-checked" data-href="<?=ADM_URL?>grupo/deletar-marcados/" data-value="">Excluir marcados</a>
		            	<a href="<?=ADM_URL?>grupo/novo" class="btn btn-w-m btn-primary">Novo</a>
		            </div>
		        </div>
                <table class="table table-stripped table-bordered table-hover dataTables-example analyzes-list">
                    <thead>
                    <tr>
                        <th class="center no-sort">
                            <div class="checkbox i-checks"><label><input class="check-all" type="checkbox" value="" /></label></div>
                        </th>
                        <th class="col-hide">ID</th>
                        <th>#</th>
                        <th>Título</th>
                        <th>Status</th>
                        <th class="center no-sort">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($groups)) : $i = 0; ?>
                        <?php foreach ($groups as $group) : $i++; ?>
                            <tr class="reg-row" data-edit="<?=ADM_URL?>grupo/editar/<?=$group["id"]?>">
                                <td class="center">
                                    <div class="checkbox i-checks"><label><input class="check" type="checkbox" value="" /></label></div>
                                </td>
                                <td class="reg-id row-hide"><?=$group["id"]?></td>
                                <td><?=$i?></td>
                                <td><?=$group["title"]?></td>
                                <td class="status"><?php if ($group["status"]) { echo "Ativo"; } else { echo "Inativo"; }?></td>
                                <td class="action-panel center">
                                    <?php if ($group["status"]) : ?>
                                        <a href="#" data-activate="<?=ADM_URL?>grupo/ativar/<?=$group["id"]?>" data-deactivate="<?=ADM_URL?>grupo/desativar/<?=$group["id"]?>" class="actions btn-status deactivate" title="Desativar"><span class="fa fa-circle activated"></span></a>&nbsp;&nbsp;
                                    <?php else : ?>
                                        <a href="#" data-activate="<?=ADM_URL?>grupo/ativar/<?=$group["id"]?>" data-deactivate="<?=ADM_URL?>grupo/desativar/<?=$group["id"]?>" class="actions btn-status activate" title="Ativar"><span class="fa fa-circle disabled"></span></a>&nbsp;&nbsp;
                                    <?php endif; ?>
                                    <a href="<?=ADM_URL?>grupo/deletar/<?=$group["id"]?>" class="actions delete" title="Excluir"><span class="fa fa-trash-o"></span></a>
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