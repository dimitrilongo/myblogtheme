/*
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
edButtons[edButtons.length]=new edButton("ed_roksprocket","roksprocket","","","r");window.addEvent("domready",function(){if($("ed_roksprocket")){$("ed_roksprocket").addEvent("mouseover",function(){if($("roksprocket_link")==null){var b=ajaxurl+"?action=roksprocket_tinymce&type=qtags&TB_iframe=true&height=100&width=350&modal=false";
var a=Element("a#roksprocket_link").wraps(this);$("roksprocket_link").setProperty("href",b);$("roksprocket_link").setProperty("class","thickbox");}});}});
