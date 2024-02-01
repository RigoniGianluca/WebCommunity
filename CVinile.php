<?php

namespace CVinile;

class CVinile
{
    public $img;
    public $titolo;
    public $autore;
    public $descrizione;
    public $utente;


    public function __construct(string $img, string $titolo, string $autore, string $utente, string $descrizione)
    {
        $this->img = $img;
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->utente = $utente;
        $this->descrizione = $descrizione;
    }
}

