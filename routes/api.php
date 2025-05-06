<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

        Route::get('/home', 'HomeController@homeindex')->name('api.home');
        
        Route::get('/testapi', 'HomeController@testapi')->name('testapi');
        
        Route::get('/testapien', 'HomeController@testapien')->name('testapien');
        
        
        
        Route::get('/getContact', 'HomeController@getcontact')->name('getContact');
        
        Route::get('/getProjects', 'HomeController@getprojects')->name('getProjects');
        Route::get('/getSpecificProject/{id}', 'HomeController@getspecificproject')->name('getSpecificProject');
        
        Route::get('/getServices', 'HomeController@getservicess')->name('getServices');
        Route::get('/getSpecificService/{id}', 'HomeController@getspecificservice')->name('getSpecificService');
        
        Route::get('/getabout', 'HomeController@getabout')->name('getabout');
        
        Route::post('/submitform', 'HomeController@submitform')->name('submitform');
        
        
        // Start Authentication , Login , Register 
        
        Route::get('/cacheurl', 'HomeController@cacheurl')->name('cacheurl');
        
         Route::get('/getSpecificProtocol/{id}', 'HomeController@getSpecificProtocol')->name('getSpecificProtocol');
         
         Route::get('/getProtocol/{id}', 'HomeController@getProtocol')->name('getProtocol');
         
         
         Route::get('/getUserBookmarksGuideLine', 'HomeController@getUserBookmarksGuideLine')->name('getUserBookmarksGuideLine');
         
         Route::get('/updatechartsids', 'HomeController@updatechartsids')->name('updatechartsids');
         
         
         Route::post('/likeanswer/{id}', 'HomeController@likeanswer')->name('likeanswer');
         
         Route::post('/dislikeanswer/{id}', 'HomeController@dislikeanswer')->name('dislikeanswer');

        Route::post('/signin', 'AuthSignInController@signin')->name('signin');

        Route::post('/signup', 'AuthSignUpController@signup')->name('signup');
        Route::post('/checkEmailVerifiedCode', 'AuthSignUpController@checkEmailVerifiedCode')->name('checkEmailVerifiedCode');
        
        Route::post('/resetUserCode', 'AuthSignUpController@resetUserCode')->name('resetUserCode');
        Route::post('/resetUserPassword', 'AuthSignUpController@resetUserPassword')->name('resetUserPassword');
        
        
       
        Route::post('/resendusercode', 'AuthSignUpController@resendusercode')->name('resendusercode'); 
        
        Route::post('/deactivateuseraccount', 'HomeController@deactivateuseraccount')->name('deactivateuseraccount');
        Route::post('/activateuseraccount', 'HomeController@activateuseraccount')->name('activateuseraccount');
        Route::post('/deleteuseraccount', 'HomeController@deleteuseraccount')->name('deleteuseraccount');
        
        Route::get('/devicetoken', 'HomeController@devicetoken')->name('devicetoken');
        Route::get('/devicetokenNew', 'HomeController@devicetokenNew')->name('devicetokenNew');
        
        
        Route::post('/sendPushNotification', 'HomeController@sendPushNotification')->name('sendPushNotification');
  
        Route::post('/checkAuthAvaliable', 'HomeController@checkAuthAvaliable')->name('checkAuthAvaliable');
        
        Route::get('/generalsearchNew', 'HomeController@generalsearchNew')->name('generalsearchNew');
        
        Route::get('/getBlogs', 'HomeController@getBlogs')->name('getBlogs');
        Route::get('/getSingleBlogs/{slug}', 'HomeController@getSingleBlogs')->name('getSingleBlogs');
        
        
        Route::get('/subcategorysearch', 'HomeController@subcategorysearch')->name('subcategorysearch');
        Route::get('/protocolsearch', 'HomeController@protocolsearch')->name('protocolsearch');
        
        
        Route::post('/storeProtocolHistory', 'HomeController@storeProtocolHistory')->name('storeProtocolHistory');
        Route::get('/getuserHistory', 'HomeController@getuserHistory')->name('getuserHistory');
        
        Route::get('/getpatientHistory', 'HomeController@getpatientHistory')->name('getpatientHistory');
        
        Route::post('/checkpatiennameavail', 'HomeController@checkpatiennameavail')->name('checkpatiennameavail');
        
        Route::post('/savehistory', 'HomeController@savehistory')->name('savehistory');
        
        
        Route::get('/getArticles', 'HomeController@getArticles')->name('getArticles');
        
        Route::get('/aboutindex', 'AboutUsController@index')->name('aboutindex');
        Route::post('/aboutupdate/{id}', 'AboutUsController@update')->name('aboutupdate');

        Route::get('/chairmessageindex', 'ChairmanMessageController@index')->name('chairmessageindex');
        Route::post('/chairmessageupdate/{id}', 'ChairmanMessageController@update')->name('chairmessageupdate');

        Route::get('/contactinfoindex', 'ContactInformationController@index')->name('contactinfoindex');
        Route::post('/contactinfoupdate/{id}', 'ContactInformationController@update')->name('contactinfoupdate');
        
        Route::get('/arregation_index', 'ArregationSystemController@index')->name('arregation_index');
        Route::post('/arregation_store', 'ArregationSystemController@store')->name('arregation_store');
        Route::post('/arregation_update/{id}', 'ArregationSystemController@update')->name('arregation_update');
        Route::get('/arregation_data/{id}', 'ArregationSystemController@edit')->name('arregation_data');
        Route::post('/arregation_destroy/{id}', 'ArregationSystemController@destroy')->name('arregation_destroy');
        Route::post('/arregation_enable/{id}', 'ArregationSystemController@recover')->name('arregation_enable');
        
        Route::get('/feedback_index', 'ContactUsFormController@index')->name('feedback_index');
        Route::get('/feedback_data/{id}', 'ContactUsFormController@show')->name('feedback_data');


        Route::get('/feature_index', 'FeaturesController@index')->name('feature_index');
        Route::post('/feature_store', 'FeaturesController@store')->name('feature_store');
        Route::post('/feature_update/{id}', 'FeaturesController@update')->name('feature_update');
        Route::get('/feature_data/{id}', 'FeaturesController@edit')->name('feature_data');
        Route::post('/feature_destroy/{id}', 'FeaturesController@destroy')->name('feature_destroy');
        Route::post('/feature_enable/{id}', 'FeaturesController@recover')->name('feature_enable');


        Route::get('/why_us_index', 'WhyUsController@index')->name('why_us_index');
        Route::post('/why_us_store', 'WhyUsController@store')->name('why_us_store');
        Route::post('/why_us_update/{id}', 'WhyUsController@update')->name('why_us_update');
        Route::get('/why_us_data/{id}', 'WhyUsController@edit')->name('why_us_data');
        Route::post('/why_us_destroy/{id}', 'WhyUsController@destroy')->name('why_us_destroy');
        Route::post('/why_us_enable/{id}', 'WhyUsController@recover')->name('why_us_enable');
        
        
        Route::get('/blog_index', 'BlogController@index')->name('blog_index');
        Route::post('/blog_store', 'BlogController@store')->name('blog_store');
        Route::post('/blog_update/{id}', 'BlogController@update')->name('blog_update');
        Route::get('/blog_data/{id}', 'BlogController@edit')->name('blog_data');
        Route::post('/blog_destroy/{id}', 'BlogController@destroy')->name('blog_destroy');
        Route::post('/blog_enable/{id}', 'BlogController@recover')->name('blog_enable');
        
        
        Route::post('/resizeImage', 'BlogController@resizeImage')->name('resizeImage');
        
        


        Route::get('/partner_index', 'PartnerController@index')->name('partner_index');
        Route::get('/client_index', 'PartnerController@indexclient')->name('client_index');
        Route::post('/partner_store', 'PartnerController@store')->name('partner_store');
        Route::post('/client_store', 'PartnerController@storeclient')->name('client_store');
        Route::post('/partner_update/{id}', 'PartnerController@update')->name('partner_update');
        Route::post('/client_update/{id}', 'PartnerController@updateclient')->name('client_update');
        Route::get('/partner_data/{id}', 'PartnerController@edit')->name('partner_data');
        Route::post('/partner_destroy/{id}', 'PartnerController@destroy')->name('partner_destroy');
        Route::post('/partner_enable/{id}', 'PartnerController@recover')->name('partner_enable');


        Route::get('/service_index', 'ServiceController@index')->name('service_index');
        Route::get('/project_index', 'ServiceController@indexprojdct')->name('project_index');
        Route::post('/service_store', 'ServiceController@store')->name('service_store');
        Route::post('/project_store', 'ServiceController@storeproject')->name('project_store');
        Route::post('/service_update/{id}', 'ServiceController@update')->name('service_update');
        Route::post('/project_update/{id}', 'ServiceController@updateproject')->name('project_update');
        Route::get('/service_data/{id}', 'ServiceController@edit')->name('service_data');
        Route::post('/service_destroy/{id}', 'ServiceController@destroy')->name('service_destroy');
        Route::post('/service_enable/{id}', 'ServiceController@recover')->name('service_enable');

        Route::post('/uploadserviceimages/{id}', 'ServiceController@uploadserviceimages')->name('uploadserviceimages');
        Route::post('/disableserviceimage/{id}', 'ServiceController@disableserviceimage')->name('disableserviceimage');
        Route::post('/updateserviceimage/{id}', 'ServiceController@updateserviceimage')->name('updateserviceimage');

Route::post('/reorderservice', 'ServiceController@reorderservice')->name('reorderservice');




        

    // End Authentication API 
    
    // Start Search API 
        

    
    // Start Mobile Application API


    
    // End Mobile Application API
    
    
    

    // Start Dashboard Statistics , Home numbers

        Route::get('/dashboard_statistic', 'DashboardController@index')->name('dashboard_statistic');
        
        
        Route::get('/customnumbers', 'DashboardController@customnumbers')->name('customnumbers');
        

    // End Dashboard Statistics

    // Start Algorithm Index , Creation , update , destroy , recover
    
        Route::get('/algorithm_index', 'AlgorithmController@index')->name('algorithm_index');
        Route::post('/algorithm_store', 'AlgorithmController@store')->name('algorithm_store');
        Route::post('/algorithm_update/{id}', 'AlgorithmController@update')->name('algorithm_update');
        Route::get('/algorithm_update_data/{id}', 'AlgorithmController@edit')->name('algorithm_update_data');
        Route::post('/algorithm_destroy/{id}', 'AlgorithmController@destroy')->name('algorithm_destroy');
        Route::post('/algorithm_enable/{id}', 'AlgorithmController@recover')->name('algorithm_enable');

    // End Algorithm API

    // Start Contact Index , Show 

        Route::get('/contact_form_index', 'ContactUsFormController@index')->name('contact_form_index');
        Route::post('/contact_form_show/{id}', 'ContactUsFormController@show')->name('contact_form_show');

    // End Contact Form API

    // Start FAQS Index , Creation , update , destroy , recover
    
        Route::get('/faq_index', 'FrequentlyAskedQuestionController@index')->name('faq_index');
        Route::post('/faq_store', 'FrequentlyAskedQuestionController@store')->name('faq_store');
        Route::post('/faq_update/{id}', 'FrequentlyAskedQuestionController@update')->name('faq_update');
        Route::get('/faq_update_data/{id}', 'FrequentlyAskedQuestionController@edit')->name('faq_update_data');
        Route::post('/faq_destroy/{id}', 'FrequentlyAskedQuestionController@destroy')->name('faq_destroy');
        Route::post('/faq_enable/{id}', 'FrequentlyAskedQuestionController@recover')->name('faq_enable');

    // End FAQS API

    // Start Guide Line Images creation 

        Route::get('/guide_line_image_index', 'GuideLineImageController@index')->name('guide_line_image_index');
        Route::post('/guide_line_image_store', 'GuideLineImageController@store')->name('guide_line_image_store');

    // End Guide Line Images API

    // Start GuideLine Main Index , Creation , update , destroy , recover
    // Not Completed 
    
        Route::get('/guide_line_main_index', 'GuideLineMainController@index')->name('guide_line_main_index');
        Route::post('/guide_line_main_store', 'GuideLineMainController@store')->name('guide_line_main_store');
        Route::post('/guide_line_main_update/{id}', 'GuideLineMainController@update')->name('guide_line_main_update');
        Route::get('/guide_line_main_update_data/{id}', 'GuideLineMainController@edit')->name('guide_line_main_update_data');
        Route::post('/guide_line_main_destroy/{id}', 'GuideLineMainController@destroy')->name('guide_line_main_destroy');
        Route::post('/guide_line_main_enable/{id}', 'GuideLineMainController@recover')->name('guide_line_main_enable');
        Route::post('/publishGuideLine/{id}', 'GuideLineMainController@publishGuideLine')->name('publishGuideLine');

    // End GuideLine Main API

    // Start GuideLine Title Index , Creation , update , destroy , recover
    // Not Completed 
    
        Route::get('/guide_line_title_index', 'GuideLineTitleController@index')->name('guide_line_title_index');
        Route::get('/guide_line_main_title_index', 'GuideLineTitleController@create')->name('guide_line_main_title_index');
        Route::post('/guide_line_title_store', 'GuideLineTitleController@store')->name('guide_line_title_store');
        Route::post('/guide_line_title_update/{id}', 'GuideLineTitleController@update')->name('guide_line_title_update');
        Route::get('/guide_line_title_update_data/{id}', 'GuideLineTitleController@edit')->name('guide_line_title_update_data');
        Route::post('/guide_line_title_destroy/{id}', 'GuideLineTitleController@destroy')->name('guide_line_title_destroy');
        Route::post('/guide_line_title_enable/{id}', 'GuideLineTitleController@recover')->name('guide_line_title_enable');

    // End GuideLine Main API


    // Start GuideLine SubTitle Index , Creation , update , destroy , recover
    // Not Completed 
    
        Route::get('/guide_line_subtitle_index', 'GuideLineSubTitleController@index')->name('guide_line_subtitle_index');
        Route::get('/guide_line_main_subtitle_index', 'GuideLineSubTitleController@create')->name('guide_line_main_subtitle_index');
        Route::post('/guide_line_subtitle_store', 'GuideLineSubTitleController@store')->name('guide_line_subtitle_store');
        Route::post('/guide_line_subtitle_update/{id}', 'GuideLineSubTitleController@update')->name('guide_line_subtitle_update');
        Route::get('/guide_line_subtitle_update_data/{id}', 'GuideLineSubTitleController@edit')->name('guide_line_subtitle_update_data');
        Route::post('/guide_line_subtitle_destroy/{id}', 'GuideLineSubTitleController@destroy')->name('guide_line_subtitle_destroy');
        Route::post('/guide_line_subtitle_enable/{id}', 'GuideLineSubTitleController@recover')->name('guide_line_subtitle_enable');

    // End GuideLine Main API


    // Start NewsLetters Index , Creation , update , destroy , recover
    
        Route::get('/newsletter_index', 'NewsletterController@index')->name('newsletter_index');
        Route::post('/newsletter_store', 'NewsletterController@store')->name('newsletter_store');
        Route::post('/newsletter_update/{id}', 'NewsletterController@update')->name('newsletter_update');
        Route::get('/newsletter_update_data/{id}', 'NewsletterController@edit')->name('newsletter_update_data');
        Route::post('/newsletter_destroy/{id}', 'NewsletterController@destroy')->name('newsletter_destroy');
        Route::post('/newsletter_enable/{id}', 'NewsletterController@recover')->name('newsletter_enable');

        Route::post('/senduseremails', 'NewsletterController@senduseremails')->name('senduseremails');

    // End GuideLine Main API

    // Start Users Index , Creation , update , destroy , recover
    
        Route::get('/user_index', 'UsersController@index')->name('user_index');
        Route::post('/user_store', 'UsersController@store')->name('user_store');
        Route::get('/user_data/{id}', 'UsersController@show')->name('user_data');
        Route::post('/user_destroy/{id}', 'UsersController@destroy')->name('user_destroy');
        Route::post('/user_enable/{id}', 'UsersController@recover')->name('user_enable');

    // End GuideLine Main API




    