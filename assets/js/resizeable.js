function resizable(e){var i;is("largescreen")&&(i=public_vars.$sidebarMenu.find(".sidebar-collapse-icon").hasClass("with-animation")||public_vars.$sidebarMenu.hasClass("with-animation"),"open"==public_vars.$sidebarMenu.data("initial-state")?show_sidebar_menu(i):hide_sidebar_menu(i)),ismdxl()&&public_vars.$mainMenu.attr("style",""),is("tabletscreen")&&(i=public_vars.$sidebarMenu.find(".sidebar-collapse-icon").hasClass("with-animation")||public_vars.$sidebarMenu.hasClass("with-animation"),hide_sidebar_menu(i)),isxs()&&public_vars.$pageContainer.removeClass("sidebar-collapsed"),jQuery(window).trigger("neon.resize")}function get_current_breakpoint(){var e=jQuery(window).width(),i=public_vars.breakpoints;for(var r in i){var a=i[r],s=a[0],n=a[1];if(-1==n&&(n=e),e>=s&&n>=e)return r}return null}function is(e){return get_current_breakpoint()==e}function isxs(){return is("devicescreen")||is("sdevicescreen")}function ismdxl(){return is("tabletscreen")||is("largescreen")}function trigger_resizable(){public_vars.lastBreakpoint!=get_current_breakpoint()&&(public_vars.lastBreakpoint=get_current_breakpoint(),resizable(public_vars.lastBreakpoint))}var public_vars=public_vars||{};jQuery.extend(public_vars,{breakpoints:{largescreen:[991,-1],tabletscreen:[768,990],devicescreen:[420,767],sdevicescreen:[0,419]},lastBreakpoint:null});