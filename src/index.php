<?php

include_once "services/frete.php";

// ---- Client ----
// The client code picks a concrete strategy and passes it to
// the context. The client should be aware of the differences
// between strategies in order to make the right choice.
$sedex = new \Services\Sedex();
$dhl = new \Services\DHL();
$me = new \Services\MercadoEnvio();

$frete = new \Services\Frete($sedex); // Pick SEDEX by constructor.
echo $frete->calcula(10);

$frete->setServico($dhl); // Pick DHL by setter.
echo '<br>' . $frete->calcula(10);

$frete->setServico($me);
echo '<br>' . $frete->calcula(10);
