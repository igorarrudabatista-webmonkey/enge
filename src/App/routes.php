<?php

use \Nornas\Route,
	\Nornas\RouteAgent as Agent,
	\Nornas\RouteGroup as Group;

Agent::addDir("root", "");
Agent::addDir("adm", "sistemapat");

Agent::addController("login", "login");
Agent::addController("leader", "aluno");
Agent::addController("user", "usuario");
Agent::addController("product", "produto");
Agent::addController("company", "empresa");
Agent::addController("group", "grupo");

Agent::addAction("list", "listar");
Agent::addAction("new", "novo");
Agent::addAction("register", "cadastrar");
Agent::addAction("activate", "ativar");
Agent::addAction("deactivate", "desativar");
Agent::addAction("edit", "editar");
Agent::addAction("update", "atualizar");
Agent::addAction("delete", "deletar");
Agent::addAction("proccess", "processa");
Agent::addAction("logout", "logout");
Agent::addAction("delete_checked", "deletar-marcados");
Agent::addAction("generate_pdf", "gerar-pdf");
Agent::addAction("change_password", "alterar-senha");
Agent::addAction("my_profile", "meu-perfil");

/**
 * 
 * Declaração dos grupos de rotas
 */

Group::add("root", "", function ($c) {
    return "\\App\\Controller\\" . ucfirst($c);
});

Group::add("adm", Agent::getDir("adm"), function ($c) {
	return "\\App\\Adm\\Controller\\" . ucfirst($c);
});

/**
 * 
 * Declaração de patterns globais
 */

Route::setGlobal("{controller}", "([A-Za-z0-9-_]+)");
Route::setGlobal("{action}", "([A-Za-z0-9-_]+)");
Route::setGlobal("{arg}", "([A-Za-z0-9-_]+)");

/**
 * 
 * Rotas cadastradas para todos os grupos.
 */

Route::add("{controller}(/{action})?(/{arg}){0,7}")
    ->alias("{action}?(/{arg}){0,7}")
    ->defaults([
        "controller" => "index"
    ])
    ->register("all");
