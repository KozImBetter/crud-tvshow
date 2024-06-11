<?php

declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$allTvShow = TvShowCollection::findAll();

$webPage = new AppWebPage();

$webPage->setTitle("Séries TV");

$webPage->appendContent("<ol>\n");

foreach ($allTvShow as $tvShow) {
    $poster = $tvShow->getPosterId();
    $webPage->appendContent(<<<HTML
      <a class="list">
        <img class="poster" src="poster.php?posterId=$poster"/>
        <div class="serie">
            <div class="title">{$webPage->escapeString($tvShow->getName())}</div>
            <div class="description">{$webPage->escapeString($tvShow->getOverview())}</div>
        </div>
      </a>
HTML);
}

$webPage->appendContent("</ol>\n");

echo $webPage->toHTML();
