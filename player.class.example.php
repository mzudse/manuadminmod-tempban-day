<?php

//...
public function tempBanDay($reason = false, $time = false, $kicker = false) {
		if (!$reason) {
			$reason = $this->mod->getCV("kickban", "defaultbanreason");
		}
		
		if (!$time || !is_numeric($time) || $time < 0) {
		    $time = 1;
		}
		else {
		    $time = (int)$time;
		}
		$this->mod->rconSay("^3".$this->getName()."^7 got ^3tempbanned ^7for ".$time."day. ^3REASON: ^7".$reason);
		$result = $this->rcon->rcon("tempban " . $this->pid. " ".$time."d ".$reason);

    $kickerlog = ($kicker !== false) ? $this->players[$kicker]->getName() : "MOD";
		$this->logging->write(MOD_NOTICE, "Player '$this->name' got temporarily banned for $time day (by: $kickerlog), reason: $reason, PID: $this->pid, GUID: $this->guid");

		$this->mod->triggerEvent("playerTempBannedDay", array($this->guid, $reason, $time ? $time : 1, $kicker));

		return true;
}
  //...
