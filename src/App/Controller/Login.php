<?php

namespace App\Controller;

use \Nornas\Controller,
	\Nornas\Common,
	\Nornas\Session;

class Login extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->loadModel("App\\Model\\User", "user");
	}

	public function action_main()
	{
		$data["pageTitle"] = "Login";
		$data["action"] = SITE_URL . "login/processa";
		$data["header"]["title"] = SITE_NAME . $data["pageTitle"];

		$this->loadView(VIEW_PATH, "login/index", $data);
	}

	public function action_proccess()
	{
		try {
			if (Common::isEmpty($_POST)) {
				throw new \Exception("Por favor, preencha todos os campos.");
			}

			Session::set("data", array(
				"email" => $_POST["email"]
			));

			$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

			if (!$email) {
				throw new \Exception("Por favor, preencha o campo 'Email'.");
			}

			$password = $_POST["password"];

			if (!$password) {
				throw new \Exception("Por favor, preencha o campo 'Senha'.");
			}

			$referenceColumns = array(
				"email" => $email
			);

			$rset = $this->user->get($referenceColumns);

			if ($rset) {
				if (!$rset["status"]) {
					throw new \Exception("Usuário desativado, por favor, contate o administrador para ativação do registro.");
				}
				
				$password = password_verify($password, $rset["password"]);

				if ($password) {
					Session::set("user-id", $rset["id"]);
					Session::set("user-name", $rset["name"]);
					Session::set("user-email", $rset["email"]);
					Session::set("user-office", $rset["office"]);
					Session::set("user-permission", $rset["just_view"]);

                    if (! Common::isEmpty($rset["companies_id"])) {
                        Session::set("user-company", $rset["companies_id"]);
                    }

                    Session::set("logged", true);
					Session::del("data");
					Session::del("error");

					$referenceColumns = array(
						"id" => $rset["id"]
					);

					$setableColumns = array(
						"last_login" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s")
					);

					$this->user->update($referenceColumns, $setableColumns);

					Common::redir("sistemapat/");
				} else {
					throw new \Exception("Senha incorreta.");
				}
			} else {
				throw new \Exception("Usuário não encontrado.");
			}
		} catch (\Exception $e) {
			Session::set("error", array(
				"type" => "alert-warning",
				"msg" => $e->getMessage()
			));

			Common::redir("login");
		}
	}

	public function action_logout()
	{
		Session::del("logged");

		Common::redir("login");
	}
}