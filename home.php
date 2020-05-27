<?php
#reflection (отражение)

function foo1 ($a, $b, $c ) {}
function foo2 (Exception $a, $b, $c ) {}
function foo3 (ReflectionFunction $a, $b = 1, $c = null ) {}
function foo4 () {}

$reflect = new ReflectionFunction ("foo1");
echo $reflect . "<br><br>";
var_export($reflect);
echo "<br><br>";


foreach ($reflect->getParameters() as $key => $value) {
    printf (
        "-- параметр #%d: %s {\n<br>".
        "допускать NULL: %s\n<br>".
        "передан по ссылке: %s\n<br>".
        "обязательный: %s\n<br>".
        "}\n<br>",
        $key,
        $value->getName(),
        var_export ($value->allowsNull (), 1),
        var_export ($value->isPassedByReference (), 1),
        $value->isOptional () ? "нет" : "да"
    ) ;
}
