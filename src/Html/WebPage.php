<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    private string $head = "";
    private string $title = "";
    private string $body = "";


    /** Constructeur de la classe WebPage
     *
     * @param string $title
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
    }


    /** Accesseur de $this->head
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }


    /** Accesseur de $this->title
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /** Modificateur de $this->title
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /** Accesseur de $this->body
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }


    /** Ajoute du contenu dans $this->head
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }


    /** Ajoute du contenu dans $this->head
     * @param string $css
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->head .= "<style>$css</style>";
    }


    /**  Ajoute l'URL du fichier CSS dans $this->head
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->head .= "<link href={$url} rel='stylesheet'>";
    }


    /** Ajoute du JavaScript dans $this->body
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->head .= "<script>$js</script>";
    }


    /** Ajoute l'URL du fichier JavaScript dans $this->head
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= "<script src='$url'></script>";
    }


    /** Ajoute du contenu à $this->body
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }


    /** Retourne la page HTML
     * @return string
     */
    public function toHTML(): string
    {
        $modification = webpage::getLastModification();
        $this->body .= "<div style='text-align: right; font-style: italic;'>Dernière modification de cette page le {$modification} </div>";
        return <<<HTML
        <!doctype html>
        <html lang="fr">
        <head>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>$this->title</title>
          $this->head
        </head>
        <body>
          $this->body
        </body>
        </html>
HTML;
    }


    /** Protéger les caractères spéciaux pouvant dégrader la page Web
     * @param string $string
     * @return string
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
    }


    /** Donner la date et l'heure de la dernière modification du script principal
     * @return string
     */
    public static function getLastModification(): string
    {
        return date('d/m/Y', getlastmod()) . " à " . date('H:i:s.', getlastmod());
    }

}
