<?php

namespace App\Adm\Controller;

use \Nornas\Controller,
    \Nornas\Common,
    \Nornas\Session;

class Company extends Controller
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

        $this->loadModel("\\App\\Adm\\Model\\Company", "company");
        $this->loadModel("\\App\\Adm\\Model\\Product", "product");
    }

    public function action_main()
    {
        Common::redir("sistemapat/empresa/listar");
    }

    public function action_new()
    {
        $data["pageTitle"] = "Nova empresa";
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
                    "scd-level%in" => array(
                        "Novo%active" => ADM_URL . "empresa/novo",
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

        $data["header"]["moduleTitle"] = "Empresas";

        $data["header"]["breadcrumbs"] = array(
            "Home" => ADM_URL,
            "Empresas" => ADM_URL . "empresa",
            "Novo%active" => null
        );

        $data["action"] = ADM_URL . "empresa/cadastrar";

        $this->loadView(ADM_VIEW_PATH, "company/new", $data);
    }

    public function action_edit($id)
    {
        if (Common::isEmpty($id)) {
            Common::redir("sistemapat/empresa/listar");
        }

        $rset = $this->company->getById($id);

        if ($rset) {
            $data["company"] = $rset;
        }

        $data["pageTitle"] = "Atualizar empresa";
        $data["action"] = ADM_URL . "empresa/atualizar/" . $id;
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
                    "scd-level%in" => array(
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

        $data["header"]["moduleTitle"] = "Empresas";

        $data["header"]["breadcrumbs"] = array(
            "Home" => ADM_URL,
            "Empresas" => ADM_URL . "empresa",
            "Editar%active" => null
        );

        $referenceColumns = array(
            "companies_id" => $id
        );

        $rset = $this->product->get($referenceColumns, array("*"), true);

        if ($rset) {
            $data["products"] = $rset;
        }

        $this->loadView(ADM_VIEW_PATH, "company/edit", $data);
    }

    public function action_list()
    {
        $rset = $this->company->getAll();

        if ($rset) {
            $data["companies"] = $rset;
        }

        $data["pageTitle"] = "Listagem de empresas";
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
                    "scd-level%in" => array(
                        "Novo" => ADM_URL . "empresa/novo",
                        "Listar%active" => ADM_URL . "empresa/listar"
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

        $data["header"]["moduleTitle"] = "Empresas";

        $data["header"]["breadcrumbs"] = array(
            "Home" => ADM_URL,
            "Empresas" => ADM_URL . "empresa",
            "Listar%active" => null
        );

        $this->loadView(ADM_VIEW_PATH, "company/list", $data);
    }

    public function action_register()
    {
        try {
            if (Common::isEmpty($_POST)) {
                throw new \Exception("Por favor, preencha todos os campos.");
            }

            Session::set("data", array(
                "name" => $_POST["name"],
                "description" => $_POST["description"],
                "status" => $_POST["status"]
            ));

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

            if (!$name) {
                throw new \Exception("Por favor, preencha o campo 'Nome'.");
            }

            $addedUpColumns = array(
                "name" => $name,
                "description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING),
                "status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING),
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            );

            $id = $this->company->create($addedUpColumns);

            if (is_numeric($id)) {
                Session::del("data");
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Empresa cadastrada com sucesso!"
                ));

                Common::redir("sistemapat/empresa/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar inserir o registro, por favor, tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/empresa/novo");
        }
    }

    public function action_update($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/empresa/listar");
            }

            if (Common::isEmpty($_POST)) {
                throw new \Exception("Por favor, preencha todos os campos obrigatórios.");
            }

            Session::set("data", array(
                "name" => $_POST["name"],
                "description" => $_POST["description"],
                "status" => $_POST["status"]
            ));

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

            if (!$name) {
                throw new \Exception("Por favor, preencha o campo 'Nome'.");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $setableColumns = array(
                "name" => $name,
                "description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING),
                "status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING),
                "updated_at" => date("Y-m-d H:i:s")
            );

            $rset = $this->company->update($referenceColumns, $setableColumns);

            if ($rset) {
                Session::del("data");
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Empresa atualizada com sucesso!"
                ));

                Common::redir("sistemapat/empresa/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar editar o registro, por favor, tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/empresa/editar/" . $id);
        }
    }

    public function action_delete($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/empresa/listar");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $rset = $this->company->delete($referenceColumns);

            if ($rset) {
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Empresa excluída com sucesso!"
                ));

                Common::redir("sistemapat/empresa/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar excluir o registro, por favor, tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/empresa/listar");
        }
    }

    public function action_deactivate ($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/empresa/listar");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $setableColumns = array(
                "status" => "0"
            );

            $rset = $this->company->update($referenceColumns, $setableColumns);

            if ($rset) {
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Empresa desativada com sucesso!"
                ));

                Common::redir("sistemapat/empresa/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar desativar o registro, por favor tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/empresa/listar");
        }
    }

    public function action_activate ($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/empresa/listar");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $setableColumns = array(
                "status" => "1"
            );

            $rset = $this->company->update($referenceColumns, $setableColumns);

            if ($rset) {
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Empresa ativada com sucesso!"
                ));

                Common::redir("sistemapat/empresa/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar ativar o registro, por favor tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/empresa/listar");
        }
    }

    public function action_delete_checked ()
    {
        try{
            if (Common::isEmpty($_POST)) {
                Common::redir("sistemapat/empresa/listar");
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

                    $rset = $this->company->delete($referenceColumns);

                    if (!$rset) {
                        throw new \Exception("Ocorreu um erro ao tentar excluir os registro, por favor, tente novamente.");
                    }
                }
            }

            Session::set("error", array(
                "type" => "alert-success",
                "msg" => "Os registros foram excluídos com sucesso."
            ));

            Common::redir("sistemapat/empresa/listar");
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/empresa/listar");
        }
    }
}
