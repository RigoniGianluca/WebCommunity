<?php

namespace CVinile;

class CVinile
{
    private $img;
    private $titolo;
    private $autore;
    private $utente;


    public function __construct(string $img, string $titolo, string $autore, string $utente)
    {
        $this->img = $img;
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->utente = $utente;
    }
}

