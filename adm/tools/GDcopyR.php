<?
//www.buezz.com.tw GDcopyR v0.6
//http://www.bluezz.com.tw/mybook/content.php?id=593
//$copyRSrc:版權圖位置(請使用png格式透明圖)
//$picSrc:來源圖片檔案位置
//$picDes:目標圖片檔案位置
//$Width:圖片寬
//$Height:圖片高
//$quality:圖片品質1~100
function GDcopyR($copyRSrc, $picSrc, $picDes, $Width, $Height,$quality){

	//檢查檔案是否存在 
	if ( file_exists($picSrc) ) {
		$srcInfo  = pathInfo($picSrc); 
		$srcSize = getImageSize($picSrc);

		$destSize[0] =  $Width;
		$destSize[1] =  $Height;

		//根據副檔名讀取圖檔 
		switch (strtolower($srcInfo['extension'])) { 
			case "gif": $imgSrc = imageCreateFromGif($picSrc); break; 
			case "jpg": $imgSrc = imageCreateFromJpeg($picSrc); break; 
			case "png": $imgSrc = imageCreateFromPng($picSrc); break; 
			default:$imgSrc = imageCreateFromJpeg($picSrc); break;
		} 
	
		$imgDes = imageCreateTrueColor($destSize[0],$destSize[1]); //GD2.0以上適用
		//建立縮圖
		ImageCopyResampled($imgDes, $imgSrc, 0, 0, 0, 0, $destSize[0], $destSize[1], $srcSize[0], $srcSize[1]);
		imagedestroy($imgSrc);

		//檢查檔案是否存在 
		if ( file_exists($copyRSrc) ) {
			//讀取版權圖
			$RSize = getImageSize($copyRSrc);
			$RInfo = pathInfo($copyRSrc);
			//根據副檔名讀取圖檔 
			switch (strtolower($RInfo['extension'])) { 
				case "gif": $RSrc = imageCreateFromGif($copyRSrc); break; 
				case "jpg": $RSrc = imageCreateFromJpeg($copyRSrc); break; 
				case "png": $RSrc = imageCreateFromPng($copyRSrc); break; 
				default:$RSrc = imageCreateFromPng($picSrc); break;
			} 
			//版權圖過大時進行縮放
			$W = ($RSize[0] > $srcSize[0])? $srcSize[0]:$RSize[0];

			//寫入版權圖
			ImageCopyResampled($imgDes, $RSrc, 0, $destSize[1] - $RSize[1] , 0, 0 ,$W, $RSize[1],$RSize[0], $RSize[1]);

			imagedestroy($RSrc);
		}
		//寫入檔案
		imageJpeg($imgDes, $picDes,$quality);
		
		imagedestroy($imgDes);
		return true;
	}
	return false;
}
?>