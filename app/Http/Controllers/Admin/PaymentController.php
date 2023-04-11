<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orderproduct;


class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.payments.index');
    }

    /**
     * @author Jayesh
     *
     * @uses Fetch records from table
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxIndex(Request $request)
    {
        try {
            $payments = Orderproduct::with([
                'product' => function ($query) {
                    $query->select('id', 'name');
                },
                'order' => function ($query) {
                    $query->select('id', 'payment_id', 'total');
                },
                'user' => function ($query) {
                    $query->select('id', 'full_name', 'user_name', 'phone', 'email', 'address');
                }
            ])
                ->get()->toarray();
            // dd($payments);

            $columns = array(
                0 => 'name',
                1 => 'full_name',
                1 => 'user_name',
                3 => 'email',
                2 => 'phone',
                4 => 'address',
                5 => 'payment_id',
                6 => 'total',
                // 7 => 'actions',
            );

            $totalData = Orderproduct::count();

            $totalFiltered = $totalData;
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if (empty($request->input('search.value'))) {
                $payments = Orderproduct::where('status', "1")
                    ->offset($start)
                    ->limit($limit)
                    // ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');
                $payments = Orderproduct::with([
                    'product' => function ($query) use ($search) {
                        $query->select('id', 'name')->Where('name', 'LIKE', "%{$search}%")->get();
                    },
                    'order' => function ($query) {
                        $query->select('id', 'payment_id', 'total');
                    },
                    'user' => function ($query) {
                        $query->select('id', 'full_name', 'user_name', 'phone', 'email', 'address');
                    }
                ])
                    ->offset($start)
                    ->limit($limit)
                    ->get()
                    ->toarray();

                foreach ($payments as $key => $payment) {

                    if ($payment['product'] != null) {
                        $srno = (int)$key;
                        $nestedData['id'] = $srno + 1;
                        $nestedData['name'] = $payment['product']['name'];
                        $nestedData['full_name'] = $payment['user']['full_name'];
                        $nestedData['user_name'] = $payment['user']['user_name'];
                        $nestedData['email'] = $payment['user']['email'];
                        $nestedData['phone'] = $payment['user']['phone'];
                        $nestedData['address'] = $payment['user']['address'];
                        $nestedData['payment_id'] = $payment['order']['payment_id'];
                        $nestedData['total'] = $payment['order']['total'];
                        $data[] = $nestedData;
                    }
                }

                $totalFiltered = count($data);
                return response()->json([
                    "draw"            => $request->input('draw'),
                    "recordsTotal"    => $totalData,
                    "recordsFiltered" => $totalFiltered,
                    "data"            => $data
                ]);
            }
            $data = array();
            foreach ($payments as $key => $payment) {
                $srno = (int)$key;
                $nestedData['id'] = $srno + 1;
                $nestedData['name'] = $payment['product']['name'];
                $nestedData['full_name'] = $payment['user']['full_name'];
                $nestedData['user_name'] = $payment['user']['user_name'];
                $nestedData['email'] = $payment['user']['email'];
                $nestedData['phone'] = $payment['user']['phone'];
                $nestedData['address'] = $payment['user']['address'];
                $nestedData['payment_id'] = $payment['order']['payment_id'];
                $nestedData['total'] = $payment['order']['total'];
                $data[] = $nestedData;
            }
            return response()->json([
                "draw"            => $request->input('draw'),
                "recordsTotal"    => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data"            => $data
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
            return response()->json([
                'status' => false,
                "message" => 'Something went wrong. Please try again later.',
            ]);
        }
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
        //
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
    }
}
