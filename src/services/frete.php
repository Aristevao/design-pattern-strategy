<?

namespace Services;

// External Lib
include_once "shipping/correios.php";
include_once "shipping/dhl.php";
include_once "shipping/fedex.php";
include_once "shipping/jadlog.php";
include_once "shipping/tnt.php";
include_once "shipping/mercadoenvio.php";

// Strategy Interface
interface FreteServico
{
    function calcula(float $peso): float;
}

// Concrete Strategy - classes que implementam a interface
class Sedex implements FreteServico
{
    function calcula(float $peso): float
    {
        $correios = new \Correios();
        $valorTotal = $correios->calculaRemessa("SEDEX", $peso);
        return $valorTotal;
    }
}

class PAC implements FreteServico
{
    function calcula(float $peso): float
    {
        $correios = new \Correios();
        $valorTotal = $correios->calculaRemessa("PAC", $peso);
        return $valorTotal;
    }
}

class JadLog implements FreteServico
{
    function calcula(float $peso): float
    {
        return  calculaFreteJadLog($peso);
    }
}

class DHL implements FreteServico
{
    function calcula(float $peso): float
    {
        $dhl = new \DHL();
        $valorTotal = $dhl->priceCalculator($peso);
        return $valorTotal;
    }
}

class Fedex implements FreteServico
{
    function calcula(float $peso): float
    {
        $dhl = new \DHL();
        $valorTotal = $dhl->priceCalculator($peso);
        return $valorTotal;
    }
}

class TNT implements FreteServico
{
    function calcula(float $peso): float
    {
        $tnt = new \TNT();
        $valorTotal = $tnt->shippingPriceCalculator("PAC", $peso);
        return $valorTotal;
    }
}
class MercadoEnvio implements FreteServico
{
    function calcula(float $peso): float
    {
        $tnt = new \MercadoEnvio();
        $valorTotal = $tnt->calcula($peso);
        return $valorTotal;
    }
}

// Context - consumo das classes Concretes
class Frete
{
    private $servico;

    function __construct(FreteServico $servico)
    {
        $this->servico = $servico;
    }

    public function calcula(float $peso)
    {
        $valorTotal = $this->servico->calcula($peso);
        return $valorTotal;
    }

    function setServico(FreteServico $servico) {
        $this->servico = $servico;
    }
}
