<?PHP
	/**
	 * Copyright : Alex Favorov (lofa@forma.kharkov.ua)
	 			   Dmitriy Feshchenko
	 * Build     : 1.2.0
	 */


	class Timer {

		var $_runTime;
		var $_useShatdown = 0;
		var $_doubleDeep = 5;
		var $_timeLabels = array();

		function Timer() {
			$this->_runTime = $this->getTime();
			if ($this->_useShatdown) {
				register_shutdown_function("timerShutDown");
			}
		}

		function getTime(){
			list($usec, $sec) = explode(" ",microtime());
			return ((float)$usec + (float)$sec);
		}

		function start($label) {
			if (!isset($this->_timeLabels[$label] ) ) {
				$this->_timeLabels[$label] = array("started" => 0, "counter" => 0, "times" =>0);
			}
			$cur_label = &$this->_timeLabels[$label];
			if ($cur_label["started"] == 0) {
				$cur_label["started"] = $this->getTime();
			}
			$cur_label["times"]++;
		}

		function stop($label){
			if (!isset($this->_timeLabels[$label]) ) {
				$this->_timeLabels[$label] = array("started" => 0, "counter" => 0);
			}
			$cur_label = &$this->_timeLabels[$label];
			if ($cur_label["started"]) {
				$cur_label["counter"] += $this->getTime() - $cur_label["started"];
				$cur_label["started"] = 0;
			}
		}

		function display(){
			$total = $this->getTime() - $this->_runTime;
			echo "<pre>\n";
			echo "Total execution time: " . number_format($total, $this->_doubleDeep) . "\n";
			foreach($this->_timeLabels as $name=>$val) {
				if ($val['started']) {
					$val["counter"] += $this->getTime() - $val["started"];
					$val["started"] = 0;
				}
				echo "$name: <b>" . number_format(100*$val["counter"]/$total, 2) . "%</b>($val[times]) (" . number_format($val["counter"], $this->_doubleDeep) . ")\n";
			}
			echo "</pre>";
		}

		function getTimerInfo()
		{
			$total = $this->getTime() - $this->_runTime;
			echo "Total execution time: " . number_format($total, $this->_doubleDeep) . "\n";
			$TimerInfo['total'] = $total;
			foreach($this->_timeLabels as $name=>$val) {
				if ($val['started']) {
					$val["counter"] += $this->getTime() - $val["started"];
					$val["started"] = 0;
				}
				$TimerInfo[$name] = array('percent' => number_format(100*$val["counter"]/$total, 2), 'time' => number_format($val["counter"], $this->_doubleDeep));
			}
			return $TimerInfo;
		}




	}

	function timerShutDown($timerObjectName = "Timer") {
		global $$timerObjectName;
		if (isset($GLOBALS[$timerObjectName]) && is_object($GLOBALS[$timerObjectName]) ) {
			$Timer = $GLOBALS[$timerObjectName];
			$Timer->send();
		}
	}
?>