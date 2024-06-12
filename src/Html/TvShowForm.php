<?php

declare(strict_types=1);

namespace Html;

use Entity\TvShow;
use Html\StringEscaper;

class TvShowForm
{
    private ?TvShow $tvShow;

    public function __construct(?TvShow $tvShow)
    {
        $this->tvShow = $tvShow;
    }
    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }

    public function getHtmlForm(string $action): string
    {
        return  <<<HTML
        <h1>{$this->tvShow->getName()}</h1>
            <form method="post" action="{$action}">
                <input name="id" type="hidden" value="{$this->tvShow->getId()}">
                
                    <div class="F_name">
                        <label for="nom">Nom: </label>
                        <input name="name" type="text" value="{$this->tvShow->getName()}" required>
                    </div>
                    
                    <div class="F_originalName">
                        <label for="nom_original">Nom original : </label>
                        <input name="originalName" type="text" value="{$this->tvShow->getOriginalName()}" required>
                    </div>
                    
                    <div class="F_homepage">
                        <label for="page_accueil">Homepage: </label>
                        <input name="homepage" type="text" value="{$this->tvShow->getHomepage()}" required>
                    </div>
                    
                    <div class="F_overview">
                        <label for="description">Description: </label>
                        <input name="overview" type="text" value="{$this->tvShow->getOverview()}" required>
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
