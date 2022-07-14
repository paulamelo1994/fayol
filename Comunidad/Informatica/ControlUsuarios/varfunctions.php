<?

function plushours($time1, $time2)
{	
	$a_hours1 = explode(":",$time1);
	$a_hours2 = explode(":",$time2);
	
	$temphour[2] = (int)$a_hours1[2] + (int)$a_hours2[2];
	$temphour[1] = (int)$a_hours1[1] + (int)$a_hours2[1];
	$temphour[0] = (int)$a_hours1[0] + (int)$a_hours2[0];
	
	$finalhour ;
	$carrie = 0;
	
	if((int)$temphour[2] > 59) //si hay mas de 60 seg
	{
		$carrie =  (int)((int)$temphour[2] / 60); // 
		 
		if(((int)$temphour[2]-($carrie*60)) < 10)
		{
			$finalhour[2] = "0".(int)$temphour[2]-($carrie*60);
		}
		else
		{
			$finalhour[2] = (int)$temphour[2]-($carrie*60);
		}
		$temphour[1]= (int)$temphour[1]+$carrie;
		$carrie=0;
	}
	else
	{
		$finalhour[2] = $temphour[2];
	}
	
	if((int)$temphour[1] > 59)
	{
		$carrie = (int)((int)$temphour[1] / 60);
		if((int)$temphour[1]-($carrie*60) < 10)
		{
			$finalhour[1] = "0".(int)$temphour[1]-($carrie*60);
		}
		else
		{
			$finalhour[1] = (int)$temphour[1]-($carrie*60);
		}
		$temphour[0]= (int)$temphour[0]+$carrie;
		$carrie=0;
	}
	else
	{
		$finalhour[1] = $temphour[1];
	}
	
	
	if((int)$temphour[0]+$trash < 10)
	{
		$finalhour[0] = "0".(int)$temphour[0]+$trash;
	}
	else
	{
		$finalhour[0] = (int)$temphour[0]+$trash;
	}
	 
	return $finalhour[0].":".$finalhour[1].":".$finalhour[2];
	
}

function datebigger($fdate1, $fdate2)
{
	$array_date1 = explode('[-]', $fdate1);
	$array_date2 = explode('[-]', $fdate2);
	if((int)$array_date1[2] > (int)$array_date2[2])
	{
		return true;
	}
	else 
	{
		if( (int)$array_date1[1] > (int)$array_date2[1] )
		{
			return true;
		}
		else 
		{
			if ( (int)$array_date1[0] > (int)$array_date2[0] )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}

function actual_tomorrow($fhour)
{
	$array_hour = explode(':',$fhour);
	if ((int)$array_hour[0] < 12)
		return true;
	else
		return false;
}

function actual_afternoon($fhour)
{
	$array_hour = explode(':', $fdate1);
	if ((int)$array_hour[0] >= 12 and  (int)$array_hour[0] < 18)
		return true;
	else
		return false;
}

function actual_nigth($fhour)
{
	$array_hour = explode(':',$fhour);
	if ((int)$array_hour[0] >= 18 )
		return true;
	else
		return false;
}

?>