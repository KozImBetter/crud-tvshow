<?php

declare(strict_types=1);

use Entity\Exception\ParameterException;
use Html\Form\TvShowForm;
use Entity\TvShow;

try {
    if (!isset($_GET['tvShowId']) || !ctype_digit($_GET['tvShowId'])) {
        header("Location: ../index.php", true, 302);
        exit();
    }

    $tvShow = TvShow::findById($_GET['tvShowId']);
    $tvShow->delete();
    header("Location: ../index.php", true, 302);
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
