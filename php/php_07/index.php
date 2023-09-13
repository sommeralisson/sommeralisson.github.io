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
    $nValorCarro = 22500;
    $iParcelas = 60;
    $nValorParcela = 489.65;

    $nValorTotalComJuros = $iParcelas * $nValorParcela;
    $nDiferencaValor = $nValorTotalComJuros - $nValorCarro;

    $sHtml = '
      <h2>Valor do carro à vista: %s</h2>
      <h2>Parcelas: %s</h2>
      <h2>Valor da parcela: %s</h2>
      <h2>Valor total com juros: %s</h2>
      <h2>Diferença de valor: %s</h2>
    ';

    $_SESSION['msg'] = sprintf(
      $sHtml
      , number_format($nValorCarro,2,",",".")
      , $iParcelas
      , number_format($nValorParcela,2,",",".")
      , number_format($nValorTotalComJuros,2,",",".")
      , number_format($nDiferencaValor,2,",",".")
    );

    header('Location: ./php_07');
  }
?>