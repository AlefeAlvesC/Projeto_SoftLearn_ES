<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index() 
    {
        $modulos = [
            [
                'id' => 1,
                'titulo' => 'Módulo 1: Fundamentos do Scrum',
                'descricao' => 'Aprenda os conceitos básicos, papéis e cerimônias do Scrum.',
                'aulas_total' => 5,
                'aulas_concluidas' => 2,
                'imagem_url' => 'https://via.placeholder.com/300x200.png/2c7a6c/ffffff?text=Scrum' 
            ],
            [
                'id' => 2,
                'titulo' => 'Módulo 2: Diagramas UML',
                'descricao' => 'Domine Casos de Uso, Diagramas de Classe e Sequência.',
                'aulas_total' => 8,
                'aulas_concluidas' => 0,
                'imagem_url' => 'https://via.placeholder.com/300x200.png/ef4444/ffffff?text=UML' 
            ],
            [
                'id' => 3,
                'titulo' => 'Módulo 3: Métodos Ágeis',
                'descricao' => 'Uma visão geral sobre Kanban, XP e outros métodos.',
                'aulas_total' => 4,
                'aulas_concluidas' => 4,
                'imagem_url' => 'https://via.placeholder.com/300x200.png/3b82f6/ffffff?text=Agile' 
            ],
        ];

        return view('aulas', [
            'modulos' => $modulos
        ]);
    }

    public function show($id) 
    {
        $moduloAtual = [
            'id' => $id,
            'titulo' => 'Módulo ' . $id . ': Título de Exemplo',
            'descricao' => 'Descrição detalhada do módulo ' . $id . '.'
        ];

        $syllabus = [
            ['id' => 1, 'titulo' => 'Módulo 1: Fundamentos do Scrum'],
            ['id' => 2, 'titulo' => 'Módulo 2: Diagramas UML'],
            ['id' => 3, 'titulo' => 'Módulo 3: Métodos Ágeis'],
        ];

        return view('aula-modulo', [
            'modulo'   => $moduloAtual, 
            'syllabus' => $syllabus     
        ]);
    }

    public function create()
    {
        return view('modules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $module = new Module();
        $module->nome = $request->nome;
        $module->descricao = $request->descricao;
        $module->user_id = Auth::id();
        $module->save();

        return redirect()->route('modules.index')->with('success', 'Módulo criado com sucesso!');
    }

    public function destroy(Module $module)
    {
        if ($module->user_id != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Módulo deletado com sucesso!');
    }
}
