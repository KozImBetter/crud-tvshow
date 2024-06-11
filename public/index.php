<?php

declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$allTvShow = TvShowCollection::findAll();

$webPage = new AppWebPage();

$webPage->setTitle("Séries TV");

$webPage->appendContent("<ol>\n");

foreach ($allTvShow as $tvShow) {
    $webPage->appendContent(<<<HTML
      <li>
        <div class="poster"></div>
        <div class="Titre">{$webPage->escapeString($tvShow->getName())}</div>
        <div class="description">{$webPage->escapeString($tvShow->getOverview())}</div>
      </li>
HTML);
}

$webPage->appendContent("<\ol>\n");

echo $webPage->toHTML();
