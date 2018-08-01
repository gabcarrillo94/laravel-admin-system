<?php

namespace App\Http\Controllers;

use App\Data;
use App\User;
use App\DataPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth:api');
    }*/
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('data.index')
                        ->with('users', User::where('type', '=', 'USER')->get());
    }
    
    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function users($id)
    {
        $user = User::find( $id );
        $history = $user->data;
        $data = $history->where('calculation_date', '=', date('Y-m-d'))->first();
        
        if($data==null)
            $data = new Data();
        
        return view('data.users')
                    ->with(['data' => $data, 'history' => $history, 'user' => $user]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function photo(Request $request)
    {
        $history = User::find( Auth::user()->id )->data;
        $data = $history->where('calculation_date', '=', date('Y-m-d'))->first();
        
        if($data==null)
            $data = new Data();
        
        return view('data.photo')
                    ->with(['data' => $data, 'history' => $history]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadPhotos(Request $request)
    {
        if($request->clean!==null) {
            $history = User::find( Auth::user()->id )->data;
            $data = $history->where('calculation_date', '=', date('Y-m-d'))->first();
            
            if($data!=null) {
                foreach($data->photos as $photo){
                    $photo->delete();
                }
                
                $data = $history->where('calculation_date', '=', date('Y-m-d'))->first();
            }
            else {
                $data = new Data();
            }
            
            return view('data.photo')
                        ->with(['data' => $data, 'history' => $history]);
        }
        else {
            if($request->hasfile('images')) {
                $this->validate($request,
                                ['images' => 'required',
                                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
                
                $input=$request->all();
                $images=array();
                $data = User::find( Auth::user()->id )->data->where('calculation_date', '=', date('Y-m-d'))->first();
                    
                if($data==null) {
                    $data = new Data();
                    $data->user_id = Auth::user()->id;
                    $data->calculation_date = date("Y-m-d H:i:s");
                    $data->save();
                }
            
                // Delete Photos before create the new ones.
                foreach($data->photos as $photo){
                    $photo->delete();
                }
                
                // Create de new Photos
                foreach($request->file('images') as $file){
                    $filename = $file->store('public/photos');
                    DataPhoto::create([
                        'data_id' => $data->id,
                        'filename' => $filename
                    ]);
                }
                
                return redirect()
                        ->route('home',
                                    ['success' => 'Fotos guardadas. ¡Muchas Gracias!']
                                );
            }
            else {
                return redirect()
                        ->route('home',
                                    ['error' => 'Error guardando las imágenes, intente nuevamente']
                                );
            }
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if($request==null
           || ($request->sInterest==null && $request->sProgram==null)
           || ($request->sInterest=='N/A' && $request->sProgram=='N/A'))
            $data['data'] = Data::all();
            
        else if($request->sInterest=='N/A')
            $data['data'] = Data::where('multi_program', 'like', '%'.$request->sProgram.'%')->get();
            
        else if($request->sProgram=='N/A')
            $data['data'] = Data::where('multi_interest', 'like', '%'.$request->sInterest.'%')->get();
            
        else
            $data['data'] = Data::where('multi_program', 'like', '%'.$request->sProgram.'%')->where('multi_interest', 'like', '%'.$request->sInterest.'%')->get();
        
        return view('data.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Search in Measure Historial.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        if($request->dateSearch!=null) {
            if($request->user_id!=0) {
                $user = User::find( $request->user_id );
                $history = $user->data;
                $data = $history->where('calculation_date', '=', $request->dateSearch)->first();
                
                if($data==null)
                    $data = new Data();
                
                return view('data.users')
                            ->with(['data' => $data, 'history' => $history, 'user' => $user]);
            }
            else {
                $history = User::find( Auth::user()->id )->data;
                $data = $history->where('calculation_date', '=', $request->dateSearch)->first();
                
                if($data==null)
                    $data = new Data();
                
                $searchMessage = 'IMPORTANTE: Estas viendo tus medidas para la fecha '.$request->dateSearch.' si escribes nuevas medidas estarás almacenando estas medidas en la fecha del día actual';
                
                return view('home')
                            ->with(['data' => $data, 'history' => $history, 'error' => $searchMessage]);
            }
        }
        else {
            return redirect()->back();
        }
    }
        
    /**
     * Body Fat Calculator.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculator(Request $request)
    {
        if($request->chest==null ||
           $request->abdominal==null ||
           $request->thigh==null ||
           $request->bicep==null ||
           $request->tricep==null ||
           $request->subscapular==null ||
           $request->suprailiac==null ||
           $request->lower_back==null ||
           $request->midaxillary==null ||
           $request->neck==null ||
           $request->bodyweight==null ||
           $request->waist==null ||
           $request->hips==null ||
           $request->height==null ||
           $request->calf==null)
        {
            $req = 'Required Fields';
            
            if($request->chest==null)
                $req = 'Required Chest';
            else if($request->abdominal==null)
                $req = 'Required Abdominal';
            else if($request->thigh==null)
                $req = 'Required Thigh';
            else if($request->bicep==null)
                $req = 'Required Bicep';
            else if($request->tricep==null)
                $req = 'Required Tricep';
            else if($request->subscapular==null)
                $req = 'Required Subscapular';
            else if($request->suprailiac==null)
                $req = 'Required Suprailiac';
            else if($request->lower_back==null)
                $req = 'Required Lower Back';
            else if($request->calf==null)
                $req = 'Required Calf';
            else if($request->midaxillary==null)
                $req = 'Required Midaxillary';
            else if($request->neck==null)
                $req = 'Required Neck';
            else if($request->bodyweight==null)
                $req = 'Required Bodyweight';
            else if($request->waist==null)
                $req = 'Required Waist';
            else if($request->hips==null)
                $req = 'Required Hips';
            else if($request->height==null)
                $req = 'Required Height';
                
            return redirect()->back()->withInput()->with('error', $req);
        }
        else {
            $resp = 0;
            
            if($request->height_unit=='Mt') {
                $request->height = $request->height * 100;
            }
            else if($request->height_unit=='Ft') {
                $request->height = $request->height * 12;
            }
            
            if($request->metric_system=='IS') {
                $request->bodyweight = $request->bodyweight * 2.20462;
                $request->height = $request->height * 0.393701;
                $request->neck = $request->neck * 0.393701;
                $request->waist = $request->waist * 0.393701;
                $request->hips = $request->hips * 0.393701;
            }
            
            if($request->jp7!=null) {
                $resp = $this->jp7($request);
                $request['jp7'] = $resp;
            }
            else if($request->pcm!=null) {
                $resp = $this->pcm($request);
                $request['pcm'] = $resp;
            }
            else if($request->ntm!=null) {
                $resp = $this->ntm($request);
                $request['ntm'] = $resp;
            }
            
            $this->store($request);
            
            return redirect('home')->with('resp', $resp);
        }
    }
    
    /**
     * Jackson/Pollock 7 Caliper Method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jp7(Request $request)
    {
        /* Chest, Midaxillary, Tricep, Subscapular, Abdominal,
        * Suprailiac and Thigh.
        * Body Density = 1.112 – (0.00043499 x sum of skinfolds) + (0.00000055 x square of the sum of skinfold sites) – (0.00028826 x age)
        * Body Fat Percentage (%) = (495 / Body Density) – 450
        */
        
        if($request->chest==null ||
           $request->abdominal==null ||
           $request->thigh==null ||
           $request->tricep==null ||
           $request->subscapular==null ||
           $request->suprailiac==null ||
           $request->midaxillary==null)
        {
            return redirect()->back()->withInput()->with('error', 'Required Fields');
        }
        else {
            // explode the date to get month, day and year
            $birthDate = explode("-", Auth::user()->birthdate);
            // get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
              ? ((date("Y") - $birthDate[0]) - 1)
              : (date("Y") - $birthDate[0]));
            
            $sum = $request->chest +
                    $request->midaxillary + $request->tricep +
                        $request->subscapular + $request->abdominal +
                            $request->thigh;
            $square = pow($sum, 2);
            
            $bodyDensity = 0;
            
            if(Auth::user()->sex==='M')
                $bodyDensity = (
                    1.112 - (0.00043499 * $sum) +
                    (0.00000055 * $square) -
                    (0.00028826 * $age)
                );
            else
                $bodyDensity = (
                    1.097 - (0.00046971 * $sum) +
                    (0.00000056 * $square) -
                    (0.00012828 * $age)
                );
            
            $request['jp7'] = (495 / $bodyDensity) - 450;
            
            $this->store($request);
            
            return redirect('home')
                        ->with(
                               ['resp_jp7' => $request['jp7'],
                                'success' => '¡Medidas Calculadas y Enviadas Satisfactoriamente!']
                               );
        }
    }
    
    /**
     * Parrillo Caliper Method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pcm(Request $request)
    {
        /* Chest, Abdominal, Thigh, Bicep, Tricep, Subscapular,
        * Suprailiac, Lower Back and Calf.
        * Body Fat Percentage (%) = (27 x sum of skinfolds sites) divided by bodyweight (lbs)
        */
        
        if($request->chest==null ||
           $request->abdominal==null ||
           $request->thigh==null ||
           $request->bicep==null ||
           $request->tricep==null ||
           $request->subscapular==null ||
           $request->suprailiac==null ||
           $request->lower_back==null ||
           $request->bodyweight==null ||
           $request->calf==null)
        {
            return redirect()->back()->withInput()->with('error', 'Required Fields');
        }
        else {
            if($request->metric_system=='IS') {
                $request->bodyweight = $request->bodyweight * 2.20462;
            }
            
            $sum = $request->chest +
                $request->abdominal + $request->thigh +
                    $request->bicep + $request->tricep +
                        $request->subscapular + $request->bicep +
                            $request->suprailiac + $request->calf +
                                $request->lower_back;
        
            $request['pcm'] = (27 * $sum) / $request->bodyweight;
            
            $this->store($request);
            
            return redirect('home')
                    ->with(
                        ['resp_pcm' => $request['pcm'],
                         'success' => '¡Medidas Calculadas y Enviadas Satisfactoriamente!']
                        );
        }
    }
    
    /**
     * Navy Tape Measure Method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ntm(Request $request)
    {
        if($request->height_integer==null ||
           $request->height_decimal==null ||
           $request->neck==null)
        {
            $req = 'Required Fields';
                
            return redirect()->back()->withInput()->with('error', $req);
        }
        else if(Auth::user()->sex==='M') {
            if($request->abdomen==null)
            {
                $req = 'Required Fields';
                return redirect()->back()->withInput()->with('error', $req);
            }
        }
        else{
            if($request->waist==null ||
                $request->hips==null)
            {
                $req = 'Required Fields';
                return redirect()->back()->withInput()->with('error', $req);
            }
        }
        
        $request->height = $request->height_integer.".".$request->height_decimal;
        
        if($request->height_unit=='Mt') {
            $request->height = $request->height * 100;
        }
        else if($request->height_unit=='Ft') {
            $request->height = $request->height * 12;
        }
        
        if($request->metric_system=='IS') {
            $request->height = $request->height * 0.393701;
            $request->neck = $request->neck * 0.393701;
            $request->waist = $request->waist * 0.393701;
            $request->hips = $request->hips * 0.393701;
        }
        
        if(Auth::user()->sex==='M')
            $request['ntm'] = (
                86.010 * log10($request->abdomen - $request->neck) -
                70.041 * log10($request->height) + 36.76
            );
        else
            $request['ntm'] = (
                163.205 * log10(($request->waist + $request->hip) - $request->neck) -
                97.684 * log10($request->height) - 78.387
            );
            
        $this->store($request);
        
        return redirect('home')
                    ->with(
                        ['resp_ntm' => $request['ntm'],
                         'success' => '¡Medidas Calculadas y Enviadas Satisfactoriamente!']
                        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = User::find( Auth::user()->id )->data->where('calculation_date', '=', date('Y-m-d'))->first();
            
        if($data==null)
            $data = new Data();
        
        $data->user_id = Auth::user()->id;
        $data->metric_system = $request['metric_system'] ?? $data->metric_system ?? "IS";
        $data->chest = $request['chest'] ?? $data->chest ?? 0;
        $data->abdominal = $request['abdominal'] ?? $data->abdominal ?? 0;
        $data->thigh = $request['thigh'] ?? $data->thigh ?? 0;
        $data->bicep = $request['bicep'] ?? $data->bicep ?? 0;
        $data->tricep = $request['tricep'] ?? $data->tricep ?? 0;
        $data->subscapular = $request['subscapular'] ?? $data->subscapular ?? 0;
        $data->suprailiac = $request['suprailiac'] ?? $data->suprailiac ?? 0;
        $data->lower_back = $request['lower_back'] ?? $data->lower_back ?? 0;
        $data->midaxillary = $request['midaxillary'] ?? $data->midaxillary ?? 0;
        $data->neck = $request['neck'] ?? $data->neck ?? 0;
        $data->bodyweight = $request['bodyweight'] ?? $data->bodyweight ?? 0;
        $data->waist = $request['waist'] ?? $data->waist ?? 0;
        $data->hips = $request['hips'] ?? $data->hips ?? 0;
        $data->calf = $request['calf'] ?? $data->calf ?? 0;
        $data->abdomen = $request['abdomen'] ?? $data->abdomen ?? 0;
        $data->height_integer = $request['height_integer'] ?? $data->height_integer ?? 0;
        $data->height_decimal = $request['height_decimal'] ?? $data->height_decimal ?? 0;
        $data->jp7 = $request['jp7'] ?? $data->jp7 ?? 0;
        $data->pcm = $request['pcm'] ?? $data->pcm ?? 0;
        $data->ntm = $request['ntm'] ?? $data->ntm ?? 0;
        $data->calculation_date = date("Y-m-d H:i:s");
        
        return $data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Data $data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Data::destroy($id);
        
        $data['data'] = Data::all();
        return view('data.index', $data);
    }
}
