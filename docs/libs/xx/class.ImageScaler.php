<?php

	class ImageScaler{

		const UPLOAD_TMP_DIR = '/tmp/';

		private $file;              //Путь к файлу с исходным изображением
		private $image;             //Исходное изображение
		private $image_new=false;   //Изображение после масштабирования

		public $smallWidth;			//Ширина уменьшеного изображения
		public $smallHeight;		//Высота уменьшеного изображения

		/**
		 * Загрузка файла для обработки
		 *
		 * @param string $file путь к файлу
		 */
		public function __construct($file)
		{
			if(!file_exists($file)) return false;

			//Получаем информацию о файле
			list($width, $height, $image_type) = getimagesize($file);

			//Создаем изображение из файла
			switch ($image_type)
			{
			case 1: $this->image = imagecreatefromgif($file); break;
			case 2: $this->image = imagecreatefromjpeg($file);  break;
			case 3: $this->image = imagecreatefrompng($file); break;
			default: return '';  break;
			}
			$this->file=$file;
		}

		/**
		 * Масштабирует исходное изображение
		 *
		 * @param int $W Ширина
		 * @param int $H Высота
		 */
		public function resize($small_width, $small_height, $scalingType = 'inside', $cutImage = '', $scalingFocus = '')
		{
			$this->image_new = false;

			$orig_width = ImageSX($this->image);
			$orig_height = ImageSY($this->image);

			$paramFactor = $small_width / $small_height;
      		$imgFactor = $orig_width / $orig_height;

	      	if($scalingType == 'width')
	      	{
	      		$xsize = $small_width;
	      		$ysize = $small_width / $imgFactor;
	      		if($cutImage == 'y')
	      		{
	      			if($ysize > $small_height)
	      			{
	      				$ysize = $small_height;
	      				$orig_height = $orig_width / $paramFactor;
	      			}
	      		}
	      	}
	      	elseif($scalingType == 'height')
	      	{
	      		$xsize = $small_height * $imgFactor;
	      		$ysize = $small_height;
	      		if($cutImage == 'y')
	      		{
	      			if($xsize > $small_width)
	      			{
	      				$xsize = $small_width;
	      				$orig_width = $orig_height * $paramFactor;
	      			}
	      		}
	      	}
	      	elseif($scalingType == 'inside')
	      	{
	      		if($paramFactor >= $imgFactor)
	      		{
	      			if(abs(intval($orig_width - $small_width)) >= abs(intval($orig_height - $small_height)))
	      		    {
	      			  $xsize = $small_height * $imgFactor;
	      		      $ysize = $small_height;
	      		    }
	      		    else
	      		    {
	      			  $xsize = $small_width;
	      		      $ysize = $small_width / $imgFactor;
	      		    }
	      		}
	      		else
	      		{
	      			if(abs(intval($orig_width - $small_width)) >= abs(intval($orig_height - $small_height)))
	      		    {
	      			  $xsize = $small_width;
	      		      $ysize = $small_width / $imgFactor;
	      		    }
	      		    else
	      		    {
	      			  $xsize = $small_height * $imgFactor;
	      		      $ysize = $small_height;
	      		    }
	      		}
	      	}
	      	elseif($scalingType == 'outside')
	      	{
	      		if($paramFactor >= $imgFactor)
	      		{
	      			if(abs(intval($orig_width - $small_width)) >= abs(intval($orig_height - $small_height)))
	      		    {
	      			  $xsize = $small_width;
	      		      $ysize = $small_width / $imgFactor;
	      		    }
	      		    else
	      		    {
	      			  $xsize = $small_height * $imgFactor;
	      		      $ysize = $small_height;
	      		    }
	      		}
	      		else
	      		{
	      			if(abs(intval($orig_width - $small_width)) >= abs(intval($orig_height - $small_height)))
	      		    {
	      			  $xsize = $small_height * $imgFactor;
	      		      $ysize = $small_height;
	      		    }
	      		    else
	      		    {
	      			  $xsize = $small_width;
	      		      $ysize = $small_width / $imgFactor;
	      		    }
	      		}
	      	}
	      	else
	      	{
	      		$xsize = $small_width;
	      		$ysize = $small_height;
	      	}
            /*
			$X=ImageSX($this->image);
			$Y=ImageSY($this->image);


			$H_NEW=$Y;
			$W_NEW=$X;

			if($X>$W){
				$W_NEW=$W;
				$H_NEW=$W*$Y/$X;
			}

			if($H_NEW>$H){
				$H_NEW=$H;
				$W_NEW=$H*$X/$Y;
			}
             */
			$this->smallWidth = (int)$xsize;
			$this->smallHeight = (int)$ysize;

            if($scalingFocus == 'center')
            {
            	$desX = 0;
            	$desY = 0;
            	$scrX = 0;
            	$scrY = 0;
            	//$scrX = abs(intval(($orig_width - $this->smallWidth) / 2));
            	//$scrY = abs(intval(($orig_height - $this->smallHeight) / 2));
            }
            else
            {
            	$desX = 0;
            	$desY = 0;
            	$scrX = 0;
            	$scrY = 0;
            }
            $this->image_new = imagecreatetruecolor($this->smallWidth, $this->smallHeight);
			imagecopyresampled($this->image_new, $this->image, $desX, $desY, $scrX, $scrY, $this->smallWidth, $this->smallHeight, $orig_width, $orig_height);
		}


		/**
		 * Сохранение файла
		 *
		 * @param string $file Путь к файлу (если не указан, записывает в исходный)
		 * @param int $qualiti Качество сжатие JPEG
		 */
		public function save($file=false, $qualiti=90)
		{
			if(!$file || $file==$this->file) {
				$file=$this->file;
				if(!$this->image_new) return true;
				else ImageJpeg($this->image_new, $file, $qualiti);
			}else{
				if(!$this->image_new) copy($this->file, $file);
				else ImageJpeg($this->image_new, $file, $qualiti);
			}
		}
	}

?>
