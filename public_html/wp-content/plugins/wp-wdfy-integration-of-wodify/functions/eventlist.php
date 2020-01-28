<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function wpwdfy_get_event_list($locations,$inclcomp,$exclcomp,$columns,$schemaorg,$numdays=1,$dateformat,$showheader) {
	global $wp_locale;
	$docoaches=true;
	$text="";
	   
		   
	if (get_option('wdfy_classes_cron')=='none')
	{
		$usecache=0;
	}
	else
	{
		$usecache = 1; 
	}

	$lines			= isset( $columns) ? $columns : array('program','date','coach');
	$futuredays = $numdays;
	$output="";
	$output .= '<div class="wdfy_upcoming_events">';
	$output.='<table class="wdfy_upcoming_events">';
	if ($showheader)
	{
		$output.='<tr>';
		foreach ($lines as $line)
		{
			switch ($line)
			{
				case 'location':
					$output.= '<th class="wdfy_eventlisthead_locationname">';
					$output.= __('Location','wp-wdfy-integration-of-wodify');
					$output.='</th>';
					break;
				case 'address':	
					$output.= '<th class="wdfy_eventlisthead_locationaddress">';
					$output.= __('Address','wp-wdfy-integration-of-wodify');
					$output.='</th>';
					break;
				case 'program':	
					$output.= '<th class="wdfy_eventlisthead_program">';
					$output.= __('Event','wp-wdfy-integration-of-wodify');
					$output.='</th>';
					break;
				case 'date':
					$output.= '<th class="wdfy_eventlisthead_date">';
					$output.= __('Date','wp-wdfy-integration-of-wodify');
					$output.='</th>';
					break;
				case 'time':
					$output.= '<th class="wdfy_eventlisthead_time">';
					$output.= __('Time','wp-wdfy-integration-of-wodify');
					$output.='</th>';
					break;
				case 'coach':			
					$output.= '<th class="wdfy_eventlisthead_coach">';
					$output.= __('Coach','wp-wdfy-integration-of-wodify');
					$output.='</th>';
					break;
			}
		}
		$output.='</tr>';
	}
	$countrows = 0;
	$datetime = new DateTime();  
	$datetime->setTimeZone(new DateTimeZone(wpwdfy_get_timezone_string()));
	$prg_inactive=get_option('wdfy_prg_inactive');
	$coach_url=get_option('wdfy_coach_url');
	$prg_images = get_option('wdfy_prg_image');
	if (!$coach_url)
		$coach_url = array();
	
	
	if (!$prg_inactive)
			$prg_inactive = array();
	do
	{
		foreach ($locations as $location)
		{
			$alllocs=SOS_Wodify_API::wodifyLocations();
			if (is_array($alllocs))
			{
				foreach ($alllocs as $loc)
				{
					if ($loc->Name == $locationname)
						exit;
				}
			}
			else
			{
				$loc=$alllocs;			
			}
			$locationid=$loc->Id;
			
			$classes =SOS_Wodify_API::wodifyClasses( $locationid, $datetime->format('Y/m/d') ,null,$usecache);
			
			if (is_array($classes))
			{
			foreach ($classes as $class)
			{
				if (array_key_exists(sanitize_title_with_dashes($class->ProgramName),$prg_inactive))
				{
					$programinactive=$prg_inactive[sanitize_title_with_dashes($class->ProgramName)];
				}
				else
				{
					$programinactive=false;
				}
				
				if (is_array($exclcomp) && (in_array($class->ProgramName,$exclcomp)))
				{
					$programinactive = true;
				}
				if (!empty($inclcomp) && !in_array($class->ProgramName,$inclcomp))
				{
					$programinactive = true;
				}
				
						
				if (!$programinactive)
				{
					$docoaches = true;
					
					$enddatetime = new DateTime($class->EndDateTime, new DateTimeZone(get_option('wodify_timezone')));
					$startdatetime = new DateTime($class->StartDateTime, new DateTimeZone(get_option('wodify_timezone')));

					if ($docoaches && $enddatetime->diff(new DateTime())->invert)
					{
						$output .= '<tr class="wdfy_evenlist_container">';				
						foreach ($lines as $line)	
						{
							switch ($line)
							{
								case 'location':			
									$output .= '<td class="wdfy_eventlist_locationname">';
									$output .= $loc->Name;
									$output.= "</td>";								
									break;
								case 'address':			
									$output .= '<td class="wdfy_eventlist_locationaddress">';
									if ($loc->StreetAddress1)
										$output .= $loc->StreetAddress1.", ";
									if ($loc->StreetAddress2)
										$output .= $loc->StreetAddress2.", ";
									$output .= $loc->City;
									$output.= "</td>";								
									break;
								case 'program':			
									$output .= '<td class="wdfy_eventlist_programname">';
									$output .= $class->ProgramName;
									$output.= "</td>";								
									break;
								case 'date':
									$output .= '<td class="wdfy_eventlist_date">';
									$output .= $startdatetime->format($dateformat);
									$output.= '</td>';
									break;
								case 'time':
									$output.= '<td class="wdfy_eventlist_hours">';
									$output .= $startdatetime->format(get_option('time_format'))."-".$enddatetime->format(get_option('time_format'));
									$output.= "</td>";
									break;
								case 'coach':
									$output .= '<td class="wdfy_eventlist_coach">';
									if ($class->Coaches)
									{
										$coachesstr="";
										$coaches = $class->Coaches->APICoach;
										if (!is_array($coaches))
										{
											$coaches = null;
											$coaches[] = $class->Coaches->APICoach;
										}
										$coachnum = 0;
										foreach ($coaches as $coach)
										{													
											if ($coachnum) 
											{
												$output.=", ";
												$coachesstr.=", ";
											}										
											if (array_key_exists(sanitize_title_with_dashes($coach->Name),$coach_url))
											{
												$curl=$coach_url[sanitize_title_with_dashes($coach->Name)];
											}
											else
											{
												$curl='';
											}	
											if ($curl)										
												$output.='<a href="'.$curl.'">';
											$output.= $coach->Name;
											$coachesstr.=$coach->Name;
											if ($curl)
												$output.='</a>';
											$coachnum++;
										}	
									}
									$output.= "</td>";
									default: 
										break;
							}
							$output.=" ";
							
						}
						
						//schema.org
						if ($schemaorg)
						{
							$script='<script type="application/ld+json">{"@context": "http://schema.org/","@type": "Event","name": "';
							$script.= $class->ProgramName;
							$script.='","startDate": "';
							$script.=$startdatetime->format(DATE_ATOM);
							$script.='",';
							$script.='"endDate": "';
							$script.=$enddatetime->format(DATE_ATOM);
							$script.='","url": "';
							global $wp;
							$script.=home_url(add_query_arg(array(), $wp->request));
							$script.='",';
														
							if ($coachesstr)
							{
								$script.='"performer": "';
								$script.=$coachesstr.'",';
							}
							$script.='"location": {"@type": "ExerciseGym","name": "';
							$script.=$loc->Name;
							
							$script.='","address": "';
							if ($loc->StreetAddress1)
								$script.= $loc->StreetAddress1.", ";
							if ($loc->StreetAddress2)
								$script .= $loc->StreetAddress2.", ";
							$script .= $loc->City;
							$script.=', ';
							$script.=$loc->Country;
							
							$script.='","image": "';
							if (array_key_exists(sanitize_title_with_dashes($class->ProgramName),$prg_images))
									$prg_image=$prg_images[sanitize_title_with_dashes($class->ProgramName)];
							if (!$prg_image)
								$prg_image = get_option('wdfy_schema_siteimage');
							if (!$prg_image)
								$prg_image = get_custom_logo();
							if (!$prg_image)
								$prg_image.=plugins_url('../img/calendar.png', __FILE__);
							$script.= $prg_image.'"';
							
							
							$script.='},"description": "';
							$script.=$class->ProgramName;
							$script.='"';
							
						
							
							/*,
							  "offers": {
								"@type": "Offer",
								"name": "Teilnahmegebühr für Athleten",
								"price": "20",
								"priceCurrency": "EUR",
								"category": "primary",
								"url": "https://muft.crossfitmagdeburg.eu/#register"
							  }
							*/
							$script.="}</script>\n";
							wpwdfy_require_script($script);
						}
							
						$output .= "</tr>";
						$countrows++;
					}
				}			
			}}
			$futuredays--;
			$datetime->modify('+1 day');
		}		
	} while ($futuredays>-1);
	$output.="</table>";
	
	if (!$countrows)
	{
			$output.=__('No upcoming events.','wp-wdfy-integration-of-wodify');
	}
	$output.="</div>";
	
	
	return $output;
	
}
	
?>