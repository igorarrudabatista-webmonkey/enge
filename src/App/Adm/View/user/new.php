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
            			<form enctype="multipart/form-data" class="form" action="<?=$action?>" method="post" role="form">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <div>
                                            <select class="form-control form-control m-b" name="company">
                                                <option value="">Selecione a empresa...</option>
                                                <?php if (isset($companies)) : ?>
                                                    <?php foreach ($companies as $company) : ?>
                                                        <option value="<?=$company["id"]?>" <?php if (isset($_SESSION["data"]["company"]) && $_SESSION["data"]["company"] === $company["id"]) { echo "selected"; } ?>><?=$company["name"]?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <div><input type="text" class="form-control" name="name" value="<?php if (isset($_SESSION["data"]["name"])) { echo $_SESSION["data"]["name"]; } ?>" /></div>
                                    </div>
                                </div>
                            </div>
		                    <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div><input type="email" class="form-control" name="email" value="<?php if (isset($_SESSION["data"]["email"])) { echo $_SESSION["data"]["email"]; } ?>" /></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <div><input type="password" class="form-control" name="password" value="" /></div>
                                    </div>
                                </div>
                            </div>
		                    <div class="hr-line-dashed"></div>
			            	<div class="form-group">
			            		<label>Cargo</label>
		                        <div><input type="text" class="form-control" name="office" value="<?php if (isset($_SESSION["data"]["office"])) { echo $_SESSION["data"]["office"]; } ?>" /></div>
		                    </div>
		                    <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Apenas visualiza?</label>
                                        <select class="form-control form-control m-b" name="just_view">
                                            <option value="0" <?php if (isset($_SESSION["data"]["just_view"]) && $_SESSION["data"]["just_view"] == "0") { echo "selected"; } ?>>Não</option>
                                            <option value="1" <?php if (isset($_SESSION["data"]["just_view"]) && $_SESSION["data"]["just_view"] == "1") { echo "selected"; } ?>>Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control form-control m-b" name="status">
                                            <option value="1" <?php if (isset($_SESSION["data"]["status"]) && $_SESSION["data"]["status"] == "1") { echo "selected"; } ?>>Ativado</option>
                                            <option value="0" <?php if (isset($_SESSION["data"]["status"]) && $_SESSION["data"]["status"] == "0") { echo "selected"; } ?>>Desativado</option>
                                        </select>
                                    </div>
                                </div>
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