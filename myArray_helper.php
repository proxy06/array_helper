<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*@ random return random value from array

*/
if ( ! function_exists('random'))
{
	function random($array)
	{
		$count = count($array);
		$key = rand(0,$count-1);
		return $array[$key];
		
	}
}

/* @ 
*	sums array and return result
*	accepts associative array set TRUE for second parameter default is false
*   accepts multi-dimentional as third parameter default if false 
*/
if (!function_exists('array_total'))
{
	function array_total($array,$assoc=false,$multiD=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		$count=0;
		if(!$multiD)
		{
			foreach($array as $a=>$val):
				$count+=$val;
			endforeach;
			if($assoc)
			{
				$test = array();
				$test[0] = $count;
				return $test;
			}
		}
		else
		{
			$count=0;
			$finalArray=array();
			foreach($array as $key=>$val):
				$count=0;
				foreach($val as $key=>$val1):
					$count+=$val1;
				endforeach;
				array_push($finalArray,$count);
			endforeach;
			return $finalArray;
		}
		return $count;		
	}
}

/* @ search accepts 3 parameter
*  first parameter is value/array of value which 
*  second parameter is an array/multi-dimentional array
*  fourth parameter is multi_dimentional array status default false
*/
if (!function_exists('search'))
{
	function search($value,$array,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if(!$multi)
		{
			if(is_array($value))
			{
				return 'Pass Value is in correct format';
			}
			foreach($array as $key=>$a):
				if($a == $value)
				{
					return $key;
				}
			endforeach;				
		}
		else
		{
			if(!is_array($value))
			{
				return 'Value is in correct format';
			}	
			$ar_count = count($array);
			$val_count = count($value);
			for($i=0;$i<$ar_count;$i++)
			{
				if($value[$i]!='')
				{
					$array_count = count($array[$i]);
					for($j=0;$j<$array_count;$j++)
					{
						if($value[$i] == $array[$i][$j])
						{
							$key = $j;
							$finalArray[$i] = $key;	
						}
									
					}				
				}
				else
				{
					$finalArray[] = 'NULL';	
				} 
			}
			return $finalArray;		
		}

		//return 'The value is not in given array';
		return $value;
	}
}

/* @ chunk
*	Accepts 4 parameter 
*	First parameter is length is array length. common length for multi-dimentional array
*	Second parameter is an array/multi-dimentional Array
*	Third parameter retain the key or not. Default FALSE
*	Multi-dimentional array status Default false

@*/
if (!function_exists('chunk'))
{
	function chunk($length,$array,$key=FALSE,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		//return array_chunk($array,$length,$key);
		$final_array =array();
		if(!$multi)
		{
			$c_array =array();
			$count = 0;
			$ar_count = count($array);
			$last_element = end($array);
			foreach($array as $a=>$val):
				++$count;
				if(!$key)
				{
					$a=$count-1;
				}
				$c_array[$a] = $val;
				if($length == $count)
				{
					array_push($final_array,$c_array);
					$c_array = array();
					$count = 0;
				}	
				if($last_element!='' && $ar_count%2 != 0 && $last_element == $val)
				{
					array_push($final_array,$c_array);
				}
				//$count=$count+1;		
			endforeach;			
		}
		else
		{
			foreach($array as $a1=>$val1):
				$c_array =array();
				$count = 0;
				$ar_count = count($val1);
				$last_element = end($val1);
				foreach($val1 as $a=>$val):
					++$count;
					if(!$key)
					{
						$a=$count-1;
					}
					$c_array[$a] = $val;
					if($length == $count)
					{
						array_push($final_array,$c_array);
						$c_array = array();
						$count = 0;
					}	
					if($last_element!='' && $ar_count%2 != 0 && $last_element == $val)
					{
						array_push($final_array,$c_array);
					}
					//$count=$count+1;	
					//return $ar_count;	
				endforeach;			
			endforeach;			
		}
		
		
		return $final_array;
		
	}
}


/* @ Array Count 
*	Count all the values of an array:
*	First Parameter array/Multi-dimentional Array
* Second Parameter Status TRUE/FALSE Default FALSE

*/


if (!function_exists('array_values_count'))
{
	function array_values_count($array,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($multi)
		{
			foreach($array as $a):
				$val = array_count_values($a);
				array_push($finalArray,$val);
				$val=array();
			endforeach;
		}
		return array_count_values($array);
	}
}

/* @ combine array only for indexed array
*	First parameter array as key
*	Second array as value
*	Third parameter is muti-dimentional array status. default is FALSE


need some work on multi-dimentional array

@*/
if (!function_exists('combine_array'))
{
	function combine_array($key,$value,$multi=FALSE)
	{
		$new_array = array();
		if(!is_array($key) or !is_array($value))
		{
			return 'Not an Array';
		}
		//return array_combine($key,$value);
		if(!$multi)
		{
			for($i=0;$i<count($key);$i++)
			{
				$new_array[$key[$i]] = $value[$i];
			}
			return $new_array;			
		}
	}
}

/*@ Value Compare 

*/

if (!function_exists('value_compare'))
{
	function value_compare($array1,$array2)
	{
		if(!is_array($array1) or !is_array($array2))
		{
			return 'Not an Array';
		}
		return array_diff($array1,$array2);
		
	}
	/*function value_compare()
	{
		 $numargs = func_num_args();
		 $ite_count = $numargs-1;
		 $final_array=array();
		 $count = 0;
		 $cmArray = func_get_arg(0);
		 $cmACount = count($cmArray);
		 $tempArray = array();
		 for($i=0;$i<count(func_get_arg(0));$i++) // array iterates for first array
		 {
		 	$array = func_get_arg($i);
		 	for($j=0;$j<$ite_count;$j++)
		 	{
		 		$next_array = $j+1;	
				$array1 = func_get_arg($next_array);
				$a1Count = count($array1);
				if($cmACount > $a1Count)
				{
					$cmArray = $cmACount;
				}
				else
				{
					$tempArray = $cmArray;
					$cmArray = $array1;
					$array1 = $tempArray;
				}
				foreach($cmArray as $key=>$val):
					  
					$cValue = $array1[$array_it];
					if(isset($cValue))
					{
						if($val == $cValue)
						{
							$flag = 1;
						}
					}
					$array_it+=1;
					$final_array[$key]=$val;
				endforeach;
			}
		 	
		 }
		 //return func_get_arg(1)['0'];
		 return $array1;
		 
	}*/
}


if (!function_exists('value_key_compare'))
{
	function value_key_compare($array1,$array2)
	{
		if(!is_array($array1) or !is_array($array2))
		{
			return 'Not an Array';
		}
		return array_diff_assoc($array1,$array2);
	}
}

/*@ Key compare compares the keys of 2 array and return diffrences


*/
if (!function_exists('key_compare'))
{
	function key_compare($array,$array1)
	{
		$arCount = func_num_args();
		for($i=0;$i<$arCount;$i++)
		{
			$tempArray = func_get_args($i);
			if(!is_array($tempArray))
			{
				return $tempArray;
			}	
		}
		return array_diff_key($array,$array1);
	}
}

/* @ Flip Array: Changes the key and value of given array:
*	Accepts 2 parameter array and Multidimentional status
*	First parameter array/multi-dimentional array
*	multi-dimentional Status TRUE/FALSE Default False  

*/
if (!function_exists('flip_array'))
{
	function flip_array($array,$multi=FALSE)
	{
		$new_array = array();
		$finalArray = array();
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		//return array_flip($array);
		if(!$multi)
		{
			foreach($array as $key=>$val):
				$new_array[$val] = $key;
			endforeach;
			return $new_array;			
		}
		else
		{
			foreach($array as $key=>$val):
				foreach($val as $key2=>$val2):
					$new_array[$val2] = $key2;
				endforeach;
				array_push($finalArray,$new_array);
				$new_array = array();
			endforeach;
			return $finalArray;
		}

	}
}

if (!function_exists('intersect_array'))
{
	function intersect_array($array1,$array2)
	{
		if(!is_array($array1) or !is_array($array2))
		{
			return 'Not an Array';
		}
		return array_intersect($array1,$array2);
	}
}
if (!function_exists('intersect_array_both'))
{
	function intersect_array_both($array1,$array2)
	{
		if(!is_array($array1) or !is_array($array2))
		{
			return 'Not an Array';
		}
		return array_intersect_assoc($array1,$array2);
	}
}
if (!function_exists('intersect_array_key'))
{
	function intersect_array_key($array1,$array2)
	{
		if(!is_array($array1) or !is_array($array2))
		{
			return 'Not an Array';
		}
		return array_intersect_assoc($array1,$array2);
	}
}

if (!function_exists('keys_array_value'))
{
	function keys_array_value($array,$value='')
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		//return array_keys($array,$value);
		if($value!='')
		{
			foreach($array as $key=>$val):
				if($val == $value)
				{
					$final_array[] = $key;
				}
			endforeach;		
			
		}
		else
		{
			foreach($array as $key=>$val):
				$final_array[] = $key;
			endforeach;	
			//return $final_array;			
		}
		return $final_array;
	}
}

/* @ values array : returns all d values in an array/muti-dimentional array
*	Accepts 2 Parameter
*	First Parameter array/multi-dimentional array
*	Status TRUE/False. Default False

*/

if (!function_exists('values_array'))
{
	function values_array($array,$multi=FALSE)
	{
		$tempArray = array();
		$finalArray = array();
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		//return array_values($array);
		if(!$multi)
		{
			foreach($array as $key=>$val):
				$final_array[] = $val;
			endforeach;
			return $final_array;			
		}
		else
		{
			foreach($array as $a):
				foreach($a as $key=>$val):
					$tempArray[] = $val;
				endforeach;	
				array_push($finalArray,$tempArray);
				$tempArray=array();				
			endforeach;
			return $finalArray;
		}

	}
}

/* @ Merge Array  Merges 2 array in single array (Only one dimentional array)
*	 Accepts two parameter
*	First Parameter array1 
*	Second Parameter array2
*	Retain Key TRUE/FALSE Default is FALSE
*	if keys of array1 and 2 are same 2 array overrides the value of 1st 
*/


if (!function_exists('merge_array'))
{
	function merge_array($array1,$array2,$retain_key=FALSE)
	{
		if(!is_array($array1) or !is_array($array2))
		{
			return 'Not an Array';
		}
		//return array_merge($array1,$array2);
		$total_count = count($array1)+count($array2);
		$join_in = count($array1);
		if($retain_key)
		{
			foreach($array2 as $key=>$val):
				$array1[$key] = $val;
			endforeach;
		}
		else
		{
			foreach($array2 as $key=>$val):
				$array1[] = $val;
			endforeach;
		}
		return $array1;
	}
}

/*@ merge array recursive: merges two array 
*	Accepts 2 parameter
*	First Parameter First array
*	Second Parameter Array 
*	this forms an array if array1 and array2 has same key
*/

if (!function_exists('merge_array_recursive'))
{
	function merge_array_recursive($array1,$array2)
	{
		if(!is_array($array1) or !is_array($array2))
		{
			return 'Not an Array';
		}
		return array_merge_recursive($array1,$array2);
	}
}

/*@ Multisort array sorts an array based on order and type
*	Accepts 4 parameter
*	First Parameter Array to be sorted
*	second Parameter order: Ascending or Desc Default:ASC
*	Third Parameter Order
*	Fourth Parameter Multi-dimentional array status: Default:False 

*/


if (!function_exists('multisort_array'))
{
	function multisort_array($array)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		$a = array_multisort($array);
		return $array;
		
	}
}

/*@ Pad Array adds new value to specified length to array
*	Accepts 4 parameter
*	First Parameter array
*	Second Parameter total Length of final array
*	new value to be added		
*	Multi-dimentional Status
*/


if (!function_exists('pad_array'))
{
	function pad_array($array,$length,$new_value,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if(!$multi)
		{
			$count = count($array);
			foreach($array as $a):
				$final_array[] = $a;
			endforeach;
			for($i=$count;$i<$length;$i++)
			{
				$final_array[] = $new_value; 
			}		
			return $final_array;	
		}
		/*else
		{
			$count = count($length);
			/*for($j=0;$j<count($array);$j++)
			{
				$arCount = count($array[$j]);
				/*for($i=$arCount;$i<$count;$i++)
				{
					$array[$j][] = $new_value[$j];
				}			
			}
			return $array[0];
		}*/
	}
}

/*@ Pop Array : Deletes Last element of an array
*	First Parameter Array
*	Second parameter Multi-Dimentional Array Status Default:FALSE	
*/
if (!function_exists('pop_array'))
{
	function pop_array($array,$type=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($type)
		{
			$finalArray = array();
			foreach($array as $key=>$val):
				$i = 0;
				foreach($val as $key1=>$val1):
					if($i<count($val)-1)
					{
						$final_array[$key1] = $val1;
					}
					$i+=1;
				endforeach;	
				array_push($finalArray,$final_array);	
				$final_array=array();
			endforeach;	
			return $finalArray;
		}
		else
		{
			$i = 0;
			foreach($array as $key=>$val):
				if($i<count($array)-1)
				{
					$final_array[$key] = $val;
				}
				$i+=1;
			endforeach;
			return $final_array;
		}
		
	}
}

/*@ Pop Array Multiple
*	Deletes multiple elemets in given array and return remaining array
*	First Parameter Specifies an array
*	Second Parameter length/length array(Multi-dimentional) 
*	Multi-dimentional array status Default FALSE
*/
if (!function_exists('pop_array_multiple'))
{
	function pop_array_multiple($array,$length,$type=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($type)
		{
			$finalArray = array();
			$j=0;
			foreach($array as $key=>$val):
				$i = 0;
				$lengthC = isset($length[$j])?$length[$j]:0;
				foreach($val as $key1=>$val1):
					if($i<count($val)-$lengthC)
					{
						$final_array[$key1] = $val1;
					}
					$i+=1;
				endforeach;	
				$j+=1;
				array_push($finalArray,$final_array);	
				$final_array=array();
			endforeach;	
			return $finalArray;
						
			/*for($i=0;$i<count($array)-$length;$i++)
			{
				$final_array[] = $array[$i];
			}*/				
		}
		else
		{
			$i = 0;
			foreach($array as $key=>$val):
				if($i<count($array)-$length)
				{
					$final_array[$key] = $val;
				}
				$i+=1;
			endforeach;
		}
		return $final_array;
	}
}

/*@ multiply array 
*	multiplies values in given array
*	First Parameter Spefies array/multi-dimentional array
*	MultiDimentional Array Status Default FALSE
*/
if (!function_exists('multiply_array'))
{
	function multiply_array($array,$type=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}		
		//return array_product($array);
		if(!$type)
		{
			$value =1;
			foreach($array as $a):
				$value = $value*$a;
			endforeach;	
			return $value;			
		}
		else
		{
			$finalArray = array();
			foreach($array as $key=>$val):
				$value = 1;
				foreach($val as $fval):
					$value = $value*$fval;
				endforeach;
				array_push($finalArray,$value);
			endforeach;
			return $finalArray;
		}

		
	}
}

/* push array 
*	Joins number of array to single multi-dimentional array
*	First Parameter Specifies <ulti-dimentional status. Specify FALSE if arrays are one dimentional
push_array(FALSE,array,array1,..)
*/
if (!function_exists('push_array'))
{
	function push_array($type=FALSE)
	{
		$newArray = array();
		$arCount = func_num_args();
		if($type)
		{
			for($i=1;$i<$arCount;$i++)
			{
				$subArrC = count(func_get_arg($i));
				for($j=0;$j<$subArrC;$j++)
				{
					$newArray[] = func_get_arg($i)[$j];
				}
			}
			return $newArray;
		}
		else
		{
			$arCount = func_num_args();
			for($i=1;$i<$arCount;$i++)
			{
				$newArray[] = func_get_arg($i);
			}		
			return $newArray;		
		}	
			
	}
}


/*@ Replace array : Replcaes the first array with second array elemetns
*	Accepts 3 Parameter 
*	First paremeter Specify array
*	Second Parameter replace array
*	Multi-Dimentional status Default:False
*/
if (!function_exists('replace_array'))
{
	function replace_array($array,$array1,$type=FALSE)
	{
		if(!is_array($array) or !is_array($array1))
		{
			return 'Not an Array';
		}		
		//$replaced_array = array_replace($array,$array1);
		//return $replaced_array;
		if($type)
		{
			/*foreach($array as $key=>$val):
				$finalArray[$key] = isset($array1[$key])?$array1[$key]:$array[$key];
			endforeach;*/
			$finalArray =array();
			if(count($array) >= count($array1))
			{
				$oArcount = count($array);
			}
			else
			{
				$oArcount = count($array1);
			}			
			for($j=0;$j<$oArcount;$j++)
			{
				if(count($array[$j]) >= count($array1[$j]))
				{
					$count = count($array[$j]);
				}
				else
				{
					$count = count($array1[$j]);
				}
				for($i=0;$i<$count;$i++)
				{
					$tempArray[$i] = isset($array1[$j][$i])?$array1[$j][$i]:$array[$j][$i];
				}
				array_push($finalArray,$tempArray);
			}	
			return $finalArray;
		}
		else
		{
			if(count($array) >= count($array1))
			{
				$count = count($array);
			}
			else
			{
				$count = count($array1);
			}
			for($i=0;$i<$count;$i++)
			{
				$finalArray[$i] = isset($array1[$i])?$array1[$i]:$array[$i];
			}
		}
		return $finalArray;
		//return $array;
		
	}
}

/*@ Replace array Associative 
*	

*/
if (!function_exists('replace_array_assoc'))
{
	function replace_array_assoc($array,$array1)
	{
		if(!is_array($array) or !is_array($array1))
		{
			return 'Not an Array';
		}		
		$replaced_array = array_replace($array,$array1);
		return $replaced_array;
	}
}

if (!function_exists('replace_array_recursive_assoc'))
{
	function replace_array_recursive_assoc($array,$array1)
	{
		if(!is_array($array) or !is_array($array1))
		{
			return 'Not an Array';
		}		
		$replaced_array = array_replace_recursive($array,$array1);
		return $replaced_array;
	}
}

/*@ Reverse Array  : Works for numbered array only
*	First Parameter Specify array
*	Retain Key: Default False
*/

if (!function_exists('reverse_array'))
{
	function reverse_array($array,$flag=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}		
		if($flag)
		{
			$i = count($array)-1;
			foreach($array as $key=>$val):
			
				$finalArray[$i] = array_key($array,$i);
				$i--;
			endforeach;	
			return $finalArray;					
		}
		else
		{
			$i = count($array)-1;
			foreach($array as $key=>$val):
			
				$finalArray[$key] = array_key($array,$i);
				$i--;
			endforeach;	
			return $finalArray;			
		}
	}
}
/*@ reverse array all written using key word
*	First parameter array
*	MultiDimentional status Default FALSE
*	Retain keys: Default false
*/

if (!function_exists('reverse_array_all'))
{
	function reverse_array_all($array,$multi=FALSE,$flag=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}	
		if($multi)
		{
			$finalArray = array();
			foreach($array as $key=>$val):
				$tempArray = array_reverse($val,$flag);
				array_push($finalArray,$tempArray);
			endforeach;
			
		}
		else
		{
			$finalArray = array_reverse($array,$flag);
		}	
		return $finalArray;
	}
}

/*@ Search Array  works for single dimentional array
*	First Parameter Value 
*	Second Parameter array
*	Flag specify strict search Default false
*/
if (!function_exists('search_array'))
{
	function search_array($value,$array,$flag=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}		
		//return array_search($value,$array,$flag);
		if($flag)
		{
			foreach($array as $key=>$val):
				if($val === $value)
				{
					return $key;
				}
			endforeach;	
			return 'NULL';
		}
		else
		{
			foreach($array as $key=>$val):
				if($val == $value)
				{
					return $key;
				}
			endforeach;	
			return 'NULL';
		}			
		
	}
}

/* Search array Multi written using built in
*	First Parameter Value 
*	Second Parameter array
*	Multi-Dimentional Array Default False
*	Flag specify strict search Default false
*/
if (!function_exists('search_array_multi'))
{
	function search_array_multi($value,$array,$multi=FALSE,$flag=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}		
		//return array_search($value,$array,$flag);
		if($multi)
		{
			$finalArray = array();
			foreach($array as $key=>$val):
				$tempArray =  array_search($value,$val,$flag);
				//$tempArray =  array_search($value,$val,$flag);
				array_push($finalArray,$tempArray);
			endforeach;	
			return $finalArray;
		}
		else
		{
			return array_search($value,$array,$flag);
			//return 'NULL';
		}			
		
	}
}

/*@ Shift array removes first element of an array and returns remaining array element
*	First Parameter Specify Array
*	Second Parameter Status of multi-dimentional array
*	

*/

if (!function_exists('shift_array'))
{
	function shift_array($array,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}		
		if($multi)
		{
			$finalArray = array();
			foreach($array as $key=>$val):
				$new_array = array_shift($val);
				array_push($finalArray,$val);
			endforeach;
			return $finalArray;
		}
		$newArray =  array_shift($array);
		return $array;
	}
}

/*@ Slice Array written in built in function
*	First Parameter array
*	Start point
*	Length to be returned
*	flag retain key Default FALSE
*	Multi-dimentional status. Default FALSE
*/
if (!function_exists('slice_array'))
{
	function slice_array($array,$start,$length='',$flag=FALSE,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($multi)
		{
			$finalArray = array();
			$cLen = count($length);
			$i=0;
			foreach($array as $key=>$val):
				$tempArray = array_slice($val,$start[$i],$length[$i],$flag);
				$i+=1;
				array_push($finalArray,$tempArray);
			endforeach;
			return $finalArray;
		}
		else
		{
			if($length == '')
			{
				$length=count($array);
			}
			return array_slice($array,$start,$length,$flag);			
		}

	}
}

/*@ Unique Array  written in built in function
*	return unique array elements in array
*	First Parameter Array
*	second array multi-dimentional Default False
*	Sorting Order
*/
if (!function_exists('unique_array'))
{
	function unique_array($array,$multi=FALSE,$order='SORT_STRING')
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($multi)
		{
			$finalArray = array();
			foreach($array as $a):
				$tempArray = array_unique($a);
				array_push($finalArray,$tempArray);			
			endforeach;	
			return $finalArray;
		}		
		return array_unique($array);
	}
}

/*@ array sort sorts an indexed array in ascending or descing order written in built in function
*	First paremeter array
*	Multi-dimentional status default FALSE
*	Order True:Ascending or False:Descending
*/
if (!function_exists('array_sort'))
{
	function array_sort($array,$multi=FALSE,$order=TRUE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($multi)
		{
			$finalArray=array();
			if($order)
			{
				foreach($array as $a):
					$new_array = asort($a);
					array_push($finalArray,$a);	
				endforeach;
			}
			else
			{
				foreach($array as $a):
					$new_array = arsort($a);
					array_push($finalArray,$a);	
				endforeach;				
			}
			return $finalArray;
		}
		else
		{
			if($order)
			{
				$new_array = asort($array);
				return $array;			
			}
			$new_array = arsort($array);
			return $array;			
		}

	}
}

/*@ array sort key Sorts an associative array in ascending or descing order written in built in function
*	First paremeter array
*	Multi-dimentional status default FALSE
*	Order True:Ascending or False:Descending
*/

if (!function_exists('array_sort_key'))
{
	function array_sort_key($array,$multi=FALSE,$order=TRUE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($multi)
		{
			$finalArray=array();
			if($order)
			{
				foreach($array as $a):
					$new_array = ksort($a);
					array_push($finalArray,$a);	
				endforeach;
			}
			else
			{
				foreach($array as $a):
					$new_array = krsort($a);
					array_push($finalArray,$a);	
				endforeach;				
			}
			return $finalArray;
		}
		else
		{
			if($order)
			{
				$new_array = ksort($array);
				return $array;			
			}
			$new_array = krsort($array);
			return $array;			
		}
	}
}

/*@ Array Shuffle shuffles an given array works for indexed array and single dimentional array.  
*	First Parameter specifys array
*/
if (!function_exists('array_shuffle'))
{
	function array_shuffle($array,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}

		$key = array();
		$new_array = array();
		$range = range(0,count($array)-1);
		shuffle($range);
		for($j=0;$j<count($array);$j++)
		{
			$new_array[] = $array[$range[$j]];
		}
		//$new_array = shuffle($array);
		return $new_array;			

	}
}

/*@ Array Shuffle shuffles an given array works for indexed array.written in built in function  
*	First Parameter specifys array
*	Multi-dimentional array status default false
*/
if (!function_exists('array_shuffle_all'))
{
	function array_shuffle_all($array,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($multi)
		{
			$finalArray = array();
			foreach($array as $a):
				shuffle($a);
				array_push($finalArray,$a);
			endforeach;
			return $finalArray;
		}
		$new_array = shuffle($array);
		return $array;			

	}
}

if (!function_exists('array_range'))
{
	function array_range($start,$end,$step='1')
	{
		$new_array = range($start,$end,$step);
		$final_array = array();
		$value = $start;
		for($i=$start;$i<=$end;$i++)
		{
			if($value <=$end)
			{
				$array[] = $value;				
			}
			$value+=$step;
		}
		return $array;
	}
}

/*@ Array Key accepts 2 parameter and return value of the key

*/
if (!function_exists('array_key'))
{
	function array_key($array,$key)
	{
		if(!is_array($array))
		{
			return 'Not an array';
		}
		foreach($array as $key1=>$val):
			if($key1 == $key)
			{
				return $val;
			}
		endforeach;
	}
}

/*@ Fill array fills an array with value works only for indexed array
*	First parameter starting value of indexed number
*	Second Parameter length of an array
*	Third Parameter value to be filled
*	Fourth Parameter multi-dimentional array status default is FALSE
*/

if(!function_exists('fill_array'))
{
	function fill_array($start,$length,$value,$multi=FALSE)
	{
		if($multi)
		{
			$finalArray = array();
			$count = count($start);
			for($i=0;$i<$count;$i++)
			{
				$subArKey = $start[$i];
				for($j=0;$j<$length[$i];$j++)
				{
					$tempArray[$subArKey] = $value[$i];
					$subArKey+=1;
				}
				array_push($finalArray,$tempArray);
				$tempArray = array();
			}
			return $finalArray;
		}
		else
		{
			for($i=0;$i<$length;$i++)
			{
				$finalArray[$start] = $value;
				$start+=1;
			}
			return $finalArray;				
		}
	
	}
}
/*@ change_key_case changes the key to upper or lower case written using built in functions
*	First parameter array
*	Second Parameter multi-dimentional array status default is FALSE
*	Third Parameter optional Either CASE_UPPER or CASE_LOWER Default CASE_UPPER For multi-dimentional array case format is  a  array(CASE_LOWER,CASE_UPPER)
*/

if(!function_exists('change_key_case'))
{
	function change_key_case($array,$multi=FALSE,$case=CASE_UPPER)
	{
		if($multi)
		{
			$i=0;
			foreach($array as $a):
				$case1 = $case[$i];
				$tempArray[] = array_change_key_case($a,$case1);
				$i+=1;
			endforeach;		
			return $tempArray;
		}
		else
		{
			return array_change_key_case($array,$case);
		}	
	}
}
/*@ count_values_array counts the values in an array
*	Specify the array;
*	Second Parameter multi-dimentional array status default is FALSE
*/

if(!function_exists('count_values_array'))
{
	function count_values_array($array,$multi=FALSE)
	{
		if($multi)
		{
			foreach($array as $a):
				$finalArray[] = array_count_values($a);
			endforeach;
			return $finalArray;
		}
		else
		{
			return array_count_values($array);
		}	
	}
}

/*@ fill_keys_array fills key with value and returns array written using built in functions
*	First parameter key array / multi-dimentional key array
*	Second parameter value / value array
*	Third Parameter multi-dimentional array status default is FALSE
*/

if(!function_exists('fill_keys_array'))
{
	function fill_keys_array($keys,$value,$multi=FALSE)
	{
		if($multi)
		{
			$i=0;
			foreach($keys as $a):
				$val1 = isset($value[$i])?$value[$i]:$value[$i-1];
				$tempArray[] = array_fill_keys($a,$val1);
				$i+=1;
			endforeach;		
			return $tempArray;
		}
		else
		{
			return array_fill_keys($keys,$value);
		}	
	}
}


/*@ rand_array retruns random keys from an array written using built in functions
*	First parameter  array / multi-dimentional key array
*	Second parameter number of keys to be returned/ array of number of keys
*	Third Parameter multi-dimentional array status default is FALSE

format rand_array($array,array(1,2),TRUE)
*/

if(!function_exists('rand_array'))
{
	function rand_array($array,$value,$multi=FALSE)
	{
		if($multi)
		{
			$finalArray = array();
			$i=0;
			foreach($array as $a):
				$val1 = isset($value[$i])?$value[$i]:$value[$i-1];
				$tempArray = array_rand($a,$val1);
				array_push($finalArray,$tempArray);
				$tempArray= array();
				$i+=1;
			endforeach;		
			return $finalArray;
		}
		else
		{
			return array_rand($array,$value);
		}	
	}
}

/*@ Splice array removes the and replce the elements written in built-in function multi-dimentional array not supported
*	Specify an array
*	start point
*	length number of elements to be removed 	
*	Optional array
*/

if(!function_exists('splice_array'))
{
	function splice_array($array,$start,$length,$array1)
	{
		array_splice($array,$start,$length,$array1);	
		return $array;	
	}
}

/*@ unshift array adds value to first element. only for one dimentional array
*	Specifys the array
*	value/value array to be added to array
*/

if(!function_exists('unshift_array'))
{
	function unshift_array($array,$value,$multi=FALSE)
	{
		//array_unshift($array,$value);
		if($multi)
		{
			if(is_array($value))
			{
				$count = count($value);
				for($i=0;$i<$count;$i++)
				{
					array_unshift($array,$value[$i]);
				}
				return $array;
			}			
		}
		else
		{
			array_unshift($array,$value);
			return $array;				
		}

	}
}

/*@ array count counts the number of elements in give array
*	Specify an array/multi-dimentional array
*	Second Parameter multi-dimentional array status default is FALSE
*/
if(!function_exists('array_count'))
{
	function array_count($array,$multi=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an Array';
		}
		if($multi)
		{
			foreach($array as $a):
				$finalArray[] = count($a);
			endforeach;
			return $finalArray;
		}
		return count($array);	
	}
}
/*@ sort an array and return sorted array accepts 4 parameter written in core
*	First Parameter Array Speficy
*	Second Parameter Multi-dimentional status default FALSE.
*	Third Parameter Order TRUE/FALSE TRUE for ASC FALSE FOR DSC
*	Fourth Parameter retain the key in array after sorting, TRUE to Retain Key even after sort. Default is False
*/

if(!function_exists('sort_array_custom'))
{
	function sort_array_custom($array,$type=FALSE,$order=TRUE,$retainKey=FALSE)
	{
		if(!is_array($array))
		{
			return 'Not an array';
		}
		else
		{
			if($type)
			{
				$mFinalArray = array();
				$finalArray = array();
				foreach($array as $a):
					$Array = array();
					$vArray = array_values($a);
					$kArray = array_keys($a);
						if($order)
						{
							$sArray = MySortAsc($vArray);
						}
						else
						
						{
							$sArray = MySortDsc($vArray);
						}
					$finalArray = array_combine($kArray,$sArray);
					if($retainKey)
					{
						foreach($finalArray as $key=>$val):
							$key1 = array_search($val,$a);
							$Array[$key1] = $val;
						endforeach;
						array_push($mFinalArray,$Array);
					}
					else
					{
						array_push($mFinalArray,$finalArray);
					}
									
				endforeach;
				return $mFinalArray;
			}
			else
			{
				$vArray = array_values($array);
				$kArray = array_keys($array);
				if($order)
				{
					$sArray = MySortAsc($vArray);
				}
				else
				{
					$sArray = MySortDsc($vArray);
				}
				$finalArray = array_combine($kArray,$sArray);
				if($retainKey)
				{
					foreach($finalArray as $key=>$val):
						$key1 = array_search($val,$array);
						$Array[$key1] = $val;
					endforeach;
					return $Array;
				}
				return $finalArray;
			}
		}
	}
}
/*@ MySortAsc Sorts an array in ascending order.
* First Parameter Specify array
*/

function MySortAsc($array)
{
	$count = count($array);
	do
	{
		$swapped = FALSE;
		for($i=0;$i<$count-1;$i++)
		{
			 if( $array[$i] > $array[$i+1] )
			 {
				 list($array[$i],$array[$i+1]) = array($array[$i+1],$array[$i]);  
				 $swapped = TRUE;
			 }
		}
		$count--;
	}
	while($swapped);
	return $array;
}
/*@ MySortDsc Sorts an array in descending order.
* First Parameter Specify array
*/
function MySortDsc($array)
{
	$count = count($array);
	do
	{
		$swapped = FALSE;
		for($i=0;$i<$count-1;$i++)
		{
			 if( $array[$i] < $array[$i+1] )
			 {
				 list($array[$i],$array[$i+1]) = array($array[$i+1],$array[$i]);  
				 $swapped = TRUE;
			 }
		}
		$count--;
	}
	while($swapped);
	return $array;
}
?>