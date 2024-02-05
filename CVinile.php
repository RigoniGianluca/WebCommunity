<?php

namespace CVinile;

class CVinile
{
    public $id;
    public $img;
    public $titolo;
    public $autore;
    public $descrizione;
    public $utente;

    public function __construct(string $id, string $img, string $titolo, string $autore, string $utente, string $descrizione)
    {
        $this->id = $id;
        $this->img = $img;
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->utente = $utente;
        $this->descrizione = $descrizione;
    }

    public function ChangeTitolo(string $titolo){
        $this->titolo = $titolo;
    }

    public function ChangeAutore(string $autore){
        $this->autore = $autore;
    }

    public function ChangeImg(string $immagine){
        $this->img = $immagine;
    }

    public function ChangeDescrizione(string $descrizione){
        $this->descrizione = $descrizione;
    }
}

