<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use GuzzleHttp\Client;
use Throwable;
use App\Http\Requests\CustomerRequest;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index')->with(compact('customers'));
    }

    public function search()
    {
        return view('customer.search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $method = 'GET';
        $post_code = $request->post_code;
        $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=' . $post_code;

        $client = new Client();

        try {
            $response = $client->request($method, $url);
            $body = $response->getBody();
            $zip_cloud = json_decode($body, false);
            $result = $zip_cloud->results[0];
            $address = $result->address1 . $result->address2 . $result->address3;
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => '郵便番号を正しく入力してください！']);
        }

        return view('customer.create')->with(compact('address', 'post_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = new Customer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->post_code = $request->post_code;
        $customer->address = $request->address;
        $customer->tel = $request->tel;

        $customer->save();
        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer.show')->with(compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit')->with(compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::find($id);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->post_code = $request->post_code;
        $customer->address = $request->address;
        $customer->tel = $request->tel;

        $customer->save();
        return redirect()->route('customers.show', $customer->id)->with('flash_message', '更新に成功しました！やったね♡');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/customers');
    }
}
