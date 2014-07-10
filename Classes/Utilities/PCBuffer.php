<?php
/**
 * PureChat (PC)
 *
 * @file ~./Classes/Utilities/PCBuffer.php
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
 
class Classes_Utilities_PCBuffer {

	public function __construct() {
		//-- Loaded PCBuffer Utility Module
	}

	public function sanitizeUserMethods() {
		$_GET = array_map('stripslashes', $_GET);
		$_POST = array_map('stripslashes', $_POST);
		$_REQUEST = array_map('stripslashes', $_REQUEST);
	}

 }