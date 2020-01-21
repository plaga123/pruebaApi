<?php

namespace App\Http\Controllers;

use App\cao_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaoUsuarioController extends Controller
{
    // - Listado de Consultores 

    public function index()
    {
        $sql = DB::select(DB::raw("SELECT u.co_usuario,u.no_usuario
        FROM cao_usuario as u inner join permissao_sistema as p on u.co_usuario = p.co_usuario
        where p.co_sistema=1 and p.in_ativo ='S' and (p.co_tipo_usuario=0 or p.co_tipo_usuario=1 or p.co_tipo_usuario=2)"));
        echo json_encode($sql);        
    }  

    public function ListarRelatorio(Request $request)
    {
        $mes1 = $request->input('mes1');
        $mes2 = $request->input('mes2');
        $year1 = $request->input('year1');
        $year2 = $request->input('year2');


        $user = $request->input('user');
        $query='';
        $cont=0;


       foreach ($user as $value) {
           
           if($cont==0){
               $query="(u.co_usuario="."'$value'";
            }else{
                $query=$query." or u.co_usuario="."'$value'";
            }
            $cont++;
       }         


        $sql = DB::select(DB::raw("SELECT u.no_usuario,os.co_usuario, sum(round((fa.valor - fa.total_imp_inc),2)) as Ganancias_Netas,
        sum(sa.brut_salario)as Costo_Fijo,sum(round(((fa.valor - (fa.valor * fa.total_imp_inc)*fa.comissao_cn))))as comision,month(fa.data_emissao)as mes,
        year(fa.data_emissao)as years,DATE_FORMAT(fa.data_emissao,'%b - %Y') AS fecha
        FROM cao_fatura as fa inner join cao_cliente as cl
        on cl.co_cliente = fa.co_cliente inner join cao_sistema as si 
        on si.co_sistema = fa.co_sistema inner join cao_os as os 
        on os.co_os = fa.co_os inner join cao_usuario as u
        on u.co_usuario = os.co_usuario inner join cao_salario as sa 
        on sa.co_usuario=u.co_usuario
        WHERE year(fa.data_emissao) between $year1 and $year2 and month(fa.data_emissao) between $mes1 and $mes2 and $query)
        group by u.no_usuario,os.co_usuario,month(fa.data_emissao),year(fa.data_emissao),fecha"));
        
        echo json_encode($sql);   

    }

    public function Total(Request $request)
    {
        $mes1 = $request->input('mes1');
        $mes2 = $request->input('mes2');
        $year1 = $request->input('year1');
        $year2 = $request->input('year2');


        $user = $request->input('user');
        $query='';
        $cont=0;


       foreach ($user as $value) {
           
           if($cont==0){
               $query="(u.co_usuario="."'$value'";
            }else{
                $query=$query." or u.co_usuario="."'$value'";
            }
            $cont++;
       } 
       
       $sql = DB::select(DB::raw("SELECT u.no_usuario,os.co_usuario, sum(round((fa.valor - fa.total_imp_inc),2)) as Ganancias_Netas,
       sum(sa.brut_salario)as Costo_Fijo,sum(round(((fa.valor - (fa.valor * fa.total_imp_inc)*fa.comissao_cn))))as comision        
       FROM cao_fatura as fa inner join cao_cliente as cl
       on cl.co_cliente = fa.co_cliente inner join cao_sistema as si 
       on si.co_sistema = fa.co_sistema inner join cao_os as os 
       on os.co_os = fa.co_os inner join cao_usuario as u
       on u.co_usuario = os.co_usuario inner join cao_salario as sa 
       on sa.co_usuario=u.co_usuario
       WHERE year(fa.data_emissao) between $year1 and $year2 and month(fa.data_emissao) between $mes1 and $mes2 and $query)
       group by u.no_usuario,os.co_usuario"));
       
       echo json_encode($sql);   
    }

    public function grafico(Request $request)
    {

        $mes1 = $request->input('mes1');
        $mes2 = $request->input('mes2');
        $year1 = $request->input('year1');
        $year2 = $request->input('year2');


        $user = $request->input('user');
        $query='';
        $cont=0;


       foreach ($user as $value) {
           
           if($cont==0){
               $query="(u.co_usuario="."'$value'";
            }else{
                $query=$query." or u.co_usuario="."'$value'";
            }
            $cont++;
       }         

        $sql = DB::select(DB::raw("SELECT u.no_usuario,os.co_usuario,month(fa.data_emissao)as mes,
        year(fa.data_emissao)as years,DATE_FORMAT(fa.data_emissao,'%b - %Y') AS fecha, round(sum(fa.valor - fa.total_imp_inc),2) as ganancias,
        sum(sa.brut_salario)as Costo_Fijo
        FROM cao_fatura as fa inner join cao_cliente as cl
        on cl.co_cliente = fa.co_cliente inner join cao_sistema as si 
        on si.co_sistema = fa.co_sistema inner join cao_os as os 
        on os.co_os = fa.co_os inner join cao_usuario as u
        on u.co_usuario = os.co_usuario inner join cao_salario as sa 
        on sa.co_usuario=u.co_usuario
        WHERE year(fa.data_emissao) between $year1 and $year2 and month(fa.data_emissao) between $mes1 and $mes2 and $query)
        group by u.no_usuario,os.co_usuario,month(fa.data_emissao),year(fa.data_emissao),fa.data_emissao
        order by fa.data_emissao"));

        echo json_encode($sql);   
    }


    public function Series(Request $request)
    {
        $mes1 = $request->input('mes1');
        $mes2 = $request->input('mes2');
        $year1 = $request->input('year1');
        $year2 = $request->input('year2');


        $user = $request->input('user');
        $query='';
        $cont=0;


       foreach ($user as $value) {
           
           if($cont==0){
               $query="(u.co_usuario="."'$value'";
            }else{
                $query=$query." or u.co_usuario="."'$value'";
            }
            $cont++;
       }         

        $sql = DB::select(DB::raw("SELECT DATE_FORMAT(fa.data_emissao,'%b - %Y') AS fecha
        FROM cao_fatura as fa inner join cao_cliente as cl
        on cl.co_cliente = fa.co_cliente inner join cao_sistema as si 
        on si.co_sistema = fa.co_sistema inner join cao_os as os 
        on os.co_os = fa.co_os inner join cao_usuario as u
        on u.co_usuario = os.co_usuario inner join cao_salario as sa 
        on sa.co_usuario=u.co_usuario
        WHERE year(fa.data_emissao) between $year1 and $year2 and month(fa.data_emissao) between $mes1 and $mes2
        group by fa.data_emissao
        order by fa.data_emissao"));

        echo json_encode($sql);   
    }  

}
