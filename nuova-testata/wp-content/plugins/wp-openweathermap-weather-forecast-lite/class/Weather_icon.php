<?php

  /**
  * 
  */
  class Weather_icon
  {
  	
  	function __construct()
  	{
      
  	}

  	function icon($icon_code)
  	{
  		  switch ($icon_code) {
  			case '01d':
  				  return "wi-day-sunny";
  				break;

  			case '02d':
  				  return "wi-day-cloudy";
  				break;

  				/************/

  			case '03d':
  				  return "wi-cloud";
  				break;

  			case '04d':
  				  return "wi-cloudy";
  				break;


  			case '09d':
  				  return "wi-sprinkle";
  				break;

  			case '10d':
  				  return "wi-day-rain";
  				break;


  			case '11d':
  				  return "wi-thunderstorm";
  				break;


  			case '13d':
  				  return "wi-snow";
  				break;


  			case '50d':
  				  return "wi-fog";
  				break;

  			/* Night ---------------- */


  			case '01n':
  				  return "wi-night-clear";
  				break;

  			case '02n':
  				  return "wi-night-alt-cloudy";
  				break;

  				/************/

  			case '03n':
  				  return "wi-cloud";
  				break;

  			case '04n':
  				  return "wi-cloudy";
  				break;


  			case '09n':
  				  return "wi-sprinkle";
  				break;

  			case '10n':
  				  return "wi-night-alt-hail";
  				break;


  			case '11n':
  				  return "wi-thunderstorm";
  				break;


  			case '13n':
  				  return "wi-snow";
  				break;


  			case '50n':
  				  return "wi-fog";
  				break;
  			
  			default:
  				  return "";
  				break;
  		}
  	}

  }


 //$icon_obj = new Weather_icon();
 //echo $icon_obj->icon("050n");
?>