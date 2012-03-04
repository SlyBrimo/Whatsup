<?php 

namespace Whatsup\SUPBundle\Helper;

class Calendar{
	public $today;
	public $month;
	public $firstDay;
	public $lastDay;
	public $prevYear;
	public $nextYear;
	public $prev;
	public $next;
	public $prevText;
	public $nextText;
	public $actDay;
	public $events;
	
	function __construct($events = 0, $month=null){
		$month ? $this->today = getdate($month) : $this->today = getdate();
		$this->events = $events;
		
		if(isset($_POST['month'])){
			$this->thisMonth = getdate($_POST['month']);		
		} else {
			$this->thisMonth = $this->today;
		}
		
		$this->firstDay = getdate(mktime(0,0,0,$this->thisMonth['mon'],1,$this->thisMonth['year']));
   		$this->lastDay  = getdate(mktime(0,0,0,$this->thisMonth['mon']+1,0,$this->thisMonth['year']));
   		
   		//error fix
		if($this->firstDay['wday'] == 0)
			$this->firstDay['wday'] = 1;
	
		$this->prevYear = $this->thisMonth['year'];
		$this->nextYear = $this->thisMonth['year'];
		
		if($this->thisMonth['mon'] == 1){
			$this->prevYear = $this->thisMonth['year'] - 1;
			$this->prev = strtotime('1-12-' . $this->prevYear);
			$this->next = strtotime('1-'.($this->thisMonth['mon'] + 1) . '-' . $this->nextYear);
		} elseif($this->thisMonth['mon'] == 12){
			$this->nextYear = $this->thisMonth['year'] + 1;
			$this->next = strtotime('1-1-' . $this->nextYear);
			$this->prev = strtotime('1-'.($this->thisMonth['mon'] - 1) . '-' . $this->prevYear);
		} else {
			$this->prev = strtotime('1-'.($this->thisMonth['mon'] - 1) . '-' . $this->prevYear);
			$this->next = strtotime('1-'.($this->thisMonth['mon'] + 1) . '-' . $this->nextYear);
		}
					
		$this->prevText = getdate($this->prev);
		$this->prevText = $this->prevText['month'];
		$this->nextText = getdate($this->next);
		$this->nextText = $this->nextText['month'];
	}
	
	function getEvents(){
		$to = $this->thisMonth['year'].'-'.$this->thisMonth['mon'].'-01';
		$from = $this->thisMonth['year'].'-'.$this->thisMonth['mon'].'-'.$this->lastDay['mday'];
	}

	function printHeader(){
		echo "<style type=\"text/css\" media=\"screen\">.today{background:#ffD999 }</style>";
		echo "<div id='calendar'>";
		echo '<table>';
   		echo '<tr><th colspan="7" style="float:none; background:orange; padding:10px">
			<span style="float:left">
				<a href="#" class="calPrevMonth" id='.$this->prev.'>&lt; '.$this->prevText. '</a>
			</span>'.
			$this->thisMonth['month'].' - '.$this->thisMonth['year'].
			'<span style="float:right">
				<a href="#" class="calNextMonth" id='.$this->next.'>'.$this->nextText.' &gt;</a>
			</span></th></tr>';
   
		echo '<tr class="days">';
   		echo '<td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Th</td>';
   		echo '<td>Fr</td><td>Sa</td></tr>';
	}
	
	function printFirstWeek(){
		echo '<tr class="week">';
   		for($i=0;$i<$this->firstDay['wday'];$i++){
    	  	 	echo '<td class=\"day blankday\">&nbsp;</td>';
   		}
   		
   		$this->actday = 0;
  			
   		for($i=$this->firstDay['wday'];$i<=6;$i++){
       		$this->actday++;
			if($this->today['mday'] == $this->actday && $this->today['mon'] == $this->thisMonth['mon'])
				echo "<td class=\"day today\">";
			else
       			echo "<td class=\"day\">";
			echo "<span class=\"dayNum\">$this->actday</span><br>";
	
			$formatedDay = $this->createCheck($this->actday,$this->thisMonth);
			$this->checkEvents($formatedDay,$this->events);
			echo "</td>";
		}
   		echo '</tr>';
	}
	
	function printFullWeeks(){
		$fullWeeks = floor(($this->lastDay['mday']-$this->actday)/7);
  			for ($i=0;$i<$fullWeeks;$i++){
       		echo '<tr class="week">';
       		for ($j=0;$j<7;$j++){
           		$this->actday++;
           		if($this->today['mday'] == $this->actday && $this->today['mon'] == $this->thisMonth['mon'])
					echo "<td class=\"today\">";
				else
        			echo "<td class=\"day\">";
				echo "<span class=\"dayNum\">$this->actday</span><br>";
				$formatedDay = $this->createCheck($this->actday,$this->thisMonth);
				$this->checkEvents($formatedDay,$this->events);
				echo "</td>";
       		}
       		echo '</tr>';
   		}
	}
	
	function printLastWeek(){
	    if($this->actday < $this->lastDay['mday']){
       		echo '<tr class="week">';
       
       		for ($i=0; $i<7;$i++){
           		$this->actday++;
           		if ($this->actday <= $this->lastDay['mday']){
               		if($this->today['mday'] == $this->actday && $this->today['mon'] == $this->thisMonth['mon']) 
						echo "<td class=\"today\">";
					else
	        			echo "<td class=\"day\">";
					echo "<span class=\"dayNum\">$this->actday</span><br>";
					$formatedDay = $this->createCheck($this->actday,$this->thisMonth);
					$this->checkEvents($formatedDay,$this->events);
					echo "</td>";
           		} else {
               		echo '<td class=\"day\ blankday">&nbsp;</td>';
           		}
       		}  
       		echo '</tr></table></div>';
   		} else {
			echo '</table></div>';
		}
	}
	
	function printCal(){
		$this->printHeader();
		$this->printFirstWeek();
		$this->printFullWeeks();
		$this->printLastWeek();
	}
	
	function createCheck($actday, $today){
		if($today['mon'] < 10){
			$checkMonth = 0 . $today['mon'];
		} else {
			$checkMonth = $today['mon'];
		}
		if($actday < 10){
			$checkDay = 0 . $actday;
		} else {
			$checkDay = $actday;
		}
		$check = $today['year'] . "-" . $checkMonth . "-" . $checkDay;
		return $check;
	}
	
	function checkEvents($day,$events){
		if($events){		
			foreach($events as $event){				
				if($event->getStartdate()->format('Y-m-d') == $day){
					echo '<a href="#">'. $event->getName() . "</a>";
				}
			}
		}
	}
}