<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpotRequest;
use App\Http\Requests\UpdateSpotRequest;
use App\Repositories\SpotRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Response;
use \Illuminate\Support\Facades\Storage;
use App\Models\Spot;
use Illuminate\Support\Facades\Log;

class SpotController extends AppBaseController
{
    /** @var  SpotRepository */
    private $spotRepository;

    public function __construct(SpotRepository $spotRepo)
    {
        $this->spotRepository = $spotRepo;
    }

    /**
     * Display a listing of the Spot.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $spots = $this->spotRepository->all();

        return view('admin/spots.index')->with('spots', $spots);
    }

    /**
     * Show the form for creating a new Spot.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/spots.create');
    }

    /**
     * Store a newly created Spot in storage.
     *
     * @param CreateSpotRequest $request
     *
     * @return Response
     */
    public function store(CreateSpotRequest $request)
    {
        $input = $request->all();
        $image = $request->file("photo_path");

        // 画像がアップロードされていれば、storageに保存。
        // if($request->hasFile('photo_path')){
        //     $path = \Strage::put('/public', $image);
        //     $path = explode('/', $path);
        // }else{
        //     $path = null;
        // }
        //拡張子付きでファイル名を取得
        $filenameWithExt = $image->getClientOriginalName();
        echo $filenameWithExt;
        //ファイル名のみを取得
         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        echo $filename;

        //拡張子を取得
        $extension = $image->getClientOriginalExtension();
        echo $extension;

        //保存のファイル名を構築
        $filenameToStore = $filename."_".time().".".$extension;


        $path = $image->storeAs("storage/spot_paths", $filenameToStore);
        // $path = \Strage::put('/public', $image);

        $spot = $this->spotRepository->create($input);

        Flash::success('Spot saved successfully.');

        return redirect(route('spots.index'));
    }

    



    /**
     * Display the specified Spot.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $spot = $this->spotRepository->find($id);

        if (empty($spot)) {
            Flash::error('Spot not found');

            return redirect(route('spots.index'));
        }

        return view('admin/spots.show')->with('spot', $spot);
    }

    /**
     * Show the form for editing the specified Spot.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $spot = $this->spotRepository->find($id);

        if (empty($spot)) {
            Flash::error('Spot not found');

            return redirect(route('spots.index'));
        }

        return view('admin/spots.edit')->with('spot', $spot);
    }

    /**
     * Update the specified Spot in storage.
     *
     * @param int $id
     * @param UpdateSpotRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpotRequest $request)
    {
        $spot = $this->spotRepository->find($id);

        if (empty($spot)) {
            Flash::error('Spot not found');
            return redirect(route('spots.index'));
        }

        $input = $request->all();
        $image = $request->file("photo_path");

        // if($request->hasFile('photo_path')){

            //拡張子付きでファイル名を取得
            $filenameWithExt = $image->getClientOriginalName();
            
            //ファイル名のみを取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //拡張子を取得
            $extension = $image->getClientOriginalExtension();

            //保存のファイル名を構築
            $filenameToStore = $filename."_".time().".".$extension;
            $path = $image->storeAs("public", $filenameToStore);
            // $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        // }else{
        //     $path = null;
        // }


//        $input["photo_path"]["realpath"]= $path;

        // Log::alert($path);
        // dd($path);


        

        // $path = \Strage::put('/public', $image);

        // $request->photo_path = $path;
        // dd($path);

        $input["photo_path"]=$path[1];
        // dd($input);
        
        $spot = $this->spotRepository->update($input, $id);

        Flash::success('Spot updated successfully.');

        return redirect(route('spots.index'));


    }

    /**
     * Remove the specified Spot from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $spot = $this->spotRepository->find($id);

        if (empty($spot)) {
            Flash::error('Spot not found');

            return redirect(route('spots.index'));
        }

        $this->spotRepository->delete($id);

        Flash::success('Spot deleted successfully.');

        return redirect(route('spots.index'));
    }



    // ゲストユーザー用
    public function read()
    {
        $data = $this->spotRepository->all();
        return $data;
    }




    
}
