<?php

if(
    strpos($config->url_current, $config->url . '/' . $config->manager->slug . '/article/') === 0 ||
    strpos($config->url_current, $config->url . '/' . $config->manager->slug . '/page/') === 0 ||
    strpos($config->url_current, $config->url . '/' . $config->manager->slug . '/comment/') === 0
) {

    Weapon::add('shell_after', function() {
        echo Asset::stylesheet('cabinet/plugins/' . basename(__DIR__) . '/shell/full-screen.css');
    });

    Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
        $speak = Config::speak();
        echo '<script>
(function($, base) {
    var $area = $(\'.MTE\');
    $area.attr(\'data-plugin-fse-languages\', \'' . $speak->plugin_fse_title_full_screen_in . '|' . $speak->plugin_fse_title_full_screen_out . '\');
    $area.wrap(\'<div class="full-screen-wrapper"></div>\');
})(Zepto, DASHBOARD);
</script>';
    }, 9);

    Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
        echo Asset::javascript('cabinet/plugins/' . basename(__DIR__) . '/sword/full-screen.js');
    }, 11);

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