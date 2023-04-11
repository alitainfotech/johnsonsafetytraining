<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orderproduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\Avilabledate;
use DateTime;
use Carbon\Carbon;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start = Carbon::today()->endOfDay()->toDateString();
        $courses = Product::where('status','1')->get();
        $courseDate = Product::where('status','1')->get();
        return view('admin.booking.index',compact('courses'));
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
            $draw = $request->get('draw');
            $start = $request->post("start");
            $limit = $request->post("length");
            $select_courses = $request->get('select_courses');
            $select_date = $request->get('select_date');
            $search = $request->input('search.value');
            $payments = new Orderproduct;
            if($search){
                $payments = $payments->whereHas('user',function($query) use ($search){
                    $query->Where('full_name', 'LIKE', "%{$search}%");
                })->orwhereHas('product',function($query) use ($search,$select_courses){
                    $query->Where('name', 'LIKE', "%{$search}%");
                });
            }
            
            if($select_date){
                $payments = $payments->whereHas('order.getAvailableDate',function($query) use ($select_date){
                    $query->Where('id',$select_date);
                });
            }

            if($select_courses){
                $payments = $payments->whereHas('product',function($query) use ($select_courses){
                    $query->Where('id',$select_courses);
                });
            }

            $user = \Auth::user();
            if($user->types == 1){
                $payments =  $payments->where('user_id',$user->id);
            }
            
            $payments = $payments
            ->skip($start)
            ->take($limit)
            ->get();
            $data = array();
            foreach ($payments as $key => $payment) {     

                $startdate = new DateTime($payment->order->getAvailableDate->start_at);
                $enddate = new DateTime($payment->order->getAvailableDate->end_at);
                $days = $startdate->diff($enddate);
                $total_day = $days->days + 1;
                if ($total_day == 0) {
                    $total_day = 1;
                }
                
                $srno = (int)$key;
                $nestedData['id'] = $srno + 1;
                $nestedData['full_name'] = $payment->user->full_name;
                $nestedData['name'] = $payment->product->name;
                $nestedData['start_at'] = $payment->order->getAvailableDate->start_at;
                if(!empty($payment->order->getEnrolment->order_id)){
                    $nestedData['enrolment'] = '<span class="badge bg-success">Yes</span>';
                }else{
                    $nestedData['enrolment'] = '<span class="badge bg-danger">No</span>';
                }
                $nestedData['duration'] = $total_day.' Days';
                if($user->types == 1){
                    $nestedData['actions'] = '';
                }else{
                    $nestedData['actions'] = '<a class="btn btn-warning" href="javascript:void(0)" data-product="'.$payment->product->id.'" data-order="'.$payment->order->id.'" id="reschedule">Reschedule</a>';
                }
                
                $data[] = $nestedData;
            }
            // dd($data);
            return response()->json([
                "draw"            => $request->input('draw'),
                "recordsTotal"    => count($data),
                "recordsFiltered" => count($data),
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
     * @author Jayesh
     *
     * @uses Fetch records from table
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxCourses(Request $request)
    {
        try {
            $reschedule_date = $request->type;
            $start = Carbon::today()->endOfDay()->toDateString();
            $avilabledate = Avilabledate::select('id','start_at','no_of_seat')->where('start_at', '>=', $start)
            ->where('product_id',$request->courseId);
            $avilabledate = $avilabledate->orderBy('start_at','ASC')->get();    
            if($reschedule_date == 'reschedule_date'){
                $data = [];
                foreach($avilabledate as $value){
                    $availability = $value->no_of_seat - count($value->getAvailable);
                    if($availability > 0){
                        $data[] = $value;
                    }
                }
                $avilabledate = $data;
            }
            return response()->json([
                "avilabledate" => $avilabledate
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
     * @author Jayesh
     *
     * @uses Fetch records from table
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxReschedule(Request $request)
    {
        try {
            $order = Order::where('id',$request->orderId)->first();
            $data = [
                'status' => 0,
                'message' => 'Something went to wrong!'
            ];
            if(!empty($order)){
                $order->available_id = $request->date;
                $order->save();
                $data = [
                    'status' => 1,
                    'message' => 'Order rescheduled successfully.'
                ];
            }
            return response()->json($data);
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