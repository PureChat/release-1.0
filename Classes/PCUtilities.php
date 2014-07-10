<?php
/**
 * PureChat (PC)
 *
 * @file ~./Classes/Utilities/Base.php
 * @author The PureChat Team
 * @copyright 2012-2014 PureChat.org <http://www.purechat.org>
 * @license GPL <http://www.gnu.org/licenses/>
 *
 * @version 0.0.1 (Alpha)
 * @file version 0.0.1 (Alpha)
 */
/**
 * This file is part of PureChat.

 * PureChat is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * PureChat is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with PureChat.  If not, see <http://www.gnu.org/licenses/>.
 */
 
class Classes_PCUtilities  {

	public $module, $modules;

	public function __construct() {
		$this->modules = array(
			'PCBuffer' => 'Classes_Utilities_PCBuffer',
		);
		$this->module  = array();
	}

	public function loadModule($module_name) {
		if (array_key_exists($module_name, $this->modules)) {
			$this->module[$module_name] = new $this->modules[$module_name];
			return $this->module[$module_name];
		} else {
			return false;
		}
	}

 }