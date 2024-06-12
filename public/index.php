<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$allTvShow = TvShowCollection::findAll();
$allGenre = GenreCollection::findAll();

$webPage = new AppWebPage();

$webPage->setTitle("Séries TV");

$webPage->appendContent(<<<HTML
 <div class="filter">
 HTML);

foreach ($allGenre as $genre) {
    $webPage->appendContent("            <a href='indexSorted.php?genreId={$genre->getId()}' class='tvshow__genre'>{$genre->getName()}</a>\n");
}

$webPage->appendContent(
    <<<HTML
        </div>
        <div class="add">
            <a class='tvshow__add' href='admin/tvShow-form.php'>
                 <img class="home_icon" src="/images/plus_icon.png" alt="icon plus pour ajouter une série"/>
            </a>
        </div>
        <ol>
HTML
);

$webPage->appendCssUrl("/css/index.css");
$webPage->appendCssUrl("/css/filter.css");
$webPage->appendCssUrl("/css/modification.css");

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
