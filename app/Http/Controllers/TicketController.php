<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'estado' => 'required|min:1',
                'usuario_id' => 'required|min:1',
            ]);

            $user = Ticket::create([
                'usuario_id' => $request->usuario_id,
                'estado' => $request->estado,
            ]);

            return response()->json([
                'message' => 'Ticket Generado correctamente',
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ha ocurrido un error',
                'error' => $th
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return $ticket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        try {
            $this->validate($request, [
                'usuario_id' => 'required|min:1',
                'estado' => 'required|min:1',
            ]);

            $ticket->update([
                'usuario_id' => $request->usuario_id,
                'estado' => $request->estado,
            ]);

            return response()->json([
                'message' => 'Ticket Actualizado correctamente',
                'user' => $ticket,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ha ocurrido un error',
                'error' => $th,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        try {
            $ticket->delete();
            return response()->json([
                'message' => 'Ticket Eliminado Correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ha ocurrido un error',
                'error' => $th,
            ]);
        }
    }

    public function restore($id)
    {
        try {
            $ticket = Ticket::where('id', $id)->withTrashed()->first();
            $ticket->restore();
            return response()->json([
                'message' => 'Ticket Restaurado Correctamente',
                'ticket' => $ticket,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ha ocurrido un error',
                'error' => $th,
            ]);
        }
    }
}
