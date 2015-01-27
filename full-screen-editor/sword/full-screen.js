(function($, base) {
    if (typeof base.composer == "undefined") return;
    var is_expand = false,
        the_base = document.documentElement,
        the_base_class = the_base.className,
        the_actions = document.getElementsByName('action')[0].parentNode,
        the_languages = base.composer.grip.area.getAttribute('data-plugin-fse-languages').split('|');
    the_actions.className = the_actions.className + ' full-screen-actions';
    base.composer.button('expand', {
        title: the_languages[0],
        position: 1,
        click: function(e, editor) {
            var the_clicked = e.target.getAttribute('href') ? e.target : e.target.parentNode,
                the_icon = the_clicked.firstChild,
                s = editor.grip.selection();
            editor.grip.area.removeAttribute('style');
            editor.grip.select(s.start, s.end);
            if (!is_expand) {
                the_base.className = the_base_class + ' MTE-editor-is-expanded';
                the_clicked.hash = 'compress';
                the_clicked.title = the_languages[1];
                the_icon.className = the_icon.className.replace(/-expand/, '-compress');
                is_expand = true;
            } else {
                the_base.className = the_base_class;
                the_clicked.hash = 'expand';
                the_clicked.title = the_languages[0];
                the_icon.className = the_icon.className.replace(/-compress/, '-expand');
                is_expand = false;
            }
        }
    });
})(Zepto, DASHBOARD);