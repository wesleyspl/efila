<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\QueueHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   /*
      modificado login para redicionar para a rota de atendentecx    
   */


    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        $pessoa=QueueHelper::UserLogin($user->pessoa_id);
       // dd($pessoa);
         // Salvar o array $pessoa na sessão
         $request->session()->put('pessoa', $pessoa);
        if($user->perfil_id==1){
            return redirect()->route('atendente.painel');
        }else{
            return redirect()->intended(route('/', absolute: false));

        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
