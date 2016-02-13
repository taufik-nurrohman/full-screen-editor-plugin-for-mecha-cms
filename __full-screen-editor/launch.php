<?php

Config::merge('DASHBOARD.languages.MTE.plugin_full_screen_editor', $speak->plugin_full_screen_editor);

Weapon::add('shell_after', function() {
    echo Asset::stylesheet(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'full-screen-editor.css', "", 'shell/full-screen-editor.min.css');
});

Filter::add('form:unit.textarea', function($content, $attr) {
    if(isset($attr['class'])) {
        if(Mecha::walk($attr['class'])->has('MTE')) {
            return '<div class="full-screen-wrapper">' . $content . '</div>';
        }
    }
    return $content;
});

Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
    echo Asset::javascript(__DIR__ . DS . 'assets' . DS . 'sword' . DS . 'button.js', "", 'sword/editor.button.' . ltrim(File::B(__DIR__), '_') . '.min.js');
}, 20);


/**
 * Plugin Updater
 * --------------
 */

Route::over($config->manager->slug . '/plugin/' . File::B(__DIR__) . '/update', function() {
    File::write(Request::post('css'))->saveTo(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'full-screen-editor.css');
    unset($_POST['css']);
});