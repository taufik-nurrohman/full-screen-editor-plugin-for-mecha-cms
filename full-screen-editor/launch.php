<?php

if($config->page_type == 'manager') {

    Weapon::add('shell_after', function() {
        echo Asset::stylesheet('cabinet/plugins/' . basename(__DIR__) . '/shell/full-screen.css');
    });

    $speak = Config::speak();

    Config::merge('DASHBOARD.languages.MTE.others', array(
        'plugin_fse_title_full_screen' => array($speak->plugin_fse_title_full_screen_in, $speak->plugin_fse_title_full_screen_out)
    ));

    Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
        echo '<script>!function(a,b){for(var d,c=b.getElementsByTagName("textarea"),e=0,f=c.length;f>e;++e)!/(^| )MTE-ignore( |$)/.test(c[e].className)&&(d=b.createElement("span"),d.className="full-screen-wrapper full-screen-wrapper-"+(e+1),c[e].parentNode.appendChild(d),d.appendChild(c[e]))}(window,document);</script>';
    }, 1);

    Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
        echo Asset::javascript('cabinet/plugins/' . basename(__DIR__) . '/sword/full-screen.js');
    }, 20);

}


/**
 * Plugin Updater
 * --------------
 */

Route::accept($config->manager->slug . '/plugin/' . basename(__DIR__) . '/update', function() use($config, $speak) {
    if( ! Guardian::happy()) {
        Shield::abort();
    }
    if($request = Request::post()) {
        Guardian::checkToken($request['token']);
        File::write($request['css'])->saveTo(PLUGIN . DS . basename(__DIR__) . DS . 'shell' . DS . 'full-screen.css');
        Notify::success(Config::speak('notify_success_updated', array($speak->plugin)));
        Guardian::kick(dirname($config->url_current));
    }
});