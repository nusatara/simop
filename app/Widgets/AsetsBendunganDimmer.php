<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\Models\AsetsBendungan;

class AsetsBendunganDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = AsetsBendungan::count();
        $string = 'Aset Bendungan ';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-company',
            'title'  => "{$count} {$string}",
            'text'   => "Anda mempunyai ".$count." ".$string." didalam database. Klik tombol dibawah ini untuk melihat " .$string,
            'button' => [
                'text' => 'Lihat Semua '.$string,
                'link' => route('voyager.asets-bendungan.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    // public function shouldBeDisplayed()
    // {
    //     return Auth::user()->can('browse', AsetsBendungan);
    // }
}
