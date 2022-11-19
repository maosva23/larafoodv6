<?php

/**
 * Funcao que formata a data para dia/mes/ano recebendo como
 * parametro o valor e o formato da data utilizando a funcao parse()
 * do Carbon
 */
function formatDateAndTime($value, $format = 'd/m/Y')
{
    return \Illuminate\Support\Carbon::parse($value)->format($format);
}

function formatAno($value, $format = 'yyyy')
{
    return \Illuminate\Support\Carbon::parse($value)->format($format);
}
