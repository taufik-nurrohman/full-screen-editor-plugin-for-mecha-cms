<?php

Weapon::add('shell_after', function() {
    echo Asset::stylesheet(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'button.css');
});

Config::merge('DASHBOARD.languages.MTE', array(
    'plugin_full_screen_editor' => Mecha::A($speak->plugin_full_screen_editor)
));

Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
    echo '<script>!function(a,b){for(var d,c=b.getElementsByTagName("textarea"),e=0,f=c.length;f>e;++e)!/(^|\s)MTE-ignore(\s|$)/.test(c[e].className)&&(d=b.createElement("span"),d.className="full-screen-wrapper full-screen-wrapper-"+(e+1),c[e].parentNode.appendChild(d),d.appendChild(c[e]))}(window,document);</script>';
}, 1);

Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
    echo Asset::javascript(__DIR__ . DS . 'assets' . DS . 'sword' . DS . 'button.js');
}, 20);


/**
 * Plugin Updater
 * --------------
 */

Route::accept($config->manager->slug . '/plugin/' . File::B(__DIR__) . '/update', function() use($config, $speak) {
    if( ! Guardian::happy()) {
        Shield::abort();
    }
    if($request = Request::post()) {
        Guardian::checkToken($request['token']);
        File::write($request['css'])->saveTo(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'button.css');
        Notify::success(Config::speak('notify_success_updated', $speak->plugin));
        Guardian::kick(File::D($config->url_current));
    }
});