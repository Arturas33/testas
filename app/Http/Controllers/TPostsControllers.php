<?php
namespace App\Http\Controllers;



use App\Models\TPosts;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;


class TPostsControllers extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /tpostss
	 *
	 * @return Response
     *
	 */
	public function index()
	{
//
        $config['list'] = Tposts::get()->toArray();
        $config['create'] = 'app.posts.create';
        $config['title'] = 'Posts';
        $config['show'] = 'app.posts.show';
        $config['delete'] = 'app.posts.destroy';
        $config['edit'] = 'app.posts.edit';
//        dd($config);

        return view('list', $config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tpostss/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $config = $this->getFormData();
        $config['tableName'] = trans('posts');
        $config['title'] = trans('posts');
        $config['route'] = route('app.posts.create');


//         dd($config);
        return view('home', $config);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tpostss
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = request()->all();
        TPosts::create([
            'id' => Uuid::uuid4(),
             'user_id'=> Auth::id(),
            'title' => $data['title'],
            'text' => $data['text'],
            'path' => $data['path'],
            'link' => $data['link'],
        ]);

        return redirect(route('app.posts.index'));
	}

	/**
	 * Display the specified resource.
	 * GET /tpostss/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tpostss/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $record = TPosts::find($id)->toArray();
        $config = $this->getFormData();
        $config['record'] = $record;
        $config['titleForm'] = $id;
        $config['route'] = route('app.posts.edit', $id);
        $config['back'] = 'app.posts.index';

        return view('form', $config);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tpostss/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = request()->all();
        $record = TPosts::find($id);
        $record->update($data);


        return redirect(route('app.posts.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tpostss/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        TPosts::destroy($id);
        return["success" => true, "id" => $id];
	}

    private function getFormData()
    {

        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'title',

        ];
        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'text',
        ];
        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'path',

        ];
        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'link',
        ];


        return $config;
    }

}