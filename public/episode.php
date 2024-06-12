<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Entity\TvShow;
use Entity\Collection\EpisodeCollection;
use Html\AppWebPage;

try {


    $season = Season::findById(intval($_GET['seasonId']));

    $webPage = new AppWebPage();

    $webPage->setTitle("Séries TV: {$webPage->escapeString((TvShow::findById($season->getTvShowId()))->getName())} - {$webPage->escapeString($season->getName())}");

    $webPage->appendContent("<ol>\n");

    $allEpisode = EpisodeCollection::findBySeasonId(intval($_GET['seasonId']));

    $webPage->appendContent(<<<HTML
      <div class="episode">
        <img class="episode__image_poster" src="poster.php?posterId={$season->getPosterId()}" alt="Poster de la série {$webPage->escapeString((TvShow::findById($season->getTvShowId()))->getName())}"/>
        <div class="episode__series">
            <a class="episode__tvshow_title" href="serie.php?seriesId={$season->getTvShowId()}">{$webPage->escapeString((TvShow::findById($season->getTvShowId()))->getName())}</a>
            <div class="episode_season__title">{$webPage->escapeString($season->getName())}</div>
        </div>
      </div>
HTML);

    foreach ($allEpisode as $episode) {
        $webPage->appendContent(<<<HTML
      <div class="episode">
        <div class="episode__series">
            <div class="episode__number">{$webPage->escapeString((string)$episode->getEpisodeNumber())}</div>
            <div class="episode__title">{$webPage->escapeString($episode->getName())}</div>
            <div class="episode__description">{$webPage->escapeString($episode->getOverview())}</div>
        </div>
      </a>
HTML);
    }

    $webPage->appendContent("</ol>\n");

    echo $webPage->toHTML();
} catch (EntityNotFoundException) {
    header("Location: index.php", true, 302);
}
