<?php
declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

if (!isset($_GET['posterId']) || !ctype_digit($_GET['posterId'])) {
    http_response_code(400);
    exit();
}

try {
    $cover = Entity\Poster::findById(intval($_GET['posterId']));
    header('Content-Type: image/jpeg');
    echo $cover->getJpeg();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
