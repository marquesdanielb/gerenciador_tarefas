<?php

namespace Tarefas\Models;

class Anexo 
{
    private $id;
    private $tarefa_id = 0;
    private $nome = "";
    private $arquivo = "";

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTarefa_id(int $tarefa_id)
    {
        $this->tarefa_id = $tarefa_id;
    }

    public function getTarefa_id(): int
    {
        return $this->tarefa_id;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setArquivo(string $arquivo)
    {
        $this->arquivo = $arquivo;
    }

    public function getArquivo(): string
    {
        return $this->arquivo;
    }
}