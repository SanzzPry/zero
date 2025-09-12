<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Freeze;
use Illuminate\Http\Request;
use App\Services\User\UserService;

class FreezeController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('username', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('address_detail', 'like', '%' . $request->search . '%');
        }

        $users = $query->get();
        $user = $this->userService->getAllUser();


        return view('pages.super-admin.freeze.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);


        return view('pages.super-admin.freeze.banned', [
            'user' => $user,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Freeze $freeze)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Freeze $freeze)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freeze $freeze)
    {
        //
    }
}
