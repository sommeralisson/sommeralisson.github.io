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

    $iArea = $aDados['val1'] * $aDados['val2'];

    $_SESSION['msg'] = sprintf(
      '<%1$s>A área do retângulo de lados %2$s e %3$s metros é %4$s metros quadrados</%1$s>'
      , $iArea > 10 ? 'h1' : 'h3'
      , $aDados['val1']
      , $aDados['val2']
      , $iArea
    );

    header('Location: ./php_04');
  }
?>