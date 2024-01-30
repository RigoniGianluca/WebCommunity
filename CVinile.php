<?php

namespace CVinile;

class CVinile
{
    public $img;
    public $titolo;
    public $autore;
    public $utente;


    public function __construct(string $img, string $titolo, string $autore, string $utente)
    {
        $this->img = $img;
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->utente = $utente;
    }
}

