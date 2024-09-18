/*
 * CKFinder
 * ========
 * http://ckfinder.com
 * Copyright (C) 2007-2012, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file, and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying, or distributing this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object for the Chinese-Simplified
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['zh-tw'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, 不可用</span>',
		confirmCancel	: '部分內容尚未保存，確定關閉對話方塊麼?',
		ok				: '確定',
		cancel			: '取消',
		confirmationTitle	: '確認',
		messageTitle	: '提示',
		inputTitle		: '詢問',
		undo			: '撤銷',
		redo			: '重做',
		skip			: '跳過',
		skipAll			: '全部跳過',
		makeDecision	: '應採取何樣措施?',
		rememberDecision: '下次不再詢問'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'ltr',
	HelpLang : 'tw',
	LangCode : 'zh-tw',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'yyyy年m月d日 h:MM aa',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: '資料夾',
	FolderLoading	: '正在載入資料夾...',
	FolderNew		: '請輸入新資料夾名稱: ',
	FolderRename	: '請輸入新資料夾名稱: ',
	FolderDelete	: '您確定要刪除資料夾 "%1" 嗎?',
	FolderRenaming	: ' (正在重命名...)',
	FolderDeleting	: ' (正在刪除...)',

	// Files
	FileRename		: '請輸入新檔案名: ',
	FileRenameExt	: '如果改變檔副檔名，可能會導致檔不可用。\r\n確定要更改嗎？',
	FileRenaming	: '正在重命名...',
	FileDelete		: '您確定要刪除檔 "%1" 嗎?',
	FilesLoading	: '載入中...',
	FilesEmpty		: '空資料夾',
	FilesMoved		: '檔案 %1 已移動至 %2:%3.',
	FilesCopied		: '檔 %1 已拷貝至 %2:%3.',

	// Basket
	BasketFolder		: '暫存資料夾',
	BasketClear			: '清空暫存資料夾',
	BasketRemove		: '從暫存資料夾移除',
	BasketOpenFolder	: '打開暫存資料夾',
	BasketTruncateConfirm : '確認清空暫存資料夾?',
	BasketRemoveConfirm	: '確認從暫存資料夾中移除檔案 "%1"？',
	BasketEmpty			: '暫存資料夾為空, 可拖放檔至其中.',
	BasketCopyFilesHere	: '從暫存資料夾複製至此',
	BasketMoveFilesHere	: '從暫存資料夾移動至此',

	BasketPasteErrorOther	: '檔案 %s 出錯: %e',
	BasketPasteMoveSuccess	: '已移動以下檔: %s',
	BasketPasteCopySuccess	: '已拷貝以下檔: %s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: '上傳',
	UploadTip	: '上傳檔案',
	Refresh		: '重新整理',
	Settings	: '設置',
	Help		: '幫助',
	HelpTip		: '查看線上說明',

	// Context Menus
	Select			: '選擇',
	SelectThumbnail : '選擇縮圖',
	View			: '查看',
	Download		: '下載',

	NewSubFolder	: '創建子資料夾',
	Rename			: '重命名',
	Delete			: '刪除',

	CopyDragDrop	: '將檔複製至此',
	MoveDragDrop	: '將檔案移動至此',

	// Dialogs
	RenameDlgTitle		: '重新命名',
	NewNameDlgTitle		: '檔案名',
	FileExistsDlgTitle	: '檔案已存在',
	SysErrorDlgTitle : '系統錯誤',

	FileOverwrite	: '自動覆蓋檔名',
	FileAutorename	: '自動重命名檔名',

	// Generic
	OkBtn		: '確定',
	CancelBtn	: '取消',
	CloseBtn	: '關閉',

	// Upload Panel
	UploadTitle			: '上傳檔案',
	UploadSelectLbl		: '選定要上傳的檔案',
	UploadProgressLbl	: '(正在上傳檔案，請稍候...)',
	UploadBtn			: '上傳選定的檔案',
	UploadBtnCancel		: '取消',

	UploadNoFileMsg		: '請選擇一個要上傳的檔',
	UploadNoFolder		: '需先選擇一個檔.',
	UploadNoPerms		: '無檔案上傳許可權.',
	UploadUnknError		: '上傳檔案出錯.',
	UploadExtIncorrect	: '此檔案尾碼在當前資料夾中不可用.',

	// Flash Uploads
	UploadLabel			: '上傳檔案',
	UploadTotalFiles	: '上傳總計:',
	UploadTotalSize		: '上傳總大小:',
	UploadSend			: '上傳',
	UploadAddFiles		: '添加檔案',
	UploadClearFiles	: '清空檔案',
	UploadCancel		: '取消上傳',
	UploadRemove		: '刪除',
	UploadRemoveTip		: '已刪除!f',
	UploadUploaded		: '已上傳!n%',
	UploadProcessing	: '上傳中...',

	// Settings Panel
	SetTitle		: '設置',
	SetView			: '查看:',
	SetViewThumb	: '縮圖',
	SetViewList		: '列表',
	SetDisplay		: '顯示:',
	SetDisplayName	: '檔案名',
	SetDisplayDate	: '日期',
	SetDisplaySize	: '大小',
	SetSort			: '排列順序:',
	SetSortName		: '按檔案名',
	SetSortDate		: '按日期',
	SetSortSize		: '按大小',
	SetSortExtension		: '按副檔名',

	// Status Bar
	FilesCountEmpty : '<空資料夾>',
	FilesCountOne	: '1 個檔案',
	FilesCountMany	: '%1 個檔案',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: '請求的操作未能完成. (錯誤 %1)',
	Errors :
	{
	 10 : '無效的指令.',
	 11 : '檔案類型不在許可範圍之內.',
	 12 : '檔案類型無效.',
	102 : '無效的檔案名或資料夾名稱.',
	103 : '由於作者限制，該請求不能完成.',
	104 : '由於檔案系統的限制，該請求不能完成.',
	105 : '無效的副檔名.',
	109 : '無效請求.',
	110 : '未知錯誤.',
	115 : '存在重名的檔案或資料夾.',
	116 : '資料夾不存在. 請刷新後再試.',
	117 : '檔案不存在. 請刷新列表後再試.',
	118 : '目標位置與當前位置相同.',
	201 : '檔案與現有的重名. 新上傳的檔案改名為 "%1".',
	202 : '無效的檔.',
	203 : '無效的檔. 檔案尺寸太大.',
	204 : '上傳檔案已損失.',
	205 : '伺服器中的上傳暫存檔案夾無效.',
	206 : '因為安全原因，上傳中斷. 上傳檔包含不能 HTML 類型資料.',
	207 : '新上傳的檔案改名為 "%1".',
	300 : '移動檔失敗.',
	301 : '複製檔失敗.',
	500 : '因為安全原因，檔不可流覽. 請聯繫系統管理員並檢查CKFinder設定檔.',
	501 : '不支援縮略圖方式.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: '檔案名不能為空.',
		FileExists		: '檔案 %s 已存在.',
		FolderEmpty		: '資料夾名稱不能為空.',

		FileInvChar		: '檔案名不能包含以下字元: \n\\ / : * ? " < > |',
		FolderInvChar	: '資料夾名稱不能包含以下字元: \n\\ / : * ? " < > |',

		PopupBlockView	: '未能在新視窗中打開檔. 請修改流覽器配置解除對本網站的鎖定.',
		XmlError		: '從伺服器讀取XML資料出錯',
		XmlEmpty		: '無法從伺服器讀取資料，因XML回應返回結果為空',
		XmlRawResponse	: '伺服器返回原始結果: %s'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: '改變尺寸 %s',
		sizeTooBig		: '無法大於原圖尺寸 (%size).',
		resizeSuccess	: '圖像尺寸已修改.',
		thumbnailNew	: '創建縮略圖',
		thumbnailSmall	: '小 (%s)',
		thumbnailMedium	: '中 (%s)',
		thumbnailLarge	: '大 (%s)',
		newSize			: '設置新尺寸',
		width			: '寬度',
		height			: '高度',
		invalidHeight	: '無效高度.',
		invalidWidth	: '無效寬度.',
		invalidName		: '檔案名無效.',
		newImage		: '創建圖像',
		noExtensionChange : '無法改變檔尾碼.',
		imageSmall		: '原檔案尺寸過小',
		contextMenuName	: '改變尺寸',
		lockRatio		: '鎖定比例',
		resetSize		: '原始尺寸'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: '存檔',
		fileOpenError	: '無法打開檔案.',
		fileSaveSuccess	: '成功保存檔.',
		contextMenuName	: '編輯',
		loadingFile		: '載入檔中...'
	},

	Maximize :
	{
		maximize : '全螢幕',
		minimize : '最小化'
	}
};
