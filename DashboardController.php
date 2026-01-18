<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Contact;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Directorate;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\History;
use App\Models\Publication;
use App\Models\PublicationCategory;
use App\Models\Service;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        try {
            // KPI counts (add anything else you need)
            $counts = [
                'Banner'               => Banner::count(),
                'Blog'                 => Blog::count(),
                'BlogCategory'         => BlogCategory::count(),
                'Contact'              => Contact::count(),
                'Department'           => Department::count(),
                'Directorate'          => Directorate::count(),
                'Event'                => Event::count(),
                'EventCategory'        => EventCategory::count(),
                'Faq'                  => Faq::count(),
                'Gallery'              => Gallery::count(),
                'Publication'          => Publication::count(),
                'PublicationCategory'  => PublicationCategory::count(),
                'Service'              => Service::count(),
                'User'                 => User::count(),
                'Doctor'                 => Doctor::count(),
          
            ];

            // Chart settings — one chart to match your Blade usage ($chart1)
            $settings1 = [
                'chart_title'           => 'Directorates (last 10 days)',
                'chart_type'            => 'bar',
                'report_type'           => 'group_by_date',
                'model'                 => Directorate::class,
                'group_by_field'        => 'created_at',
                'group_by_period'       => 'day',
                'aggregate_function'    => 'count',
                'filter_field'          => 'created_at',
                'filter_days'           => 10,
                'group_by_field_format' => 'Y-m-d',
                'column_class'          => 'col-md-12',
                'entries_number'        => 10,
                'translation_key'       => 'directorate',
                'continuous_time'       => true,
            ];

            $chart1 = new LaravelChart($settings1);

            return view('admin.dashboard', compact('counts', 'chart1'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
