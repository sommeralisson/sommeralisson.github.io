<?php

  $sTemplateHtml = file_get_contents('./table.html');

  $aMatriz = [];

  for ($iRow = 1; $iRow <= 10; $iRow++) {
    $aMatriz[$iRow][] = '<tr>';
    for ($iColumn = 0; $iColumn < 10; $iColumn++) {
      $aMatriz[$iRow][$iColumn] = sprintf(
        '<td>%s</td>'
        , rand(1, 1000)
      );
    }

    $aMatriz[$iRow][] = '</tr>';
  }

  $sMatrizString = fImplodeAll(" ", $aMatriz);

  function fImplodeAll($sSeparador, $aArray){
    if(is_array($aArray)){
      foreach($aArray as $sKey => $sValue){
        if(is_array($sValue)){
          $aArray[$sKey] = fImplodeAll($sSeparador, $sValue);
        }
      }

      return implode( $sSeparador, $aArray );
    }

    return $aArray;
  }

  $sTable = sprintf('
    <table>
      %s
    </table>
  '
  , $sMatrizString
  );

  $aValores = [
      'MATRIZ' => $sTable
  ];

  foreach ($aValores as $sChave => $sValor) {
      $sTemplate = str_replace('{{' . $sChave . '}}', $sValor, $sTemplateHtml);
  }

  echo $sTemplate;

?>