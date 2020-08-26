<?php

namespace App\Adm\Controller;

use \Nornas\Controller,
	\Nornas\Common,
    \Nornas\Session;

class Product extends Controller
{
    protected $pdf;

	public function __construct()
	{
		parent::__construct();

		if (!Session::get("logged")) {
            Session::destroy();
            Common::redir("login");
        }

		$this->loadModel("\\App\\Adm\\Model\\Company", "company");
		$this->loadModel("\\App\\Adm\\Model\\Product", "product");
		$this->loadModel("\\App\\Adm\\Model\\Group", "group");
	}

	public function action_new($companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		$data["pageTitle"] = "Novo produto";
		$data["header"]["title"] = SITE_NAME . $data["pageTitle"];
        $data["header"]["menuSide"] = array(
            "header" => array(
                "user-name" => Session::get("user-name"),
                "user-office" => Session::get("user-office")
            ),
            array(
                "dashboard" => ADM_URL
            ),
            array(
                "Empresas" => array(
                    "class-icon" => ICON_COMPANY,
                    "url" => ADM_URL . "empresa",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "empresa/novo",
                        "Listar" => ADM_URL . "empresa/listar"
                    )
                )
            ),
            array(
                "Grupos" => array(
                    "class-icon" => ICON_GROUP,
                    "url" => ADM_URL . "grupo",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "grupo/novo",
                        "Listar" => ADM_URL . "grupo/listar"
                    )
                )
            ),
            array(
                "Usuários" => array(
                    "class-icon" => ICON_USER,
                    "url" => ADM_URL . "usuario",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "usuario/novo",
                        "Listar" => ADM_URL . "usuario/listar"
                    )
                )
            )
        );

		$data["header"]["menuTop"] = array(
			"user-name" => Session::get("user-name")
		);

		$data["header"]["moduleTitle"] = "Produtos";
		
		$data["header"]["breadcrumbs"] = array(
			"Home" => ADM_URL,
			"Produtos" => ADM_URL . "produto/listar/" . $companyId,
			"Novo%active" => null
		);

		$data["action"] = ADM_URL . "produto/cadastrar/" . $companyId;

        $referenceColumns = array(
            "status" => "1"
        );

        $rset = $this->group->getAllWithOrder($referenceColumns, array("*"), true, 'title');

        if ($rset) {
            $data["groups"] = $rset;
        }

		$this->loadView(ADM_VIEW_PATH, "product/new", $data);
	}

	public function action_edit($id, $companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		if (Common::isEmpty($id)) {
			Common::redir("sistemapat/produto/listar/" . $companyId);
		}

		$rset = $this->product->getById($id);

		if ($rset) {
			$data["product"] = $rset;
		}

		$data["pageTitle"] = "Atualizar produto";
		$data["action"] = ADM_URL . "produto/atualizar/" . $id . "/" . $companyId;
		$data["header"]["title"] = SITE_NAME . $data["pageTitle"];

        $data["header"]["menuSide"] = array(
            "header" => array(
                "user-name" => Session::get("user-name"),
                "user-office" => Session::get("user-office")
            ),
            array(
                "dashboard" => ADM_URL
            ),
            array(
                "Empresas" => array(
                    "class-icon" => ICON_COMPANY,
                    "url" => ADM_URL . "empresa",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "empresa/novo",
                        "Listar" => ADM_URL . "empresa/listar"
                    )
                )
            ),
            array(
                "Grupos" => array(
                    "class-icon" => ICON_GROUP,
                    "url" => ADM_URL . "grupo",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "grupo/novo",
                        "Listar" => ADM_URL . "grupo/listar"
                    )
                )
            ),
            array(
                "Usuários" => array(
                    "class-icon" => ICON_USER,
                    "url" => ADM_URL . "usuario",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "usuario/novo",
                        "Listar" => ADM_URL . "usuario/listar"
                    )
                )
            )
        );

		$data["header"]["menuTop"] = array(
			"user-name" => Session::get("user-name")
		);

		$data["header"]["moduleTitle"] = "Produtos";
		
		$data["header"]["breadcrumbs"] = array(
			"Home" => ADM_URL,
            "Produtos" => ADM_URL . "produto/listar/" . $companyId,
			"Editar%active" => null
		);

        $referenceColumns = array(
            "status" => "1"
        );

        $rset = $this->group->get($referenceColumns, array("*"), true);

        if ($rset) {
            $data["groups"] = $rset;
        }

		$this->loadView(ADM_VIEW_PATH, "product/edit", $data);
	}

	public function action_list($companyId, $page = 1)
	{
	    if (Session::get("user-permission")) {
            if (Session::get("user-company") != $companyId) {
                Common::redir("sistemapat/");
            }
        }

        /* var_dump($_POST); */

        // TA TRAZENDO OS DADOS DO INPUT, AGORA TEM QUE SALVAR EM SESSÃO E FILTRAR OS DADOS...

        $referenceColumns = array(
            "companies_id" => $companyId
        );
        
        $rset = $this->product->get($referenceColumns, array("*"), true);
        
        if ($rset) {
			$data["products"] = $rset;
        }

        /* $limit = 10;
        $offset = ($limit * $page) - $limit;

        $rset = $this->product->getByLimit($referenceColumns, "id", $limit, $offset);

		if ($rset) {
			$data["products"] = $rset;
        }

        $total = count($products);
        $pageTotal = ceil($total/$limit);

        $data["page"] = $page;
        $data["pagination"]["pageQuantity"] = ($limit * $page) - ($limit - count($rset));
        $data["pagination"]["totalQuantity"] = $total;
        $data["pagination"]["pageTotal"] = $pageTotal;
        $data["pagination"]["showPages"] = 3;
        $data["pagination"]["previous"] = (($page - 1) == 0 ? 1 : ($page - 1));
        $data["pagination"]["next"] = (($page + 1) >= $total ? $pageTotal : ($page + 1)); */

		$data["pageTitle"] = "Listagem de produtos";
		$data["header"]["title"] = SITE_NAME . $data["pageTitle"];
        $data["header"]["menuSide"] = array(
            "header" => array(
                "user-name" => Session::get("user-name"),
                "user-office" => Session::get("user-office")
            ),
            array(
                "dashboard" => ADM_URL
            )
        );

        if (! Session::get("user-permission")) {
            array_push($data["header"]["menuSide"], array(
                "Empresas" => array(
                    "class-icon" => ICON_COMPANY,
                    "url" => ADM_URL . "empresa",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "empresa/novo",
                        "Listar" => ADM_URL . "empresa/listar"
                    )
                )
            ));

            array_push($data["header"]["menuSide"], array(
                "Grupos" => array(
                    "class-icon" => ICON_GROUP,
                    "url" => ADM_URL . "grupo",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "grupo/novo",
                        "Listar" => ADM_URL . "grupo/listar"
                    )
                )
            ));

            array_push($data["header"]["menuSide"], array(
                "Usuários" => array(
                    "class-icon" => ICON_USER,
                    "url" => ADM_URL . "usuario",
                    "scd-level" => array(
                        "Novo" => ADM_URL . "usuario/novo",
                        "Listar" => ADM_URL . "usuario/listar"
                    )
                )
            ));
        }

		$data["header"]["menuTop"] = array(
			"user-name" => Session::get("user-name")
		);

		$data["header"]["moduleTitle"] = "Produtos";
		
		$data["header"]["breadcrumbs"] = array(
			"Home" => ADM_URL,
            "Produtos" => ADM_URL . "produto/listar/" . $companyId,
			"Listar%active" => null
		);

		$data["companyId"] = $companyId;

		$rset = $this->group->getAll();

		if ($rset) {
            $data["groups"] = $rset;
        }

		$this->loadView(ADM_VIEW_PATH, "product/list", $data);
	}

	public function action_register($companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		try {
			if (Common::isEmpty($_POST)) {
				throw new \Exception("Por favor, preencha todos os campos.");
			}

			Session::set("data", array(
				"group" => $_POST["group"],
				"title" => $_POST["title"],
				"description" => $_POST["description"],
				"tag" => $_POST["tag"],
				"model" => $_POST["model"],
				"situation" => $_POST["situation"],
				"status" => $_POST["status"],
				"price" => $_POST["price"],
				"evaluation" => $_POST["evaluation"],
				"observation" => $_POST["observation"]
			));

			$group = filter_input(INPUT_POST, "group", FILTER_SANITIZE_STRING);

			if (!$group) {
				throw new \Exception("Por favor, selecione uma opção para o campo 'Grupo'.");
			}

			$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);

			if (!$title) {
				throw new \Exception("Por favor, preencha o campo 'Título'.");
			}

			$tag = filter_input(INPUT_POST, "tag", FILTER_SANITIZE_STRING);

			if (!$tag) {
				throw new \Exception("Por favor, preencha o campo 'Etiqueta'.");
            }

			$model = filter_input(INPUT_POST, "model", FILTER_SANITIZE_STRING);

			if (!$model) {
				throw new \Exception("Por favor, preencha o campo 'Modelo'.");
			}

			$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);
			$evaluation = filter_input(INPUT_POST, "evaluation", FILTER_SANITIZE_STRING);

			if ($price != '') {
                $price = str_replace(".", "", $price);
                $price = str_replace(",", ".", $price);
            }

            if ($evaluation != '') {
                $evaluation = str_replace(".", "", $evaluation);
                $evaluation = str_replace(",", ".", $evaluation);
            }

            $img_path = "img_path.png";

            if (!empty($_FILES["img_path"]["name"])) {
                $img_path = Common::upload($_FILES["img_path"], STATIC_PATH . "/images/", true);

                if (is_array($img_path)) {
                    throw new \Exception($img_path["msg"]);
                }

                $path = STATIC_PATH . "/images/" . $img_path;

                \WideImage::load($path)->resize(600, 600)->saveToFile($path);
            }

            $referenceColumns = array(
                "tag" => $tag
            );

            $rset = $this->product->get($referenceColumns, array("*"));

            if ($rset) {
				throw new \Exception("Já existe um produto cadastrado com essa etiqueta.");
            }

			$addedUpColumns = array(
				"companies_id" => $companyId,
				"groups_id" => $group,
				"title" => $title,
				"description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING),
				"tag" => $tag,
				"model" => $model,
				"situation" => filter_input(INPUT_POST, "situation", FILTER_SANITIZE_STRING),
				"status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING),
                "price" => $price,
                "evaluation" => $evaluation,
                "observation" => filter_input(INPUT_POST, "observation", FILTER_SANITIZE_STRING),
				"img_path" => $img_path,
				"created_at" => date("Y-m-d H:i:s"),
				"updated_at" => date("Y-m-d H:i:s")
			);

			$id = $this->product->create($addedUpColumns);

			if (is_numeric($id)) {
				Session::del("data");
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Produto cadastrado com sucesso!"
				));

				Common::redir("sistemapat/produto/listar/" . $companyId);
			} else {
				throw new \Exception("Ocorreu um erro ao tentar inserir o registro, por favor, tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/produto/novo/" . $companyId);
		}
	}

	public function action_update($id, $companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/produto/listar/" . $companyId);
			}

			if (Common::isEmpty($_POST)) {
				throw new \Exception("Por favor, preencha todos os campos obrigatórios.");
			}
			
			Session::set("data", array(
                "group" => $_POST["group"],
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "tag" => $_POST["tag"],
                "model" => $_POST["model"],
                "situation" => $_POST["situation"],
                "status" => $_POST["status"],
                "price" => $_POST["price"],
                "evaluation" => $_POST["evaluation"],
                "observation" => $_POST["observation"]
			));

            $rset = $this->product->getById($id);

            if (!empty($_FILES["img_path"]["name"])) {
                $img_path = Common::upload($_FILES["img_path"], STATIC_PATH . "/images/", true);

                if (is_array($img_path)) {
                    throw new \Exception($img_path["msg"]);
                }

                if (!empty($rset["img_path"])) {
                    $delImgPath = STATIC_PATH . "/images/" . $rset["img_path"];
                }

                if (isset($delImgPath)) {
                    if (file_exists($delImgPath)) {
                        unlink($delImgPath);
                    }
                }

                $path = STATIC_PATH . "/images/" . $img_path;

                \WideImage::load($path)->resize(600, 600)->saveToFile($path);
            }

            $group = filter_input(INPUT_POST, "group", FILTER_SANITIZE_STRING);

            if (!$group) {
                throw new \Exception("Por favor, selecione uma opção para o campo 'Grupo'.");
            }

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);

            if (!$title) {
                throw new \Exception("Por favor, preencha o campo 'Título'.");
            }

            $tag = filter_input(INPUT_POST, "tag", FILTER_SANITIZE_STRING);

            if (!$tag) {
                throw new \Exception("Por favor, preencha o campo 'Etiqueta'.");
            }

            $model = filter_input(INPUT_POST, "model", FILTER_SANITIZE_STRING);

            if (!$model) {
                throw new \Exception("Por favor, preencha o campo 'Modelo'.");
            }

            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);

            $evaluation = filter_input(INPUT_POST, "evaluation", FILTER_SANITIZE_STRING);

            if ($price != '') {
                $price = str_replace(".", "", $price);
                $price = str_replace(",", ".", $price);
            }

            if ($evaluation != '') {
                $evaluation = str_replace(".", "", $evaluation);
                $evaluation = str_replace(",", ".", $evaluation);
            }

			$referenceColumns = array(
				"id" => (int) $id
			);

			$setableColumns = array(
                "groups_id" => $group,
                "title" => $title,
                "description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING),
                "tag" => $tag,
                "model" => $model,
                "situation" => filter_input(INPUT_POST, "situation", FILTER_SANITIZE_STRING),
                "status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING),
                "price" => $price,
                "evaluation" => $evaluation,
                "observation" => filter_input(INPUT_POST, "observation", FILTER_SANITIZE_STRING),
                "updated_at" => date("Y-m-d H:i:s")
			);

			if (isset($img_path)) {
			    $setableColumns["img_path"] = $img_path;
            }

			$rset = $this->product->update($referenceColumns, $setableColumns);

			if ($rset) {
				Session::del("data");
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Produto atualizado com sucesso!"
				));

				Common::redir("sistemapat/produto/listar/" . $companyId);
			} else {
				throw new \Exception("Ocorreu um erro ao tentar editar o registro, por favor, tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/produto/editar/" . $id . "/" . $companyId);
		}
	}

	public function action_delete($id, $companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/produto/listar/" . $companyId);
			}

            $rset = $this->product->getById($id);

            if ($rset) {
                if (!empty($rset["img_path"])) {
                    $delImgPath = STATIC_PATH . "/images/" . $rset["img_path"];
                }

                if (isset($delImgPath)) {
                    if (file_exists($delImgPath)) {
                        unlink($delImgPath);
                    }
                }
            }

			$referenceColumns = array(
				"id" => (int) $id
			);

			$rset = $this->product->delete($referenceColumns);

			if ($rset) {
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Produto excluído com sucesso!"
				));

				Common::redir("sistemapat/produto/listar/" . $companyId);
			} else {
				throw new \Exception("Ocorreu um erro ao tentar excluir o registro, por favor, tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/produto/listar/" . $companyId);
		}
	}

	public function action_deactivate ($id, $companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/produto/listar/" . $companyId);
			}

			$referenceColumns = array(
				"id" => (int) $id
			);

			$setableColumns = array(
				"status" => "0"
			);

			$rset = $this->product->update($referenceColumns, $setableColumns);

			if ($rset) {
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Produto desativado com sucesso!"
				));

				Common::redir("sistemapat/produto/listar/" . $companyId);
			} else {
				throw new \Exception("Ocorreu um erro ao tentar desativar o registro, por favor tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/produto/listar/" . $companyId);
		}
	}

	public function action_activate ($id, $companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/produto/listar/" . $companyId);
			}

			$referenceColumns = array(
				"id" => (int) $id
			);

			$setableColumns = array(
				"status" => "1"
			);

			$rset = $this->product->update($referenceColumns, $setableColumns);

			if ($rset) {
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Produto ativado com sucesso!"
				));

				Common::redir("sistemapat/produto/listar/" . $companyId);
			} else {
				throw new \Exception("Ocorreu um erro ao tentar ativar o registro, por favor tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/produto/listar/" . $companyId);
		}
	}

	public function action_delete_checked ($companyId)
	{
        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		try{
			if (Common::isEmpty($_POST)) {
				Common::redir("sistemapat/produto/listar/" . $companyId);
			}

			set_time_limit(0);

			if (strstr($_POST["ids"], ",")) {
				$ids = explode(",", $_POST["ids"]);
			} else {
				$ids = array($_POST["ids"]);
			}

			foreach ($ids as $id) {
				if (is_numeric($id)) {
                    $rset = $this->product->getById($id);

                    if ($rset) {
                        if (!empty($rset["img_path"])) {
                            $delImgPath = STATIC_PATH . "/images/" . $rset["img_path"];
                        }

                        if (isset($delImgPath)) {
                            if (file_exists($delImgPath)) {
                                unlink($delImgPath);
                            }
                        }
                    }

					$referenceColumns = array(
						"id" => (int) $id
					);

					$rset = $this->product->delete($referenceColumns);

					if (!$rset) {
						throw new \Exception("Ocorreu um erro ao tentar excluir os registro, por favor, tente novamente.");
					}
				}
			}
			
			Session::set("error", array(
				"type" => "alert-success",
				"msg" => "Os registros foram excluídos com sucesso."
			));

			Common::redir("sistemapat/produto/listar/" . $companyId);
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/produto/listar/" . $companyId);
		}
    }

	public function action_generate_pdf($companyId)
    {
        set_time_limit(0);

        $company = $this->company->getById($companyId);

        $referenceColumns = array(
            "companies_id" => $companyId,
            "status" => "1"
        );

        $rset = $this->product->get($referenceColumns, array("*"), true);

        $referenceColumns = array(
            "status" => "1"
        );

        $groups = $this->group->getAllWithOrder($referenceColumns, array("*"), true, 'title');

        $pdf = new \Nornas\PDF($company);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Produtos ativos da empresa "' . $company["name"] . '"');

// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+15, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add a page
        $pdf->AddPage("L", "A4");

		$pdf->SetFont('helvetica', '', 8,5);

        $tbl = <<<EOD
<table border="1" cellpadding="2" cellspacing="2" align="center">
EOD;
        if ($rset) {
            foreach ($groups as $group) {
                foreach ($rset as $product) {
                    if ($group["id"] == $product['groups_id']) {
                        $url = STATIC_URL . "/images/" . $product['img_path'];
                        $situation = ($product['situation']) ? 'Bom' : 'Ruim';
                      
                        $groupTitle = "";
                        $groupTitle = $group["title"];
        $tbl .= <<<EOD
 <tr>
  <td>{$product['tag']}</td>
  <td>{$product['title']}</td>
  <td>{$product['description']}</td>
  <td>{$groupTitle}</td>
  <td>{$product['model']}</td>
  <td>{$situation}</td>
 
  <td><img src="{$url}" width="60"/></td>
 </tr>
EOD;
                }
                }
            }
        }

        $tbl .= <<<EOD
</table>
EOD;

        $pdf->writeHTML($tbl, true, false, false, false, '');
        //$pdf->writeHTMLCell($w=0, $h=0, $x=15, $y=43, $tbl, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// -----------------------------------------------------------------------------

//Close and output PDF document
        $pdf->Output('Relatório de produtos da empresa ' . $company["name"] . '.pdf', 'D');
//============================================================+
// END OF FILE
//============================================================+
    }
}
