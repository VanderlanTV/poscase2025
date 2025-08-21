<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Controller;

use App\Models\CNFe55Model;
use App\Models\CadrecModel;
use App\Models\CVendaModel;
use App\Models\MVendaModel;
use App\Controllers\C_Finger;
use App\Controllers\C_Paramets;
use App\Controllers\C_CVendas;

use App\Models\FingerModel;
use App\Models\LFingerModel;
use App\Models\EntRecNFeModel;
use App\Models\EntRecNFeItens_M;

use App\Libraries\IntegraEstoque;

use CodeIgniter\HTTP\Files\UploadedFile;
use JsonSerializable;


class C_Estoque extends BaseController
{
    protected $osession;
    protected $CVendaModel;
    protected $CadrecModel;
    protected $EntRecNFeModel;
    protected $db;
    protected $Users;
    protected $IntegraEstoque;


    // "global" items

    public function __construct()
    {
        helper('form');
        helper('url');
        $this->EntRecNFeModel = new EntRecNFeModel();
        $db = db_connect();

        $this->osession = session();
        $this->Users = new Users();
    }

    public function cadRecStart($pCalledFrom = '')
    {
        // Called by    <li class="#"><a href="<?php echo site_url('C_Finger/fingerStart') ">Financeiro </a></li>
        //

        $C_Paramets = new C_Paramets();
        $C_Paramets->fSaveParamt('Redirect.cadreclist', 'C_Estoque:jsListdesrec', '', '', 'A');
        $C_Paramets->fSaveParamt('Redirect.cadreclist', 'C_cadrec:search_keyword', '', '', 'A');
        $C_CVendas = new C_CVendas();
        $CadrecModel = new CadrecModel();


        //Empty initialize array
        $data = array();
        $data = (array) null;
        $data['pCalledFrom'] = $pCalledFrom;
        $data['titulo'] = 'Cadastro dos produtos e serviços / actionPro.Cadrec';
        if ($pCalledFrom == 'cadpro') {  //        >Cadastro
            $titulo = 'Cadastro dos produtos e serviços /Cadastro';
            $data['viewIncludeDetail'] = 'Estoque/Cadrec/cadrecDetail.php';   //detail edit, insert, updat, delete view etc
            $data['divreportcadpro'] = 'reports/v_estoque/divreportcadpro.php';   //detail edit, insert, updat, delete view etc
            $data['cadrec_detail'] = $CadrecModel->getCadrecList('', '', '')->getResult('object');
            $data['cadrectable'] = 'Estoque/Cadrec/cadrectable.php'; //View específica para table com   <td contenteditable="true"> <php echo $fieldsdesrec ></td>
        }
        if ($pCalledFrom == 'estoqueInvent') {  //        >estoqueInvent
            $titulo =   'Cadastro dos produtos e serviços / Inventário';
            $data['cadrec_detail'] = $CadrecModel->getCadrecList('', '', '')->getResult('object');
            $data['viewIncludeDetail'] = 'Estoque/Cadrec/cadrecInvent.php';   //View específica módulo Edit on table
            $data['cadrectable'] = 'Estoque/Cadrec/cadrectable.php'; //View específica para table com   <td contenteditable="true"> <php echo $fieldsdesrec ></td>

        }
        if ($pCalledFrom == 'estoqueMinimo') {  //        >estoqueMinimo
            $titulo =  'Cadastro dos produtos e serviços / Estoque Mínimo';
            $data['cadrec_detail'] = $CadrecModel->getCadrecList('', '', '')->getResult('object');
            $data['viewIncludeDetail'] = 'Estoque/Cadrec/crecEMin.php';
            $data['cadrectable'] = 'Estoque/Cadrec/cadrectable.php'; //View específica para table com   <td contenteditable="true"> <php echo $fieldsdesrec ></td>
        }
        if ($pCalledFrom == 'estoqueCFOPCSTetc') {  //        >estoqueCFOPCSTetc
            $titulo =  'Cadastro dos produtos e serviços / NCM, CFOP, CST, CSOSN, ICMS, Códigos Fiscais, Aliquotas';
            $data['cadrec_detail'] = $CadrecModel->getCadrecList('', '', '')->getResult('object');
            $data['viewIncludeDetail'] = 'Estoque/Cadrec/cadrecInvent.php';
            $data['cadrectable'] = 'Estoque/Cadrec/cadrectable.php'; //View específica para table com   <td contenteditable="true"> <php echo $fieldsdesrec ></td>
        }
        if ($pCalledFrom == 'estoqueEmbPesoUns') {  //        >estoqueEmbPesoUns
            $titulo = 'Cadastro dos produtos e serviços / Embalagens, Pesos, Unidades';
            $data['cadrec_detail'] = $CadrecModel->getCadrecList('', '', '')->getResult('object');
            $data['viewIncludeDetail'] = 'Estoque/Cadrec/cadrecInvent.php';
            $data['cadrectable'] = 'Estoque/Cadrec/cadrectable.php'; //View específica para table com   <td contenteditable="true"> <php echo $fieldsdesrec ></td>
        }
        if ($pCalledFrom == 'estoqueGTIN') {  //        >estoqueGTIN
            $titulo = 'Cadastro dos produtos e serviços / Códigos de barras GTIN';
            $data['cadrec_detail'] = $CadrecModel->getCadrecList('', '', '')->getResult('object');

            $data['viewIncludeDetail'] = 'Estoque/Cadrec/cadrecGTIN.php';
            $data['cadrectable'] = 'Estoque/Cadrec/cadrectable.php'; //View específica para table com   <td contenteditable="true"> <php echo $fieldsdesrec ></td>
        }

        if ($pCalledFrom == 'estoqueValiadeLotes') {  //        >estoqueValiadeLotes
            $titulo = 'Cadastro dos produtos e serviços / Validades e Lotes';
            $data['cadrec_detail'] = $CadrecModel->getCadrecList('', '', '')->getResult('object');
            $data['viewIncludeDetail'] =  'Estoque/Cadrec/cadrecInvent.php';
            $data['cadrectable'] = 'Estoque/Cadrec/cadrectable.php'; //View específica para table com   <td contenteditable="true"> <php echo $fieldsdesrec ></td>
        }

        $data['titulo'] = $titulo;
        $data['ERP_Atividade_Emp']  = $C_Paramets->getParamt('__ERP_Atividade_Emp');
        $data['username']  = $this->Users->getSession();

        $data['NFe_tipo']  = '';

        $data['cadrec_id'] = ''; //$CadrecModel->getCadrecList('', '', '')->getResult('object');
        $data['cadrec_idcomp'] = ''; //$CadrecModel->getCadrec_compitem_id($id)->getResult('object');

        $data['listcfopitem'] = $C_Paramets->getparamt_listparamt('CFOPCSOSNICMS.');
        //print_r($data['listcfopitem']);
        //  dd();
        $data['listRecursos'] =  $C_Paramets->getparamt_listparamt('tiprec_ind.');
        if (empty($data['listRecursos'])) {
            $C_Paramets->ftiprec_ind();
            $data['listRecursos'] =  $C_Paramets->getparamt_listparamt('tiprec_ind.');
        }

        $data['listTipovend'] = $C_Paramets->getparamt_listparamt('tipovend');
        $data['listCodvend'] = $C_CVendas->get_listCodvend('');
        foreach ($data['listCodvend'] as $item) :
            $codvend = $item->codvend;
        endforeach;
        $data['codvend'] = $codvend;


        $data['getMarcarecList'] = $CadrecModel->getMarcarecList('')->getResult('object');

        //Categorias da Marca
        $listdatacatrec  =  $C_Paramets->listParamtsBY('SearchByClassParamet', '_CATREC');

        //Criar um alista de Unidade de medidas
        foreach ($listdatacatrec as $cell) {
            $ii =  count($cell);
        }

        $i = 0;
        foreach ($listdatacatrec as $cell) {
            while ($i <= $ii - 1) {
                // print_r($i);

                //                echo "<pre>";
                // print_r('</==========================');
                //               print_r($listdatacatrec['searchParamtsBY']->valparamt);
                //              echo "</pre>";

                $i++;
                // echo "</pre>";
            }
        }
        $data['listdatacatrec'] = $cell;


        $listdatasegrec  =  $C_Paramets->listParamtsBY('SearchByClassParamet', '_SegRec');

        //Criar um alista de Unidade de medidas
        foreach ($listdatasegrec as $cell) {
            $ii =  count($cell);
        }

        $i = 0;
        foreach ($listdatasegrec as $cell) {
            while ($i <= $ii - 1) {
                // print_r($i);

                //                echo "<pre>";
                // print_r('</==========================');
                //               print_r($listdatacatrec['searchParamtsBY']->valparamt);
                //              echo "</pre>";

                $i++;
                // echo "</pre>";
            }
        }
        $data['listdatasegrec'] = $cell;


        // Características Classe _CARACT
        $listdatacaractrec  =  $C_Paramets->listParamtsBY('SearchByClassParamet', '_CARACT');

        //Criar um alista de Unidade de medidas
        foreach ($listdatacaractrec as $cell) {
            $ii =  count($cell);
        }

        $i = 0;
        foreach ($listdatacaractrec as $cell) {
            while ($i <= $ii - 1) {
                // print_r($i);

                //                echo "<pre>";
                // print_r('</==========================');
                //               print_r($listdatacatrec['searchParamtsBY']->valparamt);
                //              echo "</pre>";

                $i++;
                // echo "</pre>";
            }
        }
        $data['listdatacaractrec'] = $cell;


        $data['listNCM'] = $C_Paramets->getparamt_listparamt('_NCM.');
        $data['listCest'] = $C_Paramets->getparamt_listparamt('_CEST.');
        $data['listCST'] = $C_Paramets->getparamt_listparamt('CST.');
        $data['listCSOSN'] = $C_Paramets->getparamt_listparamt('CSOSN.');
        $data['listCFOP'] = $C_Paramets->getparamt_listparamt('CFOP.');
        $data['listCFOPCSTCSOSN'] = $C_Paramets->getparamt_listparamt('CFOPCSOSNICMS.');

        $data['listCFOPCSTCSOSN'] = $C_Paramets->getparamt_listparamt('CFOPCSOSNICMS.');
        $data['listCFOPCSTCSOSN'] = $C_Paramets->getparamt_listparamt('CFOPCSOSNICMS.');

        $listCategoriaRest  =  $C_Paramets->listParamtsBY('SearchByClassParamet', '');
        //Criar um alista de Unidade de medidas
        foreach ($listCategoriaRest as $cell) {
            $ii =  count($cell);
        }

        $i = 0;
        foreach ($listCategoriaRest as $cell) {
            while ($i <= $ii - 1) {
                // print_r($i);

                //                echo "<pre>";
                // print_r('</==========================');
                //               print_r($listCategoriaRest['searchParamtsBY']->valparamt);
                //              echo "</pre>";

                $i++;
                // echo "</pre>";
            }
        }
        $data['listCategoriaRest'] = $cell;
        $data['categoriaRest'] = '';
        $data['RecNFe_idData'] = '';
        //dd($data);

        echo view('Estoque/Cadrec/cadrec.php', $data);
    }
}
