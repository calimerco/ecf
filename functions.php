<?php
function debug($variable)
{
    echo '<pre>'. print_r($variable, true) . '</pre>';
}

// generer une chaine de caractere d'une certaine longueur $length


function str_random($length)
{
    // stocker toutes les lettres et chiffres du clavier
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

    // multiplier par 60 = $length
    // str_repeat($alphabet, $length);

    // melanger le str_repeat
    // str_shuffle(str_repeat($alphabet, $length));

    // retourner le resultat mais limiter le nombre de caractere entre 0 et $length
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);


}
// ne pas fermer php