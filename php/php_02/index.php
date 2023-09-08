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

    if ($aDados['val'] % 2 == 0) {
      $_SESSION['msg'] = 'Valor divisível por 2';
    } else {
      $_SESSION['msg'] = 'Valor não é divisível por 2';
    }

    header('Location: ./php_02');
  }
?>