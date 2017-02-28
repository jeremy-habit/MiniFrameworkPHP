<?php

namespace MagicMonkey\MiniJournal;

use MagicMonkey\Framework\Inheritance\AbstractRouter;

class Router extends AbstractRouter
{
    public function parseRequest()
    {
        // ici le code qui détermine le contrôleur de classe et l'action
        // et les met dans $this->controllerClassName et $this->controllerAction
        $package = $this->request->getGetParam('o');
        switch ($package) {
            case "article":
                $this->controllerClassName = "MagicMonkey" . DIRECTORY_SEPARATOR . "MiniJournal" . DIRECTORY_SEPARATOR;
                $this->controllerClassName .= "Article" . DIRECTORY_SEPARATOR . "ArticleController";
                break;
            default:
                $this->controllerClassName = "MagicMonkey" . DIRECTORY_SEPARATOR . "MiniJournal" . DIRECTORY_SEPARATOR;
                $this->controllerClassName .= "Article" . DIRECTORY_SEPARATOR . "ArticleController";
        }

        // tester si la classe à instancier existe bien. Si non lancer une Exception.
        if (!class_exists($this->controllerClassName)) {
            throw new \Exception("Classe {$this->controllerClassName} non existante");
        }

        // regarder si une action est demandée dans l'URL
        // si le paramètre 'a' n'existe pas alors l'action sera 'defaultAction'
        $this->controllerAction = $this->request->getGetParam('a', 'home');

        // tester si l'action existe bien. Si non lancer une Exception
        if (!method_exists($this->controllerClassName, $this->controllerAction)) {
            throw new \Exception("Action {$this->controllerAction} non existante");
        }
    }
}
