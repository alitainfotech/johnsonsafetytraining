<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * @author Jayesh
     *
     * @uses Display a page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Product::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        return view('admin.calendars.index', compact(['courses', 'categories']));
    }

    /**
     * @author Jayesh
     *
     * @uses Display a records of the resource.
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxIndex(Request $request)
    {
        $start = Carbon::parse($request->start_at)->startOfMonth()->toDateTimeString();
        $end =  Carbon::parse($request->end_at)->endOfMonth()->toDateTimeString();

        $calendars = Calendar::select('id', 'title', 'start_at AS start', 'end_at AS end', 'type', 'description', 'location', 'duration_type', 'duration_in_minute', 'is_repeat', 'repeat_times', 'status', 'created_at', 'updated_at')
        // ->whereBetween('start_at',[$start,$end])
        ->where('start_at','>',$start)
        ->where(function ($query) use ($end) {
            $query->whereNull('end_at')
              ->orWhere('end_at','>',$end);
          })
        ->get();
        return response()->json($calendars);
    }

    /**
     * @author Jayesh
     *
     * @uses Display a records of the resource.
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxPrevious(Request $request)
    {
        $start = Carbon::now($request->start_at)->startOfMonth()->subMonth()->toDateTimeString();
        $end =  Carbon::now($request->end_at)->startOfMonth()->subMonth()->endOfMonth()->toDateString();

        $calendarsPrev = Calendar::select('id', 'title', 'start_at AS start', 'end_at AS end', 'type', 'description', 'location', 'duration_type', 'duration_in_minute', 'is_repeat', 'repeat_times', 'status', 'created_at', 'updated_at')
        // ->whereBetween('start_at',[$start,$end])
        ->where('start_at','>',$start)
        ->where(function ($query) use ($end) {
            $query->whereNull('end_at')
              ->orWhere('end_at','>',$end);
          })
        ->get();
        return response()->json($calendarsPrev);
    }

    /**
     * @author Jayesh
     *
     * @uses Display a records of the resource.
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxNext(Request $request)
    {
        $start = Carbon::parse($request->start_at)->startOfMonth()->addmonths(1)->toDateTimeString();
        $end =  Carbon::parse($request->end_at)->endOfMonth()->addmonths(1)->toDateTimeString();

        $calendarsNext = Calendar::select('id', 'title', 'start_at AS start', 'end_at AS end', 'type', 'description', 'location', 'duration_type', 'duration_in_minute', 'is_repeat', 'repeat_times', 'status', 'created_at', 'updated_at')
        ->where('start_at','>',$start)
        ->where(function ($query) use ($end) {
            $query->whereNull('end_at')
              ->orWhere('end_at','>',$end);
          })
        ->get();
        return response()->json($calendarsNext);
    }

    /**
     * @author Jayesh
     *
     * @uses Manipulation of the resource.
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxCalendar(Request $request)
    {
        try {
            if(!is_null($request->course_id)) {
                $request['type_id'] = $request->course_id;
            } else if (!is_null($request->category_id)) {
                $request['type_id'] = $request->category_id;
            } else {
                $request['type_id'] = '0';
            }
            switch ($request->methodType) {
                case 'add':
                    $event = Calendar::create($request->all());
                    return response()->json($event);
                break;
                case 'show':
                    $event = Calendar::find($request->id);
                    if(config('constants.calendars.type_text.'.$event->type) == 'Category') {
                        // Category
                        $model = new Category();
                    } else if (config('constants.calendars.type_text.'.$event->type) == 'Course') {
                        // Course
                        $model = new Product();
                    }
                    $types = $model::select(['id', 'name'])->where('id', '=', $event->type_id)->first();
                    $types = !is_null($types) ? $types->toArray() : [];
                    $event->type_name_text = !empty($types) ? $types['name'] : '';
                    $event->start_at = date("l jS \of F Y h:i:s A", strtotime($event->start_at));
                    if(!is_null($event->end_at)) {
                        $event->end_at = date("l jS \of F Y h:i:s A", strtotime($event->end_at));
                    }
                    return response()->json($event);
                break;
                case 'showEdit':
                    $event = Calendar::find($request->id);
                    if(config('constants.calendars.type_text.'.$event->type) == 'Category') {
                        // Category
                        $model = new Category();
                    } else if (config('constants.calendars.type_text.'.$event->type) == 'Course') {
                        // Course
                        $model = new Product();
                    }
                    $types = $model::select(['id', 'name'])->where('id', '=', $event->type_id)->first();
                    $types = !is_null($types) ? $types->toArray() : [];
                    $event['type_name_text'] = !empty($types) ? $types['name'] : '';
                    return response()->json($event);
                break;
                case 'update':
                    if($request->duration_type == '0') {
                        $request['end_at'] = NULL;
                    }
                    $event = Calendar::find($request->id)->update($request->except('id'));
                    return response()->json(['status' => true, 'message' => 'Calender updated successfully.', 'event' => $event]);
                break;
                case 'delete':
                    $event = Calendar::find($request->id)->delete();
                    return response()->json(['status' => true, 'message' => 'Calender deleted successfully.', 'event' => $event]);
                break;
                default:
                break;
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Export calendar to ics format with filter.
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxCalendarExport(Request $request)
    {
        $requests = array_filter($request->except('_token'));
        switch ($requests['events_to_export']) {
            case 'events_related_to_categories':
                $types = ['2'];
                break;
            case 'events_related_to_courses':
                $types = ['1'];
                break;
            case 'events_related_to_groups':
                $types = ['0'];
                break;
            case 'my_personal_events':
                $types = ['0', '1', '2'];
                break;
            default:
                $types = ['0', '1', '2'];
                break;
        }
        $now = Carbon::now();
        switch ($requests['time_period']) {
            case 'this_week':
                $startDate = $now->startOfWeek()->startOfDay()->toDateTimeString();
                $endDate = $now->endOfWeek()->endOfDay()->toDateTimeString();
                break;
            case 'recent_and_next_60_days':
                $startDate = $now->startOfDay()->toDateTimeString();
                $endDate = $now->endOfDay()->addDays(60)->toDateTimeString();
                break;
            case 'next_month':
                $firstDatNextMonth = new Carbon('first day of next month');
                $lastDatNextMonth = new Carbon('last day of next month');
                $startDate = $firstDatNextMonth->startOfDay()->toDateTimeString();
                $endDate = $lastDatNextMonth->endOfDay()->toDateTimeString();
                break;
            case 'custom_range':
                $range = array_map("trim", explode('to', $requests['custom_range_date']));
                $startDate = Carbon::parse($range[0])->startOfDay()->format('Y-m-d H:i:01');
                $endDate = Carbon::parse($range[1])->endOfDay()->format('Y-m-d H:i:59');
                break;
            default:
                $startDate = $now->startOfMonth()->format('Y-m-d H:i:01');
                $endDate = $now->endOfMonth()->format('Y-m-d H:i:59');
                break;
        }
        $calendars = Calendar::select('id', 'title', 'start_at', 'end_at', 'location', 'description')
                            ->whereIn('type', $types)
                            ->where('start_at', '>=', $startDate)
                            ->where(function ($query) use($endDate) {
                                $query->where('end_at', '<=', $endDate)->orWhereNull('end_at');
                            })
                            ->get();
        $ICalendars = [];
        if($calendars->isNotEmpty()) {
            foreach ($calendars as $key => $calendar) {
                $ICalendars[$key]['id'] = $calendar->id;
                $ICalendars[$key]['title'] = $calendar->title;
                $ICalendars[$key]['description'] = strip_tags($calendar->description);
                $ICalendars[$key]['location'] = !is_null($calendar->location) ? $calendar->location : '';
                $ICalendars[$key]['start_at'] = $calendar->start_at;
                $ICalendars[$key]['end_at'] = !is_null($calendar->end_at) ? $calendar->end_at : '';
            }
            return response()->json([
                'status' => true,
                'calendars' => $ICalendars
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data found to export.'
            ]);
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Export calendar to ics format with filter.
     *
     * @param  mixed $request
     * @return void
     */
    public function filterCourse(Request $request)
    {
        try {
            $course_id = $request->course_id;

            $startPrev = Carbon::parse($request->start_at)->subMonths(1)->startOfMonth()->toDateTimeString();
            $endPrev =  Carbon::parse($request->end_at)->subMonths(1)->endOfMonth()->toDateTimeString();

            $startNext = Carbon::parse($request->start_at)->addmonths(1)->startOfMonth()->toDateTimeString();
            $endNext =  Carbon::parse($request->end_at)->addmonths(1)->endOfMonth()->toDateTimeString();

            $startCurrent = Carbon::parse($request->start_at)->startOfMonth()->toDateTimeString();
            $endCurrent =  Carbon::parse($request->end_at)->endOfMonth()->toDateTimeString();

            if($course_id == 0) {
                $eventsPrev = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('start_at', '>=', $startPrev)
                            ->where(function ($query) use($endPrev) {
                                $query->where('end_at', '<=', $endPrev)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsNext = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('start_at', '>=', $startNext)
                            ->where(function ($query) use($endNext) {
                                $query->where('end_at', '<=', $endNext)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsCurrent = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('start_at', '>=', $startCurrent)
                            ->where(function ($query) use($endCurrent) {
                                $query->where('end_at', '<=', $endCurrent)->orWhereNull('end_at');
                            })
                            ->get();

                return response()->json([
                    'eventsPrev' => $eventsPrev,
                    'eventsNext' => $eventsNext,
                    'eventsCurrent' => $eventsCurrent,
                ]);
            } else {
                $eventsPrev = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('type', '1')
                            ->where('type_id', $course_id)
                            ->where('start_at', '>=', $startPrev)
                            ->where(function ($query) use($endPrev) {
                                $query->where('end_at', '<=', $endPrev)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsNext = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('type', '1')
                            ->where('type_id', $course_id)
                            ->where('start_at', '>=', $startNext)
                            ->where(function ($query) use($endNext) {
                                $query->where('end_at', '<=', $endNext)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsCurrent = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('type', '1')
                            ->where('type_id', $course_id)
                            ->where('start_at', '>=', $startCurrent)
                            ->where(function ($query) use($endCurrent) {
                                $query->where('end_at', '<=', $endCurrent)->orWhereNull('end_at');
                            })
                            ->get();

                return response()->json([
                    'eventsPrev' => $eventsPrev,
                    'eventsNext' => $eventsNext,
                    'eventsCurrent' => $eventsCurrent,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json();
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Export calendar to ics format with filter.
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxCheckbox(Request $request)
    {
        try {
            $type = $request->type;

            $startPrev = Carbon::parse($request->start_at)->subMonths(1)->startOfMonth()->toDateTimeString();
            $endPrev =  Carbon::parse($request->end_at)->subMonths(1)->endOfMonth()->toDateTimeString();

            $startCurrent = Carbon::parse($request->start_at)->startOfMonth()->toDateTimeString();
            $endCurrent =  Carbon::parse($request->end_at)->endOfMonth()->toDateTimeString();

            $startNext = Carbon::parse($request->start_at)->addmonths(1)->startOfMonth()->toDateTimeString();
            $endNext =  Carbon::parse($request->end_at)->addmonths(1)->endOfMonth()->toDateTimeString();

            if(!empty($type) && !in_array($type, [4])) {

                $eventsPrev = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->whereNotIn('type', $type)
                            ->where('start_at', '>=', $startPrev)
                            ->where(function ($query) use($endPrev) {
                                $query->where('end_at', '<=', $endPrev)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsNext = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->whereNotIn('type', $type)
                            ->where('start_at', '>=', $startNext)
                            ->where(function ($query) use($endNext) {
                                $query->where('end_at', '<=', $endNext)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsCurrent = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->whereNotIn('type', $type)
                            ->where('start_at', '>=', $startCurrent)
                            ->where(function ($query) use($endCurrent) {
                                $query->where('end_at', '<=', $endCurrent)->orWhereNull('end_at');
                            })
                            ->get();

                return response()->json([
                    'eventsPrev' => $eventsPrev,
                    'eventsNext' => $eventsNext,
                    'eventsCurrent' => $eventsCurrent,
                ]);
            } else {
                $eventsPrev = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('start_at', '>=', $startPrev)
                            ->where(function ($query) use($endPrev) {
                                $query->where('end_at', '<=', $endPrev)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsNext = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('start_at', '>=', $startNext)
                            ->where(function ($query) use($endNext) {
                                $query->where('end_at', '<=', $endNext)->orWhereNull('end_at');
                            })
                            ->get();

                $eventsCurrent = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])
                            ->where('start_at', '>=', $startCurrent)
                            ->where(function ($query) use($endCurrent) {
                                $query->where('end_at', '<=', $endCurrent)->orWhereNull('end_at');
                            })
                            ->get();

                return response()->json([
                    'eventsPrev' => $eventsPrev,
                    'eventsNext' => $eventsNext,
                    'eventsCurrent' => $eventsCurrent,
                ]);
                // $events = Calendar::select(['id', 'title', 'start_at as start', 'end_at as end'])->get();
                // return response()->json($events);
            }
        } catch (\Exception $e) {
            return response()->json();
        }
    }


    /**
     * @author Jayesh
     *
     * @uses Page view for export and download exported calendar.
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxCalendarLinkGenerate(Request $request)
    {
        return view('admin.calendars.ical-generate-link');
    }
}