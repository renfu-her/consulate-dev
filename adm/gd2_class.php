<?php
/**
+-----------------------------------------------------------------------+
* @autor  <tonera at gmail.com>;
* @since 2006-2-28
* @version $Id: class_Photo.php,v 1.0 tonera$
* @description        生成缩略图存放
+-----------------------------------------------------------------------+
*/
class Photo {
        var $height              = 120;                //缩略图高度
        var $width               = 80;                //缩略图宽度
        var $quality             = 70;                //图片质量
        var $newPicPrefix        = 's';                //缩略图前缀
        var $newPicPath          = '';                //缩略图存放路径
        var $errorMsg            = '';                //错误信息
        var $picType        = array(
        "2"  => array("create"=>"ImageCreateFromjpeg","output"=>"imagejpeg"),
        "1"  => array("create"=>"ImageCreateFromGIF" ,"output"=>"imagegif"),
        "4"  => array("create"=>"imagecreatefrompng" ,"output"=>"imagepng"),
        "8"  => array("create"=>"imagecreatefromwbmp","output"=>"image2wbmp"));        //图像类型
        
        function Photo() {
                ;
        }
        
        /**
        * 设置缩略图像高度
        */
        function setHeight($height) {
                $this->height        = $height;
        }
        /**
        * 设置缩略图像宽度
        */
        function setWidth($width) {
                $this->width        = $width;
        }
        /**
        * 设置缩略图前缀
        */
        function setNewPicPrefix($newPicPrefix) {
                $this->newPicPrefix        = $newPicPrefix;
        }
        /**
        * 设置缩略图存放路径
        */
        function setNewPicPath($newPicPath) {
                $this->newPicPath        = $newPicPath;
        }
        /**
        * 设置图片质量
        */
        function setQuality($quality) {
                $this->quality        = $quality;
        }

        /**
        * 将一指定图像处理生成缩略图
        */
        function creatIMG($picFile,$ouput=true) {
		
                //检查图像是否存在,是否合法,mime类型,分析图像路径
                if(!@file_exists($picFile)) {
                        $this->errorMsg        = '文件不存在';
                        $this->_errMsg();
                }
                //取mime类型
                $rs        = getimagesize($picFile);
                if(!$rs) {
                        $this->errorMsg        = '文件不是一个合法的图片';
                        Return;
                }
                //var_dump($rs);
                //新图存入路径
                $imgPath        = dirname($picFile);
                $fileName        = basename($picFile);
				
				/*
                if(strpos($fileName,$this->newPicPrefix."__")!==false) {                //已被缩略的图不处理
                        Return;
                }
				*/
				
                if(!empty($this->newPicPath)) {
                        $newPath        = $this->newPicPath;
                        if(!is_writable($newPath)) {
                                $this->errorMsg        = "新的缩略图目录不可写入,生成的缩略图存在源图目录下.";                //有错误,但并不中断
                        }
                }else {
                        $newPath        = $imgPath;
                }                
                $newFile        = $newPath."/".$this->newPicPrefix.$fileName;
                $src_width        = $rs[0];
                $src_height        = $rs[1];
                $createFunc        = $this->picType[$rs[2]]['create'];
                $outpurFunc        = $this->picType[$rs[2]]['output'];
                if ($this->width && ($src_width < $src_height)) {
                       $this->width        = round(($this->height / $src_height) * $src_width);
                } else {
                       $this->height        = round(($this->width / $src_width) * $src_height);
                }
				
                $newImg        = imagecreatetruecolor($this->width, $this->height);				
                $image        = $createFunc($picFile);
                imagecopyresampled($newImg, $image, 0, 0, 0, 0, $this->width, $this->height, $src_width, $src_height);
                if($ouput) {
                        $result        = @$outpurFunc($newImg, $newFile, $this->quality);
                }else {
                        header('Content-type: '.$rs['mime']);
                        $result        = @$outpurFunc($newImg, null, $this->quality);
                }
                @imagedestroy($newImg);
                @imagedestroy($image);
        }

        /**
        * 错误处理 
        */
        function _errMsg() {
                exit($this->errorMsg);
        }
        /**
        * 捕捉异常报告
        */
        function getErrorMsg() {
                Return $this->errorMsg;
        }
}
class Photob {
        var $height              = 120;                //缩略图高度
        var $width               = 80;                //缩略图宽度
        var $quality             = 70;                //图片质量
        var $newPicPrefix        = 'b';                //缩略图前缀
        var $newPicPath          = '';                //缩略图存放路径
        var $errorMsg            = '';                //错误信息
        var $picType        = array(
        "2"  => array("create"=>"ImageCreateFromjpeg","output"=>"imagejpeg"),
        "1"  => array("create"=>"ImageCreateFromGIF" ,"output"=>"imagegif"),
        "4"  => array("create"=>"imagecreatefrompng" ,"output"=>"imagepng"),
        "8"  => array("create"=>"imagecreatefromwbmp","output"=>"image2wbmp"));        //图像类型
        
        function Photo() {
                ;
        }
        
        /**
        * 设置缩略图像高度
        */
        function setHeight($height) {
                $this->height        = $height;
        }
        /**
        * 设置缩略图像宽度
        */
        function setWidth($width) {
                $this->width        = $width;
        }
        /**
        * 设置缩略图前缀
        */
        function setNewPicPrefix($newPicPrefix) {
                $this->newPicPrefix        = $newPicPrefix;
        }
        /**
        * 设置缩略图存放路径
        */
        function setNewPicPath($newPicPath) {
                $this->newPicPath        = $newPicPath;
        }
        /**
        * 设置图片质量
        */
        function setQuality($quality) {
                $this->quality        = $quality;
        }
		function creatIMG($picFile,$ouput=true) {
		
                //检查图像是否存在,是否合法,mime类型,分析图像路径
                if(!@file_exists($picFile)) {
                        $this->errorMsg        = '文件不存在';
                        $this->_errMsg();
                }
                //取mime类型
                $rs        = getimagesize($picFile);
                if(!$rs) {
                        $this->errorMsg        = '文件不是一个合法的图片';
                        Return;
                }
                //var_dump($rs);
                //新图存入路径
                $imgPath        = dirname($picFile);
                $fileName        = basename($picFile);
				
				/*
                if(strpos($fileName,$this->newPicPrefix."__")!==false) {                //已被缩略的图不处理
                        Return;
                }
				*/
				
                if(!empty($this->newPicPath)) {
                        $newPath        = $this->newPicPath;
                        if(!is_writable($newPath)) {
                                $this->errorMsg        = "新的缩略图目录不可写入,生成的缩略图存在源图目录下.";                //有错误,但并不中断
                        }
                }else {
                        $newPath        = $imgPath;
                }                
                $newFile        = $newPath."/".$this->newPicPrefix.$fileName;
                $src_width        = $rs[0];
                $src_height        = $rs[1];
                $createFunc        = $this->picType[$rs[2]]['create'];
                $outpurFunc        = $this->picType[$rs[2]]['output'];
                if ($this->width && ($src_width < $src_height)) {
                       $this->width        = round(($this->height / $src_height) * $src_width);
                } else {
                       $this->height        = round(($this->width / $src_width) * $src_height);
                }
				
                $newImg        = imagecreatetruecolor($this->width, $this->height);				
                $image        = $createFunc($picFile);
                imagecopyresampled($newImg, $image, 0, 0, 0, 0, $this->width, $this->height, $src_width, $src_height);
                if($ouput) {
                        $result        = @$outpurFunc($newImg, $newFile, $this->quality);
                }else {
                        header('Content-type: '.$rs['mime']);
                        $result        = @$outpurFunc($newImg, null, $this->quality);
                }
                @imagedestroy($newImg);
                @imagedestroy($image);
        }
        
        /**
        * 错误处理 
        */
        function _errMsg() {
                exit($this->errorMsg);
        }
        /**
        * 捕捉异常报告
        */
        function getErrorMsg() {
                Return $this->errorMsg;
        }
}
class PhotoS {
        var $height              = 120;                //缩略图高度
        var $width               = 80;                //缩略图宽度
        var $quality             = 70;                //图片质量
        var $newPicPrefix        = '';                //缩略图前缀
        var $newPicPath          = '';                //缩略图存放路径
        var $errorMsg            = '';                //错误信息
        var $picType        = array(
        "2"  => array("create"=>"ImageCreateFromjpeg","output"=>"imagejpeg"),
        "1"  => array("create"=>"ImageCreateFromGIF" ,"output"=>"imagegif"),
        "4"  => array("create"=>"imagecreatefrompng" ,"output"=>"imagepng"),
        "8"  => array("create"=>"imagecreatefromwbmp","output"=>"image2wbmp"));        //图像类型
        
        function Photo() {
                ;
        }
        
        /**
        * 设置缩略图像高度
        */
        function setHeight($height) {
                $this->height        = $height;
        }
        /**
        * 设置缩略图像宽度
        */
        function setWidth($width) {
                $this->width        = $width;
        }
        /**
        * 设置缩略图前缀
        */
        function setNewPicPrefix($newPicPrefix) {
                $this->newPicPrefix        = $newPicPrefix;
        }
        /**
        * 设置缩略图存放路径
        */
        function setNewPicPath($newPicPath) {
                $this->newPicPath        = $newPicPath;
        }
        /**
        * 设置图片质量
        */
        function setQuality($quality) {
                $this->quality        = $quality;
        }

        /**
        * 将一指定图像处理生成缩略图
        */
        function creatIMG($picFile,$ouput=true) {
		
                //检查图像是否存在,是否合法,mime类型,分析图像路径
                if(!@file_exists($picFile)) {
                        $this->errorMsg        = '文件不存在';
                        $this->_errMsg();
                }
                //取mime类型
                $rs        = getimagesize($picFile);
                if(!$rs) {
                        $this->errorMsg        = '文件不是一个合法的图片';
                        Return;
                }
                //var_dump($rs);
                //新图存入路径
                $imgPath        = dirname($picFile);
                $fileName        = basename($picFile);
				
				/*
                if(strpos($fileName,$this->newPicPrefix."__")!==false) {                //已被缩略的图不处理
                        Return;
                }
				*/
				
                if(!empty($this->newPicPath)) {
                        $newPath        = $this->newPicPath;
                        if(!is_writable($newPath)) {
                                $this->errorMsg        = "新的缩略图目录不可写入,生成的缩略图存在源图目录下.";                //有错误,但并不中断
                        }
                }else {
                        $newPath        = $imgPath;
                }                
                $newFile        = $newPath."/".$this->newPicPrefix.$fileName;
                $src_width        = $rs[0];
                $src_height        = $rs[1];
                $createFunc        = $this->picType[$rs[2]]['create'];
                $outpurFunc        = $this->picType[$rs[2]]['output'];
                if ($this->width && ($src_width < $src_height)) {
                       $this->width        = round(($this->height / $src_height) * $src_width);
                } else {
                       $this->height        = round(($this->width / $src_width) * $src_height);
                }
				
                $newImg        = imagecreatetruecolor($this->width, $this->height);				
                $image        = $createFunc($picFile);
                imagecopyresampled($newImg, $image, 0, 0, 0, 0, $this->width, $this->height, $src_width, $src_height);
                if($ouput) {
                        $result        = @$outpurFunc($newImg, $newFile, $this->quality);
                }else {
                        header('Content-type: '.$rs['mime']);
                        $result        = @$outpurFunc($newImg, null, $this->quality);
                }
                @imagedestroy($newImg);
                @imagedestroy($image);
        }

        /**
        * 错误处理 
        */
        function _errMsg() {
                exit($this->errorMsg);
        }
        /**
        * 捕捉异常报告
        */
        function getErrorMsg() {
                Return $this->errorMsg;
        }
}
?>
