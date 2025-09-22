<?php
class atividades
{
    public $id;
    public $titulo;
    public $descricao;
    public $inicio;
    public $fim;
    public $status;
    
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Método para cadastrar uma nova tarefa
    public function cadastrar(): bool
    {
        try {
            $sql = "INSERT INTO Atividade (`titulo`, `descricao`, `inicio`, `fim`, `status`) VALUES (?, ?, ?, ?, ?)";
            $dados = [
                $this->titulo,
                $this->descricao,
                $this->inicio,
                $this->fim,
                $this->status
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao cadastrar tarefa: " . $e->getMessage());
            throw new Exception(message: "Erro ao cadastrar Atividade: " . $e->getMessage());
        }
    }

    // Método para consultar todas as tarefas, com busca opcional
    public function consultarTodos($search = '')
    {
        try {            
            if ($search) {
                $sql = "SELECT * FROM Atividade WHERE titulo LIKE ? OR descricao LIKE ?";
                $search = trim(string: $search);
                $search = "%{$search}%";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$search, $search]);
            } else {
                $sql = "SELECT * FROM Atividade";
                $stmt = $this->conn->query($sql);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar Atividades: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar Atividades: " . $e->getMessage());
        }
    }

    // Método para consultar tarefa por ID
    public function consultarPorId($id)
    {
        try {
            $sql = "SELECT * FROM Atividade WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar atividade por ID: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar tarefa por ID: " . $e->getMessage());
        }
    }

    // Método para alterar uma tarefa existente
    public function editar()
    {
        try {
            $sql = "UPDATE Atividade SET titulo = ?, descricao = ?, inicio = ?, fim = ?, status = ? WHERE id = ? ";
            $dados = [
                $this->titulo,
                $this->descricao,
                $this->inicio,
                $this->fim,
                $this->status,
                $this->id
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao alterar atividade: " . $e->getMessage());
            throw new Exception(message: "Erro ao alterar Atividade: " . $e->getMessage());
        }
    }

    // Método para deletar uma tarefa
    public function deletar($id): bool
    {
        try {
            $sql = "DELETE FROM Atividade WHERE id = ? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao deletar atividade: " . $e->getMessage());
            throw new Exception(message: "Erro ao deletar atividade: " . $e->getMessage());
        }
    }
}