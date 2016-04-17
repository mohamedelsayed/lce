<?php
class XmlExcelHelper extends AppHelper {
    var $data;
    var $header;
    var $rows;
    var $title;
    var $sheetName;
    var $columnsWidth;
    var $columns;
    var $xls;
    
    function generate(&$data, $title, &$columnWidth=null){
        $this->data =& $data;
        $this->columnsWidth = & $columnWidth;
        $this->sheetName = $title;
        $this->title = '<Cell ss:StyleID="s16"><Data ss:Type="String">'.$title.'</Data></Cell>';
        $this->setHeader();
        if (isset($this->columnsWidth))
            $this->setColumWidth();
        $this->setRows();
        $this->getXML();
        header('Content-type: application/xml');
        header('Content-Disposition: attachment; filename="'.$this->sheetName.' - '.date("d M Y").'.xml"');
        echo $this->xls;
    }
    
    function setHeader(){
        foreach ($this->data as $row) {
            foreach ($row as $model){
                foreach ($model as $field => $value)
                    $this->header.='<Cell ss:StyleID="s17"><Data ss:Type="String">'.Inflector::humanize($field).'</Data></Cell>';
            }
            break;
        }
    }
    
    function setColumWidth(){
        foreach ($this->columnsWidth as $width){
            $this->columns.='<Column ss:Width="'.$width.'"/>';
        }
        $this->columns;
    }
    
    function setRows(){
        foreach ($this->data as $row) {
            $this->rows .='<Row>';
            foreach ($row as $model){
                foreach ($model as $field){
                    $this->rows .='<Cell><Data ss:Type="String">'.utf8_encode($field).'</Data></Cell>';
                }
            }
            $this->rows .='</Row>';
        }
    }
    
    function getXML(){
    $this->xls = '<?xml version="1.0"?>
    <?mso-application progid="Excel.Sheet"?>
    <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
     xmlns:o="urn:schemas-microsoft-com:office:office"
     xmlns:x="urn:schemas-microsoft-com:office:excel"
     xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
     xmlns:html="http://www.w3.org/TR/REC-html40">
     <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
      <Author>Makio</Author>
      <LastAuthor>Makio</LastAuthor>
      <Created>2010-09-17T19:39:08Z</Created>
      <LastSaved>2010-09-17T19:40:15Z</LastSaved>
      <Company>Makio</Company>
      <Version>14.00</Version>
     </DocumentProperties>
     <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
      <AllowPNG/>
     </OfficeDocumentSettings>
     <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
      <WindowHeight>8190</WindowHeight>
      <WindowWidth>13275</WindowWidth>
      <WindowTopX>240</WindowTopX>
      <WindowTopY>15</WindowTopY>
      <ProtectStructure>False</ProtectStructure>
      <ProtectWindows>False</ProtectWindows>
     </ExcelWorkbook>
     <Styles>
      <Style ss:ID="Default" ss:Name="Normal">
       <Alignment ss:Vertical="Bottom"/>
       <Borders/>
       <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
       <Interior/>
       <NumberFormat/>
       <Protection/>
      </Style>
      <Style ss:ID="s16">
       <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="26" ss:Color="#000000"
        ss:Bold="1"/>
      </Style>
      <Style ss:ID="s17">
       <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
        ss:Bold="1"/>
       <Interior ss:Color="#BFBFBF" ss:Pattern="Solid"/>
      </Style>
     </Styles>
     <Worksheet ss:Name="'.$this->sheetName.'"><Table>'.$this->columns.'
       <Row ss:Index="3" ss:Height="33.75">'.$this->title.'</Row><Row ss:Index="5">'.$this->header.'</Row>'.$this->rows.'</Table>
      <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
       <PageSetup>
        <Header x:Margin="0.3"/>
        <Footer x:Margin="0.3"/>
        <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
       </PageSetup>
       <Print>
        <ValidPrinterInfo/>
        <HorizontalResolution>600</HorizontalResolution>
        <VerticalResolution>0</VerticalResolution>
       </Print>
       <Selected/>
       <Panes>
        <Pane>
         <Number>3</Number>
         <ActiveRow>7</ActiveRow>
         <ActiveCol>4</ActiveCol>
        </Pane>
       </Panes>
       <ProtectObjects>False</ProtectObjects>
       <ProtectScenarios>False</ProtectScenarios>
      </WorksheetOptions>
     </Worksheet>
    </Workbook>';
    }

} 
?>