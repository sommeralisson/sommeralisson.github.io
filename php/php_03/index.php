<?php
  session_start();

  $sTemplateHtml = file_get_contents('./home.html');

  $sTable = sprintf(
    '<h3 style="display:%s">%s</h3>'
    , isset($_SESSION['msg']) ? 'block' : 'none'
    , isset($_SESSION['msg']) ? $_SESSION['msg'] : ''
  );

  $aValores = [
    'VALOR' => $sTable
  ];

  foreach ($aValores as $sChave => $sValor) {
    $sTemplate = str_replace('{{' . $sChave . '}}', $sValor, $sTemplateHtml);
  }

  echo $sTemplate;
  unset($_SESSION['msg']);

  if ($_POST) {
    $aDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $iArea = pow($aDados['val'], 2);

    $_SESSION['msg'] = sprintf(
      'A área do quadrado de lado %s metros é %s metros quadrados'
      , $aDados['val']
      , $iArea
    );


    header('Location: ./php_03');
  }
?>