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
    $nJurosInicial = 1.5;
    $aParcelas = [];

    foreach ($iParcelas as $key => $value) {
      $aParcelas[$value] = sprintf(
        '<p>A parcela em %s fica R$%s</p>'
        , $value
        , number_format(($nValorMoto * $nJurosInicial), 2, ',', '.')
      );

      $nJurosInicial += 0.5;
    }

    $_SESSION['msg'] = implode(' ', $aParcelas);

    header('Location: ./php_08');
  }
?>