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

    $posterId = $tvShow->getPosterId();

    $webPage = new AppWebPage();

    $webPage->appendCssUrl("/css/filter.css");
    $webPage->appendCssUrl("/css/modification.css");

    $webPage->setTitle("Séries TV: {$webPage->escapeString($tvShow->getName())}");

    $webPage->appendContent(
        <<<HTML
        <div class="icon">
            <div class="menu">
                    <a href="index.php" class="home">
                        <img class="home_icon" src="/images/home_icon.png" alt="icon maison pour revenir à l'index"/>
                    </a>
            </div>
        HTML
    );

    $webPage->appendContent(<<<HTML
          <div class="modif">
              <a class ="tvshow__change" href="admin/tvShow-form.php?tvShowId={$tvShow->getId()}">
                  <img class="home_icon" src="/images/modification_icon.png" alt="icon pour modifier la série"/>
              </a>
          </div>
          <div class="delete"
              <a class ="tvshow__change" href="admin/tvShow-delete.php?tvShowId={$tvShow->getId()}">
                  <img class="home_icon" src="/images/trash_icon.png" alt="icon poubelle pour supprimer la série"/>
              </a>
          </div>
      </div>
      <div class="tvshow_presentation">
        <img class="tvshow__image_poster" src="poster.php?posterId=$posterId" alt="Poster de la série {$webPage->escapeString($tvShow->getName())}"/>
        <div class="tvshow__series">
            <div class="tvshow__series_numbering">
                <div class="tvshow__title_serie">{$webPage->escapeString($tvShow->getName())}</div>
                <div class="tvshow__title_original">{$webPage->escapeString($tvShow->getOriginalName())}</div>
            </div>
            <div class="tvshow__description">{$webPage->escapeString($tvShow->getOverview())}</div>
        </div>
      </div>
HTML);

    $seasons = SeasonCollection::findByTvShowId($tvShow->getId());

    foreach ($seasons as $season) {
        $posterId = $season->getPosterId();
        $webPage->appendContent(<<<HTML
      <a href="episode.php?seasonId={$season->getId()}" class="seasons">
        <img class="seasons__image_poster" src="poster.php?posterId=$posterId" alt="Poster de la saison {$webPage->escapeString($season->getName())}"/>
        <div class="seasons__series">
            <div class="seasons__title">{$webPage->escapeString($season->getName())}</div>
        </div>
      </a>
HTML);
    }

    $webPage->appendContent("</ol>\n");

    echo $webPage->toHTML();
} catch (EntityNotFoundException) {
    header("Location: index.php", true, 302);
}
