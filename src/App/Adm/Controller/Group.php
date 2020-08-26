<?php

namespace App\Adm\Controller;

use \Nornas\Controller,
    \Nornas\Common,
    \Nornas\Session;

class Group extends Controller
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

        $this->loadModel("\\App\\Adm\\Model\\Group", "group");
    }

    public function action_main()
    {
        Common::redir("sistemapat/grupo/listar");
    }

    public function action_new()
    {
        $data["pageTitle"] = "Novo grupo";
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
                    "scd-level%in" => array(
                        "Novo%active" => ADM_URL . "grupo/novo",
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

        $data["header"]["moduleTitle"] = "Grupos";

        $data["header"]["breadcrumbs"] = array(
            "Home" => ADM_URL,
            "Grupos" => ADM_URL . "grupo",
            "Novo%active" => null
        );

        $data["action"] = ADM_URL . "grupo/cadastrar";

        $this->loadView(ADM_VIEW_PATH, "group/new", $data);
    }

    public function action_edit($id)
    {
        if (Common::isEmpty($id)) {
            Common::redir("sistemapat/grupo/listar");
        }

        $rset = $this->group->getById($id);

        if ($rset) {
            $data["group"] = $rset;
        }

        $data["pageTitle"] = "Atualizar grupo";
        $data["action"] = ADM_URL . "grupo/atualizar/" . $id;
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
                    "scd-level%in" => array(
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

        $data["header"]["moduleTitle"] = "Grupos";

        $data["header"]["breadcrumbs"] = array(
            "Home" => ADM_URL,
            "Grupos" => ADM_URL . "grupo",
            "Editar%active" => null
        );

        $this->loadView(ADM_VIEW_PATH, "group/edit", $data);
    }

    public function action_list()
    {
        $rset = $this->group->getAll();

        if ($rset) {
            $data["groups"] = $rset;
        }

        $data["pageTitle"] = "Listagem de grupos";
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
                    "scd-level%in" => array(
                        "Novo" => ADM_URL . "grupo/novo",
                        "Listar%active" => ADM_URL . "grupo/listar"
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

        $data["header"]["moduleTitle"] = "Grupos";

        $data["header"]["breadcrumbs"] = array(
            "Home" => ADM_URL,
            "Grupos" => ADM_URL . "grupo",
            "Listar%active" => null
        );

        $this->loadView(ADM_VIEW_PATH, "group/list", $data);
    }

    public function action_register()
    {
        try {
            if (Common::isEmpty($_POST)) {
                throw new \Exception("Por favor, preencha todos os campos.");
            }

            Session::set("data", array(
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "status" => $_POST["status"]
            ));

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);

            if (!$title) {
                throw new \Exception("Por favor, preencha o campo 'Título'.");
            }

            $addedUpColumns = array(
                "title" => $title,
                "description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING),
                "status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING),
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            );

            $id = $this->group->create($addedUpColumns);

            if (is_numeric($id)) {
                Session::del("data");
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Grupo cadastrado com sucesso!"
                ));

                Common::redir("sistemapat/grupo/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar inserir o registro, por favor, tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/grupo/novo");
        }
    }

    public function action_update($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/grupo/listar");
            }

            if (Common::isEmpty($_POST)) {
                throw new \Exception("Por favor, preencha todos os campos obrigatórios.");
            }

            Session::set("data", array(
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "status" => $_POST["status"]
            ));

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);

            if (!$title) {
                throw new \Exception("Por favor, preencha o campo 'Título'.");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $setableColumns = array(
                "title" => $title,
                "description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING),
                "status" => filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING),
                "updated_at" => date("Y-m-d H:i:s")
            );

            $rset = $this->group->update($referenceColumns, $setableColumns);

            if ($rset) {
                Session::del("data");
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Grupo atualizado com sucesso!"
                ));

                Common::redir("sistemapat/grupo/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar editar o registro, por favor, tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/grupo/editar/" . $id);
        }
    }

    public function action_delete($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/grupo/listar");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $rset = $this->group->delete($referenceColumns);

            if ($rset) {
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Grupo excluído com sucesso!"
                ));

                Common::redir("sistemapat/grupo/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar excluir o registro, por favor, tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/grupo/listar");
        }
    }

    public function action_deactivate ($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/grupo/listar");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $setableColumns = array(
                "status" => "0"
            );

            $rset = $this->group->update($referenceColumns, $setableColumns);

            if ($rset) {
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Grupo desativado com sucesso!"
                ));

                Common::redir("sistemapat/grupo/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar desativar o registro, por favor tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/grupo/listar");
        }
    }

    public function action_activate ($id)
    {
        try {
            if (Common::isEmpty($id)) {
                Common::redir("sistemapat/grupo/listar");
            }

            $referenceColumns = array(
                "id" => (int) $id
            );

            $setableColumns = array(
                "status" => "1"
            );

            $rset = $this->group->update($referenceColumns, $setableColumns);

            if ($rset) {
                Session::set("error", array(
                    "type" => "alert-success",
                    "msg" => "Grupo ativada com sucesso!"
                ));

                Common::redir("sistemapat/grupo/listar");
            } else {
                throw new \Exception("Ocorreu um erro ao tentar ativar o registro, por favor tente novamente.");
            }
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/grupo/listar");
        }
    }

    public function action_delete_checked ()
    {
        try{
            if (Common::isEmpty($_POST)) {
                Common::redir("sistemapat/grupo/listar");
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

                    $rset = $this->group->delete($referenceColumns);

                    if (!$rset) {
                        throw new \Exception("Ocorreu um erro ao tentar excluir os registro, por favor, tente novamente.");
                    }
                }
            }

            Session::set("error", array(
                "type" => "alert-success",
                "msg" => "Os registros foram excluídos com sucesso."
            ));

            Common::redir("sistemapat/grupo/listar");
        } catch (\Exception $e) {
            Session::set("error", array(
                "type" => "alert-warning",
                "msg" => $e->getMessage()
            ));

            Common::redir("sistemapat/grupo/listar");
        }
    }
}
