<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::where('user_id', Auth::id())->get();
        return view('modules.index', ['modules' => $modules]);
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
