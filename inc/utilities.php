<?php

function wsp_formatta($numero)
{
    if ($numero) {
        return number_format(($numero/100),2, ',', '.');
    }
    return false;
}

function wsp_get_json( $codiceente, $tipo )
{
    $json = file_get_contents( plugins_url( 'media/codici_ente.json', __FILE__ ) );
    $data = json_decode($json);
    foreach($data as $item)
    {
        if ($item->codice_ente == $codiceente)
        {
            switch($tipo) {

                case 'nome':
                    return $item->descrizione_ente;
                    break;

                case 'abitanti':
                    return $item->numero_abitanti;
                    break;
            }
        }
    }
}

?>
