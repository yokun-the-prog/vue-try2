<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Repositories\TourRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Response;

class TourController extends AppBaseController
{
    /** @var  TourRepository */
    private $tourRepository;

    public function __construct(TourRepository $tourRepo)
    {
        $this->tourRepository = $tourRepo;
    }

    /**
     * Display a listing of the Tour.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tours = $this->tourRepository->all();

        return view('admin/tours.index')
            ->with('tours', $tours);
    }

    /**
     * Show the form for creating a new Tour.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/tours.create');
    }

    /**
     * Store a newly created Tour in storage.
     *
     * @param CreateTourRequest $request
     *
     * @return Response
     */
    public function store(CreateTourRequest $request)
    {
        $input = $request->all();

        $tour = $this->tourRepository->create($input);

        Flash::success('Tour saved successfully.');

        return redirect(route('tours.index'));
    }

    /**
     * Display the specified Tour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tour = $this->tourRepository->find($id);

        if (empty($tour)) {
            Flash::error('Tour not found');

            return redirect(route('tours.index'));
        }

        return view('admin/tours.show')->with('tour', $tour);
    }

    /**
     * Show the form for editing the specified Tour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tour = $this->tourRepository->find($id);

        if (empty($tour)) {
            Flash::error('Tour not found');

            return redirect(route('tours.index'));
        }

        return view('admin/tours.edit')->with('tour', $tour);
    }

    /**
     * Update the specified Tour in storage.
     *
     * @param int $id
     * @param UpdateTourRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTourRequest $request)
    {
        $tour = $this->tourRepository->find($id);

        if (empty($tour)) {
            Flash::error('Tour not found');

            return redirect(route('tours.index'));
        }

        $tour = $this->tourRepository->update($request->all(), $id);

        Flash::success('Tour updated successfully.');

        return redirect(route('tours.index'));
    }

    /**
     * Remove the specified Tour from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tour = $this->tourRepository->find($id);

        if (empty($tour)) {
            Flash::error('Tour not found');

            return redirect(route('tours.index'));
        }

        $this->tourRepository->delete($id);

        Flash::success('Tour deleted successfully.');

        return redirect(route('tours.index'));
    }




    // ゲストユーザー用
    public function guest_index(Request $request)
    {
        $spots = $this->tourRepository-->user()->all();
        return view('guest/tours.index')->with('tours', $spots);
    }

    public function guest_show($id)
    {
        $tour = $this->tourRepository->find($id);

        if (empty($tour)) {
            Flash::error('Spot not found');

            return redirect(route('guest/spots.show'));
        }

        return view('guest/tours.show')->with('tour', $spot);
    }

}
