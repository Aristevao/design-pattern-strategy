<?php

include_once "services/shipping.php";

// ---- Client ----
// The client code picks a concrete strategy and passes it to
// the context. The client should be aware of the differences
// between strategies in order to make the right choice.
$sedex = new \Services\Sedex();
$dhl = new \Services\DHL();
$me = new \Services\MercadoEnvio();

$shipping = new \Services\Shipping($sedex); // Pick SEDEX by constructor.
echo $shipping->calculate(10);

$shipping->setService($dhl); // Pick DHL by setter.
echo '<br>' . $shipping->calculate(10);

$shipping->setService($me);
echo '<br>' . $shipping->calculate(10);
