<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
class SOS_Wodify_API
{
	public static function wodifyClasses($location, $date, $programid="",$usecachedresult=true){
		$data = array(                 
			"apikey" => get_option('wodify_apikey'),                 
			"type" => 'json',        
			"encoding" => 'utf-8',
			"date" => $date,
			"locationid" => $location
			//"coachuserid" => $coachuserid
			); 

		$result=null;
		if ($programid) {
			$data["programid"]=$programid;
		}
		
		global $wdfydebug;
		if (isset($wdfydebug)&&(true==$wdfydebug))
			$usecachedresult =false;
		
		if ($usecachedresult && !$programid) // cache only if all classes are requested		
		{
			$result = get_transient('wdfyclasses_'.sanitize_title_with_dashes($date).sanitize_title_with_dashes($location));
			if (!is_array($result))
			{
				$result=null;
			}
		}
		if (!$result)	
		{
			
			
			$url = sprintf("%s?%s", "http://app.wodify.com/API/Classes_v1.aspx",  http_build_query($data));    					
			$result=wp_remote_get( $url );
			if ( is_array( $result ) ) {
				$result = $result['body']; 
			}						
						
			$result = json_decode($result);
			if (!isset($result->RecordList))
			{
				return false;	  
			}

			$result = $result->RecordList->Class;
			
			//debug
			if (isset($wdfydebug)&&(true==$wdfydebug))
				print_r($result);
			
			if (get_option('wdfy_classes_cron')!='none')
			{
				set_transient('wdfyclasses_'.sanitize_title_with_dashes($date).sanitize_title_with_dashes($location),$result,3600*24); //cache classes for one day to overcome Wodify outages cache renew will be done via cron
			}
		}    
		if (!is_array($result))
		{
			$resultarray[]=$result;
			return $resultarray;
		}
		return $result; 
	}
	
	public static function getLocationId($locationname)
	{
		$locations=SOS_Wodify_API::wodifyLocations();
		
		if (is_array($locations))
		{
			foreach ($locations as $loc)
			{
				if ($loc->Name == $locationname)
					return $loc->Id;
			}
		}
		else
		{
			if ($locationname == $locations->Name)
				return $locations->Id;
			else
				return false;
		}
		return false;
	}
	
	
	public static function wodifyLocations($cache=true){
		$data = array(                 
        "apikey" => get_option('wodify_apikey'),                 
		"type" => 'json',        
	    "encoding" => 'utf-8'
		);

		$cached = get_transient('wdfy_cachedlocation');	//Cache still current -> Use cache if thats ok
		if ($cached && $cache)
		{
			$result = get_option('wdfy_locations');
			if ($result)
				return $result;		
		}
	
		
		$url = sprintf("%s?%s", "http://app.wodify.com/API/Locations_v1.aspx",  http_build_query($data));    					
			$result=wp_remote_get( $url );
			if ( is_array( $result ) ) {
				$result = $result['body']; 
		}	
		
		$result = json_decode($result);
		if (isset($result->RecordList))  // Wodify returned correct result, update cache and return result;
		{
			$result = $result->RecordList->Location;
			if (!is_array($result))
			{
				$resultarray[]=$result;
				$result = null;
				$result = $resultarray;
			}
			update_option('wdfy_locations',$result);
			set_transient('wdfy_cachedlocation',true,3600*24); // cache location list for one day		
			return $result;
		}
		else // no proper result returned, check if we save an earlier result
		{
			$result = get_option('wdfy_locations');
			if ($result && $cache)
				return $result;
			else
				return false;
		}   
    }    

	public static function wodifyPrograms($cache=true){
		$data = array(                 
			"apikey" => get_option('wodify_apikey'),                 
			"type" => 'json',        
			"encoding" => 'utf-8'
		); 
		$cached = get_transient('wdfy_cachedprogram');	//Cache still current -> Use cache if thats ok
		
		if ($cached && $cache)
		{
			$result = get_option('wdfy_programs');
			if ($result[0])
			{
				return $result;	
			}
			
		}
		
		$url = sprintf("%s?%s", "http://app.wodify.com/API/Programs_v1.aspx",  http_build_query($data));    					
			$result=wp_remote_get( $url );
			if ( is_array( $result ) ) {
				$result = $result['body']; 
		}
		
		$result = json_decode($result);
		if (isset($result->RecordList))
		{
			if (isset($result->RecordList->Program))
				$result = $result->RecordList->Program;
			if (isset($result->RecordList->GymProgram))
				$result = $result->RecordList->GymProgram;
			if (!is_array($result))
			{
				$resultarray[]=$result;
				$result = null;
				$result = $resultarray;
			}
			update_option('wdfy_programs',$result);
			set_transient('wdfy_cachedprogram',true,3600*24); // cache program list for one day
			return $result;
		}
		else // no proper result returned, check if we save an earlier result
		{
			$result = get_option('wdfy_programs');
			if ($result && $cache)
				return $result;
			else
				return false;
		}   
    }    
	
	public static function wodifyCoaches($cache=true){
      $data = array(                 
        "apikey" => get_option('wodify_apikey'),                 
		"type" => 'json',        
	    "encoding" => 'utf-8'
      ); 
	  
		$cached = get_transient('wdfy_cachedcoach');	//Cache still current -> Use cache if thats ok
		if ($cached && $cache)
		{
			$result = get_option('wdfy_coaches');
			if ($result)
				return $result;		
		}
		  
		$url = sprintf("%s?%s", "http://app.wodify.com/API/Coaches_v1.aspx",  http_build_query($data));    					
			$result=wp_remote_get( $url );
			if ( is_array( $result ) ) {
				$result = $result['body']; 
		}
		
		$result = json_decode($result);
		if (isset($result->RecordList))
		{
			$result = $result->RecordList->Coach;
			if (!is_array($result))
			{
				$resultarray[]=$result;
				$result = null;
				$result = $resultarray;
			}
			update_option('wdfy_coaches',$result);
			set_transient('wdfy_cachedcoach',true,3600*24); // cache program list for one day
			return $result;
			
		}
		else // no proper result returned, check if we save an earlier result
		{
			$result = get_option('wdfy_coaches');
			if ($result && $cache)
				return $result;
			else
				return false;
		}         
    }    	
	
	public static function wodifyWOD($locationname,$programname,$date,$cachewod = true){
		$data = array(                 
			"apikey" => get_option('wodify_apikey'),                 
			"type" => 'json',        
			"encoding" => 'utf-8',
			"location" => $locationname,
			"program" => $programname,
			"date" => $date
		); 
		$dateformat = "Y/m/d";
		$dateobj = DateTime::createFromFormat($dateformat, $date);
		$wod = null;
		global $wdfydebug;
		if (isset($wdfydebug)&&(true==$wdfydebug))
			$cachewod =false;
		
		if (!isset($_GET['updatewodcache']) && $cachewod)
		{
			$wod = get_transient('wdfywod1_'.sanitize_title_with_dashes($date).sanitize_title_with_dashes($locationname).sanitize_title_with_dashes($programname));
		}
		if (!$wod)	
		{
			
			$url = sprintf("%s?%s", "http://app.wodify.com/API/WODs_v1.aspx",  http_build_query($data));    					
			$result=wp_remote_get( $url );
			if ( is_array( $result ) ) {
				$result = $result['body']; 
			}
			
			if (isset($wdfydebug)&&(true==$wdfydebug))
			{
				echo "$locationname,$programname,$date\n";
				print_r ($result);
			}
			
			$result = json_decode($result);   

			if (!isset($result->RecordList))
			{
				$wod = null;	  
			}
			else
			{
				$wod = $result->RecordList;         
			}
		
			if ($cachewod || isset($_GET['updatewodcache']))
			{
				
				$intervalwodday = $dateobj->diff(new DateTime()); // for what day
				if ($wod)
				{
					// wod chaching
					// account for Wodify's error last edited time returned as New York time.
					//$lastedit = new DateTime($wod->APIWod->WodHeader->LastEditDateTime, new DateTimeZone(get_option('wodify_timezone')));
					$lastedit = new DateTime($wod->APIWod->WodHeader->LastEditDateTime, new DateTimeZone('America/New_York'));
					
					
					$intervalcreated = $lastedit->diff(new DateTime());
	
					 //created how long ago;
					if (0==$intervalcreated->d && 0 == $intervalcreated->h) // if wod modified less than an hour ago it might still change
					{
						$cachetime = -1; // 20mins		
					}
					elseif ($date==date("Y/m/d")) // todays wod
					{
						$cachetime = 60*60*24;
					}
					elseif ($intervalwodday->invert) // wod is for a future day, don't cache too long, might still change
					{
						$cachetime =60*60*8; //8hours
					}
					elseif (7>=$intervalwodday->d) // cache older wods only up to 7 days
					{
						 $cachetime = (8-$intervalwodday->d) * 60*60*24;
					}
					else
					{
						$cachetime = -1; //do not cache older wods
					}
					if ($cachetime>0)
						set_transient('wdfywod1_'.sanitize_title_with_dashes($date).sanitize_title_with_dashes($locationname).sanitize_title_with_dashes($programname),$wod,$cachetime);
					else
						delete_transient('wdfywod1_'.sanitize_title_with_dashes($date).sanitize_title_with_dashes($locationname).sanitize_title_with_dashes($programname));
				}
				else
				{
					//nowod caching					
					if ($date==date("Y/m/d")) // // no wod for today yet? look again soon
					{
						$cachetime =20*60; //20min
					}
					elseif ($intervalwodday->invert && 7>=$intervalwodday->d) // future day wod, will hopefully show up soon.
					{			
						if ($intervalwodday)
						$cachetime = ($intervalwodday->d + 1) *4 *60*60 ; // 4hours for each day in the future
					}
					elseif (7>=$intervalwodday->d)// past wod - / cache older wods only up to 7 days
					{
						$cachetime = (8-$intervalwodday->d) * 60*60*24;
					}
					else
					{
						$cachetime=-1;
					}
					$nowod='nowod';
					set_transient('wdfywod1_'.sanitize_title_with_dashes($date).sanitize_title_with_dashes($locationname).sanitize_title_with_dashes($programname),$nowod,$cachetime); // 
				}
			}
		}		
		if ('nowod'==$wod)
			$wod =false;
		return $wod;
	}
	
	//get Wod from Wodify and format
	public static function wodifyFormatedWOD($locationname,$programname,$date,$ignorepublishdate=false,$includecomponent=array(),$excludecomponent=array(),$cachewod=true,$publishoffset='',$showimages=false){
		if (''===$publishoffset)
			$publishoffset = get_option('wdfy_publishoffset');
		if (substr($date,0,1)=='+'||substr($date,0,1)=='-')
		{
			$datetime = new DateTime();
			
			$datetime->setTimeZone(new DateTimeZone(wpwdfy_get_timezone_string()));
			$modify=$date.' day';
			$datetime->modify($modify);			
			$date = $datetime->format('Y/m/d');
		}
		$wod = 	SOS_Wodify_API::wodifyWOD($locationname,$programname,$date,$cachewod);
		return (SOS_Wodify_API::formatWOD($wod,$date,$ignorepublishdate,$includecomponent,$excludecomponent,$publishoffset,$showimages));
		
	}
	
	
	// Format Wod returned by Wodify API
	public static function formatWOD($wod,$date='',$ignorepublishdate=false,$includecomponent=array(),$excludecomponent=array(),$publishoffset='',$showimages=false, $dothumb =false){
		$output = '';
		$publish = null;
		if (''===$publishoffset)
			$publishoffset = get_option('wdfy_publishoffset');
		
		if ($wod)
		{			
			if ('internalpublishdate'==get_option('wdfy_publishdatesetting')){
				$blogpublish = new DateTime($wod->APIWod->WodHeader->InternalPublishDateTime, new DateTimeZone(get_option('wodify_timezone')));
			}
			else {
				$blogpublish = new DateTime($wod->APIWod->WodHeader->BlogPublishDateTime, new DateTimeZone(get_option('wodify_timezone')));
			}
			$publishoffset +=0.0;
			if ($publishoffset)
			{
				$blogpublish->modify($publishoffset.' hour');
			}
			
			$publish = $blogpublish->diff(new DateTime());
			$debug1='<!-- 
				apiinternaltime: '.print_r($wod->APIWod->WodHeader->InternalPublishDateTime,true).'
				blogpublish: '.print_r($blogpublish,true).'
				current: '.print_r (new DateTime(),true).'
				diff: '.print_r($publish,true).' -->';
				
			$output.=str_replace("=>",":",$debug1);
			
			if (!$ignorepublishdate && $publish && $publish->invert)
			{
				$output.= '<div class="soswodify_wod_notavailable">';
				$output.= __('WOD not yet available. Please come back later!','wp-wdfy-integration-of-wodify');
				$output.='</div>';
				return  $output;
			}
		}
		else {
			$output.= '<div class="soswodify_wod_notavailable">';
			$output.= __('No WOD available','wp-wdfy-integration-of-wodify');
			$output.='</div>';
			return $output;
		}

		// Filter WOD
		$output .= '<div class="soswodify_wod_wrapper">';
		
		// WOD Header
		$printsection =true;
		$wodprinted=false;
		if (is_array($excludecomponent) && (in_array('Header',$excludecomponent)))
		{
				$printsection = false;
		}
		if (!empty($includecomponent) && !in_array('Header',$includecomponent))
		{
				$printsection = false;
		}
		
		if ($printsection) {
			$output .= '<div class="soswodify_wod_header">';
			$output .= $wod->APIWod->WodHeader->Name;
			$output .= '</div>'; // wod_header
			$output .= '<div class="soswodify_wod_comment" ';
		
			if ($wod->APIWod->WodHeader->Comments)
			{	
				$output.= ">";
				$output.= nl2br(htmlentities($wod->APIWod->WodHeader->Comments));
			}
			else
			{
				$output .= 'style="display:none"><br>';
			}
			$output.= '</div>';// wod_comment
		}
		
		
		//Announcements
		$printsection =true;
		$wodprinted=false;
		if (is_array($excludecomponent) && (in_array('Announcements',$excludecomponent)))
		{
				$printsection = false;
		}
		if (!empty($includecomponent) && !in_array('Announcements',$includecomponent))
		{
				$printsection = false;
		}
		
		if ($printsection) {
			$output .= '<div class="soswodify_announcements" ';
					
			if (($wod->APIWod->Announcements) && ($wod->APIWod->Announcements!=""))
			{	
				$output.= ">";
				
				$announcements= $wod->APIWod->Announcements->Announcement;
				if (!is_array($announcements))
				{
					$annarray[]=$announcements;
						$announcements = null;
						$announcements = $annarray;
				}
				
				foreach ($announcements as $announcement)
				{
					if ("True"== $announcement->IsActive)
					{
						$announcefromdate = new DateTime($announcement->FromDate);
						$announcetodate = new DateTime($announcement->ToDate);
						$announcetodate->modify("+1 day");		
						$anntoday =  new DateTime($wod->APIWod->WodHeader->Date);
	
						if (($anntoday>=$announcefromdate) && ($announcetodate>= $anntoday ))
						{
							$output.= $announcement->LinkifiedMessage;
							$wodprinted =true;
						}
					}
				}
			}
			else
			{
				$output .= 'style="display:none"><br>';
			}
			$output.= '</div>';// announcements
		}
		
		$output .= '<span class="soswodify_ListRecords">';
		
		$printsection =true;
		$sectionopened= false;
		$firstimage=false;
		$components= $wod->APIWod->Components->Component;
		if (!is_array($components))
		{
			$comparray[]=$components;
				$components = null;
				$components = $comparray;
		}
		
		foreach ($components as $component)
		{
			if ('True'==$component->IsSection)
			{
				$printsection=true;
				if (is_array($excludecomponent) && (in_array($component->Name,$excludecomponent)))
				{
						$printsection = false;
						$output.='<!-- skipping excl. section '.sanitize_title_with_dashes($component->Name).' -->';
				}
				if (!empty($includecomponent) && !in_array($component->Name,$includecomponent))
				{
					$printsection = false;
					$output.='<!-- skipping not incl. section '.sanitize_title_with_dashes($component->Name).' -->';
				}
				if ($printsection) {
					if ($sectionopened) {
						$output.= "</div><!-- /section -->";
						$sectionopened = false;
					}
					$output.= '<div class="sos_wodify_section_'.sanitize_title_with_dashes($component->Name).'"><!-- WOD Component ID '. $component->WODComponentId .'--><div class="soswodify_section_title">';
					$sectionopened = true;
					$output.= $component->Name;
					$output.= '</div>';
					
					$output .= '<div class="soswodify_component_comment"';
		
					if ($component->Comments)
					{
						$output.=">";
						$output.= nl2br(htmlentities($component->Comments));
					}
					else
					{
						$output .= 'style="display:none"><br>';
					}
					$output.= '</div>';// wod_comment
					
					
					
					$wodprinted=true;
				}
			}
			else
			{
				// include featured images
				if ('Image'== $component->ComponentTypeName)
				{
					if($showimages || $dothumb)
					{
						$wodprinted=true;
						$attachid = get_option('wdfy_image_attachid'.$component->WODComponentId);					
						$image_url="";
						
						if ($attachid)
						{
							$image_url = wp_get_attachment_url( $attachid );
						}
						
						if (!$image_url  && (($dothumb && !$firstimage) || 'local' == get_option('wdfy_local_images')))
						{							
							$attachid=wdfy_copy_photo($component->ImageURL);
							update_option('wdfy_image_attachid'.$component->WODComponentId,$attachid);
							$image_url = wp_get_attachment_url( $attachid );
						}
						$firstimage = $attachid;
						
						if (!$image_url)
						{
							$image_url=$component->ImageURL;
							$attachid = $component->WODComponentId;
						}
						
						if ($showimages)
						{
							$output.='<figure class="wp-caption-text"><a href="'.$image_url.'">';
							$output.='<img class="soswodify_image size-full wp-image-'.$attachid.'" src="'.$image_url.'"></a>';
							if ($component->Comments)
							{
								$output .= '<figcaption soswodify_image_caption wp-caption-text>'.$component->Comments.'</figcaption>';
							}
							$output.='</figure>';		
						}
					}
				}
				elseif ($printsection)
				{
					$wodprinted=true;
					$output .= '<div class="soswodify_component_show_wrapper"><div class="soswodify_component_name">';
					$output .= $component->Name;					
					
					if (isset($component->PerformanceResultTypeName))
						$resulttype= $component->PerformanceResultTypeName;
					elseif (isset($component->ResultTypeName))
						$resulttype= $component->ResultTypeName;
					else
						$resulttype=null;
					
					if ($component->RepScheme)
					{
						$output .=" (".$component->RepScheme.")";
					}
					elseif ($resulttype)
					{
						if ("No Measure" == $resulttype)
						{
							
						}
						elseif ("Each Round" == $resulttype && absint($component->Rounds)>0 ) {
							$output .= " (".$component->Rounds." Rounds for reps)";
						}
						else	{		
							$output .=" (".$resulttype.")";
						}
					}
					
					$output .= '</div>'; // component name
					$output .= '<div class="soswodify_component_wrapper">';
					$text = nl2br(htmlentities($component->Description));
					$pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
					$text = preg_replace($pattern, "", $text);//$1 for url filtered
					$output .= $text;
					
					if ($component->Comments)
					{
						$output .= '<div class="soswodify_component_comment">';
						$text = nl2br(htmlentities($component->Comments));
						
						$pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
						$text = preg_replace($pattern, "", $text);
						
						$output .= $text;
						$output .= '</div>';
					}
					$output .= '</div>'; // component wrapper
					$output .= '</div>'; // component show wrapper
				}
			}
		}
		if ($sectionopened) {
			$output.= "</div><!-- /section -->";
			$sectionopened = false;
		}		
		if (!$wodprinted)
		{
			$output.= __('No WOD available.','wp-wdfy-integration-of-wodify');
		}
		$output .= '</span>'; //ListRecords
		$output .= '</div>'; // sos_wodify_wod_wrapper
		if ($dothumb)
			return(array($firstimage,$output));
		else
			return $output;
  
	  
    }   	
}