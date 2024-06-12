<?php

declare(strict_types=1);

use Entity\Exception\ParameterException;
use Html\Form\TvShowForm;

try {
    $tvShow = new TvShowForm(null);
    $tvShow->setEntityFromQueryString();
    $tvShow->getTvShow()->save();
    header("Location: ../index.php", true, 302);
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
