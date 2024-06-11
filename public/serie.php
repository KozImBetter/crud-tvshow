<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\TvShow;
use Entity\Collection\SeasonCollection;
use Html\AppWebPage;

try {
    if (!isset($_GET['seriesId']) || !ctype_digit($_GET['seriesId'])) {
        header("Location: index.php", true, 302);
        exit();
    }

    $tvShow = TvShow::findById(intval($_GET['seriesId']));

    $poster = $tvShow->getPosterId();

    $webPage = new AppWebPage();

    $webPage->setTitle($tvShow->getName());

    $webPage->appendContent(<<<HTML
      <a href="serie.php?seriesId={$tvShow->getId()}" class="tvshow">
        <img class="poster" src="poster.php?posterId=$poster"/>
        <div class="serie">
            <div class="title">{$webPage->escapeString($tvShow->getName())}</div>
            <div class="description">{$webPage->escapeString($tvShow->getOverview())}</div>
        </div>
      </a>
HTML);

    $season = SeasonCollection::findByTvShowId($tvShow->getId());

    foreach ($season as $episode) {
        $poster = $episode->getPosterId();
        $webPage->appendContent(<<<HTML
      <a href="episode.php?episodesId={$episode->getId()}" class="tvshow">
        <img class="poster" src="poster.php?posterId=$poster"/>
        <div class="serie">
            <div class="title">{$webPage->escapeString($episode->getName())}</div>
        </div>
      </a>
HTML);
    }

    $webPage->appendContent("</ol>\n");

    echo $webPage->toHTML();
} catch (EntityNotFoundException) {
    header("Location: index.php", true, 302);
}
