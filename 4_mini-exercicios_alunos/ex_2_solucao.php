<?php

// Classe base
abstract class Veiculo{
    protected string $modelo;
    protected string $placa;
    protected bool $disponivel;

    public function __construct(string $modelo, string $placa)
    {
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->disponivel = true;
    }

    // Método abstrato (Não implementado agora)
    abstract public function calcularAluguel(int $dias): float;

    // Métodos auxiliares
    public function getModelo(): string {
        return $this->modelo;
    } 

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Veículo '$this->modelo' alugado com sucesso!";
        }
        return "Veículo '$this->modelo' não está disponível";
    }
 
    public function devolver(): string {
         if ($this->disponivel){
             $this->disponivel = true;
             return "Veículo '$this->modelo' devolvido com sucesso!";
         }
         return "Veículo '$this->modelo' já está na biblioteca";
    } 
}

// Subclasses
class Carro extends Veiculo{
    public function calcularAluguel(int $dias): float
    {
        return $dias * 100;
    }
}

class Moto extends Veiculo{
    public function calcularAluguel(int $dias): float
    {
        return $dias * 50;
    }
}

// Classe gerenciadora (Locadora)
class Locadora {
    // Criando um dicionário
    private array $itens =[];

    // Métodos para gerenciar (adicionar, emprestar e devolver)
    public function adicionarVeiculo(Veiculo$item): string {
        $this->itens[$item->getModelo()]= $item;
        return "Veículo '{$item->getModelo()}' adicionado ao acervo!";
    }
    
    public function alugarVeiculo(string $modelo): string {
        // Isset (verifica se o título existe no array)
        return isset($this->itens[$modelo]) ? $this->itens[$modelo]->alugar():"Veículo não encontrado.";
    }

    public function devolverVeiculo(string $modelo): string {
        return isset($this->itens[$modelo]) ? $this->itens[$modelo]->devolver():"Veículo não encontrado.";
    }
}

// Criando um Objeto/ Instância
$locadora = new Locadora();

// Criando itens (1 livro e 1 revista)
$carro1 = new Carro ("Impala 97", "EAI-6969");
$moto1 = new Moto ("Harley Davidson", "SEX-0412");

// Adicionar itens a biblioteca e exibir 
echo $locadora->adicionarVeiculo($carro1) . "<br>";
echo $locadora->adicionarVeiculo($moto1) . "<br><br>";

// Testando empréstimos 
echo $locadora->alugarVeiculo("Impala 97") . "<br>";
echo $locadora->alugarVeiculo("Harley Davidson") . "<br><br>";

// Testando devolução
echo $locadora->devolverVeiculo("Impala 97") . "<br><br>";

// Calcular multa de atraso
echo "Aluguel do carro (3 dias): R$" . number_format($carro1->calcularAluguel(3), 2) . "<br>";
echo "Aluguel da moto (3 dias): R$" . number_format($moto1->calcularAluguel(3), 2) . "<br><br>";


?>