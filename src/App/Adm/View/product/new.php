<?php
	
$this->loadView(ADM_VIEW_PATH, "index/header", $header);

?>
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?=$pageTitle?></h5>
            </div>
            <div class="ibox-content">
	        	<?php if (isset($_SESSION["error"])) : ?>
	            	<div class="alert <?=$_SESSION["error"]["type"]?>">
	            		<?=$_SESSION["error"]["msg"]?>
	            	</div>
	            <?php unset($_SESSION["error"]); endif;?>
            	<div class="row">
            		<div class="col-sm-12">
            			<form class="form" action="<?=$action?>" method="post" enctype="multipart/form-data" role="form">
                            <div class="form-group">
                                <label>Imagem do produto</label>
                                <div><input type="file" class="form-control" name="img_path" /></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Grupo</label>
                                        <div>
                                            <select class="form-control form-control m-b" name="group">
                                                <option value="">Selecione o grupo...</option>
                                                <?php if (isset($groups)) : ?>
                                                    <?php foreach ($groups as $group) : ?>
                                                        <option value="<?=$group["id"]?>" <?php if (isset($_SESSION["data"]["group"]) && $_SESSION["data"]["group"] === $group["id"]) { echo "selected"; } ?>><?=$group["title"]?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label>Título</label>
                                        <div><input type="text" class="form-control" name="title" value="<?php if (isset($_SESSION["data"]["title"])) { echo $_SESSION["data"]["title"]; } ?>" /></div>
                                    </div>
                                </div>
                            </div>
		                    <div class="hr-line-dashed"></div>
			            	<div class="form-group">
			            		<label>Descrição</label>
		                        <div><textarea rows="10" class="form-control" name="description"><?php if (isset($_SESSION["data"]["description"])) { echo $_SESSION["data"]["description"]; } ?></textarea></div>
		                    </div>
		                    <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Etiqueta</label>
                                        <div><input type="text" class="form-control" name="tag" value="<?php if (isset($_SESSION["data"]["tag"])) { echo $_SESSION["data"]["tag"]; } ?>" /></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Modelo</label>
                                        <div><input type="text" class="form-control" name="model" value="<?php if (isset($_SESSION["data"]["model"])) { echo $_SESSION["data"]["model"]; } ?>" /></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Situação</label>
                                        <select class="form-control form-control m-b" name="situation">
                                            <option value="1" <?php if (isset($_SESSION["data"]["situation"]) && $_SESSION["data"]["situation"] == "1") { echo "selected"; } ?>>Bom</option>
                                            <option value="0" <?php if (isset($_SESSION["data"]["situation"]) && $_SESSION["data"]["situation"] == "0") { echo "selected"; } ?>>Ruim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
		                    <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Preço</label>
                                        <div><input type="text" class="form-control" name="price" value="<?php if (isset($_SESSION["data"]["price"])) { echo $_SESSION["data"]["price"]; } ?>" /></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Avaliação</label>
                                        <div><input type="text" class="form-control" name="evaluation" value="<?php if (isset($_SESSION["data"]["evaluation"])) { echo $_SESSION["data"]["evaluation"]; } ?>" /></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control form-control m-b" name="status">
                                            <option value="1" <?php if (isset($_SESSION["data"]["status"]) && $_SESSION["data"]["status"] == "1") { echo "selected"; } ?>>Ativo</option>
                                            <option value="0" <?php if (isset($_SESSION["data"]["status"]) && $_SESSION["data"]["status"] == "0") { echo "selected"; } ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
		                    <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>Observação</label>
                                <div><textarea rows="10" class="form-control" name="observation"><?php if (isset($_SESSION["data"]["observation"])) { echo $_SESSION["data"]["observation"]; } ?></textarea></div>
                            </div>
		                    <div class="hr-line-dashed"></div>
		                    <div class="pull-right">
                                <button class="btn btn-w-m btn-primary" type="submit"><strong>Salvar</strong></button>
                            </div>
		            	</form>
            		</div>
            	</div>
            </div>
        </div>
	</div>
</div>
<?php

$this->loadView(ADM_VIEW_PATH, "index/footer");

?>