<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\TvShow;
use Html\StringEscaper;
use Entity\Exception\ParameterException;

class TvShowForm
{
    use StringEscaper;
    private ?TvShow $tvShow;

    public function __construct(?TvShow $tvShow)
    {
        $this->tvShow = $tvShow;
    }
    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }

    public function setEntityFromQueryString(): void
    {
        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = intval($_POST['id']);
        } else {
            $id = null;
        }

        if (!empty($_POST['name'])) {
            $name = $this->escapeString($this->stripTagsAndTrim($_POST['name']));
        } else {
            throw new ParameterException("Nom vide");
        }

        if (!empty($_POST['originalName'])) {
            $originalName = $this->escapeString($this->stripTagsAndTrim($_POST['originalName']));
        } else {
            throw new ParameterException("Nom original vide");
        }

        if (!empty($_POST['homepage'])) {
            $homepage = $this->escapeString($this->stripTagsAndTrim($_POST['homepage']));
        } else {
            throw new ParameterException("Page d'accueil vide");
        }

        if (!empty($_POST['overview'])) {
            $overview = $this->escapeString($this->stripTagsAndTrim($_POST['overview']));
        } else {
            throw new ParameterException("Description vide");
        }

        if (!empty($_POST['posterId']) && ctype_digit($_POST['posterId'])) {
            $posterId = intval($_POST['posterId']);
        } else {
            $posterId = null;
        }

        $this->tvShow = TvShow::create($name, $originalName, $homepage, $overview, $posterId, $id);

        return;
    }

    public function getHtmlForm(string $action): string
    {
        return  <<<HTML
        <h1>{$this->tvShow->getName()}</h1>
            <form method="post" action="{$action}">
                <input name="id" type="hidden" value="{$this->escapeString($this->tvShow->getId())}">
                
                    <div class="F_name">
                        <label for="nom">Nom: </label>
                        <input name="name" type="text" value="{$this->escapeString($this->tvShow->getName())}" required>
                    </div>
                    
                    <div class="F_originalName">
                        <label for="nom_original">Nom original : </label>
                        <input name="originalName" type="text" value="{$this->escapeString($this->tvShow->getOriginalName())}" required>
                    </div>
                    
                    <div class="F_homepage">
                        <label for="page_accueil">Homepage: </label>
                        <input name="homepage" type="text" value="{$this->escapeString($this->tvShow->getHomepage())}" required>
                    </div>
                    
                    <div class="F_overview">
                        <label for="description">Description: </label>
                        <input name="overview" type="text" value="{$this->escapeString($this->tvShow->getOverview())}" required>
                    </div>
                    
                    <div class="F_posterId">
                        <label for="id_poster">Nom: </label>
                        <input name="posterId" type="text" value="{$this->tvShow->getPosterId()}" required>
                    </div>
                <button type="submit">Enregistrer</button>
            </form>
HTML;

    }
}
