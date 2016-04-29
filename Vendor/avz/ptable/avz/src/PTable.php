<?php
/**
* @author anovsiradj (Mayendra Costanov)
* @version 201603081142 (created)
* @license MIT (http://anovsiradj.mit-license.org/2016-2016)
*/
namespace avz\PTable;

class PTable {
	private $table;
	function __construct() { $this->open(); }
	public function open() { $this->table = ["<table>"]; }
	public function thead() {
		$this->is_thead = true;
		$this->thead = ["<thead>"];
		$this->table[] = &$this->thead;
		return $this;
	}
	public function tbody() {
		$this->is_tbody = true;
		$this->tbody = ["<tbody>"];
		$this->table[] = &$this->tbody;
		return $this;
	}
	public function tr() {
		$this->is_tr = true;
		$this->close();
		$this->tr = ["<tr>"]; // renew
		switch (true) {
			case (@$this->is_tbody):
				$this->tbody[] = &$this->tr;
			break;
			case (@$this->is_thead):
				$this->thead[] = &$this->tr;
			break;
			default:
				$this->table[] = &$this->tr;
			break;
		}
		return $this;
	}
	public function td($k) {
		if (is_array($k)) {
			foreach ($k as $v) {
				$this->tr[] = "<td>".$v."</td>";
			}
		} else {
			$this->tr[] = "<td>".$k."</td>";
		}
	}
	public function th($k) {
		if (is_array($k)) {
			foreach ($k as $v) {
				$this->tr[] = "<th>".$v."</th>";
			}
		} else {
			$this->tr[] = "<th>".$k."</th>";
		}
	}
	function close() {
		switch (true) {
			case (@$this->is_tr):
				if (isset($this->tr)) {
					$this->tr[] = "</tr>";
					$this->tr = implode("",$this->tr);
					$this->is_tr = false;
					unset($this->tr);
				}
			break;
			case (@$this->is_thead):
				if (isset($this->thead)) {
					$this->thead[] = "</thead>";
					$this->thead = implode("",$this->thead);
					$this->is_thead = false;
					unset($this->thead);
				}
			break;
			case (@$this->is_tbody):
				if (isset($this->tbody)) {
					$this->tbody[] = "</tbody>";
					$this->tbody = implode("",$this->tbody);
					$this->is_tbody = false;
					unset($this->tbody);
				}
			break;
		}
	}
	public function render($echo = false) {
		$this->table[] = "</table>";
		$this->table = implode("",$this->table);
		if ($echo) { echo $this->table; } else { return $this->table; }
		unset($this->table);
	}
}