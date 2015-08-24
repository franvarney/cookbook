<?php namespace App\Http\Controllers;

use App\Http\Requests;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContributorRequestController extends Controller
{
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contents = new \StdClass;

        $cookbook_response = $this->client->get(env('API_URL') . '/cookbooks/' . \Auth::user()->id . '/contributor');
        $contents->cookbooks = json_decode($cookbook_response->getBody());

        $received_response = $this->client->get(env('API_URL') . '/requests/' . \Auth::user()->id . '/receiver');
        $contents->received = json_decode($received_response->getBody());

        $sent_response = $this->client->get(env('API_URL') . '/requests/' . \Auth::user()->id . '/sender');
        $contents->sent = json_decode($sent_response->getBody());

        return view('requests.index', ['contents' => $contents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->client->post(env('API_URL') . '/request', ['form_params' => $request->all()]);
        return redirect('/requests/' . \Auth::user()->id);
    }

    public function approve($id)
    {
        $this->client->put(env('API_URL') . '/request/' . $id . '/approve/' . \Auth::user()->id);
        return redirect('/requests/' . \Auth::user()->id);
    }

    public function cancel($id)
    {
        $this->client->delete(env('API_URL') . '/request/' . $id);
        return redirect('/requests/' . \Auth::user()->id);
    }

    public function deny($id)
    {
        $this->client->put(env('API_URL') . '/request/' . $id . '/deny');
        return redirect('/requests/' . \Auth::user()->id);
    }

}
