/*
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
(function(){tinymce.PluginManager.requireLangPack("roksprocket");tinymce.create("tinymce.plugins.RokSprocketPlugin",{init:function(a,b){a.addCommand("mceRokSprocket",function(){a.windowManager.open({file:ajaxurl+"?action=roksprocket_tinymce&type=tinymce",width:450+a.getLang("roksprocket.delta_width",0),height:150+a.getLang("roksprocket.delta_height",0),inline:1},{plugin_url:b,some_custom_arg:""});
});a.addButton("roksprocket",{title:"roksprocket.desc",cmd:"mceRokSprocket",image:b+"/roksprocket_16x16.png"});a.onNodeChange.add(function(d,c,e){c.setActive("roksprocket",e.nodeName=="IMG");
});},createControl:function(b,a){return null;},getInfo:function(){return{longname:"RokSprocket Plugin",author:"Rocket Theme",authorurl:"http://rockettheme.com",infourl:"http://rockettheme.com",version:"1.0"};
}});tinymce.PluginManager.add("roksprocket",tinymce.plugins.RokSprocketPlugin);})();