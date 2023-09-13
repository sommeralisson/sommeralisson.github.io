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
    $aDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $aMercado = [
        'maca'      => $aDados['maca']      * 2.2
      , 'melancia'  => $aDados['melancia']  * 2.2
      , 'laranja'   => $aDados['laranja']   * 3.1
      , 'repolho'   => $aDados['repolho']   * 3.3
      , 'cenoura'   => $aDados['cenoura']   * 1.1
      , 'batatinha' => $aDados['batatinha'] * 2.1
    ];

    $iMercadoSoma = array_sum($aMercado);
    $iDinheiro = 50;

    if ($iDinheiro < $iMercadoSoma) {
      $_SESSION['msg'] = '<h2 style="color:red">O valor da compra está acima de 50 reais.</h2>';
    } else if ($iDinheiro > $iMercadoSoma) {
      $_SESSION['msg'] = sprintf(
        '<h2 style="color:blue">Após a compra, joão ainda possui saldo de %s.</h2>'
        , ($iDinheiro - $iMercadoSoma)
      );
    } else {
      $_SESSION['msg'] = '<h2 style="color:green">O saldo foi esgotado.</h2>';
    }

    header('Location: ./php_06');
  }
?>