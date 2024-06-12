<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    public function escapeString(?string $string): ?string
    {
        if ($string == null) {
            return "";
        }
        return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
    }

    public function stripTagsAndTrim(?string $string): ?string
    {
        if ($string == null) {
            return "";
        } else {
            $string = strip_tags($string);
            return trim($string);
        }
    }
}
