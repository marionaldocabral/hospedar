<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restricao;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class RestricaoController.
 *
 * @author  The scaffold-interface created at 2018-07-15 06:55:21pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class RestricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $title = 'Index - restricao';
        $restricaos = Restricao::paginate(6);
        return view('restricao.index',compact('restricaos','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - restricao';
        
        return view('restricao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restricao = new Restricao();

        
        $restricao->hospede_id = $request->hospede_id;

        
        $restricao->tipo = $request->tipo;

        
        
        $restricao->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new restricao has been created !!']);

        return redirect('restricao');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - restricao';

        if($request->ajax())
        {
            return URL::to('restricao/'.$id);
        }

        $restricao = Restricao::findOrfail($id);
        return view('restricao.show',compact('title','restricao'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - restricao';
        if($request->ajax())
        {
            return URL::to('restricao/'. $id . '/edit');
        }

        
        $restricao = Restricao::findOrfail($id);
        return view('restricao.edit',compact('title','restricao'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $restricao = Restricao::findOrfail($id);
    	
        $restricao->hospede_id = $request->hospede_id;
        
        $restricao->tipo = $request->tipo;
        
        
        $restricao->save();

        return redirect('restricao');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/restricao/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$restricao = Restricao::findOrfail($id);
     	$restricao->delete();
        return URL::to('restricao');
    }
}
