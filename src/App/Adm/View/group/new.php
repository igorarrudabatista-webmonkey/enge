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
			            		<label>Título</label>
		                        <div><input type="text" class="form-control" name="title" value="<?php if (isset($_SESSION["data"]["title"])) { echo $_SESSION["data"]["title"]; } ?>" /></div>
		                    </div>
		                    <div class="hr-line-dashed"></div>
			            	<div class="form-group">
			            		<label>Descrição</label>
		                        <div><textarea rows="10" class="form-control" name="description"><?php if (isset($_SESSION["data"]["description"])) { echo $_SESSION["data"]["description"]; } ?></textarea></div>
		                    </div>
		                    <div class="hr-line-dashed"></div>
			            	<div class="form-group">
			            		<label>Status</label>
			            		<select class="form-control form-control m-b" name="status">
	                        		<option value="1" <?php if (isset($_SESSION["data"]["status"]) && $_SESSION["data"]["status"] == "1") { echo "selected"; } ?>>Ativo</option>
	                        		<option value="0" <?php if (isset($_SESSION["data"]["status"]) && $_SESSION["data"]["status"] == "0") { echo "selected"; } ?>>Inativo</option>
	                        	</select>
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