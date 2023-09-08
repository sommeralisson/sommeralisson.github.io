<?php
  session_start();

  $sTemplateHtml = file_get_contents('./home.html');

  if (isset($_SESSION['msg'])) {
    $aSession = explode(',', $_SESSION['msg']);
  }

  $sTable = sprintf(
    '<h1 style="display:%s;color:%s;">A soma é: %s</h1>'
    , isset($_SESSION['msg']) ? 'block' : 'none'
    , isset($_SESSION['msg']) ? $aSession[0] : ''
    , isset($_SESSION['msg']) ? $aSession[1] : ''
  );

  $aValores = [
    'SOMA' => $sTable
  ];

  foreach ($aValores as $sChave => $sValor) {
    $sTemplate = str_replace('{{' . $sChave . '}}', $sValor, $sTemplateHtml);
  }

  echo $sTemplate;
  unset($_SESSION['msg']);

  if ($_POST) {
    $aDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $iSoma = array_sum($aDados);

    if ($aDados['val1'] > 10) {
      $sColor = 'blue';
    } else if ($aDados['val2'] < $aDados['val3']) {
      $sColor = 'green';
    } else if ($aDados['val3'] < $aDados['val1'] && $aDados['val3'] < $aDados['val2']) {
      $sColor = 'red';
    }

    $_SESSION['msg'] = sprintf(
      '%s,%s'
      , $sColor
      , $iSoma
    );

    header('Location: ./php_01');
  }
?>