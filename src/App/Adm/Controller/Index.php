<?php

namespace App\Adm\Controller;

use \Nornas\Controller,
	\Nornas\Common,
	\Nornas\Session;

class Index extends Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!Session::get("logged")) {
            Session::destroy();
            Common::redir("login");
        }

		$this->loadModel("\\App\\Adm\\Model\\User", "user");
		$this->loadModel("\\App\\Adm\\Model\\Company", "company");
	}

	public function action_main()
	{
		$data["pageTitle"] = "Dashboard";
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

		$data["header"]["moduleTitle"] = "Dashboard";

		$referenceColumns = array(
		    "status" => "1"
        );

		$rset = $this->company->get($referenceColumns, array("*"), true);

		if ($rset) {
		    $data["companies"] = $rset;
        }

        $data["userCompany"] = Session::get("user-company");
        $data["userPermission"] = Session::get("user-permission");

		$this->loadView(ADM_VIEW_PATH, "index/dashboard", $data);
	}

	public function action_my_profile()
	{
		try {
			if (!Common::isEmpty($_POST)) {
				Session::set("data", array(
					"name"	=> $_POST["name"],
					"email"	=> $_POST["email"],
					"office" => $_POST["office"]
				));

				$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

				if (!$name) {
					throw new \Exception("Por favor, preencha o campo 'Nome'.");
				}

				$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

				if (!$email) {
					throw new \Exception("Por favor, preencha o campo 'Email'.");
				}

				$office = filter_input(INPUT_POST, "office", FILTER_SANITIZE_STRING);

				if (!$office) {
					throw new \Exception("Por favor, preencha o campo 'Cargo'.");
				}

				$rset = $this->user->getById(Session::get("user-id"));

				$referenceColumns = array(
					"id" => Session::get("user-id")
				);

				$setableColumns = array(
					"name" => $name,
					"email" => $email,
					"office" => $office,
				);

				$rset = $this->user->update($referenceColumns, $setableColumns);

				if ($rset) {
					Session::set("user-name", $name);
					Session::set("user-email", $email);
					Session::set("user-office", $office);

					Session::del("data");
					Session::set("error", array(
						"type" => "alert-success",
						"msg" => "Perfil atualizado com sucesso!"
					));

					Common::redir("sistemapat/");
				} else {
					throw new \Exception("Ocorreu um erro ao tentar atualizar o registro, por favor, tente novamente.");
				}
			}

			$data["pageTitle"] = "Meu perfil";
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

			$data["header"]["moduleTitle"] = "Perfil";
			
			$data["header"]["breadcrumbs"] = array(
				"Home" => ADM_URL,
				"Dashboard" => ADM_URL . "painel",
				"Meu perfil%active" => null
			);

			$data["action"] = ADM_URL . "meu-perfil";

			$rset = $this->user->getById(Session::get("user-id"));

			if ($rset) {
				$data["user"] = $rset;
			}

			$this->loadView(ADM_VIEW_PATH, "index/my_profile", $data);
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/meu-perfil");
		}
	}

	public function action_change_password ()
	{
		try {
			if (!Common::isEmpty($_POST)) {
				$oldPassword = $_POST["senha_antiga"];
				$newPassword = $_POST["senha_nova"];

				$referenceColumns = array(
					"id" => Session::get("user-id")
				);

				$rset = $this->user->getById($referenceColumns);

				if (!password_verify($oldPassword, $rset["password"])) {
					throw new \Exception("A senha antiga não confere.");
				}

				$newPassword = password_hash($_POST["senha_nova"], PASSWORD_DEFAULT);

				$setableColumns = array(
					"password" => $newPassword
				);

				$rset = $this->user->update($referenceColumns, $setableColumns);

				if ($rset) {
					Session::set("error", array(
						"type" => "alert-success",
						"msg" => "Senha alterada com sucesso! Utilize a nova senha a partir do próximo acesso!"
					));

					Common::redir("sistemapat/painel");
				} else {
					throw new \Exception("Ocorreu um erro ao tentar alterar o registro, por favor, tente novamente.");
				}
			}

			$data["pageTitle"] = "Alterar senha";
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

			$data["header"]["moduleTitle"] = "Perfil";
			
			$data["header"]["breadcrumbs"] = array(
				"Home" => ADM_URL,
				"Dashboard" => ADM_URL,
				"Alterar senha%active" => null
			);

			$data["action"] = ADM_URL . "alterar-senha";

			$this->loadView(ADM_VIEW_PATH, "index/change_password", $data);
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("sistemapat/alterar-senha");
		}
	}
}