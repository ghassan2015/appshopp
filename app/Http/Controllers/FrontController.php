<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Option;
use App\Models\ProbabilityOption;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;


class FrontController extends Controller
{
    public function index(Request $request)
    {
        return view('front.index');
    }

    public function contact_post(Request $request)
    {
        $request->validate([
            'name' => "required|min:3|max:190",
            'email' => "nullable|email",
            "phone" => "required|numeric",
            "message" => "required|min:3|max:10000",
        ]);
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => "قادم من : " . urldecode(url()->previous()) . "\n\nالرسالة : " . $request->message
        ]);
        toastr()->success('تم استلام رسالتك بنجاح وسنتواصل معك في أقرب وقت');
        //\Session::flash('message', __("Your Message Has Been Send Successfully And We Will Contact You Soon !"));
        return redirect()->back();
    }

    public function about(Request $request)
    {

        $category = Category::find(3);
        $data = [];
        foreach ($category->option as $key => $option) {
            $data['attributes'][$key] = $option->attribute;

        }

        return view('front.pages.about')->with([
            'attributes' => array_unique($data['attributes']),
            'category' => $category,
        ]);
    }

    public function article(Request $request, Article $article)
    {
        return view('front.pages.article', compact('article'));
    }

    public function blog(Request $request)
    {


        $category = Category::find(3);
        $data = [];
        foreach ($category->option as $key => $option) {
            $data['attributes'][$key] = $option->attribute;

        }


        return view('front.pages.blog')->with([
            'attributes' => array_unique($data['attributes']),
            'category' => $category,
            'categories' => Category::get(),
        ]);

//        $data['categories'] = Category::get();
//        $data['category']=  Category::find(1);
//
//        return view('front.pages.blog', $data);
    }

    public function category($id)
    {
        $category = Category::find($id);
        $data = [];
        foreach ($category->option as $key => $option) {
            $data[$key]['attribute'] = $option->attribute;

        }
        return $data;

    }

    public function attribute($id)
    {
        $option = Option::where('attribute_id', $id)->get();

        return $option;

    }

    public function option(Request $request)
    {

        $x = array_map(function ($i) {
            return intval($i);
        }, $request->get('b'));
//        dd("[" . implode(',', $x) . "]");
//        $a = array();
//        $z = array();
//        foreach (b as $b) {
//            $c = (int)($b);
//            $a[] = $c;
//        }
//        return $a;
//        foreach ($a as $x) {
//            $z = $x;
//        }

        return $pr = ProbabilityOption::where('option_id', "[" . implode(',', $x) . "]")->get();

    }
}

