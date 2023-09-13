<?php

namespace Tarefas\Models;

class RepositorioTarefas
{
    public function __construct(
        private \PDO $pdo
    ) {}

    public function salvar(Tarefa $tarefa): void 
    {
        $prazo = $tarefa->getPrazo();

        if (is_object($prazo)) {
            $prazo = $prazo->format('Y-m-d');
        }

        $sql = "INSERT INTO tarefas
                    (nome, descricao, prazo, prioridade, concluida)
                VALUES
                    (:nome, :descricao, :prazo, :prioridade, :concluida)";

        $query = $this->pdo->prepare($sql);
        $query->execute([
            'nome' => strip_tags($tarefa->getNome()),
            'descricao' => strip_tags($tarefa->getDescricao()),
            'prioridade' => $tarefa->getPrioridade(), 
            'prazo' => $prazo,
            'concluida' => ($tarefa->getConcluida()) ? 1 : 0,
        ]);
    }

    public function atualizar(Tarefa $tarefa)
    {
        $prazo = $tarefa->getPrazo();

        if (is_object($prazo)) {
            $prazo = $prazo->format('Y-m-d');
        }

        $sql = "UPDATE tarefas SET
                    nome = :nome,
                    descricao = :descricao,
                    prazo = :prazo,
                    prioridade = :prioridade,
                    concluida = :concluida
                WHERE id = :id";
        
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'nome' => strip_tags($tarefa->getNome()),
            'descricao' => strip_tags($tarefa->getDescricao()),
            'prioridade' => $tarefa->getPrioridade(),
            'prazo' => $prazo,
            'concluida' => ($tarefa->getConcluida()) ? 1 : 0,
            'id' => $tarefa->getId(),
        ]);
    }

    public function buscar(int $tarefa_id = 0): Tarefa|array
    {
        if ($tarefa_id > 0) {
            return $this->buscar_tarefa($tarefa_id);
        } else {
            return $this->buscar_tarefas();
        }
    }

    private function buscar_tarefas(): array
    {
        $sql = 'SELECT * FROM tarefas';
        $resultado = $this->pdo->query($sql, \PDO::FETCH_CLASS, 'Tarefas\Models\Tarefa');

        $tarefas = [];

        foreach ($resultado as $tarefa) {
            $tarefa->setAnexos($this->buscar_anexos($tarefa->getId()));
            $tarefas[] = $tarefa;
        }

        return $tarefas;
    }

    private function buscar_tarefa(int $id): Tarefa
    {
        $sql = "SELECT * FROM tarefas WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'id' => $id,
        ]);
        $tarefa = $query->fetchObject('Tarefas\Models\Tarefa');

        if (!is_object($tarefa)) {
            throw new \Exception("A tarefa com o id {$id} não existe");
        }

        $tarefa->setAnexos($this->buscar_anexos($tarefa->getId()));

        return $tarefa;
    }

    public function remover(int $id)
    {
        $sql = "DELETE FROM tarefas WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'id' => $id,
        ]);
    }
    
    public function buscar_anexos(int $tarefa_id): array
    {
        $sql = "SELECT * FROM anexos WHERE tarefa_id = :tarefa_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            "tarefa_id" => $tarefa_id,
        ]);

        $anexos = [];

        while ($anexo = $query->fetchObject('Tarefas\Models\Anexo')) {
            $anexos[] = $anexo;    
        }

        return $anexos;
    }

    public function buscar_anexo(int $id): Anexo
    {
        $sql = "SELECT * FROM anexos WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'id' => $id,
        ]);

        $anexo = $query->fetchObject('Tarefas\Models\Anexo');

        if (!is_object($anexo)) {
            throw new \Exception("O anexo com o id {$id} não existe");
        }

        return $anexo;
    }

    public function salvar_anexo(Anexo $anexo)
    {
        $sql = "INSERT INTO anexos
                    (tarefa_id, nome, arquivo)
                VALUES
                    (:tarefa_id, :nome, :arquivo)";
        
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'tarefa_id' => $anexo->getTarefa_id(),
            'nome' => strip_tags($anexo->getNome()),
            'arquivo' => strip_tags($anexo->getArquivo()),
        ]);
    }

    public function remover_anexo(int $id)
    {
        $sql = "DELETE FROM anexos WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
    }
}
