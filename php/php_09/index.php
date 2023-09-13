<?php
  session_start();

  $sTemplate = file_get_contents('./home.html');

  if (isset($_SESSION['msg'])) {
    $sTable = $_SESSION['msg'];
  }

  $aValores = [
    'VALOR' => isset($sTable) ? $sTable : ''
  ];

  foreach ($aValores as $sChave => $sValor) {
    $sTemplate = str_replace('{{' . $sChave . '}}', $sValor, $sTemplate);
  }

  echo $sTemplate;
  unset($_SESSION['msg']);

  if ($_POST) {
    $nValorMoto = 8654;
    $iParcelas = [24, 36, 48, 60];
    $nJurosInicial = 2;
    $aParcelas = [];

    foreach ($iParcelas as $key => $value) {
      $aParcelas[$value] = sprintf(
        '<p>A parcela em %s fica R$%s</p>'
        , $value
        , number_format(($nValorMoto * $nJurosInicial), 2, ',', '.')
      );

      $nJurosInicial += 0.3;
    }

    // JUROS COMPOSTOS
    $nMontante = 0;
    $nCapitalInicial = 4000;
    $nTaxaJuros = (4 / 100);
    $iTempo = 5; //meses

    $nMontante = intval($nCapitalInicial * pow((1 + $nTaxaJuros), $iTempo));
    $iJuros = $nMontante - $nCapitalInicial;

    // JUROS SIMPLES
    $nJurosSimples = $nCapitalInicial * $nTaxaJuros * $iTempo;
    $nMontanteSimples = $nCapitalInicial + intval($nJurosSimples);
    $iJurosSimples = $nMontanteSimples - $nCapitalInicial;

    $nDiferencaJuros = $iJuros - $iJurosSimples;

    $aParcelas[] = sprintf(
      'Empréstimo de fernando<br>Juros compostos: %s <br>Juros simples: %s'
      , number_format($nMontante, 2, ',', '.')
      , number_format($nMontanteSimples, 2, ',', '.')
    );

    $_SESSION['msg'] = implode(' ', $aParcelas);

    header('Location: ./php_09');
  }
?>