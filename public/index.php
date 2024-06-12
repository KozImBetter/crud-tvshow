<?php

declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$allTvShow = TvShowCollection::findAll();

$webPage = new AppWebPage();

$webPage->setTitle("Séries TV");

$webPage->appendContent("<ol>\n");

$webPage->appendCssUrl("/css/index.css");

foreach ($allTvShow as $tvShow) {
    $poster = $tvShow->getPosterId();
    $webPage->appendContent(<<<HTML
      <a href="serie.php?seriesId={$tvShow->getId()}" class="tvshow">
        <img class="tvshow__image_poster" src="poster.php?posterId=$poster" alt="Poster de la série :{$tvShow->getName()}"/>
        <div class="tvshow__series">
            <div class="tvshow__title">{$webPage->escapeString($tvShow->getName())}</div>
            <div class="tvshow__description">{$webPage->escapeString($tvShow->getOverview())}</div>
        </div>
      </a>
HTML);
}

$webPage->appendContent("</ol>\n");

echo $webPage->toHTML();
