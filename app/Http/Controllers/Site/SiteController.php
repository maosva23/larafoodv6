<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $plans = Plan::with('details')->orderBy('price', 'ASC')->get();
        return view('site.page.home.index', compact('plans'));
    }

    //Recupera o plano atraves da sessao
    public function plan($url)
    {
        if (!$plan = Plan::where('url', $url)->first()){//recupera o plano atraves da seleção da home do site
            return redirect()->back();//Se não encontrou retorna
        }
        session()->put('plan', $plan);//se encontrou cria a sessão e recebe o plano selecionado

        return redirect()->route('register'); //tudo certo manda para o formulario register para adicionar nova instancia
    }
}
