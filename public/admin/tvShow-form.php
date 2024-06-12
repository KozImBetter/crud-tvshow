<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\Form\TvShowForm;
use Html\WebPage;
use Entity\TvShow;

try {
    if (!isset($_GET['tvShowId']) || !ctype_digit($_GET['tvShowId'])) {
        $tvShow = new TvShow();
        $form = new TvShowForm(null);
        $webPage = new WebPage();
        $webPage->setTitle("Modifier une série");
        $webPage->appendContent($form->getHtmlForm("tvShow-save.php"));
        echo $webPage->toHTML();
    }
    $tvShow = TvShow::findById(intval($_GET['tvShowId']));
    $form = new TvShowForm($tvShow);
    $webPage = new WebPage();
    $webPage->setTitle("Modifier une série");
    $webPage->appendContent($form->getHtmlForm("tvShow-save.php"));

    echo $webPage->toHTML();

} catch (ParameterException) {
    echo "hey";
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}