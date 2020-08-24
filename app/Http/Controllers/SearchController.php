<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medidore;
use App\Transformadore;
use App\Proteccione;
use App\Search;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Validator;


class SearchController extends Controller   
{
    public $table = 'searchs';
    public $dataType;
    public $dataRowsAdd;
    public $dataRowsEdit;
    public $menu;
    public $menuItems;

    public function __construct()
    {
        $this->middleware('auth');
        $this->dataType = Voyager::model('DataType')->where('slug', '=', $this->table)->first();
        $this->dataRowsAdd = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['add', "=", 1]])->orderBy('order', 'asc')->get();
        $this->dataRowsEdit = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['edit', "=", 1]])->orderBy('order', 'asc')->get();

        $this->menu = Voyager::model('Menu')->where('name', '=', $this->dataType->name)->first();
        $this->menuItems = Voyager::model('MenuItem')->where('menu_id', '=', $this->menu->id)->orderBy('order', 'asc')->get();
    }

    public function index()
    {
        return view('bread.index', [
            'dataType' =>  $this->dataType,
            'menuItems' => $this->menuItems
        ]);
    }

    public function create()
    {
        return view('bread.create', [
            'dataType' => $this->dataType,
            'dataRows'=>$this->dataRowsAdd
        ]); 
    }

    public function store(Request $request)
    {
        // return $request;
        //----------------VALIDATIONS-----------------------------------------
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        // ]);
        // if ($validator->fails())
        // {
        //     return response()->json(['error'=>$validator->errors()]);
        // }
        //----------------VALIDATIONS --------------------------------------
           
        //------------------ REGISTRO-------------------------------------
        $data = new $this->dataType->model_name;
        $myrelationships = array();
        foreach ($this->dataRowsAdd as $key) {
            $aux =  $key->field;
         
            switch ($key->type) {
                case 'Traking':
                    $data->$aux = Auth::user()->id;
                    break;
                case 'image':
                    if($request->hasFile($aux)){
                        $image=Storage::disk('public')->put($this->dataType->name.'/'.date('F').date('Y'), $request->file($aux));
                        $data->$aux = $image;
                    }
                    break;
                case 'multiple_images':
                    $image_array = array();
                    if($request->hasFile($aux)){
                        foreach($request->file($aux) as $image)
                        {
                            $array = Storage::disk('public')->put($this->dataType->name.'/'.date('F').date('Y'), $image);
                            array_push($image_array, $array);
                        }
                        // return $image_array;
                        $data->$aux = json_encode($image_array);
                    }
                    break;    
                case 'relationship':
                    if ($key->details->{'type'} == 'belongsToMany') {
                        if ($request->$aux) {
                            array_push($myrelationships, array($aux => $request->$aux));
                        }
                    }
                    break;
                case 'checkbox':
                    $data->$aux = $request->$aux ? 1 : 0;
                    break;  
                case 'rich_text_box':
                    $data->$aux = htmlspecialchars($request->$aux);
                    break; 
                case 'Slug':
                    $myslug = $key->details->slugify->{'origin'};
                    $data->$aux = Str::slug($request->$myslug);
                    break; 
                case 'select_multiple':
                        $data->$aux = json_encode($request->$aux);
                    break;
                default:
                    $data->$aux = $request->$aux;
                    break;
            }
        }
        $data->save();
        if ($myrelationships) {
            foreach ($myrelationships as $key => $valor) {
                $mydata = Voyager::model('DataRow')->where('field', "=", array_key_first($valor))->first();
                $mycolumn = $mydata->details->attributes->{'column'};
                $mykey = $mydata->details->attributes->{'key'};
                // return array_values($valor)[0];
                foreach (array_values($valor)[0] as $item => $value) {
                    $mymodel = new $mydata->details->attributes->{'model'};
                    $mymodel->$mycolumn = $data->id;
                    $mymodel->$mykey = $value;
                    $mymodel->save();
                }
            }
         }
        // --------------------------REGISTRO ---------------------------------------------------
        return $this->show();
    }

    public function show($id = null)
    {
        $dataTypeContent = $this->dataType->model_name::orderBy($this->dataType->details->{'order_column'}, $this->dataType->details->{'order_direction'})->paginate(setting('admin.pagination')); 
        return view('bread.show', [
            'dataType' =>  $this->dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

    public function edit($id)
    {
        $data = $this->dataType->model_name::find($id);
        return view('bread.edit', [
            'dataType' => $this->dataType,
            'dataRows'=> $this->dataRowsEdit,
            'data' => $data
        ]); 
    }

    public function update(Request $request, $id)
    {
        //----------------VALIDATIONS-----------------------------------------
        // $validator = Validator::make($request->all(), [
        //     'attribute' => 'required',
        // ]);
        // if ($validator->fails())
        // {
        //     return response()->json(['error'=>$validator->errors()]);
        // }
        //--------------------------------------------------------------------

        $data = $this->dataType->model_name::find($id);
        $myrelationships = array();
        foreach ($this->dataRowsEdit as $key) {
            $aux =  $key->field;
            switch ($key->type) {
                case 'Traking':
                    $data->$aux = Auth::user()->id;
                    break;
                case 'image':
                    if($request->hasFile($aux)){
                        $image=Storage::disk('public')->put($this->dataType->name.'/'.date('F').date('Y'), $request->file($aux));
                        $data->$aux = $image;
                    }
                    break;
                case 'multiple_images':
                    $image_array = array();
                    if($request->hasFile($aux)){
                        foreach($request->file($aux) as $image)
                        {
                            $array = Storage::disk('public')->put($this->dataType->name.'/'.date('F').date('Y'), $image);
                            array_push($image_array, $array);
                        }
                        $data->$aux = json_encode($image_array);
                    }
                    break;
                case 'relationship':
                    if ($key->details->{'type'} == 'belongsToMany') {
                        if ($request->$aux) {
                            array_push($myrelationships, array($aux => $request->$aux));
                        }
                    }
                    break;
                case 'checkbox':
                    $data->$aux = $request->$aux ? 1 : 0;
                    break;  
                case 'rich_text_box':
                    $data->$aux = htmlspecialchars($request->$aux);
                    break; 
                case 'Slug':
                    $myslug = $key->details->slugify->{'origin'};
                    $data->$aux = Str::slug($request->$myslug);
                    break; 
                case 'select_multiple':
                    $data->$aux = json_encode($request->$aux);
                break; 
                default:
                    $data->$aux = $request->$aux;
                    break;
            }
        }
        $data->save();
        if ($myrelationships) {
            foreach ($myrelationships as $key => $valor) {
                $mydata = Voyager::model('DataRow')->where('field', "=", array_key_first($valor))->first();
                $mycolumn = $mydata->details->attributes->{'column'};
                $mykey = $mydata->details->attributes->{'key'};
                
                $mydata->details->attributes->{'model'}::where($mydata->details->attributes->{'column'}, $data->id)->delete();

                foreach (array_values($valor)[0] as $item => $value) {
                    $mymodel = new $mydata->details->attributes->{'model'};
                    $mymodel->$mycolumn = $data->id;
                    $mymodel->$mykey = $value;
                    $mymodel->save();
                }
            }
         }
        return $this->show();
    }

    public function main_image(Request $request){
        $product = Search::find($request->id);
        $new_order = [];
        array_push($new_order, $request->image);
        foreach (json_decode($product->images) as $image) {
            if($image != $request->image){
                array_push($new_order, $image);
            }
        }
        $product->images = json_encode($new_order);
        $product->save();
        if($product){
            return 1;
        }
        return 0;
    }

    public function destroy($id)
    {
        $data = $this->dataType->model_name::find($id)->delete();
        return $this->show();
    }



    // --------------- AJAX-----------------------
    function search_first($search)
    {
        
        Search::create([
            'type' => 'search',
            'user_id' => Auth::user()->id,
            'search' => $search,
            'message' => null,
            'x' => null,
            'y' => null
        ]);

        $find = Medidore::where('codigo', $search)->first();
        if ($find) {
            return response()->json([
                'find' => $find,
                'table' => 'Medidores',
                'search' => $search
                ]);
        }else{
            $find = Transformadore::where('codigo', $search)->first();
            if($find){
                return response()->json([
                    'find' => $find,
                    'table' => 'Transformadores',
                    'search' => $search
                ]);
            }else{
                $find = Proteccione::where('codigo', $search)->first();
                if ($find) {
                    return response()->json([
                        'find' => $find,
                        'table' => 'Protecciones',
                        'search' => $search
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Busqueda NO encontrada'
                    ]);
                }
            }
        }
    }

    public function save_obervation(Request $request){

        

        $data = Search::create([
            'type' => 'observation',
            'user_id' => Auth::user()->id,
            'search' => $request->search,
            'message' => $request->message
        ]);

        return response()->json([
            'data' => $data
        ]);
        
    }
}
