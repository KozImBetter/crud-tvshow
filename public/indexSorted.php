<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;
use Entity\Genre;

try {
    if (!isset($_GET['genreId']) || !ctype_digit($_GET['genreId'])) {
        header("Location: index.php", true, 302);
        exit();
    }

    $allTvShow = \Entity\Collection\TvShowCollection::findByGenreId(intval($_GET['genreId']));

    $webPage = new AppWebPage();

    $genre = Genre::findById(intval($_GET['genreId']));

    $webPage->setTitle("Séries TV {$genre->getName()}");

    foreach ($allTvShow as $tvShow) {
        $tvShow = \Entity\TvShow::findById($tvShow['tvShowId']);
        $poster = $tvShow->getPosterId();
        $webPage->appendContent(<<<HTML
      <a href="serie.php?seriesId={$tvShow->getId()}" class="tvshow">
        <img class="tvshow__image_poster" src="poster.php?posterId=$poster"/>
        <div class="tvshow__series">
            <div class="tvshow__title">{$webPage->escapeString($tvShow->getName())}</div>
            <div class="tvshow__description">{$webPage->escapeString($tvShow->getOverview())}</div>
        </div>
      </a>
HTML);
    }

    $webPage->appendContent("</ol>\n");

    echo $webPage->toHTML();
} catch (EntityNotFoundException) {
    header("Location: index.php", true, 302);
}