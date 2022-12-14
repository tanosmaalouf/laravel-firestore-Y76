<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CrudController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    $products = app('firebase.firestore')->database()->collection('products')->documents();
    return view('Crud/index',compact('products'));
    // return dd($products);
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
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    if ($request->doc_id == null) {
      // Uplode Data
      $request->validate([
        'name' => 'required',
        'price' => 'required',
        'expiry' => 'required',
       ]);
      $stuRef = app('firebase.firestore')->database()->collection('invoices')->newDocument();
      $stuRef->set([
        'name' => $request->name,
        'price' => $request->price,
        'expiry'    => $request->expiry,
      ]);
      Session::flash('message', 'Information Uploaded');
      return back()->withInput();
    }
    else {

      $product = app('firebase.firestore')->database()->collection('invoices')->document($request->doc_id)->snapshot();

      $name = $product->data()['name'];
      $lname = $product->data()['price'];
      $age = $product->data()['expiry'];

      $data = sprintf("Name : %s %s \n and Age : %s", $name, $lname, $age);

      Session::flash('message',  $data);
      return back()->withInput();

    }


  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    echo $id;
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
    $product = app('firebase.firestore')->database()->collection('invoices')->document($id)
   ->update([
    ['path' => 'name', 'value' => $request->name],
    ['path' => 'price', 'value' => $request->price],
    ['path' => 'expiry', 'value' => $request->age],
   ]);
   return back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
    app('firebase.firestore')->database()->collection('invoices')->document($id)->delete();
    return back();
  }
}
