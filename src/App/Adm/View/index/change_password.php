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
            			<form class="form" action="<?=$action?>" method="post" role="form">
			            	<div class="form-group">
			            		<label>Senha Antiga</label>
		                        <div><input type="password" class="form-control" name="senha_antiga" value="" /></div>
		                    </div>
		                    <div class="hr-line-dashed"></div>
			            	<div class="form-group">
			            		<label>Senha Nova</label>
		                        <div><input type="password" class="form-control" name="senha_nova" value="" /></div>
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