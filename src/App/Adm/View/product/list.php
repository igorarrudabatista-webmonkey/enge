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
		            	<a class="btn btn-w-m btn-info" href="<?=ADM_URL?>produto/gerar-pdf/<?=$companyId?>" target="_blank">Gerar PDF</a>
                        <?php if (! $_SESSION["user-permission"]) : ?>
		            	    <a class="btn btn-w-m btn-warning delete-checked" data-href="<?=ADM_URL?>produto/deletar-marcados/<?=$companyId?>" data-value="">Excluir marcados</a>
                            <a href="<?=ADM_URL?>produto/novo/<?=$companyId?>" class="btn btn-w-m btn-primary">Novo</a>
                        <?php endif; ?>
		            </div>
	            </div>
	        	<table id="products-list" class="table table-stripped table-bordered table-hover dataTables-example">
					<thead>
						<tr>
                            <?php if (! $_SESSION["user-permission"]) : ?>
                                <th class="center no-sort">
                                    <div class="checkbox i-checks"><label><input class="check-all" type="checkbox" value="" /></label></div>
                                </th>
                            <?php endif; ?>
							<th class="col-hide">ID</th>
							<th>#</th>
                            <th>Etiqueta</th>
							<th>Título</th>
							<th>Descrição</th>
							<th>Grupo</th>
							<th>Modelo</th>
							<th>Situação</th>
							<th>Preço</th>
							<th>Avaliação</th>
                            <th>Imagem</th>
							<th>Status</th>
                            <?php if (! $_SESSION["user-permission"]) : ?>
							    <th class="center no-sort">Ações</th>
                            <?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php if (isset($products)) : $i = 0; ?>
							<?php foreach ($products as $product) : $i++; ?>
								<tr>
                                    <?php if (! $_SESSION["user-permission"]) : ?>
                                        <td class="center">
                                            <div class="checkbox i-checks"><label><input class="check" type="checkbox" value="" /></label></div>
                                        </td>
                                    <?php endif; ?>
									<td class="reg-id row-hide"><?=$product["id"]?></td>
									<td><?=$i?></td>
                                    <td><?=$product["tag"]?></td>
									<td><?=$product["title"]?></td>
									<td><?=$product["description"]?></td>
                                    <?php foreach ($groups as $group) : ?>
                                        <?php if ($group["id"] == $product["groups_id"]) : ?>
									        <td><?=$group["title"]?></td>
                                        <?php endif; ?>
									<?php endforeach; ?>
									<td><?=$product["model"]?></td>
									<td><?php if ($product["situation"]) { echo "Bom"; } else { echo "Ruim"; }?></td>
									<td><?php if ($product["price"] != '0.00') { echo 'R$ ' . number_format($product["price"], 2); } else { echo ' - '; } ?></td>
									<td><?php if ($product["evaluation"] != '0.00') { echo 'R$ ' . number_format($product["evaluation"], 2); } else { echo ' - '; } ?></td>
                                    <td>
                                        <a class="fancybox" href="<?=STATIC_URL . "images/" . $product["img_path"]?>" title="<?=$product["title"]?>" style="width: 60px;">
                                            <img alt="image" src="<?=STATIC_URL . "images/" . $product["img_path"]?>" width="60" />
                                        </a>
                                    </td>
									<td class="status"><?php if ($product["status"]) { echo "Ativo"; } else { echo "Inativo"; }?></td>
                                    <?php if (! $_SESSION["user-permission"]) : ?>
                                        <td class="center">
                                            <?php if ($product["status"]) : ?>
                                                <a href="#" data-activate="<?=ADM_URL?>produto/ativar/<?=$product["id"]?>/<?=$companyId?>" data-deactivate="<?=ADM_URL?>produto/desativar/<?=$product["id"]?>/<?=$companyId?>" class="actions btn-status deactivate" title="Desativar"><span class="fa fa-circle activated"></span></a>&nbsp;&nbsp;
                                            <?php else : ?>
                                                <a href="#" data-activate="<?=ADM_URL?>produto/ativar/<?=$product["id"]?>/<?=$companyId?>" data-deactivate="<?=ADM_URL?>produto/desativar/<?=$product["id"]?>/<?=$companyId?>" class="actions btn-status activate" title="Ativar"><span class="fa fa-circle disabled"></span></a>&nbsp;&nbsp;
                                            <?php endif; ?>
                                            <a href="<?=ADM_URL?>produto/editar/<?=$product["id"]?>/<?=$companyId?>" class="actions edit" title="Editar"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
                                            <a href="<?=ADM_URL?>produto/deletar/<?=$product["id"]?>/<?=$companyId?>" class="actions delete" title="Excluir"><span class="fa fa-trash-o"></span></a>
                                        </td>
                                    <?php endif; ?>
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
