<?php

namespace App\Adm\Controller;

use \Nornas\Controller,
	\Nornas\Common,
	\Nornas\Session;

class User extends Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!Session::get("logged")) {
            Session::destroy();
            Common::redir("login");
        }

        if (Session::get("user-permission")) {
            Common::redir("sistemapat/");
        }

		$this->loadModel("\\App\\Adm\\Model\\User", "user");
		$this->loadModel("\\App\\Adm\\Model\\Company", "company");
	}

	public function action_main()
	{
		Common::redir("sistemapat/usuario/listar");
	}

	public function action_new()
	{
		$data["pageTitle"] = "Novo Usuário";
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
                    "scd-level%in" => array(
                        "Novo%active" => ADM_URL . "usuario/novo",
                        "Listar" => ADM_URL . "usuario/listar"
                    )
                )
            )
        );

		$data["header"]["menuTop"] = array(
			"user-name" => Session::get("user-name")
		);

		$data["header"]["moduleTitle"] = "Usuários";
		
		$data["header"]["breadcrumbs"] = array(
			"Home" => ADM_URL,
			"Usuários" => ADM_URL . "usuario",
			"Novo%active" => null
		);

		$data["action"] = ADM_URL . "usuario/cadastrar";

		$referenceColumns = array(
		    'status' => '1'
        );

		$rset = $this->company->get($referenceColumns, array('*'), true);

		if ($rset) {
		    $data["companies"] = $rset;
        }

		$this->loadView(ADM_VIEW_PATH, "user/new", $data);
	}

	public function action_edit($id)
	{
		if (Common::isEmpty($id)) {
			Common::redir("sistemapat/usuario/listar");
		}

		$rset = $this->user->getById($id);

		if ($rset) {
			$data["user"] = $rset;
		}

		$data["pageTitle"] = "Atualizar usuário";
		$data["action"] = ADM_URL . "usuario/atualizar/" . $id;
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
                    "scd-level%in" => array(
                        "Novo" => ADM_URL . "usuario/novo",
                        "Listar" => ADM_URL . "usuario/listar"
                    )
                )
            )
        );

		$data["header"]["menuTop"] = array(
			"user-name" => Session::get("user-name")
		);

		$data["header"]["moduleTitle"] = "Usuários";

		$data["header"]["breadcrumbs"] = array(
			"Home" => ADM_URL,
			"Usuários" => ADM_URL . "usuario",
			"Editar%active" => null
		);

        $referenceColumns = array(
            'status' => '1'
        );

        $rset = $this->company->get($referenceColumns, array('*'), true);

        if ($rset) {
            $data["companies"] = $rset;
        }

		$this->loadView(ADM_VIEW_PATH, "user/edit", $data);
	}

	public function action_list()
	{
		$rset = $this->user->getAll();

		if ($rset) {
			$data["users"] = $rset;
		}

		$data["pageTitle"] = "Listagem de usuários";
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
                    "scd-level%in" => array(
                        "Novo" => ADM_URL . "usuario/novo",
                        "Listar%active" => ADM_URL . "usuario/listar"
                    )
                )
            )
        );

		$data["header"]["menuTop"] = array(
			"user-name" => Session::get("user-name")
		);

		$data["header"]["moduleTitle"] = "Usuários";

		$data["header"]["breadcrumbs"] = array(
			"Home" => ADM_URL,
			"Usuários" => ADM_URL . "usuario",
			"Listar%active" => null
		);

		$this->loadView(ADM_VIEW_PATH, "user/list", $data);
	}

	public function action_register()
	{
		try {
			if (Common::isEmpty($_POST)) {
				throw new \Exception("Por favor, preencha todos os campos.");
			}
			
			Session::set("data", array(
				"company" => $_POST["company"],
				"name" => $_POST["name"],
				"email" => $_POST["email"],
				"office" => $_POST["office"],
				"just_view" => $_POST["just_view"],
				"status" => $_POST["status"]
			));

			$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

			if (!$name) {
				throw new \Exception("Por favor, preencha o campo 'Nome'.");
			}

			$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

			if (!$email) {
				throw new \Exception("Por favor, preencha o campo 'E-mail'.");
			}

			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

			if (!$password) {
				throw new \Exception("Por favor, preencha o campo 'Senha'.");
			}

			$office = filter_input(INPUT_POST, "office", FILTER_SANITIZE_STRING);

			if (!$office) {
				throw new \Exception("Por favor, preencha o campo 'Cargo'.");
			}

			$addedUpColumns = array(
				"companies_id" => filter_input(INPUT_POST, "company", FILTER_SANITIZE_STRING),
				"name" => $name,
				"email" => $email,
				"password" => $password,
				"office" => $office,
				"just_view" => filter_input(INPUT_POST, "just_view", FILTER_SANITIZE_STRING),
				"status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING),
				"created_at" => date("Y-m-d H:i:s"),
				"updated_at" => date("Y-m-d H:i:s")
			);

			$id = $this->user->create($addedUpColumns);

			if (is_numeric($id)) {
				Session::del("data");
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Usuário cadastrado com sucesso!"
				));

				Common::redir("sistemapat/usuario/listar");
			} else {
				throw new \Exception("Ocorreu um erro ao tentar inserir o registro, por favor, tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/usuario/novo");
		}
	}

	public function action_update($id)
	{
		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/usuario/listar");
			}

			if (Common::isEmpty($_POST)) {
				throw new \Exception("Por favor, preencha todos os campos obrigatórios.");
			}
			
			Session::set("data", array(
				"company" => $_POST["company"],
				"name" => $_POST["name"],
				"email" => $_POST["email"],
				"office" => $_POST["office"],
				"just_view" => $_POST["just_view"],
				"status" => $_POST["status"]
			));

			$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

			if (!$name) {
				throw new \Exception("Por favor, preencha o campo 'Nome'.");
			}

			$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

			if (!$email) {
				throw new \Exception("Por favor, preencha o campo 'E-mail'.");
			}

			$office = filter_input(INPUT_POST, "office", FILTER_SANITIZE_STRING);

			if (!$office) {
				throw new \Exception("Por favor, preencha o campo 'Cargo'.");
			}

			$referenceColumns = array(
				"id" => (int) $id
			);

			$setableColumns = array(
				"companies_id" => filter_input(INPUT_POST, "company", FILTER_SANITIZE_STRING),
				"name" => $name,
				"email" => $email,
				"office" => $office,
				"just_view" => filter_input(INPUT_POST, "just_view", FILTER_SANITIZE_STRING),
				"status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING)
			);

			$rset = $this->user->update($referenceColumns, $setableColumns);

			if ($rset) {
				Session::del("data");
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Usuário atualizado com sucesso!"
				));

				Common::redir("sistemapat/usuario/listar");
			} else {
				throw new \Exception("Ocorreu um erro ao tentar editar o registro, por favor, tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/usuario/editar/" . $id);
		}
	}

	public function action_delete($id)
	{
		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/usuario/listar");
			}

			$referenceColumns = array(
				"id" => (int) $id
			);

			$rset = $this->user->delete($referenceColumns);

			if ($rset) {
				Session::set("error", array(
					"type" => "alert-success",
					"msg" => "Usuário excluído com sucesso!"
				));

				Common::redir("sistemapat/usuario/listar");
			} else {
				throw new \Exception("Ocorreu um erro ao tentar excluir o registro, por favor, tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/usuario/listar");
		}
	}

	public function action_deactivate ($id)
	{
		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/usuario/listar");
			}

			$referenceColumns = array(
				"id" => (int) $id
			);

			$setableColumns = array(
				"status" => "0"
			);

			$rset = $this->user->update($referenceColumns, $setableColumns);

			if ($rset) {
				$return = array(
					"type" => "alert-success",
					"msg" => "Usuário desativado com sucesso!"
				);

				$return = json_encode($return, JSON_UNESCAPED_UNICODE);

				echo $return;
			} else {
				throw new \Exception("Ocorreu um erro ao tentar desativar o registro, por favor tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/usuario/listar");
		}
	}

	public function action_activate ($id)
	{
		try {
			if (Common::isEmpty($id)) {
				Common::redir("sistemapat/usuario/listar");
			}

			$referenceColumns = array(
				"id" => (int) $id
			);

			$setableColumns = array(
				"status" => "1"
			);

			$rset = $this->user->update($referenceColumns, $setableColumns);

			if ($rset) {
				$return = array(
					"type" => "alert-success",
					"msg" => "Usuário ativado com sucesso!"
				);

				$return = json_encode($return, JSON_UNESCAPED_UNICODE);

				echo $return;
			} else {
				throw new \Exception("Ocorreu um erro ao tentar ativar o registro, por favor tente novamente.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));
		}
	}

	public function action_delete_checked ()
	{
		try{
			if (Common::isEmpty($_POST)) {
				Common::redir("sistemapat/usuario/listar");
			}

			set_time_limit(0);
			
			if (strstr($_POST["ids"], ",")) {
				$ids = explode(",", $_POST["ids"]);
			} else {
				$ids = array($_POST["ids"]);
			}

			foreach ($ids as $id) {
				if (is_numeric($id)) {
					$referenceColumns = array(
						"id" => (int) $id
					);

					$rset = $this->user->delete($referenceColumns);

					if (!$rset) {
						throw new \Exception("Ocorreu um erro ao tentar excluir os registro, por favor, tente novamente.");
					}
				}
			}

			Session::set("error", array(
				"type" => "alert-success",
				"msg" => "Os registros foram excluídos com sucesso."
			));
			
			Common::redir("sistemapat/usuario/listar");
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/usuario/listar");
		}
	}
}
