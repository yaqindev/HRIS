if ( ! function_exists('format_date')) 
	{ 
		function format_date($time,$lang) 
		{  
			$temp_time = $time; 
			if ($lang == '')
			{ 
				$lang = 'id'; 
			} 
			else 
			{ 
				$lang = $lang; 
			}  
			$exploding = explode("-", $time);  
			$numm = array('01','02','03','04','05','06','07','08','09','10','11','12');  
			$month_id = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',  'September','Oktober','November','Desember');  
			$month_en = array('January', 'February', 'March', 'April', 'Mey', 'June', 'July', 'August',  'September','October','November','December');  
			if ($lang == 'id') 
			{ 
				for ($i=0;$i<=11;$i++) 
				{  
					if($exploding[1] == $numm[$i] ) 
					{  
						$time = $exploding[2].' '.$month_id[$i].' '.$exploding[0];  
					} 
				} 
			}  
			if ($lang == 'en') 
			{  
				for ($i=0;$i<=11;$i++) 
				{  
					if($exploding[1] == $numm[$i] ) 
					{  
						$time = $exploding[2].' '.$month_en[$i].' '.$exploding[0];  
					} 
				} 
			} 
			return $time; 
		}