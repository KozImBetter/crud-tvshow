<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /** Protéger les caractères spéciaux pouvant dégrader la page Web
     * @param string|null $string $string
     * @return string
     */
    public function escapeString(?string $string): string
    {
        return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
    }
}
