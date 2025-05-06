<?php

namespace App\Http\Controllers;

use App\Algorithm;
use App\ContactUsForm;
use App\FrequentlyAskedQuestion;
use App\GuideLineMain;
use App\Http\Controllers\Controller;
use App\Newsletter;
use App\User;
use App\UserTimeSpent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $users = User::where('active_status' , 1)->count();
        $algorithms = Algorithm::where('algorithm_status' , 1)->count();
        $guidelines = GuideLineMain::where('guide_line_status'  , 1)->count();
        $totalSpentTime = UserTimeSpent::sum('user_time_spent_time');
        $totalFormSubmition = ContactUsForm::count();
        $totalFAQS = FrequentlyAskedQuestion::where('frequently_asked_question_status' , 1)->count();
        $totalNews = Newsletter::where('newsletter_status' , 1)->count();
        
        $activeUserscurrents = User::where('active_status' , 1)->get();
            
            foreach($activeUserscurrents as $activeUser){
                $spenttie = $activeUser->userTimeSpent;
                if(count($spenttie)){
                    $usersNumberactivecurrent[] = $activeUser;
                }
            }

        return response()->json([
            'users' => $users,
            'algorithms' => $algorithms,
            'guidelines' => $guidelines,
            'totalSpentTime' => $totalSpentTime,
            'totalFormSubmition' => $totalFormSubmition,
            'totalFAQS' => $totalFAQS,
            'totalNews' => $totalNews,
            'activeUsers' => count($usersNumberactivecurrent) , 
             ], 200); 
    }
    
    public function customnumbers(Request $request) {
        $dateNow = Carbon::now('Africa/Cairo')->format('Y-m-d');
        
        $singleDate = $request->single_date;
        
        $usersNumberactive = [];
                    
        if($singleDate) {
            $dateNow = Carbon::now('Africa/Cairo')->format('Y-m-d');
            $users = User::whereDate('created_at' , '=' , $singleDate)->where('active_status' , 1)->count();
            $algorithms = Algorithm::whereDate('created_at' , '=' , $singleDate)->where('algorithm_status' , 1)->count();
            $guidelines = GuideLineMain::whereDate('guide_line_date' , '=' , $singleDate)->where('guide_line_status'  , 1)->count();
            $totalSpentTime = UserTimeSpent::whereDate('user_time_spent_date' , '=' , $singleDate)->sum('user_time_spent_time');
            $totalFormSubmition = ContactUsForm::whereDate('created_at' , '=' , $singleDate)->count();
            $totalFAQS = FrequentlyAskedQuestion::whereDate('created_at' , '=' , $singleDate)->where('frequently_asked_question_status' , 1)->count();
            
            $activeUsers = User::where('active_status' , 1)->get();
            
            foreach($activeUsers as $activeUser){
                $spenttie = $activeUser->onlineactiveUser($singleDate);
                if(count($spenttie)){
                    $usersNumberactive[] = $activeUser;
                }
            }
            
            
        }  else if ($request->start_date) {
            
            // dd($startDate , $endDate);
            $fromdate = $request->start_date;
            $todate = $request->end_date;
            // dd($fromdate , $todate);
            
            $users = User::whereDate('created_at' , '>=' , $fromdate)->whereDate('created_at' , '<=' , $todate)->where('active_status' , 1)->count();
            $algorithms = Algorithm::whereDate('created_at' , '>=' , $fromdate)->whereDate('created_at' , '<=' , $todate)->where('algorithm_status' , 1)->count();
            $guidelines = GuideLineMain::whereDate('guide_line_date' , '>=' , $fromdate)->whereDate('guide_line_date' , '<=' , $todate)->where('guide_line_status'  , 1)->count();
            $totalSpentTime = UserTimeSpent::whereDate('user_time_spent_date' , '>=' , $fromdate)->whereDate('user_time_spent_date' , '<=' , $todate)->sum('user_time_spent_time');
            $totalFormSubmition = ContactUsForm::whereDate('created_at' , '>=' , $fromdate)->whereDate('created_at' , '<=' , $todate)->count();
            $totalFAQS = FrequentlyAskedQuestion::whereDate('created_at' , '>=' , $fromdate)->whereDate('created_at' , '<=' , $todate)->where('frequently_asked_question_status' , 1)->count();
            
            $activeUsers = User::where('active_status' , 1)->get();
            
            foreach($activeUsers as $activeUser){
                $spenttie = $activeUser->onlineactiveUserInBetween($fromdate , $todate);
                if(count($spenttie)){
                    $usersNumberactive[] = $activeUser;
                }
            }
            
            
        }   else {
            
            $users = User::whereDate('created_at' , '=' , $dateNow)->where('active_status' , 1)->count();
            $algorithms = Algorithm::whereDate('created_at' , '=' , $dateNow)->where('algorithm_status' , 1)->count();
            $guidelines = GuideLineMain::whereDate('guide_line_date' , '=' , $dateNow)->where('guide_line_status'  , 1)->count();
            $totalSpentTime = UserTimeSpent::whereDate('user_time_spent_date' , '=' , $dateNow)->sum('user_time_spent_time');
            $totalFormSubmition = ContactUsForm::whereDate('created_at' , '=' , $dateNow)->count();
            $totalFAQS = FrequentlyAskedQuestion::whereDate('created_at' , '=' , $dateNow)->where('frequently_asked_question_status' , 1)->count();
            
            $activeUsers = User::where('active_status' , 1)->get();
            
            foreach($activeUsers as $activeUser){
                $spenttie = $activeUser->onlineactiveUser($dateNow);
                if(count($spenttie)){
                    $usersNumberactive[] = $activeUser;
                }
            }
            
            

            
        }   
        
        
        $userscurrent = User::where('active_status' , 1)->count();
            $algorithmscurrent = Algorithm::where('algorithm_status' , 1)->count();
            $guidelinescurrent = GuideLineMain::where('guide_line_status'  , 1)->count();
            $totalSpentTimecurrent = UserTimeSpent::sum('user_time_spent_time');
            $totalFormSubmitioncurrent = ContactUsForm::count();
            $totalFAQScurrent = FrequentlyAskedQuestion::where('frequently_asked_question_status' , 1)->count();
            
            $activeUserscurrents = User::where('active_status' , 1)->get();
            
            foreach($activeUserscurrents as $activeUser){
                $spenttie = $activeUser->userTimeSpent;
                if(count($spenttie)){
                    $usersNumberactivecurrent[] = $activeUser;
                }
            }
        
        // dd(count($usersNumberactive));
        

        return response()->json([
            'users' => $users,
            'algorithms' => $algorithms,
            'guidelines' => $guidelines,
            'totalSpentTime' => $totalSpentTime,
            'totalFormSubmition' => $totalFormSubmition,
            'totalFAQS' => $totalFAQS,
            'activeUsers' => count($usersNumberactive) , 
            
            'usersTotal' => $userscurrent,
            'algorithmsTotal' => $algorithmscurrent,
            'guidelinesTotal' => $guidelinescurrent,
            'totalSpentTimeTotal' => $totalSpentTimecurrent,
            'totalFormSubmitionTotal' => $totalFormSubmitioncurrent,
            'totalFaqsTotal' => $totalFAQScurrent,
            'activeUsersTotal' => count($usersNumberactivecurrent) , 
            
            
             ], 200); 
    }

}
