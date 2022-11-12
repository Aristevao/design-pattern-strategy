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
interface ShippingService {
    function calculate(float $weight): float;
}

// ---- Concrete Strategy ----
// Concrete strategies implement the algorithm while following
// the base strategy interface. The interface makes them
// interchangeable in the context.
class Sedex implements ShippingService {
    function calculate(float $weight): float {
        $correios = new \Correios();
        $totalCost = $correios->calculateShipping("SEDEX", $weight);
        return $totalCost;
    }
}

class PAC implements ShippingService {
    function calculate(float $weight): float {
        $correios = new \Correios();
        $totalCost = $correios->calculateShipping("PAC", $weight);
        return $totalCost;
    }
}

class JadLog implements ShippingService {
    function calculate(float $weight): float {
        return  calculateJadLogShipping($weight);
    }
}

class DHL implements ShippingService {
    function calculate(float $weight): float {
        $dhl = new \DHL();
        $totalCost = $dhl->priceCalculator($weight);
        return $totalCost;
    }
}

class Fedex implements ShippingService {
    function calculate(float $weight): float {
        $dhl = new \DHL();
        $totalCost = $dhl->priceCalculator($weight);
        return $totalCost;
    }
}

class TNT implements ShippingService {
    function calculate(float $weight): float {
        $tnt = new \TNT();
        $totalCost = $tnt->shippingPriceCalculator("PAC", $weight);
        return $totalCost;
    }
}
class MercadoEnvio implements ShippingService {
    function calculate(float $weight): float {
        $tnt = new \MercadoEnvio();
        $totalCost = $tnt->calculate($weight);
        return $totalCost;
    }
}

// ---- Context ----
// The context defines the interface of interest to clients.
class Shipping {
    private $service;

    function __construct(ShippingService $service) {
        $this->service = $service;
    }

    public function calculate(float $weight) {
        $totalCost = $this->service->calculate($weight);
        return $totalCost;
    }

    function setService(ShippingService $service) {
        $this->service = $service;
    }
}
