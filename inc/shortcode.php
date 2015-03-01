<?php

    extract(
        shortcode_atts(
            array(

                'anno' => '0', //0 = ultimo mese SIOPE
                'ricerca' => '',
                'tabella' => '',

                'codicecomparto' => 'PRO',
                'codiceente' => '',
                'chi' => '',
                'cosa' => ''

            ), $atts
        )
    );

    if (!$codiceente && !$chi) { echo 'no data'; return false; }


    if (!$anno) { $anno = date("Y"); }
    if (!$chi) { $chi = 'del '. wsp_get_json( $codiceente, 'nome' ); }

    $array_sp = get_soldipubblici_array($codicecomparto, $codiceente, $cosa, false);

    foreach($array_sp->data as $item)
    {
        $sp_importo += $item->{'importo_'.$anno};
    }

    echo '<div style="margin:30px 0;width:100%;text-align:center;float:left;">';
    echo '<img style="border:none;" src="'. plugins_url( 'media/logo.png', __FILE__ ) .'"><br><br>';
    echo '<span style="
      font-weight: bold;
      color: #207090;
      font-size: 4.2em;
      line-height: 1em;
      padding: 0;
      margin: 0;
  ">€ '.wsp_formatta($sp_importo).'</span>';
    echo '<span style="
        opacity: 0.6;
      font-size: 1.4em;
      display: block;
      text-transform: uppercase;
  ">€ '.wsp_formatta($sp_importo/wsp_get_json( $codiceente, 'abitanti' )).' PRO CAPITE</span>';
    echo '<span style="
        font-weight: lighter;
        font-size: 1.5em;
        ">Sono i pagamenti '.$chi.'<br><small>da gennaio '.$anno.' ad oggi<br><br>
        <small><a style="font-weight:bold;text-decoration:none;" href="http://soldipubblici.gov.it" title="Soldi Pubblici" target="_blank">www.soldipubblici.gov.it</a></small></small></span>';
    echo '</div>';

    if ( $tabella )
    {
        echo '<table style="width:100%">';
        echo '<tr><td>Descrizione</td><td>SIOPE</td><td>Liquidazione AC</td></tr>';

        foreach($array_sp->data as $item)
        { //importo_2015

            if ( $item->{'importo_'.$anno} > 0 )
            {
                echo '<tr>';
                echo '<td>'.$item->descrizione_codice.'</td>';
                echo '<td>'.$item->codice_siope.'</td>';
                echo '<td>'.wsp_formatta($item->{'importo_'.$anno}).'</td>';
                // $item->importo_{$anno}
                echo '</tr>';
            }

        }
        echo '</table>';
    }

    echo '<span style="
        font-weight: lighter;
        border-top: 1px solid #207090;
        width:90%;
        float:left;
        text-align:center;
  "></span>';
?>
