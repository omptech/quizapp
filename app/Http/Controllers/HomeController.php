<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Admob;
use App\Category;
use App\Notifications\PaymentRejectedEmail;
use App\Notifications\PaymentSuccessEmail;
use App\PaymentMethod;
use App\Player;
use App\Question;
use App\Setting;
use App\User;
use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $players = Player::all();
        $categories = Category::all();
        $questions = Question::all();
        $withdrawals = Withdrawal::all();
        $methods = PaymentMethod::all();
        $admins = User::all();
        return view('home')->with([
            'players'=>$players,
            'categories'=>$categories,
            'questions'=>$questions,
            'withdrawals'=>$withdrawals,
            'methods'=>$methods,
            'admins'=>$admins,
        ]);
    }

    /**
     * Display players.
     *
     * @return \Illuminate\Http\Response
     */
    public function players()
    {
        $players = Player::orderBy('score', 'desc')->paginate(15);
        return view('players')->with('players',$players);
    }

    /**
     * Create New Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function newPlayer(Request $request)
    {
        if ($request->password == $request->password_confirmation) {
        $player = Player::create([
        'name' => $request->name,
        'email' => $request->email,
        'score'=>$request->points,
        'referral_code'=>Str::random(6),
        'password' => Hash::make($request->password),
        'image_url'=>URL::to('assets/img/player.png')
        ]);
        $newRef = $player->referral_code . $player->id;
                $player->referral_code = $newRef;
                $player->save();
        Session::flash('success', 'New Player created successfully!');
        return redirect()->back();
        }

    }

    /**
     * Delete Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyPlayer(Player $player)
    {
        $player->withdrawals()->delete();
        $player->delete();
        Session::flash('success', 'This Player had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Display categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('categories')->with('categories',$categories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newCategory(Request $request)
    {
        if (!empty($request->category_image)) {
            $new_name = time() . $request->file('category_image')->getClientOriginalName();
            $request->category_image->move('assets/uploads/categories/', $new_name);
            Category::create([
            'name' => $request->category_name,
            'image_url' => $new_name,
            'is_featured' => $request->featured_category
            ]);
            Session::flash('success', 'Your Category is Added successfully');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request, Category $category)
    {
        if (!empty($request->category_image)) {
            @unlink(asset('/assets/uploads/categories/'.$category->image_url));
            $new_name = time() . $request->file('category_image')->getClientOriginalName();
            $request->category_image->move('assets/uploads/categories/', $new_name);
            $category->image_url = $new_name;
        }

        $category->name = $request->category_name;
        $category->is_featured = $request->featured_category;
        $category->save();
        Session::flash('success', 'Your Category had been updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory(Category $category)
    {
        @unlink(asset('/assets/uploads/categories/'.$category->image_url));
        $category->questions()->delete();
        $category->delete();
        Session::flash('success', 'Your Category had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Display questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function questions()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(8);
        $questions = Question::all();
        return view('questions')->with(['categories'=>$categories,'questions'=>$questions]);
    }

    /**
     * Display a listing of related questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function relatedQuestions($id)
    {
        $category = Category::find($id);
        $categoryName = $category->name;
        $related_questions = Question::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(15);
        return view('manage_questions')->with([
            'related_questions'=>$related_questions,
            'categoryName'=>$categoryName,
            'category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newQuestion(Request $request)
    {
        Question::create([
            'question' => $request->question,
            'true_answer' => $request->true_answer,
            'false_answer1' => $request->false_answer1,
            'false_answer2' => $request->false_answer2,
            'false_answer3' => $request->false_answer3,
            'level' => $request->level,
            'points'=>$request->points,
            'category_id' => $request->category_id,
            ]);
        Session::flash('success', 'Your Question is Added successfully');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkImport(Request $request)
    {
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            Question::create([
            'question' => $column[0],
            'true_answer' => $column[1],
            'false_answer1' => $column[2],
            'false_answer2' => $column[3],
            'false_answer3' => $column[4],
            'level' => $column[5],
            'points'=>(int)$column[6],
            'category_id' => $request->category_id,
            ]);
            
        }
        Session::flash('success', 'Your Questions are added successfully');
        return redirect()->back();
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function updateQuestion(Request $request, Question $question)
    {
        $question->question = $request->question;
        $question->true_answer = $request->true_answer;
        $question->false_answer1 = $request->false_answer1;
        $question->false_answer2 = $request->false_answer2;
        $question->false_answer3 = $request->false_answer3;
        $question->level = $request->level;
        $question->points = $request->points;
        $question->save();
        Session::flash('success', 'Your Question had been updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroyQuestion(Question $question)
    {
        $question->delete();
        Session::flash('success', 'Your Question had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Display Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $settings = Setting::find(1);
        return view('settings')->with('settings',$settings);
    }

    /**
     * Display Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSettings(Request $request)
    {
        $settings = Setting::find(1);
        $settings->currency = $request->currency;
        $settings->min_to_withdraw = $request->min_to_withdraw;
        $settings->conversion_rate = $request->conversion_rate;
        $settings->referral_register_points = $request->referral_register_points;
        $settings->question_time = $request->question_time;
        $settings->completed_option = $request->completed_option;
        $settings->fifty_fifty = $request->fifty_fifty;
        $settings->video_reward = $request->video_reward;
        $settings->save();
        Session::flash('success', 'Your Settings has been updated successfully!');
        return redirect()->back();
    }

    /**
     * Display Payment Methods.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentMethods()
    {
        $methods = PaymentMethod::orderBy('created_at', 'desc')->paginate(15);
        return view('payment_methods')->with('methods',$methods);
    }

    /**
     * Create New Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function newPaymentMethod(Request $request)
    {
        PaymentMethod::create([
        'method' => $request->method,
        ]);
        Session::flash('success', 'New Payment Method created successfully!');
        return redirect()->back();

    }

    /**
     * Delete Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyPaymentMethod(PaymentMethod $method)
    {
        $method->delete();
        Session::flash('success', 'This Payment Method had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Display Withdrawals.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdrawals()
    {
        $settings = Setting::find(1);
        $withdrawals = Withdrawal::orderBy('created_at', 'desc')->paginate(15);
        return view('withdrawals')->with(['withdrawals'=>$withdrawals,'settings'=>$settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function updateWithdrawal(Request $request)
    {
        $withdrawal = Withdrawal::find($request->id);
        $withdrawal->status = $request->status;
        $withdrawal->save();
        if ($withdrawal->status == "Paid") {
            $player = Player::find($withdrawal->player_id);
            $player->notify(new PaymentSuccessEmail());
        } elseif ($withdrawal->status == "Rejected") {
            $player = Player::find($withdrawal->player_id);
            $player->notify(new PaymentRejectedEmail());
        }
        Session::flash('success', 'Your Withdrawal Status has been updated successfully!');
        return redirect()->back();
    }

    /**
     * Display admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function admins()
    {
        $admins = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admins')->with('admins',$admins);
    }

    /**
     * Create New Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function newAdmin(Request $request)
    {
        if ($request->password == $request->password_confirmation) {
        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'admin' => $request->admin,
        'password' => Hash::make($request->password),
        ]);
        Session::flash('success', 'New Admin created successfully!');
        return redirect()->back();
        }

    }

    /**
     * Delete Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin(User $admin)
    {
        $admin->delete();
        Session::flash('success', 'This Admin had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Display ads.
     *
     * @return \Illuminate\Http\Response
     */
    public function ads()
    {
        $ads = Admob::find(1);
        return view('ads')->with('ads',$ads);
    }

    /**
     * Display Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAds(Request $request)
    {
        $ads = Admob::find(1);
        $ads->admob_native = $request->admob_native;
        $ads->admob_interstitial = $request->admob_interstitial;
        $ads->admob_banner = $request->admob_banner;
        $ads->admob_video = $request->admob_video;
        $ads->fb_native = $request->fb_native;
        $ads->fb_banner = $request->fb_banner;
        $ads->fb_interstitial = $request->fb_interstitial;
        $ads->bottom_banner_type = $request->bottom_banner_type;
        $ads->save();
        Session::flash('success', 'Your Ads has been updated successfully!');
        return redirect()->back();
    }
    


}
