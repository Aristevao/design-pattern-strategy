<?

namespace Services;

// External Lib
include_once "shipping/correios.php";
include_once "shipping/dhl.php";
include_once "shipping/fedex.php";
include_once "shipping/jadlog.php";
include_once "shipping/tnt.php";
include_once "shipping/mercadoenvio.php";

// ---- Strategy Interface ----
// The strategy interface declares operations common to all
// supported versions of some algorithm. The context uses this
// interface to call the algorithm defined by the concrete
// strategies.
interface FreteServico {
    function calcula(float $peso): float;
}

// ---- Concrete Strategy ----
// Concrete strategies implement the algorithm while following
// the base strategy interface. The interface makes them
// interchangeable in the context.
class Sedex implements FreteServico {
    function calcula(float $peso): float {
        $correios = new \Correios();
        $valorTotal = $correios->calculaRemessa("SEDEX", $peso);
        return $valorTotal;
    }
}

class PAC implements FreteServico {
    function calcula(float $peso): float {
        $correios = new \Correios();
        $valorTotal = $correios->calculaRemessa("PAC", $peso);
        return $valorTotal;
    }
}

class JadLog implements FreteServico {
    function calcula(float $peso): float {
        return  calculaFreteJadLog($peso);
    }
}

class DHL implements FreteServico {
    function calcula(float $peso): float {
        $dhl = new \DHL();
        $valorTotal = $dhl->priceCalculator($peso);
        return $valorTotal;
    }
}

class Fedex implements FreteServico {
    function calcula(float $peso): float {
        $dhl = new \DHL();
        $valorTotal = $dhl->priceCalculator($peso);
        return $valorTotal;
    }
}

class TNT implements FreteServico {
    function calcula(float $peso): float {
        $tnt = new \TNT();
        $valorTotal = $tnt->shippingPriceCalculator("PAC", $peso);
        return $valorTotal;
    }
}
class MercadoEnvio implements FreteServico {
    function calcula(float $peso): float {
        $tnt = new \MercadoEnvio();
        $valorTotal = $tnt->calcula($peso);
        return $valorTotal;
    }
}

// ---- Context ----
// The context defines the interface of interest to clients.
class Frete {
    private $servico;

    function __construct(FreteServico $servico) {
        $this->servico = $servico;
    }

    public function calcula(float $peso) {
        $valorTotal = $this->servico->calcula($peso);
        return $valorTotal;
    }

    function setServico(FreteServico $servico) {
        $this->servico = $servico;
    }
}
