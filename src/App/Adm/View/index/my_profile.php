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
			            	<div class="form-group">
			            		<label>Nome</label>
		                        <div><input type="text" class="form-control" name="name" value="<?php if (isset($_SESSION["data"]["name"]) && $_SESSION["data"]["name"] !== "") { echo $_SESSION["data"]["name"]; } else { echo $user["name"]; } ?>" /></div>
		                    </div>
		                    <div class="hr-line-dashed"></div>
			            	<div class="form-group">
			            		<label>Email</label>
		                        <div><input type="email" class="form-control" name="email" value="<?php if (isset($_SESSION["data"]["email"]) && $_SESSION["data"]["email"] !== "") { echo $_SESSION["data"]["email"]; } else { echo $user["email"]; } ?>" /></div>
		                    </div>
		                    <div class="hr-line-dashed"></div>
			            	<div class="form-group">
			            		<label>Cargo</label>
		                        <div><input type="text" class="form-control" name="office" value="<?php if (isset($_SESSION["data"]["office"]) && $_SESSION["data"]["office"] !== "") { echo $_SESSION["data"]["office"]; } else { echo $user["office"]; } ?>" /></div>
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