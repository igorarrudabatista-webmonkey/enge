<?php

$this->loadView(ADM_VIEW_PATH, "index/header", $header);

?>
<div class="row">
	<div class="col-lg-12">
        <?php if (isset($_SESSION["error"])) : ?>
            <div class="alert <?=$_SESSION["error"]["type"]?>">
                <?=$_SESSION["error"]["msg"]?>
            </div>
        <?php unset($_SESSION["error"]); endif;?>
	</div>
</div>
<div class="row">
    <?php if (isset($companies)) : ?>
        <?php foreach ($companies as $company) : ?>
            <?php if ($userPermission) : ?>
                <?php if ($company["id"] == $userCompany) : ?>
                    <div class="col-lg-2">
                        <div class="widget p-lg text-center dashboard-itens btn-info btn-outline" data-url="<?=ADM_URL?>produto/listar/<?=$company["id"]?>">
                            <div class="m-b-md">
                                <i class="fa <?=ICON_COMPANY?> fa-4x"></i>
                                <h4 class="text-center"><?=$company["name"]?></h4>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="col-lg-2">
                    <div class="widget p-lg text-center dashboard-itens btn-info btn-outline" data-url="<?=ADM_URL?>produto/listar/<?=$company["id"]?>">
                        <div class="m-b-md">
                            <i class="fa <?=ICON_COMPANY?> fa-4x"></i>
                            <h4 class="text-center"><?=$company["name"]?></h4>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="col-sm-12">
            <div class="alert alert-info">
                Não há empresas cadastradas.
            </div>
        </div>
    <?php endif; ?>
</div>
<?php if (! $userPermission) : ?>
    <div class="row">
        <div class="col-lg-2">
            <div class="widget p-lg text-center dashboard-itens btn-info btn-outline" data-url="<?=ADM_URL?>usuario">
                <div class="m-b-md">
                    <i class="fa <?=ICON_USER?> fa-4x"></i>
                    <h4 class="text-center">Usuários</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="widget p-lg text-center dashboard-itens btn-info btn-outline" data-url="<?=ADM_URL?>usuario">
                <div class="m-b-md">
                    <i class="fa <?=ICON_GROUP?> fa-4x"></i>
                    <h4 class="text-center">Grupos</h4>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php

$this->loadView(ADM_VIEW_PATH, "index/footer");

?>
