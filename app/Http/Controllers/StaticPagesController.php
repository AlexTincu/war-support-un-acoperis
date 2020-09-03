<?php

namespace App\Http\Controllers;

use A17\Twill\Models\Block;
use A17\Twill\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class StaticPagesController
 * @package App\Http\Controllers
 */
class StaticPagesController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function home(Request $request, SettingRepository $settingRepository)
    {
        return view('frontend.home')
            ->with('homepageMessage', $settingRepository->byKey('homepage_message'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function about(Request $request)
    {
        return view('frontend.about');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function partners(Request $request)
    {
        return view('frontend.partners');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function media(Request $request)
    {
        return view('frontend.media');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function news(Request $request)
    {
        return view('frontend.news');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function privacyPolicy(Request $request)
    {
        return view('frontend.privacy-policy');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function termsAndConditions(Request $request)
    {
        return view('frontend.terms-and-conditions');
    }
}
