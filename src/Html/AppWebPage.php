<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = '')
    {
        parent::__construct($title);
        parent::appendCssUrl('/css/style.css');
    }

    public function toHTML(): string
    {
        $modification = webpage::getLastModification();
        return <<<HTML
        <!doctype html>
        <html lang="fr">
        <head>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>{$this->getTitle()}</title>
          {$this->getHead()}
        </head>
        <body>
        <header class="header">
          <h1>{$this->getTitle()}</h1>
        </header>
        <div class="content">
          <div class="list">
            {$this->getBody()}
          </div>
        </div>
        <footer class="footer">
            <div style='text-align: center; font-style: italic;'>Dernière modification : $modification </div>
        </footer>
        </body>
        </html>
HTML;
    }
}
