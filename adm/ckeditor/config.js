/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function(config)
{
	  // 編輯器樣式，有三種：'kama'（默認）、'office2003'、'v2'
    config.skin = 'kama';
    // 背景顏色
    config.uiColor = '#999999';
    // 設置寬高
    config.width = 820;
    config.height = 400;
    //字體編輯時的字元集 可以添加常用的中文字元：宋體、楷體、黑體等 plugins/font/plugin.js
    config.font_names = 'Arial;Times New Roman;Verdana;細明體;新細明體;微軟正黑體;宋體;標楷體;';
    //字體默認大小 plugins/font/plugin.js
    config.fontSize_defaultLabel = '13px';
    //字體編輯時可選的字體大小 plugins/font/plugin.js
    config.fontSize_sizes ='8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;15/15px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px'
    // 工具欄（基礎'Basic'、全能'Full'、自定義）plugins/toolbar/plugin.js
    config.toolbar = 'MXICToolbar';
    config.toolbar_MXICToolbar =
    [
    ['Source','-','NewPage','Save','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],['Maximize','ShowBlock'],
    '/',    
    ['Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    ['Styles','Format','Font','FontSize'],
    ['TextColor','BGColor'],
    ];
config.filebrowserBrowseUrl = '../ckfinder/ckfinder.html';
config.filebrowserImageBrowseUrl = '../ckfinder/ckfinder.html?Type=Images';
config.filebrowserFlashBrowseUrl = '../ckfinder/ckfinder.html?Type=Flash';
config.filebrowserUploadUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
config.filebrowserImageUploadUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
config.filebrowserFlashUploadUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';    
};