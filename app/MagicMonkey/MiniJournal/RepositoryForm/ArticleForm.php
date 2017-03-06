<?php

namespace MagicMonkey\MiniJournal\RepositoryForm;

use MagicMonkey\Framework\Inheritance\AbstractForm;
use MagicMonkey\Framework\Validator\Type\MaxLength;
use MagicMonkey\Framework\Validator\Type\NotBlank;
use MagicMonkey\Framework\Validator\Type\ValidValues;
use MagicMonkey\MiniJournal\Entity\Article;

/**
 * Class ArticleForm
 * @package MagicMonkey\MiniJournal\RepositoryForm
 */
class ArticleForm extends AbstractForm
{
    /**
     * @var Article
     */
    protected $article;

    /**
     * ArticleForm constructor.
     */
    public function __construct()
    {
        parent::__construct("article");
        $this->article = new Article();
    }

    /**
     * Permet de vérifier les données postées via un formulaire :
     * ajout de différentes validations sur différents champ
     */
    public function validationOptions()
    {
        $this->validatorManager
            ->add('title', new NotBlank())
            ->add('title', new MaxLength(255))
            ->add('author', new NotBlank())
            ->add('author', new MaxLength(255))
            ->add('content', new NotBlank())
            ->add('chapo', new NotBlank())
            ->add('publication_status', new NotBlank())
            ->add('publication_status', new ValidValues(array("brouillon", "publie")));
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }
}